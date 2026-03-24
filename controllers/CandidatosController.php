<?php

namespace app\controllers;

use app\models\Candidato;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * CandidatosController implementa las acciones CRUD para el modelo Candidato.
 */
class CandidatosController extends Controller
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
     * Lista todos los modelos Candidato.
     *
     * @return string
     */
    public function actionIndex()
    {
        $totalCandidatos = Candidato::find()->count();
        $activos = Candidato::find()->where(['estado' => Candidato::ESTADO_ACTIVO])->count();
        $inactivos = Candidato::find()->where(['estado' => Candidato::ESTADO_INACTIVO])->count();

        return $this->render('index', [
            'totalCandidatos' => $totalCandidatos,
            'activos' => $activos,
            'inactivos' => $inactivos,
        ]);
    }

    /**
     * Retorna JSON para DataTables (procesamiento server-side).
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
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 2);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'asc') === 'asc' ? SORT_ASC : SORT_DESC;

        $query = Candidato::find();
        $totalCount = (int) $query->count();

        if ($searchValue !== '') {
            $query->andWhere([
                'or',
                ['like', 'candidato.nombres', $searchValue],
                ['like', 'candidato.apellidos', $searchValue],
                ['like', 'candidato.correo', $searchValue],
                ['like', 'candidato.telefono', $searchValue],
                ['like', 'candidato.num_documento', $searchValue],
                ['like', 'candidato.estado', $searchValue],
            ]);
        }
        $filteredCount = (int) $query->count();

        $orderColumns = ['candidato.id', 'candidato.nombres', 'candidato.apellidos', 'candidato.correo', 'candidato.telefono', 'candidato.estado', null];
        $orderBy = $orderColumns[$orderCol] ?? 'candidato.nombres';
        if ($orderBy) {
            $query->orderBy([$orderBy => $orderDir]);
        }

        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $estadoLabels = Candidato::optsEstado();
            $estadoLabel = $estadoLabels[$model->estado] ?? $model->estado;
            $estadoCls = Candidato::estadoBadgeSoftClass($model->estado);
            $data[] = [
                $model->id,
                '<span class="fw-medium text-dark">' . \yii\helpers\Html::encode($model->nombres) . '</span>',
                \yii\helpers\Html::encode($model->apellidos),
                \yii\helpers\Html::encode($model->correo ?? '-'),
                \yii\helpers\Html::encode($model->telefono ?? '-'),
                '<span class="badge badge-soft-' . $estadoCls . '">' . \yii\helpers\Html::encode($estadoLabel) . '</span>',
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
     * Muestra un modelo Candidato.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException si el modelo no existe
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo Candidato vía AJAX. Retorna JSON.
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Candidato();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'message' => 'Candidato creado correctamente.',
                'model' => [
                    'id' => $model->id,
                    'nombres' => $model->nombres,
                    'apellidos' => $model->apellidos,
                    'correo' => $model->correo,
                    'telefono' => $model->telefono,
                    'estado' => $model->estado,
                ],
            ];
        }
        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Actualiza un Candidato vía AJAX. Retorna JSON.
     * @param int $id ID
     * @return array
     * @throws NotFoundHttpException si el modelo no existe
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return [
                'success' => true,
                'message' => 'Candidato actualizado correctamente.',
                'model' => [
                    'id' => $model->id,
                    'nombres' => $model->nombres,
                    'apellidos' => $model->apellidos,
                    'correo' => $model->correo,
                    'telefono' => $model->telefono,
                    'estado' => $model->estado,
                ],
            ];
        }

        return ['success' => false, 'errors' => $model->getErrors()];
    }

    /**
     * Elimina un Candidato.
     * @param int $id ID
     * @return \yii\web\Response|array
     * @throws NotFoundHttpException si el modelo no existe
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
     * Retorna HTML para el modal de ver (AJAX).
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException si el modelo no existe
     */
    public function actionViewAjax($id)
    {
        return $this->renderPartial('_view_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Retorna HTML para el formulario de edición en modal (AJAX).
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException si el modelo no existe
     */
    public function actionFormAjax($id)
    {
        return $this->renderPartial('_form_modal', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Busca el modelo Candidato por su clave primaria.
     * @param int $id ID
     * @return Candidato
     * @throws NotFoundHttpException si no se encuentra
     */
    protected function findModel($id)
    {
        if (($model = Candidato::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('La página solicitada no existe.');
    }
}
