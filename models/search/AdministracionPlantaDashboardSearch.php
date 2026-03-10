<?php

namespace app\models\search;

use app\services\AdministracionPlantaService;
use yii\base\Model;

class AdministracionPlantaDashboardSearch extends Model
{
    public $empresa_id;
    public $region_id;
    public $city_id;
    public $sede_id;
    public $tipo_sede;
    public $area_id;
    public $sub_area_id;
    public $cargo_id;
    public $texto;
    public $solo_vacantes = 0;
    public $solo_sobredotacion = 0;
    public $estado_cobertura;
    public $modo_ocupacion = AdministracionPlantaService::MODO_PONDERADO;
    public $planta_activa = 1;

    public function rules()
    {
        return [
            [['empresa_id', 'region_id', 'city_id', 'sede_id', 'area_id', 'sub_area_id', 'cargo_id', 'solo_vacantes', 'solo_sobredotacion', 'planta_activa'], 'integer'],
            [['tipo_sede', 'texto', 'estado_cobertura'], 'safe'],
            [['modo_ocupacion'], 'in', 'range' => [
                AdministracionPlantaService::MODO_PONDERADO,
                AdministracionPlantaService::MODO_ENTERO,
            ]],
            [['tipo_sede'], 'in', 'range' => ['', 'operativa', 'administrativa']],
            [['estado_cobertura'], 'in', 'range' => ['', 'alta', 'media', 'baja']],
        ];
    }

    public function formName()
    {
        return 'FiltroPlanta';
    }

    public function getModoLabel()
    {
        return $this->modo_ocupacion === AdministracionPlantaService::MODO_ENTERO
            ? 'Conteo entero'
            : 'Conteo ponderado';
    }
}
