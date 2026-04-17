<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Cargos;
use app\models\City;
use app\models\LocationSedeCargoTarifa;
use app\models\LocationSedes;
use app\services\MallaTimesheetService;
use Yii;
use yii\helpers\ArrayHelper;
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
                        'tarifas' => ['GET', 'POST'],
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
        $cities = City::sortRowsWithPriority(
            City::find()
                ->where(['country_id' => (int) $country_id])
                ->orderBy('name')
                ->all()
        );
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
            'cargoTarifaRows' => LocationSedeCargoTarifa::find()
                ->where(['location_sede_id' => (int) $model->id])
                ->with(['cargo'])
                ->orderBy(['cargo_id' => SORT_ASC])
                ->all(),
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
            $initialCities = City::sortMapWithPriority(\yii\helpers\ArrayHelper::map(
                City::find()->where(['country_id' => $initialCountryId])->orderBy('name')->all(),
                'id',
                'name'
            ));
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

    /**
     * Tarifas por cargo para una sede (pantalla dedicada).
     *
     * @param string $id
     * @return Response|string
     * @throws NotFoundHttpException
     */
    public function actionTarifas($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            $this->persistCargoTarifas(
                (int) $model->id,
                (int) $model->empresa_id,
                (array) Yii::$app->request->post('CargoTarifa', [])
            );
            Yii::$app->session->setFlash('success', Yii::t('app', 'Tarifas guardadas.'));

            return $this->redirect(['tarifas', 'id' => $model->id]);
        }

        return $this->render('tarifas', [
            'model' => $model,
            'cargoOptions' => $this->cargoOptionsForEmpresa((int) $model->empresa_id),
            'cargoTarifaValues' => $this->cargoTariffValuesForSede($model),
        ]);
    }

    /**
     * @param array<int|string, array<string, mixed>> $post
     */
    protected function persistCargoTarifas(int $sedeId, int $empresaId, array $post): void
    {
        if ($sedeId < 1 || $empresaId < 1) {
            return;
        }

        $cargoIds = Cargos::find()
            ->select('id')
            ->where(['empresa_id' => $empresaId, 'activo' => 1])
            ->column();
        if ($cargoIds === []) {
            return;
        }

        LocationSedeCargoTarifa::deleteAll(['location_sede_id' => $sedeId]);
        $fields = LocationSedeCargoTarifa::tariffColumnNames();
        foreach ($cargoIds as $cargoId) {
            $cargoId = (int) $cargoId;
            $p = $post[$cargoId] ?? $post[(string) $cargoId] ?? [];
            $row = ['location_sede_id' => $sedeId, 'cargo_id' => $cargoId];
            foreach ($fields as $f) {
                $v = $p[$f] ?? null;
                $row[$f] = LocationSedeCargoTarifa::normalizeAmountInput($v);
            }
            Yii::$app->db->createCommand()->insert(LocationSedeCargoTarifa::tableName(), $row)->execute();
        }
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function cargoTariffValuesForSede(LocationSedes $model): array
    {
        if ($model->isNewRecord) {
            return [];
        }
        $rows = LocationSedeCargoTarifa::find()
            ->where(['location_sede_id' => (int) $model->id])
            ->asArray()
            ->all();
        $out = [];
        foreach ($rows as $r) {
            $cid = (int) $r['cargo_id'];
            $out[$cid] = [];
            foreach (LocationSedeCargoTarifa::tariffColumnNames() as $f) {
                $out[$cid][$f] = $r[$f] ?? null;
            }
        }

        return $out;
    }

    /**
     * @return array<int, string>
     */
    protected function cargoOptionsForEmpresa(int $empresaId): array
    {
        if ($empresaId < 1) {
            return [];
        }

        return ArrayHelper::map(
            Cargos::find()
                ->where(['empresa_id' => $empresaId, 'activo' => 1])
                ->orderBy(['nombre' => SORT_ASC, 'id' => SORT_ASC])
                ->all(),
            'id',
            static fn(Cargos $c) => trim((string) $c->nombre)
        );
    }
}
