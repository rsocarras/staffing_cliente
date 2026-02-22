<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NovedadTipoCampo;

/**
 * NovedadTipoCampoSearch represents the model behind the search form of `app\models\NovedadTipoCampo`.
 */
class NovedadTipoCampoSearch extends NovedadTipoCampo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'novedad_tipo_id', 'orden', 'requerido', 'calculado', 'max_length', 'created_at', 'updated_at'], 'integer'],
            [['campo_id', 'label', 'tipo_dato', 'formula', 'val_min', 'val_max', 'fuente_opciones', 'depende_de', 'visible_si_campo', 'visible_si_op', 'visible_si_valor'], 'safe'],
            [['alerta_max'], 'number'],
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
        $query = NovedadTipoCampo::find();

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
            'novedad_tipo_id' => $this->novedad_tipo_id,
            'orden' => $this->orden,
            'requerido' => $this->requerido,
            'calculado' => $this->calculado,
            'max_length' => $this->max_length,
            'alerta_max' => $this->alerta_max,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'campo_id', $this->campo_id])
            ->andFilterWhere(['like', 'label', $this->label])
            ->andFilterWhere(['like', 'tipo_dato', $this->tipo_dato])
            ->andFilterWhere(['like', 'formula', $this->formula])
            ->andFilterWhere(['like', 'val_min', $this->val_min])
            ->andFilterWhere(['like', 'val_max', $this->val_max])
            ->andFilterWhere(['like', 'fuente_opciones', $this->fuente_opciones])
            ->andFilterWhere(['like', 'depende_de', $this->depende_de])
            ->andFilterWhere(['like', 'visible_si_campo', $this->visible_si_campo])
            ->andFilterWhere(['like', 'visible_si_op', $this->visible_si_op])
            ->andFilterWhere(['like', 'visible_si_valor', $this->visible_si_valor]);

        return $dataProvider;
    }
}
