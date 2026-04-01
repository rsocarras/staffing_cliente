<?php

namespace app\services;

use app\models\AdminAlert;
use app\models\AdminAlertRecipient;
use app\models\Empresas;
use app\models\Profile;
use app\models\SupportTicket;
use app\models\SupportTicketMessage;
use app\models\SupportTicketStatusLog;
use app\models\User;
use Yii;
use yii\db\Expression;
use yii\db\Transaction;
use yii\web\NotFoundHttpException;

class SupportTicketService
{
    public function createTicket(int $empresaId, int $userId, array $attributes): SupportTicket
    {
        $ticket = new SupportTicket();
        $ticket->scenario = 'default';
        $ticket->load($attributes, '');
        $ticket->empresas_id = $empresaId;
        $ticket->created_by_user_id = $userId;
        $ticket->status = SupportTicket::STATUS_NEW;

        $tx = Yii::$app->db->beginTransaction();
        try {
            if (!$ticket->save()) {
                $tx->rollBack();
                return $ticket;
            }

            $message = new SupportTicketMessage([
                'ticket_id' => (int) $ticket->id,
                'author_user_id' => $userId,
                'author_account_type' => SupportTicketMessage::AUTHOR_CLIENT,
                'body' => (string) $ticket->description,
                'is_internal' => 0,
            ]);
            if (!$message->save()) {
                $ticket->addErrors($message->getErrors());
                $tx->rollBack();
                return $ticket;
            }

            $this->createStatusLog($ticket, null, SupportTicket::STATUS_NEW, $userId, 'Ticket creado por cliente.');
            $ticket->updateAttributes(['last_message_at' => time()]);

            $this->dispatchStaffingAlerts(
                $ticket,
                AdminAlert::TYPE_TICKET_CREATED,
                'Nuevo ticket ' . $ticket->ticket_number,
                $this->buildCreatedAlertMessage($ticket)
            );

            $tx->commit();
            return $ticket;
        } catch (\Throwable $e) {
            $this->rollBack($tx);
            throw $e;
        }
    }

    public function addClientReply(SupportTicket $ticket, int $userId, string $body): SupportTicketMessage
    {
        $this->assertClientAccess($ticket);

        $tx = Yii::$app->db->beginTransaction();
        try {
            $message = new SupportTicketMessage([
                'ticket_id' => (int) $ticket->id,
                'author_user_id' => $userId,
                'author_account_type' => SupportTicketMessage::AUTHOR_CLIENT,
                'body' => trim($body),
                'is_internal' => 0,
            ]);

            if (!$message->save()) {
                $this->rollBack($tx);
                return $message;
            }

            if (in_array($ticket->status, [SupportTicket::STATUS_RESOLVED, SupportTicket::STATUS_CLOSED], true)) {
                $previousStatus = $ticket->status;
                $ticket->status = SupportTicket::STATUS_OPEN;
                $ticket->closed_at = null;
                $ticket->save(false, ['status', 'closed_at', 'updated_at']);
                $this->createStatusLog($ticket, $previousStatus, $ticket->status, $userId, 'Reabierto por respuesta del cliente.');
            } else {
                $ticket->touch('updated_at');
            }

            $ticket->updateAttributes(['last_message_at' => time()]);

            $this->dispatchStaffingAlerts(
                $ticket,
                AdminAlert::TYPE_TICKET_REPLY,
                'Nueva respuesta en ' . $ticket->ticket_number,
                $this->buildReplyAlertMessage($ticket, $userId)
            );

            $tx->commit();
            return $message;
        } catch (\Throwable $e) {
            $this->rollBack($tx);
            throw $e;
        }
    }

    public function updateAdminTicket(SupportTicket $ticket, array $attributes, ?int $actorUserId = null, ?string $comment = null): bool
    {
        $ticket->scenario = 'admin_update';
        $previousStatus = (string) $ticket->status;
        $ticket->load($attributes, '');

        if (!$ticket->validate()) {
            return false;
        }

        $tx = Yii::$app->db->beginTransaction();
        try {
            if (in_array($ticket->status, [SupportTicket::STATUS_RESOLVED, SupportTicket::STATUS_CLOSED], true)) {
                $ticket->closed_at = $ticket->closed_at ?: time();
            } elseif ($ticket->closed_at !== null) {
                $ticket->closed_at = null;
            }

            $ticket->save(false);

            if ($previousStatus !== $ticket->status) {
                $this->createStatusLog($ticket, $previousStatus, (string) $ticket->status, $actorUserId, $comment);
            }

            $tx->commit();
            return true;
        } catch (\Throwable $e) {
            $this->rollBack($tx);
            throw $e;
        }
    }

