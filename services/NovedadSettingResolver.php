<?php

declare(strict_types=1);

namespace app\services;

use app\models\Empresas;
use app\models\LocationCountry;
use app\models\SettingLaboral;
use Yii;
use yii\base\InvalidArgumentException;

/**
 * Resuelve el registro laboral en `setting` por empresa (país) y año de la fecha de la novedad.
 */
final class NovedadSettingResolver
{
    public static function resolveForEmpresaYFecha(int $empresaId, string $fechaYmd): SettingLaboral
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaYmd)) {
            throw new InvalidArgumentException('fechaYmd inválida');
        }
        $year = (int) substr($fechaYmd, 0, 4);

        $empresa = Empresas::findOne($empresaId);
        $countryId = null;
        if ($empresa !== null && $empresa->location_country_id !== null) {
            $countryId = (int) $empresa->location_country_id;
        }
        if ($countryId === null || $countryId <= 0) {
            $iso = (string) (Yii::$app->params['defaultLocationCountryIso'] ?? 'CO');
            $countryId = (int) LocationCountry::find()->select('id')->where(['iso_alpha2' => $iso])->scalar();
        }
        if ($countryId <= 0) {
            throw new InvalidArgumentException(Yii::t('app', 'No se pudo determinar el país para parámetros laborales.'));
        }

        $setting = SettingLaboral::find()
            ->where(['year' => $year, 'location_country_id' => $countryId])
            ->one();
        if ($setting === null) {
            throw new InvalidArgumentException(
                Yii::t('app', 'No hay parámetros (setting) para el año {y} y el país configurado.', ['y' => $year])
            );
        }

        return $setting;
    }
}
