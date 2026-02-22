<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NovedadFlujoPaso;

/**
 * NovedadFlujoPasoSearch represents the model behind the search form of `app\models\NovedadFlujoPaso`.
 */
class NovedadFlujoPasoSearch extends NovedadFlujoPaso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'novedad_tipo_id', 'es_inicio', 'siguiente_id', 'siguiente_si_id', 'siguiente_no_id', 'created_at', 'updated_at'], 'integer'],
            [['nombre', 'tipo_paso', 'rol', 'email_notif', 'condicion_campo', 'condicion_op', 'condicion_valor'], 'safe'],
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
        $query = NovedadFlujoPaso::find();

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
            'es_inicio' => $this->es_inicio,
            'siguiente_id' => $this->siguiente_id,
            'siguiente_si_id' => $this->siguiente_si_id,
            'siguiente_no_id' => $this->siguiente_no_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'tipo_paso', $this->tipo_paso])
            ->andFilterWhere(['like', 'rol', $this->rol])
            ->andFilterWhere(['like', 'email_notif', $this->email_notif])
            ->andFilterWhere(['like', 'condicion_campo', $this->condicion_campo])
            ->andFilterWhere(['like', 'condicion_op', $this->condicion_op])
            ->andFilterWhere(['like', 'condicion_valor', $this->condicion_valor]);

        return $dataProvider;
    }
}
