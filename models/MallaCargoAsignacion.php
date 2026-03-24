<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "malla_cargo_asignacion".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $malla_id
 * @property int $cargo_id
 * @property string $estado_aprobacion
 * @property string|null $motivo_rechazo
 * @property int|null $solicitado_por
 * @property int|null $aprobado_por
 * @property string $solicitado_at
 * @property string|null $aprobado_at
 * @property int $activo
 *
 * @property Cargos $cargo
 * @property Mallas $malla
 * @property Empresas $empresa
 * @property User $solicitadoPor
 * @property User $aprobadoPor
 */
class MallaCargoAsignacion extends ActiveRecord
{
    const ESTADO_PENDIENTE = 'pendiente_aprobacion';
    const ESTADO_APROBADA = 'aprobada';
    const ESTADO_RECHAZADA = 'rechazada';

    public static function tableName()
    {
        return 'malla_cargo_asignacion';
    }

    public function rules()
    {
        return [
            [['motivo_rechazo', 'solicitado_por', 'aprobado_por', 'aprobado_at'], 'default', 'value' => null],
            [['estado_aprobacion'], 'default', 'value' => self::ESTADO_PENDIENTE],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'malla_id', 'cargo_id'], 'required'],
            [['empresa_id', 'malla_id', 'cargo_id', 'solicitado_por', 'aprobado_por', 'activo'], 'integer'],
            [['solicitado_at', 'aprobado_at'], 'safe'],
            [['estado_aprobacion'], 'string', 'max' => 32],
            [['motivo_rechazo'], 'string', 'max' => 255],
            [['empresa_id', 'malla_id', 'cargo_id'], 'unique', 'targetAttribute' => ['empresa_id', 'malla_id', 'cargo_id']],
            [['estado_aprobacion'], 'in', 'range' => array_keys(self::optsEstadoAprobacion())],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['malla_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mallas::class, 'targetAttribute' => ['malla_id' => 'id']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargo_id' => 'id']],
            [['solicitado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['solicitado_por' => 'id']],
            [['aprobado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['aprobado_por' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa',
            'malla_id' => 'Malla',
            'cargo_id' => 'Cargo',
            'estado_aprobacion' => 'Estado aprobación',
            'motivo_rechazo' => 'Motivo rechazo',
            'solicitado_por' => 'Solicitado por',
            'aprobado_por' => 'Aprobado por',
            'solicitado_at' => 'Solicitado el',
            'aprobado_at' => 'Aprobado el',
            'activo' => 'Activo',
        ];
    }

    public static function optsEstadoAprobacion()
    {
        return [
            self::ESTADO_PENDIENTE => 'Pendiente aprobación',
            self::ESTADO_APROBADA => 'Aprobada',
            self::ESTADO_RECHAZADA => 'Rechazada',
        ];
    }

    public function displayEstadoAprobacion()
    {
        $items = self::optsEstadoAprobacion();
        return $items[$this->estado_aprobacion] ?? $this->estado_aprobacion;
    }

    /**
     * Clase Bootstrap (variante badge-soft-*) según estado de aprobación.
     */
    public static function estadoAprobacionBadgeSoftClass(string $estado): string
    {
        switch ($estado) {
            case self::ESTADO_APROBADA:
                return 'success';
            case self::ESTADO_RECHAZADA:
                return 'danger';
            case self::ESTADO_PENDIENTE:
            default:
                return 'warning';
        }
    }

    public function getCargo()
    {
        return $this->hasOne(Cargos::class, ['id' => 'cargo_id']);
    }

    public function getMalla()
    {
        return $this->hasOne(Mallas::class, ['id' => 'malla_id']);
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    public function getSolicitadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'solicitado_por']);
    }

    public function getAprobadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'aprobado_por']);
    }
}
