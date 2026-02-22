<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EmpresaWebhook;

/**
 * EmpresaWebhookSearch represents the model behind the search form of `app\models\EmpresaWebhook`.
 */
class EmpresaWebhookSearch extends EmpresaWebhook
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'activo'], 'integer'],
            [['event_name', 'url', 'secret', 'headers_json', 'created_at'], 'safe'],
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
        $query = EmpresaWebhook::find();

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
            'activo' => $this->activo,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'event_name', $this->event_name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'secret', $this->secret])
            ->andFilterWhere(['like', 'headers_json', $this->headers_json]);

        return $dataProvider;
    }
}
