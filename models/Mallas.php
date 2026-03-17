<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mallas".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $nombre
 * @property string|null $descripcion
 * @property string $tipo
 * @property int $activo
 * @property string|null $config_json
 * @property string $estado_aprobacion
 * @property string|null $motivo_rechazo
 * @property int|null $solicitado_por
 * @property int|null $aprobado_por
 * @property string|null $solicitado_at
 * @property string|null $aprobado_at
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MallaCargoAsignacion[] $mallaCargoAsignacions
 * @property MallaProfileAsignacion[] $mallaProfileAsignacions
 * @property MallasHorarios[] $mallasHorarios
 */
class Mallas extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TIPO_FIJA = 'fija';
    const TIPO_ROTATIVA = 'rotativa';
    const ESTADO_DRAFT = 'draft';
    const ESTADO_PENDIENTE = 'pendiente_aprobacion';
    const ESTADO_APROBADA = 'aprobada';
    const ESTADO_RECHAZADA = 'rechazada';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mallas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'config_json', 'motivo_rechazo', 'solicitado_por', 'aprobado_por', 'solicitado_at', 'aprobado_at'], 'default', 'value' => null],
            [['tipo'], 'default', 'value' => 'fija'],
            [['estado_aprobacion'], 'default', 'value' => self::ESTADO_DRAFT],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'nombre'], 'required'],
            [['empresa_id', 'activo', 'solicitado_por', 'aprobado_por'], 'integer'],
            [['tipo', 'estado_aprobacion'], 'string'],
            [['config_json', 'created_at', 'updated_at', 'solicitado_at', 'aprobado_at'], 'safe'],
            [['nombre'], 'string', 'max' => 190],
            [['descripcion', 'motivo_rechazo'], 'string', 'max' => 255],
            ['tipo', 'in', 'range' => array_keys(self::optsTipo())],
            ['estado_aprobacion', 'in', 'range' => array_keys(self::optsEstadoAprobacion())],
            [['solicitado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['solicitado_por' => 'id']],
            [['aprobado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['aprobado_por' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'tipo' => 'Tipo',
            'activo' => 'Activo',
            'config_json' => 'Config Json',
            'estado_aprobacion' => 'Estado aprobación',
            'motivo_rechazo' => 'Motivo rechazo',
            'solicitado_por' => 'Solicitado por',
            'aprobado_por' => 'Aprobado por',
            'solicitado_at' => 'Solicitado el',
            'aprobado_at' => 'Aprobado el',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[MallasHorarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMallasHorarios()
    {
        return $this->hasMany(MallasHorarios::class, ['malla_id' => 'id'])
            ->orderBy(['dia_semana' => SORT_ASC, 'hora_inicio' => SORT_ASC]);
    }

    public function getMallaCargoAsignacions()
    {
        return $this->hasMany(MallaCargoAsignacion::class, ['malla_id' => 'id']);
    }

    public function getMallaProfileAsignacions()
    {
        return $this->hasMany(MallaProfileAsignacion::class, ['malla_id' => 'id']);
    }


    /**
     * column tipo ENUM value labels
     * @return string[]
     */
    public static function optsTipo()
    {
        return [
            self::TIPO_FIJA => 'fija',
            self::TIPO_ROTATIVA => 'rotativa',
        ];
    }

    public static function optsEstadoAprobacion()
    {
        return [
            self::ESTADO_DRAFT => 'Borrador',
            self::ESTADO_PENDIENTE => 'Pendiente aprobación',
            self::ESTADO_APROBADA => 'Aprobada',
            self::ESTADO_RECHAZADA => 'Rechazada',
        ];
    }

    public function displayEstadoAprobacion()
    {
        $items = self::optsEstadoAprobacion();
        return $items[$this->estado_aprobacion] ?? $this->estado_aprobacion;
    }

    /**
     * @return string
     */
    public function displayTipo()
    {
        return self::optsTipo()[$this->tipo];
    }

    /**
     * @return bool
     */
    public function isTipoFija()
    {
        return $this->tipo === self::TIPO_FIJA;
    }

    public function setTipoToFija()
    {
        $this->tipo = self::TIPO_FIJA;
    }

    /**
     * @return bool
     */
    public function isTipoRotativa()
    {
        return $this->tipo === self::TIPO_ROTATIVA;
    }

    public function setTipoToRotativa()
    {
        $this->tipo = self::TIPO_ROTATIVA;
    }
}
