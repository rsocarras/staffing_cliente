<?php

use app\models\SupportTicket;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\search\SupportTicketSearch $model */
?>

<?= Html::beginForm(Url::to(['/support-ticket/index']), 'get', ['class' => 'row g-2 align-items-end']) ?>
    <div class="col-6 col-md-4 col-lg-3">
        <label class="form-label small text-muted mb-1">Buscar</label>
        <?= Html::textInput('q', $model->q, ['class' => 'form-control form-control-sm', 'placeholder' => 'Ticket, asunto o descripción']) ?>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <label class="form-label small text-muted mb-1">Estado</label>
        <?= Html::dropDownList('status', $model->status, SupportTicket::statusOptions(), ['class' => 'form-select form-select-sm', 'prompt' => 'Todos']) ?>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <label class="form-label small text-muted mb-1">Prioridad</label>
        <?= Html::dropDownList('priority', $model->priority, SupportTicket::priorityOptions(), ['class' => 'form-select form-select-sm', 'prompt' => 'Todas']) ?>
    </div>
    <div class="col-6 col-md-12 col-lg-auto ms-lg-auto d-flex gap-2">
        <button type="submit" class="btn btn-sm btn-primary">
            <i class="ti ti-filter me-1"></i>Filtrar
        </button>
        <a href="<?= Url::to(['/support-ticket/index']) ?>" class="btn btn-sm btn-outline-secondary">
            <i class="ti ti-filter-off me-1"></i>Limpiar
        </a>
    </div>
<?= Html::endForm() ?>
