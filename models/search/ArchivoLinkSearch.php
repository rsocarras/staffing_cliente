<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ArchivoLink;

/**
 * ArchivoLinkSearch represents the model behind the search form of `app\models\ArchivoLink`.
 */
class ArchivoLinkSearch extends ArchivoLink
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'archivo_id', 'entidad_id'], 'integer'],
            [['entidad_type', 'etiqueta', 'created_at'], 'safe'],
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
        $query = ArchivoLink::find();

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
            'archivo_id' => $this->archivo_id,
            'entidad_id' => $this->entidad_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'entidad_type', $this->entidad_type])
            ->andFilterWhere(['like', 'etiqueta', $this->etiqueta]);

        return $dataProvider;
    }
}
