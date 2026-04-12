<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class SupportTicket extends ActiveRecord
{
    public const STATUS_NEW = 'nuevo';
    public const STATUS_OPEN = 'abierto';
    public const STATUS_IN_PROGRESS = 'en_gestion';
    public const STATUS_PENDING_CUSTOMER = 'pendiente_cliente';
    public const STATUS_RESOLVED = 'resuelto';
    public const STATUS_CLOSED = 'cerrado';

    public const PRIORITY_LOW = 'baja';
    public const PRIORITY_MEDIUM = 'media';
    public const PRIORITY_HIGH = 'alta';
    public const PRIORITY_CRITICAL = 'critica';

    public static function tableName(): string
    {
        return 'support_ticket';
    }

    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
            ],
        ];
    }

    public function scenarios(): array
    {
        $scenarios = parent::scenarios();
        $scenarios['default'] = [
            'empresa_cliente_id',
            'subject',
            'description',
            'priority',
        ];

        return $scenarios;
    }

    public function rules(): array
    {
        return [
            [['ticket_number', 'empresa_cliente_id', 'assigned_to_user_id', 'last_message_at', 'closed_at'], 'default', 'value' => null],
            [['priority'], 'default', 'value' => self::PRIORITY_MEDIUM],
            [['status'], 'default', 'value' => self::STATUS_NEW],
            [['empresas_id', 'created_by_user_id', 'subject', 'description'], 'required'],
            [['empresas_id', 'empresa_cliente_id', 'created_by_user_id', 'assigned_to_user_id', 'last_message_at', 'closed_at', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['subject'], 'string', 'max' => 190],
            [['ticket_number'], 'string', 'max' => 32],
            [['ticket_number'], 'unique'],
            [['priority'], 'in', 'range' => array_keys(self::priorityOptions())],
            [['status'], 'in', 'range' => array_keys(self::statusOptions())],
            [['empresas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresas::class, 'targetAttribute' => ['empresas_id' => 'id']],
            [['empresa_cliente_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => EmpresaCliente::class, 'targetAttribute' => ['empresa_cliente_id' => 'id']],
            [['created_by_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by_user_id' => 'id']],
            [['assigned_to_user_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => User::class, 'targetAttribute' => ['assigned_to_user_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'ticket_number' => Yii::t('app', 'Ticket'),
            'empresa_cliente_id' => Yii::t('app', 'Cliente'),
            'subject' => Yii::t('app', 'Asunto'),
            'description' => Yii::t('app', 'Descripción'),
            'priority' => Yii::t('app', 'Prioridad'),
            'status' => Yii::t('app', 'Estado'),
        ];
    }

    public function afterSave($insert, $changedAttributes): void
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert && empty($this->ticket_number)) {
            $number = self::formatTicketNumber((int) $this->id);
            $this->updateAttributes(['ticket_number' => $number]);
            $this->ticket_number = $number;
        }
    }

    public static function formatTicketNumber(int $id): string
    {
        return 'TK-' . str_pad((string) $id, 6, '0', STR_PAD_LEFT);
    }

    public static function statusOptions(): array
    {
        return [
            self::STATUS_NEW => Yii::t('app', 'Nuevo'),
            self::STATUS_OPEN => Yii::t('app', 'Abierto'),
            self::STATUS_IN_PROGRESS => Yii::t('app', 'En gestión'),
            self::STATUS_PENDING_CUSTOMER => Yii::t('app', 'Pendiente cliente'),
            self::STATUS_RESOLVED => Yii::t('app', 'Resuelto'),
            self::STATUS_CLOSED => Yii::t('app', 'Cerrado'),
        ];
    }

    public static function priorityOptions(): array
    {
        return [
            self::PRIORITY_LOW => Yii::t('app', 'Baja'),
            self::PRIORITY_MEDIUM => Yii::t('app', 'Media'),
            self::PRIORITY_HIGH => Yii::t('app', 'Alta'),
            self::PRIORITY_CRITICAL => Yii::t('app', 'Crítica'),
        ];
    }

    public function displayStatus(): string
    {
        return self::statusOptions()[$this->status] ?? (string) $this->status;
    }

    public function displayPriority(): string
    {
        return self::priorityOptions()[$this->priority] ?? (string) $this->priority;
    }

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'bg-primary',
            self::STATUS_OPEN => 'bg-info text-dark',
            self::STATUS_IN_PROGRESS => 'bg-warning text-dark',
            self::STATUS_PENDING_CUSTOMER => 'bg-secondary',
            self::STATUS_RESOLVED => 'bg-success',
            self::STATUS_CLOSED => 'bg-dark',
            default => 'bg-light text-dark',
        };
    }

    public function priorityBadgeClass(): string
    {
        return match ($this->priority) {
            self::PRIORITY_LOW => 'bg-light text-dark',
            self::PRIORITY_MEDIUM => 'bg-info text-dark',
            self::PRIORITY_HIGH => 'bg-warning text-dark',
            self::PRIORITY_CRITICAL => 'bg-danger',
            default => 'bg-light text-dark',
        };
    }

    public function isClosed(): bool
    {
        return in_array($this->status, [self::STATUS_RESOLVED, self::STATUS_CLOSED], true);
    }

    public function getEmpresa()
    {
        return $this->hasOne(Empresas::class, ['id' => 'empresas_id']);
    }

    public function getEmpresaCliente()
    {
        return $this->hasOne(EmpresaCliente::class, ['id' => 'empresa_cliente_id']);
    }

    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by_user_id']);
    }

    public function getAssignedTo()
    {
        return $this->hasOne(User::class, ['id' => 'assigned_to_user_id']);
    }

    public function getMessages()
    {
        return $this->hasMany(SupportTicketMessage::class, ['ticket_id' => 'id'])->orderBy(['created_at' => SORT_ASC, 'id' => SORT_ASC]);
    }

    public function getStatusLogs()
    {
        return $this->hasMany(SupportTicketStatusLog::class, ['ticket_id' => 'id'])->orderBy(['created_at' => SORT_DESC, 'id' => SORT_DESC]);
    }
}
