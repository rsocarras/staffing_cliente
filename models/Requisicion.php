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
 * @property int $empresa_id
 * @property string $fecha_ingreso
 * @property int $ciudad_id
 * @property int $sede_id
 * @property int $area_id
 * @property int|null $sub_area_id
 * @property int $cargo_id
 * @property float $jornada
 * @property float $salario
 * @property float $auxilio
 * @property int|null $esquema_variable_id
 * @property int $numero_vacantes
 * @property int|null $profile_id
 * @property string|null $motivo_rechazo
 * @property int|null $vinculacion_aprobada
 * @property string|null $vinculacion_motivo_rechazo
 * @property string|null $nombres
 * @property string|null $apellidos
 * @property string|null $tipo_documento
 * @property string|null $num_documento
 * @property string|null $correo
 * @property string|null $telefono
 * @property string|null $birthday
 * @property string|null $sexo
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
 * @property EsquemaVariable $esquemaVariable
 * @property Profile $profile
 * @property Requisicion $parent
 * @property Requisicion[] $hijas
 * @property ChecklistStatus[] $checklistStatuses
 */
class Requisicion extends ActiveRecord
{
    const ESTADO_DRAFT = 'DRAFT';
    const ESTADO_SUBMITTED = 'SUBMITTED';
    const ESTADO_APPROVAL_PENDING = 'APPROVAL_PENDING';
    const ESTADO_APPROVED = 'APPROVED';
    const ESTADO_REJECTED = 'REJECTED';
    const ESTADO_ORDER_PENDING = 'ORDER_PENDING';
    const ESTADO_PERSON_ASSIGNED = 'PERSON_ASSIGNED';
    const ESTADO_VINCULATION_REVIEW = 'VINCULATION_REVIEW';
    const ESTADO_VINCULATION_REJECTED = 'VINCULATION_REJECTED';
    const ESTADO_HIRING_IN_PROGRESS = 'HIRING_IN_PROGRESS';
    const ESTADO_ACTIVE = 'ACTIVE';
    const ESTADO_CANCELLED = 'CANCELLED';

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
            [['empresa_id', 'fecha_ingreso', 'ciudad_id', 'sede_id', 'area_id', 'sub_area_id', 'cargo_id', 'jornada', 'salario', 'auxilio', 'numero_vacantes'], 'required', 'on' => ['create', 'default']],
            [['motivo_vinculacion_id', 'empresa_id', 'ciudad_id', 'sede_id', 'area_id', 'sub_area_id', 'cargo_id', 'esquema_variable_id', 'numero_vacantes', 'profile_id', 'parent_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['fecha_ingreso', 'fecha_creacion', 'fecha_update', 'birthday'], 'safe'],
            [['jornada', 'salario', 'auxilio'], 'number'],
            [['salario', 'auxilio'], 'number', 'min' => 0],
            [['numero_vacantes'], 'integer', 'min' => 1],
            [['motivo_rechazo', 'vinculacion_motivo_rechazo'], 'string'],
            [['estado'], 'string', 'max' => 50],
            [['nombres', 'apellidos'], 'string', 'max' => 250],
            [['tipo_documento'], 'string', 'max' => 10],
            [['num_documento'], 'string', 'max' => 30],
            [['correo'], 'string', 'max' => 255],
            [['correo'], 'email', 'when' => function ($m) { return !empty($m->correo); }],
            [['telefono'], 'string', 'max' => 45],
            [['sexo'], 'string', 'max' => 2],
            [['group_uuid'], 'string', 'max' => 36],
            [['motivo_vinculacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => MotivoVinculacion::class, 'targetAttribute' => ['motivo_vinculacion_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['ciudad_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['ciudad_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => LocationSedes::class, 'targetAttribute' => ['sede_id' => 'id']],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['area_id' => 'id']],
            [['sub_area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Area::class, 'targetAttribute' => ['sub_area_id' => 'id']],
            [['cargo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cargos::class, 'targetAttribute' => ['cargo_id' => 'id']],
            [['esquema_variable_id'], 'exist', 'skipOnError' => true, 'targetClass' => EsquemaVariable::class, 'targetAttribute' => ['esquema_variable_id' => 'id']],
            [['profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::class, 'targetAttribute' => ['profile_id' => 'user_id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requisicion::class, 'targetAttribute' => ['parent_id' => 'id']],
            [['sede_id'], 'validateSedeCiudad'],
            [['sub_area_id'], 'validateSubArea'],
        ];
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

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_uuid' => 'Grupo',
            'vacante_index' => 'Vacante #',
            'estado' => 'Estado',
            'motivo_vinculacion_id' => 'Motivo vinculación',
            'empresa_id' => 'Empresa',
            'fecha_ingreso' => 'Fecha ingreso',
            'ciudad_id' => 'Ciudad',
            'sede_id' => 'Sede',
            'area_id' => 'Área',
            'sub_area_id' => 'Sub-área',
            'cargo_id' => 'Cargo',
            'jornada' => 'Jornada',
            'salario' => 'Salario',
            'auxilio' => 'Auxilio',
            'esquema_variable_id' => 'Esquema variable',
            'numero_vacantes' => 'Nº vacantes',
            'profile_id' => 'Persona asignada',
            'motivo_rechazo' => 'Motivo rechazo',
            'vinculacion_aprobada' => 'Vinculación',
            'vinculacion_motivo_rechazo' => 'Motivo rechazo vinculación',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'tipo_documento' => 'Tipo documento',
            'num_documento' => 'Nº documento',
            'correo' => 'Correo',
            'telefono' => 'Teléfono',
            'birthday' => 'Fecha nacimiento',
            'sexo' => 'Sexo',
        ];
    }

    public function getMotivoVinculacion()
    {
        return $this->hasOne(MotivoVinculacion::class, ['id' => 'motivo_vinculacion_id']);
    }

    public function getEmpresa()
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_id']);
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

    public static function optsEstado()
    {
        return [
            self::ESTADO_DRAFT => 'Borrador',
            self::ESTADO_SUBMITTED => 'Enviada',
            self::ESTADO_APPROVAL_PENDING => 'Pendiente aprobación',
            self::ESTADO_APPROVED => 'Aprobada',
            self::ESTADO_REJECTED => 'Rechazada',
            self::ESTADO_ORDER_PENDING => 'Pendiente orden',
            self::ESTADO_PERSON_ASSIGNED => 'Persona asignada',
            self::ESTADO_VINCULATION_REVIEW => 'Revisión vinculación',
            self::ESTADO_VINCULATION_REJECTED => 'Vinculación rechazada',
            self::ESTADO_HIRING_IN_PROGRESS => 'Contratación en proceso',
            self::ESTADO_ACTIVE => 'Activa',
            self::ESTADO_CANCELLED => 'Anulada',
        ];
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
            $hija->nombres = $hija->apellidos = $hija->tipo_documento = $hija->num_documento = $hija->correo = $hija->telefono = $hija->birthday = $hija->sexo = null;
            $hija->save(false);
            $creadas[] = $hija;
        }
        return $creadas;
    }

    public function checklistCompleto()
    {
        $obligatorios = ChecklistItem::find()->where(['es_obligatorio' => 1, 'is_active' => 1])->count();
        $completados = ChecklistStatus::find()->where(['requisicion_id' => $this->id, 'completado' => 1])->count();
        return $obligatorios > 0 && $completados >= $obligatorios;
    }
}
