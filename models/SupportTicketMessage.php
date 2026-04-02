<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class SupportTicketMessage extends ActiveRecord
{
    public const AUTHOR_CLIENT = 'client';
    public const AUTHOR_STAFFING = 'staffing';
    public const AUTHOR_SYSTEM = 'system';

    public static function tableName(): string
    {
        return 'support_ticket_message';
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
            [['author_user_id'], 'default', 'value' => null],
            [['is_internal'], 'default', 'value' => 0],
            [['ticket_id', 'author_account_type', 'body'], 'required'],
            [['ticket_id', 'author_user_id', 'is_internal', 'created_at'], 'integer'],
            [['body'], 'string'],
            [['author_account_type'], 'in', 'range' => [self::AUTHOR_CLIENT, self::AUTHOR_STAFFING, self::AUTHOR_SYSTEM]],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupportTicket::class, 'targetAttribute' => ['ticket_id' => 'id']],
            [['author_user_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_user_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'body' => Yii::t('app', 'Mensaje'),
        ];
    }

    public function getTicket()
    {
        return $this->hasOne(SupportTicket::class, ['id' => 'ticket_id']);
    }

    public function getAuthorUser()
    {
        return $this->hasOne(User::class, ['id' => 'author_user_id']);
    }
}
