<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "integration_log".
 *
 * @property int $id
 * @property int $empresa_id
 * @property int $empresa_integration_id
 * @property string|null $request_id
 * @property string|null $endpoint
 * @property string|null $method
 * @property int|null $status_code
 * @property int|null $duration_ms
 * @property string|null $request_json
 * @property string|null $response_json
 * @property string $created_at
 *
 * @property Empresas $empresa
 * @property EmpresaIntegration $empresaIntegration
 */
class IntegrationLog extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'integration_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'endpoint', 'method', 'status_code', 'duration_ms', 'request_json', 'response_json'], 'default', 'value' => null],
            [['empresa_id', 'empresa_integration_id'], 'required'],
            [['empresa_id', 'empresa_integration_id', 'status_code', 'duration_ms'], 'integer'],
            [['request_json', 'response_json', 'created_at'], 'safe'],
            [['request_id'], 'string', 'max' => 80],
            [['endpoint'], 'string', 'max' => 255],
            [['method'], 'string', 'max' => 10],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresa_id' => 'id']],
            [['empresa_integration_id'], 'exist', 'skipOnError' => true, 'targetClass' => EmpresaIntegration::class, 'targetAttribute' => ['empresa_integration_id' => 'id']],
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
            'empresa_integration_id' => 'Empresa Integration ID',
            'request_id' => 'Request ID',
            'endpoint' => 'Endpoint',
            'method' => 'Method',
            'status_code' => 'Status Code',
            'duration_ms' => 'Duration Ms',
            'request_json' => 'Request Json',
            'response_json' => 'Response Json',
            'created_at' => 'Created At',
        ];
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
     * Gets query for [[EmpresaIntegration]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresaIntegration()
    {
        return $this->hasOne(EmpresaIntegration::class, ['id' => 'empresa_integration_id']);
    }

}
