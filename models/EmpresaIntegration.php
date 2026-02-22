<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa_integration".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $provider
 * @property string $base_url
 * @property string|null $username
 * @property resource|null $password_enc
 * @property string|null $token
 * @property int $activo
 * @property string|null $config_json
 * @property string $created_at
 * @property string $updated_at
 *
 * @property IntegrationLog[] $integrationLogs
 */
class EmpresaIntegration extends \yii\db\ActiveRecord
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
        return 'empresa_integration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password_enc', 'token', 'config_json'], 'default', 'value' => null],
            [['provider'], 'default', 'value' => 'temporapp'],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'base_url'], 'required'],
            [['empresa_id', 'activo'], 'integer'],
            [['provider'], 'string'],
            [['config_json', 'created_at', 'updated_at'], 'safe'],
            [['base_url', 'password_enc', 'token'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 190],
            ['provider', 'in', 'range' => array_keys(self::optsProvider())],
            [['empresa_id', 'provider'], 'unique', 'targetAttribute' => ['empresa_id', 'provider']],
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
            'base_url' => 'Base Url',
            'username' => 'Username',
            'password_enc' => 'Password Enc',
            'token' => 'Token',
            'activo' => 'Activo',
            'config_json' => 'Config Json',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[IntegrationLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIntegrationLogs()
    {
        return $this->hasMany(IntegrationLog::class, ['empresa_integration_id' => 'id']);
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
