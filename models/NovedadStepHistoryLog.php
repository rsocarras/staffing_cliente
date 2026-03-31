<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $novedad_flujo_id
 * @property int|null $novedad_step_id
 * @property int|null $novedad_step_id_desde
 * @property int|null $novedad_step_id_hacia
 * @property string $tipo_movimiento
 * @property string|null $motivo
 * @property int|null $profile_id user_id del perfil (misma convención que novedad_step.profile_id)
 * @property int $created_at
 *
 * @property NovedadFlujo $novedadFlujo
 */
class NovedadStepHistoryLog extends ActiveRecord
{
    /** Kanban: avance a un paso posterior (mismo orden o mayor). */
    public const TIPO_KANBAN_AVANCE = 'kanban_avance';

    /** Kanban: retroceso a un paso anterior (requiere motivo). */
    public const TIPO_KANBAN_RETRO = 'kanban_retro';

    public const TIPO_STEP_CREATE = 'step_create';

    public const TIPO_STEP_UPDATE = 'step_update';

    public const TIPO_STEP_DELETE = 'step_delete';

    public const TIPO_STEP_REORDER = 'step_reorder';

    public static function tableName()
    {
        return 'novedad_step_history_log';
    }

    /**
     * @return bool
     */
    public static function record(
        int $novedadFlujoId,
        string $tipoMovimiento,
        ?int $novedadStepId = null,
        ?int $stepIdDesde = null,
        ?int $stepIdHacia = null,
        ?string $motivo = null,
        ?int $actorUserId = null
    ) {
        $row = new static();
        $row->novedad_flujo_id = $novedadFlujoId;
        $row->tipo_movimiento = $tipoMovimiento;
        $row->novedad_step_id = $novedadStepId;
        $row->novedad_step_id_desde = $stepIdDesde;
        $row->novedad_step_id_hacia = $stepIdHacia;
        $row->motivo = $motivo !== null && $motivo !== '' ? $motivo : null;
        $row->profile_id = $actorUserId;
        $row->created_at = time();

        return $row->save(false);
    }

    public function rules()
    {
        return [
            [['novedad_flujo_id', 'tipo_movimiento', 'created_at'], 'required'],
            [['novedad_flujo_id', 'novedad_step_id', 'novedad_step_id_desde', 'novedad_step_id_hacia', 'profile_id', 'created_at'], 'integer'],
            [['motivo'], 'string'],
            [['tipo_movimiento'], 'string', 'max' => 20],
            [['motivo', 'novedad_step_id', 'novedad_step_id_desde', 'novedad_step_id_hacia', 'profile_id'], 'default', 'value' => null],
            [
                ['novedad_flujo_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => NovedadFlujo::class,
                'targetAttribute' => ['novedad_flujo_id' => 'id'],
            ],
        ];
    }

    public function getNovedadFlujo()
    {
        return $this->hasOne(NovedadFlujo::class, ['id' => 'novedad_flujo_id']);
    }
}
