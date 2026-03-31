<?php

declare(strict_types=1);

namespace app\services;

use app\models\Contrato;
use app\models\EmpresaNovedadConcepto;
use app\models\NovedadConceptoCargo;
use app\models\Profile;
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

    public static function gerenteSedePuedeParaEmpleado(int $gerenteUserId, int $empleadoProfileUserId): bool
    {
        $roles = Yii::$app->authManager->getRolesByUser($gerenteUserId);
        if (!isset($roles['gerente_sede'])) {
            return true;
        }
        $gerente = Profile::findOne(['user_id' => $gerenteUserId]);
        $empleado = Profile::findOne(['user_id' => $empleadoProfileUserId]);
        if ($gerente === null || $empleado === null) {
            return false;
        }
        if ($gerente->location_sede_id === null || $empleado->location_sede_id === null) {
            return false;
        }

        return (int) $gerente->location_sede_id === (int) $empleado->location_sede_id;
    }
}
