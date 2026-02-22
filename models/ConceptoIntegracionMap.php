<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "concepto_integracion_map".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $provider
 * @property int $concepto_id
 * @property string $remote_code
 * @property string|null $remote_name
 * @property string|null $config_json
 * @property string $created_at
 *
 * @property MaestrosConceptos $concepto
 * @property Empresas $empresa
 */
class ConceptoIntegracionMap extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const PROVIDER_TEMPORAPP = 'temporapp';
    const PROVIDER_OTRO = 'otro';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'concepto_integracion_map';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['remote_name', 'config_json'], 'default', 'value' => null],
            [['provider'], 'default', 'value' => 'temporapp'],
            [['empresa_id', 'concepto_id', 'remote_code'], 'required'],
            [['empresa_id', 'concepto_id'], 'integer'],
            [['provider'], 'string'],
            [['config_json', 'created_at'], 'safe'],
            [['remote_code'], 'string', 'max' => 80],
            [['remote_name'], 'string', 'max' => 190],
            ['provider', 'in', 'range' => array_keys(self::optsProvider())],
            [['empresa_id', 'provider', 'concepto_id'], 'unique', 'targetAttribute' => ['empresa_id', 'provider', 'concepto_id']],
            [['concepto_id'], 'exist', 'skipOnError' => true, 'targetClass' => MaestrosConceptos::class, 'targetAttribute' => ['concepto_id' => 'id']],
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
            'provider' => 'Provider',
            'concepto_id' => 'Concepto ID',
            'remote_code' => 'Remote Code',
            'remote_name' => 'Remote Name',
            'config_json' => 'Config Json',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Concepto]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConcepto()
    {
        return $this->hasOne(MaestrosConceptos::class, ['id' => 'concepto_id']);
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
     * column provider ENUM value labels
     * @return string[]
     */
    public static function optsProvider()
    {
        return [
            self::PROVIDER_TEMPORAPP => 'temporapp',
            self::PROVIDER_OTRO => 'otro',
        ];
    }

    /**
     * @return string
     */
    public function displayProvider()
    {
        return self::optsProvider()[$this->provider];
    }

    /**
     * @return bool
     */
    public function isProviderTemporapp()
    {
        return $this->provider === self::PROVIDER_TEMPORAPP;
    }

    public function setProviderToTemporapp()
    {
        $this->provider = self::PROVIDER_TEMPORAPP;
    }

    /**
     * @return bool
     */
    public function isProviderOtro()
    {
        return $this->provider === self::PROVIDER_OTRO;
    }

    public function setProviderToOtro()
    {
        $this->provider = self::PROVIDER_OTRO;
    }
}
