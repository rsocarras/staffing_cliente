<?php

namespace app\controllers;

use app\models\Area;
use app\models\Profile;
use app\models\search\AreaSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * AreaController implements the CRUD actions for Area model.
 */
class AreaController extends Controller
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
     * Lists all Area models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AreaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false; // Cargar todos para DataTables client-side

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Area model.
     * @param int $id ID
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
     * Creates a new Area model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Area();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
                $model->user_create = Yii::$app->user->id;
                $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
                if ($profile) {
                    $model->empresas_id = $profile->empresas_id;
                } else {
                    $model->addError('empresas_id', 'El usuario no tiene perfil asociado a una empresa.');
                }
                if (!$model->hasErrors() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Area via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Area();

        if ($model->load(Yii::$app->request->post())) {
            $model->uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
            $model->user_create = Yii::$app->user->id;
            $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
            if ($profile) {
                $model->empresas_id = $profile->empresas_id;
            } else {
                return ['success' => false, 'errors' => ['empresas_id' => ['El usuario no tiene perfil asociado a una empresa.']]];
            }
            if ($model->save()) {
                $areaPadreNombre = $model->areaPadre ? $model->areaPadre->nombre : null;
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Area creada correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'nombre' => $model->nombre,
                        'descripcion' => $model->descripcion,
                        'area_padre' => $model->area_padre,
                        'area_padre_nombre' => $areaPadreNombre,
                        'centro_utilidad' => $model->centro_utilidad,
                        'referencia_externa' => $model->referencia_externa,
                        'centro_utilidad_staffing' => $model->centro_utilidad_staffing,
                    ],
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Updates an existing Area model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
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
     * Deletes an existing Area model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Area model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Area the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Area::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
