<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NovedadOpcionesDependientes;

/**
 * NovedadOpcionesDependientesSearch represents the model behind the search form of `app\models\NovedadOpcionesDependientes`.
 */
class NovedadOpcionesDependientesSearch extends NovedadOpcionesDependientes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'orden', 'activo'], 'integer'],
            [['campo_hijo', 'campo_padre', 'valor_padre', 'valor', 'etiqueta'], 'safe'],
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
        $query = NovedadOpcionesDependientes::find();

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
            'orden' => $this->orden,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'campo_hijo', $this->campo_hijo])
            ->andFilterWhere(['like', 'campo_padre', $this->campo_padre])
            ->andFilterWhere(['like', 'valor_padre', $this->valor_padre])
            ->andFilterWhere(['like', 'valor', $this->valor])
            ->andFilterWhere(['like', 'etiqueta', $this->etiqueta]);

        return $dataProvider;
    }
}
