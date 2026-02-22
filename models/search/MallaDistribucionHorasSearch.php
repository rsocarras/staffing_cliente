<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MallaDistribucionHoras;

/**
 * MallaDistribucionHorasSearch represents the model behind the search form of `app\models\MallaDistribucionHoras`.
 */
class MallaDistribucionHorasSearch extends MallaDistribucionHoras
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'payroll_period_id', 'profile_id', 'sede_id', 'cargo_id', 'centro_costo_id', 'centro_utilidad_id', 'created_by'], 'integer'],
            [['fecha', 'created_at'], 'safe'],
            [['horas'], 'number'],
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
        $query = MallaDistribucionHoras::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'empresa_id' => $this->empresa_id,
            'payroll_period_id' => $this->payroll_period_id,
            'profile_id' => $this->profile_id,
            'sede_id' => $this->sede_id,
            'cargo_id' => $this->cargo_id,
            'centro_costo_id' => $this->centro_costo_id,
            'centro_utilidad_id' => $this->centro_utilidad_id,
            'fecha' => $this->fecha,
            'horas' => $this->horas,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
