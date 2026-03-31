<?php

namespace app\models\search;

use app\components\TenantContext;
use app\models\StaffingPlanta;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class StaffingPlantaSearch extends StaffingPlanta
{
    public $region_id;
    public $city_id;
    public $tipo_sede;
    public $texto;

    public function rules()
    {
        return [
            [['id', 'empresa_id', 'location_sede_id', 'area_id', 'sub_area_id', 'cargo_id', 'activo', 'region_id', 'city_id'], 'integer'],
            [['cantidad_autorizada'], 'number'],
            [['tipo_sede', 'texto', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, ?ActiveQuery $query = null)
    {
        $query = $query ?: StaffingPlanta::find()->alias('planta');

        $query->joinWith([
            'locationSede sede',
            'locationSede.city city',
            'locationSede.city.region region',
            'area area',
            'subArea subArea',
            'cargo cargo',
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['updated_at' => SORT_DESC, 'id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['planta.id' => SORT_ASC],
                        'desc' => ['planta.id' => SORT_DESC],
                    ],
                    'activo' => [
                        'asc' => ['planta.activo' => SORT_ASC],
                        'desc' => ['planta.activo' => SORT_DESC],
                    ],
                    'created_at' => [
                        'asc' => ['planta.created_at' => SORT_ASC],
                        'desc' => ['planta.created_at' => SORT_DESC],
                    ],
                    'updated_at' => [
                        'asc' => ['planta.updated_at' => SORT_ASC],
                        'desc' => ['planta.updated_at' => SORT_DESC],
                    ],
                    'tipo_sede' => [
                        'asc' => ['sede.tipo_sede' => SORT_ASC],
                        'desc' => ['sede.tipo_sede' => SORT_DESC],
                    ],
                    'cantidad_autorizada' => [
                        'asc' => ['planta.cantidad_autorizada' => SORT_ASC],
                        'desc' => ['planta.cantidad_autorizada' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            TenantContext::applyFilter($query, 'planta.empresa_id');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'planta.id' => $this->id,
            'planta.location_sede_id' => $this->location_sede_id,
            'planta.area_id' => $this->area_id,
            'planta.sub_area_id' => $this->sub_area_id,
            'planta.cargo_id' => $this->cargo_id,
            'planta.activo' => $this->activo,
            'city.id' => $this->city_id,
            'region.id' => $this->region_id,
        ]);

        $query->andFilterWhere(['sede.tipo_sede' => $this->tipo_sede]);

        if (!empty($this->texto)) {
            $query->andWhere([
                'or',
                ['like', 'sede.nombre', $this->texto],
                ['like', 'cargo.nombre', $this->texto],
                ['like', 'area.nombre', $this->texto],
                ['like', 'subArea.nombre', $this->texto],
            ]);
        }

        TenantContext::applyFilter($query, 'planta.empresa_id');

        return $dataProvider;
    }
}
