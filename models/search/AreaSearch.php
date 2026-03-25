<?php

namespace app\models\search;

use app\components\TenantContext;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Area;

/**
 * AreaSearch represents the model behind the search form of `app\models\Area`.
 */
class AreaSearch extends Area
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_create', 'area_padre', 'empresas_id', 'centro_utilidad', 'referencia_externa', 'centro_utilidad_staffing'], 'integer'],
            [['uuid', 'nombre', 'descripcion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Area::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            TenantContext::applyFilter($query, 'empresas_id');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_create' => $this->user_create,
            'area_padre' => $this->area_padre,
            'centro_utilidad' => $this->centro_utilidad,
            'referencia_externa' => $this->referencia_externa,
            'centro_utilidad_staffing' => $this->centro_utilidad_staffing,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion]);

        TenantContext::applyFilter($query, 'empresas_id');

        return $dataProvider;
    }
}
