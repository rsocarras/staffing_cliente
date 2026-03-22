<?php

namespace app\models\search;

use app\models\Presupuesto;
use app\services\AdministracionPlantaService;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class PresupuestoSearch extends Presupuesto
{
    public $vigencia_desde;
    public $vigencia_hasta;

    public function rules()
    {
        return [
            [['id', 'empresa_id', 'empresa_cliente_id', 'location_sede_id', 'created_by', 'activo', 'version'], 'integer'],
            [['estado', 'nombre', 'vigencia_desde', 'vigencia_hasta'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, ?int $forceEmpresaId = null)
    {
        $query = Presupuesto::find()->alias('p')
            ->joinWith(['locationSede sede', 'empresaCliente ec']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                // Las claves deben coincidir con `attributes`; el SQL usa alias `p` por los JOINs.
                'defaultOrder' => ['created_at' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['p.id' => SORT_ASC],
                        'desc' => ['p.id' => SORT_DESC],
                    ],
                    'nombre' => [
                        'asc' => ['p.nombre' => SORT_ASC],
                        'desc' => ['p.nombre' => SORT_DESC],
                    ],
                    'estado' => [
                        'asc' => ['p.estado' => SORT_ASC],
                        'desc' => ['p.estado' => SORT_DESC],
                    ],
                    'version' => [
                        'asc' => ['p.version' => SORT_ASC],
                        'desc' => ['p.version' => SORT_DESC],
                    ],
                    'fecha_inicio_vigencia' => [
                        'asc' => ['p.fecha_inicio_vigencia' => SORT_ASC],
                        'desc' => ['p.fecha_inicio_vigencia' => SORT_DESC],
                    ],
                    'fecha_fin_vigencia' => [
                        'asc' => ['p.fecha_fin_vigencia' => SORT_ASC],
                        'desc' => ['p.fecha_fin_vigencia' => SORT_DESC],
                    ],
                    'created_at' => [
                        'asc' => ['p.created_at' => SORT_ASC],
                        'desc' => ['p.created_at' => SORT_DESC],
                    ],
                    'location_sede_id' => [
                        'asc' => ['sede.nombre' => SORT_ASC],
                        'desc' => ['sede.nombre' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $empresaId = $forceEmpresaId;
        if ($empresaId === null) {
            $raw = Yii::$app->user->empresas_id ?? null;
            $empresaId = (is_numeric($raw) && (int) $raw > 0) ? (int) $raw : null;
        }

        if ($empresaId === null) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andWhere(['p.empresa_id' => $empresaId]);

        try {
            $scopeService = new AdministracionPlantaService();
            $scope = $scopeService->getScopeContext();
            if (empty($scope['full_access']) && !empty($scope['allowedSedeIds'])) {
                $query->andWhere(['p.location_sede_id' => $scope['allowedSedeIds']]);
            }
        } catch (\Throwable $e) {
            // sin perfil: no restringir sede adicionalmente
        }

        $query->andFilterWhere(['p.id' => $this->id])
            ->andFilterWhere(['p.estado' => $this->estado])
            ->andFilterWhere(['p.empresa_cliente_id' => $this->empresa_cliente_id])
            ->andFilterWhere(['p.location_sede_id' => $this->location_sede_id])
            ->andFilterWhere(['p.created_by' => $this->created_by])
            ->andFilterWhere(['p.activo' => $this->activo])
            ->andFilterWhere(['like', 'p.nombre', $this->nombre]);

        if (!empty($this->vigencia_desde)) {
            $query->andWhere(['>=', 'p.fecha_fin_vigencia', $this->vigencia_desde]);
        }
        if (!empty($this->vigencia_hasta)) {
            $query->andWhere(['<=', 'p.fecha_inicio_vigencia', $this->vigencia_hasta]);
        }

        return $dataProvider;
    }
}
