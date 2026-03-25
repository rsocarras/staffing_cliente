<?php

namespace app\models\search;

use app\components\TenantContext;
use app\models\Contrato;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

class ContratoSearch extends Contrato
{
    public $region_id;
    public $city_id;
    public $tipo_sede;
    public $texto;
    public $vigente;

    public function rules()
    {
        return [
            [['id', 'empresa_id', 'profile_id', 'contrato_tipo_id', 'area_id', 'sub_area_id', 'cargo_id', 'sede_id', 'region_id', 'city_id', 'vigente'], 'integer'],
            [['estado', 'tipo_sede', 'texto', 'fecha_inicio', 'fecha_fin', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, ?ActiveQuery $query = null)
    {
        $query = $query ?: Contrato::find()->alias('contrato');
        $query->distinct();
        $query->joinWith([
            'profile profile',
            'profile.user user',
            'contratoTipo tipo',
            'sede sede',
            'sede.city city',
            'sede.city.region region',
            'area area',
            'subArea subArea',
            'cargo cargo',
        ]);
        $query->with(['contratoDistribucionSedes', 'profile.user', 'contratoTipo', 'sede', 'area', 'subArea', 'cargo']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['updated_at' => SORT_DESC, 'id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['contrato.id' => SORT_ASC],
                        'desc' => ['contrato.id' => SORT_DESC],
                    ],
                    'estado' => [
                        'asc' => ['contrato.estado' => SORT_ASC],
                        'desc' => ['contrato.estado' => SORT_DESC],
                    ],
                    'fecha_inicio' => [
                        'asc' => ['contrato.fecha_inicio' => SORT_ASC],
                        'desc' => ['contrato.fecha_inicio' => SORT_DESC],
                    ],
                    'fecha_fin' => [
                        'asc' => ['contrato.fecha_fin' => SORT_ASC],
                        'desc' => ['contrato.fecha_fin' => SORT_DESC],
                    ],
                    'updated_at' => [
                        'asc' => ['contrato.updated_at' => SORT_ASC],
                        'desc' => ['contrato.updated_at' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            TenantContext::applyFilter($query, 'contrato.empresa_id');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'contrato.id' => $this->id,
            'contrato.profile_id' => $this->profile_id,
            'contrato.contrato_tipo_id' => $this->contrato_tipo_id,
            'contrato.area_id' => $this->area_id,
            'contrato.sub_area_id' => $this->sub_area_id,
            'contrato.cargo_id' => $this->cargo_id,
            'contrato.sede_id' => $this->sede_id,
            'region.id' => $this->region_id,
            'city.id' => $this->city_id,
        ]);

        $query->andFilterWhere(['contrato.estado' => $this->estado]);
        $query->andFilterWhere(['sede.tipo_sede' => $this->tipo_sede]);

        if ($this->vigente !== null && $this->vigente !== '') {
            $today = date('Y-m-d');
            if ((int) $this->vigente === 1) {
                $query->andWhere(['<=', 'contrato.fecha_inicio', $today])
                    ->andWhere([
                        'or',
                        ['contrato.fecha_fin' => null],
                        ['>=', 'contrato.fecha_fin', $today],
                    ]);
            } else {
                $query->andWhere([
                    'or',
                    ['>', 'contrato.fecha_inicio', $today],
                    ['<', 'contrato.fecha_fin', $today],
                ]);
            }
        }

        if (!empty($this->texto)) {
            $query->andWhere([
                'or',
                ['like', 'profile.name', $this->texto],
                ['like', 'user.username', $this->texto],
                ['like', 'cargo.nombre', $this->texto],
                ['like', 'sede.nombre', $this->texto],
                ['like', 'tipo.nombre', $this->texto],
            ]);
        }

        TenantContext::applyFilter($query, 'contrato.empresa_id');

        return $dataProvider;
    }
}
