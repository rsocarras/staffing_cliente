<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Profile;

/**
 * ProfileSearch represents the model behind the search form of `app\models\Profile`.
 */
class ProfileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'empresas_id', 'sede_id', 'cargo_id', 'centro_costo_id', 'centro_utilidad_id', 'area_id'], 'integer'],
            [['tipo_doc', 'num_doc', 'name', 'public_email', 'gravatar_email', 'gravatar_id', 'location', 'timezone', 'bio', 'sexo', 'about', 'estado', 'telefono', 'birthday', 'position', 'photo_', 'instagram', 'tiktok', 'linkedin', 'youtube', 'website', 'address', 'data_json', 'city'], 'safe'],
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
        $query = Profile::find();

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
            'user_id' => $this->user_id,
            'empresas_id' => $this->empresas_id,
            'birthday' => $this->birthday,
            'sede_id' => $this->sede_id,
            'cargo_id' => $this->cargo_id,
            'centro_costo_id' => $this->centro_costo_id,
            'centro_utilidad_id' => $this->centro_utilidad_id,
            'area_id' => $this->area_id,
        ]);

        $query->andFilterWhere(['like', 'tipo_doc', $this->tipo_doc])
            ->andFilterWhere(['like', 'num_doc', $this->num_doc])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'public_email', $this->public_email])
            ->andFilterWhere(['like', 'gravatar_email', $this->gravatar_email])
            ->andFilterWhere(['like', 'gravatar_id', $this->gravatar_id])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'timezone', $this->timezone])
            ->andFilterWhere(['like', 'bio', $this->bio])
            ->andFilterWhere(['like', 'sexo', $this->sexo])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'photo_', $this->photo_])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'tiktok', $this->tiktok])
            ->andFilterWhere(['like', 'linkedin', $this->linkedin])
            ->andFilterWhere(['like', 'youtube', $this->youtube])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'data_json', $this->data_json])
            ->andFilterWhere(['like', 'city', $this->city]);

        return $dataProvider;
    }
}
