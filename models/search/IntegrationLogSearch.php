<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IntegrationLog;

/**
 * IntegrationLogSearch represents the model behind the search form of `app\models\IntegrationLog`.
 */
class IntegrationLogSearch extends IntegrationLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'empresa_integration_id', 'status_code', 'duration_ms'], 'integer'],
            [['request_id', 'endpoint', 'method', 'request_json', 'response_json', 'created_at'], 'safe'],
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
        $query = IntegrationLog::find();

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
            'empresa_integration_id' => $this->empresa_integration_id,
            'status_code' => $this->status_code,
            'duration_ms' => $this->duration_ms,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'request_id', $this->request_id])
            ->andFilterWhere(['like', 'endpoint', $this->endpoint])
            ->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'request_json', $this->request_json])
            ->andFilterWhere(['like', 'response_json', $this->response_json]);

        return $dataProvider;
    }
}
