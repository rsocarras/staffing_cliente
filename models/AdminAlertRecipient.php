<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class AdminAlertRecipient extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'admin_alert_recipient';
    }

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function rules(): array
    {
        return [
            [['read_at'], 'default', 'value' => null],
            [['alert_id', 'user_id'], 'required'],
            [['alert_id', 'user_id', 'read_at', 'created_at'], 'integer'],
            [['alert_id', 'user_id'], 'unique', 'targetAttribute' => ['alert_id', 'user_id']],
        ];
    }
}
