<?php

namespace app\controllers;

use app\models\NovedadTipo;
use app\models\search\NovedadTipoSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * NovedadTipoController implements the CRUD actions for NovedadTipo model.
 */
class NovedadTipoController extends Controller
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
     * Lists all NovedadTipo models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NovedadTipoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false; // Cargar todos para DataTables client-side

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NovedadTipo model.
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
     * Creates a new NovedadTipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new NovedadTipo();
        $empresaId = $this->currentEmpresaId();
        if ($empresaId !== null) {
            $this->assignEmpresaToModel($model, $empresaId);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($empresaId === null || !$this->assignEmpresaToModel($model, $empresaId)) {
                    $model->addError('id', 'No se pudo resolver la empresa de la sesión.');
                }
                if ($model->save()) {
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
     * Creates a new NovedadTipo via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new NovedadTipo();
        $empresaId = $this->currentEmpresaId();

        if ($model->load(Yii::$app->request->post())) {
            if ($empresaId === null || !$this->assignEmpresaToModel($model, $empresaId)) {
                return ['success' => false, 'errors' => ['empresa_id' => ['No se pudo resolver empresas_id desde la sesión del usuario.']]];
            }
            if ($model->orden === null || $model->orden === '') {
                $model->orden = 0;
            }
            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Tipo de novedad creado correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'nombre' => $model->nombre,
                        'descripcion' => $model->descripcion,
                        'icono' => $model->icono,
                        'orden' => $model->orden,
                        'activo' => $model->activo,
                    ],
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Updates an existing NovedadTipo model.
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
     * Deletes an existing NovedadTipo model.
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
     * Finds the NovedadTipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return NovedadTipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        $model = NovedadTipo::findOne(['id' => $id]);
        if ($model !== null) {
            $empresaId = $this->currentEmpresaId();
            if ($empresaId !== null) {
                $empresaColumn = $model->hasAttribute('empresa_id')
                    ? 'empresa_id'
                    : ($model->hasAttribute('empresas_id') ? 'empresas_id' : null);
                if ($empresaColumn === null || (int) $model->getAttribute($empresaColumn) !== $empresaId) {
                    throw new NotFoundHttpException('The requested page does not exist.');
                }
            }
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function currentEmpresaId(): ?int
    {
        $empresaId = Yii::$app->user->empresas_id ?? null;
        if ($empresaId === null || !is_numeric($empresaId) || (int) $empresaId <= 0) {
            return null;
        }
        return (int) $empresaId;
    }

    private function assignEmpresaToModel(NovedadTipo $model, int $empresaId): bool
    {
        if ($model->hasAttribute('empresa_id')) {
            $model->setAttribute('empresa_id', $empresaId);
            return true;
        }
        if ($model->hasAttribute('empresas_id')) {
            $model->setAttribute('empresas_id', $empresaId);
            return true;
        }
        return false;
    }
}
