<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $location_sede_id
 * @property int $location_sede_category_id
 * @property float|null $valor_hora_diurna
 * @property float|null $valor_hora_diurna_domingo_festivos
 * @property float|null $valor_hora_nocturna
 * @property float|null $valor_hora_nocturna_domingo_festiva
 * @property float|null $valor_movilizacion
 * @property float|null $valor_hora_especial
 * @property string $created_at
 *
 * @property LocationSedes $locationSede
 * @property LocationSedesCategory $locationSedeCategory
 */
class LocationSedeCategory extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'location_sede_category';
    }

    public function getLocationSede(): \yii\db\ActiveQuery
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }

    public function getLocationSedeCategory(): \yii\db\ActiveQuery
    {
        return $this->hasOne(LocationSedesCategory::class, ['id' => 'location_sede_category_id']);
    }
}
