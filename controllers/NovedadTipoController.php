<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\NovedadTipo;
use app\models\Profile;
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
                        'update-ajax' => ['POST'],
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
        return $this->render('index');
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
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
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

        if ($model->load(Yii::$app->request->post())) {
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
     * Returns JSON for DataTables server-side processing.
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

        $query = NovedadTipo::find();

        $totalCount = (int) $query->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'novedad_tipo.nombre', $searchValue],
                ['like', 'novedad_tipo.descripcion', $searchValue],
                ['like', 'novedad_tipo.icono', $searchValue],
            ]);
        }

        $filteredCount = (int) $query->count();

        $orderColumns = [
            'novedad_tipo.id',
            'novedad_tipo.nombre',
            'novedad_tipo.descripcion',
            'novedad_tipo.icono',
            'novedad_tipo.orden',
            'novedad_tipo.activo',
            null,
        ];
        $orderBy = $orderColumns[$orderCol] ?? 'novedad_tipo.nombre';
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
                \yii\helpers\Html::encode($model->icono ?? '-'),
                $model->orden !== null ? $model->orden : '-',
                $model->activo ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-danger">No</span>',
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

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['success' => true];
        }

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
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Returns HTML for view modal (AJAX).
     * @param int $id ID
     * @return string
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
     */
    public function actionFormAjax($id)
    {
        return $this->renderPartial('_form_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates NovedadTipo via AJAX. Returns JSON.
     * @param int $id ID
     * @return array
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'message' => Yii::t('app', 'Tipo de novedad actualizado correctamente.'),
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

    private function currentEmpresaId(): ?int
    {
        return TenantContext::currentEmpresaId();
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
