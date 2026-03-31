<?php

namespace app\models;

use Da\User\Model\User;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Schema;
use yii\web\Application as WebApplication;

/**
 * @property int $id
 * @property int $empresa_id
 * @property int|null $created_by
 * @property int $profile_id
 * @property int $concepto_id
 * @property string|null $descripcion
 * @property int $novedad_tipo_id
 * @property int|null $novedad_flujo_id (solo si existe la columna en BD)
 * @property string $estado
 * @property string $estado_carga borrador|creada
 * @property string $datos JSON
 * @property string|null $schema_snapshot
 * @property string|null $alertas
 * @property int|null $paso_actual_id
 * @property int $es_masivo
 * @property int|null $lote_masivo_id
 * @property int|null $novedad_centro_costo_id
 * @property int|null $novedad_centro_utilidad_id
 * @property string|null $fecha_novedad
 * @property string|null $hora_inicio H:i:s
 * @property string|null $hora_fin H:i:s
 * @property float|null $horas_calculadas diferencia hora_fin − hora_inicio (mismo día en solicitud web; en otros flujos puede calcularse con fin en día siguiente)
 * @property string|null $periodo_nomina mensual|quincenal
 * @property int|null $anio
 * @property int|null $novedad_origen_id
 * @property string|null $importe importe monetario asociado a la novedad (p. ej. auxilio o 0 si aún no aplica cálculo)
 * @property int|string $created_at Unix o datetime según esquema BD
 * @property int|string $updated_at Unix o datetime según esquema BD
 *
 * @property NovedadConcepto $concepto
 * @property Empresas $empresa
 * @property NovedadTipo $novedadTipo
 * @property NovedadFlujo|null $novedadFlujo
 * @property NovedadStep|null $pasoActual
 * @property User|null $creador
 * @property NovedadCentroCosto|null $novedadCentroCosto
 * @property NovedadCentroUtilidad|null $novedadCentroUtilidad
 * @property Novedad|null $novedadOrigen
 * @property NovedadHorasDetalle[] $novedadHorasDetalles
 */
class Novedad extends ActiveRecord
{
    /** Creación desde formulario web de solicitud (fecha/horas obligatorias). */
    public const SCENARIO_SOLICITUD_WEB = 'solicitud_web';

    /** Solicitud tipo Horas: sin concepto único; el servidor trocea y crea varias novedades. */
    public const SCENARIO_SOLICITUD_HORAS_AUTO = 'solicitud_horas_auto';

    /** Novedad auxilio movilización ligada a troceo Horas (sin rango horario obligatorio). */
    public const SCENARIO_AUXILIO_MOVILIZACION = 'auxilio_movilizacion';

    /** Edición por administrador: sin reglas de negocio de solicitud (sede, contrato, permisos de tipo). */
    public const SCENARIO_ADMIN_UPDATE = 'admin_update';

    public const ESTADO_BORRADOR = 'borrador';
    public const ESTADO_PENDIENTE = 'pendiente';
    public const ESTADO_APROBADA = 'aprobada';
    public const ESTADO_RECHAZADA = 'rechazada';

    public const ESTADO_CARGA_BORRADOR = 'borrador';
    public const ESTADO_CARGA_CREADA = 'creada';

    public const PERIODO_MENSUAL = 'mensual';
    public const PERIODO_QUINCENAL = 'quincenal';

    public static function tableName(): string
    {
        return 'novedad';
    }

    /**
     * La migración `m250322_120000_add_novedad_flujo_id_to_novedad` agrega la columna.
     */
    public static function hasNovedadFlujoIdColumn(): bool
    {
        static $cached = null;
        if ($cached === null) {
            $cached = static::getTableSchema()->getColumn('novedad_flujo_id') !== null;
        }
        return $cached;
    }

