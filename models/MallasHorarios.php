<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mallas_horarios".
 *
 * @property int $id
 * @property int $malla_id
 * @property int $dia_semana
 * @property string $tipo_bloque
 * @property int $orden
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property int $minutos_descanso
 *
 * @property Mallas $malla
 */
class MallasHorarios extends \yii\db\ActiveRecord
{
    const TIPO_WORK = 'WORK';
    const TIPO_BREAK = 'BREAK';
    const TIPO_OFF = 'OFF';
    const TIPO_MEAL = 'MEAL';
    const TIPO_TRAINING = 'TRAINING';
    const TIPO_MEETING = 'MEETING';
    const TIPO_OVERTIME = 'OVERTIME';
    const TIPO_ON_CALL = 'ON_CALL';


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mallas_horarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['minutos_descanso', 'orden'], 'default', 'value' => 0],
            [['tipo_bloque'], 'default', 'value' => self::TIPO_WORK],
            [['malla_id', 'dia_semana', 'hora_inicio', 'hora_fin'], 'required'],
            [['malla_id', 'dia_semana', 'minutos_descanso', 'orden'], 'integer'],
            [['hora_inicio', 'hora_fin'], 'safe'],
            [['tipo_bloque'], 'string', 'max' => 20],
            [['dia_semana'], 'integer', 'min' => 1, 'max' => 7],
            [['hora_fin'], 'validateRangoHorario'],
            [['tipo_bloque'], 'in', 'range' => array_keys(self::optsTipoBloque())],
            [['malla_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mallas::class, 'targetAttribute' => ['malla_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'malla_id' => 'Malla ID',
            'dia_semana' => 'Dia Semana',
            'tipo_bloque' => 'Tipo Bloque',
            'orden' => 'Orden',
            'hora_inicio' => 'Hora Inicio',
            'hora_fin' => 'Hora Fin',
            'minutos_descanso' => 'Minutos Descanso',
        ];
    }

    /**
     * Gets query for [[Malla]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMalla()
    {
        return $this->hasOne(Mallas::class, ['id' => 'malla_id']);
    }

    public function validateRangoHorario($attribute)
    {
        if (empty($this->hora_inicio) || empty($this->hora_fin)) {
            return;
        }

        if ($this->hora_inicio === $this->hora_fin) {
            $this->addError($attribute, 'La hora fin no puede ser igual a la hora inicio.');
        }
    }

    public static function optsTipoBloque()
    {
        return [
            self::TIPO_WORK => 'WORK',
            self::TIPO_BREAK => 'BREAK',
            self::TIPO_OFF => 'OFF',
            self::TIPO_MEAL => 'MEAL',
            self::TIPO_TRAINING => 'TRAINING',
            self::TIPO_MEETING => 'MEETING',
            self::TIPO_OVERTIME => 'OVERTIME',
            self::TIPO_ON_CALL => 'ON_CALL',
        ];
    }

}
