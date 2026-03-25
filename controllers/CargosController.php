<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Area;
use app\models\Cargos;
use app\models\search\CargosSearch;
use app\services\AdministracionPlantaService;
use Yii;
use yii\helpers\ArrayHelper;
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
        $baseQuery = Cargos::find()->alias('cargos');
        TenantContext::applyFilter($baseQuery, 'cargos.empresa_id');
        $summaryCounts = [
            'total' => (int) (clone $baseQuery)->count(),
            'activos' => (int) (clone $baseQuery)->andWhere(['cargos.activo' => 1])->count(),
            'inactivos' => (int) (clone $baseQuery)->andWhere(['cargos.activo' => 0])->count(),
        ];

        return $this->render('index', ['summaryCounts' => $summaryCounts]);
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
            if ($model->save()) {
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
        return $this->renderPartial('_view_modal', [
            'model' => $this->findModel($id),
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

        return $this->renderPartial('_form_modal', [
            'model' => $model,
            'areasList' => $areasList,
            'subAreasList' => $subAreasList,
        ]);
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
            if ($model->save()) {
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
}
