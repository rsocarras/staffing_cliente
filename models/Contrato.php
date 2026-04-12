<?php

namespace app\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "contrato".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $profile_id
 * @property int $contrato_tipo_id
 * @property int $area_id
 * @property int|null $sub_area_id
 * @property int $cargo_id
 * @property int|null $sede_id
 * @property string $estado
 * @property string $fecha_inicio
 * @property string|null $fecha_fin
 * @property string $created_at
 * @property string $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $requisicion_id
 * @property int|null $motivo_vinculacion_id
 * @property int|null $empresa_cliente_id
 * @property int|null $ciudad_id
 * @property float|string|null $jornada
 * @property float|string|null $salario
 * @property float|string|null $auxilio
 * @property int|null $esquema_variable_id
 * @property string|null $tipo_contrato
 *
 * @property Area $area
 * @property Cargos $cargo
 * @property City|null $ciudad
 * @property ContratoTipos $contratoTipo
 * @property ContratoDistribucionSede[] $contratoDistribucionSedes
 * @property EmpresaCliente|null $empresaCliente
 * @property Empresas $empresa
 * @property EsquemaVariable|null $esquemaVariable
 * @property LocationSedes|null $sede
 * @property MotivoVinculacion|null $motivoVinculacion
 * @property Profile $profile
 * @property Requisicion|null $requisicion
 * @property Area|null $subArea
 * @property User|null $createdBy
 * @property User|null $updatedBy
 */
class Contrato extends ActiveRecord
{
    const ESTADO_ACTIVO = 'activo';
    const ESTADO_INACTIVO = 'inactivo';
    const ESTADO_SUSPENDIDO = 'suspendido';
    const ESTADO_LICENCIA = 'licencia';
    const ESTADO_INCAPACIDAD = 'incapacidad';
    const ESTADO_LIQUIDADO = 'liquidado';
    const ESTADO_CANCELADO = 'cancelado';

