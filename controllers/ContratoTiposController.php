<?php

namespace app\controllers;

use app\models\ContratoTipos;
use app\models\Profile;
use app\models\search\ContratoTiposSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * ContratoTiposController implements the CRUD actions for ContratoTipos model.
 */
class ContratoTiposController extends Controller
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
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ContratoTipos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContratoTiposSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false; // Cargar todos para DataTables client-side

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContratoTipos model.
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
     * Creates a new ContratoTipos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ContratoTipos();

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
     * Creates a new ContratoTipos via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new ContratoTipos();

        if ($model->load(Yii::$app->request->post())) {
            $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
            if ($profile) {
                $model->empresa_id = $profile->empresas_id;
            }
            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Tipo de contrato creado correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'empresa_id' => $model->empresa_id,
                        'code' => $model->code,
                        'nombre' => $model->nombre,
                        'descripcion' => $model->descripcion,
                        'requiere_fecha_fin' => $model->requiere_fecha_fin,
                        'es_indefinido' => $model->es_indefinido,
                        'duracion_dias_default' => $model->duracion_dias_default,
                        'activo' => $model->activo,
                    ],
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Updates an existing ContratoTipos model.
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
     * Deletes an existing ContratoTipos model.
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
     * Finds the ContratoTipos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return ContratoTipos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContratoTipos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
