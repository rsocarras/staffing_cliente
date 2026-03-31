<?php

declare(strict_types=1);

namespace app\services;

use Yii;

/**
 * Importe fijo del auxilio de movilización para solicitudes tipo Horas (checkbox).
 */
final class NovedadAuxilioMovilizacionResolver
{
    public const PARAM_IMPORTE = 'novedad_auxilio_movilizacion_importe';

    /**
     * Monto en COP a registrar en {@see \app\models\Novedad::$importe}, o null si no está configurado.
     *
     * @param int|null $empresaId reservado para futura lógica por tenant
     */
    public static function importePredeterminado(?int $empresaId = null): ?float
    {
        unset($empresaId);
        $raw = Yii::$app->params[self::PARAM_IMPORTE] ?? null;
        if ($raw === null || $raw === '') {
            return null;
        }
        if (!is_numeric($raw)) {
            return null;
        }
        $f = round((float) $raw, 2);

        return $f >= 0.01 ? $f : null;
    }

    /**
     * @deprecated Usar {@see importePredeterminado}; mantiene compatibilidad (0 si no hay valor válido).
     */
    public static function importe(): float
    {
        $v = self::importePredeterminado();

        return $v !== null ? $v : 0.0;
    }
}
