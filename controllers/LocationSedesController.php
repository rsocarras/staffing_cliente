<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\City;
use app\models\LocationSedes;
use app\services\MallaTimesheetService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * LocationSedesController implements the CRUD actions for LocationSedes model.
 */
class LocationSedesController extends Controller
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
                        'get-cities' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all LocationSedes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = LocationSedes::find();
        TenantContext::applyFilter($query, 'empresa_id');

        $total = (int) (clone $query)->count();
        $activos = (int) (clone $query)->andWhere(['activo' => 1])->count();
        $inactivos = (int) (clone $query)->andWhere(['activo' => 0])->count();

        return $this->render('index', [
            'total' => $total,
            'activos' => $activos,
            'inactivos' => $inactivos,
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
        $length = (int) $request->get('length', 25);
        $searchValue = trim((string) ($request->get('search', [])['value'] ?? ''));
        $orderCol = (int) (($request->get('order', [])[0]['column'] ?? 2));
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = LocationSedes::find()->alias('sede')->with(['city', 'city.country']);
        TenantContext::applyFilter($query, 'sede.empresa_id');

        $baseQuery = LocationSedes::find();
        TenantContext::applyFilter($baseQuery, 'empresa_id');
        $totalCount = (int) $baseQuery->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'sede.codigo', $searchValue],
                ['like', 'sede.nombre', $searchValue],
                ['like', 'sede.direccion', $searchValue],
                ['like', 'sede.codigo_externo', $searchValue],
                ['like', 'sede.tipo_sede', $searchValue],
                ['like', 'CAST(sede.max_horas_clases_grupales AS CHAR)', $searchValue],
                ['like', 'CAST(sede.valor_hora_diurna AS CHAR)', $searchValue],
                ['like', 'CAST(sede.valor_hora_diurna_domingo_festivos AS CHAR)', $searchValue],
                ['like', 'CAST(sede.valor_hora_nocturna AS CHAR)', $searchValue],
                ['like', 'CAST(sede.valor_hora_nocturna_domingo_festiva AS CHAR)', $searchValue],
                ['like', 'CAST(sede.valor_hora_especial AS CHAR)', $searchValue],
                ['like', 'CAST(sede.valor_movilizacion AS CHAR)', $searchValue],
            ]);
        }
        $filteredCount = (int) (clone $query)->count();

        $orderColumns = ['sede.id', 'sede.codigo', 'sede.nombre', 'sede.direccion', 'sede.tipo_sede', null, 'sede.activo', null];
        $orderBy = $orderColumns[$orderCol] ?? 'sede.nombre';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $data[] = [
                $model->id,
                \yii\helpers\Html::encode($model->codigo ?? '-'),
                '<span class="fw-medium text-dark">' . \yii\helpers\Html::encode($model->nombre) . '</span>',
                \yii\helpers\Html::encode($model->direccion ?? '-'),
                \yii\helpers\Html::encode($model->getTipoSedeLabel()),
                $model->city ? \yii\helpers\Html::encode($model->city->name) : '-',
                $model->activo
                    ? '<span class="badge badge-soft-success">Sí</span>'
                    : '<span class="badge badge-soft-danger">No</span>',
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
     * Displays a single LocationSedes model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $date = $this->request->get('date', date('Y-m-d'));
        $tab = $this->request->get('tab', 'day');
        $dayData = MallaTimesheetService::buildDay((int) $model->empresa_id, (int) $model->id, $date);
        $weekData = MallaTimesheetService::buildWeek((int) $model->empresa_id, (int) $model->id, $date);

        return $this->render('view', [
            'model' => $model,
            'date' => $date,
            'tab' => $tab,
            'dayData' => $dayData,
            'weekData' => $weekData,
        ]);
    }

    /**
     * Creates a new LocationSedes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LocationSedes();

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
     * Creates a new LocationSedes via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new LocationSedes();

        if ($model->load(Yii::$app->request->post())) {
            $model->empresa_id = TenantContext::requireEmpresaId();
            if ($model->save()) {
                $cityName = $model->city ? $model->city->name : null;
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Sede creada correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'codigo' => $model->codigo,
                        'nombre' => $model->nombre,
                        'direccion' => $model->direccion,
                        'tipo_sede' => $model->tipo_sede,
                        'tipo_sede_label' => $model->getTipoSedeLabel(),
                        'activo' => $model->activo,
                        'city_id' => $model->city_id,
                        'city_name' => $cityName,
                        'centro_costo' => $model->centro_costo,
                        'centro_costo_staffing' => $model->centro_costo_staffing,
                        'codigo_externo' => $model->codigo_externo,
                        'max_horas_clases_grupales' => $model->max_horas_clases_grupales,
                        'valor_hora_diurna' => $model->valor_hora_diurna,
                        'valor_hora_diurna_domingo_festivos' => $model->valor_hora_diurna_domingo_festivos,
                        'valor_hora_nocturna' => $model->valor_hora_nocturna,
                        'valor_hora_nocturna_domingo_festiva' => $model->valor_hora_nocturna_domingo_festiva,
                        'valor_hora_especial' => $model->valor_hora_especial,
                        'valor_movilizacion' => $model->valor_movilizacion,
                    ],
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Retorna ciudades por país (JSON). Para dropdown dependiente.
     * @param int $country_id
     * @return array
     */
    public function actionGetCities($country_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $cities = City::find()
            ->where(['country_id' => (int) $country_id])
            ->orderBy('name')
            ->all();
        return array_map(function ($c) {
            return ['id' => $c->id, 'name' => $c->name];
        }, $cities);
    }

    /**
     * Updates an existing LocationSedes model.
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
     * Deletes an existing LocationSedes model.
     * @param string $id ID
     * @return \yii\web\Response|array
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
        $date = $this->request->get('date', date('Y-m-d'));
        $tab = $this->request->get('tab', 'day');
        $dayData = MallaTimesheetService::buildDay((int) $model->empresa_id, (int) $model->id, $date);
        $weekData = MallaTimesheetService::buildWeek((int) $model->empresa_id, (int) $model->id, $date);

        return $this->renderPartial('_view_modal', [
            'model' => $model,
            'date' => $date,
            'tab' => $tab,
            'dayData' => $dayData,
            'weekData' => $weekData,
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
        $countries = \yii\helpers\ArrayHelper::map(
            \app\models\LocationCountry::find()->where(['is_active' => 1])->orderBy('name')->all(),
            'id',
            'name'
        );
        $initialCountryId = $model->city ? $model->city->country_id : null;
        $initialCities = [];
        if ($initialCountryId) {
            $initialCities = \yii\helpers\ArrayHelper::map(
                City::find()->where(['country_id' => $initialCountryId])->orderBy('name')->all(),
                'id',
                'name'
            );
        }

        return $this->renderPartial('_form_modal', [
            'model' => $model,
            'countries' => $countries,
            'initialCountryId' => $initialCountryId,
            'initialCities' => $initialCities,
        ]);
    }

    /**
     * Updates a LocationSedes via AJAX. Returns JSON.
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
                $cityName = $model->city ? $model->city->name : null;
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Sede actualizada correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'codigo' => $model->codigo,
                        'nombre' => $model->nombre,
                        'direccion' => $model->direccion,
                        'tipo_sede' => $model->tipo_sede,
                        'tipo_sede_label' => $model->getTipoSedeLabel(),
                        'activo' => $model->activo,
                        'city_id' => $model->city_id,
                        'city_name' => $cityName,
                        'centro_costo' => $model->centro_costo,
                        'centro_costo_staffing' => $model->centro_costo_staffing,
                        'codigo_externo' => $model->codigo_externo,
                        'max_horas_clases_grupales' => $model->max_horas_clases_grupales,
                        'valor_hora_diurna' => $model->valor_hora_diurna,
                        'valor_hora_diurna_domingo_festivos' => $model->valor_hora_diurna_domingo_festivos,
                        'valor_hora_nocturna' => $model->valor_hora_nocturna,
                        'valor_hora_nocturna_domingo_festiva' => $model->valor_hora_nocturna_domingo_festiva,
                        'valor_hora_especial' => $model->valor_hora_especial,
                        'valor_movilizacion' => $model->valor_movilizacion,
                    ],
                ];
            }
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Finds the LocationSedes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return LocationSedes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LocationSedes::findOne(['id' => $id, 'empresa_id' => TenantContext::requireEmpresaId()])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
