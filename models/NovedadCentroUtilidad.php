<?php

namespace app\models;

use app\components\TenantContext;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int $area_id
 * @property int|null $empresa_cliente_id
 * @property string $codigo
 * @property string $nombre
 * @property int $activo
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Area $area
 * @property EmpresaCliente|null $empresaCliente
 */
class NovedadCentroUtilidad extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'novedad_centro_utilidad';
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
            [['area_id', 'codigo', 'nombre', 'empresa_cliente_id'], 'required'],
            [['area_id', 'activo', 'empresa_cliente_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['codigo'], 'string', 'max' => 50],
            [['nombre'], 'string', 'max' => 190],
            [['area_id'], 'unique'],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_id' => 'id']],
            [['empresa_cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_cliente_id' => 'id']],
            [['empresa_cliente_id'], 'validateEmpresaClienteTenant'],
            [['area_id', 'empresa_cliente_id'], 'validateAreaEmpresaCliente'],
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

    public function validateAreaEmpresaCliente(string $attribute, ?array $params = null): void
    {
        if ((int) $this->area_id <= 0 || (int) $this->empresa_cliente_id <= 0) {
            return;
        }
        $ec = EmpresaCliente::findOne((int) $this->empresa_cliente_id);
        $area = Area::findOne((int) $this->area_id);
        if ($ec === null || $area === null) {
            return;
        }
        if ((int) $ec->empresas_id !== (int) $area->empresas_id) {
            $this->addError('empresa_cliente_id', Yii::t('app', 'El área debe pertenecer a la misma organización que la empresa cliente.'));
        }
    }

    public function attributeLabels(): array
    {
        return [
            'area_id' => Yii::t('app', 'Área'),
            'empresa_cliente_id' => Yii::t('app', 'Empresa cliente'),
            'codigo' => Yii::t('app', 'Código'),
            'nombre' => Yii::t('app', 'Nombre'),
            'activo' => Yii::t('app', 'Activo'),
        ];
    }

    public function getArea(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Area::class, ['id' => 'area_id']);
    }

    public function getEmpresaCliente(): \yii\db\ActiveQuery
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }
}
