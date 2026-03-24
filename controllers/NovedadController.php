<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\City;
use app\models\Contrato;
use app\models\EmpresaCliente;
use app\models\EmpresaNovedadConcepto;
use app\models\Empresas;
use app\models\forms\NovedadSolicitudContextForm;
use app\models\LocationSedes;
use app\models\Novedad;
use app\models\NovedadConcepto;
use app\models\NovedadConceptoCargo;
use app\models\NovedadFlujo;
use app\models\NovedadStep;
use app\models\NovedadStepHistoryLog;
use app\models\NovedadTipo;
use app\models\NovedadTipoCampo;
use app\models\Profile;
use app\services\NovedadAuxilioMovilizacionResolver;
use app\services\NovedadConceptoFormularioService;
use app\services\NovedadGuard;
use app\services\NovedadHorasTroceoService;
use app\services\NovedadSettingResolver;
use Throwable;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * CRUD, flujos/kanban y solicitud web de novedades (tenant desde usuario logueado).
 */
class NovedadController extends Controller
{
    /** Sesión: IDs de novedades tipo Horas en borrador (resumen antes de confirmar). */
    private const SESSION_HORAS_BORRADOR = 'novedad_horas_borrador_resumen';

    public function behaviors(): array
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'create-ajax' => ['POST'],
                    'update-ajax' => ['POST'],
                    'move-step' => ['POST'],
                    'confirmar-borrador-horas' => ['POST'],
                    'eliminar-borrador-horas' => ['POST'],
                    'resumen-borrador-horas' => ['GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ]);
    }

    /**
     * Listado con DataTables (AJAX).
     *
     * @return string
     */
    public function actionIndex(): string
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
        $tipos = array_values(array_filter(
            $tipos,
            fn (NovedadTipo $t): bool => $this->usuarioPuedeCrearTipo($t)
        ));

