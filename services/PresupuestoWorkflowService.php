<?php

namespace app\services;

use app\models\EmpresaCliente;
use app\models\LocationSedes;
use app\models\NovedadConcepto;
use app\models\Presupuesto;
use app\models\PresupuestoConcepto;
use app\models\PresupuestoConceptoDia;
use app\models\PresupuestoHistorial;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;

/**
 * Workflow y persistencia del módulo Presupuestos.
 */
class PresupuestoWorkflowService
{
    /** @var AdministracionPlantaService */
    private $plantaService;

    public function __construct(?AdministracionPlantaService $plantaService = null)
    {
        $this->plantaService = $plantaService ?: new AdministracionPlantaService();
    }

    public function getCurrentEmpresaId(): int
    {
        $raw = Yii::$app->user->empresas_id ?? null;
        if (!is_numeric($raw) || (int) $raw <= 0) {
            throw new ForbiddenHttpException('Usuario sin empresa asignada.');
        }
        return (int) $raw;
    }

    /**
     * Empresa, alcance de sede (si aplica) y permisos de acción vía RBAC en el controller.
     *
     * @param bool $forWrite reservado (antes enlazaba a `readonly` de administración de planta; ya no aplica).
     * @throws ForbiddenHttpException
     */
    public function assertPresupuestoAccess(Presupuesto $model, bool $forWrite = false): void
    {
        $empresaId = $this->getCurrentEmpresaId();
        if ((int) $model->empresa_id !== $empresaId) {
            throw new ForbiddenHttpException('El presupuesto no pertenece a su empresa.');
        }

        $scope = $this->plantaService->getScopeContext();
        if (!$scope['full_access'] && !empty($scope['allowedSedeIds'])) {
            if (!in_array((int) $model->location_sede_id, $scope['allowedSedeIds'], true)) {
                throw new ForbiddenHttpException('El presupuesto no está en una sede autorizada para su usuario.');
            }
        }

        // No usar `scope['readonly']` de Administración de planta aquí: para `gerente_sede` ese flag
        // solo indica que no puede gestionar la malla de planta, pero sí puede operar presupuestos
        // si RBAC lo permite (p. ej. presupuesto_update) y la sede está en su alcance.
    }

    /**
     * Validación para guardar borrador / crear: no exige horas > 0 ni catálogo por empresa.
     * Solo comprueba que los IDs existan en `novedad_concepto` (referencia maestra) y rango de horas.
     *
     * @param int[] $conceptoIds
     * @param array<int, array<int|string, float|int|string>> $matrix
     * @return string[]
     */
    public function validateMatrixDraft(array $conceptoIds, array $matrix): array
    {
        $errors = [];
        foreach ($conceptoIds as $cid) {
            $cid = (int) $cid;
            if ($cid < 1) {
                continue;
            }
            if (!NovedadConcepto::find()->where(['id' => $cid, 'activo' => 1])->exists()) {
                $errors[] = 'Etiqueta/concepto no válido (ID ' . $cid . ').';
            }
        }

        foreach ($conceptoIds as $cid) {
            $cid = (int) $cid;
            for ($d = 1; $d <= 7; $d++) {
                $raw = $matrix[$cid][$d] ?? $matrix[$cid][(string) $d] ?? 0;
                $h = is_numeric($raw) ? (float) $raw : 0;
                if ($h < 0 || $h > 24) {
                    $errors[] = "Horas inválidas (0–24) para la línea {$cid}, día {$d}.";
                }
            }
        }

        return $errors;
    }

