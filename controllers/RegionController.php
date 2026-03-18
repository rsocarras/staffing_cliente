<?php

namespace app\controllers;

use app\models\Region;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * RegionController implements the CRUD actions for Region model.
 */
class RegionController extends Controller
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
                        'get-parent-regions' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Region models.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
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
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 3);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = Region::find();
        $totalCount = (int) $query->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'region.code', $searchValue],
                ['like', 'region.name', $searchValue],
                ['like', 'region.type', $searchValue],
                ['like', 'country.name', $searchValue],
                ['like', 'parentRegion.name', $searchValue],
            ]);
        }
        $filteredCount = (int) $query->count();

        $orderColumns = ['region.id', 'country.name', 'region.code', 'region.name', 'region.type', null];
        $orderBy = $orderColumns[$orderCol] ?? 'region.name';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $data[] = [
                $model->id,
                $model->country ? \yii\helpers\Html::encode($model->country->name) : '-',
                \yii\helpers\Html::encode($model->code),
                '<span class="fw-medium text-dark">' . \yii\helpers\Html::encode($model->name) . '</span>',
                \yii\helpers\Html::encode($model->type ?? '-'),
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
     * Displays a single Region model.
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
     * Creates a new Region model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Region();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Region via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Region();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $countryName = $model->country ? $model->country->name : null;
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'Región creada correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'country_id' => $model->country_id,
                        'code' => $model->code,
                        'name' => $model->name,
                        'type' => $model->type,
                        'country_name' => $countryName,
                    ],
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Updates an existing Region model.
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
     * Deletes an existing Region model.
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
     * Returns parent regions by country (JSON). For dependent dropdown.
     * @param int $country_id
     * @param int|null $exclude_id Region ID to exclude (e.g. current region)
     * @return array
     */
    public function actionGetParentRegions($country_id, $exclude_id = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $query = Region::find()
            ->where(['country_id' => (int) $country_id, 'is_active' => 1])
            ->orderBy('name');
        if ($exclude_id) {
            $query->andWhere(['!=', 'id', (int) $exclude_id]);
        }
        $regions = $query->all();
        return array_map(function ($r) {
            return ['id' => $r->id, 'name' => $r->name];
        }, $regions);
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
     * Updates Region via AJAX. Returns JSON.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $countryName = $model->country ? $model->country->name : null;
            $parentName = $model->parentRegion ? $model->parentRegion->name : null;
            return [
                'success' => true,
                'message' => Yii::t('app', 'Región actualizada correctamente.'),
                'model' => [
                    'id' => $model->id,
                    'country_id' => $model->country_id,
                    'code' => $model->code,
                    'name' => $model->name,
                    'type' => $model->type,
                    'country_name' => $countryName,
                    'parent_region_name' => $parentName,
                ],
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Region::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
