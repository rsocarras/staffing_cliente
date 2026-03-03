<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $codigo
 * @property string $nombre
 * @property string|null $descripcion
 * @property int $es_obligatorio
 * @property int $orden
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ChecklistStatus[] $checklistStatuses
 */
class ChecklistItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'checklist_item';
    }

    public function rules()
    {
        return [
            [['codigo', 'nombre'], 'required'],
            [['descripcion'], 'string'],
            [['es_obligatorio', 'orden', 'is_active'], 'integer'],
            [['codigo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['codigo'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'codigo' => 'Código',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'es_obligatorio' => 'Obligatorio',
            'orden' => 'Orden',
        ];
    }

    public function getChecklistStatuses()
    {
        return $this->hasMany(ChecklistStatus::class, ['checklist_item_id' => 'id']);
    }

    public static function getObligatorios()
    {
        return static::find()->where(['es_obligatorio' => 1, 'is_active' => 1])->orderBy('orden')->all();
    }
}
