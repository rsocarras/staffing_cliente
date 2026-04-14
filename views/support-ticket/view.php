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

<div class="page-wrapper">
    <div class="content">
        <!-- Encabezado -->
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item">Soporte</li>
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/support-ticket/index']) ?>">Tickets de soporte</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                        <a href="<?= Url::to(['/support-ticket/index']) ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="ti ti-arrow-left me-1"></i>Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach (['success' => 'success', 'error' => 'danger'] as $flashKey => $alertClass): ?>
            <?php if (Yii::$app->session->hasFlash($flashKey)): ?>
                <div class="alert alert-<?= $alertClass ?> mb-3"><?= Html::encode(Yii::$app->session->getFlash($flashKey)) ?></div>
            <?php endif; ?>
        <?php endforeach; ?>

        <div class="row">
            <!-- Panel lateral: resumen + historial -->
            <div class="col-xl-4">
                <div class="card mb-3">
                    <div class="card-body p-0">
                        <!-- Resumen: datos del ticket -->
                        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light mx-3 mt-3">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="ti ti-ticket fs-20"></i>
                                </span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Resumen</h6>
                                    <p class="text-muted small mb-0">Datos principales del ticket.</p>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-12">
                                    <small class="text-muted d-block">Asunto</small>
                                    <span class="fw-medium"><?= Html::encode($model->subject) ?></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Cliente</small>
                                    <span class="fw-medium"><?= Html::encode($model->empresaCliente?->nombre ?: 'Sin cliente') ?></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Solicitante</small>
                                    <span class="fw-medium"><?= Html::encode($resolveName($model->createdBy, 'Usuario')) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Estado y prioridad -->
                        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light mx-3">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="ti ti-flag fs-20"></i>
                                </span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Estado y prioridad</h6>
                                    <p class="text-muted small mb-0">Clasificación actual del ticket.</p>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-6">
                                    <small class="text-muted d-block">Prioridad</small>
                                    <span class="badge <?= Html::encode($model->priorityBadgeClass()) ?>"><?= Html::encode($model->displayPriority()) ?></span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Estado</small>
                                    <span class="badge <?= Html::encode($model->statusBadgeClass()) ?>"><?= Html::encode($model->displayStatus()) ?></span>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block">Última actualización</small>
                                    <span class="fw-medium"><?= Html::encode(Yii::$app->formatter->asRelativeTime((int) $model->updated_at)) ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Historial de estado -->
                        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light mx-3">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="ti ti-history fs-20"></i>
                                </span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Historial de estado</h6>
                                    <p class="text-muted small mb-0">Movimientos registrados.</p>
                                </div>
                            </div>
                            <?php if ($model->statusLogs === []): ?>
                                <p class="text-muted mb-0 small">No hay movimientos registrados.</p>
                            <?php else: ?>
                                <div class="d-flex flex-column gap-2">
                                    <?php foreach ($model->statusLogs as $log): ?>
                                        <div class="border-start border-2 border-primary ps-2">
                                            <div class="fw-semibold small"><?= Html::encode(SupportTicket::statusOptions()[$log->to_status] ?? $log->to_status) ?></div>
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
            </div>

            <!-- Panel principal: conversación + respuesta -->
            <div class="col-xl-8">
                <!-- Conversación -->
                <div class="card mb-3">
                    <div class="card-body p-0">
                        <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light m-3">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="ti ti-messages fs-20"></i>
                                </span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Conversación</h6>
                                    <p class="text-muted small mb-0">Mensajes del ticket entre cliente y Staffing.</p>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-3">
                                <?php foreach ($model->messages as $message): ?>
                                    <?php
                                    /** @var SupportTicketMessage $message */
                                    if ((int) $message->is_internal === 1) {
                                        continue;
                                    }
                                    $isClient = $message->author_account_type === SupportTicketMessage::AUTHOR_CLIENT;
                                    ?>
                                    <div class="border rounded-3 p-3 <?= $isClient ? 'bg-white' : 'bg-soft-primary' ?>">
                                        <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="avatar avatar-sm <?= $isClient ? 'bg-soft-secondary text-secondary' : 'bg-soft-primary text-primary' ?> rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0">
                                                    <i class="ti <?= $isClient ? 'ti-user' : 'ti-headset' ?> fs-12"></i>
                                                </span>
                                                <span class="fw-semibold small">
                                                    <?= Html::encode($isClient ? 'Cliente: ' . $resolveName($message->authorUser, 'Cliente') : 'Staffing: ' . $resolveName($message->authorUser, 'Staffing')) ?>
                                                </span>
                                            </div>
                                            <small class="text-muted"><?= Html::encode(Yii::$app->formatter->asRelativeTime((int) $message->created_at)) ?></small>
                                        </div>
                                        <div class="small" style="white-space: pre-line;"><?= Html::encode($message->body) ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Responder -->
                <div class="card mb-0">
                    <div class="card-body p-0">
                        <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light m-3">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                    <i class="ti ti-send fs-20"></i>
                                </span>
                                <div>
                                    <h6 class="fw-semibold mb-1">Responder</h6>
                                    <p class="text-muted small mb-0">Añada contexto o seguimiento para el equipo de Staffing.</p>
                                </div>
                            </div>
                            <?php if ($model->status === SupportTicket::STATUS_CLOSED): ?>
                                <div class="alert alert-warning border-0 mb-0">
                                    <i class="ti ti-lock me-1"></i>El ticket está cerrado. Si necesita reabrirlo, contacte a Staffing.
                                </div>
                            <?php else: ?>
                                <?= Html::beginForm(['/support-ticket/reply', 'id' => $model->id], 'post') ?>
                                <div class="mb-3">
                                    <?= Html::textarea('body', '', [
                                        'class' => 'form-control',
                                        'rows' => 5,
                                        'placeholder' => 'Añada contexto o seguimiento para el equipo de Staffing.',
                                    ]) ?>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-send me-1"></i>Enviar respuesta
                                </button>
                                <?= Html::endForm() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>