<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NovedadTipoCampoOpcion;

/**
 * NovedadTipoCampoOpcionSearch represents the model behind the search form of `app\models\NovedadTipoCampoOpcion`.
 */
class NovedadTipoCampoOpcionSearch extends NovedadTipoCampoOpcion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'novedad_tipo_campo_id', 'orden'], 'integer'],
            [['valor', 'etiqueta'], 'safe'],
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
        $query = NovedadTipoCampoOpcion::find();

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
            'novedad_tipo_campo_id' => $this->novedad_tipo_campo_id,
            'orden' => $this->orden,
        ]);

        $query->andFilterWhere(['like', 'valor', $this->valor])
            ->andFilterWhere(['like', 'etiqueta', $this->etiqueta]);

        return $dataProvider;
    }
}
