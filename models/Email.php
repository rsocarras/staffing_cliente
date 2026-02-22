<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "email".
 *
 * @property int $id
 * @property int|null $empresa_id
 * @property string $to_email
 * @property string|null $cc_email
 * @property string|null $bcc_email
 * @property string $subject
 * @property string $body_html
 * @property string $status
 * @property string|null $provider
 * @property string|null $external_id
 * @property string|null $error_message
 * @property string $created_at
 * @property string|null $sent_at
 */
class Email extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const STATUS_QUEUED = 'queued';
    const STATUS_SENT = 'sent';
    const STATUS_FAILED = 'failed';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['empresa_id', 'cc_email', 'bcc_email', 'provider', 'external_id', 'error_message', 'sent_at'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'queued'],
            [['empresa_id'], 'integer'],
            [['to_email', 'subject', 'body_html'], 'required'],
            [['body_html', 'status'], 'string'],
            [['created_at', 'sent_at'], 'safe'],
            [['to_email', 'cc_email', 'bcc_email', 'subject', 'error_message'], 'string', 'max' => 255],
            [['provider'], 'string', 'max' => 80],
            [['external_id'], 'string', 'max' => 190],
            ['status', 'in', 'range' => array_keys(self::optsStatus())],
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
            'to_email' => 'To Email',
            'cc_email' => 'Cc Email',
            'bcc_email' => 'Bcc Email',
            'subject' => 'Subject',
            'body_html' => 'Body Html',
            'status' => 'Status',
            'provider' => 'Provider',
            'external_id' => 'External ID',
            'error_message' => 'Error Message',
            'created_at' => 'Created At',
            'sent_at' => 'Sent At',
        ];
    }


    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_QUEUED => 'queued',
            self::STATUS_SENT => 'sent',
            self::STATUS_FAILED => 'failed',
        ];
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusQueued()
    {
        return $this->status === self::STATUS_QUEUED;
    }

    public function setStatusToQueued()
    {
        $this->status = self::STATUS_QUEUED;
    }

    /**
     * @return bool
     */
    public function isStatusSent()
    {
        return $this->status === self::STATUS_SENT;
    }

    public function setStatusToSent()
    {
        $this->status = self::STATUS_SENT;
    }

    /**
     * @return bool
     */
    public function isStatusFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }

    public function setStatusToFailed()
    {
        $this->status = self::STATUS_FAILED;
    }
}
