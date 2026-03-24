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
 * @property int|null $empresas_id Tenant al que pertenece el cliente
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
            [['empresas_id'], 'default', 'value' => null],
            [['nit'], 'unique'],
            [['nit'], 'string', 'max' => 20],
            [['nombre'], 'string', 'max' => 190],
            [['is_active', 'empresas_id'], 'integer'],
            [['empresas_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresas_id' => 'id']],
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
        return $this->hasMany(Requisicion::class, ['empresa_cliente_id' => 'id']);
    }

    public static function getActivos(?int $empresasId = null)
    {
        $query = static::find()->where(['is_active' => 1]);
        if ($empresasId !== null && $empresasId > 0) {
            $query->andWhere(['empresas_id' => $empresasId]);
        }
        return $query->orderBy('nombre')->all();
    }
}
