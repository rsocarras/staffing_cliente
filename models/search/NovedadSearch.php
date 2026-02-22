<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Novedad;

/**
 * NovedadSearch represents the model behind the search form of `app\models\Novedad`.
 */
class NovedadSearch extends Novedad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'profile_id', 'concepto_id', 'novedad_tipo_id', 'paso_actual_id', 'es_masivo', 'lote_masivo_id', 'created_at', 'updated_at'], 'integer'],
            [['estado', 'datos', 'schema_snapshot', 'alertas'], 'safe'],
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
        $query = Novedad::find();

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
            'concepto_id' => $this->concepto_id,
            'novedad_tipo_id' => $this->novedad_tipo_id,
            'paso_actual_id' => $this->paso_actual_id,
            'es_masivo' => $this->es_masivo,
            'lote_masivo_id' => $this->lote_masivo_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'datos', $this->datos])
            ->andFilterWhere(['like', 'schema_snapshot', $this->schema_snapshot])
            ->andFilterWhere(['like', 'alertas', $this->alertas]);

        return $dataProvider;
    }
}
