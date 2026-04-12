<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Cargos;
use app\models\EmpresaNovedadConcepto;
use app\models\NovedadConcepto;
use app\models\NovedadConceptoCargo;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NovedadConceptoEmpresaController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'view' => ['GET', 'POST'],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $empresaId = TenantContext::requireEmpresaId();

        $rows = EmpresaNovedadConcepto::find()
            ->alias('enc')
            ->innerJoinWith(['novedadConcepto nc'])
            ->leftJoin('novedad_tipo nt', 'nt.id = nc.novedad_tipo_id')
            ->where(['enc.empresa_id' => $empresaId])
            ->orderBy([
                'nt.nombre' => SORT_ASC,
                'nc.nombre' => SORT_ASC,
            ])
            ->all();

        $agrupados = [];
        foreach ($rows as $row) {
            $concepto = $row->novedadConcepto;
            if ($concepto === null) {
                continue;
            }
            $grupo = $concepto->novedadTipo ? (string) $concepto->novedadTipo->nombre : Yii::t('app', 'Sin agrupador');
            if (!isset($agrupados[$grupo])) {
                $agrupados[$grupo] = [];
            }
            $agrupados[$grupo][] = $concepto;
        }

        ksort($agrupados, SORT_NATURAL | SORT_FLAG_CASE);

        return $this->render('index', [
            'agrupados' => $agrupados,
        ]);
    }

    public function actionView($id)
    {
        $empresaId = TenantContext::requireEmpresaId();
        $concepto = $this->findConceptoEmpresa((int) $id, $empresaId);

        $cargos = Cargos::find()
            ->where(['empresa_id' => $empresaId])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        if (Yii::$app->request->isPost) {
            $selectedCargoIds = Yii::$app->request->post('cargo_ids', []);
            if (!is_array($selectedCargoIds)) {
                $selectedCargoIds = [];
            }
            $selectedCargoIds = array_values(array_unique(array_filter(array_map('intval', $selectedCargoIds), static fn ($v) => $v > 0)));

            $cargosPermitidos = Cargos::find()
                ->select('id')
                ->where(['empresa_id' => $empresaId, 'id' => $selectedCargoIds])
                ->column();
            $cargosPermitidos = array_map('intval', $cargosPermitidos);

            $tx = Yii::$app->db->beginTransaction();
            try {
                $subQuery = (new Query())
                    ->select('id')
                    ->from(Cargos::tableName())
                    ->where(['empresa_id' => $empresaId]);

                NovedadConceptoCargo::deleteAll([
                    'and',
                    ['novedad_concepto_id' => $concepto->id],
                    ['in', 'cargo_id', $subQuery],
                ]);

                foreach ($cargosPermitidos as $cargoId) {
                    Yii::$app->db->createCommand()->insert(NovedadConceptoCargo::tableName(), [
                        'novedad_concepto_id' => (int) $concepto->id,
                        'cargo_id' => (int) $cargoId,
                    ])->execute();
                }

                if ($this->conceptoPermiteValorPorDefecto($concepto)) {
                    $enc = EmpresaNovedadConcepto::findOne([
                        'empresa_id' => $empresaId,
                        'novedad_concepto_id' => (int) $concepto->id,
                    ]);
                    if ($enc !== null) {
                        $raw = Yii::$app->request->post('valor_por_defecto');
                        $valorDef = $this->normalizarMontoNullable($raw);
                        $enc->valor_por_defecto = $valorDef;
                        if (!$enc->save(false, ['valor_por_defecto'])) {
                            throw new \RuntimeException('valor_por_defecto');
                        }
                    }
                }

                $tx->commit();
                Yii::$app->session->setFlash('success', Yii::t('app', 'Cambios guardados correctamente.'));

                return $this->redirect(['view', 'id' => $concepto->id]);
            } catch (\Throwable $e) {
                $tx->rollBack();
                Yii::error($e->getMessage(), __METHOD__);
                Yii::$app->session->setFlash('error', Yii::t('app', 'No fue posible guardar la asignación de cargos.'));
            }
        }

        $asignados = NovedadConceptoCargo::find()
            ->alias('ncc')
            ->innerJoin('cargos c', 'c.id = ncc.cargo_id')
            ->where([
                'ncc.novedad_concepto_id' => $concepto->id,
                'c.empresa_id' => $empresaId,
            ])
            ->select('ncc.cargo_id')
            ->column();
        $asignados = array_map('intval', $asignados);

        $permiteValorDefecto = $this->conceptoPermiteValorPorDefecto($concepto);
        $valorPorDefecto = '';
        if ($permiteValorDefecto) {
            $enc = EmpresaNovedadConcepto::findOne([
                'empresa_id' => $empresaId,
                'novedad_concepto_id' => (int) $concepto->id,
            ]);
            if ($enc !== null && $enc->valor_por_defecto !== null && (string) $enc->valor_por_defecto !== '') {
                $valorPorDefecto = (string) (float) $enc->valor_por_defecto;
            }
        }

        return $this->render('view', [
            'model' => $concepto,
            'cargos' => $cargos,
            'asignados' => $asignados,
            'permiteValorDefecto' => $permiteValorDefecto,
            'valorPorDefecto' => $valorPorDefecto,
        ]);
    }

    private function findConceptoEmpresa(int $id, int $empresaId): NovedadConcepto
    {
        $model = NovedadConcepto::find()
            ->alias('nc')
            ->innerJoin(EmpresaNovedadConcepto::tableName() . ' enc', 'enc.novedad_concepto_id = nc.id')
            ->where([
                'nc.id' => $id,
                'enc.empresa_id' => $empresaId,
            ])
            ->with(['novedadTipo'])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'El concepto solicitado no existe para la empresa actual.'));
    }

    /**
     * Misma regla que en staffing_admin: PE_* (pagos extralegales) y PP_* (pagos prestacionales).
     */
    private function conceptoPermiteValorPorDefecto(NovedadConcepto $c): bool
    {
        $tipo = $c->novedadTipo;
        if ($tipo === null) {
            return false;
        }
        $codigoTipo = strtolower(trim((string) ($tipo->codigo ?? '')));
        $nombreTipo = strtolower(trim((string) ($tipo->nombre ?? '')));
        $codigoConcepto = strtoupper(trim((string) ($c->codigo ?? '')));
        if ($codigoConcepto === '') {
            return false;
        }
        if ($codigoTipo === 'pagos_extralegales' || $nombreTipo === 'pagos extralegales') {
            return str_starts_with($codigoConcepto, 'PE_');
        }
        if ($codigoTipo === 'pagos_prestacionales' || $nombreTipo === 'pagos prestacionales') {
            return str_starts_with($codigoConcepto, 'PP_');
        }

        return false;
    }

    /**
     * Normaliza montos con formato local (p. ej. 1.234,56 o 1,234.56) a decimal.
     */
    private function normalizarMontoNullable(mixed $raw): ?float
    {
        if (!is_scalar($raw)) {
            return null;
        }
        $s = trim((string) $raw);
        if ($s === '') {
            return null;
        }

        $s = str_replace([' ', "\u{00A0}"], '', $s);
        $hasDot = str_contains($s, '.');
        $hasComma = str_contains($s, ',');

        if ($hasDot && $hasComma) {
            $lastDot = strrpos($s, '.');
            $lastComma = strrpos($s, ',');
            if ($lastComma !== false && $lastDot !== false) {
                if ($lastComma > $lastDot) {
                    // Formato 1.234,56
                    $s = str_replace('.', '', $s);
                    $s = str_replace(',', '.', $s);
                } else {
                    // Formato 1,234.56
                    $s = str_replace(',', '', $s);
                }
            }
        } elseif ($hasComma && !$hasDot) {
            // Formato 1234,56
            $s = str_replace(',', '.', $s);
        } else {
            // Formato 1234.56 o 1234
            $s = str_replace(',', '', $s);
        }

        if (!is_numeric($s)) {
            return null;
        }

        return round((float) $s, 2);
    }
}
