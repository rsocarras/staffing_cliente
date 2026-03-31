<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $novedad_id
 * @property string $horas
 * @property string $fecha_acusacion
 * @property string|null $observacion
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Novedad $novedad
 */
class NovedadHorasDetalle extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_horas_detalle';
    }

    public function rules(): array
    {
        return [
            [['observacion'], 'default', 'value' => null],
            [['novedad_id', 'horas', 'fecha_acusacion'], 'required'],
            [['novedad_id'], 'integer'],
            [['horas'], 'number'],
            [['fecha_acusacion'], 'date', 'format' => 'php:Y-m-d'],
            [['observacion'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['novedad_id'], 'exist', 'skipOnError' => true, 'targetClass' => Novedad::class, 'targetAttribute' => ['novedad_id' => 'id']],
        ];
    }

    public function getNovedad(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Novedad::class, ['id' => 'novedad_id']);
    }
}
