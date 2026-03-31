<?php

namespace app\controllers;

use app\models\LocationCountry;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * LocationCountryController implements the CRUD actions for LocationCountry model.
 */
class LocationCountryController extends Controller
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
     * Lists all LocationCountry models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $total = (int) LocationCountry::find()->count();
        $activos = (int) LocationCountry::find()->where(['is_active' => 1])->count();
        $inactivos = (int) LocationCountry::find()->where(['is_active' => 0])->count();

        return $this->render('index', [
            'total' => $total,
            'activos' => $activos,
            'inactivos' => $inactivos,
        ]);
    }

    /**
     * Devuelve datos paginados y filtrados para DataTables (server-side).
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
        $orderCol = (int) (($request->get('order', [])[0]['column'] ?? 1));
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? 'asc' : 'desc';

        $query = LocationCountry::find();

        // Búsqueda global en columnas buscables
        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'name', $searchValue],
                ['like', 'official_name', $searchValue],
                ['like', 'common_name', $searchValue],
                ['like', 'iso_alpha2', $searchValue],
                ['like', 'iso_alpha3', $searchValue],
                ['like', 'region', $searchValue],
            ]);
        }

        $recordsTotal = (int) LocationCountry::find()->count();
        $recordsFiltered = (int) (clone $query)->count();

        // Orden (columnas: 0=id, 1=name, 2=official_name, 3=iso_alpha2, 4=iso_alpha3, 5=region, 6=is_active)
        $orderColumns = ['id', 'name', 'official_name', 'iso_alpha2', 'iso_alpha3', 'region', 'is_active', null];
        $orderBy = $orderColumns[$orderCol] ?? 'name';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir === 'asc' ? SORT_ASC : SORT_DESC]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $data[] = [
                $model->id,
                $model->name,
                $model->official_name,
                $model->iso_alpha2,
                $model->iso_alpha3,
                $model->region,
                $model->is_active
                    ? '<span class="badge badge-soft-success">' . Yii::t('app', 'Yes') . '</span>'
                    : '<span class="badge badge-soft-danger">' . Yii::t('app', 'No') . '</span>',
                $this->renderPartial('_actions_dropdown', ['model' => $model]),
            ];
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
        ];
    }

    /**
     * Displays a single LocationCountry model.
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
     * Creates a new LocationCountry model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LocationCountry();

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
     * Creates a new LocationCountry via AJAX. Returns JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new LocationCountry();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return [
                    'success' => true,
                    'message' => Yii::t('app', 'País creado correctamente.'),
                    'model' => [
                        'id' => $model->id,
                        'name' => $model->name,
                        'official_name' => $model->official_name,
                        'iso_alpha2' => $model->iso_alpha2,
                        'iso_alpha3' => $model->iso_alpha3,
                        'region' => $model->region,
                        'is_active' => $model->is_active,
                    ],
                ];
            }
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Updates an existing LocationCountry model.
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
     * Deletes an existing LocationCountry model.
     * @param int $id ID
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
     * Updates a LocationCountry via AJAX. Returns JSON.
     * @param int $id ID
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
                'message' => Yii::t('app', 'País actualizado correctamente.'),
                'model' => [
                    'id' => $model->id,
                    'name' => $model->name,
                    'official_name' => $model->official_name,
                    'iso_alpha2' => $model->iso_alpha2,
                    'iso_alpha3' => $model->iso_alpha3,
                    'region' => $model->region,
                    'is_active' => $model->is_active,
                ],
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Finds the LocationCountry model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LocationCountry the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LocationCountry::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
