<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "novedad".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $profile_id
 * @property int $concepto_id
 * @property int $novedad_tipo_id
 * @property string $estado
 * @property string $datos
 * @property string|null $schema_snapshot
 * @property string|null $alertas
 * @property int|null $paso_actual_id
 * @property int $es_masivo
 * @property int|null $lote_masivo_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property NovedadConcepto $concepto
 * @property Empresas $empresa
 * @property NovedadTipo $novedadTipo
 */
class Novedad extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_BORRADOR = 'borrador';
    const ESTADO_PENDIENTE = 'pendiente';
    const ESTADO_APROBADA = 'aprobada';
    const ESTADO_RECHAZADA = 'rechazada';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'novedad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['schema_snapshot', 'alertas', 'paso_actual_id', 'lote_masivo_id'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 'borrador'],
            [['updated_at'], 'default', 'value' => 0],
            [['empresa_id', 'profile_id', 'concepto_id', 'novedad_tipo_id', 'datos'], 'required'],
            [['empresa_id', 'profile_id', 'concepto_id', 'novedad_tipo_id', 'paso_actual_id', 'es_masivo', 'lote_masivo_id', 'created_at', 'updated_at'], 'integer'],
            [['estado'], 'string'],
            [['datos', 'schema_snapshot', 'alertas'], 'safe'],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
            [['concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadConcepto::class, 'targetAttribute' => ['concepto_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['novedad_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => NovedadTipo::class, 'targetAttribute' => ['novedad_tipo_id' => 'id']],
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
            'profile_id' => 'Profile ID',
            'concepto_id' => 'Concepto ID',
            'novedad_tipo_id' => 'Novedad Tipo ID',
            'estado' => 'Estado',
            'datos' => 'Datos',
            'schema_snapshot' => 'Schema Snapshot',
            'alertas' => 'Alertas',
            'paso_actual_id' => 'Paso Actual ID',
            'es_masivo' => 'Es Masivo',
            'lote_masivo_id' => 'Lote Masivo ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Concepto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConcepto()
    {
        return $this->hasOne(NovedadConcepto::class, ['id' => 'concepto_id']);
    }

    /**
     * Gets query for [[Empresa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresa_id']);
    }

    /**
     * Gets query for [[NovedadTipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNovedadTipo()
    {
        return $this->hasOne(NovedadTipo::class, ['id' => 'novedad_tipo_id']);
    }


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_BORRADOR => 'borrador',
            self::ESTADO_PENDIENTE => 'pendiente',
            self::ESTADO_APROBADA => 'aprobada',
            self::ESTADO_RECHAZADA => 'rechazada',
        ];
    }

    /**
     * @return string
     */
    public function displayEstado()
    {
        return self::optsEstado()[$this->estado];
    }

    /**
     * @return bool
     */
    public function isEstadoBorrador()
    {
        return $this->estado === self::ESTADO_BORRADOR;
    }

    public function setEstadoToBorrador()
    {
        $this->estado = self::ESTADO_BORRADOR;
    }

    /**
     * @return bool
     */
    public function isEstadoPendiente()
    {
        return $this->estado === self::ESTADO_PENDIENTE;
    }

    public function setEstadoToPendiente()
    {
        $this->estado = self::ESTADO_PENDIENTE;
    }

    /**
     * @return bool
     */
    public function isEstadoAprobada()
    {
        return $this->estado === self::ESTADO_APROBADA;
    }

    public function setEstadoToAprobada()
    {
        $this->estado = self::ESTADO_APROBADA;
    }

    /**
     * @return bool
     */
    public function isEstadoRechazada()
    {
        return $this->estado === self::ESTADO_RECHAZADA;
    }

    public function setEstadoToRechazada()
    {
        $this->estado = self::ESTADO_RECHAZADA;
    }
}
