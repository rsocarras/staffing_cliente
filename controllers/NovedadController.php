<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\City;
use app\models\Contrato;
use app\models\ContratoDistribucionSede;
use app\models\ProfileSede;
use app\models\EmpresaCliente;
use app\models\EmpresaNovedadConcepto;
use app\models\Empresas;
use app\models\forms\NovedadSolicitudContextForm;
use app\models\LocationSedeCargoTarifa;
use app\models\LocationSedes;
use app\components\TenantContext;
use app\models\Novedad;
use app\models\NovedadConcepto;
use app\models\NovedadConceptoCargo;
use app\models\NovedadCentroCosto;
use app\models\NovedadFlujo;
use app\models\NovedadStep;
use app\models\NovedadStepHistoryLog;
use app\models\NovedadTipo;
use app\models\NovedadTipoCampo;
use app\models\Cargos;
use app\models\Profile;
use app\models\Setting;
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
                    'confirmar-novedad' => ['POST'],
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
            fn(NovedadTipo $t): bool => $this->usuarioPuedeCrearTipo($t)
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

        $summaryCounts = ['total' => 0, 'en_curso' => 0, 'resueltas' => 0];
        if ($empresaId !== null) {
            $q = Novedad::find()->alias('n')->where(['n.empresa_id' => $empresaId]);
            $summaryCounts['total'] = (int) (clone $q)->count();
            $summaryCounts['en_curso'] = (int) (clone $q)->andWhere([
                'n.estado' => [Novedad::ESTADO_BORRADOR, Novedad::ESTADO_PENDIENTE],
            ])->count();
            $summaryCounts['resueltas'] = (int) (clone $q)->andWhere([
                'n.estado' => [Novedad::ESTADO_APROBADA, Novedad::ESTADO_RECHAZADA],
            ])->count();
        }

        return $this->render('index', [
            'tipos' => $tipos,
            'flujos' => $flujos,
            'profiles' => $profiles,
            'conceptosFiltro' => $conceptosFiltro,
            'summaryCounts' => $summaryCounts,
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

        $this->sincronizarImporteYValorUnitarioPagosPeOPp($model, $concepto);

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
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'puedeEditarSolicitud' => $model->isEstadoCargaBorrador(),
        ]);
    }

    /**
     * Pasa una solicitud de borrador de flujo a pendiente o aprobada (igual criterio que staffing_admin).
     */
    public function actionConfirmarNovedad(int $id): Response
    {
        $model = $this->findModel($id);
        if (!$model->isEstadoCargaBorrador()) {
            Yii::$app->session->setFlash(
                'warning',
                Yii::t('app', 'Solo se pueden confirmar solicitudes cuya carga sigue en borrador.')
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }
        if ((string) $model->estado !== Novedad::ESTADO_BORRADOR) {
            Yii::$app->session->setFlash(
                'warning',
                Yii::t('app', 'Solo se pueden confirmar solicitudes en borrador.')
            );

            return $this->redirect(['view', 'id' => $model->id]);
        }

        $nuevoEstado = NovedadTipo::tipoTieneFlujoAprobacion((int) $model->novedad_tipo_id)
            ? Novedad::ESTADO_PENDIENTE
            : Novedad::ESTADO_APROBADA;
        $model->estado = $nuevoEstado;
        $model->estado_carga = Novedad::ESTADO_CARGA_CREADA;
        if (!$model->save(false)) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'No se pudo confirmar el envío.'));
        } else {
            Yii::$app->session->setFlash(
                'success',
                $nuevoEstado === Novedad::ESTADO_APROBADA
                    ? Yii::t('app', 'Solicitud registrada y aprobada automáticamente (este tipo no tiene flujo de aprobación).')
                    : Yii::t('app', 'Solicitud enviada correctamente.')
            );
        }

        return $this->redirect(['view', 'id' => $model->id]);
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

        if (!$this->request->isPost) {
            $this->aplicarPrefillSolicitudDesdeRequest($model, $ctx, $tenantId);
        }

        if ($this->request->isPost) {
            $ctx->load($this->request->post());
            $model->load($this->request->post());
            $model->empresa_id = $tenantId;

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
            $ausentismosTipoId = $this->resolveAusentismosNovedadTipoId($tenantId);
            if (
                $ausentismosTipoId > 0
                && (int) ($ctx->novedad_tipo_id ?? 0) === $ausentismosTipoId
            ) {
                $fi = $this->extraerFechaInicialAusentismosDesdeDatosJson((string) ($model->datos ?? ''));
                if ($fi !== null && $fi !== '') {
                    $model->fecha_novedad = $fi;
                }
            }
            $this->asignarContextoValidacionEmpresaCliente($ctx, $model);

            if (!$ctx->validate()) {
                $ctxErrs = $ctx->getFirstErrors();
                $ctxMsg = $ctxErrs !== [] ? (string) reset($ctxErrs) : '';
                Yii::$app->session->setFlash(
                    'error',
                    $ctxMsg !== '' ? $ctxMsg : Yii::t('app', 'Revise el contexto de la solicitud.')
                );

                return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
            }

            $model->novedad_tipo_id = (int) $ctx->novedad_tipo_id;

            if ($tipo !== null && $tipo->esTipoHoras()) {
                return $this->procesarSolicitudHoras($model, $ctx, $tipo, $empresa);
            }

            $concepto = NovedadConcepto::findOne((int) ($model->concepto_id ?? 0));
            if ($concepto !== null && (int) ($concepto->novedad_tipo_id ?? 0) > 0) {
                $model->novedad_tipo_id = (int) $concepto->novedad_tipo_id;
            }
            if (
                $concepto !== null
                && (int) ($ctx->novedad_tipo_id ?? 0) > 0
                && (int) $concepto->novedad_tipo_id !== (int) $ctx->novedad_tipo_id
            ) {
                $model->addError('concepto_id', Yii::t('app', 'El concepto no corresponde al agrupador indicado.'));
            }
            $this->validarReglasNovedad($model);
            if (!$model->hasErrors()) {
                $this->aplicarFormularioConceptoYSaveDatos(
                    $model,
                    $concepto,
                    $this->extractDatosCamposDinamicosFromPost(),
                    $ctx
                );
            }

            if (!$model->hasErrors()) {
                if ($concepto !== null) {
                    $this->aplicarImporteYValorUnitarioSolicitudWeb($model, $concepto, $ctx);
                } else {
                    $model->importe = 0;
                    $model->valor_unitario = null;
                }
            }

            $model->scenario = Novedad::SCENARIO_SOLICITUD_WEB;
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('app', 'Solicitud registrada en borrador.'));

                return $this->redirect(['view', 'id' => $model->id]);
            }
            $this->setFlashFirstModelError($model);
            if (!Yii::$app->session->hasFlash('error')) {
                Yii::$app->session->setFlash(
                    'error',
                    Yii::t('app', 'No se pudo guardar la solicitud. Revise los datos marcados o intente de nuevo.')
                );
            }
        }

        return $this->render('create', $this->createViewParams($model, $ctx, $empresa, null));
    }

    /**
     * Resumen de solicitudes tipo Horas en borrador antes de confirmar envío.
     */
    public function actionResumenBorradorHoras(): string|Response
    {
        $batchGet = trim((string) $this->request->get('batch', ''));
        if ($batchGet === '') {
            $batchGet = trim((string) $this->request->get('grupo', ''));
        }
        $pack = null;
        if ($batchGet !== '') {
            $pack = $this->obtienePackBorradorPorBatchId($batchGet);
            if ($pack !== null) {
                Yii::$app->session->set(self::SESSION_HORAS_BORRADOR, [
                    'ids' => $pack['ids'],
                    'origen_id' => $pack['origen_id'],
                    'batch_id' => $pack['batch_id'],
                ]);
            }
        }
        if ($pack === null) {
            $pack = $this->obtieneNovedadesBorradorHorasSesionValidadas();
        }
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
            'batchId' => $pack['batch_id'] ?? '',
            'resumenContexto' => $this->buildResumenBorradorContexto($pack['novedades']),
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

    /**
     * Filas enviadas en POST como HorasFilas[i][concepto_id|cantidad|unidad|comentario].
     *
     * @return array<int, array{concepto_id: int, cantidad: string, unidad: string, comentario: string}>
     */
    private function normalizarHorasFilasDesdePost(): array
    {
        $raw = Yii::$app->request->post('HorasFilas', []);
        if (!is_array($raw)) {
            return [];
        }
        $out = [];
        foreach ($raw as $row) {
            if (!is_array($row)) {
                continue;
            }
            $cid = (int) ($row['concepto_id'] ?? 0);
            $cant = trim((string) ($row['cantidad'] ?? ''));
            $uni = trim((string) ($row['unidad'] ?? ''));
            $com = trim((string) ($row['comentario'] ?? ''));
            if ($cid <= 0 && $cant === '' && $uni === '' && $com === '') {
                continue;
            }
            $out[] = [
                'concepto_id' => $cid,
                'cantidad' => $cant,
                'unidad' => $uni,
                'comentario' => $com,
            ];
        }

        return $out;
    }

    private function procesarSolicitudHoras(
        Novedad $model,
        NovedadSolicitudContextForm $ctx,
        NovedadTipo $tipo,
        ?Empresas $empresa
    ): string|Response {
        $model->concepto_id = null;
        $tenantId = (int) $model->empresa_id;
        $allowed = $this->empresasIdsDisponiblesParaSolicitud();
        if (!in_array($tenantId, $allowed, true)) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'Organización no permitida.'));

            return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
        }

        $fechaVal = trim((string) ($model->fecha_novedad ?? ''));
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaVal)) {
            $model->addError(
                'fecha_novedad',
                Yii::t('app', 'Indique la fecha de aplicación de la novedad.')
            );
        }

        $empleado = Profile::findOne(['user_id' => $model->profile_id]);
        if (
            $empleado === null
            || (int) $empleado->empresas_id !== $tenantId
            || $empleado->estado !== Profile::ESTADO_ACTIVO
        ) {
            $model->addError('profile_id', Yii::t('app', 'Seleccione un empleado activo de la organización indicada.'));
        }

        $filas = $this->normalizarHorasFilasDesdePost();
        if ($filas === [] && !$model->hasErrors()) {
            $model->addError(
                'horas_filas_error',
                Yii::t('app', 'Agregue al menos una fila con concepto, cantidad y unidad.')
            );
        }
        foreach ($filas as $i => $fila) {
            $nLinea = (int) $i + 1;
            if ((int) ($fila['concepto_id'] ?? 0) <= 0) {
                $model->addError('horas_filas_error', Yii::t('app', 'Línea {n}: seleccione un concepto.', ['n' => $nLinea]));
            }
            if (($fila['cantidad'] ?? '') === '') {
                $model->addError('horas_filas_error', Yii::t('app', 'Línea {n}: indique la cantidad.', ['n' => $nLinea]));
            } elseif (!is_numeric(str_replace(',', '.', (string) $fila['cantidad'])) || (float) str_replace(',', '.', (string) $fila['cantidad']) <= 0) {
                $model->addError('horas_filas_error', Yii::t('app', 'Línea {n}: la cantidad debe ser un número mayor que cero.', ['n' => $nLinea]));
            }
            if (($fila['unidad'] ?? '') === '') {
                $model->addError('horas_filas_error', Yii::t('app', 'Línea {n}: indique la unidad (p. ej. horas).', ['n' => $nLinea]));
            }
        }

        if ($model->hasErrors()) {
            $this->setFlashFirstModelError($model);

            return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
        }

        $datosValores = $this->extractDatosCamposDinamicosFromPost();
        foreach ($filas as $j => $fila) {
            $filas[$j]['cantidad'] = (string) (float) str_replace(',', '.', (string) $fila['cantidad']);
        }
        $eidCtx = (int) $model->empresa_id;
        $pidModel = (int) $model->profile_id;
        $esContratoTipoHoras = false;
        if ($eidCtx > 0 && $pidModel > 0) {
            $esContratoTipoHoras = $this->esContratoTipoHorasActivo($eidCtx, $pidModel, $ctx);
        }
        $guardado = $this->guardarSolicitudTipoHorasFilas(
            $model,
            $ctx,
            $allowed,
            $filas,
            $datosValores,
            $esContratoTipoHoras
        );
        if (!$guardado['ok']) {
            $model->addError('horas_filas_error', $guardado['error']);
            $this->setFlashFirstModelError($model);

            return $this->render('create', $this->createViewParams($model, $ctx, $empresa, $tipo));
        }

        $batchId = (string) ($guardado['batch_id'] ?? '');
        Yii::$app->session->set(self::SESSION_HORAS_BORRADOR, [
            'ids' => $guardado['ids'],
            'origen_id' => $guardado['origen_id'],
            'batch_id' => $batchId,
        ]);
        Yii::$app->session->setFlash(
            'success',
            Yii::t('app', 'Solicitud tipo horas registrada en borrador. Revisá el resumen para confirmar el envío.')
        );

        return $this->redirect(
            $batchId !== ''
                ? ['resumen-borrador-horas', 'batch' => $batchId]
                : ['resumen-borrador-horas']
        );
    }

    /**
     * @param array<int, array{concepto_id: int, cantidad: string, unidad: string, comentario: string}> $filas
     *
     * @return array{ok: bool, error: string, ids: int[], origen_id: int, batch_id: string}
     */
    private function guardarSolicitudTipoHorasFilas(
        Novedad $plantilla,
        NovedadSolicitudContextForm $ctx,
        array $allowed,
        array $filas,
        array $datosValores,
        bool $esContratoTipoHoras
    ): array {
        $fail = static function (string $msg): array {
            return ['ok' => false, 'error' => $msg, 'ids' => [], 'origen_id' => 0, 'batch_id' => ''];
        };

        $empresaId = (int) $plantilla->empresa_id;
        $profileId = (int) $plantilla->profile_id;
        if (!in_array($empresaId, $allowed, true)) {
            return $fail(Yii::t('app', 'Organización no permitida.'));
        }

        $fechaPlantilla = trim((string) ($plantilla->fecha_novedad ?? ''));
        if ($fechaPlantilla === '') {
            return $fail(Yii::t('app', 'Indique la fecha de la novedad.'));
        }

        $sede = null;
        $cargoTarifa = null;
        $tarifasPorConcepto = null;
        $setting = null;
        $valorHoraOrdinaria = null;

        if ($esContratoTipoHoras) {
            $sede = $this->resolveSedeContratoActivo($empresaId, $profileId, $ctx);
            if ($sede === null) {
                return $fail(Yii::t('app', 'No se encontró la sede del contrato activo para calcular valores por concepto.'));
            }
            $cargoTarifa = $this->resolveLocationSedeCargoTarifaContratoActivo($empresaId, $profileId, $ctx);
            if ($cargoTarifa === null) {
                return $fail(Yii::t('app', 'No hay tarifa horaria configurada para la sede y el cargo del contrato activo (location_sede_cargo_tarifa). Revise sede y cargo del contrato.'));
            }
            $tarifasPorConcepto = $this->mapTarifasHorasDesdeCargoTarifa($cargoTarifa);
        } else {
            try {
                $setting = NovedadSettingResolver::resolveForEmpresaYFecha($empresaId, $fechaPlantilla);
            } catch (\Throwable $e) {
                return $fail($e->getMessage());
            }
            $contratoLiquidacion = $this->resolveContratoActivoContexto($empresaId, $profileId, $ctx);
            if ($contratoLiquidacion === null) {
                return $fail(Yii::t('app', 'No se encontró un contrato activo para calcular el importe por hora.'));
            }
            $valorHoraOrdinaria = $this->resolveValorHoraOrdinariaContrato($contratoLiquidacion);
            if ($valorHoraOrdinaria === null) {
                return $fail(Yii::t(
                    'app',
                    'El contrato activo debe tener salario y jornada mayores a cero para calcular el valor hora (salario ÷ jornada).'
                ));
            }
        }

        $ecidPorConc = (int) ($ctx->empresa_cliente_id ?? 0);
        $aplicables = $this->conceptosAplicablesParaSolicitud(
            $empresaId,
            $profileId,
            (int) $plantilla->novedad_tipo_id,
            $fechaPlantilla,
            $ecidPorConc > 0 ? $ecidPorConc : null
        );
        $aplicableIds = [];
        foreach ($aplicables as $c) {
            $aplicableIds[(int) $c->id] = true;
        }

        $conceptosPorId = NovedadConcepto::find()
            ->where([
                'id' => array_values(array_unique(array_map(static fn(array $f): int => (int) ($f['concepto_id'] ?? 0), $filas))),
                'activo' => 1,
            ])
            ->indexBy('id')
            ->all();

        foreach ($filas as $i => $fila) {
            $cid = (int) ($fila['concepto_id'] ?? 0);
            if ($cid <= 0 || !isset($aplicableIds[$cid])) {
                return $fail(Yii::t('app', 'Línea {n}: el concepto no está habilitado para el cargo del empleado.', ['n' => $i + 1]));
            }
            if (!isset($conceptosPorId[$cid])) {
                return $fail(Yii::t('app', 'Concepto no válido.'));
            }
        }

        foreach ($filas as $fila) {
            /** @var NovedadConcepto $concepto */
            $concepto = $conceptosPorId[(int) $fila['concepto_id']];
            $codigo = strtoupper(trim((string) ($concepto->codigo ?? '')));
            $qty = (float) str_replace(',', '.', (string) ($fila['cantidad'] ?? '0'));
            if ($codigo === NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION) {
                $qty = 1.0;
            }
            if ($qty <= 0) {
                return $fail(Yii::t('app', 'Línea con concepto «{c}»: indique una cantidad mayor a 0.', ['c' => (string) $concepto->nombre]));
            }
            if ($esContratoTipoHoras) {
                [$campoTarifa, $campoLabel] = $this->tarifaFieldByConceptoCodigo($codigo);
                if ($campoTarifa === null) {
                    return $fail(Yii::t(
                        'app',
                        'El concepto «{nombre}» no puede usarse con contrato por horas: el código del concepto en catálogo («{codigo}») no corresponde a ninguna tarifa horaria (location_sede_cargo_tarifa). Códigos de concepto admitidos: {lista}.',
                        [
                            'nombre' => (string) $concepto->nombre,
                            'codigo' => $codigo !== '' ? $codigo : Yii::t('app', '(vacío o inválido)'),
                            'lista' => implode(', ', NovedadHorasTroceoService::codigosConceptoMapeadosTarifaLocationSedes()),
                        ]
                    ));
                }
                $valorTarifa = (float) ($cargoTarifa->$campoTarifa ?? 0);
                if ($valorTarifa <= 0) {
                    $sedeNombre = trim((string) ($sede->nombre ?? ('#' . $sede->id)));

                    return $fail(Yii::t(
                        'app',
                        'Para la sede «{sede}» y el cargo del contrato debe configurarse «{etiqueta}» ({campo} en tarifa sede–cargo) con un valor mayor a cero para liquidar el concepto «{concepto}».',
                        [
                            'sede' => $sedeNombre,
                            'etiqueta' => $campoLabel,
                            'campo' => $campoTarifa,
                            'concepto' => (string) $concepto->nombre,
                        ]
                    ));
                }
                if ($tarifasPorConcepto === null || !isset($tarifasPorConcepto[$codigo]) || (float) $tarifasPorConcepto[$codigo] <= 0) {
                    return $fail(Yii::t(
                        'app',
                        'No hay tarifa válida en sede para el concepto «{c}» (revisión interna de tarifas por código).',
                        ['c' => (string) $concepto->nombre]
                    ));
                }
            } else {
                if ($setting === null) {
                    return $fail(Yii::t('app', 'No se pudo resolver parámetros laborales (setting) para la fecha indicada.'));
                }
                if ($codigo === NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION) {
                    $auxImp = $this->resolveImporteAuxilioMovilizacion($empresaId, $profileId, $ctx);
                    if ($auxImp === null || $auxImp < 0.01) {
                        return $fail(Yii::t(
                            'app',
                            'Configure el valor de movilización en la sede o el importe predeterminado de auxilio para liquidar «{c}».',
                            ['c' => (string) $concepto->nombre]
                        ));
                    }
                } else {
                    $factorMult = $this->factorMultiplicadorSettingHorasPorCodigo($setting, $codigo);
                    if ($factorMult <= 0.0) {
                        return $fail(Yii::t(
                            'app',
                            'No hay parámetro de recargo (setting) configurado para el concepto «{c}» (código «{code}»).',
                            [
                                'c' => (string) $concepto->nombre,
                                'code' => $codigo !== '' ? $codigo : '—',
                            ]
                        ));
                    }
                }
            }
        }

        $batchUuid = $this->nuevoBatchUuid();

        $tx = Yii::$app->db->beginTransaction();
        try {
            $primeraId = null;
            $idsCreados = [];
            foreach ($filas as $fila) {
                /** @var NovedadConcepto $concObj */
                $concObj = $conceptosPorId[(int) $fila['concepto_id']];
                $codigo = strtoupper(trim((string) ($concObj->codigo ?? '')));
                $qty = (float) str_replace(',', '.', (string) ($fila['cantidad'] ?? '0'));
                if ($codigo === NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION) {
                    $qty = 1.0;
                }

                $importeFila = 0.0;
                if ($esContratoTipoHoras && $tarifasPorConcepto !== null) {
                    $tarifa = (float) ($tarifasPorConcepto[$codigo] ?? 0);
                    $importeFila = round($qty * $tarifa, 4);
                } elseif ($codigo === NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION) {
                    $auxImp = $this->resolveImporteAuxilioMovilizacion($empresaId, $profileId, $ctx);
                    $importeFila = round((float) ($auxImp ?? 0.0), 4);
                } elseif ($setting !== null && $valorHoraOrdinaria !== null) {
                    $factorMult = $this->factorMultiplicadorSettingHorasPorCodigo($setting, $codigo);
                    $importeFila = round($qty * $valorHoraOrdinaria * $factorMult, 4);
                }

                $vu = null;
                if ($importeFila > 0.0 && $qty > 0.0) {
                    $vu = round($importeFila / $qty, 6);
                }

                $n = new Novedad();
                $n->setScenario(Novedad::SCENARIO_SOLICITUD_HORAS_FILAS);
                $n->batch_id = $batchUuid;
                $n->empresa_id = $plantilla->empresa_id;
                $n->profile_id = $plantilla->profile_id;
                $n->novedad_tipo_id = $plantilla->novedad_tipo_id;
                $n->concepto_id = (int) $concObj->id;
                $n->fecha_novedad = $fechaPlantilla;
                $n->hora_inicio = null;
                $n->hora_fin = null;
                $n->cantidad = (string) $qty;
                $n->unidad = $codigo === NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION
                    ? Yii::t('app', 'Unidad')
                    : (trim((string) ($fila['unidad'] ?? '')) !== '' ? trim((string) $fila['unidad']) : Yii::t('app', 'Hora'));
                $com = trim((string) ($fila['comentario'] ?? ''));
                $n->descripcion = $com !== '' ? $com : null;
                $n->novedad_origen_id = $primeraId;
                $n->estado = Novedad::ESTADO_BORRADOR;
                $n->estado_carga = Novedad::ESTADO_CARGA_CREADA;
                $n->importe = $importeFila;
                $n->valor_unitario = $vu;

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

            $tx->commit();

            return [
                'ok' => true,
                'error' => '',
                'ids' => $idsCreados,
                'origen_id' => $primeraId ?? 0,
                'batch_id' => $batchUuid,
            ];
        } catch (Throwable $e) {
            $tx->rollBack();
            Yii::error($e, __METHOD__);

            return $fail(Yii::t('app', 'Error al guardar las novedades.'));
        }
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
        $decoded = $this->decodeNovedadDatosArrayFromPost();
        $campos = $decoded['campos_dinamicos'] ?? null;
        if (is_array($campos)) {
            return $campos;
        }
        if ($decoded !== []) {
            unset($decoded['solicitud']);

            return $decoded;
        }

        return [];
    }

    /**
     * @return array<string, mixed>
     */
    private function decodeNovedadDatosArrayFromPost(): array
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

            return is_array($decoded) ? $decoded : [];
        } catch (\JsonException $e) {
            return [];
        }
    }

    private function extraerFechaInicialAusentismosDesdeDatosJson(string $datosJson): ?string
    {
        if ($datosJson === '') {
            return null;
        }
        try {
            $arr = json_decode($datosJson, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            return null;
        }
        if (!is_array($arr)) {
            return null;
        }
        $fi = $arr['fecha_inicial'] ?? null;
        if (!is_scalar($fi) || trim((string) $fi) === '') {
            $cd = $arr['campos_dinamicos'] ?? [];
            if (is_array($cd)) {
                $fi = $cd['fecha_inicial'] ?? null;
            }
        }
        if (!is_scalar($fi)) {
            return null;
        }
        $s = trim((string) $fi);

        return $s !== '' ? $s : null;
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
     * @param int|null $empresaClienteId filtra el contrato activo como en la solicitud (opcional)
     *
     * @return NovedadConcepto[]
     */
    private function conceptosAplicablesParaSolicitud(
        int $empresaId,
        ?int $empleadoProfileUserId = null,
        ?int $novedadTipoId = null,
        ?string $fechaContratoYmd = null,
        ?int $empresaClienteId = null
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
                $codigoUpper = strtoupper(trim((string) ($c->codigo ?? '')));
                $tipoNt = $c->novedadTipo;
                if (
                    $tipoNt !== null
                    && (string) $tipoNt->codigo === 'horas'
                    && ($codigoUpper === NovedadHorasTroceoService::COD_HORA_ESPECIAL
                        || $codigoUpper === NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION)
                    && !$this->esContratoTipoHorasParaEmpleado($empresaId, (int) $empleadoProfileUserId, $empresaClienteId)
                ) {
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

        $campos = NovedadConceptoFormularioService::camposOrdenados($concepto);
        if ($campos === []) {
            if ($ctx === null) {
                return;
            }
            $datosMin = [];
            if ($model->cantidad !== null) {
                $datosMin['horas_cantidad'] = (string) $model->cantidad;
            }
            if (!empty($model->fecha_novedad)) {
                $datosMin['fecha_novedad'] = (string) $model->fecha_novedad;
            }
            try {
                $pack = NovedadConceptoFormularioService::empaquetarDatosJsonSolicitud($datosMin, $ctx);
                $model->datos = json_encode($pack, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
            } catch (\JsonException $e) {
                $model->addError('datos', Yii::t('app', 'Error al serializar los datos del formulario.'));
            }

            return;
        }

        NovedadConceptoFormularioService::validarCampos($model, $concepto, $postedDatos);

        if ($model->hasErrors()) {
            return;
        }

        NovedadConceptoFormularioService::sincronizarAtributosNovedadDesdeCampos($model, $concepto, $postedDatos);

        $datosLimpios = NovedadConceptoFormularioService::datosLimpiosParaJson($postedDatos, $concepto);

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
            if ($model->cantidad !== null) {
                $datosLimpios['horas_cantidad'] = (string) $model->cantidad;
            }
            if (!empty($model->fecha_novedad)) {
                $datosLimpios['fecha_novedad'] = (string) $model->fecha_novedad;
            }
        }

        foreach ($campos as $campoArchivo) {
            $tipoArch = NovedadConceptoFormularioService::tipoDatoFormularioArchivo($campoArchivo);
            if ($tipoArch === null) {
                continue;
            }
            $file = UploadedFile::getInstanceByName('datos[' . $campoArchivo->campo_id . ']');
            if (!$file instanceof UploadedFile || $file->error !== UPLOAD_ERR_OK) {
                continue;
            }
            if ($tipoArch === 'file_pdf') {
                $path = NovedadConceptoFormularioService::guardarAdjuntoPdf($file, (int) $model->empresa_id);
            } else {
                $path = NovedadConceptoFormularioService::guardarAdjuntoDocumento($file, (int) $model->empresa_id);
            }
            if ($path === null) {
                $model->addError('datos', Yii::t('app', 'No se pudo guardar el archivo.'));

                return;
            }
            $datosLimpios[(string) $campoArchivo->campo_id] = $path;
        }

        try {
            $pack = NovedadConceptoFormularioService::empaquetarDatosJsonSolicitud($datosLimpios, $ctx);
            $model->datos = json_encode($pack, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $model->addError('datos', Yii::t('app', 'Error al serializar los datos del formulario.'));
        }
    }

    /**
     * Completa {@see Novedad::$importe} y {@see Novedad::$valor_unitario} cuando hay cantidad y reglas de horas/settlement;
     * si no aplica cálculo, importe 0 (misma línea que admin).
     */
    private function aplicarImporteYValorUnitarioSolicitudWeb(
        Novedad $model,
        NovedadConcepto $concepto,
        NovedadSolicitudContextForm $ctx
    ): void {
        $empresaId = (int) $model->empresa_id;
        $profileId = (int) $model->profile_id;
        $fechaPlantilla = trim((string) ($model->fecha_novedad ?? ''));
        $codigo = strtoupper(trim((string) ($concepto->codigo ?? '')));

        if ($this->sincronizarImporteYValorUnitarioPagosPeOPp($model, $concepto)) {
            return;
        }

        $qty = null;
        if ($model->cantidad !== null && $model->cantidad !== '') {
            $qs = str_replace(',', '.', (string) $model->cantidad);
            if (is_numeric($qs)) {
                $qty = (float) $qs;
            }
        }
        if ($qty === null || $qty <= 0.0) {
            $model->importe = 0;
            $model->valor_unitario = null;

            return;
        }
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaPlantilla)) {
            $model->importe = 0;
            $model->valor_unitario = null;

            return;
        }

        $esContratoTipoHoras = $this->esContratoTipoHorasActivo($empresaId, $profileId, $ctx);

        if ($esContratoTipoHoras) {
            $tarifasPorConcepto = $this->resolveTarifasHorasPorConcepto($empresaId, $profileId, $ctx);
            if ($tarifasPorConcepto === null) {
                $model->importe = 0;
                $model->valor_unitario = null;

                return;
            }
            $tarifa = (float) ($tarifasPorConcepto[$codigo] ?? 0.0);
            if ($tarifa <= 0.0) {
                $model->importe = 0;
                $model->valor_unitario = null;

                return;
            }
            $importeFila = round($qty * $tarifa, 4);
            $model->importe = $importeFila;
            $model->valor_unitario = $qty > 0 ? round($importeFila / $qty, 6) : null;

            return;
        }

        if ($codigo === NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION) {
            $auxImp = $this->resolveImporteAuxilioMovilizacion($empresaId, $profileId, $ctx);
            if ($auxImp === null || $auxImp < 0.01) {
                $model->importe = 0;
                $model->valor_unitario = null;

                return;
            }
            $imp = round((float) $auxImp, 4);
            $model->importe = $imp;
            $model->valor_unitario = $qty > 0 ? round($imp / $qty, 6) : null;

            return;
        }

        try {
            $setting = NovedadSettingResolver::resolveForEmpresaYFecha($empresaId, $fechaPlantilla);
        } catch (Throwable $e) {
            $model->importe = 0;
            $model->valor_unitario = null;

            return;
        }

        $contratoLiquidacion = $this->resolveContratoActivoContexto($empresaId, $profileId, $ctx);
        if ($contratoLiquidacion === null) {
            $model->importe = 0;
            $model->valor_unitario = null;

            return;
        }

        $valorHoraOrdinaria = $this->resolveValorHoraOrdinariaContrato($contratoLiquidacion);
        if ($valorHoraOrdinaria === null) {
            $model->importe = 0;
            $model->valor_unitario = null;

            return;
        }

        $factorMult = $this->factorMultiplicadorSettingHorasPorCodigo($setting, $codigo);
        if ($factorMult <= 0.0) {
            $model->importe = 0;
            $model->valor_unitario = null;

            return;
        }

        $importeFila = round($qty * $valorHoraOrdinaria * $factorMult, 4);
        $model->importe = $importeFila;
        $model->valor_unitario = $qty > 0 ? round($importeFila / $qty, 6) : null;
    }

    /**
     * Importe y valor unitario para PE_* / PP_* desde columna ya sincronizada o desde `datos.campos_dinamicos`.
     * PP_*: mismo importe y valor unitario (sin fórmulas; horas/minutos solo en JSON).
     *
     * @return bool true si aplica esta rama (no debe ejecutarse la lógica de horas)
     */
    private function sincronizarImporteYValorUnitarioPagosPeOPp(Novedad $model, NovedadConcepto $concepto): bool
    {
        if (!$this->esConceptoImporteDesdeValorPeOPp($concepto)) {
            return false;
        }
        $imp = $this->resolverImportePagosExtralegalesDesdeModelo($model);
        if ($imp !== null && $imp > 0) {
            $model->importe = round($imp, 2);
        } else {
            $model->importe = 0;
        }

        if ($this->esConceptoPagosPrestacionalesPp($concepto)) {
            $model->valor_unitario = round((float) $model->importe, 4);

            return true;
        }

        $qtyPe = null;
        if ($model->cantidad !== null && $model->cantidad !== '') {
            $qs = str_replace(',', '.', (string) $model->cantidad);
            if (is_numeric($qs)) {
                $qtyPe = (float) $qs;
            }
        }
        if ($qtyPe !== null && $qtyPe > 0.0) {
            $model->valor_unitario = round((float) $model->importe / $qtyPe, 6);
        } else {
            $model->valor_unitario = round((float) $model->importe, 4);
        }

        return true;
    }

    /**
     * PE_* (pagos extralegales) o PP_* (pagos prestacionales): importe desde campo dinámico `valor`.
     */
    private function esConceptoImporteDesdeValorPeOPp(NovedadConcepto $c): bool
    {
        return $this->esConceptoPagosExtralegalesPe($c) || $this->esConceptoPagosPrestacionalesPp($c);
    }

    private function esConceptoPagosExtralegalesPe(NovedadConcepto $c): bool
    {
        if ($c->novedadTipo === null && $c->novedad_tipo_id) {
            $c->populateRelation('novedadTipo', NovedadTipo::findOne((int) $c->novedad_tipo_id));
        }
        $tipo = $c->novedadTipo;
        if ($tipo === null) {
            return false;
        }
        $codigoTipo = strtolower(trim((string) ($tipo->codigo ?? '')));
        $nombreTipo = strtolower(trim((string) ($tipo->nombre ?? '')));
        $esTipo = $codigoTipo === 'pagos_extralegales' || $nombreTipo === 'pagos extralegales';
        if (!$esTipo) {
            return false;
        }
        $codigoConcepto = strtoupper(trim((string) ($c->codigo ?? '')));

        return $codigoConcepto !== '' && str_starts_with($codigoConcepto, 'PE_');
    }

    private function esConceptoPagosPrestacionalesPp(NovedadConcepto $c): bool
    {
        if ($c->novedadTipo === null && $c->novedad_tipo_id) {
            $c->populateRelation('novedadTipo', NovedadTipo::findOne((int) $c->novedad_tipo_id));
        }
        $tipo = $c->novedadTipo;
        if ($tipo === null) {
            return false;
        }
        $codigoTipo = strtolower(trim((string) ($tipo->codigo ?? '')));
        $nombreTipo = strtolower(trim((string) ($tipo->nombre ?? '')));
        $esTipo = $codigoTipo === 'pagos_prestacionales' || $nombreTipo === 'pagos prestacionales';
        if (!$esTipo) {
            return false;
        }
        $codigoConcepto = strtoupper(trim((string) ($c->codigo ?? '')));

        return $codigoConcepto !== '' && str_starts_with($codigoConcepto, 'PP_');
    }

    private function resolverImportePagosExtralegalesDesdeModelo(Novedad $model): ?float
    {
        $rawImp = $model->importe;
        if ($rawImp !== null && (string) $rawImp !== '') {
            $s = str_replace(',', '.', trim((string) $rawImp));
            if (is_numeric($s)) {
                return (float) $s;
            }
        }
        $datosStr = trim((string) ($model->datos ?? ''));
        if ($datosStr === '') {
            return null;
        }
        try {
            $arr = json_decode($datosStr, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            return null;
        }
        if (!is_array($arr)) {
            return null;
        }
        $cd = $arr['campos_dinamicos'] ?? [];
        if (!is_array($cd)) {
            return null;
        }
        $v = $cd['valor'] ?? null;
        if (!is_scalar($v)) {
            return null;
        }
        $s = str_replace(',', '.', trim(str_replace([' ', "\u{00A0}"], '', (string) $v)));
        if ($s === '' || !is_numeric($s)) {
            return null;
        }

        return (float) $s;
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
        if (
            !Yii::$app->user->isGuest
            && !NovedadGuard::gerenteSedePuedeParaEmpleado(
                (int) Yii::$app->user->id,
                (int) $model->profile_id,
                (int) $model->empresa_id,
                $fechaContratoOk ? $fechaContrato : null
            )
        ) {
            $model->addError(
                'profile_id',
                Yii::t(
                    'app',
                    'Solo puede registrar novedades para empleados de una sede que tenga asignada o cuando su contrato y el del empleado son en la misma empresa y sede.'
                )
            );
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
     * @return array{novedades: Novedad[], ids: int[], origen_id: int, batch_id: string}|null
     */
    private function obtieneNovedadesBorradorHorasSesionValidadas(): ?array
    {
        $pack = Yii::$app->session->get(self::SESSION_HORAS_BORRADOR);
        if (!is_array($pack) || empty($pack['ids']) || !is_array($pack['ids'])) {
            return null;
        }
        $ids = array_values(array_unique(array_map('intval', $pack['ids'])));

        /** @var Novedad[] $novedades */
        $novedades = Novedad::find()
            ->where(['id' => $ids])
            ->with(['concepto', 'novedadTipo', 'profile.cargo', 'empresa'])
            ->all();

        if (count($novedades) !== count($ids)) {
            return null;
        }

        return $this->validaYOrdenaPackBorradorHoras($novedades);
    }

    /**
     * @param Novedad[] $novedades
     */
    private function resuelveOrigenIdTroceo(array $novedades): int
    {
        $ids = array_map(static fn(Novedad $n): int => (int) $n->id, $novedades);
        foreach ($novedades as $n) {
            if ($n->novedad_origen_id === null) {
                return (int) $n->id;
            }
        }

        return min($ids);
    }

    /**
     * @param Novedad[] $novedades
     *
     * @return array{novedades: Novedad[], ids: int[], origen_id: int, batch_id: string}|null
     */
    private function validaYOrdenaPackBorradorHoras(array $novedades): ?array
    {
        if ($novedades === []) {
            return null;
        }
        $allowed = $this->empresasIdsDisponiblesParaSolicitud();
        if ($allowed === []) {
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
            $fn = ($n->fecha_novedad !== null && $n->fecha_novedad !== '') ? (string) $n->fecha_novedad : null;
            $fnOk = $fn !== null && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fn);
            if (
                !Yii::$app->user->isGuest
                && !NovedadGuard::gerenteSedePuedeParaEmpleado(
                    (int) Yii::$app->user->id,
                    (int) $n->profile_id,
                    (int) $n->empresa_id,
                    $fnOk ? $fn : null
                )
            ) {
                return null;
            }
        }

        usort($novedades, static function (Novedad $a, Novedad $b): int {
            $fa = ($a->fecha_novedad ?? '') . ' ' . ($a->hora_inicio ?? '');
            $fb = ($b->fecha_novedad ?? '') . ' ' . ($b->hora_inicio ?? '');

            return $fa <=> $fb;
        });

        $ids = array_map(static fn(Novedad $n): int => (int) $n->id, $novedades);
        $origenId = $this->resuelveOrigenIdTroceo($novedades);
        $batchId = '';
        foreach ($novedades as $n) {
            $g = trim((string) ($n->batch_id ?? ''));
            if ($g !== '') {
                $batchId = $g;
                break;
            }
        }

        return [
            'novedades' => $novedades,
            'ids' => $ids,
            'origen_id' => $origenId,
            'batch_id' => $batchId,
        ];
    }

    private function obtienePackBorradorPorBatchId(string $uuid): ?array
    {
        $uuid = trim($uuid);
        if ($uuid === '' || !$this->esUuidV4Formato($uuid)) {
            return null;
        }

        /** @var Novedad[] $novedades */
        $novedades = Novedad::find()
            ->where(['batch_id' => $uuid, 'estado' => Novedad::ESTADO_BORRADOR])
            ->with(['concepto', 'novedadTipo', 'profile.cargo', 'empresa'])
            ->all();

        return $this->validaYOrdenaPackBorradorHoras($novedades);
    }

    private function nuevoBatchUuid(): string
    {
        $b = random_bytes(16);
        $b[6] = chr((ord($b[6]) & 0x0f) | 0x40);
        $b[8] = chr((ord($b[8]) & 0x3f) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($b), 4));
    }

    private function esUuidV4Formato(string $uuid): bool
    {
        return (bool) preg_match(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
            $uuid
        );
    }

    /**
     * Datos de lectura para el recuadro de contexto en el resumen del borrador (primera solicitud del pack).
     *
     * @param Novedad[] $novedades
     *
     * @return array{nombre: string, documento: string, cargo: string, organizacion: string, empresaCliente: string}
     */
    private function buildResumenBorradorContexto(array $novedades): array
    {
        $defaults = [
            'nombre' => '—',
            'documento' => '—',
            'cargo' => '—',
            'organizacion' => '—',
            'empresaCliente' => '—',
        ];
        if ($novedades === []) {
            return $defaults;
        }

        $n = $novedades[0];
        $profile = $n->profile;

        $nombre = '—';
        if ($profile !== null) {
            $nombre = trim((string) $profile->name);
            $nombre = $nombre !== '' ? $nombre : '—';
        }

        $documento = '—';
        if ($profile !== null) {
            $tipo = trim((string) ($profile->tipo_doc ?? ''));
            $num = trim((string) ($profile->num_doc ?? ''));
            if ($tipo !== '' && $num !== '') {
                $documento = $tipo . ' ' . $num;
            } elseif ($num !== '') {
                $documento = $num;
            }
        }

        $cargo = '—';
        if ($profile !== null) {
            $contrato = NovedadGuard::contratoActivoEnEmpresa((int) $n->empresa_id, (int) $n->profile_id);
            if ($contrato !== null) {
                $cargoContrato = $contrato->cargo;
                if ($cargoContrato !== null) {
                    $cn = trim((string) $cargoContrato->nombre);
                    if ($cn !== '') {
                        $cargo = $cn;
                    }
                }
            }
            if ($cargo === '—' && (int) ($profile->cargo_id ?? 0) > 0) {
                $cPerfil = $profile->cargo;
                if ($cPerfil === null) {
                    $cPerfil = Cargos::findOne((int) $profile->cargo_id);
                }
                if ($cPerfil !== null) {
                    $cn = trim((string) $cPerfil->nombre);
                    if ($cn !== '') {
                        $cargo = $cn;
                    }
                }
            }
            if ($cargo === '—') {
                $pos = trim((string) ($profile->position ?? ''));
                if ($pos !== '') {
                    $cargo = $pos;
                }
            }
        }

        $organizacion = '—';
        if ($n->empresa !== null) {
            $on = trim((string) ($n->empresa->name ?? $n->empresa->social_name ?? ''));
            $organizacion = $on !== '' ? $on : '—';
        }

        $empresaCliente = '—';
        $datos = [];
        try {
            $datos = json_decode((string) ($n->datos ?? '{}'), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            $datos = [];
        }
        $ecId = isset($datos['empresa_cliente_id']) ? (int) $datos['empresa_cliente_id'] : 0;
        if ($ecId > 0) {
            $ec = EmpresaCliente::findOne($ecId);
            if ($ec !== null) {
                $ecn = trim((string) $ec->nombre);
                $empresaCliente = $ecn !== '' ? $ecn : '—';
            }
        }

        return [
            'nombre' => $nombre,
            'documento' => $documento,
            'cargo' => $cargo,
            'organizacion' => $organizacion,
            'empresaCliente' => $empresaCliente,
        ];
    }

    /**
     * @return array{0:?string,1:string}
     */
    private function tarifaFieldByConceptoCodigo(string $codigo): array
    {
        $map = NovedadHorasTroceoService::mapCodigoConceptoACampoTarifaLocationSedes();
        $campo = $map[$codigo] ?? null;
        $etiquetasPorCampo = [
            'valor_hora_diurna' => Yii::t('app', 'Valor hora diurna'),
            'valor_hora_especial' => Yii::t('app', 'Valor hora especial'),
            'valor_movilizacion' => Yii::t('app', 'Valor movilización'),
            'valor_hora_nocturna' => Yii::t('app', 'Valor hora nocturna'),
            'valor_hora_diurna_domingo_festivos' => Yii::t('app', 'Valor hora diurna domingo/festivos'),
            'valor_hora_nocturna_domingo_festiva' => Yii::t('app', 'Valor hora nocturna domingo/festivo'),
        ];
        $label = $campo !== null ? ($etiquetasPorCampo[$campo] ?? Yii::t('app', 'Tarifa sede')) : Yii::t('app', 'Sin tarifa en sede');

        return [$campo, $label];
    }

    private function esContratoTipoHorasActivo(int $empresaId, int $profileId, NovedadSolicitudContextForm $ctx): bool
    {
        $contrato = $this->resolveContratoActivoContexto($empresaId, $profileId, $ctx);
        if ($contrato === null || $contrato->contratoTipo === null) {
            return false;
        }

        return strtoupper(trim((string) ($contrato->contratoTipo->code ?? ''))) === 'HORAS';
    }

    private function esContratoTipoHorasParaEmpleado(int $empresaId, int $profileUserId, ?int $empresaClienteId): bool
    {
        $ctx = new NovedadSolicitudContextForm();
        if ($empresaClienteId !== null && $empresaClienteId > 0) {
            $ctx->empresa_cliente_id = $empresaClienteId;
        }

        return $this->esContratoTipoHorasActivo($empresaId, $profileUserId, $ctx);
    }

    private function resolveContratoActivoContexto(int $empresaId, int $profileId, NovedadSolicitudContextForm $ctx): ?Contrato
    {
        if ($empresaId <= 0 || $profileId <= 0) {
            return null;
        }

        $q = Contrato::find()
            ->where([
                'empresa_id' => $empresaId,
                'profile_id' => $profileId,
                'estado' => Contrato::ESTADO_ACTIVO,
            ])
            ->with(['contratoTipo', 'cargo']);

        if ((int) ($ctx->empresa_cliente_id ?? 0) > 0) {
            $q->andWhere(['empresa_cliente_id' => (int) $ctx->empresa_cliente_id]);
        }

        return $q->orderBy(['fecha_inicio' => SORT_DESC, 'id' => SORT_DESC])->one();
    }

    /**
     * Valor hora ordinaria del contrato: salario base ÷ jornada (contratos distintos de tipo HORAS).
     */
    private function resolveValorHoraOrdinariaContrato(Contrato $contrato): ?float
    {
        $salario = (float) ($contrato->salario ?? 0);
        $jornada = (float) ($contrato->jornada ?? 0);
        if ($salario <= 0.0 || $jornada <= 0.0) {
            return null;
        }

        return $salario / $jornada;
    }

    private function resolveLocationSedeCargoTarifaContratoActivo(int $empresaId, int $profileId, NovedadSolicitudContextForm $ctx): ?LocationSedeCargoTarifa
    {
        $contrato = $this->resolveContratoActivoContexto($empresaId, $profileId, $ctx);
        if ($contrato === null) {
            return null;
        }
        $sid = (int) ($contrato->sede_id ?? 0);
        $cid = (int) ($contrato->cargo_id ?? 0);
        if ($sid <= 0 || $cid <= 0) {
            return null;
        }
        if (LocationSedes::findOne(['id' => $sid, 'empresa_id' => $empresaId]) === null) {
            return null;
        }

        return LocationSedeCargoTarifa::findOne(['location_sede_id' => $sid, 'cargo_id' => $cid]);
    }

    /**
     * @return array<string, float>
     */
    private function mapTarifasHorasDesdeCargoTarifa(LocationSedeCargoTarifa $t): array
    {
        $diurna = (float) ($t->valor_hora_diurna ?? 0);
        $domFest = (float) ($t->valor_hora_diurna_domingo_festivos ?? 0);
        $noct = (float) ($t->valor_hora_nocturna ?? 0);
        $noctDomFest = (float) ($t->valor_hora_nocturna_domingo_festiva ?? 0);

        return [
            NovedadHorasTroceoService::COD_HORA_DIURNA => $diurna,
            NovedadHorasTroceoService::COD_HORA_ESPECIAL => (float) ($t->valor_hora_especial ?? 0),
            NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION => (float) ($t->valor_movilizacion ?? 0),
            NovedadHorasTroceoService::COD_REC_DOM_FEST => $domFest,
            NovedadHorasTroceoService::COD_HORA_FESTIVA_DIURNA => $domFest,
            NovedadHorasTroceoService::COD_REC_NOCT => $noct,
            NovedadHorasTroceoService::COD_HORA_NOCTURNA => $noct,
            NovedadHorasTroceoService::COD_REC_NOCT_FEST => $noct,
            NovedadHorasTroceoService::COD_HORA_FESTIVA_NOCTURNA => $noctDomFest,
            NovedadHorasTroceoService::COD_DOMINICAL_COMPENSATORIO => $noctDomFest,
        ];
    }

    /**
     * @return array<string, float>|null
     */
    private function resolveTarifasHorasPorConcepto(int $empresaId, int $profileId, NovedadSolicitudContextForm $ctx): ?array
    {
        $tarifa = $this->resolveLocationSedeCargoTarifaContratoActivo($empresaId, $profileId, $ctx);
        if ($tarifa === null) {
            return null;
        }

        return $this->mapTarifasHorasDesdeCargoTarifa($tarifa);
    }

    /**
     * Factores multiplicadores por código de concepto (setting año/país) para contrato distinto de tipo HORAS.
     *
     * @return array<string, float>
     */
    private function resolveTarifasHorasPorConceptoDesdeSetting(Setting $setting): array
    {
        $diurna = (float) ($setting->valor_hora_extra_diurna ?? 0);
        $domFest = (float) ($setting->valor_hora_extra_dia_festivo ?? 0);
        $noct = (float) ($setting->recargo_nocturno ?? 0);
        if ($noct <= 0.0 && $setting->valor_hora_extra_nocturna !== null && $setting->valor_hora_extra_nocturna !== '') {
            $noct = (float) $setting->valor_hora_extra_nocturna;
        }
        $noctFest = (float) ($setting->valor_hora_extra_nocturno_festivo ?? 0);
        $domComp = (float) ($setting->valor_dominical_compensatorio ?? 0);
        if ($domComp <= 0.0 && $setting->recargo_nocturno_dominical_festivo !== null && $setting->recargo_nocturno_dominical_festivo !== '') {
            $domComp = (float) $setting->recargo_nocturno_dominical_festivo;
        }

        return [
            NovedadHorasTroceoService::COD_HORA_DIURNA => $diurna,
            NovedadHorasTroceoService::COD_HORA_ESPECIAL => $diurna,
            NovedadHorasTroceoService::COD_REC_DOM_FEST => $domFest,
            NovedadHorasTroceoService::COD_HORA_FESTIVA_DIURNA => $domFest,
            NovedadHorasTroceoService::COD_REC_NOCT => $noct,
            NovedadHorasTroceoService::COD_HORA_NOCTURNA => $noct,
            NovedadHorasTroceoService::COD_REC_NOCT_FEST => $noctFest,
            NovedadHorasTroceoService::COD_HORA_FESTIVA_NOCTURNA => $noctFest,
            NovedadHorasTroceoService::COD_DOMINICAL_COMPENSATORIO => $domComp,
        ];
    }

    private function factorMultiplicadorSettingHorasPorCodigo(Setting $setting, string $codigo): float
    {
        $map = $this->resolveTarifasHorasPorConceptoDesdeSetting($setting);

        return (float) ($map[$codigo] ?? 0.0);
    }

    private function resolveImporteAuxilioMovilizacion(int $empresaId, int $profileId, NovedadSolicitudContextForm $ctx): ?float
    {
        $tarifa = $this->resolveLocationSedeCargoTarifaContratoActivo($empresaId, $profileId, $ctx);
        if ($tarifa !== null && $tarifa->valor_movilizacion !== null && (float) $tarifa->valor_movilizacion > 0) {
            return (float) $tarifa->valor_movilizacion;
        }

        return NovedadAuxilioMovilizacionResolver::importePredeterminado($empresaId);
    }

    private function resolveSedeContratoActivo(int $empresaId, int $profileId, NovedadSolicitudContextForm $ctx): ?LocationSedes
    {
        if ($empresaId <= 0 || $profileId <= 0) {
            return null;
        }

        $sedeId = (int) ($ctx->sede_id ?? 0);
        if ($sedeId > 0) {
            return LocationSedes::findOne(['id' => $sedeId, 'empresa_id' => $empresaId]);
        }

        $contrato = $this->resolveContratoActivoContexto($empresaId, $profileId, $ctx);
        if ($contrato === null || (int) ($contrato->sede_id ?? 0) <= 0) {
            return null;
        }

        return LocationSedes::findOne(['id' => (int) $contrato->sede_id, 'empresa_id' => $empresaId]);
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

    private function asignarContextoValidacionEmpresaCliente(NovedadSolicitudContextForm $ctx, Novedad $model): void
    {
        $ctx->profileUserIdParaEmpresaCliente = (int) ($model->profile_id ?: 0);
        $fechaVal = (string) ($model->fecha_novedad ?? '');
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaVal)) {
            $fechaVal = date('Y-m-d');
        }
        $ctx->fechaNovedadParaEmpresaCliente = $fechaVal;
    }

    /**
     * Precarga empleado y contexto en GET (/novedad/create?profile_id=…&fecha_novedad=…).
     */
    private function aplicarPrefillSolicitudDesdeRequest(Novedad $model, NovedadSolicitudContextForm $ctx, int $tenantId): void
    {
        $pid = (int) Yii::$app->request->get('profile_id', 0);
        if ($pid <= 0) {
            return;
        }

        $profile = Profile::findOne([
            'user_id' => $pid,
            'empresas_id' => $tenantId,
        ]);
        if ($profile === null) {
            Yii::$app->session->setFlash(
                'warning',
                Yii::t('app', 'No se pudo precargar el colaborador indicado (no encontrado en su organización).')
            );

            return;
        }

        if (Yii::$app->user->can('gerente_sede')) {
            $identity = Yii::$app->user->identity;
            $op = $identity && $identity->profile ? $identity->profile : null;
            if ($op !== null && !empty($op->sede_id) && (int) $profile->sede_id !== (int) $op->sede_id) {
                Yii::$app->session->setFlash(
                    'warning',
                    Yii::t('app', 'No se pudo precargar el colaborador indicado (no corresponde a su sede).')
                );

                return;
            }
        }

        $fecha = trim((string) Yii::$app->request->get('fecha_novedad', ''));
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            $fecha = date('Y-m-d');
        }

        $model->profile_id = $pid;
        $model->fecha_novedad = $fecha;

        $ctx->profileUserIdParaEmpresaCliente = $pid;
        $ctx->fechaNovedadParaEmpresaCliente = $fecha;

        $clientes = EmpresaCliente::activosPorPerfilYContratoVigente($tenantId, $pid, $fecha);
        if (count($clientes) === 1) {
            $ctx->empresa_cliente_id = (int) $clientes[0]->id;
        }

        if ($profile->sede_id !== null) {
            $sede = LocationSedes::findOne([
                'id' => (int) $profile->sede_id,
                'empresa_id' => $tenantId,
                'activo' => 1,
            ]);
            if ($sede !== null) {
                $ctx->sede_id = (int) $sede->id;
                if ($sede->city_id !== null) {
                    $ctx->ciudad_id = (int) $sede->city_id;
                }
            }
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
        $ausentismosTipoId = $this->resolveAusentismosNovedadTipoId($tenantId);

        $clientesGlobales = $tenantId ? EmpresaCliente::getActivos($tenantId) : [];

        $esContratoTipoHorasForm = false;
        $eidForm = (int) ($model->empresa_id ?? 0);
        $pidForm = (int) ($model->profile_id ?? 0);
        if ($eidForm > 0 && $pidForm > 0) {
            $esContratoTipoHorasForm = $this->esContratoTipoHorasActivo($eidForm, $pidForm, $ctx);
        }

        return [
            'model' => $model,
            'ctx' => $ctx,
            'empresa' => $empresa,
            'tipoSeleccionado' => $tipoSeleccionado,
            'horasTipoId' => $horasTipo ? (int) $horasTipo->id : null,
            'ausentismosTipoId' => $ausentismosTipoId > 0 ? $ausentismosTipoId : null,
            'esContratoTipoHoras' => $esContratoTipoHorasForm,
            'clientesEmpresa' => [],
            'clienteUnico' => null,
            'sinEmpresaCliente' => $tenantId !== null && $clientesGlobales === [],
            'solicitudFormState' => $this->buildSolicitudFormStateForView($model, $ctx),
        ];
    }

    /**
     * Id del agrupador Ausentismos (por código).
     */
    private function resolveAusentismosNovedadTipoId(?int $tenantId): int
    {
        $q = NovedadTipo::find()
            ->select('id')
            ->where(['codigo' => 'ausentismos', 'activo' => 1]);
        if ($this->novedadTipoTieneColumnaEmpresa() && $tenantId !== null) {
            $q->andWhere(['empresa_id' => (int) $tenantId]);
        }

        return (int) ($q->scalar() ?: 0);
    }

    /**
     * @return array<string, string> id => etiqueta (misma convención que staffing_admin)
     */
    private function mapaCentrosCostoNovedad(): array
    {
        $rows = NovedadCentroCosto::find()
            ->where(['activo' => 1])
            ->orderBy(['nombre' => SORT_ASC])
            ->all();
        $out = [];
        foreach ($rows as $r) {
            $cod = trim((string) $r->codigo);
            $nom = (string) $r->nombre;
            $out[(string) $r->id] = $cod !== '' ? $cod . ' — ' . $nom : $nom;
        }

        return $out;
    }

    /**
     * Valores del último POST para repoblar selects AJAX tras errores de validación.
     *
     * @return array<string, mixed>
     */
    private function buildSolicitudFormStateForView(Novedad $model, NovedadSolicitudContextForm $ctx): array
    {
        $tenantId = $this->currentEmpresaId();

        $state = [
            'horas_filas' => Yii::$app->request->isPost ? $this->normalizarHorasFilasDesdePost() : [],
            'novedad_tipo_id' => $ctx->novedad_tipo_id !== null ? (int) $ctx->novedad_tipo_id : null,
            'empresa_cliente_id' => $ctx->empresa_cliente_id !== null ? (int) $ctx->empresa_cliente_id : null,
            'ciudad_id' => $ctx->ciudad_id !== null ? (int) $ctx->ciudad_id : null,
            'sede_id' => $ctx->sede_id !== null ? (int) $ctx->sede_id : null,
            'profile_id' => $model->profile_id !== null ? (int) $model->profile_id : null,
            'concepto_id' => $model->concepto_id !== null ? (int) $model->concepto_id : null,
            'num_doc' => null,
            'cargo_id' => null,
            'empleado_display_name' => null,
            'empleado_cargo_nombre' => null,
            'ciudad_nombre' => null,
        ];
        $fecha = (string) ($model->fecha_novedad ?? '');
        $ctrVigente = null;
        if ($model->profile_id !== null && (int) $model->profile_id > 0) {
            $pfCond = ['user_id' => (int) $model->profile_id];
            if ($tenantId !== null) {
                $pfCond['empresas_id'] = (int) $tenantId;
            }
            $pf = Profile::findOne($pfCond);
            if ($pf !== null) {
                if (
                    $pf->num_doc !== null
                    && trim((string) $pf->num_doc) !== ''
                    && $pf->estado === Profile::ESTADO_ACTIVO
                ) {
                    $state['num_doc'] = trim((string) $pf->num_doc);
                }
                $nom = trim((string) ($pf->name ?? ''));
                if ($nom !== '') {
                    $state['empleado_display_name'] = $nom;
                }
                if (
                    $tenantId !== null
                    && preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)
                ) {
                    $q = Contrato::findOccupyingAt($fecha)
                        ->andWhere([
                            'contrato.profile_id' => (int) $model->profile_id,
                            'contrato.empresa_id' => (int) $tenantId,
                        ]);
                    if ((int) ($ctx->empresa_cliente_id ?? 0) > 0) {
                        $ctrVigente = (clone $q)->andWhere(['contrato.empresa_cliente_id' => (int) $ctx->empresa_cliente_id])->one();
                    }
                    if ($ctrVigente === null) {
                        $ctrVigente = $q->one();
                    }
                    if ($ctrVigente !== null) {
                        $state['cargo_id'] = (int) $ctrVigente->cargo_id;
                        if ($ctrVigente->cargo !== null) {
                            $cn = trim((string) $ctrVigente->cargo->nombre);
                            if ($cn !== '') {
                                $state['empleado_cargo_nombre'] = $cn;
                            }
                        }
                    }
                }
                if ($state['empleado_cargo_nombre'] === null || $state['empleado_cargo_nombre'] === '') {
                    if ($pf->cargo_id !== null && (int) $pf->cargo_id > 0) {
                        $cPerfil = $pf->cargo ?? Cargos::findOne((int) $pf->cargo_id);
                        if ($cPerfil !== null) {
                            $cn = trim((string) $cPerfil->nombre);
                            if ($cn !== '') {
                                $state['empleado_cargo_nombre'] = $cn;
                            }
                        }
                    }
                }
                if ($state['empleado_cargo_nombre'] === null || $state['empleado_cargo_nombre'] === '') {
                    $pos = trim((string) ($pf->position ?? ''));
                    if ($pos !== '') {
                        $state['empleado_cargo_nombre'] = $pos;
                    }
                }
            }
        }
        if ($ctx->ciudad_id !== null && (int) $ctx->ciudad_id > 0) {
            $city = City::findOne((int) $ctx->ciudad_id);
            if ($city !== null) {
                $cn = trim((string) ($city->name ?? ''));
                if ($cn !== '') {
                    $state['ciudad_nombre'] = $cn;
                }
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
        $idModel = (int) $model->id;
        $empresaId = (int) $model->empresa_id;

        $tx = Yii::$app->db->beginTransaction();
        try {
            $childIds = Novedad::find()
                ->select('id')
                ->where(['novedad_origen_id' => $idModel, 'empresa_id' => $empresaId])
                ->column();
            if ($childIds !== []) {
                Novedad::deleteAll(['id' => $childIds, 'empresa_id' => $empresaId]);
            }
            Novedad::deleteAll(['id' => $idModel, 'empresa_id' => $empresaId]);
            $tx->commit();
        } catch (Throwable $e) {
            $tx->rollBack();
            Yii::error($e, __METHOD__);
            Yii::$app->session->setFlash('error', Yii::t('app', 'No se pudo eliminar la solicitud.'));

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->statusCode = 500;

                return ['success' => false, 'message' => Yii::t('app', 'No se pudo eliminar la solicitud.')];
            }

            return $this->redirect(['view', 'id' => $idModel]);
        }

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ['success' => true];
        }
        Yii::$app->session->setFlash('info', Yii::t('app', 'Solicitud eliminada.'));

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
        $profileUserId = (int) Yii::$app->request->get('profile_id', 0);
        $fecha = trim((string) Yii::$app->request->get('fecha_novedad', ''));
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            $fecha = date('Y-m-d');
        }
        $empresaClienteId = (int) Yii::$app->request->get('empresa_cliente_id', 0);
        [$cargoId] = $this->resolveCargoContext(
            $eid,
            $profileUserId,
            $fecha,
            $empresaClienteId > 0 ? $empresaClienteId : null
        );

        $tq = NovedadTipo::find()->where(['activo' => 1]);
        if ($this->novedadTipoTieneColumnaEmpresa()) {
            $tq->andWhere(['empresa_id' => $eid]);
        }
        $tipos = $tq->orderBy(['orden' => SORT_ASC, 'nombre' => SORT_ASC])->all();
        $tipos = array_values(array_filter(
            $tipos,
            fn(NovedadTipo $t): bool => $this->usuarioPuedeCrearTipo($t)
        ));
        if ($profileUserId > 0) {
            $tipos = array_values(array_filter($tipos, function (NovedadTipo $t) use ($eid, $cargoId): bool {
                return !empty($this->conceptosPermitidosPorTipo($eid, (int) $t->id, $cargoId));
            }));
        }

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
    public function actionTipoCampos(int $novedad_tipo_id = 0): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $eid = $this->currentEmpresaId();
        if ($eid === null) {
            return ['success' => false, 'items' => []];
        }
        $conceptoId = (int) Yii::$app->request->get('concepto_id', 0);
        if ($conceptoId > 0) {
            $concepto = NovedadConcepto::findOne(['id' => $conceptoId, 'activo' => 1]);
            if ($concepto === null) {
                return ['success' => false, 'items' => []];
            }
            $tipoCond = ['id' => (int) $concepto->novedad_tipo_id, 'activo' => 1];
            if ($this->novedadTipoTieneColumnaEmpresa()) {
                $tipoCond['empresa_id'] = $eid;
            }
            $tipo = NovedadTipo::findOne($tipoCond);
            if ($tipo === null || !$this->usuarioPuedeCrearTipo($tipo)) {
                return ['success' => false, 'items' => []];
            }
            $profileUserId = (int) Yii::$app->request->get('profile_id', 0);
            if ($profileUserId > 0) {
                $fecha = trim((string) Yii::$app->request->get('fecha_novedad', ''));
                if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
                    $fecha = date('Y-m-d');
                }
                $empresaClienteId = (int) Yii::$app->request->get('empresa_cliente_id', 0);
                [$cargoId] = $this->resolveCargoContext(
                    $eid,
                    $profileUserId,
                    $fecha,
                    $empresaClienteId > 0 ? $empresaClienteId : null
                );
                $permitidos = $this->conceptosPermitidosPorTipo($eid, (int) $tipo->id, $cargoId);
                $permitidosIds = array_map(static fn(NovedadConcepto $c): int => (int) $c->id, $permitidos);
                if (!in_array($conceptoId, $permitidosIds, true)) {
                    return ['success' => false, 'items' => []];
                }
            }
            $campos = NovedadConceptoFormularioService::camposOrdenados($concepto);
            $items = [];
            foreach ($campos as $c) {
                $fuente = trim((string) ($c->fuente_opciones ?? ''));
                $opciones = array_map(static function ($op) {
                    return [
                        'valor' => $op->valor,
                        'etiqueta' => $op->etiqueta !== null && $op->etiqueta !== '' ? $op->etiqueta : $op->valor,
                    ];
                }, $c->opciones ?? []);
                if ((string) $c->tipo_dato === 'select' && $fuente === 'novedad_centro_costo') {
                    $opciones = [];
                    foreach ($this->mapaCentrosCostoNovedad() as $id => $etiqueta) {
                        $opciones[] = ['valor' => (string) $id, 'etiqueta' => $etiqueta];
                    }
                }
                $tipoUi = (string) $c->tipo_dato;
                $archUi = NovedadConceptoFormularioService::tipoDatoFormularioArchivo($c);
                if ($archUi !== null) {
                    $tipoUi = $archUi;
                    $opciones = [];
                }
                $items[] = [
                    'campo_id' => (string) $c->campo_id,
                    'label' => (string) $c->label,
                    'tipo_dato' => $tipoUi,
                    'requerido' => (int) $c->requerido === 1,
                    'fuente_opciones' => $fuente,
                    'opciones' => $opciones,
                ];
            }

            $datosDefecto = [];
            $enc = EmpresaNovedadConcepto::findOne([
                'empresa_id' => $eid,
                'novedad_concepto_id' => $conceptoId,
            ]);
            if ($enc !== null && $enc->valor_por_defecto !== null && (string) $enc->valor_por_defecto !== '') {
                $datosDefecto['valor'] = (string) (float) $enc->valor_por_defecto;
            }

            return ['success' => true, 'items' => $items, 'datos_defecto' => $datosDefecto];
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

        $profileUserId = (int) Yii::$app->request->get('profile_id', 0);
        $fecha = (string) Yii::$app->request->get('fecha_novedad', '');
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            $fecha = date('Y-m-d');
        }
        $empresaClienteId = (int) Yii::$app->request->get('empresa_cliente_id', 0);
        [$cargoId, $cargoNombre] = $this->resolveCargoContext(
            $eid,
            $profileUserId,
            $fecha,
            $empresaClienteId > 0 ? $empresaClienteId : null
        );
        $conceptos = $this->conceptosPermitidosPorTipo($eid, (int) $tipo->id, $cargoId);

        if ($tipo->esTipoHoras()) {
            $ecid = $empresaClienteId > 0 ? $empresaClienteId : null;
            $esH = $this->esContratoTipoHorasParaEmpleado($eid, $profileUserId, $ecid);
            if (!$esH) {
                $conceptos = array_values(array_filter($conceptos, static function (NovedadConcepto $c): bool {
                    $cod = strtoupper(trim((string) ($c->codigo ?? '')));

                    return $cod !== NovedadHorasTroceoService::COD_HORA_ESPECIAL
                        && $cod !== NovedadHorasTroceoService::COD_AUXILIO_MOVILIZACION;
                }));
            }
        }

        $items = array_map(static function (NovedadConcepto $c) {
            return ['id' => (int) $c->id, 'nombre' => $c->nombre, 'codigo' => $c->codigo];
        }, $conceptos);

        $emptyMessage = null;
        if ($profileUserId > 0 && $items === []) {
            $emptyMessage = Yii::t('app', 'Deben configurarse los conceptos para el cargo {cargo} del empleado.', [
                'cargo' => $cargoNombre !== null && $cargoNombre !== '' ? $cargoNombre : '—',
            ]);
        }

        return [
            'success' => true,
            'items' => $items,
            'empty_message' => $emptyMessage,
        ];
    }

    public function actionSedes(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $eid = $this->currentEmpresaId();
        if ($eid === null) {
            return [];
        }

        $empresaClienteId = (int) Yii::$app->request->get('empresa_cliente_id', 0);
        $profileId        = (int) Yii::$app->request->get('profile_id', 0);
        $fecha            = trim((string) Yii::$app->request->get('fecha_novedad', ''));
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            $fecha = date('Y-m-d');
        }

        /**
         * Cascada de filtrado (cuando hay empleado):
         * 1) Contrato vigente (preferiblemente del cliente seleccionado) → sede/ciudad preferida.
         * 2) Si no hay sede en contrato, distribución del contrato.
         * 3) Si no hay contrato aplicable, profile_sedes.
         * 4) Fallback: sedes del contrato vigente (distribución).
         * 5) Último fallback: todas las sedes activas del tenant.
         */
        $sedeIds = null; // null = sin filtro por IDs
        $preferredSedeId = null;
        $preferredCityId = null;

        if ($profileId > 0) {
            $contratoQuery = Contrato::findOccupyingAt($fecha)
                ->andWhere(['contrato.profile_id' => $profileId, 'contrato.empresa_id' => $eid]);

            $contrato = null;
            if ($empresaClienteId > 0) {
                $contrato = (clone $contratoQuery)
                    ->andWhere(['contrato.empresa_cliente_id' => $empresaClienteId])
                    ->orderBy(['contrato.id' => SORT_DESC])
                    ->one();
            }
            if ($contrato === null) {
                $contrato = (clone $contratoQuery)
                    ->orderBy(['contrato.id' => SORT_DESC])
                    ->one();
            }

            if ($contrato !== null) {
                if (!empty($contrato->sede_id)) {
                    $preferredSedeId = (int) $contrato->sede_id;
                    $sedeIds = [$preferredSedeId];
                }
                if (!empty($contrato->ciudad_id)) {
                    $preferredCityId = (int) $contrato->ciudad_id;
                }
                if ($sedeIds === null) {
                    $distribIds = ContratoDistribucionSede::find()
                        ->select('sede_id')
                        ->where(['contrato_id' => $contrato->id])
                        ->column();
                    $distribIds = array_map('intval', $distribIds);
                    if (!empty($distribIds)) {
                        $sedeIds = $distribIds;
                    }
                }
            }

            if ($sedeIds === null) {
                $profile = Profile::findOne(['user_id' => $profileId]);
                if ($profile !== null) {
                    $profileSedeIds = ProfileSede::locationSedeIdsForProfileModel($profile);
                    if (!empty($profileSedeIds)) {
                        $sedeIds = $profileSedeIds;
                    }
                }
            }
        }

        $query = LocationSedes::find()
            ->with('city')
            ->where(['empresa_id' => $eid, 'activo' => 1])
            ->orderBy('nombre');

        if ($sedeIds !== null) {
            $query->andWhere(['id' => $sedeIds]);
        }

        return array_map(static function (LocationSedes $s) use ($preferredSedeId, $preferredCityId): array {
            $cityId = $s->city_id !== null ? (int) $s->city_id : null;
            $preferida = false;
            if ($preferredSedeId !== null && $preferredSedeId > 0) {
                $preferida = ((int) $s->id === (int) $preferredSedeId);
            } elseif ($preferredCityId !== null && $preferredCityId > 0 && $cityId !== null) {
                $preferida = ($cityId === (int) $preferredCityId);
            }
            return [
                'id'          => (int) $s->id,
                'nombre'      => (string) $s->nombre,
                'city_id'     => $cityId,
                'city_nombre' => $s->city ? (string) $s->city->name : null,
                'preferida'   => $preferida,
            ];
        }, $query->all());
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
        $rows = City::sortRowsWithPriority(
            City::find()->where(['is_active' => 1])->orderBy('name')->limit(500)->all()
        );

        return array_map(static function (City $c) {
            return ['id' => $c->id, 'nombre' => $c->name];
        }, $rows);
    }

    /**
     * Empresas cliente permitidas para la solicitud: activas del tenant y ligadas al empleado por contrato vigente a la fecha.
     */
    public function actionEmpresasClientePorEmpleado(): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $eid = $this->currentEmpresaId();
        $pid = (int) Yii::$app->request->get('profile_id', 0);
        $fecha = trim((string) Yii::$app->request->get('fecha_novedad', ''));
        if ($eid === null || $pid <= 0) {
            return ['success' => true, 'items' => []];
        }
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha)) {
            $fecha = date('Y-m-d');
        }
        $rows = EmpresaCliente::activosPorPerfilYContratoVigente((int) $eid, $pid, $fecha);

        return [
            'success' => true,
            'items' => array_map(static function (EmpresaCliente $e): array {
                return ['id' => (int) $e->id, 'nombre' => (string) $e->nombre];
            }, $rows),
        ];
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

        $empresaClienteFiltro = (int) Yii::$app->request->get('empresa_cliente_id', 0);
        $empresaClienteFiltro = $empresaClienteFiltro > 0 ? $empresaClienteFiltro : null;

        return [
            'results' => array_map(function (Profile $p) use ($eid, $fecha, $empresaClienteFiltro) {
                [$cargoId, $cargoNombre] = $this->resolveCargoContext($eid, $p->user_id, $fecha, $empresaClienteFiltro);

                return [
                    'id' => $p->user_id,
                    'text' => ($p->name ?: Yii::t('app', 'Sin nombre')) . ' — ' . $p->num_doc,
                    'name' => $p->name,
                    'num_doc' => $p->num_doc,
                    'cargo_id' => $cargoId,
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
        $cls = Novedad::estadoBadgeSoftClass($model->estado);

        return '<span class="badge badge-soft-' . $cls . '">' . $label . '</span>';
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

    /**
     * Contrato vigente del empleado; si se indica empresa cliente, se prioriza el de ese cliente (misma regla que {@see actionSedes}).
     *
     * @return array{0: ?int, 1: ?string}
     */
    private function resolveCargoContext(int $empresaId, int $profileUserId, string $fechaYmd, ?int $empresaClienteId = null): array
    {
        if ($profileUserId <= 0) {
            return [null, null];
        }
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fechaYmd)) {
            $fechaYmd = date('Y-m-d');
        }
        $base = Contrato::findOccupyingAt($fechaYmd)
            ->with('cargo')
            ->andWhere(['contrato.profile_id' => $profileUserId, 'contrato.empresa_id' => $empresaId]);

        $contrato = null;
        if ($empresaClienteId !== null && $empresaClienteId > 0) {
            $contrato = (clone $base)
                ->andWhere(['contrato.empresa_cliente_id' => $empresaClienteId])
                ->orderBy(['contrato.id' => SORT_DESC])
                ->one();
        }
        if ($contrato === null) {
            $contrato = (clone $base)
                ->orderBy(['contrato.id' => SORT_DESC])
                ->one();
        }
        if ($contrato === null || $contrato->cargo_id === null) {
            return [null, null];
        }
        $cargoNombre = $contrato->cargo ? (string) $contrato->cargo->nombre : null;

        return [(int) $contrato->cargo_id, $cargoNombre];
    }

    /**
     * @return NovedadConcepto[]
     */
    private function conceptosPermitidosPorTipo(int $empresaId, int $tipoId, ?int $cargoId): array
    {
        $q = NovedadConcepto::find()
            ->where(['novedad_tipo_id' => $tipoId, 'activo' => 1])
            ->orderBy(['nombre' => SORT_ASC]);

        $hayEnc = EmpresaNovedadConcepto::find()->where(['empresa_id' => $empresaId])->exists();
        if ($hayEnc) {
            $q->innerJoin(
                'empresa_novedad_concepto enc',
                'enc.novedad_concepto_id = novedad_concepto.id AND enc.empresa_id = ' . (int) $empresaId
            );
        }

        /** @var NovedadConcepto[] $conceptos */
        $conceptos = $q->all();
        return $this->filtrarConceptosPorCargoAplicabilidad($conceptos, $cargoId);
    }

    private function currentEmpresaId(): ?int
    {
        return TenantContext::currentEmpresaId();
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
