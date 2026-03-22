<?php

namespace app\controllers;

use app\models\EmpresaCliente;
use app\models\LocationSedes;
use app\models\Presupuesto;
use app\models\search\PresupuestoSearch;
use app\services\PresupuestoWorkflowService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PresupuestoController extends Controller
{
    /** @var PresupuestoWorkflowService */
    private $workflow;

    public function init()
    {
        parent::init();
        $this->workflow = new PresupuestoWorkflowService();
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'submit' => ['POST'],
                    'approve' => ['POST'],
                    'reject' => ['POST'],
                    'reopen' => ['POST'],
                    'cancel' => ['POST'],
                    'clone' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_index'],
                        'actions' => ['index', 'pending', 'conceptos-json'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_view'],
                        'actions' => ['view'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_create'],
                        'actions' => ['create'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_update'],
                        'actions' => ['update'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_submit'],
                        'actions' => ['submit'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_approve'],
                        'actions' => ['approve'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_reject'],
                        'actions' => ['reject'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_reopen'],
                        'actions' => ['reopen'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_cancel'],
                        'actions' => ['cancel'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['presupuesto_clone'],
                        'actions' => ['clone'],
                    ],
                ],
            ],
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new PresupuestoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPending()
    {
        $searchModel = new PresupuestoSearch();
        $searchModel->estado = Presupuesto::ESTADO_PENDIENTE_APROBACION;
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pageTitle' => 'Presupuestos pendientes de aprobación',
            'isPending' => true,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $this->workflow->assertPresupuestoAccess($model, false);

        $conceptos = $model->getPresupuestoConceptos()->with(['novedadConcepto', 'dias'])->all();

        return $this->render('view', [
            'model' => $model,
            'conceptos' => $conceptos,
        ]);
    }

    public function actionCreate()
    {
        $model = new Presupuesto();
        $model->estado = Presupuesto::ESTADO_BORRADOR;
        $model->loadDefaultValues();
        if (!$model->fecha_inicio_vigencia) {
            $model->fecha_inicio_vigencia = date('Y-m-d');
        }
        if (!$model->fecha_fin_vigencia) {
            $model->fecha_fin_vigencia = date('Y-m-d', strtotime('+1 year'));
        }

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $eid = $this->currentEmpresaId();
            if ($eid !== null) {
                $model->empresa_id = $eid;
            }
            [$conceptoIds, $matrix] = $this->parseConceptosPost();
            if ($this->workflow->createNew($model, $conceptoIds, $matrix)) {
                Yii::$app->session->setFlash('success', 'Presupuesto creado.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'matrixJson' => '{}',
            'selectedConceptos' => [],
            'conceptosCatalogo' => $this->buildConceptosCatalogoMap(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $this->workflow->assertPresupuestoAccess($model, true);

        if (!$model->isEditable()) {
            Yii::$app->session->setFlash('warning', 'Este presupuesto no admite edición directa. Use clonar si está aprobado.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($this->request->isPost) {
            $model->load($this->request->post());
            $eid = $this->currentEmpresaId();
            if ($eid !== null) {
                $model->empresa_id = $eid;
            }
            [$conceptoIds, $matrix] = $this->parseConceptosPost();
            if ($this->workflow->saveDraft($model, $conceptoIds, $matrix)) {
                Yii::$app->session->setFlash('success', 'Cambios guardados.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'matrixJson' => Json::encode($this->buildMatrixPayload($model)),
            'selectedConceptos' => $this->getSelectedConceptoIds($model),
            'conceptosCatalogo' => $this->buildConceptosCatalogoMap(),
        ]);
    }

    /**
     * @return array<int, string>
     */
    protected function buildConceptosCatalogoMap(): array
    {
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            return [];
        }
        $map = [];
        foreach ($this->workflow->listConceptosForEmpresa($empresaId) as $c) {
            $map[(int) $c->id] = $c->nombre;
        }
        return $map;
    }

    public function actionSubmit($id)
    {
        $model = $this->findModel($id);
        $this->workflow->assertPresupuestoAccess($model, true);
        if ($this->workflow->submit($model)) {
            Yii::$app->session->setFlash('success', 'Enviado a aprobación.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo enviar.');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        $this->workflow->assertPresupuestoAccess($model, true);
        $comentario = Yii::$app->request->post('comentario');
        if ($this->workflow->approve($model, $comentario ?: null)) {
            Yii::$app->session->setFlash('success', 'Presupuesto aprobado.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo aprobar.');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionReject($id)
    {
        $model = $this->findModel($id);
        $this->workflow->assertPresupuestoAccess($model, true);
        $comentario = (string) Yii::$app->request->post('comentario', '');
        if ($this->workflow->reject($model, $comentario)) {
            Yii::$app->session->setFlash('success', 'Presupuesto rechazado.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo rechazar.');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionReopen($id)
    {
        $model = $this->findModel($id);
        $this->workflow->assertPresupuestoAccess($model, true);
        if ($this->workflow->reopen($model)) {
            Yii::$app->session->setFlash('success', 'Reabierto como borrador.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo reabrir.');
        }
        return $this->redirect(['update', 'id' => $id]);
    }

    public function actionCancel($id)
    {
        $model = $this->findModel($id);
        $this->workflow->assertPresupuestoAccess($model, true);
        $comentario = Yii::$app->request->post('comentario');
        if ($this->workflow->cancel($model, $comentario ?: null)) {
            Yii::$app->session->setFlash('success', 'Presupuesto anulado.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo anular.');
        }
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionClone($id)
    {
        $model = $this->findModel($id);
        $this->workflow->assertPresupuestoAccess($model, false);
        $nuevo = $this->workflow->clonePresupuesto($model);
        Yii::$app->session->setFlash('success', 'Se creó un borrador a partir del presupuesto seleccionado.');
        return $this->redirect(['update', 'id' => $nuevo->id]);
    }

    public function actionConceptosJson()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            return [];
        }
        $rows = $this->workflow->listConceptosForEmpresa($empresaId);
        $out = [];
        foreach ($rows as $c) {
            $out[] = ['id' => $c->id, 'text' => $c->nombre];
        }
        return $out;
    }

    protected function findModel($id): Presupuesto
    {
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            throw new NotFoundHttpException('Empresa no definida.');
        }
        $model = Presupuesto::find()->where(['id' => $id, 'empresa_id' => $empresaId])->one();
        if ($model === null) {
            throw new NotFoundHttpException('Presupuesto no encontrado.');
        }
        return $model;
    }

    private function currentEmpresaId(): ?int
    {
        $raw = Yii::$app->user->empresas_id ?? null;
        if (!is_numeric($raw) || (int) $raw <= 0) {
            return null;
        }
        return (int) $raw;
    }

    /**
     * @return array{0: int[], 1: array<int, array<int, float>>}
     */
    private function parseConceptosPost(): array
    {
        $post = Yii::$app->request->post('conceptos', []);
        // Un solo valor en <select multiple> a veces llega como string, no como array.
        if (!is_array($post)) {
            $post = ($post !== null && $post !== '') ? [(string) $post] : [];
        }
        // array_filter sin callback elimina "0" como falsy; solo quitamos strings vacíos.
        $post = array_filter($post, static function ($v) {
            return $v !== null && $v !== '';
        });
        $conceptoIds = array_map('intval', $post);
        $conceptoIds = array_values(array_unique(array_filter($conceptoIds, static function ($id) {
            return $id > 0;
        })));

        $matrixRaw = Yii::$app->request->post('matrix', []);
        if (!is_array($matrixRaw)) {
            $matrixRaw = [];
        }
        // Si la matriz trae filas pero conceptos[] falló (p. ej. Select2), recuperar IDs desde matrix[*].
        foreach (array_keys($matrixRaw) as $mk) {
            $ik = (int) $mk;
            if ($ik > 0 && !in_array($ik, $conceptoIds, true)) {
                $conceptoIds[] = $ik;
            }
        }
        sort($conceptoIds);

        $matrix = [];
        foreach ($conceptoIds as $cid) {
            $matrix[$cid] = [];
            $row = $this->matrixPostRow($matrixRaw, $cid);
            for ($d = 1; $d <= 7; $d++) {
                $v = $row[$d] ?? $row[(string) $d] ?? null;
                $matrix[$cid][$d] = ($v !== null && $v !== '' && is_numeric($v)) ? (float) $v : 0.0;
            }
        }
        return [$conceptoIds, $matrix];
    }

    /**
     * Fila de matriz desde POST: las claves suelen venir como string ("1") aunque el name sea matrix[1][1].
     *
     * @param array<mixed, mixed> $matrixRaw
     * @return array<int|string, mixed>
     */
    private function matrixPostRow(array $matrixRaw, int $cid): array
    {
        foreach ($matrixRaw as $k => $row) {
            if ((int) $k === $cid && is_array($row)) {
                return $row;
            }
        }
        return [];
    }

    /**
     * @return array<int, array<int, float>>
     */
    private function buildMatrixPayload(Presupuesto $presupuesto): array
    {
        $out = [];
        foreach ($presupuesto->getPresupuestoConceptos()->with('dias')->all() as $pc) {
            $cid = (int) $pc->novedad_concepto_id;
            $out[$cid] = [];
            for ($d = 1; $d <= 7; $d++) {
                $out[$cid][$d] = 0.0;
            }
            foreach ($pc->dias as $dia) {
                $out[$cid][(int) $dia->dia_semana] = (float) $dia->horas_maximas;
            }
        }
        return $out;
    }

    /**
     * @return int[]
     */
    private function getSelectedConceptoIds(Presupuesto $presupuesto): array
    {
        $ids = [];
        foreach ($presupuesto->getPresupuestoConceptos()->all() as $pc) {
            $ids[] = (int) $pc->novedad_concepto_id;
        }
        return $ids;
    }
}
