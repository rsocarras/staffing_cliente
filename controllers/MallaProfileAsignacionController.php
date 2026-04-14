<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\MallaProfileAsignacion;
use app\models\Mallas;
use app\models\search\MallaProfileAsignacionSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\helpers\Html;

class MallaProfileAsignacionController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'create-ajax' => ['POST'],
                    'update-ajax' => ['POST'],
                    'approve' => ['POST'],
                    'reject' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['approve', 'reject'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['malla.asignacion_empleado.aprobar'],
                    ],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Returns JSON for DataTables server-side processing.
     * @return array
     */
    public function actionData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $request = Yii::$app->request;

        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = $request->get('search', [])['value'] ?? '';
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 0);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = MallaProfileAsignacion::find()
            ->joinWith(['profile', 'malla']);

        TenantContext::applyFilter($query, 'malla_profile_asignacion.empresa_id');

        $totalCount = (int) $query->count();

        if (is_string($searchValue) && trim($searchValue) !== '') {
            $v = trim($searchValue);
            $query->andWhere([
                'or',
                ['like', 'malla_profile_asignacion.id', $v],
                ['like', 'profile.name', $v],
                ['like', 'profile.num_doc', $v],
                ['like', 'mallas.nombre', $v],
                ['like', 'malla_profile_asignacion.estado_aprobacion', $v],
            ]);
        }

        $filteredCount = (int) $query->count();

        $orderColumns = [
            'malla_profile_asignacion.id',
            'profile.name',
            'mallas.nombre',
            'malla_profile_asignacion.estado_aprobacion',
            null,
        ];
        $orderBy = $orderColumns[$orderCol] ?? 'malla_profile_asignacion.id';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $estadoCls = MallaProfileAsignacion::estadoAprobacionBadgeSoftClass($model->estado_aprobacion);
            $estadoHtml = '<span class="badge badge-soft-' . $estadoCls . '">' . Html::encode($model->displayEstadoAprobacion()) . '</span>';
            $actualHtml = (int) $model->es_actual === 1
                ? '<span class="badge badge-soft-success">Sí</span>'
                : '<span class="badge badge-soft-danger">No</span>';
            $data[] = [
                (int) $model->id,
                '<span class="fw-medium text-dark">' . Html::encode($model->profile ? $model->profile->name : ($model->profile_id ?? '-')) . '</span>',
                Html::encode($model->malla ? $model->malla->nombre : ($model->malla_id ?? '-')),
                $estadoHtml,
                $actualHtml,
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

    public function actionCreate()
    {
        $model = new MallaProfileAsignacion();
        $model->empresa_id = TenantContext::requireEmpresaId();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->empresa_id = TenantContext::requireEmpresaId();
            $model->estado_aprobacion = MallaProfileAsignacion::ESTADO_PENDIENTE;
            $model->motivo_rechazo = null;
            $model->solicitado_por = Yii::$app->user->id;
            $model->solicitado_at = date('Y-m-d H:i:s');
            $model->aprobado_por = null;
            $model->aprobado_at = null;
            $model->es_actual = 0;
            $model->activo = 1;

            if ($model->malla_id && !$this->isMallaAprobada((int) $model->malla_id)) {
                $model->addError('malla_id', 'Solo puedes asignar mallas aprobadas.');
            }

            if (!$model->hasErrors() && $model->save()) {
                Yii::$app->session->setFlash('success', 'Asignación enviada a aprobación RRHH.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Creates a new MallaProfileAsignacion via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new MallaProfileAsignacion();
        $model->empresa_id = TenantContext::requireEmpresaId();

        if (!$this->request->isPost || !$model->load(Yii::$app->request->post())) {
            return ['success' => false, 'errors' => ['general' => ['Datos inválidos.']]];
        }

        $model->empresa_id = TenantContext::requireEmpresaId();
        $model->estado_aprobacion = MallaProfileAsignacion::ESTADO_PENDIENTE;
        $model->motivo_rechazo = null;
        $model->solicitado_por = Yii::$app->user->id;
        $model->solicitado_at = date('Y-m-d H:i:s');
        $model->aprobado_por = null;
        $model->aprobado_at = null;
        $model->es_actual = 0;
        $model->activo = 1;

        if ($model->malla_id && !$this->isMallaAprobada((int) $model->malla_id)) {
            $model->addError('malla_id', 'Solo puedes asignar mallas aprobadas.');
        }

        if (!$model->hasErrors() && $model->save()) {
            return [
                'success' => true,
                'message' => 'Asignación creada. Enviada a aprobación RRHH.',
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->estado_aprobacion = MallaProfileAsignacion::ESTADO_PENDIENTE;
            $model->motivo_rechazo = null;
            $model->solicitado_por = Yii::$app->user->id;
            $model->solicitado_at = date('Y-m-d H:i:s');
            $model->aprobado_por = null;
            $model->aprobado_at = null;
            $model->es_actual = 0;
            $model->activo = 1;

            if ($model->malla_id && !$this->isMallaAprobada((int) $model->malla_id)) {
                $model->addError('malla_id', 'Solo puedes asignar mallas aprobadas.');
            }

            if (!$model->hasErrors() && $model->save()) {
                Yii::$app->session->setFlash('success', 'Asignación actualizada y enviada a aprobación RRHH.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    /**
     * Returns HTML for edit form modal (AJAX).
     * @param int $id
     * @return string
     */
    public function actionFormAjax($id)
    {
        return $this->renderPartial('_form_modal', [
            'model' => $this->findModel($id),
            'esCreacion' => false,
        ]);
    }

    /**
     * Updates MallaProfileAsignacion via AJAX. Returns JSON.
     * @param int $id
     * @return array
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if (!$this->request->isPost || !$model->load(Yii::$app->request->post())) {
            return ['success' => false, 'errors' => ['general' => ['Datos inválidos.']]];
        }

        $model->estado_aprobacion = MallaProfileAsignacion::ESTADO_PENDIENTE;
        $model->motivo_rechazo = null;
        $model->solicitado_por = Yii::$app->user->id;
        $model->solicitado_at = date('Y-m-d H:i:s');
        $model->aprobado_por = null;
        $model->aprobado_at = null;
        $model->es_actual = 0;
        $model->activo = 1;

        if ($model->malla_id && !$this->isMallaAprobada((int) $model->malla_id)) {
            $model->addError('malla_id', 'Solo puedes asignar mallas aprobadas.');
        }

        if (!$model->hasErrors() && $model->save()) {
            return [
                'success' => true,
                'message' => 'Asignación actualizada y enviada a aprobación RRHH.',
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Returns HTML for view modal (AJAX).
     * @param int $id
     * @return string
     */
    public function actionViewAjax($id)
    {
        return $this->renderPartial('_view_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->redirect(['index']);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $model->approve(Yii::$app->user->id);
        Yii::$app->session->setFlash('success', 'Asignación a empleado aprobada.');
        return $this->redirect($this->request->referrer ?: ['view', 'id' => $id]);
    }

    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $model->estado_aprobacion = MallaProfileAsignacion::ESTADO_RECHAZADA;
        $model->motivo_rechazo = trim((string) $this->request->post('motivo_rechazo', '')) ?: null;
        $model->aprobado_por = Yii::$app->user->id;
        $model->aprobado_at = date('Y-m-d H:i:s');
        $model->es_actual = 0;
        $model->activo = 0;
        $model->save(false);
        Yii::$app->session->setFlash('success', 'Asignación a empleado rechazada.');
        return $this->redirect($this->request->referrer ?: ['view', 'id' => $id]);
    }

    protected function findModel($id): MallaProfileAsignacion
    {
        $model = MallaProfileAsignacion::findOne(['id' => $id, 'empresa_id' => TenantContext::requireEmpresaId()]);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }

    private function isMallaAprobada(int $mallaId): bool
    {
        $malla = Mallas::findOne($mallaId);
        return $malla !== null && $malla->estado_aprobacion === Mallas::ESTADO_APROBADA;
    }
}
