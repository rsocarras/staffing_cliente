<?php

use app\models\SupportTicket;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\search\SupportTicketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var array<string, int|string> $stats */
/** @var array<int, string> $empresaClienteOptions */

$this->title = 'Tickets de soporte';
$models = $dataProvider->getModels();
$hasActiveFilters = $searchModel->q || $searchModel->status || $searchModel->priority;

$createAjaxUrl = Url::to(['/support-ticket/create-ajax']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;
?>

<div class="page-wrapper">
    <div class="content">
        <!-- 1. Encabezado -->
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                    </div>
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item">Soporte</li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Cards resumen -->
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="row row-gap-4">
                    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-dark flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-ticket fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Total</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) $stats['total'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-warning flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-folder-open fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Abiertos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) $stats['abiertos'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-success flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-circle-check fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Resueltos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) $stats['resueltos'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-secondary flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-lock fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Cerrados</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) $stats['cerrados'] ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Contenido -->
        <div class="card mb-0">
            <div class="card-body py-3">
                <?php foreach (['success' => 'success', 'error' => 'danger'] as $flashKey => $alertClass): ?>
                    <?php if (Yii::$app->session->hasFlash($flashKey)): ?>
                        <div class="alert alert-<?= $alertClass ?> mb-3"><?= Html::encode(Yii::$app->session->getFlash($flashKey)) ?></div>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-ticket">
                            <i class="ti ti-ticket me-1"></i>Nueva solicitud
                        </a>
                    </div>
                </div>

                <!-- Filtros accordion -->
                <div class="accordion mb-4" id="accordionFiltrosTicket">
                    <div class="accordion-item border rounded-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button <?= $hasActiveFilters ? '' : 'collapsed' ?> py-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiltrosTicket" aria-expanded="<?= $hasActiveFilters ? 'true' : 'false' ?>" aria-controls="collapseFiltrosTicket">
                                <i class="ti ti-filter me-2"></i>Filtros
                            </button>
                        </h2>
                        <div id="collapseFiltrosTicket" class="accordion-collapse collapse <?= $hasActiveFilters ? 'show' : '' ?>" data-bs-parent="#accordionFiltrosTicket">
                            <div class="accordion-body py-3 bg-light bg-opacity-25">
                                <?= $this->render('_search', ['model' => $searchModel]) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0">
                        <thead>
                            <tr>
                                <th>Ticket</th>
                                <th>Cliente</th>
                                <th>Asunto</th>
                                <th>Prioridad</th>
                                <th>Estado</th>
                                <th>Actualizado</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($models as $model): ?>
                                <?php /** @var SupportTicket $model */ ?>
                                <tr>
                                    <td class="fw-medium"><?= Html::encode($model->ticket_number ?: ('#' . $model->id)) ?></td>
                                    <td><?= Html::encode($model->empresaCliente?->nombre ?: 'Sin cliente') ?></td>
                                    <td>
                                        <div class="fw-semibold"><?= Html::encode($model->subject) ?></div>
                                        <small class="text-muted"><?= Html::encode(StringHelper::truncate((string) $model->description, 90)) ?></small>
                                    </td>
                                    <td><span class="badge <?= Html::encode($model->priorityBadgeClass()) ?>"><?= Html::encode($model->displayPriority()) ?></span></td>
                                    <td><span class="badge <?= Html::encode($model->statusBadgeClass()) ?>"><?= Html::encode($model->displayStatus()) ?></span></td>
                                    <td><?= Html::encode(Yii::$app->formatter->asRelativeTime((int) $model->updated_at)) ?></td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones">
                                                <i class="ti ti-dots-vertical fs-16"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="<?= Url::to(['/support-ticket/view', 'id' => $model->id]) ?>" class="dropdown-item d-flex align-items-center gap-2 py-2 rounded text-info">
                                                        <span class="avatar avatar-sm bg-soft-info text-info rounded-circle d-inline-flex align-items-center justify-content-center flex-shrink-0"><i class="ti ti-eye fs-12"></i></span>
                                                        <span class="fw-medium">Ver</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if ($models === []): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No hay tickets registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pt-3">
                    <?= LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nueva solicitud -->
<div class="modal fade" id="modal-add-ticket">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-ticket fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nueva solicitud de soporte</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Completa los datos para enviar la solicitud a Staffing.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $ticketModal = new SupportTicket();
            $ticketModal->loadDefaultValues();
            $formTicket = ActiveForm::begin([
                'id' => 'form-add-ticket',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="ticket-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>

                <!-- Sección: Identificación -->
                <div class="rounded-3 border border-dashed p-3 mb-3 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-ticket fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Identificación del problema</h6>
                            <p class="text-muted small mb-0">Asunto, prioridad y cliente asociado.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <?= $formTicket->field($ticketModal, 'subject', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-pencil text-primary"></i></span>{input}</div>{error}',
                                'options' => ['class' => 'mb-0'],
                                'labelOptions' => ['class' => 'form-label fw-medium'],
                            ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Resumen corto del problema']) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $formTicket->field($ticketModal, 'priority', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-flag text-primary"></i></span>{input}</div>{error}',
                                'options' => ['class' => 'mb-0'],
                                'labelOptions' => ['class' => 'form-label fw-medium'],
                            ])->dropDownList(SupportTicket::priorityOptions(), ['class' => 'form-select']) ?>
                        </div>
                        <?php if ($empresaClienteOptions !== []): ?>
                        <div class="col-12">
                            <?= $formTicket->field($ticketModal, 'empresa_cliente_id', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building text-primary"></i></span>{input}</div>{error}',
                                'options' => ['class' => 'mb-0'],
                                'labelOptions' => ['class' => 'form-label fw-medium'],
                            ])->dropDownList($empresaClienteOptions, ['class' => 'form-select', 'prompt' => 'Sin cliente específico']) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Sección: Descripción -->
                <div class="rounded-3 border border-dashed p-3 mb-0 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-notes fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Descripción</h6>
                            <p class="text-muted small mb-0">Detalle el requerimiento, impacto y cualquier dato relevante.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <?= $formTicket->field($ticketModal, 'description', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white align-items-start pt-3"><i class="ti ti-notes text-info"></i></span>{input}</div>{error}',
                                'options' => ['class' => 'mb-0'],
                                'labelOptions' => ['class' => 'form-label fw-medium'],
                            ])->textarea([
                                'rows' => 5,
                                'class' => 'form-control',
                                'placeholder' => 'Describa el requerimiento, impacto y cualquier dato relevante para Staffing.',
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-ticket">
                    <span class="btn-text"><i class="ti ti-send me-1"></i>Enviar ticket</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Enviando...</span>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    $('#form-add-ticket').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-ticket');
        var \$errors = $('#ticket-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: \$form.serialize() + '&{$csrfParam}={$csrfToken}',
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    window.location.href = res.redirectUrl;
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            var msg = res.errors[k];
                            errors.push(msg.join ? msg.join(' ') : msg);
                        }
                    }
                    \$errors.html(errors.join('<br>')).removeClass('d-none');
                    \$btn.prop('disabled', false);
                    \$btn.find('.btn-text').removeClass('d-none');
                    \$btn.find('.btn-loading').addClass('d-none');
                }
            },
            error: function() {
                \$errors.html('Error al enviar. Intente nuevamente.').removeClass('d-none');
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });

    $('#modal-add-ticket').on('hidden.bs.modal', function() {
        $('#form-add-ticket')[0].reset();
        $('#ticket-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