    /**
     * En MySQL suele ser DATETIME; en otros entornos puede ser INT (epoch).
     */
    public static function timestampsAreDatetimeColumns(): bool
    {
        static $cached = null;
        if ($cached === null) {
            $col = static::getTableSchema()->getColumn('created_at');
            $cached = $col !== null && in_array($col->type, [
                Schema::TYPE_DATETIME,
                Schema::TYPE_TIMESTAMP,
                Schema::TYPE_DATE,
            ], true);
        }
        return $cached;
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return static::timestampsAreDatetimeColumns()
                        ? date('Y-m-d H:i:s')
                        : time();
                },
            ],
        ];
    }

    public function rules(): array
    {
        $rules = [
            [[
                'schema_snapshot',
                'alertas',
                'paso_actual_id',
                'lote_masivo_id',
                'descripcion',
                'created_by',
                'novedad_centro_costo_id',
                'novedad_centro_utilidad_id',
                'fecha_novedad',
                'hora_inicio',
                'hora_fin',
                'horas_calculadas',
                'periodo_nomina',
                'anio',
                'novedad_origen_id',
                'importe',
            ], 'default', 'value' => null],
            [['estado'], 'default', 'value' => self::ESTADO_BORRADOR],
            [['estado_carga'], 'default', 'value' => self::ESTADO_CARGA_BORRADOR],
            [['es_masivo'], 'default', 'value' => 0],
            [['datos'], 'default', 'value' => '{}'],
            [['empresa_id', 'profile_id', 'novedad_tipo_id'], 'required'],
            [['datos'], 'required', 'except' => self::SCENARIO_ADMIN_UPDATE],
            [['concepto_id'], 'required', 'except' => self::SCENARIO_SOLICITUD_HORAS_AUTO],
            [['profile_id'], 'filter', 'filter' => static function ($v) {
                if ($v === '' || $v === null) {
                    return null;
                }

                return (int) $v;
            }],
            [['empresa_id', 'profile_id', 'concepto_id', 'novedad_tipo_id', 'paso_actual_id', 'es_masivo', 'lote_masivo_id', 'created_by', 'anio', 'novedad_origen_id'], 'integer'],
            [['novedad_centro_costo_id', 'novedad_centro_utilidad_id'], 'integer'],
            [['estado', 'estado_carga'], 'string'],
            [['datos', 'schema_snapshot', 'alertas'], 'safe'],
            [['descripcion'], 'string'],
            [['fecha_novedad'], 'date', 'format' => 'php:Y-m-d', 'skipOnEmpty' => true],
            [['hora_inicio', 'hora_fin'], 'match', 'pattern' => '/^\d{2}:\d{2}(:\d{2})?$/', 'skipOnEmpty' => true],
            [['horas_calculadas'], 'number', 'skipOnEmpty' => true],
            [['importe'], 'number', 'min' => 0],
            [['periodo_nomina'], 'in', 'range' => [self::PERIODO_MENSUAL, self::PERIODO_QUINCENAL], 'skipOnEmpty' => true],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            ['estado_carga', 'in', 'range' => [self::ESTADO_CARGA_BORRADOR, self::ESTADO_CARGA_CREADA]],
            [['concepto_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => NovedadConcepto::class, 'targetAttribute' => ['concepto_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['novedad_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadTipo::class, 'targetAttribute' => ['novedad_tipo_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['novedad_centro_costo_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => NovedadCentroCosto::class, 'targetAttribute' => ['novedad_centro_costo_id' => 'id']],
            [['novedad_centro_utilidad_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => NovedadCentroUtilidad::class, 'targetAttribute' => ['novedad_centro_utilidad_id' => 'id']],
            [['novedad_origen_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => self::class, 'targetAttribute' => ['novedad_origen_id' => 'id']],
            [['fecha_novedad', 'hora_inicio', 'hora_fin'], 'required', 'on' => [self::SCENARIO_SOLICITUD_WEB, self::SCENARIO_SOLICITUD_HORAS_AUTO]],
            [['fecha_novedad'], 'required', 'on' => self::SCENARIO_AUXILIO_MOVILIZACION],
            [['importe'], 'required', 'on' => self::SCENARIO_AUXILIO_MOVILIZACION],
            [['importe'], 'number', 'min' => 0.01, 'on' => self::SCENARIO_AUXILIO_MOVILIZACION],
            [['hora_inicio'], 'validateRangoHoras', 'on' => [self::SCENARIO_SOLICITUD_WEB, self::SCENARIO_SOLICITUD_HORAS_AUTO]],
            [['datos'], 'validateDatosJsonAdmin', 'on' => self::SCENARIO_ADMIN_UPDATE],
            [['schema_snapshot', 'alertas'], 'validateJsonNullableAdmin', 'on' => self::SCENARIO_ADMIN_UPDATE],
            [['novedad_tipo_id'], 'validatePermisoCrearTipoSolicitud', 'on' => [self::SCENARIO_SOLICITUD_WEB, self::SCENARIO_SOLICITUD_HORAS_AUTO, self::SCENARIO_AUXILIO_MOVILIZACION]],
            [['profile_id'], 'validateProfileEmpleadoSolicitud', 'on' => [self::SCENARIO_SOLICITUD_WEB, self::SCENARIO_SOLICITUD_HORAS_AUTO, self::SCENARIO_AUXILIO_MOVILIZACION]],
            [['profile_id'], 'validateEmpleadoGerenteSede', 'on' => [self::SCENARIO_SOLICITUD_WEB, self::SCENARIO_SOLICITUD_HORAS_AUTO, self::SCENARIO_AUXILIO_MOVILIZACION]],
            [['concepto_id', 'novedad_tipo_id'], 'validateConceptoTipoEmpresaSolicitud', 'on' => [self::SCENARIO_SOLICITUD_WEB, self::SCENARIO_AUXILIO_MOVILIZACION]],
            [['concepto_id'], 'validateEmpresaNovedadConceptoSolicitud', 'on' => [self::SCENARIO_SOLICITUD_WEB, self::SCENARIO_AUXILIO_MOVILIZACION]],
            [['concepto_id'], 'validateConceptoCargoContratoSolicitud', 'on' => [self::SCENARIO_SOLICITUD_WEB, self::SCENARIO_AUXILIO_MOVILIZACION]],
        ];
        if (static::hasNovedadFlujoIdColumn()) {
            $rules[] = [['novedad_flujo_id'], 'default', 'value' => null];
            $rules[] = [['novedad_flujo_id'], 'integer'];
            $rules[] = [
                ['novedad_flujo_id'],
                'exist',
                'skipOnError' => true,
                'skipOnEmpty' => true,
                'targetClass' => NovedadFlujo::class,
                'targetAttribute' => ['novedad_flujo_id' => 'id'],
            ];
        }
        if (static::timestampsAreDatetimeColumns()) {
            $rules[] = [['created_at', 'updated_at'], 'safe'];
        } else {
            $rules[] = [['updated_at'], 'default', 'value' => 0];
            $rules[] = [['created_at', 'updated_at'], 'integer'];
        }
        return $rules;
    }

    public function validatePermisoCrearTipoSolicitud(string $attribute, ?array $params = null): void
    {
        if (!$this->puedeCrearSegunTipo()) {
            $this->addError($attribute, Yii::t('app', 'No tiene permiso para crear solicitudes de este tipo.'));
        }
    }

    public function validateProfileEmpleadoSolicitud(string $attribute, ?array $params = null): void
    {
        if ($this->hasErrors()) {
            return;
        }
        $profile = Profile::findOne(['user_id' => $this->profile_id]);
        if ($profile === null) {
            $this->addError($attribute, Yii::t('app', 'Empleado no encontrado.'));

            return;
        }
        if ($profile->estado !== Profile::ESTADO_ACTIVO) {
            $this->addError($attribute, Yii::t('app', 'El empleado no está activo.'));

            return;
        }
        if ((int) $profile->empresas_id !== (int) $this->empresa_id) {
            $this->addError($attribute, Yii::t('app', 'El empleado no pertenece a su organización.'));
        }
    }

    public function validateEmpleadoGerenteSede(string $attribute, ?array $params = null): void
    {
        if ($this->hasErrors() || !Yii::$app instanceof WebApplication || Yii::$app->user->isGuest) {
            return;
        }
        if (!Yii::$app->user->can('gerente_sede')) {
            return;
        }
        $identity = Yii::$app->user->identity;
        $op = $identity && $identity->profile ? $identity->profile : null;
        if ($op === null || empty($op->sede_id)) {
            return;
        }
        $emp = Profile::findOne(['user_id' => $this->profile_id]);
        if ($emp === null) {
            return;
        }
        if ((int) $emp->sede_id !== (int) $op->sede_id) {
            $this->addError($attribute, Yii::t('app', 'El empleado no pertenece a su sede.'));
        }
    }

    public function validateConceptoTipoEmpresaSolicitud(string $attribute, ?array $params = null): void
    {
        if ($this->hasErrors() || $this->concepto_id === null) {
            return;
        }
        $concepto = NovedadConcepto::findOne(['id' => $this->concepto_id, 'activo' => 1]);
        if ($concepto === null) {
            $this->addError('concepto_id', Yii::t('app', 'Concepto no válido.'));

            return;
        }
        if ((int) $concepto->novedad_tipo_id !== (int) $this->novedad_tipo_id) {
            $this->addError('concepto_id', Yii::t('app', 'El concepto no corresponde al agrupador seleccionado.'));

            return;
        }
        $tipo = $concepto->novedadTipo;
        if ($tipo === null) {
            $this->addError('concepto_id', Yii::t('app', 'El concepto no pertenece a su organización.'));

            return;
        }
        if (
            NovedadTipo::hasEmpresaIdColumn()
            && (int) $tipo->empresa_id !== (int) $this->empresa_id
        ) {
            $this->addError('concepto_id', Yii::t('app', 'El concepto no pertenece a su organización.'));
        }
    }

    public function validateEmpresaNovedadConceptoSolicitud(string $attribute, ?array $params = null): void
    {
        if ($this->hasErrors() || $this->concepto_id === null) {
            return;
        }
        $hayConfig = EmpresaNovedadConcepto::find()->where(['empresa_id' => $this->empresa_id])->exists();
        if (!$hayConfig) {
            return;
        }
        $ok = EmpresaNovedadConcepto::find()->where([
            'empresa_id' => $this->empresa_id,
            'novedad_concepto_id' => $this->concepto_id,
        ])->exists();
        if (!$ok) {
            $this->addError($attribute, Yii::t('app', 'Este concepto no está habilitado para su organización.'));
        }
    }

    public function validateConceptoCargoContratoSolicitud(string $attribute, ?array $params = null): void
    {
        if ($this->hasErrors() || $this->concepto_id === null || $this->fecha_novedad === null || $this->fecha_novedad === '') {
            return;
        }
        $contrato = Contrato::findOccupyingAt((string) $this->fecha_novedad)
            ->andWhere(['contrato.profile_id' => $this->profile_id, 'contrato.empresa_id' => $this->empresa_id])
            ->one();
        if ($contrato === null) {
            $this->addError('profile_id', Yii::t('app', 'No hay contrato vigente para el empleado en la fecha indicada.'));

            return;
        }
        $cargoId = (int) $contrato->cargo_id;
        $hayRestriccion = NovedadConceptoCargo::find()->where(['novedad_concepto_id' => $this->concepto_id])->exists();
        if (!$hayRestriccion) {
            return;
        }
        $ok = NovedadConceptoCargo::find()->where([
            'novedad_concepto_id' => $this->concepto_id,
            'cargo_id' => $cargoId,
        ])->exists();
        if (!$ok) {
            $this->addError($attribute, Yii::t('app', 'El cargo del contrato no aplica para este concepto.'));
        }
    }

    /**
     * JSON opcional (columnas con CHECK json_valid en BD).
     */
    public function validateJsonNullableAdmin(string $attribute, ?array $params = null): void
    {
        $raw = $this->$attribute;
        if ($raw === null || $raw === '') {
            $this->$attribute = null;

            return;
        }
        if (!is_string($raw)) {
            return;
        }
        try {
            json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $this->addError($attribute, Yii::t('app', 'Debe ser JSON válido o vacío.'));
        }
    }

    /**
     * Valida JSON en {@see $datos} en edición administrativa.
     */
    public function validateDatosJsonAdmin(string $attribute, ?array $params = null): void
    {
        $raw = $this->$attribute;
        if ($raw === null || $raw === '') {
            $this->$attribute = '{}';

            return;
        }
        if (!is_string($raw)) {
            return;
        }
        try {
            json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            $this->addError($attribute, Yii::t('app', 'El campo «datos» debe ser JSON válido.'));
        }
    }

    public function validateRangoHoras(string $attribute, ?array $params = null): void
    {
        if ($this->hasErrors()) {
            return;
        }
        $hi = self::normalizarTimeString($this->hora_inicio);
        $hf = self::normalizarTimeString($this->hora_fin);

        // Solo la plantilla de solicitud tipo Horas (una sola franja en el formulario): sin cruce de medianoche en reloj.
        // Los fragmentos generados por el troceo usan {@see SCENARIO_SOLICITUD_WEB} y pueden tener hora_fin &lt; hora_inicio
        // sobre la misma fecha_novedad (p. ej. hasta medianoche); ahí {@see calcularHorasEntre} suma un día.
        if (
            $this->scenario === self::SCENARIO_SOLICITUD_HORAS_AUTO
            && $hi !== null && $hf !== null && $hi !== '' && $hf !== ''
        ) {
            if (strcmp($hf, $hi) <= 0) {
                $this->addError(
                    'hora_fin',
                    Yii::t('app', 'La hora final debe ser posterior a la hora inicial (mismo día; no puede ser anterior ni igual).')
                );

                return;
            }
        }

        $this->normalizarHorasYCalcular();
        if ($this->horas_calculadas === null) {
            $this->addError('hora_fin', Yii::t('app', 'No se pudo calcular la duración; revise fecha y horas.'));

            return;
        }
        if ($this->horas_calculadas <= 0) {
            $this->addError('hora_fin', Yii::t('app', 'La hora final debe ser posterior a la hora inicial.'));
        }
    }

    public function attributeLabels(): array
    {
        $labels = [
            'id' => Yii::t('app', 'ID'),
            'empresa_id' => Yii::t('app', 'Empresa'),
            'created_by' => Yii::t('app', 'Usuario creación'),
            'profile_id' => Yii::t('app', 'Empleado'),
            'concepto_id' => Yii::t('app', 'Concepto'),
            'descripcion' => Yii::t('app', 'Descripción'),
            'novedad_tipo_id' => Yii::t('app', 'Tipo'),
            'estado' => Yii::t('app', 'Estado flujo'),
            'estado_carga' => Yii::t('app', 'Estado carga'),
            'datos' => Yii::t('app', 'Datos'),
            'schema_snapshot' => Yii::t('app', 'Schema snapshot'),
            'alertas' => Yii::t('app', 'Alertas'),
            'paso_actual_id' => Yii::t('app', 'Paso actual'),
            'es_masivo' => Yii::t('app', 'Es masivo'),
            'lote_masivo_id' => Yii::t('app', 'Lote masivo'),
            'fecha_novedad' => Yii::t('app', 'Fecha novedad'),
            'hora_inicio' => Yii::t('app', 'Hora inicial'),
            'hora_fin' => Yii::t('app', 'Hora final'),
            'horas_calculadas' => Yii::t('app', 'Horas calculadas'),
            'periodo_nomina' => Yii::t('app', 'Periodo nómina'),
            'anio' => Yii::t('app', 'Año'),
            'importe' => Yii::t('app', 'Importe'),
            'novedad_centro_costo_id' => Yii::t('app', 'Centro de costo'),
            'novedad_centro_utilidad_id' => Yii::t('app', 'Centro de utilidad'),
            'novedad_origen_id' => Yii::t('app', 'Novedad de origen'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
        if (static::hasNovedadFlujoIdColumn()) {
            $labels['novedad_flujo_id'] = Yii::t('app', 'Flujo de novedad');
        }
        return $labels;
    }

    public function beforeValidate(): bool
    {
        if (!parent::beforeValidate()) {
            return false;
        }
        $this->normalizarHorasYCalcular();

        return true;
    }

    public function beforeSave($insert): bool
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        if ($insert && $this->created_by === null && !Yii::$app->user->isGuest) {
            $this->created_by = Yii::$app->user->id;
        }
        $this->normalizarHorasYCalcular();

        return true;
    }

    /**
     * Normaliza TIME a H:i:s y asigna {@see $horas_calculadas} si hay fecha y ambas horas.
     */
    public function normalizarHorasYCalcular(): void
    {
        $this->hora_inicio = self::normalizarTimeString($this->hora_inicio);
        $this->hora_fin = self::normalizarTimeString($this->hora_fin);

        if (
            $this->fecha_novedad === null || $this->fecha_novedad === ''
            || $this->hora_inicio === null || $this->hora_inicio === ''
            || $this->hora_fin === null || $this->hora_fin === ''
        ) {
            $this->horas_calculadas = null;

            return;
        }

        $calc = self::calcularHorasEntre(
            (string) $this->fecha_novedad,
            (string) $this->hora_inicio,
            (string) $this->hora_fin
        );
        $this->horas_calculadas = $calc;
    }

    public static function normalizarTimeString(?string $t): ?string
    {
        if ($t === null || trim($t) === '') {
            return null;
        }
        $t = trim($t);
        if (preg_match('/^\d{2}:\d{2}$/', $t)) {
            return $t . ':00';
        }
        if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $t)) {
            return $t;
        }

        return $t;
    }

    /**
     * @return float|null horas decimales; si hora_fin &lt; hora_inicio se asume día siguiente
     */
    public static function calcularHorasEntre(string $fechaYmd, string $horaInicio, string $horaFin): ?float
    {
        $hi = self::normalizarTimeString($horaInicio);
        $hf = self::normalizarTimeString($horaFin);
        if ($hi === null || $hf === null) {
            return null;
        }
        try {
            $start = new \DateTimeImmutable($fechaYmd . ' ' . $hi);
            $end = new \DateTimeImmutable($fechaYmd . ' ' . $hf);
        } catch (\Exception $e) {
            return null;
        }
        if ($end < $start) {
            $end = $end->modify('+1 day');
        }
        $secs = $end->getTimestamp() - $start->getTimestamp();
        if ($secs < 0) {
            return null;
        }

        return round($secs / 3600, 2);
    }

    public function getConcepto(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadConcepto::class, ['id' => 'concepto_id']);
    }

    /** Empleado (FK `profile_id` → `profile.user_id`). */
    public function getProfile(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Profile::class, ['user_id' => 'profile_id']);
    }

    public function getEmpresa(): \yii\db\ActiveQuery
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    public function getNovedadTipo(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadTipo::class, ['id' => 'novedad_tipo_id']);
    }

    public function getCreador(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getNovedadFlujo(): \yii\db\ActiveQuery
    {
        if (!static::hasNovedadFlujoIdColumn()) {
            return $this->hasOne(NovedadFlujo::class, ['id' => 'id'])->andWhere('0=1');
        }
        return $this->hasOne(NovedadFlujo::class, ['id' => 'novedad_flujo_id']);
    }

    public function getPasoActual(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadStep::class, ['id' => 'paso_actual_id']);
    }

    public function getNovedadCentroCosto(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadCentroCosto::class, ['id' => 'novedad_centro_costo_id']);
    }

    public function getNovedadCentroUtilidad(): \yii\db\ActiveQuery
    {
        return $this->hasOne(NovedadCentroUtilidad::class, ['id' => 'novedad_centro_utilidad_id']);
    }

    public function getNovedadOrigen(): \yii\db\ActiveQuery
    {
        return $this->hasOne(self::class, ['id' => 'novedad_origen_id']);
    }

    public function getNovedadHorasDetalles(): \yii\db\ActiveQuery
    {
        return $this->hasMany(NovedadHorasDetalle::class, ['novedad_id' => 'id']);
    }

    /**
     * Edición y eliminación desde administración / listado solo si la carga sigue en borrador.
     */
    public function isEstadoCargaBorrador(): bool
    {
        return (string) ($this->estado_carga ?? '') === self::ESTADO_CARGA_BORRADOR;
    }

    public static function optsEstado(): array
    {
        return [
            self::ESTADO_BORRADOR => Yii::t('app', 'borrador'),
            self::ESTADO_PENDIENTE => Yii::t('app', 'pendiente'),
            self::ESTADO_APROBADA => Yii::t('app', 'aprobada'),
            self::ESTADO_RECHAZADA => Yii::t('app', 'rechazada'),
        ];
    }

    /**
     * Etiqueta legible del estado de flujo (para listados y badges).
     */
    public function displayEstado(): string
    {
        $items = self::optsEstado();
        $e = (string) $this->estado;

        return $items[$e] ?? $e;
    }

    /**
     * Clase Bootstrap (variante badge-soft-*) según estado de la novedad.
     */
    public static function estadoBadgeSoftClass(string $estado): string
    {
        switch ($estado) {
            case self::ESTADO_APROBADA:
                return 'success';
            case self::ESTADO_RECHAZADA:
                return 'danger';
            case self::ESTADO_PENDIENTE:
                return 'warning';
            case self::ESTADO_BORRADOR:
            default:
                return 'secondary';
        }
    }

    public function puedeCrearSegunTipo(): bool
    {
        if (!Yii::$app instanceof WebApplication || Yii::$app->user->isGuest) {
            return false;
        }
        $tipo = $this->novedadTipo;
        if ($tipo === null || !(int) $tipo->activo) {
            return false;
        }
        $perm = $tipo->getPermisoCrearNombre();

        return Yii::$app->user->can($perm);
    }
}
