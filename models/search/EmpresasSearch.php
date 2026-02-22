<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empresas;

/**
 * EmpresasSearch represents the model behind the search form of `app\models\Empresas`.
 */
class EmpresasSearch extends Empresas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entity', 'status', 'supplier_only', 'user_owner'], 'integer'],
            [['name', 'social_name', 'ref_int', 'ref_ext', 'tms', 'datec', 'dateu', 'code', 'address', 'url', 'twitter', 'instagram', 'phone_1', 'phone_2', 'email', 'description_s', 'description_l', 'idu', 'slug'], 'safe'],
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
        $query = Empresas::find();

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
            'entity' => $this->entity,
            'status' => $this->status,
            'tms' => $this->tms,
            'datec' => $this->datec,
            'dateu' => $this->dateu,
            'supplier_only' => $this->supplier_only,
            'user_owner' => $this->user_owner,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'social_name', $this->social_name])
            ->andFilterWhere(['like', 'ref_int', $this->ref_int])
            ->andFilterWhere(['like', 'ref_ext', $this->ref_ext])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'phone_1', $this->phone_1])
            ->andFilterWhere(['like', 'phone_2', $this->phone_2])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'description_s', $this->description_s])
            ->andFilterWhere(['like', 'description_l', $this->description_l])
            ->andFilterWhere(['like', 'idu', $this->idu])
            ->andFilterWhere(['like', 'slug', $this->slug]);

        return $dataProvider;
    }
}