    /**
     * Reglas completas antes de enviar a aprobación (desde datos ya guardados).
     */
    public function validatePresupuestoParaEnviar(Presupuesto $p): array
    {
        $errors = [];
        $conceptos = $p->getPresupuestoConceptos()->with('dias')->all();
        if (count($conceptos) < 1) {
            $errors[] = 'Debe añadir al menos una etiqueta/concepto y guardar antes de enviar a aprobación.';
            return $errors;
        }
        foreach ($conceptos as $pc) {
            $sumPositive = false;
            foreach ($pc->dias as $dia) {
                $h = (float) $dia->horas_maximas;
                if ($h < 0 || $h > 24) {
                    $errors[] = 'Hay horas fuera del rango 0–24.';
                    return $errors;
                }
                if ($h > 0) {
                    $sumPositive = true;
                }
            }
            if (!$sumPositive) {
                $errors[] = 'Cada línea debe tener al menos un día con horas mayores a cero antes de enviar (concepto ID '
                    . (int) $pc->novedad_concepto_id . ').';
            }
        }
        return $errors;
    }

    /**
     * Listado de conceptos para presupuestos (catálogo `novedad_concepto`).
     *
     * No se usa la tabla `novedad` para armar este listado: el presupuesto no depende de novedades ya cargadas.
     *
     * - Si existe columna `novedad_tipo.empresa_id` en BD → se filtran conceptos cuyo tipo pertenece a la empresa (tenant).
     * - Si no existe → se listan **todos** los `novedad_concepto` con `activo = 1` (catálogo global del sistema).
     *   El aislamiento por tenant en ese caso queda en la cabecera del presupuesto (`empresa_id` + sede).
     */
    protected function conceptosPermitidosQuery(int $empresaId): ActiveQuery
    {
        $schema = Yii::$app->db->getTableSchema('novedad_tipo', true);
        $q = NovedadConcepto::find()->alias('c')->where(['c.activo' => 1]);

        if ($schema && isset($schema->columns['empresa_id'])) {
            return $q->innerJoin(['nt' => 'novedad_tipo'], 'nt.id = c.novedad_tipo_id')
                ->andWhere(['nt.empresa_id' => $empresaId, 'nt.activo' => 1])
                ->andWhere(['not', ['c.novedad_tipo_id' => null]]);
        }

        return NovedadConcepto::find()->alias('c')
            ->where(['c.activo' => 1]);
    }

    /**
     * @return array<int, int> map concepto_id => concepto_id
     */
    public function queryConceptosPermitidosIds(int $empresaId): array
    {
        $ids = $this->conceptosPermitidosQuery($empresaId)->select('c.id')->column();
        $map = [];
        foreach ($ids as $id) {
            $map[(int) $id] = (int) $id;
        }
        return $map;
    }

    /**
     * Lista conceptos para Select2.
     *
     * @return NovedadConcepto[]
     */
    public function listConceptosForEmpresa(int $empresaId): array
    {
        return $this->conceptosPermitidosQuery($empresaId)
            ->orderBy(['c.nombre' => SORT_ASC])
            ->all();
    }

    /**
     * @param int[] $conceptoIds
     * @param array<int, array<int, float>> $matrix
     */
    public function saveDraft(Presupuesto $presupuesto, array $conceptoIds, array $matrix): bool
    {
        $this->assertPresupuestoAccess($presupuesto, true);
        if (!$presupuesto->isEditable()) {
            throw new BadRequestHttpException('Solo se pueden guardar borradores o presupuestos rechazados en edición.');
        }

        $errs = $this->validateMatrixDraft($conceptoIds, $matrix);
        if ($errs) {
            foreach ($errs as $e) {
                $presupuesto->addError('nombre', $e);
            }
            return false;
        }

        $this->validateCabeceraNegocio($presupuesto);

        $tx = Yii::$app->db->beginTransaction();
        try {
            if (!$presupuesto->save()) {
                $tx->rollBack();
                return false;
            }

            $this->syncConceptosYDias($presupuesto, $conceptoIds, $matrix);

            PresupuestoHistorial::registrar(
                $presupuesto,
                PresupuestoHistorial::ACCION_UPDATE,
                null,
                $presupuesto->estado,
                'Guardado borrador'
            );

            $tx->commit();
            return true;
        } catch (\Throwable $e) {
            $tx->rollBack();
            throw $e;
        }
    }

