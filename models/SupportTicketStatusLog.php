<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class SupportTicketStatusLog extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'support_ticket_status_log';
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
            [['from_status', 'changed_by_user_id', 'comment'], 'default', 'value' => null],
            [['ticket_id', 'to_status'], 'required'],
            [['ticket_id', 'changed_by_user_id', 'created_at'], 'integer'],
            [['comment'], 'string'],
            [['from_status', 'to_status'], 'string', 'max' => 30],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupportTicket::class, 'targetAttribute' => ['ticket_id' => 'id']],
            [['changed_by_user_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => User::class, 'targetAttribute' => ['changed_by_user_id' => 'id']],
        ];
    }

    public function getTicket()
    {
        return $this->hasOne(SupportTicket::class, ['id' => 'ticket_id']);
    }

    public function getChangedBy()
    {
        return $this->hasOne(User::class, ['id' => 'changed_by_user_id']);
    }
}
