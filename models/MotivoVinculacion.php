<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Requisicion[] $requisiciones
 */
class MotivoVinculacion extends ActiveRecord
{
    public static function tableName()
    {
        return 'motivo_vinculacion';
    }

    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
            [['is_active'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'is_active' => 'Activo',
        ];
    }

    public function getRequisiciones()
    {
        return $this->hasMany(Requisicion::class, ['motivo_vinculacion_id' => 'id']);
    }

    public static function getActivos()
    {
        return static::find()->where(['is_active' => 1])->orderBy('nombre')->all();
    }
}
