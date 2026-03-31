<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\Area;
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
                        'update-ajax' => ['POST'],
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
        $baseQuery = Area::find()->alias('area');
        TenantContext::applyFilter($baseQuery, 'area.empresas_id');
        $summaryCounts = [
            'total' => (int) (clone $baseQuery)->count(),
            'raices' => (int) (clone $baseQuery)->andWhere(['area.area_padre' => null])->count(),
            'subareas' => (int) (clone $baseQuery)->andWhere(['not', ['area.area_padre' => null]])->count(),
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
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 1);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = Area::find()->alias('area');
        TenantContext::applyFilter($query, 'area.empresas_id');
        $totalCount = (int) (clone $query)->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'area.nombre', $searchValue],
                ['like', 'area.descripcion', $searchValue],
                ['like', 'area.centro_utilidad', $searchValue],
                ['like', 'area.referencia_externa', $searchValue],
                ['like', 'area.centro_utilidad_staffing', $searchValue]
            ]);
        }
        $filteredCount = (int) (clone $query)->count();

        $orderColumns = ['area.id', 'area.nombre', 'area.descripcion', 'areaPadre.nombre', 'area.centro_utilidad', 'area.referencia_externa', 'area.centro_utilidad_staffing', null];
        $orderBy = $orderColumns[$orderCol] ?? 'nombre';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $data[] = [
                $model->id,
                '<span class="fw-medium text-dark">' . \yii\helpers\Html::encode($model->nombre) . '</span>',
                \yii\helpers\Html::encode($model->descripcion ?? '-'),
                $model->areaPadre ? \yii\helpers\Html::encode($model->areaPadre->nombre) : '-',
                $model->centro_utilidad !== null ? $model->centro_utilidad : '-',
                $model->referencia_externa !== null ? $model->referencia_externa : '-',
                $model->centro_utilidad_staffing !== null ? $model->centro_utilidad_staffing : '-',
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
                $model->empresas_id = TenantContext::requireEmpresaId();
                if (!$model->hasErrors() && $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
            $model->empresas_id = TenantContext::requireEmpresaId();
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
            $model->empresas_id = TenantContext::requireEmpresaId();
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

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->empresas_id = TenantContext::requireEmpresaId();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
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

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }

        return $this->redirect(['index']);
    }

    /**
     * Returns HTML for view modal (AJAX).
     * @param int $id ID
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
     * @param int $id ID
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
     * Updates Area via AJAX. Returns JSON.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->empresas_id = TenantContext::requireEmpresaId();
            if ($model->save()) {
                $areaPadreNombre = $model->areaPadre ? $model->areaPadre->nombre : null;
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Área actualizada correctamente.'),
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
        }

        return ['success' => false, 'errors' => $model->getErrors()];
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
        if (($model = Area::findOne(['id' => $id, 'empresas_id' => TenantContext::requireEmpresaId()])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
