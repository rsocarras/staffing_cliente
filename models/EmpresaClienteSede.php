<?php

declare(strict_types=1);

namespace app\models;

use Yii;

/**
 * Pivote empresa_cliente ↔ location_sedes.
 *
 * @property int $id
 * @property int $empresa_cliente_id
 * @property int $location_sede_id
 * @property string $created_at
 *
 * @property EmpresaCliente $empresaCliente
 * @property LocationSedes $locationSede
 */
class EmpresaClienteSede extends \yii\db\ActiveRecord
{
    public static function tableName(): string
    {
        return 'empresa_cliente_sedes';
    }

    public function rules(): array
    {
        return [
            [['empresa_cliente_id', 'location_sede_id'], 'required'],
            [['empresa_cliente_id', 'location_sede_id'], 'integer'],
            [['created_at'], 'safe'],
            [
                ['empresa_cliente_id', 'location_sede_id'],
                'unique',
                'targetAttribute' => ['empresa_cliente_id', 'location_sede_id'],
            ],
            [
                ['empresa_cliente_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => EmpresaCliente::class,
                'targetAttribute' => ['empresa_cliente_id' => 'id'],
            ],
            [
                ['location_sede_id'],
                'exist',
                'skipOnError'     => true,
                'targetClass'     => LocationSedes::class,
                'targetAttribute' => ['location_sede_id' => 'id'],
            ],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id'                 => 'ID',
            'empresa_cliente_id' => Yii::t('app', 'Empresa cliente'),
            'location_sede_id'   => Yii::t('app', 'Sede'),
            'created_at'         => Yii::t('app', 'Creado'),
        ];
    }

    public function getEmpresaCliente(): \yii\db\ActiveQuery
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }

    public function getLocationSede(): \yii\db\ActiveQuery
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }
}
