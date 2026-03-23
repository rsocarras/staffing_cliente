<?php

namespace app\controllers;

use app\models\NovedadFlujo;
use app\models\NovedadStep;
use app\models\NovedadStepHistoryLog;
use app\models\Profile;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * CRUD de flujos de novedad y configuración de pasos (steppers).
 */
class NovedadFlujoController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'create-ajax' => ['POST'],
                        'update-ajax' => ['POST'],
                        'step-save-ajax' => ['POST'],
                        'step-delete' => ['POST'],
                        'reorder-steps' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $base = NovedadFlujo::find();
        $total = (int) (clone $base)->count();
        $borradores = (int) (clone $base)->andWhere(['estado' => NovedadFlujo::ESTADO_BORRADOR])->count();
        $activos = (int) (clone $base)->andWhere(['estado' => NovedadFlujo::ESTADO_ACTIVO])->count();
        $inactivos = (int) (clone $base)->andWhere(['estado' => NovedadFlujo::ESTADO_INACTIVO])->count();

        return $this->render('index', [
            'total' => $total,
            'borradores' => $borradores,
            'activos' => $activos,
            'inactivos' => $inactivos,
        ]);
    }

    public function actionData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = $request->get('search', [])['value'] ?? '';
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 1);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = NovedadFlujo::find();
        $totalCount = (int) $query->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'novedad_flujo.nombre', $searchValue],
                ['like', 'novedad_flujo.descripcion', $searchValue],
                ['like', 'novedad_flujo.estado', $searchValue],
            ]);
        }
        $filteredCount = (int) $query->count();

        $orderColumns = ['novedad_flujo.id', 'novedad_flujo.nombre', 'novedad_flujo.descripcion', 'novedad_flujo.estado', null];
        $orderBy = $orderColumns[$orderCol] ?? 'novedad_flujo.nombre';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $estadoLabels = NovedadFlujo::estadoLista();
        $data = [];
        foreach ($models as $model) {
            $estado = $model->estado;
            $estadoTexto = $estadoLabels[$estado] ?? $estado;
            $badgeClass = 'bg-secondary';
            if ($estado === NovedadFlujo::ESTADO_ACTIVO) {
                $badgeClass = 'bg-success';
            } elseif ($estado === NovedadFlujo::ESTADO_INACTIVO) {
                $badgeClass = 'bg-dark';
            } elseif ($estado === NovedadFlujo::ESTADO_BORRADOR) {
                $badgeClass = 'bg-warning text-dark';
            }
            $data[] = [
                $model->id,
                '<span class="fw-medium text-dark">' . \yii\helpers\Html::encode($model->nombre) . '</span>',
                \yii\helpers\Html::encode($model->descripcion ?? '-'),
                '<span class="badge ' . $badgeClass . '">' . \yii\helpers\Html::encode($estadoTexto) . '</span>',
                $this->renderPartial('_actions_dropdown', ['model' => $model]),
            ];
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ];
    }

    public function actionViewAjax($id)
    {
        return $this->renderPartial('_view_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionFormAjax($id)
    {
        return $this->renderPartial('_form_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new NovedadFlujo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'message' => Yii::t('app', 'Flujo creado correctamente.'),
                'model' => [
                    'id' => $model->id,
                    'nombre' => $model->nombre,
                ],
            ];
        }

        if ($model->hasErrors()) {
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'message' => Yii::t('app', 'Flujo actualizado correctamente.'),
                'model' => [
                    'id' => $model->id,
                    'nombre' => $model->nombre,
                ],
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->findModel($id)->delete();
        return ['success' => true];
    }

    /**
     * Pantalla de configuración de pasos (steppers) del flujo.
     */
    public function actionConfigure($id)
    {
        $flujo = $this->findModel($id);
        $steps = NovedadStep::find()
            ->where(['novedad_flujo_id' => $flujo->id])
            ->with('profile')
            ->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        return $this->render('configure', [
            'flujo' => $flujo,
            'steps' => $steps,
        ]);
    }

    public function actionStepFormAjax($id)
    {
        $flujo = $this->findModel($id);
        $stepId = Yii::$app->request->get('step_id');
        if ($stepId) {
            $step = NovedadStep::findOne(['id' => $stepId, 'novedad_flujo_id' => $flujo->id]);
            if (!$step) {
                throw new NotFoundHttpException('Paso no encontrado.');
            }
        } else {
            $step = new NovedadStep();
            $step->novedad_flujo_id = $flujo->id;
            $step->loadDefaultValues();
        }

        $empresaId = $this->resolveEmpresaIdForProfiles();
        $profiles = [];
        if ($empresaId) {
            $profiles = ArrayHelper::map(
                Profile::find()
                    ->where(['empresas_id' => $empresaId, 'estado' => Profile::ESTADO_ACTIVO])
                    ->orderBy(['name' => SORT_ASC])
                    ->all(),
                'user_id',
                function (Profile $profile) {
                    return trim(($profile->name ?: 'Sin nombre') . ' — ' . $profile->num_doc);
                }
            );
        }

        return $this->renderPartial('_step_form_modal', [
            'flujo' => $flujo,
            'step' => $step,
            'profiles' => $profiles,
        ]);
    }

    public function actionStepSaveAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $post = Yii::$app->request->post();
        $flujoId = (int) ($post['NovedadStep']['novedad_flujo_id'] ?? 0);
        if (!$flujoId || !NovedadFlujo::findOne($flujoId)) {
            return ['success' => false, 'errors' => ['general' => ['Flujo inválido.']]];
        }

        $stepId = isset($post['NovedadStep']['id']) ? (int) $post['NovedadStep']['id'] : 0;
        if ($stepId) {
            $model = NovedadStep::findOne(['id' => $stepId, 'novedad_flujo_id' => $flujoId]);
            if (!$model) {
                return ['success' => false, 'errors' => ['general' => ['Paso no encontrado.']]];
            }
        } else {
            $model = new NovedadStep();
            $model->novedad_flujo_id = $flujoId;
            $maxOrden = (int) NovedadStep::find()->where(['novedad_flujo_id' => $flujoId])->max('orden');
            $model->orden = $maxOrden + 1;
        }

        if ($model->load($post) && $model->save()) {
            $actor = $this->currentActorUserId();
            $tipo = $stepId > 0
                ? NovedadStepHistoryLog::TIPO_STEP_UPDATE
                : NovedadStepHistoryLog::TIPO_STEP_CREATE;
            NovedadStepHistoryLog::record(
                $flujoId,
                $tipo,
                (int) $model->id,
                null,
                null,
                null,
                $actor
            );

            return ['success' => true, 'message' => 'Paso guardado correctamente.'];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionStepDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $step = NovedadStep::findOne($id);
        if (!$step) {
            return ['success' => false, 'message' => 'No encontrado'];
        }
        $flujoId = (int) $step->novedad_flujo_id;
        $sid = (int) $step->id;
        $motivo = 'Eliminado: ' . $step->codigo . ($step->nombre !== null && $step->nombre !== '' ? (' — ' . $step->nombre) : '');
        NovedadStepHistoryLog::record(
            $flujoId,
            NovedadStepHistoryLog::TIPO_STEP_DELETE,
            $sid,
            null,
            null,
            $motivo,
            $this->currentActorUserId()
        );
        $step->delete();

        return ['success' => true];
    }

    public function actionReorderSteps()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $flujoId = (int) Yii::$app->request->post('novedad_flujo_id');
        $order = Yii::$app->request->post('order');
        if (!$flujoId || !is_array($order)) {
            return ['success' => false, 'message' => 'Datos inválidos'];
        }

        if (!NovedadFlujo::findOne($flujoId)) {
            return ['success' => false, 'message' => 'Flujo no encontrado'];
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            foreach ($order as $i => $stepId) {
                $stepId = (int) $stepId;
                $affected = NovedadStep::updateAll(
                    ['orden' => $i, 'updated_at' => time()],
                    ['id' => $stepId, 'novedad_flujo_id' => $flujoId]
                );
                if ($affected === 0) {
                    throw new \RuntimeException('Paso inválido en el orden.');
                }
            }
            $msg = NovedadStep::mensajeValidacionAprobacionFlujo($flujoId);
            if ($msg !== null) {
                throw new \RuntimeException($msg);
            }
            $transaction->commit();
            $idsCsv = implode(',', array_map(static function ($v) {
                return (string) (int) $v;
            }, $order));
            NovedadStepHistoryLog::record(
                $flujoId,
                NovedadStepHistoryLog::TIPO_STEP_REORDER,
                null,
                null,
                null,
                'orden:' . $idsCsv,
                $this->currentActorUserId()
            );

            return ['success' => true];
        } catch (\Throwable $e) {
            $transaction->rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    protected function currentActorUserId(): ?int
    {
        $uid = Yii::$app->user->id ?? null;

        return $uid !== null ? (int) $uid : null;
    }

    protected function resolveEmpresaIdForProfiles(): ?int
    {
        $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
        return $profile ? (int) $profile->empresas_id : null;
    }

    protected function findModel($id): NovedadFlujo
    {
        if (($model = NovedadFlujo::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
