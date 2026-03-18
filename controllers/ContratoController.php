<?php

namespace app\controllers;

use app\models\Area;
use app\models\Contrato;
use app\models\ContratoDistribucionSede;
use app\models\ContratoTipos;
use app\models\Profile;
use app\models\search\AdministracionPlantaDashboardSearch;
use app\models\search\ContratoSearch;
use app\services\AdministracionPlantaService;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ContratoController extends Controller
{
    /** @var AdministracionPlantaService */
    private $scopeService;

    public function __construct($id, $module, $config = [])
    {
        $this->scopeService = new AdministracionPlantaService();
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'sub-areas' => ['GET'],
                    'cargos-por-estructura' => ['GET'],
                    'create-ajax' => ['POST'],
                    'update-ajax' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin', 'administrator', 'admin_total', 'rrhh', 'rrhh_interno', 'rrhh_cliente', 'operaciones_regionales', 'director_area', 'gerente_sede'],
                        'actions' => ['index', 'view', 'sub-areas', 'cargos-por-estructura', 'view-ajax', 'form-ajax'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin', 'administrator', 'admin_total', 'rrhh', 'rrhh_interno', 'rrhh_cliente', 'operaciones_regionales', 'director_area'],
                        'actions' => ['create', 'update', 'delete', 'create-ajax', 'update-ajax'],
                    ],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $scope = $this->getScopeContext();
        $searchModel = new ContratoSearch();
        $searchModel->empresa_id = $this->scopeService->getCurrentEmpresaId();

        $query = Contrato::find()
            ->alias('contrato')
            ->where(['contrato.empresa_id' => $this->scopeService->getCurrentEmpresaId()]);
        $this->applyScopeToQuery($query, $scope);

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $query);
        $dataProvider->pagination = false;

        $summaryCounts = $this->getContratoSummaryCounts($query);

        $modelForForm = new Contrato();
        $modelForForm->empresa_id = $this->scopeService->getCurrentEmpresaId();
        $modelForForm->estado = Contrato::ESTADO_ACTIVO;
        $modelForForm->fecha_inicio = date('Y-m-d');
        $formOptions = $this->buildFormOptions($modelForForm);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filterOptions' => $this->buildFilterOptions($searchModel),
            'scope' => $scope,
            'summaryCounts' => $summaryCounts,
            'formOptions' => $formOptions,
            'modelContratoAdd' => $modelForForm,
        ]);
    }

    private function getContratoSummaryCounts(ActiveQuery $baseQuery)
    {
        $today = date('Y-m-d');
        $counts = [
            'total' => (int) (clone $baseQuery)->count(),
            'activos' => (int) (clone $baseQuery)->andWhere(['contrato.estado' => Contrato::ESTADO_ACTIVO])->count(),
            'vigentes' => (int) (clone $baseQuery)
                ->andWhere(['<=', 'contrato.fecha_inicio', $today])
                ->andWhere([
                    'or',
                    ['contrato.fecha_fin' => null],
                    ['>=', 'contrato.fecha_fin', $today],
                ])
                ->count(),
            'liquidados' => (int) (clone $baseQuery)->andWhere([
                'contrato.estado' => [Contrato::ESTADO_LIQUIDADO, Contrato::ESTADO_CANCELADO],
            ])->count(),
        ];

        return $counts;
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->assertModelScope($model);

        return $this->render('view', [
            'model' => $model,
            'scope' => $this->getScopeContext(),
        ]);
    }

    public function actionCreate()
    {
        $this->ensureManageAccess();

        $model = new Contrato();
        $model->empresa_id = $this->scopeService->getCurrentEmpresaId();
        $model->estado = Contrato::ESTADO_ACTIVO;
        $model->fecha_inicio = date('Y-m-d');

        $distributionRows = [['sede_id' => '', 'porcentaje' => '']];

        if ($this->request->isPost && $model->load($this->request->post())) {
            $distributionRows = $this->getPostedDistributionRows();
            $model->empresa_id = $this->scopeService->getCurrentEmpresaId();

            if ($this->saveContrato($model, $distributionRows)) {
                Yii::$app->session->setFlash('success', 'Contrato creado correctamente.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'distributionRows' => $distributionRows,
            'options' => $this->buildFormOptions($model),
            'scope' => $this->getScopeContext(),
        ]);
    }

    public function actionUpdate($id)
    {
        $this->ensureManageAccess();

        $model = $this->findModel($id);
        $this->assertModelScope($model, true);

        $distributionRows = $this->buildDistributionRowsFromModel($model);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $distributionRows = $this->getPostedDistributionRows();
            $model->empresa_id = $this->scopeService->getCurrentEmpresaId();

            if ($this->saveContrato($model, $distributionRows)) {
                Yii::$app->session->setFlash('success', 'Contrato actualizado correctamente.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'distributionRows' => $distributionRows,
            'options' => $this->buildFormOptions($model),
            'scope' => $this->getScopeContext(),
        ]);
    }

    public function actionDelete($id)
    {
        $this->ensureManageAccess();

        $model = $this->findModel($id);
        $this->assertModelScope($model, true);
        $model->delete();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }

        Yii::$app->session->setFlash('success', 'Contrato eliminado correctamente.');
        return $this->redirect(['index']);
    }

    public function actionViewAjax($id)
    {
        $model = $this->findModel($id);
        $this->assertModelScope($model);

        return $this->renderPartial('_view_modal', [
            'model' => $model,
            'scope' => $this->getScopeContext(),
        ]);
    }

    public function actionFormAjax($id)
    {
        $this->ensureManageAccess();

        $model = $this->findModel($id);
        $this->assertModelScope($model, true);

        $distributionRows = $this->buildDistributionRowsFromModel($model);
        $options = $this->buildFormOptions($model);

        return $this->renderPartial('_form_modal', [
            'model' => $model,
            'distributionRows' => $distributionRows,
            'options' => $options,
        ]);
    }

    public function actionCreateAjax()
    {
        $this->ensureManageAccess();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Contrato();
        $model->empresa_id = $this->scopeService->getCurrentEmpresaId();
        $model->estado = Contrato::ESTADO_ACTIVO;
        $model->fecha_inicio = date('Y-m-d');

        $distributionRows = $this->getPostedDistributionRows();

        if ($model->load(Yii::$app->request->post()) && $this->saveContrato($model, $distributionRows)) {
            return [
                'success' => true,
                'message' => 'Contrato creado correctamente.',
                'model' => ['id' => $model->id],
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionUpdateAjax($id)
    {
        $this->ensureManageAccess();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);
        $this->assertModelScope($model, true);

        $distributionRows = $this->getPostedDistributionRows();

        if ($model->load(Yii::$app->request->post()) && $this->saveContrato($model, $distributionRows)) {
            return [
                'success' => true,
                'message' => 'Contrato actualizado correctamente.',
                'model' => ['id' => $model->id],
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    public function actionSubAreas($area_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $rows = $this->scopeService->getSubAreaOptions((int) $area_id, $this->scopeService->getCurrentEmpresaId());

        return array_map(function ($row) {
            return [
                'id' => $row->id,
                'nombre' => $row->nombre,
            ];
        }, $rows);
    }

    public function actionCargosPorEstructura($area_id = null, $sub_area_id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $rows = $this->scopeService->getCargoOptions(
            $this->scopeService->getCurrentEmpresaId(),
            $area_id ? (int) $area_id : null,
            $sub_area_id ? (int) $sub_area_id : null
        );

        return array_map(function ($row) {
            return [
                'id' => $row->id,
                'nombre' => $row->nombre,
            ];
        }, $rows);
    }

    protected function findModel($id)
    {
        $model = Contrato::find()
            ->with(['profile.user', 'contratoTipo', 'sede', 'area', 'subArea', 'cargo', 'contratoDistribucionSedes.sede', 'createdBy', 'updatedBy'])
            ->where([
                'id' => $id,
                'empresa_id' => $this->scopeService->getCurrentEmpresaId(),
            ])
            ->one();

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El contrato solicitado no existe.');
    }

    private function saveContrato(Contrato $model, array $distributionRows)
    {
        $scope = $this->getScopeContext();
        $this->assertModelScope($model, true);

        $isValid = $model->validate();
        $distributionRows = $this->normalizeDistributionRows($distributionRows);
        $isValid = $this->validateDistributionRows($distributionRows, $model, $scope) && $isValid;

        if (!$isValid) {
            return false;
        }

        $transaction = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save(false)) {
                throw new \RuntimeException('No fue posible guardar el contrato.');
            }

            ContratoDistribucionSede::deleteAll(['contrato_id' => $model->id]);

            foreach ($distributionRows as $row) {
                $distribution = new ContratoDistribucionSede();
                $distribution->contrato_id = $model->id;
                $distribution->sede_id = (int) $row['sede_id'];
                $distribution->porcentaje = (float) $row['porcentaje'];
                if (!$distribution->save()) {
                    foreach ($distribution->getFirstErrors() as $error) {
                        $model->addError('sede_id', $error);
                    }
                    $transaction->rollBack();
                    return false;
                }
            }

            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            Yii::error($e->getMessage(), __METHOD__);
            $model->addError('profile_id', 'No fue posible guardar el contrato.');
            return false;
        }
    }

    private function normalizeDistributionRows(array $rows)
    {
        $normalized = [];

        foreach ($rows as $row) {
            $sedeId = isset($row['sede_id']) ? trim((string) $row['sede_id']) : '';
            $porcentaje = isset($row['porcentaje']) ? trim((string) $row['porcentaje']) : '';

            if ($sedeId === '' && $porcentaje === '') {
                continue;
            }

            $normalized[] = [
                'sede_id' => $sedeId,
                'porcentaje' => $porcentaje,
            ];
        }

        return $normalized;
    }

    private function validateDistributionRows(array $rows, Contrato $model, array $scope)
    {
        if (empty($rows)) {
            return true;
        }

        $valid = true;
        $sum = 0.0;
        $seenSedeIds = [];

        foreach ($rows as $index => $row) {
            $position = $index + 1;

            if ($row['sede_id'] === '') {
                $model->addError('sede_id', "La distribución #{$position} requiere sede.");
                $valid = false;
                continue;
            }

            if (!is_numeric($row['porcentaje'])) {
                $model->addError('sede_id', "La distribución #{$position} requiere un porcentaje válido.");
                $valid = false;
                continue;
            }

            $sedeId = (int) $row['sede_id'];
            $porcentaje = (float) $row['porcentaje'];

            if ($porcentaje <= 0 || $porcentaje > 100) {
                $model->addError('sede_id', "La distribución #{$position} debe estar entre 0.01 y 100.");
                $valid = false;
            }

            if (in_array($sedeId, $seenSedeIds, true)) {
                $model->addError('sede_id', "La sede de la distribución #{$position} está repetida.");
                $valid = false;
            } else {
                $seenSedeIds[] = $sedeId;
            }

            $sede = (new Query())
                ->from('location_sedes')
                ->where([
                    'id' => $sedeId,
                    'empresa_id' => $model->empresa_id,
                ])
                ->exists(Yii::$app->db);

            if (!$sede) {
                $model->addError('sede_id', "La sede de la distribución #{$position} no pertenece al tenant actual.");
                $valid = false;
            }

            if (!$scope['full_access'] && !empty($scope['allowedSedeIds']) && !in_array($sedeId, $scope['allowedSedeIds'], true)) {
                $model->addError('sede_id', "La sede de la distribución #{$position} está fuera de su alcance.");
                $valid = false;
            }

            $sum += $porcentaje;
        }

        if (abs($sum - 100) > 0.01) {
            $model->addError('sede_id', 'La suma de la distribución por sedes debe ser exactamente 100%.');
            $valid = false;
        }

        return $valid;
    }

    private function getPostedDistributionRows()
    {
        return Yii::$app->request->post('DistribucionSede', []);
    }

    private function buildDistributionRowsFromModel(Contrato $model)
    {
        $rows = [];

        foreach ($model->contratoDistribucionSedes as $distribution) {
            $rows[] = [
                'sede_id' => $distribution->sede_id,
                'porcentaje' => $distribution->porcentaje,
            ];
        }

        return empty($rows) ? [['sede_id' => '', 'porcentaje' => '']] : $rows;
    }

    private function buildFilterOptions(?ContratoSearch $searchModel = null)
    {
        $filterState = new AdministracionPlantaDashboardSearch();
        if ($searchModel !== null) {
            $filterState->region_id = $searchModel->region_id;
            $filterState->city_id = $searchModel->city_id;
            $filterState->area_id = $searchModel->area_id;
            $filterState->sub_area_id = $searchModel->sub_area_id;
        }

        $baseOptions = $this->scopeService->getFilterOptions($filterState);

        return array_merge($baseOptions, [
            'profiles' => $this->getProfileOptions(),
            'contratoTipos' => $this->getContratoTipoOptions(),
            'estados' => Contrato::optsEstado(),
            'vigencia' => [
                1 => 'Vigentes por fecha',
                0 => 'No vigentes por fecha',
            ],
        ]);
    }

    private function buildFormOptions(Contrato $model)
    {
        $baseOptions = $this->buildFilterOptions();

        return [
            'profiles' => $baseOptions['profiles'],
            'contratoTipos' => $baseOptions['contratoTipos'],
            'sedes' => $baseOptions['sedes'],
            'areas' => $baseOptions['areas'],
            'subAreas' => $model->area_id ? $this->scopeService->getSubAreaOptions($model->area_id, $model->empresa_id) : [],
            'cargos' => $this->scopeService->getCargoOptions($model->empresa_id, $model->area_id, $model->sub_area_id),
            'estados' => Contrato::optsEstado(),
        ];
    }

    private function getProfileOptions()
    {
        $rows = Profile::find()
            ->alias('profile')
            ->joinWith(['user user'])
            ->where(['profile.empresas_id' => $this->scopeService->getCurrentEmpresaId()])
            ->orderBy(['profile.name' => SORT_ASC, 'user.username' => SORT_ASC])
            ->all();

        return $rows;
    }

    private function getContratoTipoOptions()
    {
        return ContratoTipos::find()
            ->where([
                'or',
                ['empresa_id' => $this->scopeService->getCurrentEmpresaId()],
                ['empresa_id' => null],
            ])
            ->andWhere(['activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();
    }

    private function getScopeContext()
    {
        return $this->scopeService->getScopeContext();
    }

    private function ensureManageAccess()
    {
        $scope = $this->getScopeContext();
        if (!empty($scope['readonly'])) {
            throw new ForbiddenHttpException('Su alcance actual es de solo lectura.');
        }
    }

    private function assertModelScope(Contrato $model, $forWrite = false)
    {
        $scope = $this->getScopeContext();

        if ((int) $model->empresa_id !== (int) $scope['empresa_id']) {
            throw new ForbiddenHttpException('El contrato no pertenece al tenant actual.');
        }

        if (!$scope['full_access']) {
            if (!empty($scope['allowedSedeIds'])
                && !empty($model->sede_id)
                && !in_array((int) $model->sede_id, $scope['allowedSedeIds'], true)
            ) {
                throw new ForbiddenHttpException('La sede principal del contrato está fuera de su alcance.');
            }

            if (!empty($scope['allowedAreaIds'])
                && !empty($model->area_id)
                && !in_array((int) $model->area_id, $scope['allowedAreaIds'], true)
            ) {
                throw new ForbiddenHttpException('El área del contrato está fuera de su alcance.');
            }
        }

        if ($forWrite && !empty($scope['readonly'])) {
            throw new ForbiddenHttpException('Su alcance actual no permite edición.');
        }
    }

    private function applyScopeToQuery(ActiveQuery $query, array $scope)
    {
        if (empty($scope['full_access']) && !empty($scope['allowedSedeIds'])) {
            $query->andWhere(['contrato.sede_id' => $scope['allowedSedeIds']]);
        }

        if (empty($scope['full_access']) && !empty($scope['allowedAreaIds'])) {
            $query->andWhere(['contrato.area_id' => $scope['allowedAreaIds']]);
        }
    }
}
