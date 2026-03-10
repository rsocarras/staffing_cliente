<?php

namespace app\controllers;

use app\models\StaffingPlanta;
use app\models\search\AdministracionPlantaDashboardSearch;
use app\models\search\StaffingPlantaSearch;
use app\services\AdministracionPlantaService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AdministracionPlantaController extends Controller
{
    /** @var AdministracionPlantaService */
    private $service;

    public function __construct($id, $module, $config = [])
    {
        $this->service = new AdministracionPlantaService();
        parent::__construct($id, $module, $config);
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'sub-areas' => ['GET'],
                    'cargos-por-estructura' => ['GET'],
                    'export' => ['GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['administracion_planta_dashboard', 'administracion_planta_view', 'admin', 'administrator'],
                        'actions' => ['dashboard', 'resumen-sede', 'resumen-area', 'index', 'view', 'historial', 'sub-areas', 'cargos-por-estructura'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['administracion_planta_manage', 'admin', 'administrator'],
                        'actions' => ['create', 'update'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['administracion_planta_export', 'admin', 'administrator'],
                        'actions' => ['export'],
                    ],
                ],
            ],
        ]);
    }

    public function actionDashboard()
    {
        $this->service->ensureViewAccess();
        $searchModel = $this->buildDashboardSearch();
        $dashboard = $this->service->getDashboardData($searchModel);

        return $this->render('dashboard', [
            'searchModel' => $searchModel,
            'dashboard' => $dashboard,
            'filterOptions' => $this->service->getFilterOptions($searchModel),
            'scope' => $this->service->getScopeContext(),
            'activeTab' => 'dashboard',
        ]);
    }

    public function actionResumenSede()
    {
        $this->service->ensureViewAccess();
        $searchModel = $this->buildDashboardSearch();
        $dashboard = $this->service->getDashboardData($searchModel);

        return $this->render('resumen-sede', [
            'searchModel' => $searchModel,
            'rows' => $dashboard['resumenSede'],
            'dashboard' => $dashboard,
            'filterOptions' => $this->service->getFilterOptions($searchModel),
            'scope' => $this->service->getScopeContext(),
            'activeTab' => 'resumen-sede',
        ]);
    }

    public function actionResumenArea()
    {
        $this->service->ensureViewAccess();
        $searchModel = $this->buildDashboardSearch();
        $dashboard = $this->service->getDashboardData($searchModel);

        return $this->render('resumen-area', [
            'searchModel' => $searchModel,
            'rows' => $dashboard['resumenArea'],
            'dashboard' => $dashboard,
            'filterOptions' => $this->service->getFilterOptions($searchModel),
            'scope' => $this->service->getScopeContext(),
            'activeTab' => 'resumen-area',
        ]);
    }

    public function actionIndex()
    {
        $this->service->ensureViewAccess();

        $searchModel = new StaffingPlantaSearch();
        $searchParams = Yii::$app->request->queryParams;
        if (!isset($searchParams[$searchModel->formName()]['activo'])) {
            $searchModel->activo = 1;
        }
        $searchModel->empresa_id = $this->service->getCurrentEmpresaId();
        $dataProvider = $this->service->buildPlantaDataProvider($searchModel, $searchParams);

        $filterState = new AdministracionPlantaDashboardSearch();
        $filterState->area_id = $searchModel->area_id;
        $filterState->sub_area_id = $searchModel->sub_area_id;
        $filterState->city_id = $searchModel->city_id;
        $filterState->region_id = $searchModel->region_id;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filterOptions' => $this->service->getFilterOptions($filterState),
            'scope' => $this->service->getScopeContext(),
            'activeTab' => 'index',
        ]);
    }

    public function actionView($id)
    {
        $this->service->ensureViewAccess();
        $model = $this->findModel($id);
        $this->service->assertModelScope($model);

        return $this->render('view', [
            'model' => $model,
            'scope' => $this->service->getScopeContext(),
            'activeTab' => 'index',
        ]);
    }

    public function actionCreate()
    {
        $this->service->ensureManageAccess();
        $model = new StaffingPlanta();
        $model->empresa_id = $this->service->getCurrentEmpresaId();
        $model->activo = 1;
        $filterOptions = $this->service->getFilterOptions();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->empresa_id = $this->service->getCurrentEmpresaId();
            $this->service->assertModelScope($model, true);

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Registro de planta creado correctamente.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'scope' => $this->service->getScopeContext(),
            'activeTab' => 'index',
            'sedes' => $filterOptions['sedes'],
            'areas' => $filterOptions['areas'],
            'subAreas' => $model->area_id ? $this->service->getSubAreaOptions($model->area_id, $model->empresa_id) : [],
            'cargos' => $this->service->getCargoOptions($model->empresa_id, $model->area_id, $model->sub_area_id),
        ]);
    }

    public function actionUpdate($id)
    {
        $this->service->ensureManageAccess();
        $model = $this->findModel($id);
        $this->service->assertModelScope($model, true);
        $filterOptions = $this->service->getFilterOptions();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->empresa_id = $this->service->getCurrentEmpresaId();
            $this->service->assertModelScope($model, true);

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Registro de planta actualizado correctamente.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'scope' => $this->service->getScopeContext(),
            'activeTab' => 'index',
            'sedes' => $filterOptions['sedes'],
            'areas' => $filterOptions['areas'],
            'subAreas' => $model->area_id ? $this->service->getSubAreaOptions($model->area_id, $model->empresa_id) : [],
            'cargos' => $this->service->getCargoOptions($model->empresa_id, $model->area_id, $model->sub_area_id),
        ]);
    }

    public function actionHistorial()
    {
        $this->service->ensureHistoryAccess();
        $searchModel = $this->buildDashboardSearch();
        $dataProvider = $this->service->buildHistoryDataProvider(Yii::$app->request->queryParams);

        return $this->render('historial', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'filterOptions' => $this->service->getFilterOptions($searchModel),
            'scope' => $this->service->getScopeContext(),
            'activeTab' => 'historial',
        ]);
    }

    public function actionSubAreas($area_id)
    {
        $this->service->ensureViewAccess();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rows = $this->service->getSubAreaOptions((int) $area_id, $this->service->getCurrentEmpresaId());

        return array_map(function ($row) {
            return [
                'id' => $row->id,
                'nombre' => $row->nombre,
            ];
        }, $rows);
    }

    public function actionCargosPorEstructura($area_id = null, $sub_area_id = null)
    {
        $this->service->ensureViewAccess();
        Yii::$app->response->format = Response::FORMAT_JSON;

        $rows = $this->service->getCargoOptions(
            $this->service->getCurrentEmpresaId(),
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

    public function actionExport($scope = 'resumen-sede', $format = 'excel')
    {
        $this->service->ensureExportAccess();

        $payload = $this->buildExportPayload($scope);
        $filename = 'administracion-planta-' . $scope . '-' . date('Ymd-His');

        if ($format === 'excel') {
            Yii::$app->response->format = Response::FORMAT_RAW;
            Yii::$app->response->headers->set('Content-Type', 'application/vnd.ms-excel; charset=UTF-8');
            Yii::$app->response->headers->set('Content-Disposition', 'attachment; filename="' . $filename . '.xls"');

            return $this->renderPartial('_export_table', [
                'title' => $payload['title'],
                'columns' => $payload['columns'],
                'rows' => $payload['rows'],
                'printMode' => false,
            ]);
        }

        Yii::$app->response->format = Response::FORMAT_RAW;
        return $this->renderPartial('_export_table', [
            'title' => $payload['title'],
            'columns' => $payload['columns'],
            'rows' => $payload['rows'],
            'printMode' => true,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = StaffingPlanta::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('El registro solicitado no existe.');
    }

    private function buildDashboardSearch()
    {
        $searchModel = new AdministracionPlantaDashboardSearch();
        $searchModel->empresa_id = $this->service->getCurrentEmpresaId();
        $searchModel->load(Yii::$app->request->queryParams);

        if (empty($searchModel->modo_ocupacion)) {
            $searchModel->modo_ocupacion = AdministracionPlantaService::MODO_PONDERADO;
        }

        return $searchModel;
    }

    private function buildExportPayload($scope)
    {
        if ($scope === 'planta') {
            $searchModel = new StaffingPlantaSearch();
            $searchModel->empresa_id = $this->service->getCurrentEmpresaId();
            $searchParams = Yii::$app->request->queryParams;
            if (!isset($searchParams[$searchModel->formName()]['activo'])) {
                $searchModel->activo = 1;
            }
            $provider = $this->service->buildPlantaDataProvider($searchModel, $searchParams);
            $models = $provider->query->all();

            return [
                'title' => 'Administración de planta',
                'columns' => [
                    'sede' => 'Sede',
                    'tipo_sede' => 'Tipo sede',
                    'area' => 'Área',
                    'sub_area' => 'Subárea',
                    'cargo' => 'Cargo',
                    'cantidad_autorizada' => 'Planta autorizada',
                    'activo' => 'Activo',
                        'updated_at' => 'Actualizado',
                    ],
                'rows' => array_map(function (StaffingPlanta $item) {
                    return [
                        'sede' => $item->locationSede ? $item->locationSede->nombre : '-',
                        'tipo_sede' => $item->locationSede ? $item->locationSede->getTipoSedeLabel() : '-',
                        'area' => $item->area ? $item->area->nombre : '-',
                        'sub_area' => $item->subArea ? $item->subArea->nombre : '-',
                        'cargo' => $item->cargo ? $item->cargo->nombre : '-',
                        'cantidad_autorizada' => $item->cantidad_autorizada,
                        'activo' => (int) $item->activo === 1 ? 'Sí' : 'No',
                        'updated_at' => $item->updated_at,
                    ];
                }, $models),
            ];
        }

        if ($scope === 'historial') {
            $searchModel = $this->buildDashboardSearch();
            $provider = $this->service->buildHistoryDataProvider(Yii::$app->request->queryParams);
            $models = $provider->query->all();

            return [
                'title' => 'Historial de planta',
                'columns' => [
                    'dimension' => 'Registro',
                    'campo' => 'Campo',
                    'accion' => 'Acción',
                    'valor_anterior' => 'Valor anterior',
                    'valor_nuevo' => 'Valor nuevo',
                    'usuario' => 'Usuario',
                    'created_at' => 'Fecha',
                ],
                'rows' => array_map(function ($item) {
                    return [
                        'dimension' => $item->planta ? $item->planta->getDimensionLabel() : '#'.$item->planta_id,
                        'campo' => $item->campo,
                        'accion' => $item->accion,
                        'valor_anterior' => $item->valor_anterior,
                        'valor_nuevo' => $item->valor_nuevo,
                        'usuario' => $item->user ? $item->user->username : '-',
                        'created_at' => $item->created_at,
                    ];
                }, $models),
            ];
        }

        return $this->service->getExportPayload($scope, $this->buildDashboardSearch());
    }
}
