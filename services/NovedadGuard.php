<?php

declare(strict_types=1);

namespace app\services;

use app\models\Contrato;
use app\models\EmpresaNovedadConcepto;
use app\models\NovedadConceptoCargo;
use app\models\Profile;
use app\models\ProfileSede;
use Yii;

/**
 * Reglas de negocio: whitelist tenant, aplicabilidad por cargo (contrato activo), gerente de sede.
 */
final class NovedadGuard
{
    public static function conceptoHabilitadoParaEmpresa(int $empresaId, int $conceptoId): bool
    {
        return EmpresaNovedadConcepto::find()
            ->where(['empresa_id' => $empresaId, 'novedad_concepto_id' => $conceptoId])
            ->exists();
    }

    /** Sin filas en novedad_concepto_cargo → el concepto no se puede usar en solicitudes. */
    public static function conceptoTieneCargosAplicabilidad(int $conceptoId): bool
    {
        return NovedadConceptoCargo::find()->where(['novedad_concepto_id' => $conceptoId])->exists();
    }

    /**
     * Contrato en estado activo del empleado (profile.user_id) en el tenant, más reciente por fecha_inicio.
     */
    public static function contratoActivoEnEmpresa(int $empresaId, int $profileUserId): ?Contrato
    {
        return Contrato::find()
            ->where([
                'empresa_id' => $empresaId,
                'profile_id' => $profileUserId,
                'estado' => Contrato::ESTADO_ACTIVO,
            ])
            ->orderBy(['fecha_inicio' => SORT_DESC, 'id' => SORT_DESC])
            ->one();
    }

    /**
     * Contrato que “ocupa planta” a una fecha (activo, suspendido, licencia, incapacidad), misma lógica que {@see Contrato::findOccupyingAt}.
     */
    public static function contratoOcupaPlantaALaFecha(int $empresaId, int $profileUserId, string $fechaYmd): ?Contrato
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaYmd)) {
            return null;
        }

        return Contrato::findOccupyingAt($fechaYmd)
            ->andWhere([
                'contrato.profile_id' => $profileUserId,
                'contrato.empresa_id' => $empresaId,
            ])
            ->orderBy(['contrato.fecha_inicio' => SORT_DESC, 'contrato.id' => SORT_DESC])
            ->one();
    }

    /**
     * El cargo del contrato vigente a la fecha (o del activo si no hay fecha) debe estar en {@see NovedadConceptoCargo}.
     *
     * @param string|null $fechaYmd Y-m-d; si es null se usa solo contrato estrictamente activo.
     */
    public static function empleadoContratoYCargoCumplenConcepto(
        int $empresaId,
        int $profileUserId,
        int $conceptoId,
        ?string $fechaYmd = null
    ): bool {
        $contrato = ($fechaYmd !== null && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaYmd))
            ? self::contratoOcupaPlantaALaFecha($empresaId, $profileUserId, $fechaYmd)
            : self::contratoActivoEnEmpresa($empresaId, $profileUserId);
        if ($contrato === null) {
            return false;
        }
        $cargoId = (int) $contrato->cargo_id;

        return NovedadConceptoCargo::find()
            ->where(['novedad_concepto_id' => $conceptoId, 'cargo_id' => $cargoId])
            ->exists();
    }

    /**
     * Regla `gerente_sede`: el empleado objetivo debe estar en una sede que el gerente puede gestionar
     * (tabla {@see ProfileSede} y/o `profile.location_sede_id` legado), o bien ambos deben tener contrato
     * en la misma empresa y la misma sede (`contrato.sede_id`) a la fecha indicada o en estado activo.
     *
     * @param string|null $fechaYmd Fecha de la novedad (Y-m-d); si es inválida o null se usa solo contrato estrictamente activo.
     */
    public static function gerenteSedePuedeParaEmpleado(
        int $gerenteUserId,
        int $empleadoProfileUserId,
        int $empresaId,
        ?string $fechaYmd = null
    ): bool {
        $roles = Yii::$app->authManager->getRolesByUser($gerenteUserId);
        if (!isset($roles['gerente_sede'])) {
            return true;
        }
        if ($empresaId <= 0 || $empleadoProfileUserId <= 0) {
            return false;
        }
        $gerente = Profile::findOne(['user_id' => $gerenteUserId]);
        $empleado = Profile::findOne(['user_id' => $empleadoProfileUserId]);
        if ($gerente === null || $empleado === null) {
            return false;
        }

        $empleadoSedeId = self::sedeEmpleadoParaReglaGerente($empresaId, $empleadoProfileUserId, $empleado, $fechaYmd);
        if ($empleadoSedeId === null || $empleadoSedeId <= 0) {
            return false;
        }

        $sedesGerente = ProfileSede::locationSedeIdsForProfileModel($gerente);
        if ($sedesGerente === [] && $gerente->location_sede_id !== null && (int) $gerente->location_sede_id > 0) {
            $sedesGerente = [(int) $gerente->location_sede_id];
        }
        if ($sedesGerente !== [] && in_array($empleadoSedeId, $sedesGerente, true)) {
            return true;
        }

        $cGerente = self::contratoParaReglaSedeGerente($empresaId, $gerenteUserId, $fechaYmd);
        $cEmpleado = self::contratoParaReglaSedeGerente($empresaId, $empleadoProfileUserId, $fechaYmd);
        if (
            $cGerente !== null && $cEmpleado !== null
            && $cGerente->sede_id !== null && $cEmpleado->sede_id !== null
            && (int) $cGerente->sede_id === (int) $cEmpleado->sede_id
        ) {
            return true;
        }

        return false;
    }

    /**
     * Sede del empleado para la regla: prioriza `contrato.sede_id` vigente; si no hay, `profile.location_sede_id`.
     *
     * @return int|null ID en {@see \app\models\LocationSedes}
     */
    private static function sedeEmpleadoParaReglaGerente(
        int $empresaId,
        int $empleadoProfileUserId,
        Profile $empleado,
        ?string $fechaYmd
    ): ?int {
        $c = self::contratoParaReglaSedeGerente($empresaId, $empleadoProfileUserId, $fechaYmd);
        if ($c !== null && $c->sede_id !== null && (int) $c->sede_id > 0) {
            return (int) $c->sede_id;
        }
        if ($empleado->location_sede_id !== null && (int) $empleado->location_sede_id > 0) {
            return (int) $empleado->location_sede_id;
        }

        return null;
    }

    private static function contratoParaReglaSedeGerente(int $empresaId, int $profileUserId, ?string $fechaYmd): ?Contrato
    {
        $fechaOk = $fechaYmd !== null && preg_match('/^\d{4}-\d{2}-\d{2}$/', (string) $fechaYmd);

        return $fechaOk
            ? self::contratoOcupaPlantaALaFecha($empresaId, $profileUserId, (string) $fechaYmd)
            : self::contratoActivoEnEmpresa($empresaId, $profileUserId);
    }
}
