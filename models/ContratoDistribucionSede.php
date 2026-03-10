<?php

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "contrato_distribucion_sede".
 *
 * @property int $id
 * @property int $contrato_id
 * @property int $sede_id
 * @property float $porcentaje
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Contrato $contrato
 * @property LocationSedes $sede
 * @property User $createdBy
 * @property User $updatedBy
 */
class ContratoDistribucionSede extends ActiveRecord
{
    public static function tableName()
    {
        return 'contrato_distribucion_sede';
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
            [['created_by', 'updated_by'], 'default', 'value' => null],
            [['contrato_id', 'sede_id', 'porcentaje'], 'required'],
            [['contrato_id', 'sede_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['porcentaje'], 'number', 'min' => 0.01, 'max' => 100],
            [['contrato_id', 'sede_id'], 'unique', 'targetAttribute' => ['contrato_id', 'sede_id']],
            [['sede_id'], 'validateSedeTenant'],
            [['porcentaje'], 'validateAccumulatedPercentage'],
            [['contrato_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contrato::class, 'targetAttribute' => ['contrato_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['sede_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contrato_id' => 'Contrato',
            'sede_id' => 'Sede',
            'porcentaje' => 'Porcentaje',
            'created_at' => 'Creado el',
            'updated_at' => 'Actualizado el',
        ];
    }

    public function validateSedeTenant($attribute)
    {
        if (empty($this->contrato_id) || empty($this->sede_id)) {
            return;
        }

        $contrato = $this->contrato ?: Contrato::findOne($this->contrato_id);
        $sede = $this->sede ?: LocationSedes::findOne($this->sede_id);

        if ($contrato !== null && $sede !== null && (int) $contrato->empresa_id !== (int) $sede->empresa_id) {
            $this->addError($attribute, 'La sede distribuida debe pertenecer a la misma empresa del contrato.');
        }
    }

    public function validateAccumulatedPercentage($attribute)
    {
        if (empty($this->contrato_id) || !is_numeric($this->porcentaje)) {
            return;
        }

        $current = static::find()->where(['contrato_id' => $this->contrato_id]);
        if (!$this->isNewRecord) {
            $current->andWhere(['<>', 'id', $this->id]);
        }

        $accumulated = (float) $current->sum('porcentaje');
        $nextTotal = $accumulated + (float) $this->porcentaje;

        if ($nextTotal > 100.0001) {
            $this->addError($attribute, 'La suma de porcentajes no puede superar 100.');
        }
    }

    public static function totalPercentage($contratoId)
    {
        return (float) static::find()->where(['contrato_id' => $contratoId])->sum('porcentaje');
    }

    public static function hasCompleteDistribution($contratoId)
    {
        $total = static::totalPercentage($contratoId);

        return $total > 0 && abs($total - 100) < 0.01;
    }

    public function getContrato()
    {
        return $this->hasOne(Contrato::class, ['id' => 'contrato_id']);
    }

    public function getSede()
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'sede_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
