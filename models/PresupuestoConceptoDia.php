<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Horas máximas por día (ISO: 1=lunes … 7=domingo) para un presupuesto_concepto.
 *
 * @property int $id
 * @property int $presupuesto_concepto_id
 * @property int $dia_semana
 * @property string $horas_maximas
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $activo
 *
 * @property PresupuestoConcepto $presupuestoConcepto
 */
class PresupuestoConceptoDia extends ActiveRecord
{
    public const DIA_LUNES = 1;
    public const DIA_DOMINGO = 7;

    public static function tableName()
    {
        return 'presupuesto_concepto_dia';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['activo'], 'default', 'value' => 1],
            [['horas_maximas'], 'default', 'value' => 0],
            [['presupuesto_concepto_id', 'dia_semana', 'horas_maximas'], 'required'],
            [['presupuesto_concepto_id', 'dia_semana', 'activo', 'created_by', 'updated_by'], 'integer'],
            [['horas_maximas'], 'number', 'min' => 0, 'max' => 24],
            [['created_at', 'updated_at'], 'safe'],
            ['dia_semana', 'integer', 'min' => self::DIA_LUNES, 'max' => self::DIA_DOMINGO],
            [['presupuesto_concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => PresupuestoConcepto::class, 'targetAttribute' => ['presupuesto_concepto_id' => 'id']],
        ];
    }

    public static function optsDiaSemana(): array
    {
        return [
            1 => 'Lun',
            2 => 'Mar',
            3 => 'Mié',
            4 => 'Jue',
            5 => 'Vie',
            6 => 'Sáb',
            7 => 'Dom',
        ];
    }

    public function attributeLabels()
    {
        return [
            'dia_semana' => 'Día',
            'horas_maximas' => 'Horas máx.',
        ];
    }

    public function getPresupuestoConcepto()
    {
        return $this->hasOne(PresupuestoConcepto::class, ['id' => 'presupuesto_concepto_id']);
    }
}
