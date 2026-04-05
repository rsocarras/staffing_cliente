<?php

namespace app\models\search;

use app\components\TenantContext;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LocationSedes;

/**
 * LocationSedesSearch represents the model behind the search form of `app\models\LocationSedes`.
 */
class LocationSedesSearch extends LocationSedes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'activo', 'city_id', 'centro_costo', 'centro_costo_staffing'], 'integer'],
            [[
                'max_horas_clases_grupales',
                'valor_hora_base',
                'valor_hora_domingo_festivos',
                'valor_movilizacion',
                'valor_hora_especial',
            ], 'number'],
            [['codigo', 'nombre', 'direccion', 'codigo_externo', 'tipo_sede', 'created_at', 'updated_at'], 'safe'],
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
        $query = LocationSedes::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            TenantContext::applyFilter($query, 'empresa_id');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'activo' => $this->activo,
            'city_id' => $this->city_id,
            'centro_costo' => $this->centro_costo,
            'centro_costo_staffing' => $this->centro_costo_staffing,
            'max_horas_clases_grupales' => $this->max_horas_clases_grupales,
            'valor_hora_base' => $this->valor_hora_base,
            'valor_hora_domingo_festivos' => $this->valor_hora_domingo_festivos,
            'valor_movilizacion' => $this->valor_movilizacion,
            'valor_hora_especial' => $this->valor_hora_especial,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['tipo_sede' => $this->tipo_sede]);

        $query->andFilterWhere(['like', 'codigo', $this->codigo])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'codigo_externo', $this->codigo_externo]);

        TenantContext::applyFilter($query, 'empresa_id');

        return $dataProvider;
    }
}
