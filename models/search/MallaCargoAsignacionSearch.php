<?php

namespace app\models\search;

use app\models\MallaCargoAsignacion;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class MallaCargoAsignacionSearch extends MallaCargoAsignacion
{
    public function rules()
    {
        return [
            [['id', 'empresa_id', 'malla_id', 'cargo_id', 'solicitado_por', 'aprobado_por', 'activo'], 'integer'],
            [['estado_aprobacion', 'motivo_rechazo', 'solicitado_at', 'aprobado_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MallaCargoAsignacion::find();
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
            'cargo_id' => $this->cargo_id,
            'solicitado_por' => $this->solicitado_por,
            'aprobado_por' => $this->aprobado_por,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'estado_aprobacion', $this->estado_aprobacion])
            ->andFilterWhere(['like', 'motivo_rechazo', $this->motivo_rechazo]);

        return $dataProvider;
    }
}
