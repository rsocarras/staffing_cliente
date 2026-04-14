<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * Requisición de contratación con soporte N vacantes
 *
 * @property int $id
 * @property string $group_uuid
 * @property int $vacante_index
 * @property int|null $parent_id
 * @property string $estado
 * @property int|null $motivo_vinculacion_id
 * @property int $empresa_cliente_id
 * @property int $empresas_id
 * @property string $fecha_ingreso
 * @property int $ciudad_id
 * @property int $sede_id
 * @property int $area_id
 * @property int|null $sub_area_id
 * @property int $cargo_id
 * @property string|null $tipo_contrato
 * @property int|null $contrato_tipo_id
 * @property float $jornada
 * @property float $salario
 * @property float $auxilio
 * @property int|null $esquema_variable_id
 * @property int $numero_vacantes
 * @property int|null $profile_id
 * @property string|null $motivo_rechazo
 * @property int|null $vinculacion_aprobada
 * @property string|null $vinculacion_motivo_rechazo
 * @property int|null $creado_por
 * @property int|null $actualizado_por
 * @property string $fecha_creacion
 * @property string $fecha_update
 *
 * @property MotivoVinculacion $motivoVinculacion
 * @property EmpresaCliente $empresa
 * @property City $ciudad
 * @property LocationSedes $sede
 * @property Area $area
 * @property Area $subArea
 * @property Cargos $cargo
 * @property ContratoTipos|null $contratoTipo
 * @property EsquemaVariable $esquemaVariable
 * @property Profile $profile
 * @property Requisicion $parent
 * @property Requisicion[] $hijas
 * @property ChecklistStatus[] $checklistStatuses
 * @property RequisicionHistoryLog[] $historyLogs
 */
class Requisicion extends ActiveRecord
{
    private static $tipoContratoEnumCache = null;
    public ?string $jornada_selector = null;
    public ?string $jornada_otro = null;
    const ESTADO_DRAFT = 'DRAFT';   // Borrador 

    const ESTADO_SUBMITTED = 'SUBMITTED';  

    const ESTADO_APPROVAL_PENDING = 'APPROVAL_PENDING'; // Registrada 
    
    const ESTADO_APPROVED = 'APPROVED'; // Aprobado -->  Cuando se aprueba lo envia a staffing
    const ESTADO_REJECTED = 'REJECTED'; // Rechazado 

    const ESTADO_ORDER_PENDING = 'ORDER_PENDING'; // En gestión 

    const ESTADO_PERSON_ASSIGNED = 'PERSON_ASSIGNED'; //Aqui ya hay una persona asignado 
    const ESTADO_VINCULATION_REVIEW = 'VINCULATION_REVIEW';  // REVISION DE LA VINCULACION 
    const ESTADO_VINCULATION_REJECTED = 'VINCULATION_REJECTED'; //VINCULACION RECHAZADA 
    const ESTADO_HIRING_IN_PROGRESS = 'HIRING_IN_PROGRESS'; // CONTRATACION  
    const ESTADO_ACTIVE = 'ACTIVE'; // CONTRATACION finalizada  
    const ESTADO_CANCELLED = 'CANCELLED'; // 

