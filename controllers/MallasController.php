<?php

namespace app\controllers;

use app\models\Mallas;
use app\models\search\MallasSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MallasController implements the CRUD actions for Mallas model.
 */
class MallasController extends Controller
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
                        'approve' => ['POST'],
                        'reject' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['approve', 'reject'],
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['malla.aprobar', 'admin', 'administrator'],
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Mallas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MallasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false; // Cargar todos para DataTables client-side

        $empresaId = $this->currentEmpresaId();
        if ($empresaId !== null) {
            $dataProvider->query->andWhere(['empresa_id' => $empresaId]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mallas model.
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
     * Creates a new Mallas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Mallas();
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            Yii::$app->session->setFlash('error', 'No se pudo resolver empresas_id desde la sesión del usuario.');
        } else {
            $model->empresa_id = $empresaId;
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->empresa_id = $empresaId ?: $model->empresa_id;
                $model->estado_aprobacion = Mallas::ESTADO_PENDIENTE;
                $model->motivo_rechazo = null;
                $model->solicitado_por = Yii::$app->user->id;
                $model->solicitado_at = date('Y-m-d H:i:s');
                $model->aprobado_por = null;
                $model->aprobado_at = null;
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Malla creada y enviada a aprobación RRHH.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new Mallas();
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            return [
                'success' => false,
                'errors' => [
                    'empresa_id' => ['No se encontró empresas_id en la sesión del usuario.'],
                ],
            ];
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->empresa_id = $empresaId;
            $model->estado_aprobacion = Mallas::ESTADO_PENDIENTE;
            $model->motivo_rechazo = null;
            $model->solicitado_por = Yii::$app->user->id;
            $model->solicitado_at = date('Y-m-d H:i:s');
            $model->aprobado_por = null;
            $model->aprobado_at = null;

            $fkEmpresaTable = $this->getMallasEmpresaFkTable();
            $fkTableSchema = Yii::$app->db->schema->getTableSchema($fkEmpresaTable, true);
            if ($fkTableSchema !== null) {
                $exists = (bool) Yii::$app->db->createCommand(
                    'SELECT 1 FROM `' . $fkEmpresaTable . '` WHERE `id` = :id LIMIT 1',
                    [':id' => (int) $empresaId]
                )->queryScalar();
                if (!$exists) {
                    return [
                        'success' => false,
                        'errors' => [
                            'empresa_id' => [
                                'El empresas_id de sesión (' . (int) $empresaId . ') no existe en la tabla `' . $fkEmpresaTable . '` requerida por mallas.',
                            ],
                        ],
                    ];
                }
            }

            try {
                if ($model->save()) {
                    return [
                        'success' => true,
                        'message' => Yii::t('app', 'Malla creada correctamente.'),
                        'model' => [
                            'id' => $model->id,
                            'empresa_id' => $model->empresa_id,
                            'nombre' => $model->nombre,
                            'descripcion' => $model->descripcion,
                            'tipo' => $model->displayTipo(),
                            'estado' => $model->displayEstadoAprobacion(),
                        ],
                    ];
                }
            } catch (\yii\db\IntegrityException $e) {
                return [
                    'success' => false,
                    'errors' => [
                        'empresa_id' => ['No se pudo guardar la malla: revisa la FK de `mallas.empresa_id` y el valor de empresas_id de sesión.'],
                    ],
                ];
            }

            return ['success' => false, 'errors' => $model->getErrors()];
        }

        return ['success' => false, 'errors' => ['general' => [Yii::t('app', 'Datos inválidos.')]]];
    }

    /**
     * Updates an existing Mallas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->estado_aprobacion = Mallas::ESTADO_PENDIENTE;
            $model->motivo_rechazo = null;
            $model->solicitado_por = Yii::$app->user->id;
            $model->solicitado_at = date('Y-m-d H:i:s');
            $model->aprobado_por = null;
            $model->aprobado_at = null;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Cambios guardados y enviados a aprobación RRHH.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mallas model.
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

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $model->estado_aprobacion = Mallas::ESTADO_APROBADA;
        $model->motivo_rechazo = null;
        $model->aprobado_por = Yii::$app->user->id;
        $model->aprobado_at = date('Y-m-d H:i:s');
        $model->save(false);
        Yii::$app->session->setFlash('success', 'Malla aprobada.');

        return $this->redirect($this->request->referrer ?: ['view', 'id' => $id]);
    }

    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $model->estado_aprobacion = Mallas::ESTADO_RECHAZADA;
        $model->motivo_rechazo = trim((string) $this->request->post('motivo_rechazo', '')) ?: null;
        $model->aprobado_por = Yii::$app->user->id;
        $model->aprobado_at = date('Y-m-d H:i:s');
        $model->save(false);
        Yii::$app->session->setFlash('success', 'Malla rechazada.');

        return $this->redirect($this->request->referrer ?: ['view', 'id' => $id]);
    }

    /**
     * Finds the Mallas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Mallas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mallas::findOne(['id' => $id])) !== null) {
            $empresaId = $this->currentEmpresaId();
            if ($empresaId !== null && (int) $model->empresa_id !== (int) $empresaId) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function currentEmpresaId(): ?int
    {
        $empresaId = Yii::$app->user->empresas_id ?? null;
        if ($empresaId === null || (int) $empresaId <= 0) {
            return null;
        }
        return (int) $empresaId;
    }

    private function getMallasEmpresaFkTable(): string
    {
        $sql = <<<SQL
SELECT REFERENCED_TABLE_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'mallas'
  AND COLUMN_NAME = 'empresa_id'
  AND REFERENCED_TABLE_NAME IS NOT NULL
LIMIT 1
SQL;
        $table = Yii::$app->db->createCommand($sql)->queryScalar();
        return $table ? (string) $table : 'empresas';
    }
}
