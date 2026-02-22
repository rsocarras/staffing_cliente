<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mallas_horarios".
 *
 * @property int $id
 * @property int $malla_id
 * @property int $dia_semana
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property int $minutos_descanso
 *
 * @property Mallas $malla
 */
class MallasHorarios extends \yii\db\ActiveRecord
{


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
            [['minutos_descanso'], 'default', 'value' => 0],
            [['malla_id', 'dia_semana', 'hora_inicio', 'hora_fin'], 'required'],
            [['malla_id', 'dia_semana', 'minutos_descanso'], 'integer'],
            [['hora_inicio', 'hora_fin'], 'safe'],
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

}
