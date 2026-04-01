<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class AdminAlert extends ActiveRecord
{
    public const TYPE_TICKET_CREATED = 'support_ticket_created';
    public const TYPE_TICKET_REPLY = 'support_ticket_reply';

    public const ENTITY_SUPPORT_TICKET = 'support_ticket';

    public static function tableName(): string
    {
        return 'admin_alert';
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
            [['entity_type', 'entity_id', 'payload_json', 'created_by_user_id'], 'default', 'value' => null],
            [['type', 'title', 'message'], 'required'],
            [['message', 'payload_json'], 'string'],
            [['entity_id', 'created_by_user_id', 'created_at'], 'integer'],
            [['type', 'entity_type'], 'string', 'max' => 50],
            [['title'], 'string', 'max' => 190],
        ];
    }
}
