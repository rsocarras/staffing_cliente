<?php

namespace app\models\search;

use app\models\MallaProfileAsignacion;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MallaProfileAsignacionSearch extends MallaProfileAsignacion
{
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'malla_id', 'profile_id', 'solicitado_por', 'aprobado_por', 'es_actual', 'activo'], 'integer'],
            [['estado_aprobacion', 'motivo_rechazo', 'solicitado_at', 'aprobado_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MallaProfileAsignacion::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'empresa_id' => $this->empresa_id,
            'malla_id' => $this->malla_id,
            'profile_id' => $this->profile_id,
            'solicitado_por' => $this->solicitado_por,
            'aprobado_por' => $this->aprobado_por,
            'es_actual' => $this->es_actual,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'estado_aprobacion', $this->estado_aprobacion])
            ->andFilterWhere(['like', 'motivo_rechazo', $this->motivo_rechazo]);

        return $dataProvider;
    }
}
