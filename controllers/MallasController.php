<?php

namespace app\controllers;

use app\models\MallaCargoAsignacion;
use app\models\MallaProfileAsignacion;
use app\models\Mallas;
use app\models\MallasHorarios;
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

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->empresa_id = $empresaId ?: $model->empresa_id;
            $saveAction = (string) $this->request->post('save_action', 'draft');
            $isPublish = $saveAction === 'publish';
            $model->estado_aprobacion = $isPublish ? Mallas::ESTADO_PENDIENTE : Mallas::ESTADO_DRAFT;
            $model->motivo_rechazo = null;
            $model->solicitado_por = $isPublish ? Yii::$app->user->id : null;
            $model->solicitado_at = $isPublish ? date('Y-m-d H:i:s') : null;
            $model->aprobado_por = null;
            $model->aprobado_at = null;

            $horariosPayload = $this->request->post('horarios_json', '[]');
            $horarios = $this->decodeHorariosPayload($horariosPayload, $model);
            $this->validateNoOverlaps($horarios, $model);

            $model->config_json = $this->buildConfigJsonFromPost($model->config_json);

            if (!$model->hasErrors() && $model->save()) {
                $this->persistHorarios($model->id, $horarios);
                Yii::$app->session->setFlash('success', $isPublish
                    ? 'Malla creada y enviada a aprobación RRHH.'
                    : 'Malla guardada en borrador.');
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

        if ($this->isMallaAssigned((int) $model->id)) {
            Yii::$app->session->setFlash('warning', 'La malla ya está asignada y no se puede editar.');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $saveAction = (string) $this->request->post('save_action', 'draft');
            $isPublish = $saveAction === 'publish';
            $model->estado_aprobacion = $isPublish ? Mallas::ESTADO_PENDIENTE : Mallas::ESTADO_DRAFT;
            $model->motivo_rechazo = null;
            $model->solicitado_por = $isPublish ? Yii::$app->user->id : null;
            $model->solicitado_at = $isPublish ? date('Y-m-d H:i:s') : null;
            $model->aprobado_por = null;
            $model->aprobado_at = null;
            $horariosPayload = $this->request->post('horarios_json', '[]');
            $horarios = $this->decodeHorariosPayload($horariosPayload, $model);
            $this->validateNoOverlaps($horarios, $model);
            $model->config_json = $this->buildConfigJsonFromPost($model->config_json);

            if (!$model->hasErrors() && $model->save()) {
                $this->persistHorarios($model->id, $horarios);
                Yii::$app->session->setFlash('success', $isPublish
                    ? 'Cambios guardados y enviados a aprobación RRHH.'
                    : 'Cambios guardados como borrador.');
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
        $model = $this->findModel($id);
        if ($this->isMallaAssigned((int) $model->id)) {
            Yii::$app->session->setFlash('warning', 'La malla ya está asignada y no se puede eliminar.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionApprove($id)
    {
        $model = $this->findModel($id);
        if ($model->estado_aprobacion === Mallas::ESTADO_DRAFT) {
            Yii::$app->session->setFlash('warning', 'Primero publica el borrador para enviarlo a aprobación.');
            return $this->redirect(['view', 'id' => $id]);
        }
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

    private function decodeHorariosPayload(string $payload, Mallas $model): array
    {
        $items = json_decode($payload, true);
        if (!is_array($items)) {
            $model->addError('config_json', 'El formato de bloques horarios es inválido.');
            return [];
        }
        $clean = [];
        foreach ($items as $idx => $item) {
            if (!is_array($item)) {
                continue;
            }
            $day = isset($item['day']) ? (int) $item['day'] : null;
            $type = strtoupper(trim((string) ($item['type'] ?? 'WORK')));
            $start = trim((string) ($item['start'] ?? ''));
            $end = trim((string) ($item['end'] ?? ''));
            $break = isset($item['break']) ? (int) $item['break'] : 0;
            if ($day < 1 || $day > 7 || $start === '' || $end === '') {
                $model->addError('config_json', 'Hay bloques incompletos en la programación semanal.');
                continue;
            }
            if (!array_key_exists($type, MallasHorarios::optsTipoBloque())) {
                $model->addError('config_json', "Tipo de bloque inválido en fila {$idx}.");
                continue;
            }
            $clean[] = [
                'day' => $day,
                'type' => $type,
                'start' => $start,
                'end' => $end,
                'break' => max(0, $break),
                'order' => isset($item['order']) ? (int) $item['order'] : $idx,
            ];
        }
        return $clean;
    }

    private function validateNoOverlaps(array $horarios, Mallas $model): void
    {
        $segmentsByDay = [];
        foreach ($horarios as $idx => $item) {
            [$startMin, $endMin] = $this->normalizeTimePair($item['start'], $item['end']);
            if ($startMin === null || $endMin === null) {
                $model->addError('config_json', "Hora inválida en bloque #{$idx}.");
                continue;
            }
            $segments = $this->expandSegmentsByMidnight((int) $item['day'], $startMin, $endMin);
            foreach ($segments as $segment) {
                $segmentsByDay[$segment['day']][] = [
                    'start' => $segment['start'],
                    'end' => $segment['end'],
                    'idx' => $idx,
                ];
            }
        }

        foreach ($segmentsByDay as $day => $segments) {
            usort($segments, function ($a, $b) {
                return $a['start'] <=> $b['start'];
            });
            for ($i = 1; $i < count($segments); $i++) {
                $prev = $segments[$i - 1];
                $curr = $segments[$i];
                if ($curr['start'] < $prev['end']) {
                    $model->addError('config_json', "Hay solape de bloques en día {$day}. Corrige antes de guardar/publicar.");
                    return;
                }
            }
        }
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
        if (!preg_match('/^(\d{2}):(\d{2})$/', $value, $m)) {
            return null;
        }
        $h = (int) $m[1];
        $i = (int) $m[2];
        if ($h < 0 || $h > 23 || $i < 0 || $i > 59) {
            return null;
        }
        return $h * 60 + $i;
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

    private function persistHorarios(int $mallaId, array $horarios): void
    {
        MallasHorarios::deleteAll(['malla_id' => $mallaId]);
        foreach ($horarios as $item) {
            $row = new MallasHorarios();
            $row->malla_id = $mallaId;
            $row->dia_semana = (int) $item['day'];
            $row->tipo_bloque = $item['type'];
            $row->orden = (int) $item['order'];
            $row->hora_inicio = $item['start'];
            $row->hora_fin = $item['end'];
            $row->minutos_descanso = (int) $item['break'];
            $row->save(false);
        }
    }

    private function buildConfigJsonFromPost(?string $existing): string
    {
        $config = [];
        if (!empty($existing)) {
            $decoded = json_decode($existing, true);
            if (is_array($decoded)) {
                $config = $decoded;
            }
        }

        $activeDays = array_values(array_unique(array_map('intval', (array) $this->request->post('dias_activos', []))));
        $activeDays = array_values(array_filter($activeDays, function ($d) {
            return $d >= 1 && $d <= 7;
        }));

        $config['week_range_ref'] = [
            'inicio' => (string) $this->request->post('week_range_inicio', ''),
            'fin' => (string) $this->request->post('week_range_fin', ''),
        ];
        $config['shift_template'] = (string) $this->request->post('shift_template', '');
        $config['dias_activos'] = $activeDays;
        $config['resumen_manual'] = [
            'trabajo_total' => (string) $this->request->post('resumen_trabajo_manual', ''),
            'descansos_total' => (string) $this->request->post('resumen_descanso_manual', ''),
        ];

        return json_encode($config, JSON_UNESCAPED_UNICODE);
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
