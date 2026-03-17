<?php

namespace app\controllers;

use app\models\City;
use app\models\Empresas;
use app\models\LocationSedes;
use app\models\Profile;
use app\services\MallaTimesheetService;
use app\models\search\LocationSedesSearch;
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
        $searchModel = new LocationSedesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false; // Cargar todos para DataTables client-side

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
                $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
                if ($profile) {
                    $model->empresa_id = $profile->empresas_id;
                }
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
            $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
            if ($profile) {
                $model->empresa_id = $profile->empresas_id;
            }
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
            $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
            if (!$profile) {
                return ['success' => false, 'errors' => ['empresa_id' => ['El usuario no tiene perfil asociado a una empresa.']]];
            }
            $model->empresa_id = $profile->empresas_id;
            if (!Empresas::findOne($model->empresa_id)) {
                return ['success' => false, 'errors' => ['empresa_id' => ['La empresa seleccionada no existe en el sistema. Contacte al administrador.']]];
            }
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

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LocationSedes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
        if (($model = LocationSedes::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
