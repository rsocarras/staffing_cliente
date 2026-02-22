<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfileEventosLog;

/**
 * ProfileEventosLogSearch represents the model behind the search form of `app\models\ProfileEventosLog`.
 */
class ProfileEventosLogSearch extends ProfileEventosLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'profile_id', 'entity_id', 'actor_user_id'], 'integer'],
            [['event_type', 'entity_type', 'before_json', 'after_json', 'contexto_json', 'created_at'], 'safe'],
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
        $query = ProfileEventosLog::find();

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
            'profile_id' => $this->profile_id,
            'entity_id' => $this->entity_id,
            'actor_user_id' => $this->actor_user_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'event_type', $this->event_type])
            ->andFilterWhere(['like', 'entity_type', $this->entity_type])
            ->andFilterWhere(['like', 'before_json', $this->before_json])
            ->andFilterWhere(['like', 'after_json', $this->after_json])
            ->andFilterWhere(['like', 'contexto_json', $this->contexto_json]);

        return $dataProvider;
    }
}
