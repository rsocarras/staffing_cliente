<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlanillaImport;

/**
 * PlanillaImportSearch represents the model behind the search form of `app\models\PlanillaImport`.
 */
class PlanillaImportSearch extends PlanillaImport
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'payroll_period_id', 'template_id', 'archivo_id', 'created_by'], 'integer'],
            [['status', 'resumen_json', 'created_at', 'processed_at'], 'safe'],
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
        $query = PlanillaImport::find();

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
            'payroll_period_id' => $this->payroll_period_id,
            'template_id' => $this->template_id,
            'archivo_id' => $this->archivo_id,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'processed_at' => $this->processed_at,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'resumen_json', $this->resumen_json]);

        return $dataProvider;
    }
}
