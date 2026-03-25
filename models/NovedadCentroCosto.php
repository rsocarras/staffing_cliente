<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $location_sede_id
 * @property string $codigo
 * @property string $nombre
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property LocationSedes $locationSede
 */
class NovedadCentroCosto extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_centro_costo';
    }

    public function rules(): array
    {
        return [
            [['location_sede_id', 'codigo', 'nombre'], 'required'],
            [['location_sede_id', 'activo'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['location_sede_id'], 'unique'],
        ];
    }

    public function getLocationSede(): \yii\db\ActiveQuery
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }
}
