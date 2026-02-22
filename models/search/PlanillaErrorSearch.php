<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlanillaError;

/**
 * PlanillaErrorSearch represents the model behind the search form of `app\models\PlanillaError`.
 */
class PlanillaErrorSearch extends PlanillaError
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'import_id', 'row_number'], 'integer'],
            [['col_name', 'error_code', 'message', 'raw_value', 'created_at'], 'safe'],
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
        $query = PlanillaError::find();

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
            'import_id' => $this->import_id,
            'row_number' => $this->row_number,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'col_name', $this->col_name])
            ->andFilterWhere(['like', 'error_code', $this->error_code])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'raw_value', $this->raw_value]);

        return $dataProvider;
    }
}
