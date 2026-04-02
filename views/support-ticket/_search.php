<?php

use app\models\SupportTicket;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\search\SupportTicketSearch $model */
?>

<?= Html::beginForm(Url::to(['/support-ticket/index']), 'get', ['class' => 'row g-2 align-items-end']) ?>
    <div class="col-md-4">
        <label class="form-label">Buscar</label>
        <?= Html::textInput('q', $model->q, ['class' => 'form-control', 'placeholder' => 'Ticket, asunto o descripción']) ?>
    </div>
    <div class="col-md-3">
        <label class="form-label">Estado</label>
        <?= Html::dropDownList('status', $model->status, SupportTicket::statusOptions(), ['class' => 'form-select', 'prompt' => 'Todos']) ?>
    </div>
    <div class="col-md-3">
        <label class="form-label">Prioridad</label>
        <?= Html::dropDownList('priority', $model->priority, SupportTicket::priorityOptions(), ['class' => 'form-select', 'prompt' => 'Todas']) ?>
    </div>
    <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        <a href="<?= Url::to(['/support-ticket/index']) ?>" class="btn btn-light w-100">Limpiar</a>
    </div>
<?= Html::endForm() ?>
