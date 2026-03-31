<?php

namespace app\components;

use app\models\Area;
use app\models\Cargos;
use app\models\ContabilidadCentroCosto;
use app\models\ContabilidadCentroUtilidad;
use app\models\LocationSedes;
use app\models\Profile;

/**
 * Listas y mapas para formularios de {@see Profile} (sedes, cargos, áreas, etc.).
 */
final class ProfileFormOptionsProvider
{
    /**
     * @return array{
     *   tipoDoc: array,
     *   sexo: array,
     *   estado: array,
     *   sedes: array|\app\models\LocationSedes[],
     *   cargos: array|\app\models\Cargos[],
     *   centrosCosto: array|\app\models\ContabilidadCentroCosto[],
     *   centrosUtilidad: array|\app\models\ContabilidadCentroUtilidad[],
     *   areas: array|\app\models\Area[],
     *   timezones: array<string, string>
     * }
     */
    public static function forEmpresaId(?int $empresaId): array
    {
        $base = [
            'tipoDoc' => Profile::optsTipoDoc(),
            'sexo' => Profile::optsSexo(),
            'estado' => Profile::optsEstado(),
            'sedes' => [],
            'cargos' => [],
            'centrosCosto' => [],
            'centrosUtilidad' => [],
            'areas' => [],
            'timezones' => self::timezoneOptions(),
        ];

        if ($empresaId === null) {
            return $base;
        }

        return array_merge($base, [
            'sedes' => LocationSedes::find()->where(['empresa_id' => $empresaId, 'activo' => 1])->orderBy(['nombre' => SORT_ASC])->all(),
            'cargos' => Cargos::find()->where(['empresa_id' => $empresaId, 'activo' => 1])->orderBy(['nombre' => SORT_ASC])->all(),
            'centrosCosto' => ContabilidadCentroCosto::find()->where(['empresa_id' => $empresaId, 'activo' => 1])->orderBy(['nombre' => SORT_ASC])->all(),
            'centrosUtilidad' => ContabilidadCentroUtilidad::find()->where(['empresa_id' => $empresaId, 'activo' => 1])->orderBy(['nombre' => SORT_ASC])->all(),
            'areas' => Area::find()->where(['empresas_id' => $empresaId])->orderBy(['nombre' => SORT_ASC])->all(),
        ]);
    }

    /**
     * Zonas horarias (América + UTC) para select en formularios de perfil.
     *
     * @return array<string, string> id => etiqueta legible
     */
    public static function timezoneOptions(): array
    {
        $out = ['UTC' => 'UTC'];
        foreach (timezone_identifiers_list(\DateTimeZone::AMERICA) as $id) {
            $out[$id] = str_replace('_', ' ', $id);
        }
        ksort($out);

        return $out;
    }
}
