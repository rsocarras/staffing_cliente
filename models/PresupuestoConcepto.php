<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Pivote presupuesto ↔ concepto de novedad.
 *
 * @property int $id
 * @property int $presupuesto_id
 * @property int $novedad_concepto_id
 * @property string|null $observacion
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $activo
 *
 * @property Presupuesto $presupuesto
 * @property NovedadConcepto $novedadConcepto
 * @property PresupuestoConceptoDia[] $dias
 */
class PresupuestoConcepto extends ActiveRecord
{
    public static function tableName()
    {
        return 'presupuesto_concepto';
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
            [['observacion'], 'default', 'value' => null],
            [['activo'], 'default', 'value' => 1],
            [['presupuesto_id', 'novedad_concepto_id'], 'required'],
            [['presupuesto_id', 'novedad_concepto_id', 'activo', 'created_by', 'updated_by'], 'integer'],
            [['observacion'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['presupuesto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Presupuesto::class, 'targetAttribute' => ['presupuesto_id' => 'id']],
            [['novedad_concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadConcepto::class, 'targetAttribute' => ['novedad_concepto_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'novedad_concepto_id' => 'Concepto',
            'observacion' => 'Observación',
        ];
    }

    public function getPresupuesto()
    {
        return $this->hasOne(Presupuesto::class, ['id' => 'presupuesto_id']);
    }

    public function getNovedadConcepto()
    {
        return $this->hasOne(NovedadConcepto::class, ['id' => 'novedad_concepto_id']);
    }

    public function getDias()
    {
        return $this->hasMany(PresupuestoConceptoDia::class, ['presupuesto_concepto_id' => 'id'])
            ->andWhere(['presupuesto_concepto_dia.activo' => 1])
            ->orderBy(['presupuesto_concepto_dia.dia_semana' => SORT_ASC]);
    }
}
