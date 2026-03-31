<?php

namespace app\components;

use app\models\Area;
use app\models\Contrato;
use app\models\ContratoTipos;
use app\models\LocationSedes;
use app\services\AdministracionPlantaService;
use Yii;

/**
 * Permisos y opciones de formulario para contratos de colaborador (reutilizado en usuarios y empleados).
 */
final class ContratoFormSupport
{
    /**
     * Roles que pueden crear o gestionar contratos desde las fichas de usuario/colaborador.
     */
    public static function currentUserCanManageContratos(): bool
    {
        $roles = ['admin', 'administrator', 'admin_total', 'rrhh', 'rrhh_interno', 'rrhh_cliente', 'operaciones_regionales', 'director_area'];
        foreach ($roles as $r) {
            if (Yii::$app->user->can($r)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array{
     *   contratoTipos: \app\models\ContratoTipos[],
     *   sedes: \app\models\LocationSedes[],
     *   areas: \app\models\Area[],
     *   subAreas: array,
     *   cargos: array,
     *   estados: array
     * }
     */
    public static function buildFormOptions(Contrato $model, AdministracionPlantaService $planta): array
    {
        $eid = (int) $model->empresa_id;
        $tipos = ContratoTipos::find()
            ->where(['or', ['empresa_id' => $eid], ['empresa_id' => null]])
            ->andWhere(['activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();
        $sedes = LocationSedes::find()->where(['empresa_id' => $eid, 'activo' => 1])->orderBy(['nombre' => SORT_ASC])->all();
        $areas = Area::find()->where(['empresas_id' => $eid])->orderBy(['nombre' => SORT_ASC])->all();
        $subAreas = $model->area_id ? $planta->getSubAreaOptions((int) $model->area_id, $eid) : [];
        $cargos = [];
        if ($model->area_id) {
            $cargos = $planta->getCargoOptions(
                $eid,
                (int) $model->area_id,
                $model->sub_area_id ? (int) $model->sub_area_id : null
            );
        }

        return [
            'contratoTipos' => $tipos,
            'sedes' => $sedes,
            'areas' => $areas,
            'subAreas' => $subAreas,
            'cargos' => $cargos,
            'estados' => Contrato::optsEstado(),
        ];
    }
}
