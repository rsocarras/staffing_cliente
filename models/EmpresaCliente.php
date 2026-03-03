<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Empresa cliente/solicitante (con NIT) para requisiciones
 *
 * @property int $id
 * @property string $nit
 * @property string $nombre
 * @property int $is_active
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Requisicion[] $requisiciones
 */
class EmpresaCliente extends ActiveRecord
{
    public static function tableName()
    {
        return 'empresa_cliente';
    }

    public function rules()
    {
        return [
            [['nit', 'nombre'], 'required'],
            [['nit'], 'unique'],
            [['nit'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 190],
            [['is_active'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nit' => 'NIT',
            'nombre' => 'Nombre',
            'is_active' => 'Activo',
        ];
    }

    public function getRequisiciones()
    {
        return $this->hasMany(Requisicion::class, ['empresa_id' => 'id']);
    }

    public static function getActivos()
    {
        return static::find()->where(['is_active' => 1])->orderBy('nombre')->all();
    }
}