    public function createNew(Presupuesto $presupuesto, array $conceptoIds, array $matrix): bool
    {
        $empresaId = $this->getCurrentEmpresaId();
        $presupuesto->empresa_id = $empresaId;
        $presupuesto->estado = Presupuesto::ESTADO_BORRADOR;
        $presupuesto->version = $presupuesto->version ?: 1;

        $errs = $this->validateMatrixDraft($conceptoIds, $matrix);
        if ($errs) {
            foreach ($errs as $e) {
                $presupuesto->addError('nombre', $e);
            }
            return false;
        }

        $this->validateCabeceraNegocio($presupuesto);

        $tx = Yii::$app->db->beginTransaction();
        try {
            if (!$presupuesto->save()) {
                $tx->rollBack();
                return false;
            }

            $this->syncConceptosYDias($presupuesto, $conceptoIds, $matrix);

            PresupuestoHistorial::registrar(
                $presupuesto,
                PresupuestoHistorial::ACCION_CREATE,
                null,
                $presupuesto->estado,
                null
            );

            $tx->commit();
            return true;
        } catch (\Throwable $e) {
            $tx->rollBack();
            throw $e;
        }
    }

    protected function validateCabeceraNegocio(Presupuesto $presupuesto): void
    {
        $sede = LocationSedes::findOne(['id' => $presupuesto->location_sede_id, 'empresa_id' => $presupuesto->empresa_id]);
        if (!$sede) {
            $presupuesto->addError('location_sede_id', 'La sede no pertenece a la empresa.');
        }

        if ($presupuesto->empresa_cliente_id) {
            $ec = EmpresaCliente::findOne(['id' => $presupuesto->empresa_cliente_id, 'empresas_id' => $presupuesto->empresa_id]);
            if (!$ec) {
                $presupuesto->addError('empresa_cliente_id', 'El cliente empresa no corresponde al tenant.');
            }
        }
    }

    /**
     * @param int[] $conceptoIds
     * @param array<int, array<int, float>> $matrix
     */
    public function syncConceptosYDias(Presupuesto $presupuesto, array $conceptoIds, array $matrix): void
    {
        $conceptoIds = array_values(array_unique(array_map('intval', $conceptoIds)));

        $existing = PresupuestoConcepto::find()
            ->where(['presupuesto_id' => $presupuesto->id])
            ->indexBy('novedad_concepto_id')
            ->all();

        foreach ($existing as $ncid => $piv) {
            if (!in_array((int) $ncid, $conceptoIds, true)) {
                PresupuestoConceptoDia::updateAll(
                    ['activo' => 0, 'updated_at' => new Expression('NOW()')],
                    ['presupuesto_concepto_id' => $piv->id]
                );
                $piv->activo = 0;
                $piv->save(false);
            }
        }

        foreach ($conceptoIds as $ncid) {
            $ncid = (int) $ncid;
            $piv = PresupuestoConcepto::find()
                ->where(['presupuesto_id' => $presupuesto->id, 'novedad_concepto_id' => $ncid])
                ->one();

            if ($piv === null) {
                $piv = new PresupuestoConcepto();
                $piv->presupuesto_id = $presupuesto->id;
                $piv->novedad_concepto_id = $ncid;
            }
            $piv->activo = 1;
            if (!$piv->save()) {
                throw new \RuntimeException('No se pudo guardar pivote concepto.');
            }

            for ($d = 1; $d <= 7; $d++) {
                $raw = $matrix[$ncid][$d] ?? $matrix[$ncid][(string) $d] ?? 0;
                $h = round((float) $raw, 2);

                $dia = PresupuestoConceptoDia::find()
                    ->where(['presupuesto_concepto_id' => $piv->id, 'dia_semana' => $d])
                    ->one();

                if ($dia === null) {
                    $dia = new PresupuestoConceptoDia();
                    $dia->presupuesto_concepto_id = $piv->id;
                    $dia->dia_semana = $d;
                }
                $dia->horas_maximas = (string) $h;
                $dia->activo = 1;
                if (!$dia->save()) {
                    throw new \RuntimeException('No se pudo guardar detalle día.');
                }
            }
        }
    }