    public static function tableName()
    {
        return 'requisicion';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'fecha_creacion',
                'updatedAtAttribute' => 'fecha_update',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'creado_por',
                'updatedByAttribute' => 'actualizado_por',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['empresa_cliente_id', 'empresas_id', 'fecha_ingreso', 'ciudad_id', 'sede_id', 'area_id', 'cargo_id', 'tipo_contrato', 'contrato_tipo_id', 'numero_vacantes'], 'required', 'on' => ['create', 'default']],
            [['motivo_vinculacion_id', 'empresa_cliente_id', 'empresas_id', 'ciudad_id', 'sede_id', 'area_id', 'sub_area_id', 'cargo_id', 'contrato_tipo_id', 'esquema_variable_id', 'numero_vacantes', 'profile_id', 'parent_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['fecha_ingreso', 'fecha_creacion', 'fecha_update'], 'safe'],
            [['jornada_otro'], 'trim'],
            [['jornada', 'salario', 'auxilio'], 'number'],
            [['salario', 'auxilio'], 'number', 'min' => 0],
            [['numero_vacantes'], 'integer', 'min' => 1],
            [['motivo_rechazo', 'vinculacion_motivo_rechazo'], 'string'],
            [['tipo_contrato'], 'string', 'max' => 255],
            [['tipo_contrato'], 'in', 'range' => array_keys(self::optsTipoContrato())],
            [['jornada_selector'], 'in', 'range' => ['110', '220', 'otro']],
            [['estado'], 'string', 'max' => 50],
            [['group_uuid'], 'string', 'max' => 36],
            [['motivo_vinculacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoVinculacion::class, 'targetAttribute' => ['motivo_vinculacion_id' => 'id']],
            [['empresa_cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_cliente_id' => 'id']],
            [['empresas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresas_id' => 'id']],
            [['ciudad_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['ciudad_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['sede_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_id' => 'id']],
            [['sub_area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['sub_area_id' => 'id']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargo_id' => 'id']],
            [['contrato_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ContratoTipos::class, 'targetAttribute' => ['contrato_tipo_id' => 'id']],
            [['esquema_variable_id'], 'exist', 'skipOnError' => true, 'targetClass' => EsquemaVariable::class, 'targetAttribute' => ['esquema_variable_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'user_id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requisicion::class, 'targetAttribute' => ['parent_id' => 'id']],
            [['sede_id'], 'validateSedeCiudad'],
            [['sub_area_id'], 'validateSubArea'],
            [['cargo_id'], 'validateCargoDependencia'],
            [['contrato_tipo_id'], 'validateContratoTipoTenant'],
            [['contrato_tipo_id'], 'validateContratoTipoModalidad'],
            [['jornada_selector'], 'validateJornadaRequeridaSegunTipoContrato'],
            [['jornada'], 'validateJornadaRango'],
            [['jornada_otro'], 'validateJornadaOtro'],
            [['empresa_cliente_id'], 'validateEmpresaClienteTenant'],
        ];
    }

    public function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }

        $selector = trim((string) $this->jornada_selector);
        if ($selector === '' && $this->jornada !== null) {
            $selector = in_array((string) (int) $this->jornada, ['110', '220'], true) ? (string) (int) $this->jornada : 'otro';
            $this->jornada_selector = $selector;
        }

        if ($this->isContratoTipoHoras()) {
            $this->jornada = 0;
            $this->jornada_selector = null;
            $this->jornada_otro = null;
            $this->salario = 0;
        } else {
            if ($selector === '110' || $selector === '220') {
                $this->jornada = (float) $selector;
                $this->jornada_otro = null;
            } elseif ($selector === 'otro') {
                $raw = str_replace(',', '.', trim((string) $this->jornada_otro));
                if ($raw !== '' && is_numeric($raw)) {
                    $this->jornada = (float) $raw;
                }
            }
        }

        return true;
    }

    public function afterFind()
    {
        parent::afterFind();
        $j = $this->jornada !== null ? (float) $this->jornada : null;
        if ($j === 110.0) {
            $this->jornada_selector = '110';
            $this->jornada_otro = null;
        } elseif ($j === 220.0) {
            $this->jornada_selector = '220';
            $this->jornada_otro = null;
        } elseif ($j !== null) {
            $this->jornada_selector = 'otro';
            $this->jornada_otro = rtrim(rtrim(number_format($j, 2, '.', ''), '0'), '.');
        }
    }

    public function validateSedeCiudad($attribute, $params, $validator)
    {
        $sede = LocationSedes::findOne($this->sede_id);
        if ($sede && $sede->city_id !== null && $sede->city_id != $this->ciudad_id) {
            $this->addError($attribute, 'La sede debe pertenecer a la ciudad seleccionada.');
        }
    }

    public function validateSubArea($attribute, $params, $validator)
    {
        if ($this->sub_area_id) {
            $subArea = Area::findOne($this->sub_area_id);
            if ($subArea && $subArea->area_padre != $this->area_id) {
                $this->addError($attribute, 'La sub-área debe pertenecer al área seleccionada.');
            }
        }
    }

    public function validateCargoDependencia($attribute, $params, $validator)
    {
        if (empty($this->cargo_id) || empty($this->area_id)) {
            return;
        }
        $cargo = Cargos::findOne((int) $this->cargo_id);
        if ($cargo === null) {
            return;
        }
        if ((int) $cargo->area_id !== (int) $this->area_id) {
            $this->addError($attribute, 'El cargo debe pertenecer al área seleccionada.');

            return;
        }
        if (!empty($this->sub_area_id) && (int) ($cargo->sub_area_id ?? 0) !== (int) $this->sub_area_id) {
            $this->addError($attribute, 'El cargo debe pertenecer a la sub-área seleccionada.');
        }
    }

    public function validateContratoTipoTenant($attribute, $params, $validator)
    {
        if (empty($this->contrato_tipo_id) || empty($this->empresas_id)) {
            return;
        }
        $contratoTipo = ContratoTipos::findOne((int) $this->contrato_tipo_id);
        if ($contratoTipo === null) {
            return;
        }
        if (!$contratoTipo->hasAttribute('empresa_id')) {
            return;
        }
        if ($contratoTipo->empresa_id !== null && (int) $contratoTipo->empresa_id !== (int) $this->empresas_id) {
            $this->addError($attribute, 'El tipo de contrato debe pertenecer a la empresa actual.');
        }
    }

    public function validateContratoTipoModalidad($attribute, $params, $validator): void
    {
        $modalidad = trim((string) $this->tipo_contrato);
        if ($modalidad === '' || empty($this->contrato_tipo_id)) {
            return;
        }
        if (!array_key_exists($modalidad, self::optsTipoContrato())) {
            return;
        }
        $contratoTipo = ContratoTipos::findOne((int) $this->contrato_tipo_id);
        if ($contratoTipo === null) {
            return;
        }
        if (!ContratoTipos::aplicaAModalidad($contratoTipo, $modalidad)) {
            $this->addError($attribute, 'El tipo de contrato no aplica para la modalidad de contratación seleccionada.');
        }
    }

    public function validateJornadaRango($attribute, $params, $validator)
    {
        if ($this->isContratoTipoHoras()) {
            return;
        }
        if ($this->$attribute === null || $this->$attribute === '') {
            return;
        }
        $value = (float) $this->$attribute;
        if ($value < 100 || $value > 300) {
            $this->addError($attribute, 'La jornada debe estar entre 100 y 300.');
        }
    }

    public function validateJornadaOtro($attribute, $params, $validator)
    {
        if ($this->isContratoTipoHoras()) {
            return;
        }
        if ((string) $this->jornada_selector !== 'otro') {
            return;
        }
        $raw = str_replace(',', '.', trim((string) $this->$attribute));
        if ($raw === '') {
            $this->addError($attribute, 'Debe ingresar un valor de jornada cuando selecciona "otro".');

            return;
        }
        if (!is_numeric($raw)) {
            $this->addError($attribute, 'La jornada debe ser un número válido.');

            return;
        }
        $value = (float) $raw;
        if ($value < 100 || $value > 300) {
            $this->addError($attribute, 'La jornada debe estar entre 100 y 300.');
        }
    }

    public function validateJornadaRequeridaSegunTipoContrato($attribute, $params, $validator)
    {
        if ($this->isContratoTipoHoras()) {
            return;
        }
        if (trim((string) $this->$attribute) === '') {
            $this->addError($attribute, 'Debe seleccionar una jornada.');
        }
    }

    private function isContratoTipoHoras(): bool
    {
        if (empty($this->contrato_tipo_id)) {
            return false;
        }
        $tipo = $this->contratoTipo ?: ContratoTipos::findOne((int) $this->contrato_tipo_id);
        if ($tipo === null || !$tipo->hasAttribute('code')) {
            return false;
        }

        return strtoupper((string) $tipo->code) === 'HORAS';
    }

    public function validateEmpresaClienteTenant($attribute, $params, $validator)
    {
        if (empty($this->empresa_cliente_id) || empty($this->empresas_id)) {
            return;
        }
        $empresaCliente = EmpresaCliente::findOne($this->empresa_cliente_id);
        if ($empresaCliente === null) {
            return;
        }
        if ((int) $empresaCliente->empresas_id !== (int) $this->empresas_id) {
            $this->addError($attribute, 'La empresa cliente no pertenece a la empresa actual.');
        }
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_uuid' => 'Grupo',
            'vacante_index' => 'Vacante #',
            'estado' => 'Estado',
            'motivo_vinculacion_id' => 'Motivo vinculación',
            'empresa_cliente_id' => 'Empresa cliente',
            'empresas_id' => 'Empresa',
            'fecha_ingreso' => 'Fecha ingreso',
            'ciudad_id' => 'Ciudad',
            'sede_id' => 'Sede',
            'area_id' => 'Área',
            'sub_area_id' => 'Sub-área',
            'cargo_id' => 'Cargo',
            'tipo_contrato' => 'Modalidad de vinculación',
            'contrato_tipo_id' => 'Tipo de contrato',
            'jornada' => 'Jornada',
            'jornada_selector' => 'Jornada',
            'jornada_otro' => 'Jornada (otro)',
            'salario' => 'Salario',
            'auxilio' => 'Auxilio',
            'esquema_variable_id' => 'Esquema variable',
            'numero_vacantes' => 'Nº vacantes',
            'profile_id' => 'Persona asignada',
            'motivo_rechazo' => 'Motivo rechazo',
            'vinculacion_aprobada' => 'Vinculación',
            'vinculacion_motivo_rechazo' => 'Motivo rechazo vinculación',
        ];
    }

    public function getMotivoVinculacion()
    {
        return $this->hasOne(MotivoVinculacion::class, ['id' => 'motivo_vinculacion_id']);
    }

    public function getEmpresa()
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }

    public function getEmpresas()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresas_id']);
    }

    public function getCiudad()
    {
        return $this->hasOne(City::class, ['id' => 'ciudad_id']);
    }

    public function getSede()
    {
        return $this->hasOne(LocationSedes::class, ['id' => 'sede_id']);
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

    public function getContratoTipo()
    {
        return $this->hasOne(ContratoTipos::class, ['id' => 'contrato_tipo_id']);
    }

    public function getEsquemaVariable()
    {
        return $this->hasOne(EsquemaVariable::class, ['id' => 'esquema_variable_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'profile_id']);
    }

    public function getParent()
    {
        return $this->hasOne(Requisicion::class, ['id' => 'parent_id']);
    }

    public function getHijas()
    {
        return $this->hasMany(Requisicion::class, ['parent_id' => 'id']);
    }

    public function getChecklistStatuses()
    {
        return $this->hasMany(ChecklistStatus::class, ['requisicion_id' => 'id']);
    }

    public function getHistoryLogs()
    {
        return $this->hasMany(RequisicionHistoryLog::class, ['requisicion_id' => 'id'])->orderBy(['created_at' => SORT_DESC]);
    }

    /**
     * Clase Bootstrap para badge según estado.
     * @param string $estado
     * @return string ej. 'success', 'danger', 'warning', etc.
     */
    public static function estadoBadgeClass($estado)
    {
        $map = [
            self::ESTADO_DRAFT => 'secondary',
            self::ESTADO_SUBMITTED => 'info',
            self::ESTADO_APPROVAL_PENDING => 'warning',
            self::ESTADO_APPROVED => 'primary',
            self::ESTADO_REJECTED => 'danger',
            self::ESTADO_ORDER_PENDING => 'info',
            self::ESTADO_PERSON_ASSIGNED => 'info',
            self::ESTADO_VINCULATION_REVIEW => 'warning',
            self::ESTADO_VINCULATION_REJECTED => 'danger',
            self::ESTADO_HIRING_IN_PROGRESS => 'primary',
            self::ESTADO_ACTIVE => 'success',
            self::ESTADO_CANCELLED => 'dark',
        ];
        return $map[$estado] ?? 'secondary';
    }

    public static function optsEstado()
    {
        return [
            self::ESTADO_DRAFT => 'Borrador',
            self::ESTADO_SUBMITTED => 'Enviada',
            self::ESTADO_APPROVAL_PENDING => 'Pendiente aprobación',
            self::ESTADO_APPROVED => 'Aprobada',
            self::ESTADO_REJECTED => 'Rechazada',
            self::ESTADO_ORDER_PENDING => 'En gestión',
            self::ESTADO_PERSON_ASSIGNED => 'Persona asignada',
            self::ESTADO_VINCULATION_REVIEW => 'Revisión vinculación',
            self::ESTADO_VINCULATION_REJECTED => 'Vinculación rechazada',
            self::ESTADO_HIRING_IN_PROGRESS => 'Contratación en proceso',
            self::ESTADO_ACTIVE => 'Activa',
            self::ESTADO_CANCELLED => 'Anulada',
        ];
    }

    public static function optsTipoContrato()
    {
        if (self::$tipoContratoEnumCache !== null) {
            return self::$tipoContratoEnumCache;
        }

        $items = [];
        try {
            $column = Yii::$app->db->schema->getTableSchema(self::tableName(), true)->getColumn('tipo_contrato');
            $dbType = $column ? (string) $column->dbType : '';
            if (preg_match('/^enum\((.*)\)$/i', $dbType, $matches)) {
                $values = str_getcsv($matches[1], ',', "'");
                foreach ($values as $value) {
                    $value = trim((string) $value);
                    if ($value === '') {
                        continue;
                    }
                    $items[$value] = ucfirst($value);
                }
            }
        } catch (\Throwable $e) {
            // fallback silencioso
        }

        if (empty($items)) {
            $items = [
                'directo' => 'Directo',
                'temporal' => 'Temporal',
            ];
        }

        self::$tipoContratoEnumCache = $items;
        return self::$tipoContratoEnumCache;
    }

    public function isEditable()
    {
        return $this->estado === self::ESTADO_DRAFT;
    }

    public function isMaestra()
    {
        return $this->parent_id === null;
    }

    public function getGrupoRequisiciones()
    {
        return static::find()->where(['group_uuid' => $this->group_uuid])->orderBy('vacante_index')->all();
    }

    /**
     * Crea N requisiciones hijas a partir de una maestra
     */
    public static function crearGrupoVacantes(Requisicion $maestra)
    {
        $n = (int) $maestra->numero_vacantes;
        if ($n < 1) return [];
        $uuid = $maestra->group_uuid ?: sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
        $maestra->group_uuid = $uuid;
        $maestra->vacante_index = 1;
        $maestra->numero_vacantes = $n;
        $maestra->save(false);
        $creadas = [$maestra];
        for ($i = 2; $i <= $n; $i++) {
            $hija = new static();
            $hija->setAttributes($maestra->getAttributes(null, ['id', 'fecha_creacion', 'fecha_update']));
            $hija->parent_id = $maestra->id;
            $hija->group_uuid = $uuid;
            $hija->vacante_index = $i;
            $hija->numero_vacantes = 1;
            $hija->profile_id = null;
            $hija->save(false);
            RequisicionHistoryLog::registrar($hija, self::ESTADO_DRAFT, 'Vacante #' . $i . ' creada', null);
            $creadas[] = $hija;
        }
        return $creadas;
    }

    /**
     * Tiempo total desde fecha_creacion en formato "X h Y min".
     */
    public function getTiempoTotalDesdeCreacion(): string
    {
        if (empty($this->fecha_creacion)) {
            return '-';
        }
        $minutos = (int) floor((time() - strtotime($this->fecha_creacion)) / 60);
        return RequisicionHistoryLog::formatDuracion(max(0, $minutos));
    }

    public function checklistCompleto()
    {
        $obligatorios = ChecklistItem::find()->where(['es_obligatorio' => 1, 'is_active' => 1])->count();
        $completados = ChecklistStatus::find()->where(['requisicion_id' => $this->id, 'completado' => 1])->count();
        return $obligatorios > 0 && $completados >= $obligatorios;
    }
}
