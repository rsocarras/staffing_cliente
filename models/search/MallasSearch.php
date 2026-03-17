<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mallas;

/**
 * MallasSearch represents the model behind the search form of `app\models\Mallas`.
 */
class MallasSearch extends Mallas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'activo', 'solicitado_por', 'aprobado_por'], 'integer'],
            [['nombre', 'descripcion', 'tipo', 'config_json', 'estado_aprobacion', 'motivo_rechazo', 'solicitado_at', 'aprobado_at', 'created_at', 'updated_at'], 'safe'],
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
        $query = Mallas::find();

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
            'activo' => $this->activo,
            'solicitado_por' => $this->solicitado_por,
            'aprobado_por' => $this->aprobado_por,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'estado_aprobacion', $this->estado_aprobacion])
            ->andFilterWhere(['like', 'motivo_rechazo', $this->motivo_rechazo])
            ->andFilterWhere(['like', 'config_json', $this->config_json]);

        return $dataProvider;
    }
}
