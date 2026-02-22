<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfileSalarios;

/**
 * ProfileSalariosSearch represents the model behind the search form of `app\models\ProfileSalarios`.
 */
class ProfileSalariosSearch extends ProfileSalarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'profile_id', 'actor_user_id'], 'integer'],
            [['fecha_efectiva', 'moneda', 'motivo', 'created_at'], 'safe'],
            [['salario_base'], 'number'],
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
        $query = ProfileSalarios::find();

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
            'fecha_efectiva' => $this->fecha_efectiva,
            'salario_base' => $this->salario_base,
            'actor_user_id' => $this->actor_user_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'moneda', $this->moneda])
            ->andFilterWhere(['like', 'motivo', $this->motivo]);

        return $dataProvider;
    }
}
