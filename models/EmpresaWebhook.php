<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa_webhook".
 *
 * @property int $id
 * @property int $empresa_id
 * @property string $event_name
 * @property string $url
 * @property string|null $secret
 * @property int $activo
 * @property string|null $headers_json
 * @property string $created_at
 */
class EmpresaWebhook extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'empresa_webhook';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['secret', 'headers_json'], 'default', 'value' => null],
            [['activo'], 'default', 'value' => 1],
            [['empresa_id', 'event_name', 'url'], 'required'],
            [['empresa_id', 'activo'], 'integer'],
            [['headers_json', 'created_at'], 'safe'],
            [['event_name'], 'string', 'max' => 120],
            [['url'], 'string', 'max' => 500],
            [['secret'], 'string', 'max' => 190],
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
            'event_name' => 'Event Name',
            'url' => 'Url',
            'secret' => 'Secret',
            'activo' => 'Activo',
            'headers_json' => 'Headers Json',
            'created_at' => 'Created At',
        ];
    }

}
