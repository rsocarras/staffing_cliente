<?php

namespace app\controllers;

use app\models\Requisicion;
use app\models\search\RequisicionSearch;
use app\models\Profile;
use app\models\ChecklistStatus;
use app\models\ChecklistItem;
use app\services\RequisicionService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class RequisicionController extends Controller
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'submit' => ['POST'],
                    'approve' => ['POST'],
                    'reject' => ['POST'],
                    'assign-person' => ['POST'],
                    'vinculacion' => ['POST'],
                    'activar' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'submit', 'sedes-por-ciudad', 'sub-areas-por-area'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['rrhh_cliente', 'admin'],
                        'actions' => ['approval', 'approve', 'reject'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['analista_atraccion', 'admin'],
                        'actions' => ['assign-person', 'buscar-persona'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['analista_vinculacion', 'admin'],
                        'actions' => ['vinculacion', 'checklist', 'completar-checklist', 'activar'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['rrhh_interno', 'admin'],
                        'actions' => ['reportes', 'nuevas-contrataciones', 'activos-por-mes'],
                    ],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new RequisicionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $grupo = $model->getGrupoRequisiciones();

        return $this->render('view', [
            'model' => $model,
            'grupo' => $grupo,
        ]);
    }

    public function actionCreate()
    {
        $model = new Requisicion();
        $model->estado = Requisicion::ESTADO_DRAFT;
        $model->numero_vacantes = 1;

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $model->group_uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
                    $model->vacante_index = 1;
                    $model->save(false);
                    $creadas = Requisicion::crearGrupoVacantes($model);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Requisición creada. Se generaron ' . count($creadas) . ' vacante(s).');
                    return $this->redirect(['view', 'id' => $creadas[0]->id]);
                } catch (\Throwable $e) {
                    $transaction->rollBack();
                    $model->addError('numero_vacantes', $e->getMessage());
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!$model->isEditable()) {
            throw new \yii\web\ForbiddenHttpException('No se puede editar esta requisición.');
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->isEditable()) {
            throw new \yii\web\ForbiddenHttpException('No se puede eliminar esta requisición.');
        }
        $model->delete();
        return $this->redirect(['index']);
    }

    public function actionSubmit($id)
    {
        $model = $this->findModel($id);
        try {
            RequisicionService::submit($model);
            Yii::$app->session->setFlash('success', 'Requisición enviada a aprobación.');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionApproval()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Requisicion::find()->where(['estado' => Requisicion::ESTADO_APPROVAL_PENDING])->orderBy('fecha_creacion'),
            'pagination' => ['pageSize' => 20],
        ]);

        return $this->render('approval', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        try {
            RequisicionService::approve($model);
            Yii::$app->session->setFlash('success', 'Requisición aprobada.');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect($this->request->referrer ?: ['approval']);
    }

    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $motivo = $this->request->post('motivo_rechazo', '');
        try {
            RequisicionService::reject($model, $motivo);
            Yii::$app->session->setFlash('success', 'Requisición rechazada.');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect($this->request->referrer ?: ['approval']);
    }

    public function actionBuscarPersona()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $numDoc = $this->request->get('num_documento', '');
        if (strlen($numDoc) < 3) {
            return ['results' => []];
        }
        $profiles = Profile::find()
            ->where(['like', 'num_doc', $numDoc])
            ->limit(10)
            ->all();
        return [
            'results' => array_map(function (Profile $p) {
                return [
                    'id' => $p->user_id,
                    'text' => ($p->name ?: 'Sin nombre') . ' - ' . $p->num_doc,
                    'name' => $p->name,
                    'num_doc' => $p->num_doc,
                    'email' => $p->public_email,
                    'telefono' => $p->telefono,
                    'birthday' => $p->birthday,
                    'sexo' => $p->sexo,
                    'tipo_doc' => $p->tipo_doc,
                ];
            }, $profiles),
        ];
    }

    public function actionAssignPerson($id)
    {
        $model = $this->findModel($id);
        $profileId = $this->request->post('profile_id');
        if ($profileId) {
            try {
                RequisicionService::assignPerson($model, $profileId);
                Yii::$app->session->setFlash('success', 'Persona asignada correctamente.');
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionVinculacion($id)
    {
        $model = $this->findModel($id);
        $aprobada = (bool) $this->request->post('aprobada');
        $motivo = $this->request->post('motivo_rechazo', '');
        try {
            RequisicionService::vincular($model, $aprobada, $aprobada ? null : $motivo);
            Yii::$app->session->setFlash('success', $aprobada ? 'Vinculación aprobada. Checklist habilitado.' : 'Vinculación rechazada.');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionChecklist($id)
    {
        $model = $this->findModel($id);
        $statuses = ChecklistStatus::find()
            ->where(['requisicion_id' => $id])
            ->joinWith('checklistItem')
            ->orderBy('checklist_item.orden')
            ->all();
        return $this->render('checklist', [
            'model' => $model,
            'statuses' => $statuses,
        ]);
    }

    public function actionCompletarChecklist($id)
    {
        $reqId = $this->request->post('requisicion_id');
        $itemId = $this->request->post('checklist_item_id');
        $completado = (bool) $this->request->post('completado');
        $status = ChecklistStatus::findOne(['requisicion_id' => $reqId, 'checklist_item_id' => $itemId]);
        if ($status) {
            $status->completado = $completado ? 1 : 0;
            $status->completado_por = $completado ? Yii::$app->user->id : null;
            $status->completado_at = $completado ? date('Y-m-d H:i:s') : null;
            $status->save(false);
        }
        return $this->redirect(['checklist', 'id' => $reqId]);
    }

    public function actionActivar($id)
    {
        $model = $this->findModel($id);
        try {
            RequisicionService::activar($model);
            Yii::$app->session->setFlash('success', 'Contratación activada. Persona en estado ACTIVO. Webhook ejecutado.');
        } catch (\DomainException $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionReportes()
    {
        return $this->render('reportes');
    }

    public function actionNuevasContrataciones()
    {
        $desde = $this->request->get('desde', date('Y-m-01'));
        $hasta = $this->request->get('hasta', date('Y-m-d'));
        $models = Requisicion::find()
            ->where(['estado' => Requisicion::ESTADO_ACTIVE])
            ->andWhere(['>=', 'fecha_creacion', $desde . ' 00:00:00'])
            ->andWhere(['<=', 'fecha_creacion', $hasta . ' 23:59:59'])
            ->joinWith(['empresa', 'ciudad', 'cargo', 'profile'])
            ->orderBy('fecha_creacion DESC')
            ->all();
        return $this->render('nuevas-contrataciones', [
            'models' => $models,
            'desde' => $desde,
            'hasta' => $hasta,
        ]);
    }

    public function actionActivosPorMes()
    {
        $anio = (int) $this->request->get('anio', date('Y'));
        $sql = "SELECT DATE_FORMAT(fecha_creacion, '%Y-%m') as mes, COUNT(*) as total 
                FROM requisicion 
                WHERE estado = 'ACTIVE' AND YEAR(fecha_creacion) = :anio 
                GROUP BY mes ORDER BY mes";
        $rows = Yii::$app->db->createCommand($sql, [':anio' => $anio])->queryAll();
        return $this->render('activos-por-mes', [
            'rows' => $rows,
            'anio' => $anio,
        ]);
    }

    public function actionSedesPorCiudad($ciudad_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $sedes = \app\models\LocationSedes::find()
            ->where(['or', ['city_id' => $ciudad_id], ['city_id' => null]])
            ->andWhere(['activo' => 1])
            ->orderBy('nombre')
            ->all();
        return array_map(function ($s) {
            return ['id' => $s->id, 'nombre' => $s->nombre];
        }, $sedes);
    }

    public function actionSubAreasPorArea($area_id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $subAreas = \app\models\Area::find()
            ->where(['area_padre' => $area_id])
            ->orderBy('nombre')
            ->all();
        return array_map(function ($a) {
            return ['id' => $a->id, 'nombre' => $a->nombre];
        }, $subAreas);
    }

    protected function findModel($id)
    {
        $model = Requisicion::findOne($id);
        if ($model !== null) {
            return $model;
        }
        throw new NotFoundHttpException('La página solicitada no existe.');
    }
}
