<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Area;
use app\models\Cargos;
use app\models\EmpresaCliente;
use app\models\Requisicion;
use app\models\RequisicionHistoryLog;
use app\models\search\RequisicionSearch;
use app\models\Profile;
use app\models\ChecklistStatus;
use app\models\ChecklistItem;
use app\services\RequisicionService;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\db\ActiveQuery;
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
                    'sedes-por-ciudad' => ['GET'],
                    'areas-por-empresa-cliente' => ['GET'],
                    'sub-areas-por-area' => ['GET'],
                    'cargos-por-sub-area' => ['GET'],
                    'create-ajax' => ['POST'],
                    'submit' => ['POST'],
                    'update-ajax' => ['POST'],
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
                        'roles' => ['requisicion_index'],
                        'actions' => ['index', 'data', 'view', 'view-ajax', 'create', 'create-ajax', 'update', 'form-ajax', 'update-ajax', 'delete', 'submit', 'sedes-por-ciudad', 'areas-por-empresa-cliente', 'sub-areas-por-area', 'cargos-por-sub-area'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['requisicion_approve'],
                        'actions' => ['approval', 'approve', 'reject'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['requisicion_assign'],
                        'actions' => ['assign-person', 'buscar-persona'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['requisicion_vinculacion'],
                        'actions' => ['vinculacion', 'checklist', 'completar-checklist', 'activar'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['requisicion_reportes'],
                        'actions' => ['reportes', 'nuevas-contrataciones', 'activos-por-mes'],
                    ],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new RequisicionSearch();
        $searchModel->empresas_id = $this->currentEmpresaId();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false;

        $this->applyDraftVisibilityForApprover($dataProvider->query);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Returns JSON for DataTables server-side processing.
     *
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

        $searchModel = new RequisicionSearch();
        $searchModel->empresas_id = $this->currentEmpresaId();
        $dataProvider = $searchModel->search($request->queryParams);

        /** @var \yii\db\ActiveQuery $baseQuery */
        $baseQuery = clone $dataProvider->query;

        $this->applyDraftVisibilityForApprover($baseQuery);

        // Persona (profile) is required for the table column.
        $baseQuery->joinWith(['profile']);

        $recordsTotal = (int) $baseQuery->count();

        /** @var \yii\db\ActiveQuery $filteredQuery */
        $filteredQuery = clone $baseQuery;
        if (is_string($searchValue) && trim($searchValue) !== '') {
            $v = trim($searchValue);
            $filteredQuery->andWhere([
                'or',
                ['like', 'requisicion.id', $v],
                ['like', 'requisicion.group_uuid', $v],
                ['like', 'requisicion.estado', $v],
                ['like', 'empresa_cliente.nombre', $v],
                ['like', 'city.name', $v],
                ['like', 'location_sedes.nombre', $v],
                ['like', 'area.nombre', $v],
                ['like', 'cargo.nombre', $v],
                ['like', 'profile.name', $v],
            ]);
        }

        $recordsFiltered = (int) $filteredQuery->count();

        $orderColumns = [
            'requisicion.id',
            'requisicion.group_uuid',
            'requisicion.estado',
            'requisicion.fecha_creacion',
            'empresa_cliente.nombre',
            'city.name',
            'location_sedes.nombre',
            'area.nombre',
            'requisicion.fecha_ingreso',
            'profile.name',
            null,
        ];
        $orderBy = $orderColumns[$orderCol] ?? 'requisicion.fecha_creacion';
        if ($orderBy) {
            $filteredQuery->orderBy([$orderBy => $orderDir]);
        }

        $models = $filteredQuery->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $parts = explode('-', $model->group_uuid ?? '');
            $shortUuid = $model->group_uuid ? (end($parts) ?: $model->group_uuid) : '-';
            $fechaIngreso = $model->fecha_ingreso ? Yii::$app->formatter->asDate($model->fecha_ingreso) : '-';
            $persona = $model->profile ? ($model->profile->name ?: '-') : '-';

            $data[] = [
                (string) $model->id,
                Html::a(Html::encode($shortUuid) . ' #' . (int) $model->vacante_index, ['view', 'id' => $model->id], ['title' => $model->group_uuid]),
                '<span class="badge badge-soft-' . Requisicion::estadoBadgeClass($model->estado) . '">' . Html::encode(Requisicion::optsEstado()[$model->estado] ?? $model->estado) . '</span>',
                Html::encode($model->tiempoTotalDesdeCreacion ?: '-'),
                Html::encode($model->empresa->nombre ?? '-'),
                Html::encode($model->ciudad->name ?? '-'),
                Html::encode($model->sede->nombre ?? '-'),
                Html::encode($model->cargo->nombre ?? '-'),
                Html::encode((string) $fechaIngreso),
                Html::encode($persona),
                $this->renderPartial('_actions_dropdown', ['model' => $model]),
            ];
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];
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
        $this->applyTenantEmpresa($model);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {
            $this->applyTenantEmpresa($model);
            $creadas = $this->guardarGrupoRequisiciones($model);
            if ($creadas !== null) {
                Yii::$app->session->setFlash('success', 'Requisición creada. Se generaron ' . count($creadas) . ' vacante(s).');
                return $this->redirect(['view', 'id' => $creadas[0]->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Requisicion();
        $model->estado = Requisicion::ESTADO_DRAFT;
        $model->numero_vacantes = 1;
        $this->applyTenantEmpresa($model);

        if (!$this->request->isPost || !$model->load($this->request->post())) {
            return [
                'success' => false,
                'errors' => ['general' => ['Datos inválidos.']],
            ];
        }

        $this->applyTenantEmpresa($model);
        if (!$model->validate()) {
            return [
                'success' => false,
                'errors' => $model->getErrors(),
            ];
        }

        $creadas = $this->guardarGrupoRequisiciones($model);
        if ($creadas === null) {
            return [
                'success' => false,
                'errors' => $model->getErrors(),
            ];
        }

        return [
            'success' => true,
            'message' => 'Requisición creada. Se generaron ' . count($creadas) . ' vacante(s).',
            'rowsHtml' => array_map(function (Requisicion $requisicion) {
                return $this->renderPartial('_row', ['model' => $requisicion]);
            }, $creadas),
            'viewUrl' => Url::to(['view', 'id' => $creadas[0]->id]),
            'canAppendToList' => !Yii::$app->user->can('requisicion_approve'),
        ];
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
     * Updates requisición via AJAX. Returns JSON.
     * @param int $id
     * @return array
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if (!$model->isEditable()) {
            return ['success' => false, 'errors' => ['general' => ['No se puede editar esta requisición.']]];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['success' => true];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->isEditable()) {
            throw new \yii\web\ForbiddenHttpException('No se puede eliminar esta requisición.');
        }
        $model->delete();
        if ($this->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }

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
            'query' => Requisicion::find()->where([
                'estado' => Requisicion::ESTADO_APPROVAL_PENDING,
                'empresas_id' => $this->currentEmpresaId(),
            ])->orderBy('fecha_creacion'),
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
            ->andWhere(['empresas_id' => $this->currentEmpresaId()])
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
        $comentario = $this->request->post('comentario', '');
        if ($profileId) {
            try {
                RequisicionService::assignPerson($model, $profileId, $comentario ?: null);
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
        $comentario = $this->request->post('comentario', '');
        try {
            RequisicionService::activar($model, $comentario ?: null);
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
            ->andWhere(['empresas_id' => $this->currentEmpresaId()])
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
                WHERE estado = 'ACTIVE' AND YEAR(fecha_creacion) = :anio AND empresas_id = :empresas_id
                GROUP BY mes ORDER BY mes";
        $rows = Yii::$app->db->createCommand($sql, [':anio' => $anio, ':empresas_id' => $this->currentEmpresaId()])->queryAll();
        return $this->render('activos-por-mes', [
            'rows' => $rows,
            'anio' => $anio,
        ]);
    }

    /**
     * Áreas raíz de la organización (tenant) al seleccionar empresa cliente.
     * Único filtro: empresa cliente válida y activa para el tenant; se listan todas las áreas raíz del tenant.
     */
    public function actionAreasPorEmpresaCliente(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tenantId = $this->currentEmpresaId();
        if ($tenantId === null) {
            return [];
        }
        $ecId = (int) Yii::$app->request->get('empresa_cliente_id', 0);
        if ($ecId <= 0) {
            return [];
        }
        $ec = EmpresaCliente::findOne(['id' => $ecId, 'empresas_id' => $tenantId, 'is_active' => 1]);
        if ($ec === null) {
            return [];
        }

        $areas = Area::find()
            ->where(['empresas_id' => $tenantId])
            ->andWhere(['or', ['area_padre' => null], ['area_padre' => 0]])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        return array_map(static function (Area $a) {
            return ['id' => $a->id, 'nombre' => (string) $a->nombre];
        }, $areas);
    }

    public function actionSedesPorCiudad($ciudad_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $sedes = \app\models\LocationSedes::find()
            ->where(['or', ['city_id' => $ciudad_id], ['city_id' => null]])
            ->andWhere(['empresa_id' => $this->currentEmpresaId()])
            ->andWhere(['activo' => 1])
            ->orderBy('nombre')
            ->all();
        return array_map(function ($s) {
            return ['id' => $s->id, 'nombre' => $s->nombre];
        }, $sedes);
    }

    public function actionSubAreasPorArea($area_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $tenantId = $this->currentEmpresaId();
        if ($tenantId === null || !$area_id) {
            return [];
        }
        $parent = Area::findOne(['id' => (int) $area_id, 'empresas_id' => $tenantId]);
        if ($parent === null) {
            return [];
        }
        $subAreas = Area::find()
            ->where(['area_padre' => (int) $area_id])
            ->andWhere(['empresas_id' => $tenantId])
            ->orderBy('nombre')
            ->all();

        return array_map(static function (Area $a) {
            return ['id' => $a->id, 'nombre' => $a->nombre];
        }, $subAreas);
    }

    /**
     * Cargos activos por organización (tenant) y área; si llega subárea, también la aplica.
     */
    public function actionCargosPorSubArea(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $areaId = (int) Yii::$app->request->get('area_id', 0);
        $subAreaId = (int) Yii::$app->request->get('sub_area_id', 0);
        $tenantId = $this->currentEmpresaId();
        if ($areaId <= 0 || $tenantId === null) {
            return [];
        }
        $area = Area::findOne(['id' => $areaId, 'empresas_id' => $tenantId]);
        if ($area === null) {
            return [];
        }
        $query = Cargos::find()->where([
            'area_id' => $areaId,
            'activo' => 1,
        ]);
        if ($subAreaId > 0) {
            $sub = Area::findOne(['id' => $subAreaId, 'empresas_id' => $tenantId]);
            if ($sub === null || (int) $sub->area_padre !== $areaId) {
                return [];
            }
            $query->andWhere(['sub_area_id' => $subAreaId]);
        }
        $query->orderBy(['nombre' => SORT_ASC]);
        TenantContext::applyFilter($query, 'empresa_id');
        $rows = $query->all();

        return array_map(static function (Cargos $c) {
            return ['id' => $c->id, 'nombre' => $c->nombre];
        }, $rows);
    }

    protected function findModel($id)
    {
        $model = Requisicion::find()
            ->where(['id' => $id, 'empresas_id' => $this->currentEmpresaId()])
            ->one();
        if ($model !== null) {
            $this->assertApproverCanAccessDraft($model);
            return $model;
        }
        throw new NotFoundHttpException('La página solicitada no existe.');
    }

    /**
     * Aprobadores: no ven borradores de otros; sí los propios (mismo creado_por).
     */
    protected function applyDraftVisibilityForApprover(ActiveQuery $query): void
    {
        if (!Yii::$app->user->can('requisicion_approve')) {
            return;
        }
        $uid = Yii::$app->user->id;
        $query->andWhere([
            'or',
            ['!=', 'requisicion.estado', Requisicion::ESTADO_DRAFT],
            [
                'and',
                ['requisicion.estado' => Requisicion::ESTADO_DRAFT],
                ['requisicion.creado_por' => $uid],
            ],
        ]);
    }

    /**
     * Evita ver/editar por URL borradores de terceros si el usuario es aprobador.
     */
    protected function assertApproverCanAccessDraft(Requisicion $model): void
    {
        if (!Yii::$app->user->can('requisicion_approve')) {
            return;
        }
        if ($model->estado !== Requisicion::ESTADO_DRAFT) {
            return;
        }
        if ((int) $model->creado_por !== (int) Yii::$app->user->id) {
            throw new ForbiddenHttpException('No puede acceder al borrador de otro usuario.');
        }
    }

    private function currentEmpresaId(): ?int
    {
        return TenantContext::currentEmpresaId();
    }

    private function applyTenantEmpresa(Requisicion $model): void
    {
        $empresaId = $this->currentEmpresaId();
        if ($empresaId !== null) {
            $model->empresas_id = $empresaId;
        }
    }

    private function guardarGrupoRequisiciones(Requisicion $model): ?array
    {
        $transaction = Yii::$app->db->beginTransaction();

        try {
            $model->group_uuid = sprintf(
                '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff)
            );
            $model->vacante_index = 1;
            $model->save(false);
            RequisicionHistoryLog::registrar($model, Requisicion::ESTADO_DRAFT, 'Requisición creada', null);
            $creadas = Requisicion::crearGrupoVacantes($model);
            $transaction->commit();

            return $creadas;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            $model->addError('numero_vacantes', $e->getMessage());

            return null;
        }
    }
}
