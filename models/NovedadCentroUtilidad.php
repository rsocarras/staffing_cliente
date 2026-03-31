<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $area_id
 * @property string $codigo
 * @property string $nombre
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Area $area
 */
class NovedadCentroUtilidad extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_centro_utilidad';
    }

    public function rules(): array
    {
        return [
            [['area_id', 'codigo', 'nombre'], 'required'],
            [['area_id', 'activo'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['area_id'], 'unique'],
        ];
    }

    public function getArea(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Area::class, ['id' => 'area_id']);
    }
}
