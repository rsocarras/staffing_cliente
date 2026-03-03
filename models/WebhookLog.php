<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property int|null $requisicion_id
 * @property int|null $profile_id
 * @property string $evento
 * @property string $url
 * @property string $method
 * @property string|null $request_body
 * @property int|null $response_code
 * @property string|null $response_body
 * @property string|null $error_message
 * @property int $intentos
 * @property string $created_at
 *
 * @property Requisicion $requisicion
 * @property Profile $profile
 */
class WebhookLog extends ActiveRecord
{
    public static function tableName()
    {
        return 'webhook_log';
    }

    public function rules()
    {
        return [
            [['evento', 'url'], 'required'],
            [['requisicion_id', 'profile_id', 'response_code', 'intentos'], 'integer'],
            [['request_body', 'response_body'], 'string'],
            [['evento'], 'string', 'max' => 80],
            [['url'], 'string', 'max' => 500],
            [['method'], 'string', 'max' => 10],
            [['error_message'], 'string', 'max' => 500],
        ];
    }

    public function getRequisicion()
    {
        return $this->hasOne(Requisicion::class, ['id' => 'requisicion_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'profile_id']);
    }

    public static function registrar($evento, $url, $payload, $responseCode = null, $responseBody = null, $error = null, $requisicionId = null, $profileId = null)
    {
        $log = new static();
        $log->evento = $evento;
        $log->url = $url;
        $log->method = 'POST';
        $log->request_body = is_string($payload) ? $payload : json_encode($payload);
        $log->response_code = $responseCode;
        $log->response_body = is_string($responseBody) ? $responseBody : ($responseBody ? json_encode($responseBody) : null);
        $log->error_message = $error;
        $log->requisicion_id = $requisicionId;
        $log->profile_id = $profileId;
        $log->save(false);
        return $log;
    }
}