    public static function tableName()
    {
        return 'contrato';
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
            [
                [
                    'sub_area_id',
                    'sede_id',
                    'fecha_fin',
                    'created_by',
                    'updated_by',
                    'requisicion_id',
                    'motivo_vinculacion_id',
                    'empresa_cliente_id',
                    'ciudad_id',
                    'jornada',
                    'salario',
                    'auxilio',
                    'esquema_variable_id',
                    'tipo_contrato',
                ],
                'default',
                'value' => null,
            ],
            [['estado'], 'default', 'value' => self::ESTADO_ACTIVO],
            [['empresa_id', 'profile_id', 'contrato_tipo_id', 'area_id', 'cargo_id', 'sede_id', 'fecha_inicio'], 'required'],
            [
                [
                    'empresa_id',
                    'profile_id',
                    'contrato_tipo_id',
                    'area_id',
                    'sub_area_id',
                    'cargo_id',
                    'sede_id',
                    'empresa_cliente_id',
                    'created_by',
                    'updated_by',
                    'requisicion_id',
                    'motivo_vinculacion_id',
                    'ciudad_id',
                    'esquema_variable_id',
                ],
                'integer',
            ],
            [['fecha_inicio', 'fecha_fin', 'created_at', 'updated_at'], 'safe'],
            [['jornada', 'salario', 'auxilio'], 'number'],
            [['tipo_contrato'], 'string', 'max' => 20],
            [['estado'], 'string', 'max' => 20],
            [['estado'], 'in', 'range' => array_keys(self::optsEstado())],
            [['fecha_fin'], 'validateFechaFin'],
            [['contrato_tipo_id'], 'validateContratoTipoFechaFin'],
            [['sub_area_id'], 'validateSubArea'],
            [['cargo_id'], 'validateCargoConsistency'],
            [['profile_id'], 'validateProfileTenant'],
            [['area_id'], 'validateAreaTenant'],
            [['sede_id'], 'validateSedeTenant'],
            [['contrato_tipo_id'], 'validateContratoTipoTenant'],
            [['profile_id'], 'validateOverlappingActiveContract'],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'user_id']],
            [['contrato_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContratoTipos::class, 'targetAttribute' => ['contrato_tipo_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_id' => 'id']],
            [['sub_area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['sub_area_id' => 'id']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargo_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['sede_id' => 'id']],
            [['empresa_cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_cliente_id' => 'id']],
            [['requisicion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requisicion::class, 'targetAttribute' => ['requisicion_id' => 'id']],
            [['motivo_vinculacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoVinculacion::class, 'targetAttribute' => ['motivo_vinculacion_id' => 'id']],
            [['ciudad_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['ciudad_id' => 'id']],
            [['esquema_variable_id'], 'exist', 'skipOnError' => true, 'targetClass' => EsquemaVariable::class, 'targetAttribute' => ['esquema_variable_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa',
            'profile_id' => 'Empleado',
            'contrato_tipo_id' => 'Tipo de contrato',
            'area_id' => 'Área',
            'sub_area_id' => 'Subárea',
            'cargo_id' => 'Cargo',
            'sede_id' => 'Sede principal',
            'requisicion_id' => 'Requisición',
            'motivo_vinculacion_id' => 'Motivo de vinculación',
            'empresa_cliente_id' => 'Empresa cliente',
            'ciudad_id' => 'Ciudad',
            'jornada' => 'Jornada',
            'salario' => 'Salario',
            'auxilio' => 'Auxilio',
            'esquema_variable_id' => 'Esquema variable',
            'tipo_contrato' => 'Tipo contrato',
            'estado' => 'Estado',
            'fecha_inicio' => 'Fecha inicio',
            'fecha_fin' => 'Fecha fin',
            'created_at' => 'Creado el',
            'updated_at' => 'Actualizado el',
            'created_by' => 'Creado por',
            'updated_by' => 'Actualizado por',
        ];
    }

    public static function optsEstado()
    {
        return [
            self::ESTADO_ACTIVO => 'Activo',
            self::ESTADO_INACTIVO => 'Inactivo',
            self::ESTADO_SUSPENDIDO => 'Suspendido',
            self::ESTADO_LICENCIA => 'Licencia',
            self::ESTADO_INCAPACIDAD => 'Incapacidad',
            self::ESTADO_LIQUIDADO => 'Liquidado',
            self::ESTADO_CANCELADO => 'Cancelado',
        ];
    }

    public static function occupyingStatuses()
    {
        return [
            self::ESTADO_ACTIVO,
            self::ESTADO_SUSPENDIDO,
            self::ESTADO_LICENCIA,
            self::ESTADO_INCAPACIDAD,
        ];
    }

    public static function specialOccupyingStatuses()
    {
        return [
            self::ESTADO_INCAPACIDAD,
            self::ESTADO_LICENCIA,
            self::ESTADO_SUSPENDIDO,
        ];
    }

    public static function find()
    {
        return parent::find();
    }

    public static function findOccupyingAt($date = null)
    {
        $date = $date ?: date('Y-m-d');

        return static::find()
            ->alias('contrato')
            ->where(['contrato.estado' => self::occupyingStatuses()])
            ->andWhere(['<=', 'contrato.fecha_inicio', $date])
            ->andWhere([
                'or',
                ['contrato.fecha_fin' => null],
                ['>=', 'contrato.fecha_fin', $date],
            ]);
    }

    public function isOccupyingPlanta()
    {
        if (!in_array($this->estado, self::occupyingStatuses(), true)) {
            return false;
        }

        $today = date('Y-m-d');

        if ($this->fecha_inicio > $today) {
            return false;
        }

        if ($this->fecha_fin !== null && $this->fecha_fin < $today) {
            return false;
        }

        return true;
    }

    public function getDisplayEstado()
    {
        $items = self::optsEstado();

        return isset($items[$this->estado]) ? $items[$this->estado] : $this->estado;
    }

    public function getEstadoBadgeClass()
    {
        switch ($this->estado) {
            case self::ESTADO_ACTIVO:
                return 'success';
            case self::ESTADO_SUSPENDIDO:
                return 'warning';
            case self::ESTADO_LICENCIA:
                return 'info';
            case self::ESTADO_INCAPACIDAD:
                return 'primary';
            case self::ESTADO_INACTIVO:
                return 'danger';
            case self::ESTADO_LIQUIDADO:
            case self::ESTADO_CANCELADO:
                return 'danger';
            default:
                return 'secondary';
        }
    }

    public function isCurrentByDate($date = null)
    {
        $date = $date ?: date('Y-m-d');

        if ($this->fecha_inicio > $date) {
            return false;
        }

        if ($this->fecha_fin !== null && $this->fecha_fin < $date) {
            return false;
        }

        return true;
    }

    public function getVigenciaLabel($date = null)
    {
        return $this->isCurrentByDate($date) ? 'Vigente' : 'No vigente';
    }

    public function getProfileDisplayName()
    {
        if ($this->profile === null) {
            return (string) $this->profile_id;
        }

        $parts = array_filter([
            $this->profile->name,
            $this->profile->user ? '@' . $this->profile->user->username : null,
        ]);

        return empty($parts) ? (string) $this->profile_id : implode(' ', $parts);
    }

    public function validateFechaFin($attribute)
    {
        if (empty($this->fecha_fin) || empty($this->fecha_inicio)) {
            return;
        }

        if ($this->fecha_fin < $this->fecha_inicio) {
            $this->addError($attribute, 'La fecha fin no puede ser menor que la fecha inicio.');
        }
    }

    public function validateContratoTipoFechaFin($attribute)
    {
        if (empty($this->contrato_tipo_id)) {
            return;
        }

        $contratoTipo = $this->contratoTipo ?: ContratoTipos::findOne($this->contrato_tipo_id);
        if ($contratoTipo === null) {
            return;
        }

        if ((int) $contratoTipo->requiere_fecha_fin === 1 && empty($this->fecha_fin)) {
            $this->addError('fecha_fin', 'El tipo de contrato seleccionado requiere fecha fin.');
        }

        if ((int) $contratoTipo->es_indefinido === 1 && !empty($this->fecha_fin)) {
            $this->addError('fecha_fin', 'El tipo de contrato indefinido no debe llevar fecha fin.');
        }
    }

    public function validateSubArea($attribute)
    {
        if (empty($this->area_id) || empty($this->sub_area_id)) {
            return;
        }

        $subArea = Area::findOne($this->sub_area_id);
        if ($subArea === null) {
            return;
        }

        if ((int) $subArea->id === (int) $this->area_id && !$this->areaHasChildren($this->area_id)) {
            return;
        }

        if ((int) $subArea->area_padre !== (int) $this->area_id) {
            $this->addError($attribute, 'La subárea debe pertenecer al área seleccionada.');
        }
    }

    public function validateCargoConsistency($attribute)
    {
        if (empty($this->cargo_id) || empty($this->empresa_id)) {
            return;
        }

        $cargo = $this->cargo ?: Cargos::findOne($this->cargo_id);
        if ($cargo === null) {
            return;
        }

        if ((int) $cargo->empresa_id !== (int) $this->empresa_id) {
            $this->addError($attribute, 'El cargo debe pertenecer a la empresa actual.');
        }

        if ($cargo->area_id !== null && (int) $cargo->area_id !== (int) $this->area_id) {
            $this->addError($attribute, 'El cargo no corresponde al área seleccionada.');
        }

        $expectedSubAreaId = $cargo->sub_area_id !== null ? (int) $cargo->sub_area_id : (int) $this->area_id;
        $selectedSubAreaId = $this->sub_area_id !== null ? (int) $this->sub_area_id : null;

        if ($selectedSubAreaId !== null && $cargo->sub_area_id !== null && $expectedSubAreaId !== $selectedSubAreaId) {
            $this->addError($attribute, 'El cargo no corresponde a la subárea seleccionada.');
        }
    }

    public function validateProfileTenant($attribute)
    {
        if (empty($this->profile_id) || empty($this->empresa_id)) {
            return;
        }

        $profile = $this->profile ?: Profile::findOne(['user_id' => $this->profile_id]);
        if ($profile !== null && (int) $profile->empresas_id !== (int) $this->empresa_id) {
            $this->addError($attribute, 'El empleado debe pertenecer a la empresa actual.');
        }
    }

    public function validateAreaTenant($attribute)
    {
        if (empty($this->area_id) || empty($this->empresa_id)) {
            return;
        }

        $area = $this->area ?: Area::findOne($this->area_id);
        if ($area !== null && (int) $area->empresas_id !== (int) $this->empresa_id) {
            $this->addError($attribute, 'El área debe pertenecer a la empresa actual.');
        }
    }

    public function validateSedeTenant($attribute)
    {
        if (empty($this->sede_id) || empty($this->empresa_id)) {
            return;
        }

        $sede = $this->sede ?: LocationSedes::findOne($this->sede_id);
        if ($sede !== null && (int) $sede->empresa_id !== (int) $this->empresa_id) {
            $this->addError($attribute, 'La sede debe pertenecer a la empresa actual.');
        }
    }

    public function validateContratoTipoTenant($attribute)
    {
        if (empty($this->contrato_tipo_id) || empty($this->empresa_id)) {
            return;
        }

        $contratoTipo = $this->contratoTipo ?: ContratoTipos::findOne($this->contrato_tipo_id);
        if ($contratoTipo === null || !$contratoTipo->hasAttribute('empresa_id')) {
            return;
        }

        if ($contratoTipo->empresa_id !== null
            && (int) $contratoTipo->empresa_id !== (int) $this->empresa_id
        ) {
            $this->addError($attribute, 'El tipo de contrato debe pertenecer a la empresa actual.');
        }
    }

    public function validateOverlappingActiveContract($attribute)
    {
        if ($this->hasErrors()) {
            return;
        }

        if (!$this->isStatusPotentiallyActive()) {
            return;
        }

        if (empty($this->profile_id) || empty($this->fecha_inicio)) {
            return;
        }

        $endDate = $this->fecha_fin ?: '9999-12-31';

        $query = static::find()
            ->andWhere(['profile_id' => $this->profile_id])
            ->andWhere(['estado' => self::occupyingStatuses()])
            ->andWhere(['<=', 'fecha_inicio', $endDate])
            ->andWhere(new Expression('COALESCE(fecha_fin, "9999-12-31") >= :startDate', [
                ':startDate' => $this->fecha_inicio,
            ]));

        if (!$this->isNewRecord) {
            $query->andWhere(['<>', 'id', $this->id]);
        }

        if ($query->exists()) {
            $this->addError($attribute, 'El empleado ya tiene otro contrato activo o vigente que ocupa planta.');
        }
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'profile_id']);
    }

    public function getContratoTipo()
    {
        return $this->hasOne(ContratoTipos::class, ['id' => 'contrato_tipo_id']);
    }

    public function getArea()
    {
        return $this->hasOne(Area::class, ['id' => 'area_id']);
    }

    public function getSubArea()
    {
        return $this->hasOne(Area::class, ['id' => 'sub_area_id']);
    }

    public function getCargo()
    {
        return $this->hasOne(Cargos::class, ['id' => 'cargo_id']);
    }

    public function getSede()
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'sede_id']);
    }

    public function getEmpresaCliente()
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }

    public function getRequisicion()
    {
        return $this->hasOne(Requisicion::class, ['id' => 'requisicion_id']);
    }

    public function getMotivoVinculacion()
    {
        return $this->hasOne(MotivoVinculacion::class, ['id' => 'motivo_vinculacion_id']);
    }

    public function getCiudad()
    {
        return $this->hasOne(City::class, ['id' => 'ciudad_id']);
    }

    public function getEsquemaVariable()
    {
        return $this->hasOne(EsquemaVariable::class, ['id' => 'esquema_variable_id']);
    }

    public function getContratoDistribucionSedes()
    {
        return $this->hasMany(ContratoDistribucionSede::class, ['contrato_id' => 'id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function hasValidDistribution()
    {
        return ContratoDistribucionSede::hasCompleteDistribution($this->id);
    }

    private function isStatusPotentiallyActive()
    {
        return in_array($this->estado, self::occupyingStatuses(), true);
    }

    private function areaHasChildren($areaId)
    {
        return Area::find()->where(['area_padre' => $areaId])->exists();
    }
}
