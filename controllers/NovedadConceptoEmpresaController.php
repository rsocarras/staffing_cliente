<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Cargos;
use app\models\EmpresaNovedadConcepto;
use app\models\NovedadConcepto;
use app\models\NovedadConceptoCargo;
use Yii;
use yii\db\Query;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class NovedadConceptoEmpresaController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'view' => ['GET', 'POST'],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $empresaId = TenantContext::requireEmpresaId();

        $rows = EmpresaNovedadConcepto::find()
            ->alias('enc')
            ->innerJoinWith(['novedadConcepto nc'])
            ->leftJoin('novedad_tipo nt', 'nt.id = nc.novedad_tipo_id')
            ->where(['enc.empresa_id' => $empresaId])
            ->orderBy([
                'nt.nombre' => SORT_ASC,
                'nc.nombre' => SORT_ASC,
            ])
            ->all();

        $agrupados = [];
        foreach ($rows as $row) {
            $concepto = $row->novedadConcepto;
            if ($concepto === null) {
                continue;
            }
            $grupo = $concepto->novedadTipo ? (string) $concepto->novedadTipo->nombre : Yii::t('app', 'Sin agrupador');
            if (!isset($agrupados[$grupo])) {
                $agrupados[$grupo] = [];
            }
            $agrupados[$grupo][] = $concepto;
        }

        ksort($agrupados, SORT_NATURAL | SORT_FLAG_CASE);

        return $this->render('index', [
            'agrupados' => $agrupados,
        ]);
    }

    public function actionView($id)
    {
        $empresaId = TenantContext::requireEmpresaId();
        $concepto = $this->findConceptoEmpresa((int) $id, $empresaId);

        $cargos = Cargos::find()
            ->where(['empresa_id' => $empresaId])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        if (Yii::$app->request->isPost) {
            $selectedCargoIds = Yii::$app->request->post('cargo_ids', []);
            if (!is_array($selectedCargoIds)) {
                $selectedCargoIds = [];
            }
            $selectedCargoIds = array_values(array_unique(array_filter(array_map('intval', $selectedCargoIds), static fn ($v) => $v > 0)));

            $cargosPermitidos = Cargos::find()
                ->select('id')
                ->where(['empresa_id' => $empresaId, 'id' => $selectedCargoIds])
                ->column();
            $cargosPermitidos = array_map('intval', $cargosPermitidos);

            $tx = Yii::$app->db->beginTransaction();
            try {
                $subQuery = (new Query())
                    ->select('id')
                    ->from(Cargos::tableName())
                    ->where(['empresa_id' => $empresaId]);

                NovedadConceptoCargo::deleteAll([
                    'and',
                    ['novedad_concepto_id' => $concepto->id],
                    ['in', 'cargo_id', $subQuery],
                ]);

                foreach ($cargosPermitidos as $cargoId) {
                    Yii::$app->db->createCommand()->insert(NovedadConceptoCargo::tableName(), [
                        'novedad_concepto_id' => (int) $concepto->id,
                        'cargo_id' => (int) $cargoId,
                    ])->execute();
                }

                $tx->commit();
                Yii::$app->session->setFlash('success', Yii::t('app', 'Asignación de cargos guardada correctamente.'));

                return $this->redirect(['view', 'id' => $concepto->id]);
            } catch (\Throwable $e) {
                $tx->rollBack();
                Yii::error($e->getMessage(), __METHOD__);
                Yii::$app->session->setFlash('error', Yii::t('app', 'No fue posible guardar la asignación de cargos.'));
            }
        }

        $asignados = NovedadConceptoCargo::find()
            ->alias('ncc')
            ->innerJoin('cargos c', 'c.id = ncc.cargo_id')
            ->where([
                'ncc.novedad_concepto_id' => $concepto->id,
                'c.empresa_id' => $empresaId,
            ])
            ->select('ncc.cargo_id')
            ->column();
        $asignados = array_map('intval', $asignados);

        return $this->render('view', [
            'model' => $concepto,
            'cargos' => $cargos,
            'asignados' => $asignados,
        ]);
    }

    private function findConceptoEmpresa(int $id, int $empresaId): NovedadConcepto
    {
        $model = NovedadConcepto::find()
            ->alias('nc')
            ->innerJoin(EmpresaNovedadConcepto::tableName() . ' enc', 'enc.novedad_concepto_id = nc.id')
            ->where([
                'nc.id' => $id,
                'enc.empresa_id' => $empresaId,
            ])
            ->with(['novedadTipo'])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'El concepto solicitado no existe para la empresa actual.'));
    }
}
