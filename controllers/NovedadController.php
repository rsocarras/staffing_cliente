<?php

namespace app\controllers;

use app\models\Novedad;
use app\models\NovedadConcepto;
use app\models\NovedadFlujo;
use app\models\NovedadStep;
use app\models\NovedadStepHistoryLog;
use app\models\NovedadTipo;
use app\models\Profile;
use Yii;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * CRUD de novedades.
 */
class NovedadController extends Controller
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
                        'move-step' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Listado con DataTables (AJAX).
     *
     * @return string
     */
    public function actionIndex()
    {
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            Yii::$app->session->setFlash('warning', 'No se pudo determinar la empresa de la sesión.');
        }

        $tiposQuery = NovedadTipo::find()->where(['activo' => 1]);
        if ($this->novedadTipoTieneColumnaEmpresa()) {
            if ($empresaId !== null) {
                $tiposQuery->andWhere(['empresa_id' => $empresaId]);
            } else {
                $tiposQuery->andWhere('0=1');
            }
        }
        $tipos = $tiposQuery->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])->all();

        $flujos = NovedadFlujo::find()
            ->where(['estado' => NovedadFlujo::ESTADO_ACTIVO])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        $profiles = [];
        if ($empresaId !== null) {
            $profiles = Profile::find()
                ->where(['empresas_id' => $empresaId, 'estado' => Profile::ESTADO_ACTIVO])
                ->orderBy(['name' => SORT_ASC, 'user_id' => SORT_ASC])
                ->all();
        }

        return $this->render('index', [
            'tipos' => $tipos,
            'flujos' => $flujos,
            'profiles' => $profiles,
        ]);
    }

    /**
     * JSON para DataTables.
     *
     * @return array
     */
    public function actionData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            return [
                'draw' => (int) Yii::$app->request->get('draw', 1),
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => [],
            ];
        }

        $request = Yii::$app->request;
        $draw = (int) $request->get('draw', 1);
        $start = (int) $request->get('start', 0);
        $length = (int) $request->get('length', 10);
        $searchValue = $request->get('search', [])['value'] ?? '';
        $orderCol = (int) ($request->get('order', [])[0]['column'] ?? 0);
        $orderDir = ($request->get('order', [])[0]['dir'] ?? 'desc') === 'asc' ? SORT_ASC : SORT_DESC;
        $hasFlujo = Novedad::hasNovedadFlujoIdColumn();

        $query = Novedad::find()
            ->alias('n')
            ->leftJoin(['c' => 'novedad_concepto'], 'c.id = n.concepto_id')
            ->leftJoin(['nt' => 'novedad_tipo'], 'nt.id = n.novedad_tipo_id')
            ->leftJoin(['ns' => 'novedad_step'], 'ns.id = n.paso_actual_id')
            ->with(['concepto', 'novedadTipo', 'novedadFlujo', 'pasoActual'])
            ->where(['n.empresa_id' => $empresaId]);

        if ($hasFlujo) {
            $query->leftJoin(['nf' => 'novedad_flujo'], 'nf.id = n.novedad_flujo_id');
        }

        $totalCount = (int) $query->count();

        if ($searchValue !== '') {
            $or = [
                ['like', 'c.nombre', $searchValue],
                ['like', 'nt.nombre', $searchValue],
                ['like', 'n.estado', $searchValue],
                ['like', 'ns.nombre', $searchValue],
                ['like', 'ns.codigo', $searchValue],
            ];
            if ($hasFlujo) {
                $or[] = ['like', 'nf.nombre', $searchValue];
            }
            if (ctype_digit((string) $searchValue)) {
                $or[] = ['n.id' => (int) $searchValue];
            }
            $query->andWhere(array_merge(['or'], $or));
        }

        $filteredCount = (int) $query->count();

        if ($hasFlujo) {
            $orderColumns = ['n.id', 'c.nombre', 'nt.nombre', 'nf.nombre', 'n.estado', 'ns.nombre', null];
        } else {
            $orderColumns = ['n.id', 'c.nombre', 'nt.nombre', 'n.estado', null];
        }
        $orderBy = $orderColumns[$orderCol] ?? 'n.id';
        if ($orderBy !== null) {
            $query->orderBy([$orderBy => $orderDir]);
        } else {
            $query->orderBy(['n.id' => SORT_DESC]);
        }

        /** @var Novedad[] $models */
        $models = $query->offset($start)->limit($length)->all();

        $data = [];
        foreach ($models as $model) {
            $conceptoNombre = $model->concepto ? $model->concepto->nombre : ('#' . $model->concepto_id);
            $tipoNombre = $model->novedadTipo ? $model->novedadTipo->nombre : ('#' . $model->novedad_tipo_id);
            $estadoBadge = $this->estadoBadgeHtml($model);
            $row = [
                $model->id,
                '<span class="fw-medium text-dark">' . Html::encode($conceptoNombre) . '</span>',
                Html::encode($tipoNombre),
            ];
            if ($hasFlujo) {
                $flujoNombre = '-';
                if ($model->novedadFlujo) {
                    $flujoNombre = $model->novedadFlujo->nombre;
                }
                $row[] = Html::encode($flujoNombre);
            }
            $row[] = $estadoBadge;
            if ($hasFlujo) {
                $pasoNombre = '-';
                if ($model->pasoActual) {
                    $pasoNombre = $model->pasoActual->nombre ?: $model->pasoActual->codigo;
                }
                $row[] = Html::encode($pasoNombre);
            }
            $row[] = $this->renderPartial('_actions_dropdown', ['model' => $model]);
            $data[] = $row;
        }

        return [
            'draw' => $draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ];
    }

    /**
     * HTML modal Ver.
     *
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
     * HTML modal Editar.
     *
     * @param int $id ID
     * @return string
     */
    public function actionFormAjax($id)
    {
        $model = $this->findModel($id);
        $conceptos = $this->conceptosForTipo((int) $model->novedad_tipo_id);

        $empresaId = $this->currentEmpresaId();
        $tiposQuery = NovedadTipo::find()->where(['activo' => 1]);
        if ($this->novedadTipoTieneColumnaEmpresa()) {
            if ($empresaId !== null) {
                $tiposQuery->andWhere(['empresa_id' => $empresaId]);
            } else {
                $tiposQuery->andWhere('0=1');
            }
        }
        $tipos = $tiposQuery->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])->all();
        $flujos = NovedadFlujo::find()
            ->where(['estado' => NovedadFlujo::ESTADO_ACTIVO])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        return $this->renderPartial('_form_modal', [
            'model' => $model,
            'conceptos' => $conceptos,
            'tipos' => $tipos,
            'flujos' => $flujos,
        ]);
    }

    /**
     * Pasos de un flujo (para selects en edición).
     *
     * @param int $novedad_flujo_id
     * @return array
     */
    public function actionPasosPorFlujo($novedad_flujo_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $fid = (int) $novedad_flujo_id;
        if ($fid <= 0 || !Novedad::hasNovedadFlujoIdColumn()) {
            return ['success' => false, 'items' => []];
        }
        $flujo = NovedadFlujo::findOne(['id' => $fid, 'estado' => NovedadFlujo::ESTADO_ACTIVO]);
        if ($flujo === null) {
            return ['success' => false, 'items' => []];
        }
        $rows = NovedadStep::find()
            ->where(['novedad_flujo_id' => $fid])
            ->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])
            ->all();
        $items = array_map(static function (NovedadStep $s) {
            return [
                'id' => (int) $s->id,
                'nombre' => $s->nombre ?: $s->codigo,
            ];
        }, $rows);

        return ['success' => true, 'items' => $items];
    }

    /**
     * Modal: visualización del flujo y paso actual.
     *
     * @param int $id ID
     * @return string
     */
    public function actionFlujoAjax($id)
    {
        $model = $this->findModel($id);
        $steps = [];
        $flujoNombre = null;
        if (Novedad::hasNovedadFlujoIdColumn() && $model->getAttribute('novedad_flujo_id')) {
            $fid = (int) $model->getAttribute('novedad_flujo_id');
            if ($model->novedadFlujo) {
                $flujoNombre = $model->novedadFlujo->nombre;
            }
            $steps = NovedadStep::find()
                ->where(['novedad_flujo_id' => $fid])
                ->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])
                ->all();
        }

        return $this->renderPartial('_flujo_kanban_modal', [
            'model' => $model,
            'flujoNombre' => $flujoNombre,
            'steps' => $steps,
        ]);
    }

    /**
     * JSON: pasos del flujo y la tarjeta de una sola novedad por columna (modal Kanban).
     *
     * @param int $novedad_id
     * @return array
     */
    public function actionKanbanDataNovedad($novedad_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            return ['success' => false, 'message' => 'Empresa no disponible.'];
        }
        $novedadId = (int) $novedad_id;
        /** @var Novedad|null $novedad */
        $novedad = Novedad::find()
            ->alias('n')
            ->with(['concepto'])
            ->where(['n.id' => $novedadId, 'n.empresa_id' => $empresaId])
            ->one();
        if ($novedad === null) {
            return ['success' => false, 'message' => 'Novedad no encontrada.'];
        }
        if (!Novedad::hasNovedadFlujoIdColumn()) {
            return [
                'success' => false,
                'message' => 'Falta la columna novedad.novedad_flujo_id. Ejecute: php yii migrate',
            ];
        }
        $flujoId = (int) $novedad->getAttribute('novedad_flujo_id');
        if ($flujoId === 0) {
            return ['success' => false, 'message' => 'La novedad no tiene flujo asignado.'];
        }
        $flujo = NovedadFlujo::findOne(['id' => $flujoId, 'estado' => NovedadFlujo::ESTADO_ACTIVO]);
        if ($flujo === null) {
            return ['success' => false, 'message' => 'Flujo no encontrado o inactivo.'];
        }
        $steps = NovedadStep::find()
            ->where(['novedad_flujo_id' => $flujoId])
            ->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        $estadoListaPaso = NovedadStep::estadoLista();
        $stepRows = [];
        foreach ($steps as $idx => $s) {
            $stepRows[] = [
                'id' => (int) $s->id,
                'nombre' => $s->nombre ?: $s->codigo,
                'codigo' => $s->codigo,
                'orden' => (int) $s->orden,
                'step_index' => $idx + 1,
                'estado' => $s->estado,
                'estado_label' => $estadoListaPaso[$s->estado] ?? $s->estado,
            ];
        }

        $columns = [];
        foreach ($steps as $s) {
            $columns[(string) $s->id] = [];
        }

        $lastStepId = null;
        if ($steps !== []) {
            $lastStepId = (int) $steps[count($steps) - 1]->id;
        }
        $isUltimoPaso = $lastStepId !== null
            && $novedad->paso_actual_id !== null
            && (int) $novedad->paso_actual_id === $lastStepId;

        $actorCanMove = $this->actorCanMoveKanbanFromCurrentStep($novedad, $steps);
        $canMove = $actorCanMove && !$isUltimoPaso;
        $card = $this->serializeNovedadCard($novedad, true, $canMove);

        $nSteps = count($steps);
        $currentIndex = 0;
        $foundPaso = false;
        if ($novedad->paso_actual_id !== null) {
            foreach ($steps as $i => $s) {
                if ((int) $s->id === (int) $novedad->paso_actual_id) {
                    $currentIndex = $i;
                    $foundPaso = true;
                    break;
                }
            }
        }
        if (!$foundPaso) {
            $currentIndex = 0;
        }
        $currentStepForEstado = $nSteps > 0 ? $steps[$currentIndex] : null;
        $card['paso_step_estado'] = $currentStepForEstado ? $currentStepForEstado->estado : null;
        $card['paso_step_estado_label'] = $currentStepForEstado
            ? ($estadoListaPaso[$currentStepForEstado->estado] ?? $currentStepForEstado->estado)
            : null;
        if ($nSteps > 0) {
            $card['next_step_id'] = $currentIndex < $nSteps - 1 ? (int) $steps[$currentIndex + 1]->id : null;
            $card['prev_step_id'] = $currentIndex > 0 ? (int) $steps[$currentIndex - 1]->id : null;
            $card['next_step_nombre'] = $currentIndex < $nSteps - 1
                ? ($steps[$currentIndex + 1]->nombre ?: $steps[$currentIndex + 1]->codigo)
                : null;
            $card['prev_step_nombre'] = $currentIndex > 0
                ? ($steps[$currentIndex - 1]->nombre ?: $steps[$currentIndex - 1]->codigo)
                : null;
        } else {
            $card['next_step_id'] = null;
            $card['prev_step_id'] = null;
            $card['next_step_nombre'] = null;
            $card['prev_step_nombre'] = null;
        }

        $pid = $novedad->paso_actual_id;
        if ($pid === null || !isset($columns[(string) $pid])) {
            if ($steps !== []) {
                $columns[(string) $steps[0]->id][] = $card;
            }
        } else {
            $columns[(string) $pid][] = $card;
        }

        return [
            'success' => true,
            'novedad_id' => $novedadId,
            'is_ultimo_paso' => $isUltimoPaso,
            'can_move' => $canMove,
            'last_step_id' => $lastStepId,
            'flujo' => [
                'id' => (int) $flujo->id,
                'nombre' => $flujo->nombre,
            ],
            'steps' => $stepRows,
            'columns' => $columns,
        ];
    }

    /**
     * Mueve la novedad a otro paso del mismo flujo (Kanban).
     *
     * @return array
     */
    public function actionMoveStep()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            return ['success' => false, 'message' => 'Empresa no disponible.'];
        }

        $novedadId = (int) Yii::$app->request->post('novedad_id');
        $stepIdRaw = Yii::$app->request->post('novedad_step_id');
        $stepId = $stepIdRaw === '' || $stepIdRaw === null ? null : (int) $stepIdRaw;
        $motivo = trim((string) Yii::$app->request->post('motivo', ''));

        $novedad = Novedad::findOne(['id' => $novedadId, 'empresa_id' => $empresaId]);
        if ($novedad === null) {
            return ['success' => false, 'message' => 'Novedad no encontrada.'];
        }
        if (!Novedad::hasNovedadFlujoIdColumn()) {
            return ['success' => false, 'message' => 'Falta la columna novedad.novedad_flujo_id.'];
        }
        $flujoIdNovedad = (int) $novedad->getAttribute('novedad_flujo_id');
        if ($flujoIdNovedad === 0) {
            return ['success' => false, 'message' => 'La novedad no tiene flujo asignado.'];
        }

        $stepsOrdered = NovedadStep::find()
            ->where(['novedad_flujo_id' => $flujoIdNovedad])
            ->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        $lastStepId = $stepsOrdered !== [] ? (int) $stepsOrdered[count($stepsOrdered) - 1]->id : null;
        if (
            $lastStepId !== null
            && $novedad->paso_actual_id !== null
            && (int) $novedad->paso_actual_id === $lastStepId
        ) {
            if ($stepId === null || (int) $stepId !== $lastStepId) {
                return [
                    'success' => false,
                    'message' => 'La novedad ya está en el último paso del flujo; no se puede modificar.',
                ];
            }

            return ['success' => true, 'message' => 'Sin cambios.', 'readonly' => true];
        }

        $permStep = $this->resolveKanbanStepForPermission($novedad, $stepsOrdered);
        if ($permStep !== null && !$this->actorCanMoveKanban($permStep)) {
            return [
                'success' => false,
                'message' => 'Solo el responsable asignado al paso actual puede mover la novedad. Si el paso no tiene responsable, cualquier usuario puede moverla.',
            ];
        }

        $ordenPorStepId = [];
        foreach ($stepsOrdered as $s) {
            $ordenPorStepId[(int) $s->id] = (int) $s->orden;
        }
        $primerOrden = $stepsOrdered !== [] ? (int) $stepsOrdered[0]->orden : null;

        $fromStepId = $novedad->paso_actual_id !== null ? (int) $novedad->paso_actual_id : null;
        $fromOrden = null;
        if ($fromStepId !== null && isset($ordenPorStepId[$fromStepId])) {
            $fromOrden = $ordenPorStepId[$fromStepId];
        } elseif ($primerOrden !== null) {
            $fromOrden = $primerOrden;
        }

        if ($fromStepId === $stepId) {
            return ['success' => true, 'message' => 'Sin cambios.'];
        }

        if ($stepId === null) {
            $novedad->paso_actual_id = null;
            $toOrden = null;
        } else {
            $step = NovedadStep::findOne(['id' => $stepId, 'novedad_flujo_id' => $flujoIdNovedad]);
            if ($step === null) {
                return ['success' => false, 'message' => 'El paso no pertenece a este flujo.'];
            }
            $toOrden = isset($ordenPorStepId[$stepId]) ? $ordenPorStepId[$stepId] : null;
            $novedad->paso_actual_id = $stepId;
        }

        $isBackward = $fromOrden !== null && $toOrden !== null && $toOrden < $fromOrden;
        if ($isBackward && $motivo === '') {
            return [
                'success' => false,
                'requires_motivo' => true,
                'message' => 'Indique el motivo para volver a un paso anterior.',
            ];
        }

        if (!$novedad->save(false, ['paso_actual_id', 'updated_at'])) {
            return ['success' => false, 'message' => 'No se pudo actualizar el paso.', 'errors' => $novedad->getErrors()];
        }

        $this->touchNovedadStepTimestampsOnPasoTransition($fromStepId, $stepId, $isBackward);

        $actorId = $this->currentActorUserId();
        $tipoLog = $isBackward ? NovedadStepHistoryLog::TIPO_KANBAN_RETRO : NovedadStepHistoryLog::TIPO_KANBAN_AVANCE;
        $motivoLog = $isBackward ? $motivo : null;
        NovedadStepHistoryLog::record(
            $flujoIdNovedad,
            $tipoLog,
            $stepId,
            $fromStepId,
            $stepId,
            $motivoLog,
            $actorId
        );

        return ['success' => true, 'message' => 'Paso actualizado.'];
    }

    /**
     * Actualiza una novedad vía AJAX.
     *
     * @param int $id ID
     * @return array
     */
    public function actionUpdateAjax($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->findModel($id);

        $post = Yii::$app->request->post('Novedad', []);
        if ($post === []) {
            return ['success' => false, 'errors' => ['general' => ['Datos inválidos.']]];
        }

        $tipoId = isset($post['novedad_tipo_id']) ? (int) $post['novedad_tipo_id'] : (int) $model->novedad_tipo_id;
        $conceptoId = isset($post['concepto_id']) ? (int) $post['concepto_id'] : (int) $model->concepto_id;
        $datosRaw = $post['datos'] ?? $model->datos;
        if (!is_string($datosRaw)) {
            $datosRaw = '{}';
        }
        if (trim($datosRaw) === '') {
            $datosRaw = '{}';
        }
        json_decode($datosRaw);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['success' => false, 'errors' => ['datos' => ['El campo datos debe ser JSON válido.']]];
        }

        $estado = $post['estado'] ?? $model->estado;
        if (!array_key_exists($estado, Novedad::optsEstado())) {
            return ['success' => false, 'errors' => ['estado' => ['Estado inválido.']]];
        }

        $empresaId = $this->currentEmpresaId();
        $tipo = NovedadTipo::findOne(['id' => $tipoId]);
        if ($tipo === null || (int) $tipo->activo !== 1) {
            return ['success' => false, 'errors' => ['novedad_tipo_id' => ['Tipo de novedad inválido.']]];
        }
        if ($this->novedadTipoTieneColumnaEmpresa() && $empresaId !== null && (int) $tipo->empresa_id !== $empresaId) {
            return ['success' => false, 'errors' => ['novedad_tipo_id' => ['Tipo inválido para su empresa.']]];
        }

        $concepto = NovedadConcepto::findOne(['id' => $conceptoId, 'activo' => 1]);
        if ($concepto === null || (int) $concepto->novedad_tipo_id !== $tipoId) {
            return ['success' => false, 'errors' => ['concepto_id' => ['El concepto no corresponde al tipo.']]];
        }

        $oldFlujoId = Novedad::hasNovedadFlujoIdColumn() ? (int) ($model->getAttribute('novedad_flujo_id') ?: 0) : 0;
        $oldPasoId = Novedad::hasNovedadFlujoIdColumn() && $model->paso_actual_id !== null ? (int) $model->paso_actual_id : null;
        $newFlujoId = 0;
        $flujoIdCambio = false;

        if (Novedad::hasNovedadFlujoIdColumn()) {
            $flujoId = isset($post['novedad_flujo_id']) && $post['novedad_flujo_id'] !== '' && $post['novedad_flujo_id'] !== null
                ? (int) $post['novedad_flujo_id']
                : null;
            if ($flujoId !== null) {
                $flujo = NovedadFlujo::findOne(['id' => $flujoId, 'estado' => NovedadFlujo::ESTADO_ACTIVO]);
                if ($flujo === null) {
                    return ['success' => false, 'errors' => ['novedad_flujo_id' => ['Flujo inválido o inactivo.']]];
                }
                $model->setAttribute('novedad_flujo_id', $flujoId);
            } else {
                $model->setAttribute('novedad_flujo_id', null);
                $model->paso_actual_id = null;
            }
            $newFlujoId = (int) ($model->getAttribute('novedad_flujo_id') ?: 0);
            $flujoIdCambio = $oldFlujoId !== $newFlujoId;
        }

        if (Novedad::hasNovedadFlujoIdColumn() && $newFlujoId > 0 && $flujoIdCambio) {
            $model->paso_actual_id = $this->firstStepIdForFlujo($newFlujoId);
        }

        $model->novedad_tipo_id = $tipoId;
        $model->concepto_id = $conceptoId;
        $model->datos = $datosRaw;
        $model->estado = $estado;

        if (!$model->save()) {
            return ['success' => false, 'errors' => $model->getErrors()];
        }

        if (Novedad::hasNovedadFlujoIdColumn() && $flujoIdCambio) {
            $newPasoId = $model->paso_actual_id !== null ? (int) $model->paso_actual_id : null;
            $this->touchNovedadStepTimestampsOnPasoTransition($oldPasoId, $newPasoId);
        }

        return ['success' => true, 'message' => 'Novedad actualizada.'];
    }

    /**
     * Crea una novedad y la ubica en el primer paso del flujo elegido.
     *
     * @return array
     */
    public function actionCreateAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        try {
            return $this->runCreateAjax();
        } catch (\Throwable $e) {
            Yii::error($e, __METHOD__);
            return [
                'success' => false,
                'message' => YII_DEBUG ? $e->getMessage() : 'No se pudo crear la novedad. Revisá los datos o ejecutá las migraciones de la base.',
            ];
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function runCreateAjax(): array
    {
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            return ['success' => false, 'message' => 'Empresa no disponible.'];
        }

        $req = Yii::$app->request;
        $tipoId = (int) $req->post('novedad_tipo_id');
        $conceptoId = (int) $req->post('concepto_id');
        $flujoId = (int) $req->post('novedad_flujo_id');
        $datosRaw = $req->post('datos', '{}');
        if (!is_string($datosRaw) || trim($datosRaw) === '') {
            $datosRaw = '{}';
        }
        json_decode($datosRaw);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['success' => false, 'message' => 'El campo datos debe ser JSON válido.'];
        }

        $tipo = NovedadTipo::findOne(['id' => $tipoId]);
        if ($tipo === null || (int) $tipo->activo !== 1) {
            return ['success' => false, 'message' => 'Tipo de novedad inválido.'];
        }
        if ($this->novedadTipoTieneColumnaEmpresa() && (int) $tipo->empresa_id !== $empresaId) {
            return ['success' => false, 'message' => 'Tipo de novedad inválido para su empresa.'];
        }

        $concepto = NovedadConcepto::findOne(['id' => $conceptoId, 'activo' => 1]);
        if ($concepto === null || (int) $concepto->novedad_tipo_id !== $tipoId) {
            return ['success' => false, 'message' => 'El concepto no corresponde al tipo seleccionado.'];
        }

        $flujo = NovedadFlujo::findOne(['id' => $flujoId, 'estado' => NovedadFlujo::ESTADO_ACTIVO]);
        if ($flujo === null) {
            return ['success' => false, 'message' => 'Seleccione un flujo activo.'];
        }

        $profileId = (int) $req->post('profile_id');
        if ($profileId <= 0) {
            return ['success' => false, 'message' => 'Seleccione el colaborador asociado a la novedad.'];
        }
        $colaborador = Profile::findOne([
            'user_id' => $profileId,
            'empresas_id' => $empresaId,
            'estado' => Profile::ESTADO_ACTIVO,
        ]);
        if ($colaborador === null) {
            return ['success' => false, 'message' => 'Colaborador inválido o inactivo para su empresa.'];
        }

        $model = new Novedad();
        $model->empresa_id = $empresaId;
        $model->profile_id = $profileId;
        $model->concepto_id = $conceptoId;
        $model->novedad_tipo_id = $tipoId;
        if (Novedad::hasNovedadFlujoIdColumn()) {
            $model->setAttribute('novedad_flujo_id', $flujoId);
        }
        $model->paso_actual_id = $this->firstStepIdForFlujo($flujoId);
        $model->datos = $datosRaw;
        $model->estado = Novedad::ESTADO_PENDIENTE;
        $model->es_masivo = 0;

        if (!$model->save()) {
            return ['success' => false, 'message' => 'No se pudo guardar.', 'errors' => $model->getErrors()];
        }

        if ($model->paso_actual_id !== null) {
            $this->touchNovedadStepTimestampsOnPasoTransition(null, (int) $model->paso_actual_id);
        }

        return [
            'success' => true,
            'message' => 'Novedad creada.',
        ];
    }

    /**
     * Conceptos activos para un tipo de novedad.
     *
     * @param int $novedad_tipo_id
     * @return array
     */
    public function actionConceptosPorTipo($novedad_tipo_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $empresaId = $this->currentEmpresaId();
        $tipoId = (int) $novedad_tipo_id;
        if ($tipoId <= 0) {
            return ['success' => false, 'items' => []];
        }
        if ($this->novedadTipoTieneColumnaEmpresa() && $empresaId === null) {
            return ['success' => false, 'items' => []];
        }

        $tipo = NovedadTipo::findOne(['id' => $tipoId]);
        if ($tipo === null || (int) $tipo->activo !== 1) {
            return ['success' => false, 'items' => []];
        }
        if ($this->novedadTipoTieneColumnaEmpresa() && (int) $tipo->empresa_id !== $empresaId) {
            return ['success' => false, 'items' => []];
        }

        $rows = NovedadConcepto::find()
            ->where(['novedad_tipo_id' => $tipoId, 'activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

        $items = array_map(static function (NovedadConcepto $c) {
            return ['id' => (int) $c->id, 'nombre' => $c->nombre];
        }, $rows);

        return ['success' => true, 'items' => $items];
    }

    /**
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Novedad();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (Novedad::hasNovedadFlujoIdColumn()) {
                    $fid = (int) ($model->getAttribute('novedad_flujo_id') ?: 0);
                    if ($fid > 0) {
                        $model->paso_actual_id = $this->firstStepIdForFlujo($fid);
                    }
                }
                if ($model->save()) {
                    if (Novedad::hasNovedadFlujoIdColumn() && $model->paso_actual_id !== null) {
                        $this->touchNovedadStepTimestampsOnPasoTransition(null, (int) $model->paso_actual_id);
                    }
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
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldFlujoId = Novedad::hasNovedadFlujoIdColumn() ? (int) ($model->getAttribute('novedad_flujo_id') ?: 0) : 0;
        $oldPasoId = Novedad::hasNovedadFlujoIdColumn() && $model->paso_actual_id !== null ? (int) $model->paso_actual_id : null;

        if ($this->request->isPost && $model->load($this->request->post())) {
            if (Novedad::hasNovedadFlujoIdColumn()) {
                $newFlujoId = (int) ($model->getAttribute('novedad_flujo_id') ?: 0);
                if ($oldFlujoId !== $newFlujoId && $newFlujoId > 0) {
                    $model->paso_actual_id = $this->firstStepIdForFlujo($newFlujoId);
                }
            }
            if ($model->save()) {
                if (Novedad::hasNovedadFlujoIdColumn() && $oldFlujoId !== (int) ($model->getAttribute('novedad_flujo_id') ?: 0)) {
                    $newPasoId = $model->paso_actual_id !== null ? (int) $model->paso_actual_id : null;
                    $this->touchNovedadStepTimestampsOnPasoTransition($oldPasoId, $newPasoId);
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException
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
     * @param int $id ID
     * @return Novedad
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model = Novedad::findOne(['id' => $id, 'empresa_id' => $empresaId]);
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return NovedadConcepto[]
     */
    private function conceptosForTipo(int $tipoId): array
    {
        if ($tipoId <= 0) {
            return [];
        }
        return NovedadConcepto::find()
            ->where(['novedad_tipo_id' => $tipoId, 'activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();
    }

    /**
     * @return string
     */
    private function estadoBadgeHtml(Novedad $model): string
    {
        $label = Html::encode((string) $model->displayEstado());
        $cls = 'bg-secondary';
        if ($model->estado === Novedad::ESTADO_PENDIENTE) {
            $cls = 'bg-warning text-dark';
        } elseif ($model->estado === Novedad::ESTADO_APROBADA) {
            $cls = 'bg-success';
        } elseif ($model->estado === Novedad::ESTADO_RECHAZADA) {
            $cls = 'bg-danger';
        } elseif ($model->estado === Novedad::ESTADO_BORRADOR) {
            $cls = 'bg-light text-dark border';
        }
        return '<span class="badge ' . $cls . '">' . $label . '</span>';
    }

    /**
     * El modelo PHP asume `empresa_id`, pero en algunas BDs la tabla no la tiene.
     */
    private function novedadTipoTieneColumnaEmpresa(): bool
    {
        static $cached = null;
        if ($cached === null) {
            $cached = NovedadTipo::getTableSchema()->getColumn('empresa_id') !== null;
        }
        return $cached;
    }

    private function currentEmpresaId(): ?int
    {
        $empresaId = Yii::$app->user->empresas_id ?? null;
        if ($empresaId !== null && is_numeric($empresaId) && (int) $empresaId > 0) {
            return (int) $empresaId;
        }
        $uid = Yii::$app->user->id ?? null;
        if ($uid !== null) {
            $profile = Profile::findOne(['user_id' => (int) $uid]);
            if ($profile !== null && (int) $profile->empresas_id > 0) {
                return (int) $profile->empresas_id;
            }
        }
        return null;
    }

    /**
     * user_id del perfil (columna profile_id en novedad_step / history log).
     */
    private function currentActorUserId(): ?int
    {
        $uid = Yii::$app->user->id ?? null;

        return $uid !== null ? (int) $uid : null;
    }

    /**
     * Paso del flujo que define permisos de movimiento (misma lógica que la columna donde se muestra la tarjeta).
     *
     * @param NovedadStep[] $stepsOrdered
     */
    private function resolveKanbanStepForPermission(Novedad $novedad, array $stepsOrdered): ?NovedadStep
    {
        if ($stepsOrdered === []) {
            return null;
        }
        $pid = $novedad->paso_actual_id;
        if ($pid !== null) {
            foreach ($stepsOrdered as $s) {
                if ((int) $s->id === (int) $pid) {
                    return $s;
                }
            }
        }

        return $stepsOrdered[0];
    }

    /**
     * Si el paso no tiene responsable (profile_id null), cualquier usuario puede mover.
     * Si tiene responsable, solo coincide con el usuario logueado (user_id del perfil).
     */
    private function actorCanMoveKanban(NovedadStep $step): bool
    {
        if ($step->profile_id === null) {
            return true;
        }
        $uid = $this->currentActorUserId();
        if ($uid === null) {
            return false;
        }

        return (int) $step->profile_id === (int) $uid;
    }

    /**
     * @param NovedadStep[] $stepsOrdered
     */
    private function actorCanMoveKanbanFromCurrentStep(Novedad $novedad, array $stepsOrdered): bool
    {
        $step = $this->resolveKanbanStepForPermission($novedad, $stepsOrdered);
        if ($step === null) {
            return true;
        }

        return $this->actorCanMoveKanban($step);
    }

    /**
     * Primer paso del flujo (orden ascendente, luego id).
     */
    private function firstStepIdForFlujo(int $flujoId): ?int
    {
        $first = NovedadStep::find()
            ->where(['novedad_flujo_id' => $flujoId])
            ->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])
            ->one();

        return $first !== null ? (int) $first->id : null;
    }

    /**
     * Marca inicio en el paso destino y fin en el paso que se deja (tabla novedad_step).
     * También actualiza novedad_step.estado: el paso destino queda en curso; el paso que se deja queda
     * completado al avanzar o devuelto al retroceder en el orden del flujo.
     * Nota: las filas de paso son compartidas por el flujo; el último movimiento de cualquier novedad actualiza estos campos.
     *
     * @param int|null $fromStepId Paso anterior de la novedad (null si no había paso)
     * @param int|null $toStepId   Paso nuevo (null si se quitó el paso)
     * @param bool|null $isBackward true = retroceso en el orden del flujo; false o null = avance o alta / cambio de flujo
     */
    private function touchNovedadStepTimestampsOnPasoTransition(?int $fromStepId, ?int $toStepId, ?bool $isBackward = null): void
    {
        if ($fromStepId === $toStepId) {
            return;
        }
        $now = time();
        if ($fromStepId !== null) {
            $fromEstado = $isBackward === true
                ? NovedadStep::ESTADO_DEVUELTO
                : NovedadStep::ESTADO_COMPLETADO;
            NovedadStep::updateAll(
                [
                    'completed_at' => $now,
                    'updated_at' => $now,
                    'estado' => $fromEstado,
                ],
                ['id' => $fromStepId]
            );
        }
        if ($toStepId !== null) {
            NovedadStep::updateAll(
                [
                    'started_at' => $now,
                    'completed_at' => null,
                    'updated_at' => $now,
                    'estado' => NovedadStep::ESTADO_EN_CURSO,
                ],
                ['id' => $toStepId]
            );
        }
    }

    /**
     * @param bool $genericKanban Tarjeta genérica en tablero (sin nombre de concepto).
     * @return array<string, mixed>
     */
    private function serializeNovedadCard(Novedad $n, bool $genericKanban = false, bool $canMove = true): array
    {
        $base = [
            'id' => (int) $n->id,
            'paso_actual_id' => $n->paso_actual_id !== null ? (int) $n->paso_actual_id : null,
            'can_move' => $canMove,
        ];
        if ($genericKanban) {
            return $base;
        }
        $conceptoNombre = $n->concepto ? $n->concepto->nombre : ('#' . $n->concepto_id);

        return $base + [
            'estado' => $n->estado,
            'titulo' => $conceptoNombre,
            'estado_label' => $n->displayEstado(),
        ];
    }
}