        $conceptosFiltro = NovedadConcepto::find()
            ->where(['activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();

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
            'conceptosFiltro' => $conceptosFiltro,
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
            ->select(['n.*'])
            ->leftJoin(['c' => 'novedad_concepto'], 'c.id = n.concepto_id')
            ->leftJoin(['nt' => 'novedad_tipo'], 'nt.id = n.novedad_tipo_id')
            ->leftJoin(['ns' => 'novedad_step'], 'ns.id = n.paso_actual_id')
            ->leftJoin(['e' => 'empresas'], 'e.id = n.empresa_id')
            ->leftJoin(['p' => 'profile'], 'p.user_id = n.profile_id')
            ->with(['concepto', 'novedadTipo', 'novedadFlujo', 'pasoActual', 'profile', 'empresa'])
            ->where(['n.empresa_id' => $empresaId]);

        if ($hasFlujo) {
            $query->leftJoin(['nf' => 'novedad_flujo'], 'nf.id = n.novedad_flujo_id');
        }

        $filterEstado = trim((string) $request->get('filter_estado', ''));
        if ($filterEstado !== '') {
            $query->andWhere(['n.estado' => $filterEstado]);
        }
        $filterTipo = (int) $request->get('filter_novedad_tipo_id', 0);
        if ($filterTipo > 0) {
            $query->andWhere(['n.novedad_tipo_id' => $filterTipo]);
        }
        $filterConcepto = (int) $request->get('filter_concepto_id', 0);
        if ($filterConcepto > 0) {
            $query->andWhere(['n.concepto_id' => $filterConcepto]);
        }
        $filterProfile = (int) $request->get('filter_profile_id', 0);
        if ($filterProfile > 0) {
            $query->andWhere(['n.profile_id' => $filterProfile]);
        }
        $filterFechaDesde = trim((string) $request->get('filter_fecha_desde', ''));
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $filterFechaDesde)) {
            $query->andWhere(['>=', 'n.fecha_novedad', $filterFechaDesde]);
        }
        $filterFechaHasta = trim((string) $request->get('filter_fecha_hasta', ''));
        if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $filterFechaHasta)) {
            $query->andWhere(['<=', 'n.fecha_novedad', $filterFechaHasta]);
        }

        $totalCount = (int) Novedad::find()->where(['empresa_id' => $empresaId])->count();

        if ($searchValue !== '') {
            $or = [
                ['like', 'c.nombre', $searchValue],
                ['like', 'nt.nombre', $searchValue],
                ['like', 'n.estado', $searchValue],
                ['like', 'ns.nombre', $searchValue],
                ['like', 'ns.codigo', $searchValue],
                ['like', 'p.name', $searchValue],
                ['like', 'p.num_doc', $searchValue],
                ['like', 'e.name', $searchValue],
                ['like', 'e.social_name', $searchValue],
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
            $orderColumns = [
                'n.id',
                'e.name',
                'p.name',
                'n.importe',
                'c.nombre',
                'nt.nombre',
                'nf.nombre',
                'n.estado',
                'ns.nombre',
                null,
            ];
        } else {
            $orderColumns = [
                'n.id',
                'e.name',
                'p.name',
                'n.importe',
                'c.nombre',
                'nt.nombre',
                'n.estado',
                null,
            ];
        }
        $orderBy = $orderColumns[$orderCol] ?? 'n.id';
        if ($orderBy !== null) {
            $query->orderBy([$orderBy => $orderDir]);
        } else {
            $query->orderBy(['n.id' => SORT_DESC]);
        }

        /** @var Novedad[] $models */
        $models = $query->offset($start)->limit($length)->all();

        $fmt = Yii::$app->formatter;
        $data = [];
        foreach ($models as $model) {
            $emp = $model->empresa;
            $empresaNombre = $emp !== null
                ? (trim((string) ($emp->name ?: '')) !== '' ? (string) $emp->name : (string) ($emp->social_name ?: '—'))
                : '—';
            $prof = $model->profile;
            $personaNombre = '—';
            if ($prof !== null) {
                $nm = trim((string) ($prof->name ?? ''));
                $doc = trim((string) ($prof->num_doc ?? ''));
                if ($nm !== '' && $doc !== '') {
                    $personaNombre = $nm . ' · ' . $doc;
                } elseif ($nm !== '') {
                    $personaNombre = $nm;
                } elseif ($doc !== '') {
                    $personaNombre = $doc;
                }
            }
            $impRaw = $model->importe;
            $importeTxt = ($impRaw !== null && (string) $impRaw !== '')
                ? $fmt->asCurrency((float) $impRaw)
                : '—';

            $conceptoNombre = $model->concepto ? $model->concepto->nombre : ('#' . $model->concepto_id);
            $tipoNombre = $model->novedadTipo ? $model->novedadTipo->nombre : ('#' . $model->novedad_tipo_id);
            $estadoBadge = $this->estadoBadgeHtml($model);
            $row = [
                $model->id,
                Html::encode($empresaNombre),
                '<span class="text-dark">' . Html::encode($personaNombre) . '</span>',
                '<span class="text-end d-block fw-medium">' . Html::encode($importeTxt) . '</span>',
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
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            throw new NotFoundHttpException(Yii::t('app', 'La página solicitada no existe.'));
        }
        $model = Novedad::find()
            ->where(['id' => (int) $id, 'empresa_id' => $empresaId])
            ->with([
                'concepto',
                'novedadTipo',
                'novedadFlujo',
                'pasoActual',
                'empresa',
                'profile',
                'creador',
                'novedadCentroCosto',
                'novedadCentroUtilidad',
                'novedadOrigen',
                'novedadHorasDetalles' => static function ($q) {
                    $q->orderBy(['fecha_acusacion' => SORT_ASC, 'id' => SORT_ASC]);
                },
            ])
            ->one();
        if ($model === null) {
            throw new NotFoundHttpException(Yii::t('app', 'La página solicitada no existe.'));
        }

        return $this->renderPartial('_view_modal', [
            'model' => $model,
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
        if (!$model->isEstadoCargaBorrador()) {
            Yii::$app->response->statusCode = 403;

            return $this->renderPartial('_modal_novedad_no_editable', ['model' => $model]);
        }
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
        if (!$model->isEstadoCargaBorrador()) {
            return [
                'success' => false,
                'errors' => [
                    'general' => [
                        Yii::t('app', 'Solo se pueden guardar cambios en novedades con carga en borrador.'),
                    ],
                ],
            ];
        }

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
        if (!$this->usuarioPuedeCrearTipo($tipo)) {
            return ['success' => false, 'message' => 'No tiene permiso para crear este tipo de novedad.'];
        }

        $concepto = NovedadConcepto::findOne(['id' => $conceptoId, 'activo' => 1]);
        if ($concepto === null || (int) $concepto->novedad_tipo_id !== $tipoId) {
            return ['success' => false, 'message' => 'El concepto no corresponde al tipo seleccionado.'];
        }

        $hasFlujoCol = Novedad::hasNovedadFlujoIdColumn();
        if ($hasFlujoCol) {
            if ($flujoId <= 0) {
                return ['success' => false, 'message' => 'Seleccione un flujo de novedad.'];
            }
            $flujo = NovedadFlujo::findOne(['id' => $flujoId, 'estado' => NovedadFlujo::ESTADO_ACTIVO]);
            if ($flujo === null) {
                return ['success' => false, 'message' => 'Seleccione un flujo activo.'];
            }
        } elseif ($flujoId > 0) {
            $flujo = NovedadFlujo::findOne(['id' => $flujoId, 'estado' => NovedadFlujo::ESTADO_ACTIVO]);
            if ($flujo === null) {
                return ['success' => false, 'message' => 'Flujo inválido.'];
            }
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
        if ($hasFlujoCol) {
            $model->setAttribute('novedad_flujo_id', $flujoId);
        }
        $model->paso_actual_id = $flujoId > 0 ? $this->firstStepIdForFlujo($flujoId) : null;
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
        if (!$this->usuarioPuedeCrearTipo($tipo)) {
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
    public function actionView($id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Formulario web de solicitud de novedad (create-ajax sigue para modal administrativo).
     *
     * @return string|Response
     */
    public function actionCreate(): Response|string
    {
        $tenantId = $this->currentEmpresaId();
        $empresa = $tenantId ? Empresas::findOne($tenantId) : null;

        $ctx = new NovedadSolicitudContextForm();
        $ctx->setEmpresasId($tenantId);

        $model = new Novedad();
        $model->loadDefaultValues();

        if ($tenantId === null) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'No tiene organización asignada en su perfil.'));

            return $this->render('create', $this->createViewParams($model, $ctx, $empresa, null));
        }

        $clientesActivos = EmpresaCliente::getActivos($tenantId);
        if ($clientesActivos === []) {
            Yii::$app->session->setFlash(
                'warning',
                Yii::t(
                    'app',
                    'No hay empresas cliente activas para su organización. Solicitá la configuración en administración antes de cargar novedades.'
                )
            );
        }

        if ($this->request->isPost) {
            $ctx->load($this->request->post());
            $model->load($this->request->post());
            $model->empresa_id = $tenantId;

            $auxilioMovilizacion = (bool) $this->request->post('auxilio_movilizacion', false);

            $tipo = null;
            if ($ctx->novedad_tipo_id !== null) {
                $tipoCond = [
                    'id' => $ctx->novedad_tipo_id,
                    'activo' => 1,
                ];
                if ($this->novedadTipoTieneColumnaEmpresa()) {
                    $tipoCond['empresa_id'] = $tenantId;
                }
                $tipo = NovedadTipo::findOne($tipoCond);
            }

            $this->mergeSolicitudDatos($model, $ctx);

            if (!$ctx->validate()) {
                Yii::$app->session->setFlash('error', Yii::t('app', 'Revise el contexto de la solicitud.'));

                return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
            }

            $model->novedad_tipo_id = (int) $ctx->novedad_tipo_id;

            if ($tipo !== null && $tipo->esTipoHoras()) {
                return $this->procesarSolicitudHoras($model, $ctx, $tipo, $auxilioMovilizacion, $empresa);
            }

            $model->scenario = Novedad::SCENARIO_SOLICITUD_WEB;
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Solicitud registrada en borrador.'));

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', $this->createViewParams($model, $ctx, $empresa, null));
    }

    /**
     * Resumen de solicitudes tipo Horas en borrador antes de confirmar envío.
     */
    public function actionResumenBorradorHoras(): string|Response
    {
        $pack = $this->obtieneNovedadesBorradorHorasSesionValidadas();
        if ($pack === null) {
            Yii::$app->session->setFlash(
                'warning',
                Yii::t('app', 'No hay un borrador de horas para revisar o la sesión expiró.')
            );

            return $this->redirect(['index']);
        }

        return $this->render('resumen-borrador-horas', [
            'novedades' => $pack['novedades'],
            'ids' => $pack['ids'],
            'origenId' => $pack['origen_id'],
        ]);
    }

    /**
     * Confirma el envío del borrador (pendiente o aprobada según flujo del tipo).
     */
    public function actionConfirmarBorradorHoras(): Response
    {
        $pack = $this->obtieneNovedadesBorradorHorasSesionValidadas();
        if ($pack === null) {
            Yii::$app->session->setFlash('warning', Yii::t('app', 'No hay borrador válido para confirmar.'));

            return $this->redirect(['index']);
        }

        $primerTipoId = (int) ($pack['novedades'][0]->novedad_tipo_id ?? 0);
        $nuevoEstado = NovedadTipo::tipoTieneFlujoAprobacion($primerTipoId)
            ? Novedad::ESTADO_PENDIENTE
            : Novedad::ESTADO_APROBADA;

        $tx = Yii::$app->db->beginTransaction();
        try {
            Novedad::updateAll(
                ['estado' => $nuevoEstado],
                ['id' => $pack['ids'], 'estado' => Novedad::ESTADO_BORRADOR]
            );
            $tx->commit();
        } catch (Throwable $e) {
            $tx->rollBack();
            Yii::error($e, __METHOD__);
            Yii::$app->session->setFlash('error', Yii::t('app', 'No se pudo confirmar el envío.'));

            return $this->redirect(['resumen-borrador-horas']);
        }

        Yii::$app->session->remove(self::SESSION_HORAS_BORRADOR);
        Yii::$app->session->setFlash(
            'success',
            $nuevoEstado === Novedad::ESTADO_APROBADA
                ? Yii::t('app', 'Solicitudes registradas y aprobadas automáticamente (este tipo no tiene flujo de aprobación).')
                : Yii::t('app', 'Solicitudes enviadas correctamente.')
        );

        return $this->redirect(['index']);
    }

    /**
     * Elimina todas las novedades del borrador de horas.
     */
    public function actionEliminarBorradorHoras(): Response
    {
        $pack = $this->obtieneNovedadesBorradorHorasSesionValidadas();
        if ($pack === null) {
            Yii::$app->session->setFlash('warning', Yii::t('app', 'No hay borrador válido para eliminar.'));

            return $this->redirect(['index']);
        }

        $ids = $pack['ids'];
        $origenId = (int) $pack['origen_id'];

        $tx = Yii::$app->db->beginTransaction();
        try {
            if ($origenId > 0) {
                $hijas = array_values(array_diff($ids, [$origenId]));
                if ($hijas !== []) {
                    Novedad::deleteAll(['id' => $hijas]);
                }
                Novedad::deleteAll(['id' => $origenId]);
            } else {
                Novedad::deleteAll(['id' => $ids]);
            }
            $tx->commit();
        } catch (Throwable $e) {
            $tx->rollBack();
            Yii::error($e, __METHOD__);
            Yii::$app->session->setFlash('error', Yii::t('app', 'No se pudieron eliminar las solicitudes.'));

            return $this->redirect(['resumen-borrador-horas']);
        }

        Yii::$app->session->remove(self::SESSION_HORAS_BORRADOR);
        Yii::$app->session->setFlash('info', Yii::t('app', 'Borrador eliminado.'));

        return $this->redirect(['index']);
    }

    private function procesarSolicitudHoras(
        Novedad $model,
        NovedadSolicitudContextForm $ctx,
        NovedadTipo $tipo,
        bool $auxilioMovilizacion,
        ?Empresas $empresa
    ): string|Response {
        $model->scenario = Novedad::SCENARIO_SOLICITUD_HORAS_AUTO;
        $model->concepto_id = null;
        $tenantId = (int) $model->empresa_id;
        $allowed = $this->empresasIdsDisponiblesParaSolicitud();
        if (!in_array($tenantId, $allowed, true)) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Organización no permitida.'));

            return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
        }

        $empleado = Profile::findOne(['user_id' => $model->profile_id]);
        if ($empleado === null
            || (int) $empleado->empresas_id !== $tenantId
            || $empleado->estado !== Profile::ESTADO_ACTIVO) {
            $model->addError('profile_id', Yii::t('app', 'Seleccione un empleado activo de la organización indicada.'));
        }

        if (!$model->validate() || $model->hasErrors()) {
            $this->setFlashFirstModelError($model);

            return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
        }

        $eidCtx = $tenantId;
        $pidModel = (int) $model->profile_id;
        $fechaNovedad = (string) ($model->fecha_novedad ?? '');
        $cargoAplicaClases = $this->empleadoAplicaConceptoClasesGrupales($eidCtx, $pidModel, $fechaNovedad);
        $auxilioPost = $auxilioMovilizacion;
        $importeAux = NovedadAuxilioMovilizacionResolver::importePredeterminado($eidCtx);
        if ($auxilioPost) {
            if (!$cargoAplicaClases) {
                $auxilioPost = false;
            } elseif ($importeAux === null || $importeAux < 0.01) {
                $model->addError(
                    'importe',
                    Yii::t('app', 'No hay importe de auxilio de movilización configurado. Revise los parámetros de la aplicación o contacte al administrador.')
                );
            }
        }
        if ($model->hasErrors()) {
            $this->setFlashFirstModelError($model);

            return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
        }

        $datosValores = $this->extractDatosCamposDinamicosFromPost();
        $troceo = $this->guardarSolicitudTipoHorasTroceada(
            $model,
            $ctx,
            $allowed,
            $datosValores,
            $auxilioPost,
            $importeAux
        );
        if (!$troceo['ok']) {
            $model->addError('fecha_novedad', $troceo['error']);
            Yii::$app->session->setFlash('error', $troceo['error']);

            return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
        }

        Yii::$app->session->set(self::SESSION_HORAS_BORRADOR, [
            'ids' => $troceo['ids'],
            'origen_id' => $troceo['origen_id'],
        ]);

        return $this->redirect(['resumen-borrador-horas']);
    }

    private function setFlashFirstModelError(Novedad $model): void
    {
        if (!$model->hasErrors()) {
            return;
        }
        $errors = $model->getFirstErrors();
        if ($errors === []) {
            return;
        }
        $first = reset($errors);
        if (is_string($first) && $first !== '') {
            Yii::$app->session->setFlash('error', $first);
        }
    }

    /**
     * Campos dinámicos enviados dentro del JSON {@see Novedad::$datos} (`campos_dinamicos`), para {@see aplicarFormularioConceptoYSaveDatos}.
     *
     * @return array<string, mixed>
     */
    private function extractDatosCamposDinamicosFromPost(): array
    {
        $novedadPosted = $this->request->post('Novedad', []);
        $raw = $novedadPosted['datos'] ?? null;
        if (is_array($raw)) {
            return $raw;
        }
        if (!is_string($raw) || trim($raw) === '') {
            return [];
        }
        try {
            $decoded = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
            if (!is_array($decoded)) {
                return [];
            }
            $campos = $decoded['campos_dinamicos'] ?? [];

            return is_array($campos) ? $campos : [];
        } catch (\JsonException $e) {
            return [];
        }
    }

    /**
     * @return int[]
     */
    private function empresasIdsDisponiblesParaSolicitud(): array
    {
        $id = $this->currentEmpresaId();

        return $id !== null && $id > 0 ? [$id] : [];
    }

    private function esNovedadTipoHoras(int $tipoId): bool
    {
        if ($tipoId <= 0) {
            return false;
        }
        $t = NovedadTipo::findOne($tipoId);

        return $t !== null && $t->esTipoHoras();
    }

    /**
     * @param int|null $empleadoProfileUserId user_id del empleado (profile)
     * @param int|null $novedadTipoId si se indica (>0), solo conceptos de ese tipo
     * @param string|null $fechaContratoYmd si se indica, contrato según {@see Contrato::findOccupyingAt} (no solo estado activo)
     *
     * @return NovedadConcepto[]
     */
    private function conceptosAplicablesParaSolicitud(
        int $empresaId,
        ?int $empleadoProfileUserId = null,
        ?int $novedadTipoId = null,
        ?string $fechaContratoYmd = null
    ): array {
        $ids = EmpresaNovedadConcepto::find()
            ->select('novedad_concepto_id')
            ->where(['empresa_id' => $empresaId])
            ->column();
        if ($ids === []) {
            return [];
        }

        $q = NovedadConcepto::find()
            ->where(['id' => $ids, 'activo' => 1])
            ->with(['novedadTipo'])
            ->orderBy(['nombre' => SORT_ASC]);
        if ($novedadTipoId !== null && $novedadTipoId > 0) {
            $q->andWhere(['novedad_tipo_id' => $novedadTipoId]);
        }

        $conceptos = $q->all();
        $out = [];
        $fechaOk = $fechaContratoYmd !== null && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaContratoYmd);
        foreach ($conceptos as $c) {
            $tipo = $c->novedadTipo;
            if ($tipo === null || !(int) $tipo->activo) {
                continue;
            }
            if (!Yii::$app->user->can($tipo->getPermisoCrearNombre())) {
                continue;
            }
            if ($empleadoProfileUserId !== null && $empleadoProfileUserId > 0) {
                if ($fechaOk) {
                    if (NovedadGuard::contratoOcupaPlantaALaFecha($empresaId, $empleadoProfileUserId, $fechaContratoYmd) === null) {
                        continue;
                    }
                } elseif (NovedadGuard::contratoActivoEnEmpresa($empresaId, $empleadoProfileUserId) === null) {
                    continue;
                }
                if (!NovedadGuard::conceptoTieneCargosAplicabilidad((int) $c->id)) {
                    continue;
                }
                if (!NovedadGuard::empleadoContratoYCargoCumplenConcepto(
                    $empresaId,
                    $empleadoProfileUserId,
                    (int) $c->id,
                    $fechaOk ? $fechaContratoYmd : null
                )) {
                    continue;
                }
            }
            $out[] = $c;
        }

        return $out;
    }

    /**
     * @param array<string, mixed> $postedDatos
     */
    private function aplicarFormularioConceptoYSaveDatos(
        Novedad $model,
        ?NovedadConcepto $concepto,
        array $postedDatos,
        ?NovedadSolicitudContextForm $ctx = null
    ): void {
        if ($concepto === null || $model->hasErrors()) {
            return;
        }

        $mergeCtx = static function (array $datos, ?NovedadSolicitudContextForm $c): array {
            if ($c === null) {
                return $datos;
            }
            $datos['empresa_cliente_id'] = (string) $c->empresa_cliente_id;
            $datos['ciudad_id'] = (string) $c->ciudad_id;
            $datos['sede_id'] = (string) $c->sede_id;

            return $datos;
        };

        $campos = NovedadConceptoFormularioService::camposOrdenados($concepto);
        if ($campos === []) {
            if ($ctx === null) {
                return;
            }
            $datosMin = [];
            if ($model->horas_calculadas !== null) {
                $datosMin['horas_cantidad'] = (string) $model->horas_calculadas;
            }
            if (!empty($model->fecha_novedad)) {
                $datosMin['fecha_novedad'] = (string) $model->fecha_novedad;
            }
            try {
                $model->datos = json_encode($mergeCtx($datosMin, $ctx), JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                $model->addError('datos', Yii::t('app', 'Error al serializar los datos del formulario.'));
            }

            return;
        }

        $adjunto = UploadedFile::getInstanceByName('datos[adjunto_pdf]');
        NovedadConceptoFormularioService::validarCampos($model, $concepto, $postedDatos, $adjunto);

        if ($model->hasErrors()) {
            return;
        }

        $datosLimpios = NovedadConceptoFormularioService::datosLimpiosParaJson($postedDatos, $concepto);
        $datosLimpios = $mergeCtx($datosLimpios, $ctx);

        $cod = strtoupper((string) $concepto->codigo);
        $codigosHorasJson = [
            strtoupper(NovedadHorasTroceoService::COD_CLASES_GRUPALES),
            strtoupper(NovedadHorasTroceoService::COD_HORAS_EXTRAS),
            strtoupper(NovedadHorasTroceoService::COD_REC_DOM_FEST),
            strtoupper(NovedadHorasTroceoService::COD_REC_NOCT),
            strtoupper(NovedadHorasTroceoService::COD_REC_NOCT_FEST),
            strtoupper(NovedadHorasTroceoService::COD_REC_NOCT_DOM_FEST),
        ];
        if (in_array($cod, $codigosHorasJson, true)) {
            $model->normalizarHorasYCalcular();
            if ($model->horas_calculadas !== null) {
                $datosLimpios['horas_cantidad'] = (string) $model->horas_calculadas;
            }
            if (!empty($model->fecha_novedad)) {
                $datosLimpios['fecha_novedad'] = (string) $model->fecha_novedad;
            }
        }

        if ($adjunto instanceof UploadedFile && $adjunto->error === UPLOAD_ERR_OK) {
            $path = NovedadConceptoFormularioService::guardarAdjuntoPdf($adjunto, (int) $model->empresa_id);
            if ($path === null) {
                $model->addError('datos', Yii::t('app', 'No se pudo guardar el archivo PDF.'));

                return;
            }
            $datosLimpios['adjunto_pdf'] = $path;
        }

        try {
            $model->datos = $datosLimpios === []
                ? '{}'
                : json_encode($datosLimpios, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $model->addError('datos', Yii::t('app', 'Error al serializar los datos del formulario.'));
        }
    }

    private function validarReglasNovedad(Novedad $model): void
    {
        $concepto = NovedadConcepto::findOne($model->concepto_id);
        if ($concepto === null) {
            $model->addError('concepto_id', 'Concepto no válido.');

            return;
        }
        $tipo = $concepto->novedadTipo;
        if ($tipo === null || !(int) $tipo->activo) {
            $model->addError('concepto_id', 'El tipo de novedad no está activo.');

            return;
        }
        if (!$model->puedeCrearSegunTipo()) {
            $model->addError('concepto_id', 'No tiene permiso para crear novedades de este tipo.');
        }
        if (!NovedadGuard::conceptoHabilitadoParaEmpresa((int) $model->empresa_id, (int) $model->concepto_id)) {
            $model->addError('concepto_id', 'Este concepto no está habilitado para la empresa (tenant).');
        }
        $fechaContrato = (string) ($model->fecha_novedad ?? '');
        $fechaContratoOk = preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaContrato);
        $tieneContrato = $fechaContratoOk
            ? NovedadGuard::contratoOcupaPlantaALaFecha((int) $model->empresa_id, (int) $model->profile_id, $fechaContrato) !== null
            : NovedadGuard::contratoActivoEnEmpresa((int) $model->empresa_id, (int) $model->profile_id) !== null;
        if (!$tieneContrato) {
            $model->addError(
                'profile_id',
                Yii::t('app', 'No hay contrato vigente para el empleado en la fecha indicada.')
            );
        } elseif (!NovedadGuard::conceptoTieneCargosAplicabilidad((int) $model->concepto_id)) {
            $model->addError('concepto_id', Yii::t('app', 'Configure al menos un cargo de aplicabilidad para este concepto.'));
        } elseif (!NovedadGuard::empleadoContratoYCargoCumplenConcepto(
            (int) $model->empresa_id,
            (int) $model->profile_id,
            (int) $model->concepto_id,
            $fechaContratoOk ? $fechaContrato : null
        )) {
            $model->addError('profile_id', Yii::t('app', 'El cargo del contrato vigente del empleado no está habilitado para este concepto.'));
        }
        if (!Yii::$app->user->isGuest && !NovedadGuard::gerenteSedePuedeParaEmpleado((int) Yii::$app->user->id, (int) $model->profile_id)) {
            $model->addError('profile_id', 'Solo puede registrar novedades para empleados de su misma sede (location_sede).');
        }
    }

    /**
     * @param int[] $allowed
     * @param array<string, mixed> $datosValores
     *
     * @return array{ok: bool, error: string, ids: int[], origen_id: int}
     */
    private function guardarSolicitudTipoHorasTroceada(
        Novedad $plantilla,
        NovedadSolicitudContextForm $ctx,
        array $allowed,
        array $datosValores,
        bool $solicitarAuxilioMovilizacion = false,
        ?float $importeAuxilioMovilizacion = null
    ): array {
        $fail = static function (string $msg): array {
            return ['ok' => false, 'error' => $msg, 'ids' => [], 'origen_id' => 0];
        };

        $empresaId = (int) $plantilla->empresa_id;
        $profileId = (int) $plantilla->profile_id;
        if (!in_array($empresaId, $allowed, true)) {
            return $fail(Yii::t('app', 'Organización no permitida.'));
        }

        try {
            $setting = NovedadSettingResolver::resolveForEmpresaYFecha($empresaId, (string) $plantilla->fecha_novedad);
        } catch (Throwable $e) {
            return $fail($e->getMessage());
        }

        try {
            $fragmentos = NovedadHorasTroceoService::trocear(
                (string) $plantilla->fecha_novedad,
                (string) $plantilla->hora_inicio,
                (string) $plantilla->hora_fin,
                $setting
            );
        } catch (Throwable $e) {
            return $fail($e->getMessage());
        }

        if ($fragmentos === []) {
            return $fail(Yii::t('app', 'No se generó ningún fragmento de horas; revise el rango.'));
        }

        $fechaPlantilla = (string) $plantilla->fecha_novedad;
        $cargoAplicaClases = $this->empleadoAplicaConceptoClasesGrupales($empresaId, $profileId, $fechaPlantilla);
        foreach ($fragmentos as $i => $frag) {
            if ($frag['codigo'] === NovedadHorasTroceoService::COD_CLASES_GRUPALES && !$cargoAplicaClases) {
                $fragmentos[$i]['codigo'] = NovedadHorasTroceoService::COD_HORAS_EXTRAS;
            }
        }

        $codigos = array_values(array_unique(array_column($fragmentos, 'codigo')));
        /** @var array<string, NovedadConcepto> $conceptosPorCodigo */
        $conceptosPorCodigo = NovedadConcepto::find()
            ->where(['codigo' => $codigos, 'activo' => 1])
            ->indexBy('codigo')
            ->all();
        foreach ($codigos as $cod) {
            if (!isset($conceptosPorCodigo[$cod])) {
                return $fail(Yii::t('app', 'Falta el concepto con código «{c}» en el catálogo.', ['c' => $cod]));
            }
        }

        $aplicables = $this->conceptosAplicablesParaSolicitud($empresaId, $profileId, null, $fechaPlantilla);
        $aplicableIds = [];
        foreach ($aplicables as $c) {
            $aplicableIds[(int) $c->id] = true;
        }
        foreach ($fragmentos as $frag) {
            $cid = (int) $conceptosPorCodigo[$frag['codigo']]->id;
            if (!isset($aplicableIds[$cid])) {
                return $fail(Yii::t('app', 'El concepto «{c}» no aplica a este empleado o no está habilitado.', ['c' => $frag['codigo']]));
            }
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            $primeraId = null;
            $idsCreados = [];
            foreach ($fragmentos as $frag) {
                $concObj = $conceptosPorCodigo[$frag['codigo']];
                $n = new Novedad();
                $n->setScenario(Novedad::SCENARIO_SOLICITUD_WEB);
                $n->empresa_id = $plantilla->empresa_id;
                $n->profile_id = $plantilla->profile_id;
                $n->novedad_tipo_id = $plantilla->novedad_tipo_id;
                $n->concepto_id = (int) $concObj->id;
                $n->fecha_novedad = $frag['fecha_novedad'];
                $n->hora_inicio = $frag['hora_inicio'];
                $n->hora_fin = $frag['hora_fin'];
                $n->descripcion = $plantilla->descripcion;
                $n->novedad_origen_id = $primeraId;
                $n->estado = Novedad::ESTADO_BORRADOR;
                $n->estado_carga = Novedad::ESTADO_CARGA_CREADA;
                $n->importe = 0;

                $this->validarReglasNovedad($n);
                if ($n->hasErrors()) {
                    $tx->rollBack();

                    return $fail(implode(' ', $n->getFirstErrors()));
                }

                $this->aplicarFormularioConceptoYSaveDatos($n, $concObj, $datosValores, $ctx);
                if ($n->hasErrors()) {
                    $tx->rollBack();

                    return $fail(implode(' ', $n->getFirstErrors()));
                }

                if (!$n->save()) {
                    $tx->rollBack();

                    return $fail(implode(' ', $n->getFirstErrors()));
                }

                $idsCreados[] = (int) $n->id;
                if ($primeraId === null) {
                    $primeraId = (int) $n->id;
                }
            }

            if ($solicitarAuxilioMovilizacion
                && $cargoAplicaClases
                && $importeAuxilioMovilizacion !== null
                && $importeAuxilioMovilizacion >= 0.01
                && $primeraId !== null) {
                $concAux = NovedadConcepto::find()
                    ->where(['codigo' => NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION, 'activo' => 1])
                    ->one();
                if ($concAux === null) {
                    $tx->rollBack();

                    return $fail(Yii::t('app', 'No está configurado el concepto de auxilio de movilización.'));
                }
                $auxId = (int) $concAux->id;
                if (!isset($aplicableIds[$auxId])) {
                    $tx->rollBack();

                    return $fail(Yii::t('app', 'El auxilio de movilización no aplica a este empleado o no está habilitado.'));
                }
                $na = new Novedad();
                $na->setScenario(Novedad::SCENARIO_AUXILIO_MOVILIZACION);
                $na->empresa_id = $plantilla->empresa_id;
                $na->profile_id = $plantilla->profile_id;
                $na->novedad_tipo_id = $plantilla->novedad_tipo_id;
                $na->concepto_id = $auxId;
                $na->fecha_novedad = (string) $plantilla->fecha_novedad;
                $na->hora_inicio = null;
                $na->hora_fin = null;
                $na->horas_calculadas = null;
                $na->importe = (string) $importeAuxilioMovilizacion;
                $na->novedad_origen_id = $primeraId;
                $na->descripcion = $plantilla->descripcion;
                $na->estado = Novedad::ESTADO_BORRADOR;
                $na->estado_carga = Novedad::ESTADO_CARGA_CREADA;

                $this->validarReglasNovedad($na);
                if ($na->hasErrors()) {
                    $tx->rollBack();

                    return $fail(implode(' ', $na->getFirstErrors()));
                }
                $this->aplicarFormularioConceptoYSaveDatos($na, $concAux, $datosValores, $ctx);
                if ($na->hasErrors()) {
                    $tx->rollBack();

                    return $fail(implode(' ', $na->getFirstErrors()));
                }
                if (!$na->save()) {
                    $tx->rollBack();

                    return $fail(implode(' ', $na->getFirstErrors()));
                }
                $idsCreados[] = (int) $na->id;
            }

            $tx->commit();

            return [
                'ok' => true,
                'error' => '',
                'ids' => $idsCreados,
                'origen_id' => $primeraId ?? 0,
            ];
        } catch (Throwable $e) {
            $tx->rollBack();
            Yii::error($e, __METHOD__);

            return $fail(Yii::t('app', 'Error al guardar las novedades.'));
        }
    }

    /**
     * Misma regla que {@see conceptoClasesGrupalesParaAplicabilidad()} pero solo el id (para JSON y troceo).
     */
    private static function conceptoIdClasesGrupalesParaCargoAplicabilidad(): ?int
    {
        $cg = NovedadConcepto::find()
            ->where(['codigo' => NovedadHorasTroceoService::COD_CLASES_GRUPALES, 'activo' => 1])
            ->one();
        if ($cg !== null) {
            return (int) $cg->id;
        }
        if (NovedadConcepto::find()->where(['codigo' => NovedadHorasTroceoService::COD_CLASES_GRUPALES])->exists()) {
            return null;
        }
        $hx = NovedadConcepto::find()
            ->where(['codigo' => NovedadHorasTroceoService::COD_HORAS_EXTRAS, 'activo' => 1])
            ->one();

        return $hx !== null ? (int) $hx->id : null;
    }

    private function conceptoClasesGrupalesParaAplicabilidad(): ?NovedadConcepto
    {
        $id = self::conceptoIdClasesGrupalesParaCargoAplicabilidad();

        return $id !== null ? NovedadConcepto::findOne($id) : null;
    }

    private function empleadoAplicaConceptoClasesGrupales(int $empresaId, int $profileUserId, ?string $fechaYmd = null): bool
    {
        if ($empresaId <= 0 || $profileUserId <= 0) {
            return false;
        }
        $conc = $this->conceptoClasesGrupalesParaAplicabilidad();
        if ($conc === null) {
            return false;
        }
        if (!NovedadGuard::conceptoHabilitadoParaEmpresa($empresaId, (int) $conc->id)) {
            return false;
        }
        if (!NovedadGuard::conceptoTieneCargosAplicabilidad((int) $conc->id)) {
            return false;
        }

        $fechaOk = $fechaYmd !== null && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaYmd);

        return NovedadGuard::empleadoContratoYCargoCumplenConcepto(
            $empresaId,
            $profileUserId,
            (int) $conc->id,
            $fechaOk ? $fechaYmd : null
        );
    }

    /**
     * @return array{novedades: Novedad[], ids: int[], origen_id: int}|null
     */
    private function obtieneNovedadesBorradorHorasSesionValidadas(): ?array
    {
        $pack = Yii::$app->session->get(self::SESSION_HORAS_BORRADOR);
        if (!is_array($pack) || empty($pack['ids']) || !is_array($pack['ids'])) {
            return null;
        }
        $ids = array_values(array_unique(array_map('intval', $pack['ids'])));
        $origenId = (int) ($pack['origen_id'] ?? 0);

        $allowed = $this->empresasIdsDisponiblesParaSolicitud();
        if ($allowed === []) {
            return null;
        }

        /** @var Novedad[] $novedades */
        $novedades = Novedad::find()
            ->where(['id' => $ids])
            ->with(['concepto', 'novedadTipo', 'profile', 'empresa'])
            ->all();

        if (count($novedades) !== count($ids)) {
            return null;
        }

        foreach ($novedades as $n) {
            if ((string) $n->estado !== Novedad::ESTADO_BORRADOR) {
                return null;
            }
            if (!in_array((int) $n->empresa_id, $allowed, true)) {
                return null;
            }
            if (!$this->esNovedadTipoHoras((int) $n->novedad_tipo_id)) {
                return null;
            }
            if (!Yii::$app->user->isGuest && !NovedadGuard::gerenteSedePuedeParaEmpleado((int) Yii::$app->user->id, (int) $n->profile_id)) {
                return null;
            }
        }

        usort($novedades, static function (Novedad $a, Novedad $b): int {
            $fa = ($a->fecha_novedad ?? '') . ' ' . ($a->hora_inicio ?? '');
            $fb = ($b->fecha_novedad ?? '') . ' ' . ($b->hora_inicio ?? '');

            return $fa <=> $fb;
        });

        return [
            'novedades' => $novedades,
            'ids' => $ids,
            'origen_id' => $origenId,
        ];
    }

    public static function cargoAplicaClasesGrupales(int $cargoId): bool
    {
        if ($cargoId <= 0) {
            return false;
        }
        $conceptoId = self::conceptoIdClasesGrupalesParaCargoAplicabilidad();
        if ($conceptoId === null) {
            return false;
        }

        return NovedadConceptoCargo::find()->where([
            'novedad_concepto_id' => $conceptoId,
            'cargo_id' => $cargoId,
        ])->exists();
    }

    private function mergeSolicitudDatos(Novedad $model, NovedadSolicitudContextForm $ctx): void
    {
        $raw = $model->datos;
        $datos = [];
        if (is_string($raw) && $raw !== '') {
            try {
                $datos = json_decode($raw, true, 512, JSON_THROW_ON_ERROR) ?: [];
            } catch (\JsonException $e) {
                $datos = [];
            }
        }
        $datos['solicitud'] = [
            'empresa_cliente_id' => $ctx->empresa_cliente_id,
            'ciudad_id' => $ctx->ciudad_id,
            'sede_id' => $ctx->sede_id,
        ];
        try {
            $model->datos = json_encode($datos, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $model->datos = '{}';
        }
    }

    /**
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    private function createViewParams(
        Novedad $model,
        NovedadSolicitudContextForm $ctx,
        ?Empresas $empresa,
        ?NovedadTipo $tipoSeleccionado
    ): array {
        $tenantId = $this->currentEmpresaId();
        $horasCodigo = (string) (Yii::$app->params['novedad_horas_tipo_codigo'] ?? 'horas');
        $horasTipo = null;
        if ($tenantId) {
            $hq = NovedadTipo::find()->where(['activo' => 1])->andWhere(['codigo' => $horasCodigo]);
            if ($this->novedadTipoTieneColumnaEmpresa()) {
                $hq->andWhere(['empresa_id' => $tenantId]);
            }
            $horasTipo = $hq->one();
        }

        $clientesEmpresa = $tenantId ? EmpresaCliente::getActivos($tenantId) : [];
        $clienteUnico = count($clientesEmpresa) === 1 ? $clientesEmpresa[0] : null;
        if (
            $clienteUnico !== null
            && ($ctx->empresa_cliente_id === null || (int) $ctx->empresa_cliente_id <= 0)
        ) {
            $ctx->empresa_cliente_id = (int) $clienteUnico->id;
        }

        return [
            'model' => $model,
            'ctx' => $ctx,
            'empresa' => $empresa,
            'tipoSeleccionado' => $tipoSeleccionado,
            'horasTipoId' => $horasTipo ? (int) $horasTipo->id : null,
            'clientesEmpresa' => $clientesEmpresa,
            'clienteUnico' => $clienteUnico,
            'sinEmpresaCliente' => $tenantId !== null && $clientesEmpresa === [],
            'msgHorasRangoInvalido' => Yii::t(
                'app',
                'La hora final debe ser posterior a la hora inicial (mismo día; no puede ser anterior ni igual).'
            ),
            'solicitudFormState' => $this->buildSolicitudFormStateForView($model, $ctx),
        ];
    }

    /**
     * Valores del último POST para repoblar selects AJAX tras errores de validación.
     *
     * @return array<string, mixed>
     */
    private function buildSolicitudFormStateForView(Novedad $model, NovedadSolicitudContextForm $ctx): array
    {
        $state = [
            'novedad_tipo_id' => $ctx->novedad_tipo_id !== null ? (int) $ctx->novedad_tipo_id : null,
            'ciudad_id' => $ctx->ciudad_id !== null ? (int) $ctx->ciudad_id : null,
            'sede_id' => $ctx->sede_id !== null ? (int) $ctx->sede_id : null,
            'profile_id' => $model->profile_id !== null ? (int) $model->profile_id : null,
            'concepto_id' => $model->concepto_id !== null ? (int) $model->concepto_id : null,
            'num_doc' => null,
            'cargo_id' => null,
            'auxilio_movilizacion' => (int) Yii::$app->request->post('auxilio_movilizacion', 0) === 1,
        ];
        if ($model->profile_id !== null && (int) $model->profile_id > 0) {
            $pf = Profile::findOne(['user_id' => (int) $model->profile_id]);
            if ($pf !== null && $pf->num_doc !== null && trim((string) $pf->num_doc) !== '') {
                $state['num_doc'] = trim((string) $pf->num_doc);
            }
        }
        $tenantId = $this->currentEmpresaId();
        $fecha = (string) ($model->fecha_novedad ?? '');
        if ($tenantId !== null && $model->profile_id !== null
            && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            $ctr = Contrato::findOccupyingAt($fecha)
                ->andWhere([
                    'contrato.profile_id' => (int) $model->profile_id,
                    'contrato.empresa_id' => (int) $tenantId,
                ])
                ->one();
            if ($ctr !== null) {
                $state['cargo_id'] = (int) $ctr->cargo_id;
            }
        }

        return $state;
    }

    public function actionUpdate($id): Response|string
    {
        $model = $this->findModel($id);
        if (!$model->isEstadoCargaBorrador()) {
            Yii::$app->session->setFlash(
                'warning',
                Yii::t('app', 'Solo se pueden editar novedades con carga en borrador.')
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }
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
        $model = $this->findModel($id);
        if (!$model->isEstadoCargaBorrador()) {
            $msg = Yii::t('app', 'Solo se pueden eliminar novedades con carga en borrador.');
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->statusCode = 403;

                return ['success' => false, 'message' => $msg];
            }
            Yii::$app->session->setFlash('warning', $msg);

            return $this->redirect(['index']);
        }
        $model->delete();

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
    protected function findModel($id): Novedad
    {
        $empresaId = $this->currentEmpresaId();
        if ($empresaId === null) {
            throw new NotFoundHttpException(Yii::t('app', 'La página solicitada no existe.'));
        }
        $model = Novedad::findOne(['id' => $id, 'empresa_id' => $empresaId]);
        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'La página solicitada no existe.'));
    }

    public function actionEmpresaClientes(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $eid = $this->currentEmpresaId();
        if ($eid === null) {
            return [];
        }
        $rows = EmpresaCliente::getActivos($eid);

        return array_map(static function (EmpresaCliente $c) {
            return ['id' => $c->id, 'nombre' => $c->nombre];
        }, $rows);
    }

    public function actionAgrupadores(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $eid = $this->currentEmpresaId();
        if ($eid === null) {
            return [];
        }
        $tq = NovedadTipo::find()->where(['activo' => 1]);
        if ($this->novedadTipoTieneColumnaEmpresa()) {
            $tq->andWhere(['empresa_id' => $eid]);
        }
        $tipos = $tq->orderBy(['orden' => SORT_ASC, 'nombre' => SORT_ASC])->all();
        $tipos = array_values(array_filter(
            $tipos,
            fn (NovedadTipo $t): bool => $this->usuarioPuedeCrearTipo($t)
        ));

        return array_map(static function (NovedadTipo $t) {
            return [
                'id' => $t->id,
                'nombre' => $t->nombre,
                'codigo' => $t->codigo,
            ];
        }, $tipos);
    }

    /**
     * Campos dinámicos del agrupador (para el formulario web de solicitud).
     */
    public function actionTipoCampos(int $novedad_tipo_id): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $eid = $this->currentEmpresaId();
        if ($eid === null) {
            return ['success' => false, 'items' => []];
        }
        $tipoCond = ['id' => $novedad_tipo_id, 'activo' => 1];
        if ($this->novedadTipoTieneColumnaEmpresa()) {
            $tipoCond['empresa_id'] = $eid;
        }
        $tipo = NovedadTipo::findOne($tipoCond);
        if ($tipo === null || !$this->usuarioPuedeCrearTipo($tipo)) {
            return ['success' => false, 'items' => []];
        }

        $campos = NovedadTipoCampo::find()
            ->where(['novedad_tipo_id' => $tipo->id])
            ->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC])
            ->with(['novedadTipoCampoOpcions' => static function ($q) {
                $q->orderBy(['orden' => SORT_ASC, 'id' => SORT_ASC]);
            }])
            ->all();

        $items = [];
        foreach ($campos as $c) {
            $opciones = [];
            foreach ($c->novedadTipoCampoOpcions as $op) {
                $opciones[] = [
                    'valor' => $op->valor,
                    'etiqueta' => $op->etiqueta !== null && $op->etiqueta !== '' ? $op->etiqueta : $op->valor,
                ];
            }
            $items[] = [
                'campo_id' => $c->campo_id,
                'label' => $c->label,
                'tipo_dato' => $c->tipo_dato,
                'requerido' => (int) $c->requerido === 1,
                'opciones' => $opciones,
            ];
        }

        return ['success' => true, 'items' => $items];
    }

    public function actionConceptos(int $novedad_tipo_id): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $eid = $this->currentEmpresaId();
        if ($eid === null) {
            return [];
        }
        $tipoCond = ['id' => $novedad_tipo_id, 'activo' => 1];
        if ($this->novedadTipoTieneColumnaEmpresa()) {
            $tipoCond['empresa_id'] = $eid;
        }
        $tipo = NovedadTipo::findOne($tipoCond);
        if ($tipo === null || !$this->usuarioPuedeCrearTipo($tipo)) {
            return [];
        }

        $q = NovedadConcepto::find()
            ->where(['novedad_tipo_id' => $tipo->id, 'activo' => 1])
            ->orderBy(['nombre' => SORT_ASC]);

        $hayEnc = EmpresaNovedadConcepto::find()->where(['empresa_id' => $eid])->exists();
        if ($hayEnc) {
            $q->innerJoin(
                'empresa_novedad_concepto enc',
                'enc.novedad_concepto_id = novedad_concepto.id AND enc.empresa_id = ' . (int) $eid
            );
        }

        /** @var NovedadConcepto[] $conceptos */
        $conceptos = $q->all();

        $profileUserId = (int) Yii::$app->request->get('profile_id', 0);
        $fecha = (string) Yii::$app->request->get('fecha_novedad', '');
        if (
            $profileUserId > 0
            && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)
        ) {
            $contrato = Contrato::findOccupyingAt($fecha)
                ->andWhere(['contrato.profile_id' => $profileUserId, 'contrato.empresa_id' => $eid])
                ->one();
            $cargoId = $contrato !== null ? (int) $contrato->cargo_id : null;
            $conceptos = $this->filtrarConceptosPorCargoAplicabilidad($conceptos, $cargoId);
        }

        return array_map(static function (NovedadConcepto $c) {
            return ['id' => (int) $c->id, 'nombre' => $c->nombre, 'codigo' => $c->codigo];
        }, $conceptos);
    }

    public function actionSedesPorCiudad(int $ciudad_id): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $eid = $this->currentEmpresaId();
        if ($eid === null) {
            return [];
        }
        $sedes = LocationSedes::find()
            ->where(['or', ['city_id' => $ciudad_id], ['city_id' => null]])
            ->andWhere(['empresa_id' => $eid, 'activo' => 1])
            ->orderBy('nombre')
            ->all();

        return array_map(static function (LocationSedes $s) {
            return ['id' => $s->id, 'nombre' => $s->nombre];
        }, $sedes);
    }

    public function actionCiudades(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $rows = City::find()->where(['is_active' => 1])->orderBy('name')->limit(500)->all();

        return array_map(static function (City $c) {
            return ['id' => $c->id, 'nombre' => $c->name];
        }, $rows);
    }

    public function actionBuscarEmpleado(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $numDoc = trim((string) $this->request->get('num_documento', ''));
        if (strlen($numDoc) < 3) {
            return ['results' => []];
        }
        $eid = $this->currentEmpresaId();
        if ($eid === null) {
            return ['results' => []];
        }

        $fecha = (string) $this->request->get('fecha_novedad', date('Y-m-d'));
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            $fecha = date('Y-m-d');
        }

        $q = Profile::find()
            ->where(['like', 'num_doc', $numDoc])
            ->andWhere(['empresas_id' => $eid, 'estado' => Profile::ESTADO_ACTIVO]);

        if (Yii::$app->user->can('gerente_sede')) {
            $identity = Yii::$app->user->identity;
            $op = $identity && $identity->profile ? $identity->profile : null;
            if ($op !== null && !empty($op->sede_id)) {
                $q->andWhere(['sede_id' => $op->sede_id]);
            }
        }

        $profiles = $q->limit(10)->all();

        return [
            'results' => array_map(function (Profile $p) use ($eid, $fecha) {
                $c = Contrato::findOccupyingAt($fecha)
                    ->with('cargo')
                    ->andWhere(['contrato.profile_id' => $p->user_id, 'contrato.empresa_id' => $eid])
                    ->one();
                $cargoNombre = null;
                if ($c !== null && $c->cargo !== null) {
                    $cargoNombre = (string) $c->cargo->nombre;
                }

                return [
                    'id' => $p->user_id,
                    'text' => ($p->name ?: Yii::t('app', 'Sin nombre')) . ' — ' . $p->num_doc,
                    'name' => $p->name,
                    'num_doc' => $p->num_doc,
                    'cargo_id' => $c !== null ? (int) $c->cargo_id : null,
                    'cargo_nombre' => $cargoNombre,
                ];
            }, $profiles),
        ];
    }

    public function actionCargoClasesGrupales(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $cargoId = (int) $this->request->get('cargo_id', 0);
        if ($cargoId <= 0) {
            return ['aplica' => false];
        }

        return ['aplica' => self::cargoAplicaClasesGrupales($cargoId)];
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

    /**
     * Permiso amplio o permiso por tipo (`novedad.crear.tipo.{codigo}`).
     */
    private function usuarioPuedeCrearTipo(NovedadTipo $tipo): bool
    {
        $u = Yii::$app->user;
        if ($u->can('novedad.crear')) {
            return true;
        }

        return $u->can($tipo->getPermisoCrearNombre());
    }

    /**
     * Si el concepto tiene filas en {@see NovedadConceptoCargo}, solo aplica a esos cargos.
     *
     * @param NovedadConcepto[] $conceptos
     * @return NovedadConcepto[]
     */
    private function filtrarConceptosPorCargoAplicabilidad(array $conceptos, ?int $cargoId): array
    {
        return array_values(array_filter($conceptos, static function (NovedadConcepto $c) use ($cargoId): bool {
            $hayRestriccion = NovedadConceptoCargo::find()->where(['novedad_concepto_id' => $c->id])->exists();
            if (!$hayRestriccion) {
                return true;
            }
            if ($cargoId === null || $cargoId <= 0) {
                return false;
            }

            return NovedadConceptoCargo::find()->where([
                'novedad_concepto_id' => $c->id,
                'cargo_id' => $cargoId,
            ])->exists();
        }));
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
