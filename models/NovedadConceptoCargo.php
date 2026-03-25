<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Cargo que puede usar un concepto de novedad (tabla `novedad_concepto_cargo`).
 *
 * @property int $novedad_concepto_id
 * @property int $cargo_id
 *
 * @property NovedadConcepto $novedadConcepto
 * @property Cargos $cargo
 */
class NovedadConceptoCargo extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_concepto_cargo';
    }

    public static function primaryKey(): array
    {
        return ['novedad_concepto_id', 'cargo_id'];
    }

    public function rules(): array
    {
        return [
            [['novedad_concepto_id', 'cargo_id'], 'required'],
            [['novedad_concepto_id', 'cargo_id'], 'integer'],
            [['novedad_concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadConcepto::class, 'targetAttribute' => ['novedad_concepto_id' => 'id']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargo_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'novedad_concepto_id' => Yii::t('app', 'Concepto'),
            'cargo_id' => Yii::t('app', 'Cargo'),
        ];
    }

    public function getNovedadConcepto(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadConcepto::class, ['id' => 'novedad_concepto_id']);
    }

    public function getCargo(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Cargos::class, ['id' => 'cargo_id']);
    }
}
