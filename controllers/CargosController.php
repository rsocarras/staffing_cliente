<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Area;
use app\models\Cargos;
use app\models\NovedadConceptoCargo;
use app\models\search\CargosSearch;
use app\services\AdministracionPlantaService;
use app\services\CargoNovedadConceptoService;
use Throwable;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * CargosController implements the CRUD actions for Cargos model.
 */
class CargosController extends Controller
{
    /**
     * @inheritDoc
     */
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
                        'get-sub-areas' => ['GET'],
                        'ajax-conceptos-cargo-html' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Cargos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $empresaId = TenantContext::requireEmpresaId();
        $conceptosPorAgrupador = CargoNovedadConceptoService::conceptosAgrupadosPorTipoParaEmpresa($empresaId);
        $baseQuery = Cargos::find()->alias('cargos');
        TenantContext::applyFilter($baseQuery, 'cargos.empresa_id');
        $summaryCounts = [
            'total' => (int) (clone $baseQuery)->count(),
            'activos' => (int) (clone $baseQuery)->andWhere(['cargos.activo' => 1])->count(),
            'inactivos' => (int) (clone $baseQuery)->andWhere(['cargos.activo' => 0])->count(),
        ];

        return $this->render('index', [
            'summaryCounts' => $summaryCounts,
            'conceptosPorAgrupador' => $conceptosPorAgrupador,
            'urlAjaxConceptosCargoHtml' => Url::to(['/cargos/ajax-conceptos-cargo-html']),
            'cargoAccordionSuffixNew' => 'new',
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
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 4);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = Cargos::find()->alias('cargos')->joinWith(['area', 'subArea']);
        TenantContext::applyFilter($query, 'cargos.empresa_id');
        $totalCount = (int) (clone $query)->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'cargos.codigo', $searchValue],
                ['like', 'cargos.nombre', $searchValue],
                ['like', 'cargos.descripcion', $searchValue],
                ['like', 'area.nombre', $searchValue],
                ['like', 'subArea.nombre', $searchValue],
            ]);
        }
        $filteredCount = (int) (clone $query)->count();

        $orderColumns = ['cargos.id', 'area.nombre', 'subArea.nombre', 'cargos.codigo', 'cargos.nombre', 'cargos.descripcion', null, null];
        $orderBy = $orderColumns[$orderCol] ?? 'cargos.nombre';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $data[] = [
                $model->id,
                $model->area ? \yii\helpers\Html::encode($model->area->nombre) : '-',
                $model->subArea ? \yii\helpers\Html::encode($model->subArea->nombre) : '-',
                \yii\helpers\Html::encode($model->codigo ?? '-'),
                '<span class="fw-medium text-dark">' . \yii\helpers\Html::encode($model->nombre) . '</span>',
                \yii\helpers\Html::encode($model->descripcion ?? '-'),
                $model->activo ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-danger">No</span>',
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

    /**
     * Displays a single Cargos model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cargos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cargos();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->empresa_id = TenantContext::requireEmpresaId();
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
            $model->empresa_id = TenantContext::requireEmpresaId();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Cargos via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Cargos();

        if ($model->load(Yii::$app->request->post())) {
            $model->empresa_id = TenantContext::requireEmpresaId();
            $this->filtrarConceptosPermitidosCargo($model);
            if ($this->guardarCargoConConceptos($model)) {
                $areaNombre = $model->area ? $model->area->nombre : null;
                $subAreaNombre = $model->subArea ? $model->subArea->nombre : null;
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Cargo creado correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'codigo' => $model->codigo,
                        'nombre' => $model->nombre,
                        'descripcion' => $model->descripcion,
                        'activo' => $model->activo,
                        'area_id' => $model->area_id,
                        'sub_area_id' => $model->sub_area_id,
                        'area_nombre' => $areaNombre,
                        'sub_area_nombre' => $subAreaNombre,
                    ],
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Retorna sub-áreas por área (JSON). Misma lógica que contratos (getSubAreaOptions).
     */
    /**
     * HTML del bloque de conceptos por cargo (AJAX; mismo criterio que staffing_admin).
     */
    public function actionAjaxConceptosCargoHtml(int $empresa_id = 0, int $cargo_id = 0): string
    {
        $this->layout = false;
        $eid = $empresa_id > 0 ? $empresa_id : (int) TenantContext::requireEmpresaId();
        $allowedSet = array_fill_keys(CargoNovedadConceptoService::idsConceptosAsignadosOrganizacion($eid), true);
        $selected = [];
        if ($cargo_id > 0) {
            $selected = array_map(
                'intval',
                NovedadConceptoCargo::find()
                    ->select('novedad_concepto_id')
                    ->where(['cargo_id' => $cargo_id])
                    ->column()
            );
            $selected = array_values(array_filter($selected, static function (int $cid) use ($allowedSet): bool {
                return $cid > 0 && isset($allowedSet[$cid]);
            }));
        }
        $groups = CargoNovedadConceptoService::conceptosAgrupadosPorTipoParaEmpresa($eid);

        return $this->renderPartial('_conceptos_cargo', [
            'conceptosPorAgrupador' => $groups,
            'selectedIds' => $selected,
            'formFieldPrefix' => 'Cargos',
            'accordionSuffix' => $cargo_id > 0 ? (string) $cargo_id : 'new',
        ]);
    }

    public function actionGetSubAreas()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $raw = Yii::$app->request->get('area_id');
        if ($raw === null || $raw === '') {
            return [];
        }
        $service = new AdministracionPlantaService();
        $rows = $service->getSubAreaOptions((int) $raw, TenantContext::requireEmpresaId());

        return array_map(function ($a) {
            return [
                'id' => (int) $a->id,
                'nombre' => (string) ($a->nombre ?? ''),
            ];
        }, $rows);
    }

    /**
     * Updates an existing Cargos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->empresa_id = TenantContext::requireEmpresaId();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cargos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->redirect(['index']);
    }

    /**
     * Returns HTML for view modal (AJAX).
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewAjax($id)
    {
        $model = $this->findModel($id);
        $model->novedadConceptoIds = array_map(
            'intval',
            NovedadConceptoCargo::find()
                ->select('novedad_concepto_id')
                ->where(['cargo_id' => $model->id])
                ->column()
        );
        $conceptosOpts = $this->opcionesConceptosCargoForm($model);

        return $this->renderPartial('_view_modal', [
            'model' => $model,
            'conceptosPorAgrupador' => $conceptosOpts['conceptosPorAgrupador'],
            'selectedIdsConceptosCargo' => $conceptosOpts['selectedIdsConceptosCargo'],
        ]);
    }

    /**
     * Returns HTML for edit form modal (AJAX).
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionFormAjax($id)
    {
        $model = $this->findModel($id);
        $empresaId = TenantContext::requireEmpresaId();
        if (!Yii::$app->request->isPost) {
            $model->novedadConceptoIds = array_map(
                'intval',
                NovedadConceptoCargo::find()
                    ->select('novedad_concepto_id')
                    ->where(['cargo_id' => $model->id])
                    ->column()
            );
        }
        $service = new AdministracionPlantaService();
        $areasList = ArrayHelper::map(
            Area::find()
                ->where(['empresas_id' => $empresaId])
                ->orderBy(['nombre' => SORT_ASC])
                ->all(),
            'id',
            'nombre'
        );
        $subAreasList = $model->area_id
            ? ArrayHelper::map(
                $service->getSubAreaOptions((int) $model->area_id, $empresaId),
                'id',
                'nombre'
            )
            : [];

        $conceptosOpts = $this->opcionesConceptosCargoForm($model);

        return $this->renderPartial('_form_modal', [
            'model' => $model,
            'areasList' => $areasList,
            'subAreasList' => $subAreasList,
        ] + $conceptosOpts);
    }

    /**
     * Updates Cargos via AJAX. Returns JSON.
     * @param string $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->empresa_id = TenantContext::requireEmpresaId();
            $this->filtrarConceptosPermitidosCargo($model);
            if ($this->guardarCargoConConceptos($model)) {
                $areaNombre = $model->area ? $model->area->nombre : null;
                $subAreaNombre = $model->subArea ? $model->subArea->nombre : null;
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Cargo actualizado correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'codigo' => $model->codigo,
                        'nombre' => $model->nombre,
                        'descripcion' => $model->descripcion,
                        'activo' => $model->activo,
                        'area_id' => $model->area_id,
                        'sub_area_id' => $model->sub_area_id,
                        'area_nombre' => $areaNombre,
                        'sub_area_nombre' => $subAreaNombre,
                    ],
                ];
            }
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Finds the Cargos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Cargos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cargos::findOne(['id' => $id, 'empresa_id' => TenantContext::requireEmpresaId()])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return array{
     *     conceptosPorAgrupador: list<array{tipo: \app\models\NovedadTipo, conceptos: list<\app\models\NovedadConcepto>}>,
     *     selectedIdsConceptosCargo: int[],
     *     cargoAccordionSuffix: string,
     *     urlAjaxConceptosCargoHtml: string
     * }
     */
    private function opcionesConceptosCargoForm(Cargos $model): array
    {
        $eid = (int) $model->empresa_id;
        $conceptosPorAgrupador = CargoNovedadConceptoService::conceptosAgrupadosPorTipoParaEmpresa($eid);
        $allowedSet = array_fill_keys(CargoNovedadConceptoService::idsConceptosAsignadosOrganizacion($eid), true);
        $selectedIdsConceptosCargo = array_values(array_filter(
            array_map('intval', $model->novedadConceptoIds),
            static fn (int $cid): bool => $cid > 0 && isset($allowedSet[$cid])
        ));
        $model->novedadConceptoIds = $selectedIdsConceptosCargo;

        return [
            'conceptosPorAgrupador' => $conceptosPorAgrupador,
            'selectedIdsConceptosCargo' => $selectedIdsConceptosCargo,
            'cargoAccordionSuffix' => $model->isNewRecord ? 'new' : (string) (int) $model->id,
            'urlAjaxConceptosCargoHtml' => Url::to(['/cargos/ajax-conceptos-cargo-html']),
        ];
    }

    private function filtrarConceptosPermitidosCargo(Cargos $model): void
    {
        $eid = (int) $model->empresa_id;
        $allowedSet = array_fill_keys(CargoNovedadConceptoService::idsConceptosAsignadosOrganizacion($eid), true);
        $model->novedadConceptoIds = array_values(array_filter(
            array_map('intval', $model->novedadConceptoIds),
            static fn (int $cid): bool => $cid > 0 && isset($allowedSet[$cid])
        ));
    }

    private function guardarCargoConConceptos(Cargos $model): bool
    {
        if (!$model->validate()) {
            return false;
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            if (!$model->save(false)) {
                $tx->rollBack();

                return false;
            }
            CargoNovedadConceptoService::sync($model, $model->novedadConceptoIds);
            $tx->commit();
        } catch (Throwable $e) {
            if ($tx->isActive) {
                $tx->rollBack();
            }
            Yii::error($e, __METHOD__);
            throw $e;
        }

        return true;
    }
}
