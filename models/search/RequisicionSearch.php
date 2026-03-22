<?php

namespace app\models\search;

use app\components\TenantContext;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Requisicion;

class RequisicionSearch extends Requisicion
{
    public $empresa_nombre;
    public $ciudad_nombre;
    public $fecha_ingreso_desde;
    public $fecha_ingreso_hasta;

    public function rules()
    {
        return [
            [['id', 'empresa_cliente_id', 'empresas_id', 'ciudad_id', 'sede_id', 'area_id', 'cargo_id', 'numero_vacantes'], 'integer'],
            [['estado', 'group_uuid', 'empresa_nombre', 'ciudad_nombre'], 'safe'],
            [['fecha_ingreso', 'fecha_ingreso_desde', 'fecha_ingreso_hasta'], 'safe'],
        ];
    }

    public function search($params, $formName = null)
    {
        $query = Requisicion::find()
            ->joinWith(['empresa', 'ciudad', 'sede', 'area', 'cargo']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['fecha_creacion' => SORT_DESC],
                'attributes' => [
                    'id', 'estado', 'fecha_ingreso', 'fecha_creacion',
                    'empresa_nombre' => ['asc' => ['empresa_cliente.nombre' => SORT_ASC], 'desc' => ['empresa_cliente.nombre' => SORT_DESC]],
                    'ciudad_nombre' => ['asc' => ['city.name' => SORT_ASC], 'desc' => ['city.name' => SORT_DESC]],
                ],
            ],
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $tenantEmpresaId = TenantContext::currentEmpresaId();
        if (is_numeric($tenantEmpresaId) && (int) $tenantEmpresaId > 0) {
            $query->andWhere(['requisicion.empresas_id' => (int) $tenantEmpresaId]);
        } else {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['requisicion.estado' => $this->estado])
            ->andFilterWhere(['requisicion.empresa_cliente_id' => $this->empresa_cliente_id])
            ->andFilterWhere(['requisicion.ciudad_id' => $this->ciudad_id])
            ->andFilterWhere(['requisicion.sede_id' => $this->sede_id])
            ->andFilterWhere(['requisicion.area_id' => $this->area_id])
            ->andFilterWhere(['requisicion.cargo_id' => $this->cargo_id])
            ->andFilterWhere(['like', 'requisicion.group_uuid', $this->group_uuid])
            ->andFilterWhere(['>=', 'requisicion.fecha_ingreso', $this->fecha_ingreso_desde])
            ->andFilterWhere(['<=', 'requisicion.fecha_ingreso', $this->fecha_ingreso_hasta])
            ->andFilterWhere(['like', 'empresa_cliente.nombre', $this->empresa_nombre])
            ->andFilterWhere(['like', 'city.name', $this->ciudad_nombre]);

        return $dataProvider;
    }
}
