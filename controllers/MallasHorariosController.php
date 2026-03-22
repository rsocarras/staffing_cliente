<?php

namespace app\controllers;

use app\components\TenantContext;
use app\models\MallaCargoAsignacion;
use app\models\MallaProfileAsignacion;
use app\models\Mallas;
use app\models\MallasHorarios;
use app\models\search\MallasHorariosSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * MallasHorariosController implements the CRUD actions for MallasHorarios model.
 */
class MallasHorariosController extends Controller
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
                        'init-board-ajax' => ['POST'],
                        'save-board-ajax' => ['POST'],
                        'create-block-ajax' => ['POST'],
                        'update-block-ajax' => ['POST'],
                        'delete-block-ajax' => ['POST'],
                        'clear-day-ajax' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionInitBoardAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $board = $this->ensureBoard(
                $this->request->post('malla_id'),
                (array) $this->request->post('board', []),
                false
            );

            return [
                'success' => true,
                'board' => $this->serializeBoard($board),
                'blocks' => $this->serializeBlocks($board),
                'summary' => $this->buildBoardSummary($board),
            ];
        } catch (\DomainException $e) {
            return ['success' => false, 'errors' => ['general' => [$e->getMessage()]]];
        }
    }

    public function actionSaveBoardAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $mode = (string) $this->request->post('mode', 'draft');
        $publish = $mode === 'publish';

        try {
            $board = $this->ensureBoard(
                $this->request->post('malla_id'),
                (array) $this->request->post('board', []),
                $publish
            );

            $blocks = $this->serializeBlocks($board);
            $conflicts = $this->detectOverlapIssues($blocks);
            if (!empty($conflicts)) {
                return [
                    'success' => false,
                    'errors' => ['general' => $conflicts],
                ];
            }

            if ($publish && empty($blocks)) {
                return [
                    'success' => false,
                    'errors' => ['general' => ['Agrega al menos un bloque antes de publicar la malla.']],
                ];
            }

            if ($publish) {
                $board->estado_aprobacion = Mallas::ESTADO_PENDIENTE;
                $board->motivo_rechazo = null;
                $board->solicitado_por = Yii::$app->user->id;
                $board->solicitado_at = date('Y-m-d H:i:s');
                $board->aprobado_por = null;
                $board->aprobado_at = null;
            } else {
                $board->estado_aprobacion = Mallas::ESTADO_DRAFT;
                $board->motivo_rechazo = null;
                $board->solicitado_por = null;
                $board->solicitado_at = null;
                $board->aprobado_por = null;
                $board->aprobado_at = null;
            }

            $board->save(false);

            return [
                'success' => true,
                'message' => $publish ? 'Malla publicada para aprobación.' : 'Borrador guardado correctamente.',
                'board' => $this->serializeBoard($board),
                'blocks' => $this->serializeBlocks($board),
                'summary' => $this->buildBoardSummary($board),
                'viewUrl' => Url::to(['/mallas/view', 'id' => $board->id]),
            ];
        } catch (\DomainException $e) {
            return ['success' => false, 'errors' => ['general' => [$e->getMessage()]]];
        }
    }

    public function actionCreateBlockAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $board = $this->ensureBoard(
                $this->request->post('malla_id'),
                (array) $this->request->post('board', []),
                false
            );

            $payload = $this->normalizeBlockPayload($this->request->post(), null);
            $model = new MallasHorarios();
            $this->fillBlockModel($model, $board->id, $payload);

            $conflicts = $this->detectOverlapIssues(array_merge(
                $this->serializeBlocks($board),
                [$this->serializeBlock($model)]
            ));
            if (!empty($conflicts)) {
                return ['success' => false, 'errors' => ['general' => $conflicts]];
            }

            if (!$model->validate()) {
                return ['success' => false, 'errors' => $model->getErrors()];
            }

            $model->save(false);

            return [
                'success' => true,
                'message' => 'Bloque creado.',
                'board' => $this->serializeBoard($board),
                'blocks' => $this->serializeBlocks($board),
                'block' => $this->serializeBlock($model),
                'summary' => $this->buildBoardSummary($board),
            ];
        } catch (\DomainException $e) {
            return ['success' => false, 'errors' => ['general' => [$e->getMessage()]]];
        }
    }

    public function actionUpdateBlockAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $id = (int) $this->request->post('id');
            $model = $this->findModel($id);
            $board = $this->findBoardForWrite((int) $model->malla_id);
            $payload = $this->normalizeBlockPayload($this->request->post(), $model);

            $this->fillBlockModel($model, $board->id, $payload);

            $existing = array_values(array_filter(
                $this->serializeBlocks($board),
                static function (array $block) use ($model) {
                    return (int) $block['id'] !== (int) $model->id;
                }
            ));
            $conflicts = $this->detectOverlapIssues(array_merge($existing, [$this->serializeBlock($model)]));
            if (!empty($conflicts)) {
                return ['success' => false, 'errors' => ['general' => $conflicts]];
            }

            if (!$model->validate()) {
                return ['success' => false, 'errors' => $model->getErrors()];
            }

            $model->save(false);

            return [
                'success' => true,
                'message' => 'Bloque actualizado.',
                'board' => $this->serializeBoard($board),
                'blocks' => $this->serializeBlocks($board),
                'block' => $this->serializeBlock($model),
                'summary' => $this->buildBoardSummary($board),
            ];
        } catch (\DomainException $e) {
            return ['success' => false, 'errors' => ['general' => [$e->getMessage()]]];
        }
    }

    public function actionDeleteBlockAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $id = (int) $this->request->post('id');
            $model = $this->findModel($id);
            $board = $this->findBoardForWrite((int) $model->malla_id);
            $model->delete();

            return [
                'success' => true,
                'message' => 'Bloque eliminado.',
                'board' => $this->serializeBoard($board),
                'blocks' => $this->serializeBlocks($board),
                'summary' => $this->buildBoardSummary($board),
            ];
        } catch (\DomainException $e) {
            return ['success' => false, 'errors' => ['general' => [$e->getMessage()]]];
        }
    }

    public function actionClearDayAjax()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        try {
            $mallaId = (int) $this->request->post('malla_id');
            $day = (int) $this->request->post('day');
            if ($day < 1 || $day > 7) {
                throw new \DomainException('El día enviado es inválido.');
            }

            $board = $this->findBoardForWrite($mallaId);
            MallasHorarios::deleteAll([
                'malla_id' => $board->id,
                'dia_semana' => $day,
            ]);

            return [
                'success' => true,
                'message' => 'Día limpiado.',
                'board' => $this->serializeBoard($board),
                'blocks' => $this->serializeBlocks($board),
                'summary' => $this->buildBoardSummary($board),
            ];
        } catch (\DomainException $e) {
            return ['success' => false, 'errors' => ['general' => [$e->getMessage()]]];
        }
    }

    /**
     * Lists all MallasHorarios models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MallasHorariosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false; // Cargar todos para DataTables client-side

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MallasHorarios model.
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
     * Creates a new MallasHorarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MallasHorarios();

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
     * Updates an existing MallasHorarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
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
     * Deletes an existing MallasHorarios model.
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

    /**
     * Finds the MallasHorarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return MallasHorarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MallasHorarios::findOne(['id' => $id])) !== null) {
            $empresaId = $this->currentEmpresaId();
            if (
                $empresaId !== null
                && $model->malla !== null
                && (int) $model->malla->empresa_id !== (int) $empresaId
            ) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function ensureBoard($mallaId, array $boardPayload, bool $requireNameForSave): Mallas
    {
        if (!empty($mallaId)) {
            $board = $this->findBoardForWrite((int) $mallaId);
        } else {
            $empresaId = $this->currentEmpresaId();
            if ($empresaId === null) {
                throw new \DomainException('No se encontró empresas_id en la sesión del usuario.');
            }

            $board = new Mallas();
            $board->empresa_id = $empresaId;
            $board->estado_aprobacion = Mallas::ESTADO_DRAFT;
            $board->activo = 1;
            $board->tipo = Mallas::TIPO_FIJA;
        }

        $this->applyBoardPayload($board, $boardPayload, $requireNameForSave);
        if ($board->hasErrors() || !$board->validate()) {
            $errors = $board->getFirstErrors();
            throw new \DomainException(reset($errors) ?: 'No fue posible guardar la cabecera de la malla.');
        }

        $board->save(false);

        return $board;
    }

    private function applyBoardPayload(Mallas $board, array $payload, bool $requireExplicitName): void
    {
        $name = trim((string) ($payload['nombre'] ?? $board->nombre ?? ''));
        if ($name === '') {
            if ($requireExplicitName) {
                $board->addError('nombre', 'El nombre de la malla es obligatorio.');
                return;
            }

            if ($board->isNewRecord || trim((string) $board->nombre) === '') {
                $name = 'Malla sin título ' . date('YmdHis');
            } else {
                $name = $board->nombre;
            }
        }

        $type = trim((string) ($payload['tipo'] ?? $board->tipo ?? Mallas::TIPO_FIJA));
        if (!array_key_exists($type, Mallas::optsTipo())) {
            $type = Mallas::TIPO_FIJA;
        }

        $activo = array_key_exists('activo', $payload)
            ? (int) $payload['activo']
            : (int) ($board->activo ?? 1);

        $config = [];
        if (!empty($board->config_json)) {
            $decoded = json_decode((string) $board->config_json, true);
            if (is_array($decoded)) {
                $config = $decoded;
            }
        }
        $config['builder'] = 'kanban_weekly';
        $config['layout'] = 'sun_to_sat_fixed';

        $board->nombre = $name;
        $board->descripcion = trim((string) ($payload['descripcion'] ?? $board->descripcion ?? '')) ?: null;
        $board->tipo = $type;
        $board->activo = $activo === 0 ? 0 : 1;
        $board->config_json = json_encode($config, JSON_UNESCAPED_UNICODE);
    }

    private function normalizeBlockPayload(array $payload, ?MallasHorarios $current): array
    {
        $type = strtoupper(trim((string) ($payload['type'] ?? $payload['tipo_bloque'] ?? ($current->tipo_bloque ?? MallasHorarios::TIPO_WORK))));
        $allowedTypes = [
            MallasHorarios::TIPO_WORK,
            MallasHorarios::TIPO_BREAK,
            MallasHorarios::TIPO_OFF,
        ];

        if (!in_array($type, $allowedTypes, true)) {
            throw new \DomainException('Tipo de bloque inválido para el tablero kanban.');
        }

        $day = (int) ($payload['day'] ?? $payload['dia_semana'] ?? ($current->dia_semana ?? 1));
        if ($day < 1 || $day > 7) {
            throw new \DomainException('El día del bloque es inválido.');
        }

        $defaultTimes = [
            MallasHorarios::TIPO_WORK => ['09:00', '17:00'],
            MallasHorarios::TIPO_BREAK => ['12:00', '13:00'],
            MallasHorarios::TIPO_OFF => ['00:00', '23:59'],
        ];

        if ($type === MallasHorarios::TIPO_OFF) {
            $start = $defaultTimes[$type][0];
            $end = $defaultTimes[$type][1];
        } else {
            $start = trim((string) ($payload['start'] ?? $payload['hora_inicio'] ?? ($current ? substr((string) $current->hora_inicio, 0, 5) : $defaultTimes[$type][0])));
            $end = trim((string) ($payload['end'] ?? $payload['hora_fin'] ?? ($current ? substr((string) $current->hora_fin, 0, 5) : $defaultTimes[$type][1])));
        }

        $break = (int) ($payload['break'] ?? $payload['minutos_descanso'] ?? ($current->minutos_descanso ?? 0));
        $order = array_key_exists('order', $payload)
            ? (int) $payload['order']
            : ($current ? (int) $current->orden : $this->nextBlockOrder((int) ($payload['malla_id'] ?? $current->malla_id ?? 0), $day));

        return [
            'day' => $day,
            'type' => $type,
            'start' => $start,
            'end' => $end,
            'break' => max(0, $break),
            'order' => max(0, $order),
        ];
    }

    private function fillBlockModel(MallasHorarios $model, int $mallaId, array $payload): void
    {
        $model->malla_id = $mallaId;
        $model->dia_semana = (int) $payload['day'];
        $model->tipo_bloque = $payload['type'];
        $model->hora_inicio = $payload['start'];
        $model->hora_fin = $payload['end'];
        $model->minutos_descanso = (int) $payload['break'];
        $model->orden = (int) $payload['order'];
    }

    private function findBoardForWrite(int $mallaId): Mallas
    {
        $board = Mallas::findOne(['id' => $mallaId]);
        if ($board === null) {
            throw new \DomainException('La malla solicitada no existe.');
        }

        $empresaId = $this->currentEmpresaId();
        if ($empresaId !== null && (int) $board->empresa_id !== (int) $empresaId) {
            throw new \DomainException('La malla no pertenece a la empresa actual.');
        }

        if ($this->isMallaAssigned((int) $board->id)) {
            throw new \DomainException('La malla ya está asignada y no se puede editar desde el tablero.');
        }

        return $board;
    }

    private function serializeBoard(Mallas $board): array
    {
        return [
            'id' => (int) $board->id,
            'nombre' => (string) $board->nombre,
            'descripcion' => (string) ($board->descripcion ?? ''),
            'tipo' => (string) $board->tipo,
            'activo' => (int) $board->activo,
            'estado' => (string) $board->estado_aprobacion,
            'estadoLabel' => (string) $board->displayEstadoAprobacion(),
            'viewUrl' => Url::to(['/mallas/view', 'id' => $board->id]),
            'editUrl' => Url::to(['/mallas/create-kanban', 'id' => $board->id]),
        ];
    }

    private function serializeBlocks(Mallas $board): array
    {
        $rows = MallasHorarios::find()
            ->where(['malla_id' => $board->id])
            ->orderBy(['dia_semana' => SORT_ASC, 'orden' => SORT_ASC, 'hora_inicio' => SORT_ASC, 'id' => SORT_ASC])
            ->all();

        return array_map(function (MallasHorarios $row) {
            return $this->serializeBlock($row);
        }, $rows);
    }

    private function serializeBlock(MallasHorarios $row): array
    {
        return [
            'id' => (int) $row->id,
            'malla_id' => (int) $row->malla_id,
            'day' => (int) $row->dia_semana,
            'type' => (string) $row->tipo_bloque,
            'start' => substr((string) $row->hora_inicio, 0, 5),
            'end' => substr((string) $row->hora_fin, 0, 5),
            'break' => (int) $row->minutos_descanso,
            'order' => (int) $row->orden,
        ];
    }

    private function buildBoardSummary(Mallas $board): array
    {
        $blocks = $this->serializeBlocks($board);
        $workMinutes = 0;
        $breakMinutes = 0;
        $configuredDays = [];
        $dayTotals = [];

        for ($day = 1; $day <= 7; $day++) {
            $dayTotals[$day] = ['minutes' => 0, 'label' => $this->formatMinutes(0)];
        }

        foreach ($blocks as $block) {
            $minutes = $this->computeDurationMinutes($block['start'], $block['end']);
            if ($block['type'] === MallasHorarios::TIPO_WORK) {
                $workMinutes += $minutes;
                $dayTotals[$block['day']]['minutes'] += $minutes;
                $configuredDays[$block['day']] = true;
            } elseif ($block['type'] === MallasHorarios::TIPO_BREAK) {
                $breakMinutes += $minutes;
            }
        }

        foreach ($dayTotals as $day => $data) {
            $dayTotals[$day]['label'] = $this->formatMinutes($data['minutes']);
        }

        $alerts = $this->detectOverlapIssues($blocks);

        return [
            'workMinutes' => $workMinutes,
            'workLabel' => $this->formatMinutes($workMinutes),
            'breakMinutes' => $breakMinutes,
            'breakLabel' => $this->formatMinutes($breakMinutes),
            'configuredDays' => count($configuredDays),
            'configuredLabel' => count($configuredDays) . '/7',
            'dayTotals' => $dayTotals,
            'alerts' => $alerts,
        ];
    }

    private function detectOverlapIssues(array $blocks): array
    {
        $segmentsByDay = [];

        foreach ($blocks as $idx => $item) {
            [$startMin, $endMin] = $this->normalizeTimePair((string) $item['start'], (string) $item['end']);
            if ($startMin === null || $endMin === null) {
                continue;
            }

            foreach ($this->expandSegmentsByMidnight((int) $item['day'], $startMin, $endMin) as $segment) {
                $segmentsByDay[$segment['day']][] = [
                    'start' => $segment['start'],
                    'end' => $segment['end'],
                    'idx' => $idx,
                ];
            }
        }

        $errors = [];
        foreach ($segmentsByDay as $day => $segments) {
            usort($segments, static function (array $a, array $b) {
                return $a['start'] <=> $b['start'];
            });

            for ($i = 1, $count = count($segments); $i < $count; $i++) {
                if ($segments[$i]['start'] < $segments[$i - 1]['end']) {
                    $errors[] = 'Hay solape de bloques en ' . $this->dayLabel($day) . '. Corrige antes de guardar.';
                    break;
                }
            }
        }

        return $errors;
    }

    private function normalizeTimePair(string $start, string $end): array
    {
        $startMin = $this->timeToMinutes($start);
        $endMin = $this->timeToMinutes($end);
        if ($startMin === null || $endMin === null || $startMin === $endMin) {
            return [null, null];
        }

        return [$startMin, $endMin];
    }

    private function timeToMinutes(string $value): ?int
    {
        if (!preg_match('/^(\d{2}):(\d{2})$/', $value, $matches)) {
            return null;
        }

        $hours = (int) $matches[1];
        $minutes = (int) $matches[2];
        if ($hours < 0 || $hours > 23 || $minutes < 0 || $minutes > 59) {
            return null;
        }

        return ($hours * 60) + $minutes;
    }

    private function expandSegmentsByMidnight(int $day, int $start, int $end): array
    {
        if ($end > $start) {
            return [['day' => $day, 'start' => $start, 'end' => $end]];
        }

        $nextDay = ($day % 7) + 1;

        return [
            ['day' => $day, 'start' => $start, 'end' => 1440],
            ['day' => $nextDay, 'start' => 0, 'end' => $end],
        ];
    }

    private function computeDurationMinutes(string $start, string $end): int
    {
        [$startMin, $endMin] = $this->normalizeTimePair($start, $end);
        if ($startMin === null || $endMin === null) {
            return 0;
        }

        return $endMin > $startMin
            ? $endMin - $startMin
            : (1440 - $startMin) + $endMin;
    }

    private function formatMinutes(int $minutes): string
    {
        $hours = intdiv(max(0, $minutes), 60);
        $mins = max(0, $minutes) % 60;

        return sprintf('%02dh %02dm', $hours, $mins);
    }

    private function dayLabel(int $day): string
    {
        $days = [
            1 => 'domingo',
            2 => 'lunes',
            3 => 'martes',
            4 => 'miércoles',
            5 => 'jueves',
            6 => 'viernes',
            7 => 'sábado',
        ];

        return $days[$day] ?? 'día ' . $day;
    }

    private function nextBlockOrder(int $mallaId, int $day): int
    {
        if ($mallaId <= 0) {
            return 0;
        }

        $maxOrder = MallasHorarios::find()
            ->where(['malla_id' => $mallaId, 'dia_semana' => $day])
            ->max('orden');

        return $maxOrder === null ? 0 : ((int) $maxOrder + 1);
    }

    private function currentEmpresaId(): ?int
    {
        return TenantContext::currentEmpresaId();
    }

    private function isMallaAssigned(int $mallaId): bool
    {
        $hasCargo = MallaCargoAsignacion::find()
            ->where([
                'malla_id' => $mallaId,
                'estado_aprobacion' => MallaCargoAsignacion::ESTADO_APROBADA,
                'activo' => 1,
            ])->exists();
        if ($hasCargo) {
            return true;
        }

        return MallaProfileAsignacion::find()
            ->where([
                'malla_id' => $mallaId,
                'estado_aprobacion' => MallaProfileAsignacion::ESTADO_APROBADA,
                'activo' => 1,
            ])->exists();
    }
}
