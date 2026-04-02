<?php

use app\models\SupportTicket;
use app\models\SupportTicketMessage;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\SupportTicket $model */

$this->title = 'Ticket ' . ($model->ticket_number ?: ('#' . $model->id));
$resolveName = static function ($user, string $fallback = 'Sistema'): string {
    if ($user === null) {
        return $fallback;
    }
    $profile = $user->profile ?? null;
    if ($profile !== null && trim((string) $profile->name) !== '') {
        return trim((string) $profile->name);
    }
    return trim((string) ($user->username ?? $fallback)) ?: $fallback;
};
?>

<div class="d-md-flex d-block align-items-center justify-content-between page-breadcrumb mb-3">
    <div class="my-auto mb-2">
        <h2 class="mb-1"><?= Html::encode($this->title) ?></h2>
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-smart-home"></i></a></li>
                <li class="breadcrumb-item"><a href="<?= Url::to(['/support-ticket/index']) ?>">Tickets de soporte</a></li>
                <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
            </ol>
        </nav>
    </div>
    <div class="mb-2">
        <a href="<?= Url::to(['/support-ticket/index']) ?>" class="btn btn-light">Volver</a>
    </div>
</div>

<?php foreach (['success' => 'success', 'error' => 'danger'] as $flashKey => $alertClass): ?>
    <?php if (Yii::$app->session->hasFlash($flashKey)): ?>
        <div class="alert alert-<?= $alertClass ?>"><?= Html::encode(Yii::$app->session->getFlash($flashKey)) ?></div>
    <?php endif; ?>
<?php endforeach; ?>

<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Resumen</h5>
            </div>
            <div class="card-body">
                <p class="mb-2"><span class="text-muted">Asunto:</span><br><strong><?= Html::encode($model->subject) ?></strong></p>
                <p class="mb-2"><span class="text-muted">Cliente:</span><br><?= Html::encode($model->empresaCliente?->nombre ?: 'Sin cliente') ?></p>
                <p class="mb-2"><span class="text-muted">Solicitante:</span><br><?= Html::encode($resolveName($model->createdBy, 'Usuario')) ?></p>
                <p class="mb-2"><span class="text-muted">Prioridad:</span><br><span class="badge <?= Html::encode($model->priorityBadgeClass()) ?>"><?= Html::encode($model->displayPriority()) ?></span></p>
                <p class="mb-2"><span class="text-muted">Estado:</span><br><span class="badge <?= Html::encode($model->statusBadgeClass()) ?>"><?= Html::encode($model->displayStatus()) ?></span></p>
                <p class="mb-0"><span class="text-muted">Última actualización:</span><br><?= Html::encode(Yii::$app->formatter->asRelativeTime((int) $model->updated_at)) ?></p>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Historial de estado</h5>
            </div>
            <div class="card-body">
                <?php if ($model->statusLogs === []): ?>
                    <p class="text-muted mb-0">No hay movimientos registrados.</p>
                <?php else: ?>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($model->statusLogs as $log): ?>
                            <div>
                                <div class="fw-semibold"><?= Html::encode(SupportTicket::statusOptions()[$log->to_status] ?? $log->to_status) ?></div>
                                <?php if ($log->comment): ?>
                                    <div class="text-muted small"><?= Html::encode($log->comment) ?></div>
                                <?php endif; ?>
                                <div class="text-muted small"><?= Html::encode(Yii::$app->formatter->asRelativeTime((int) $log->created_at)) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Conversación</h5>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column gap-3">
                    <?php foreach ($model->messages as $message): ?>
                        <?php
                        /** @var SupportTicketMessage $message */
                        if ((int) $message->is_internal === 1) {
                            continue;
                        }
                        $isClient = $message->author_account_type === SupportTicketMessage::AUTHOR_CLIENT;
                        ?>
                        <div class="border rounded p-3 <?= $isClient ? 'bg-light' : 'bg-white' ?>">
                            <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                <div class="fw-semibold">
                                    <?= Html::encode($isClient ? 'Cliente: ' . $resolveName($message->authorUser, 'Cliente') : 'Staffing: ' . $resolveName($message->authorUser, 'Staffing')) ?>
                                </div>
                                <small class="text-muted"><?= Html::encode(Yii::$app->formatter->asRelativeTime((int) $message->created_at)) ?></small>
                            </div>
                            <div style="white-space: pre-line;"><?= Html::encode($message->body) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Responder</h5>
            </div>
            <div class="card-body">
                <?php if ($model->status === SupportTicket::STATUS_CLOSED): ?>
                    <div class="alert alert-warning mb-0">El ticket está cerrado. Si necesita reabrirlo, contacte a Staffing.</div>
                <?php else: ?>
                    <?= Html::beginForm(['/support-ticket/reply', 'id' => $model->id], 'post') ?>
                        <div class="mb-3">
                            <?= Html::textarea('body', '', [
                                'class' => 'form-control',
                                'rows' => 5,
                                'placeholder' => 'Añada contexto o seguimiento para el equipo de Staffing.',
                            ]) ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar respuesta</button>
                    <?= Html::endForm() ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
