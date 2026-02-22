<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "archivo_link".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $archivo_id
 * @property string $entidad_type
 * @property int $entidad_id
 * @property string|null $etiqueta
 * @property string $created_at
 *
 * @property Archivos $archivo
 * @property Empresas $empresa
 */
class ArchivoLink extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ENTIDAD_TYPE_EMPLEADO = 'empleado';
    const ENTIDAD_TYPE_CONTRATO = 'contrato';
    const ENTIDAD_TYPE_NOVEDAD = 'novedad';
    const ENTIDAD_TYPE_SS_AUSENTISMO = 'ss_ausentismo';
    const ENTIDAD_TYPE_NOMINA = 'nomina';
    const ENTIDAD_TYPE_OTRO = 'otro';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivo_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['etiqueta'], 'default', 'value' => null],
            [['empresa_id', 'archivo_id', 'entidad_type', 'entidad_id'], 'required'],
            [['empresa_id', 'archivo_id', 'entidad_id'], 'integer'],
            [['entidad_type'], 'string'],
            [['created_at'], 'safe'],
            [['etiqueta'], 'string', 'max' => 80],
            ['entidad_type', 'in', 'range' => array_keys(self::optsEntidadType())],
            [['archivo_id', 'entidad_type', 'entidad_id'], 'unique', 'targetAttribute' => ['archivo_id', 'entidad_type', 'entidad_id']],
            [['archivo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Archivos::class, 'targetAttribute' => ['archivo_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
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
            'archivo_id' => 'Archivo ID',
            'entidad_type' => 'Entidad Type',
            'entidad_id' => 'Entidad ID',
            'etiqueta' => 'Etiqueta',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Archivo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivo()
    {
        return $this->hasOne(Archivos::class, ['id' => 'archivo_id']);
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
     * column entidad_type ENUM value labels
     * @return string[]
     */
    public static function optsEntidadType()
    {
        return [
            self::ENTIDAD_TYPE_EMPLEADO => 'empleado',
            self::ENTIDAD_TYPE_CONTRATO => 'contrato',
            self::ENTIDAD_TYPE_NOVEDAD => 'novedad',
            self::ENTIDAD_TYPE_SS_AUSENTISMO => 'ss_ausentismo',
            self::ENTIDAD_TYPE_NOMINA => 'nomina',
            self::ENTIDAD_TYPE_OTRO => 'otro',
        ];
    }

    /**
     * @return string
     */
    public function displayEntidadType()
    {
        return self::optsEntidadType()[$this->entidad_type];
    }

    /**
     * @return bool
     */
    public function isEntidadTypeEmpleado()
    {
        return $this->entidad_type === self::ENTIDAD_TYPE_EMPLEADO;
    }

    public function setEntidadTypeToEmpleado()
    {
        $this->entidad_type = self::ENTIDAD_TYPE_EMPLEADO;
    }

    /**
     * @return bool
     */
    public function isEntidadTypeContrato()
    {
        return $this->entidad_type === self::ENTIDAD_TYPE_CONTRATO;
    }

    public function setEntidadTypeToContrato()
    {
        $this->entidad_type = self::ENTIDAD_TYPE_CONTRATO;
    }

    /**
     * @return bool
     */
    public function isEntidadTypeNovedad()
    {
        return $this->entidad_type === self::ENTIDAD_TYPE_NOVEDAD;
    }

    public function setEntidadTypeToNovedad()
    {
        $this->entidad_type = self::ENTIDAD_TYPE_NOVEDAD;
    }

    /**
     * @return bool
     */
    public function isEntidadTypeSsausentismo()
    {
        return $this->entidad_type === self::ENTIDAD_TYPE_SS_AUSENTISMO;
    }

    public function setEntidadTypeToSsausentismo()
    {
        $this->entidad_type = self::ENTIDAD_TYPE_SS_AUSENTISMO;
    }

    /**
     * @return bool
     */
    public function isEntidadTypeNomina()
    {
        return $this->entidad_type === self::ENTIDAD_TYPE_NOMINA;
    }

    public function setEntidadTypeToNomina()
    {
        $this->entidad_type = self::ENTIDAD_TYPE_NOMINA;
    }

    /**
     * @return bool
     */
    public function isEntidadTypeOtro()
    {
        return $this->entidad_type === self::ENTIDAD_TYPE_OTRO;
    }

    public function setEntidadTypeToOtro()
    {
        $this->entidad_type = self::ENTIDAD_TYPE_OTRO;
    }
}
