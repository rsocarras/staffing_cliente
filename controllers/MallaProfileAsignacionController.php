<?php

namespace app\controllers;

use app\models\MallaProfileAsignacion;
use app\models\Mallas;
use app\models\Profile;
use app\models\search\MallaProfileAsignacionSearch;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MallaProfileAsignacionController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
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
        $searchModel = new MallaProfileAsignacionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false;

        $empresaId = $this->currentEmpresaId();
        if ($empresaId !== null) {
            $dataProvider->query->andWhere(['empresa_id' => $empresaId]);
        }

        return $this->render('index', compact('searchModel', 'dataProvider'));
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionCreate()
    {
        $model = new MallaProfileAsignacion();
        $empresaId = $this->currentEmpresaId();
        if ($empresaId !== null) {
            $model->empresa_id = $empresaId;
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->empresa_id = $empresaId ?: $model->empresa_id;
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

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
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
        $model = MallaProfileAsignacion::findOne(['id' => $id]);
        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $empresaId = $this->currentEmpresaId();
        if ($empresaId !== null && (int) $model->empresa_id !== (int) $empresaId) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $model;
    }

    private function currentEmpresaId(): ?int
    {
        $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
        return $profile ? (int) $profile->empresas_id : null;
    }

    private function isMallaAprobada(int $mallaId): bool
    {
        $malla = Mallas::findOne($mallaId);
        return $malla !== null && $malla->estado_aprobacion === Mallas::ESTADO_APROBADA;
    }
}