    public function submit(Presupuesto $p): bool
    {
        $this->assertPresupuestoAccess($p, true);
        if (!$p->isEditable()) {
            throw new BadRequestHttpException('No se puede enviar este estado.');
        }

        $p->refresh();
        $errs = $this->validatePresupuestoParaEnviar($p);
        if ($errs) {
            throw new BadRequestHttpException(implode(' ', $errs));
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            $prev = $p->estado;
            $p->estado = Presupuesto::ESTADO_PENDIENTE_APROBACION;
            if (!$p->save(false)) {
                $tx->rollBack();
                return false;
            }
            PresupuestoHistorial::registrar($p, PresupuestoHistorial::ACCION_SUBMIT, $prev, $p->estado, null);
            $tx->commit();
            return true;
        } catch (\Throwable $e) {
            $tx->rollBack();
            throw $e;
        }
    }

    public function approve(Presupuesto $p, ?string $comentario = null): bool
    {
        $this->assertPresupuestoAccess($p, true);
        if ($p->estado !== Presupuesto::ESTADO_PENDIENTE_APROBACION) {
            throw new BadRequestHttpException('Solo se aprueba en estado pendiente.');
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            $reemplazados = $this->findOverlappingApproved($p);
            foreach ($reemplazados as $viejo) {
                $ea = $viejo->estado;
                $viejo->estado = Presupuesto::ESTADO_INACTIVO;
                $viejo->activo = 0;
                $viejo->save(false);
                PresupuestoHistorial::registrar(
                    $viejo,
                    PresupuestoHistorial::ACCION_REPLACE_PREVIOUS,
                    $ea,
                    $viejo->estado,
                    'Reemplazado por aprobación de presupuesto #' . $p->id
                );
            }

            $prev = $p->estado;
            $p->estado = Presupuesto::ESTADO_APROBADO;
            $p->aprobado_por = Yii::$app->user->id;
            $p->aprobado_at = date('Y-m-d H:i:s');
            $p->rechazado_por = null;
            $p->rechazado_at = null;
            if (!$p->save(false)) {
                $tx->rollBack();
                return false;
            }
            PresupuestoHistorial::registrar($p, PresupuestoHistorial::ACCION_APPROVE, $prev, $p->estado, $comentario);

            $tx->commit();
            return true;
        } catch (\Throwable $e) {
            $tx->rollBack();
            throw $e;
        }
    }

    public function reject(Presupuesto $p, string $comentario): bool
    {
        $this->assertPresupuestoAccess($p, true);
        if ($p->estado !== Presupuesto::ESTADO_PENDIENTE_APROBACION) {
            throw new BadRequestHttpException('Solo se rechaza en estado pendiente.');
        }
        $comentario = trim($comentario);
        if ($comentario === '') {
            throw new BadRequestHttpException('El comentario de rechazo es obligatorio.');
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            $prev = $p->estado;
            $p->estado = Presupuesto::ESTADO_RECHAZADO;
            $p->rechazado_por = Yii::$app->user->id;
            $p->rechazado_at = date('Y-m-d H:i:s');
            if (!$p->save(false)) {
                $tx->rollBack();
                return false;
            }
            PresupuestoHistorial::registrar($p, PresupuestoHistorial::ACCION_REJECT, $prev, $p->estado, $comentario);
            $tx->commit();
            return true;
        } catch (\Throwable $e) {
            $tx->rollBack();
            throw $e;
        }
    }

    public function reopen(Presupuesto $p): bool
    {
        $this->assertPresupuestoAccess($p, true);
        if ($p->estado !== Presupuesto::ESTADO_RECHAZADO) {
            throw new BadRequestHttpException('Solo se reabre desde rechazado.');
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            $prev = $p->estado;
            $p->estado = Presupuesto::ESTADO_BORRADOR;
            if (!$p->save(false)) {
                $tx->rollBack();
                return false;
            }
            PresupuestoHistorial::registrar($p, PresupuestoHistorial::ACCION_REOPEN, $prev, $p->estado, null);
            $tx->commit();
            return true;
        } catch (\Throwable $e) {
            $tx->rollBack();
            throw $e;
        }
    }

