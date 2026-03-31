<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Presupuesto de horas por sede y vigencia.
 *
 * @property int $id
 * @property int $empresa_id
 * @property int|null $empresa_cliente_id
 * @property int $location_sede_id
 * @property string $nombre
 * @property string $fecha_inicio_vigencia
 * @property string $fecha_fin_vigencia
 * @property string $estado
 * @property int $version
 * @property string|null $observacion
 * @property int|null $aprobado_por
 * @property string|null $aprobado_at
 * @property int|null $rechazado_por
 * @property string|null $rechazado_at
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $activo
 *
 * @property Empresas $empresa
 * @property EmpresaCliente|null $empresaCliente
 * @property LocationSedes $locationSede
 * @property User|null $aprobadoPor
 * @property User|null $rechazadoPor
 * @property User|null $createdBy
 * @property User|null $updatedBy
 * @property PresupuestoConcepto[] $presupuestoConceptos
 * @property PresupuestoHistorial[] $historiales
 */
class Presupuesto extends ActiveRecord
{
    public const ESTADO_BORRADOR = 'borrador';
    public const ESTADO_PENDIENTE_APROBACION = 'pendiente_aprobacion';
    public const ESTADO_APROBADO = 'aprobado';
    public const ESTADO_RECHAZADO = 'rechazado';
    public const ESTADO_INACTIVO = 'inactivo';

    public static function tableName()
    {
        return 'presupuesto';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['empresa_cliente_id', 'observacion', 'aprobado_por', 'aprobado_at', 'rechazado_por', 'rechazado_at'], 'default', 'value' => null],
            [['activo'], 'default', 'value' => 1],
            [['version'], 'default', 'value' => 1],
            [['estado'], 'default', 'value' => self::ESTADO_BORRADOR],
            [['empresa_id', 'location_sede_id', 'nombre', 'fecha_inicio_vigencia', 'fecha_fin_vigencia'], 'required'],
            [['empresa_id', 'empresa_cliente_id', 'version', 'activo', 'aprobado_por', 'rechazado_por', 'created_by', 'updated_by'], 'integer'],
            [['location_sede_id'], 'integer', 'min' => 1],
            [['fecha_inicio_vigencia', 'fecha_fin_vigencia', 'created_at', 'updated_at', 'aprobado_at', 'rechazado_at'], 'safe'],
            [['observacion'], 'string'],
            [['nombre'], 'string', 'max' => 190],
            [['estado'], 'string', 'max' => 32],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['empresa_cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_cliente_id' => 'id']],
            [['location_sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['location_sede_id' => 'id']],
            [['aprobado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['aprobado_por' => 'id']],
            [['rechazado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['rechazado_por' => 'id']],
            [['fecha_inicio_vigencia', 'fecha_fin_vigencia'], 'validateVigencia'],
        ];
    }

    public function validateVigencia($attribute, $params): void
    {
        if (empty($this->fecha_inicio_vigencia) || empty($this->fecha_fin_vigencia)) {
            return;
        }
        $ini = strtotime($this->fecha_inicio_vigencia);
        $fin = strtotime($this->fecha_fin_vigencia);
        if ($ini === false || $fin === false || $fin < $ini) {
            $this->addError('fecha_fin_vigencia', 'La fecha fin de vigencia debe ser mayor o igual a la fecha inicio.');
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa',
            'empresa_cliente_id' => 'Cliente empresa',
            'location_sede_id' => 'Sede',
            'nombre' => 'Nombre',
            'fecha_inicio_vigencia' => 'Inicio vigencia',
            'fecha_fin_vigencia' => 'Fin vigencia',
            'estado' => 'Estado',
            'version' => 'Versión',
            'observacion' => 'Observaciones',
            'aprobado_por' => 'Aprobado por',
            'aprobado_at' => 'Fecha aprobación',
            'rechazado_por' => 'Rechazado por',
            'rechazado_at' => 'Fecha rechazo',
            'activo' => 'Activo',
            'created_at' => 'Creado el',
            'updated_at' => 'Actualizado el',
            'created_by' => 'Creado por',
            'updated_by' => 'Actualizado por',
        ];
    }

    public static function optsEstado(): array
    {
        return [
            self::ESTADO_BORRADOR => 'Borrador',
            self::ESTADO_PENDIENTE_APROBACION => 'Pendiente aprobación',
            self::ESTADO_APROBADO => 'Aprobado',
            self::ESTADO_RECHAZADO => 'Rechazado',
            self::ESTADO_INACTIVO => 'Inactivo',
        ];
    }

    public function getEstadoLabel(): string
    {
        return self::optsEstado()[$this->estado] ?? $this->estado;
    }

    /**
     * Clase Bootstrap (variante badge-soft-*) según estado del presupuesto.
     */
    public function getEstadoBadgeSoftClass(): string
    {
        switch ($this->estado) {
            case self::ESTADO_APROBADO:
                return 'success';
            case self::ESTADO_RECHAZADO:
                return 'danger';
            case self::ESTADO_PENDIENTE_APROBACION:
                return 'warning';
            case self::ESTADO_BORRADOR:
                return 'info';
            case self::ESTADO_INACTIVO:
                return 'dark';
            default:
                return 'secondary';
        }
    }

    public function isEditable(): bool
    {
        return $this->activo
            && ($this->estado === self::ESTADO_BORRADOR || $this->estado === self::ESTADO_RECHAZADO);
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    public function getEmpresaCliente()
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }

    public function getLocationSede()
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'location_sede_id']);
    }

    public function getAprobadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'aprobado_por']);
    }

    public function getRechazadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'rechazado_por']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getPresupuestoConceptos()
    {
        return $this->hasMany(PresupuestoConcepto::class, ['presupuesto_id' => 'id'])
            ->andWhere(['presupuesto_concepto.activo' => 1])
            ->orderBy(['presupuesto_concepto.id' => SORT_ASC]);
    }

    public function getHistoriales()
    {
        return $this->hasMany(PresupuestoHistorial::class, ['presupuesto_id' => 'id'])
            ->orderBy([
                'presupuesto_historial.created_at' => SORT_DESC,
                'presupuesto_historial.id' => SORT_DESC,
            ]);
    }
}
