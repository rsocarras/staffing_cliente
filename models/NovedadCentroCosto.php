<?php

namespace app\models;

use app\components\TenantContext;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $location_sede_id
 * @property int|null $empresa_cliente_id
 * @property string $codigo
 * @property string $nombre
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property LocationSedes $locationSede
 * @property EmpresaCliente|null $empresaCliente
 */
class NovedadCentroCosto extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_centro_costo';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => static fn () => date('Y-m-d H:i:s'),
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [['location_sede_id', 'codigo', 'nombre', 'empresa_cliente_id'], 'required'],
            [['location_sede_id', 'activo', 'empresa_cliente_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['location_sede_id'], 'unique'],
            [['location_sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['location_sede_id' => 'id']],
            [['empresa_cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_cliente_id' => 'id']],
            [['empresa_cliente_id'], 'validateEmpresaClienteTenant'],
            [['location_sede_id', 'empresa_cliente_id'], 'validateSedeEmpresaClientePivot'],
        ];
    }

    public function validateEmpresaClienteTenant(string $attribute, ?array $params = null): void
    {
        $tenantEid = TenantContext::currentEmpresaId();
        if ($tenantEid === null || $this->empresa_cliente_id === null || $this->empresa_cliente_id === '') {
            return;
        }
        $ec = EmpresaCliente::findOne((int) $this->empresa_cliente_id);
        if ($ec === null) {
            return;
        }
        if ((int) $ec->empresas_id !== (int) $tenantEid) {
            $this->addError($attribute, Yii::t('app', 'La empresa cliente no pertenece a su organización.'));
        }
    }

    public function validateSedeEmpresaClientePivot(string $attribute, ?array $params = null): void
    {
        if ((int) $this->location_sede_id <= 0 || (int) $this->empresa_cliente_id <= 0) {
            return;
        }
        $ec = EmpresaCliente::findOne((int) $this->empresa_cliente_id);
        $sede = LocationSedes::findOne((int) $this->location_sede_id);
        if ($ec === null || $sede === null) {
            return;
        }
        if ((int) $ec->empresas_id !== (int) $sede->empresa_id) {
            $this->addError('empresa_cliente_id', Yii::t('app', 'La sede y la empresa cliente deben pertenecer a la misma organización.'));

            return;
        }
        $ok = EmpresaClienteSede::find()
            ->where([
                'empresa_cliente_id' => (int) $this->empresa_cliente_id,
                'location_sede_id' => (int) $this->location_sede_id,
            ])
            ->exists();
        if (!$ok) {
            $this->addError('location_sede_id', Yii::t('app', 'La sede no está asignada a la empresa cliente seleccionada.'));
        }
    }

    public function attributeLabels(): array
    {
        return [
            'location_sede_id' => Yii::t('app', 'Sede'),
            'empresa_cliente_id' => Yii::t('app', 'Empresa cliente'),
            'codigo' => Yii::t('app', 'Código'),
            'nombre' => Yii::t('app', 'Nombre'),
            'activo' => Yii::t('app', 'Activo'),
        ];
    }

    public function getLocationSede(): \yii\db\ActiveQuery
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }

    public function getEmpresaCliente(): \yii\db\ActiveQuery
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }
}