    public function cancel(Presupuesto $p, ?string $comentario = null): bool
    {
        $this->assertPresupuestoAccess($p, true);
        if (in_array($p->estado, [Presupuesto::ESTADO_INACTIVO], true)) {
            throw new BadRequestHttpException('Ya está inactivo.');
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            $prev = $p->estado;
            $p->estado = Presupuesto::ESTADO_INACTIVO;
            $p->activo = 0;
            if (!$p->save(false)) {
                $tx->rollBack();
                return false;
            }
            PresupuestoHistorial::registrar($p, PresupuestoHistorial::ACCION_CANCEL, $prev, $p->estado, $comentario);
            $tx->commit();
            return true;
        } catch (\Throwable $e) {
            $tx->rollBack();
            throw $e;
        }
    }

    public function clonePresupuesto(Presupuesto $origen): Presupuesto
    {
        $this->assertPresupuestoAccess($origen, false);

        $tx = Yii::$app->db->beginTransaction();
        try {
            $n = new Presupuesto();
            $n->empresa_id = $origen->empresa_id;
            $n->empresa_cliente_id = $origen->empresa_cliente_id;
            $n->location_sede_id = $origen->location_sede_id;
            $n->nombre = $origen->nombre . ' (copia)';
            $n->fecha_inicio_vigencia = $origen->fecha_inicio_vigencia;
            $n->fecha_fin_vigencia = $origen->fecha_fin_vigencia;
            $n->estado = Presupuesto::ESTADO_BORRADOR;
            $n->version = (int) $origen->version + 1;
            $n->observacion = $origen->observacion;
            $n->activo = 1;
            if (!$n->save()) {
                $tx->rollBack();
                throw new \RuntimeException('No se pudo clonar cabecera.');
            }

            foreach ($origen->getPresupuestoConceptos()->with(['dias'])->all() as $pc) {
                $np = new PresupuestoConcepto();
                $np->presupuesto_id = $n->id;
                $np->novedad_concepto_id = $pc->novedad_concepto_id;
                $np->observacion = $pc->observacion;
                $np->activo = 1;
                $np->save(false);

                foreach ($pc->dias as $dia) {
                    $nd = new PresupuestoConceptoDia();
                    $nd->presupuesto_concepto_id = $np->id;
                    $nd->dia_semana = $dia->dia_semana;
                    $nd->horas_maximas = $dia->horas_maximas;
                    $nd->activo = 1;
                    $nd->save(false);
                }
            }

            PresupuestoHistorial::registrar($n, PresupuestoHistorial::ACCION_CLONE, null, $n->estado, 'Clonado desde #' . $origen->id);

            $tx->commit();
            return $n;
        } catch (\Throwable $e) {
            $tx->rollBack();
            throw $e;
        }
    }

    /**
     * @return Presupuesto[]
     */
    public function findOverlappingApproved(Presupuesto $p): array
    {
        $ecNull = $p->empresa_cliente_id === null || $p->empresa_cliente_id === '';

        $q = Presupuesto::find()->alias('o')
            ->where(['and',
                ['!=', 'o.id', $p->id],
                ['o.empresa_id' => $p->empresa_id],
                ['o.location_sede_id' => $p->location_sede_id],
                ['o.estado' => Presupuesto::ESTADO_APROBADO],
                ['o.activo' => 1],
            ])
            ->andWhere(['<=', 'o.fecha_inicio_vigencia', $p->fecha_fin_vigencia])
            ->andWhere(['>=', 'o.fecha_fin_vigencia', $p->fecha_inicio_vigencia]);

        if ($ecNull) {
            $q->andWhere(['o.empresa_cliente_id' => null]);
        } else {
            $q->andWhere(['o.empresa_cliente_id' => (int) $p->empresa_cliente_id]);
        }

        return $q->all();
    }
}
