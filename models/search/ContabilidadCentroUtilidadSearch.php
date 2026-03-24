<?php

namespace app\models\search;

use app\components\TenantContext;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ContabilidadCentroUtilidad;

/**
 * ContabilidadCentroUtilidadSearch represents the model behind the search form of `app\models\ContabilidadCentroUtilidad`.
 */
class ContabilidadCentroUtilidadSearch extends ContabilidadCentroUtilidad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'activo'], 'integer'],
            [['codigo', 'nombre', 'created_at', 'updated_at'], 'safe'],
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
        $query = ContabilidadCentroUtilidad::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            TenantContext::applyFilter($query, 'empresa_id');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'activo' => $this->activo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nombre', $this->nombre]);

        TenantContext::applyFilter($query, 'empresa_id');

        return $dataProvider;
    }
}
