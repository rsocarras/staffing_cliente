<?php

use app\models\NovedadFlujo;
use app\models\NovedadStep;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var NovedadFlujo $flujo */
/** @var NovedadStep[] $steps */

$this->title = 'Configurar pasos — ' . $flujo->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Flujos de novedad', 'url' => ['/configuracion/novedad-flujo']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/js/jquery-ui.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$indexUrl = Url::to(['/configuracion/novedad-flujo']);
$stepFormUrl = Url::to(['novedad-flujo/step-form-ajax', 'id' => $flujo->id]);
$stepSaveUrl = Url::to(['novedad-flujo/step-save-ajax']);
$stepDeleteUrl = Url::to(['novedad-flujo/step-delete']);
$reorderUrl = Url::to(['novedad-flujo/reorder-steps']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;

$tipoLabels = NovedadStep::tipoPasoLista();
$estadoLabels = NovedadStep::estadoLista();
$flujoEstados = NovedadFlujo::estadoLista();
?>

<div class="page-wrapper">
    <div class="content">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 pb-3">
                    <div>
                        <a href="<?= Html::encode($indexUrl) ?>" class="btn btn-outline-secondary btn-sm mb-2"><i class="ti ti-arrow-left me-1"></i>Volver al listado</a>
                        <h4 class="fs-20 fw-bold mb-1"><?= Html::encode($flujo->nombre) ?></h4>
                        <p class="text-muted mb-0 small"><?= Html::encode($flujo->descripcion ?: 'Sin descripción') ?></p>
                    </div>
                    <div class="text-end">
                        <?php $flujoEstadoCls = NovedadFlujo::estadoBadgeSoftClass($flujo->estado); ?>
                        <span class="badge badge-soft-<?= Html::encode($flujoEstadoCls) ?>"><?= Html::encode($flujoEstados[$flujo->estado] ?? $flujo->estado) ?></span>
                    </div>
                </div>

                <p class="text-muted small mb-3">
                    Define el orden de los pasos arrastrando las filas. Cada paso puede tener un responsable (perfil) y un tipo de actividad.
                </p>

                <!-- Stepper visual -->
                <div class="mb-4 overflow-auto">
                    <ul class="nav nav-pills flex-nowrap gap-2 pb-1" id="novedad-flujo-stepper" style="min-height: 48px;">
                        <?php if (empty($steps)): ?>
                            <li class="nav-item">
                                <span class="nav-link text-muted border border-dashed rounded-pill px-3 py-2 small">Sin pasos aún — agrega el primero</span>
                            </li>
                        <?php else: ?>
                            <?php foreach ($steps as $i => $s): ?>
                                <li class="nav-item">
                                    <span class="nav-link rounded-pill px-3 py-2 small <?= $i === 0 ? 'active bg-primary' : 'bg-light text-dark' ?>" title="<?= Html::encode($s->codigo) ?>">
                                        <span class="opacity-75 me-1"><?= (int) ($i + 1) ?>.</span><?= Html::encode($s->nombre ?: $s->codigo) ?>
                                    </span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                    <h6 class="mb-0 fw-semibold"><i class="ti ti-list-numbers me-1"></i>Pasos del flujo</h6>
                    <button type="button" class="btn btn-primary btn-sm" id="btn-open-add-step">
                        <i class="ti ti-plus me-1"></i>Agregar paso
                    </button>
                </div>

                <ul class="list-group" id="novedad-step-sortable">
                    <?php foreach ($steps as $s): ?>
                        <?php
                        $tipoTxt = $tipoLabels[$s->tipo_paso] ?? $s->tipo_paso;
                        $estadoTxt = $estadoLabels[$s->estado] ?? $s->estado;
                        $resp = $s->profile ? trim(($s->profile->name ?: '') . ' — ' . $s->profile->num_doc) : '—';
                        ?>
                        <li class="list-group-item d-flex flex-wrap align-items-center gap-3" data-step-id="<?= (int) $s->id ?>">
                            <span class="step-drag-handle text-muted" style="cursor: move;" title="Arrastrar"><i class="ti ti-grip-vertical fs-18"></i></span>
                            <span class="badge bg-secondary"><?= (int) $s->orden ?></span>
                            <div class="flex-grow-1 min-w-0">
                                <div class="fw-medium text-dark"><?= Html::encode($s->nombre ?: $s->codigo) ?></div>
                                <div class="small text-muted text-truncate">
                                    <code><?= Html::encode($s->codigo) ?></code>
                                    · <?= Html::encode($tipoTxt) ?>
                                    · <?= Html::encode($estadoTxt) ?>
                                    · <?= Html::encode($resp) ?>
                                </div>
                            </div>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn btn-icon btn-sm btn-outline-light border btn-edit-step text-primary" data-step-id="<?= (int) $s->id ?>" title="Editar">
                                    <i class="ti ti-edit"></i>
                                </button>
                                <button type="button" class="btn btn-icon btn-sm btn-outline-light border btn-delete-step text-danger" data-step-id="<?= (int) $s->id ?>" data-label="<?= Html::encode($s->nombre ?: $s->codigo) ?>" title="Eliminar">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_novedad_step" tabindex="-1" aria-labelledby="modal_novedad_step_label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="modal_novedad_step_label">Paso del flujo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2" id="modal_novedad_step_body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-novedad-step">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar paso</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$flujoId = (int) $flujo->id;
$js = <<<JS
(function() {
    var flujoId = {$flujoId};
    var stepFormUrl = '{$stepFormUrl}';
    var stepSaveUrl = '{$stepSaveUrl}';
    var stepDeleteUrl = '{$stepDeleteUrl}';
    var reorderUrl = '{$reorderUrl}';
    var csrfParam = '{$csrfParam}';
    var csrfToken = '{$csrfToken}';

    function loadStepForm(stepId) {
        stepId = stepId || '';
        var url = stepFormUrl + (stepId ? '&step_id=' + encodeURIComponent(stepId) : '');
        $('#modal_novedad_step_body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $.get(url, function(html) {
            $('#modal_novedad_step_body').html(html);
        }).fail(function() {
            $('#modal_novedad_step_body').html('<div class="alert alert-danger">No se pudo cargar el formulario.</div>');
        });
    }

    $('#btn-open-add-step').on('click', function(e) {
        e.preventDefault();
        $('#modal_novedad_step_label').text('Nuevo paso');
        loadStepForm(null);
        var modal = new bootstrap.Modal(document.getElementById('modal_novedad_step'));
        modal.show();
    });

    $(document).on('click', '.btn-edit-step', function() {
        var sid = $(this).data('step-id');
        $('#modal_novedad_step_label').text('Editar paso');
        var modal = new bootstrap.Modal(document.getElementById('modal_novedad_step'));
        modal.show();
        loadStepForm(sid);
    });

    $('#btn-save-novedad-step').on('click', function() {
        var \$btn = $(this);
        var \$form = $('#modal_novedad_step_body').find('form').first();
        if (!\$form.length) return;
        var \$err = $('#novedad-step-form-errors');
        \$err.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        var data = \$form.serialize() + '&' + csrfParam + '=' + encodeURIComponent(csrfToken);
        $.ajax({
            url: stepSaveUrl,
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    window.location.reload();
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            errors.push(res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]);
                        }
                    }
                    \$err.html(errors.join('<br>')).removeClass('d-none');
                }
            },
            error: function() {
                \$err.html('Error al guardar.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });

    $(document).on('click', '.btn-delete-step', function() {
        var sid = $(this).data('step-id');
        var label = $(this).data('label') || '';
        var doPost = function() {
            $.ajax({
                url: stepDeleteUrl + '?id=' + encodeURIComponent(sid),
                type: 'POST',
                data: (function(){ var o = {}; o[csrfParam] = csrfToken; return o; })(),
                dataType: 'json',
                success: function(res) {
                    if (res.success) window.location.reload();
                },
                error: function() {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ title: 'Error', text: 'No se pudo eliminar.', icon: 'error' });
                    }
                }
            });
        };
        if (typeof Swal === 'undefined') {
            if (confirm('¿Eliminar este paso?')) doPost();
            return;
        }
        Swal.fire({
            title: '¿Eliminar paso?',
            text: label ? ('Se eliminará: ' + label) : undefined,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(r) { if (r.isConfirmed) doPost(); });
    });

    if ($('#novedad-step-sortable li').length > 0) {
        $('#novedad-step-sortable').sortable({
            handle: '.step-drag-handle',
            axis: 'y',
            update: function() {
                var order = [];
                $('#novedad-step-sortable li').each(function() {
                    order.push($(this).data('step-id'));
                });
                var payload = { novedad_flujo_id: flujoId, order: order };
                payload[csrfParam] = csrfToken;
                $.ajax({
                    url: reorderUrl,
                    type: 'POST',
                    data: payload,
                    dataType: 'json',
                    success: function(res) {
                        if (res.success) {
                            window.location.reload();
                        } else if (typeof Swal !== 'undefined') {
                            Swal.fire({ title: 'Orden', text: res.message || 'No se pudo guardar el orden.', icon: 'error' });
                        }
                    },
                    error: function() {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({ title: 'Error', text: 'No se pudo guardar el orden.', icon: 'error' });
                        }
                    }
                });
            }
        });
    }
})();
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
