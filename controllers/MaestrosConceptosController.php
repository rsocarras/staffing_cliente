<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\MaestrosConceptos;
use app\models\search\MaestrosConceptosSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * MaestrosConceptosController implements the CRUD actions for MaestrosConceptos model.
 */
class MaestrosConceptosController extends Controller
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
     * Lists all MaestrosConceptos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MaestrosConceptosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false; // Cargar todos para DataTables client-side

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MaestrosConceptos model.
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
     * Creates a new MaestrosConceptos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MaestrosConceptos();

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
     * Creates a new MaestrosConceptos via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new MaestrosConceptos();

        if ($model->load(Yii::$app->request->post())) {
            $model->empresa_id = TenantContext::requireEmpresaId();
            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Concepto creado correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'code' => $model->code,
                        'name' => $model->name,
                        'category' => $model->category,
                        'active' => $model->active,
                    ],
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Updates an existing MaestrosConceptos model.
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
     * Deletes an existing MaestrosConceptos model.
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
     * Finds the MaestrosConceptos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return MaestrosConceptos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MaestrosConceptos::findOne(['id' => $id, 'empresa_id' => TenantContext::requireEmpresaId()])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