    public function addStaffingReply(SupportTicket $ticket, int $userId, string $body, bool $isInternal = false): SupportTicketMessage
    {
        $tx = Yii::$app->db->beginTransaction();
        try {
            $message = new SupportTicketMessage([
                'ticket_id' => (int) $ticket->id,
                'author_user_id' => $userId,
                'author_account_type' => SupportTicketMessage::AUTHOR_STAFFING,
                'body' => trim($body),
                'is_internal' => $isInternal ? 1 : 0,
            ]);

            if (!$message->save()) {
                $this->rollBack($tx);
                return $message;
            }

            $ticket->updateAttributes(['last_message_at' => time(), 'updated_at' => time()]);
            $tx->commit();
            return $message;
        } catch (\Throwable $e) {
            $this->rollBack($tx);
            throw $e;
        }
    }

    public function assertClientAccess(SupportTicket $ticket): void
    {
        $tenantId = (int) (Yii::$app->user->empresas_id ?? 0);
        if ($tenantId <= 0 || (int) $ticket->empresas_id !== $tenantId) {
            throw new NotFoundHttpException('Ticket no encontrado.');
        }
    }

    private function createStatusLog(SupportTicket $ticket, ?string $from, string $to, ?int $userId, ?string $comment = null): void
    {
        $log = new SupportTicketStatusLog([
            'ticket_id' => (int) $ticket->id,
            'from_status' => $from,
            'to_status' => $to,
            'changed_by_user_id' => $userId,
            'comment' => $comment,
        ]);
        $log->save(false);
    }

    private function dispatchStaffingAlerts(SupportTicket $ticket, string $type, string $title, string $message): void
    {
        $recipientIds = $this->findStaffingRecipientIds();
        if ($recipientIds === []) {
            return;
        }

        $alert = new AdminAlert([
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'entity_type' => AdminAlert::ENTITY_SUPPORT_TICKET,
            'entity_id' => (int) $ticket->id,
            'created_by_user_id' => (int) $ticket->created_by_user_id,
        ]);
        $alert->save(false);

        foreach ($recipientIds as $recipientId) {
            $recipient = new AdminAlertRecipient([
                'alert_id' => (int) $alert->id,
                'user_id' => (int) $recipientId,
            ]);
            $recipient->save(false);
        }
    }

    private function findStaffingRecipientIds(): array
    {
        return User::find()
            ->alias('u')
            ->select('u.id')
            ->andWhere(['u.account_type' => 'staffing'])
            ->andWhere(['u.blocked_at' => null])
            ->orderBy(['u.id' => SORT_ASC])
            ->column();
    }

    private function buildCreatedAlertMessage(SupportTicket $ticket): string
    {
        $empresa = Empresas::findOne((int) $ticket->empresas_id);
        $creatorName = $this->resolveUserDisplayName((int) $ticket->created_by_user_id);
        $empresaName = $empresa ? trim((string) ($empresa->name ?: $empresa->social_name)) : '';
        $prefix = $creatorName !== '' ? $creatorName : 'Un cliente';

        if ($empresaName !== '') {
            return $prefix . ' creó un ticket para ' . $empresaName . ': ' . $ticket->subject;
        }

        return $prefix . ' creó un ticket: ' . $ticket->subject;
    }

    private function buildReplyAlertMessage(SupportTicket $ticket, int $userId): string
    {
        $author = $this->resolveUserDisplayName($userId);
        $prefix = $author !== '' ? $author : 'El cliente';

        return $prefix . ' respondió el ticket ' . $ticket->ticket_number . ': ' . $ticket->subject;
    }

    private function resolveUserDisplayName(int $userId): string
    {
        $profile = Profile::findOne(['user_id' => $userId]);
        if ($profile !== null && trim((string) $profile->name) !== '') {
            return trim((string) $profile->name);
        }

        $user = User::findOne($userId);
        if ($user === null) {
            return '';
        }

        $username = $user->username ?? null;
        return $username !== null ? trim((string) $username) : '';
    }

    private function rollBack(Transaction $transaction): void
    {
        if ($transaction->isActive) {
            $transaction->rollBack();
        }
    }
}
