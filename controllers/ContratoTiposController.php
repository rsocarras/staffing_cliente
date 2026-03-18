<?php

namespace app\controllers;

use app\models\ContratoTipos;
use app\models\Profile;
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
                        'update-ajax' => ['POST'],
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
        $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
        $empresaId = $profile ? $profile->empresas_id : null;

        $query = ContratoTipos::find();
        if ($empresaId) {
            $query->andWhere(['or', ['empresa_id' => $empresaId], ['empresa_id' => null]]);
        }

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

        $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
        $empresaId = $profile ? $profile->empresas_id : null;

        $request = Yii::$app->request;
        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 25);
        $searchValue = trim((string) ($request->get('search', [])['value'] ?? ''));
        $orderCol = (int) (($request->get('order', [])[0]['column'] ?? 3));
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = ContratoTipos::find();
        if ($empresaId) {
            $query->andWhere(['or', ['empresa_id' => $empresaId], ['empresa_id' => null]]);
        }

        $baseQuery = ContratoTipos::find();
        if ($empresaId) {
            $baseQuery->andWhere(['or', ['empresa_id' => $empresaId], ['empresa_id' => null]]);
        }
        $totalCount = (int) $baseQuery->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'code', $searchValue],
                ['like', 'nombre', $searchValue],
                ['like', 'descripcion', $searchValue],
            ]);
        }
        $filteredCount = (int) (clone $query)->count();

        $orderColumns = ['id', 'empresa_id', 'code', 'nombre', 'descripcion', 'activo', null];
        $orderBy = $orderColumns[$orderCol] ?? 'nombre';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $data[] = [
                $model->id,
                $model->empresa_id !== null ? $model->empresa_id : '-',
                \yii\helpers\Html::encode($model->code),
                '<span class="fw-medium text-dark">' . \yii\helpers\Html::encode($model->nombre) . '</span>',
                \yii\helpers\Html::encode($model->descripcion ?? '-'),
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
        return $this->renderPartial('_form_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates a ContratoTipos via AJAX. Returns JSON.
     * @param string $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'message' => Yii::t('app', 'Tipo de contrato actualizado correctamente.'),
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
