<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\RequisicionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Requisiciones de Contratación';
$this->params['breadcrumbs'][] = $this->title;

$createAjaxUrl = Url::to(['requisicion/create-ajax']);
$dataUrl = Url::to(['requisicion/data']);
$viewAjaxUrl = Url::to(['requisicion/view-ajax']);
$formAjaxUrl = Url::to(['requisicion/form-ajax']);
$updateAjaxUrl = Url::to(['requisicion/update-ajax']);
$deleteUrl = Url::to(['requisicion/delete']);

$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
?>

<div class="page-wrapper">
    <div class="content pb-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="text-end">
                <?= Html::a('<i class="ti ti-plus me-1"></i> Nueva Requisición', 'javascript:void(0);', ['class' => 'btn btn-primary', 'data-bs-toggle' => 'modal', 'data-bs-target' => '#add_requisicion']) ?>
                <?php if (Yii::$app->user->can('requisicion_approve')): ?>
                    <?= Html::a('<i class="ti ti-check me-1"></i> Bandeja Aprobación', ['approval'], ['class' => 'btn btn-outline-primary']) ?>
                <?php endif; ?>
                <?php if (Yii::$app->user->can('requisicion_reportes')): ?>
                    <?= Html::a('<i class="ti ti-report me-1"></i> Reportes RRHH', ['reportes'], ['class' => 'btn btn-outline-secondary']) ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filtros</h5>
            </div>
            <div class="card-body">
                <?php
                $tenantEmpresaId = Yii::$app->user->empresas_id ?? null;
                ?>
                <?php $form = ActiveForm::begin([
                    'method' => 'get',
                    'action' => ['index'],
                    'options' => ['id' => 'requisicion-filter-form'],
                ]); ?>
                <div class="row g-2">
                    <div class="col-md-2"><?= $form->field($searchModel, 'estado')->dropDownList(\app\models\Requisicion::optsEstado(), ['prompt' => 'Todos'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'empresa_cliente_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\EmpresaCliente::getActivos($tenantEmpresaId ? (int) $tenantEmpresaId : null), 'id', 'nombre'), ['prompt' => 'Empresa cliente'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'ciudad_id')->dropDownList(\app\models\City::sortMapWithPriority(\yii\helpers\ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name')), ['prompt' => 'Ciudad'])->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'fecha_ingreso_desde')->input('date')->label(false) ?></div>
                    <div class="col-md-2"><?= $form->field($searchModel, 'fecha_ingreso_hasta')->input('date')->label(false) ?></div>
                    <div class="col-md-2">
                        <?= Html::submitButton('<i class="ti ti-search"></i> Buscar', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap" id="requisicion-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Grupo / Vacante</th>
                                <th>Estado</th>
                                <th>Tiempo total</th>
                                <th>Empresa</th>
                                <th>Ciudad</th>
                                <th>Sede</th>
                                <th>Cargo</th>
                                <th>F. Ingreso</th>
                                <th>Persona</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Requisición -->
<div class="modal fade" id="modal-view-requisicion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 py-2 px-3">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="modal-view-requisicion-body">
                <div class="text-center py-5 px-3">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Requisición -->
<div class="modal fade" id="modal-edit-requisicion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-edit-requisicion-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmar envío a aprobación -->
<div class="modal fade" id="modal-submit-requisicion" tabindex="-1" aria-labelledby="modal-submit-requisicion-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <div class="d-flex align-items-center gap-2">
                    <span class="avatar avatar-sm bg-soft-warning text-warning rounded d-inline-flex align-items-center justify-content-center">
                        <i class="ti ti-send fs-16"></i>
                    </span>
                    <h5 class="modal-title fw-bold mb-0" id="modal-submit-requisicion-label">Enviar a aprobación</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body pt-2">
                <p class="mb-2 text-muted">¿Desea enviar esta requisición a aprobación?</p>
                <div id="submit-requisicion-resumen" class="border rounded-3 bg-light p-3 small"></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-success" id="btn-confirm-submit-requisicion">
                    <i class="ti ti-check me-1"></i>Enviar
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$modelRequisicionModal = new \app\models\Requisicion();
$modelRequisicionModal->estado = \app\models\Requisicion::ESTADO_DRAFT;
$modelRequisicionModal->numero_vacantes = 1;
?>

<!-- Modal Agregar Requisición (scroll en .requisicion-add-scroll; sin modal-dialog-centered para no romper max-height) -->
<div class="modal fade" id="add_requisicion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl requisicion-add-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start flex-shrink-0">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-file-plus fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nueva requisición</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Complete los datos de la vacante y la cantidad de posiciones.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php $modalForm = ActiveForm::begin([
                'id' => 'form-add-requisicion',
                'action' => ['create'],
                'method' => 'post',
                'enableClientValidation' => false,
            ]); ?>
            <div class="modal-body p-0 d-flex flex-column requisicion-add-modal-body">
                <div class="requisicion-add-scroll px-4 pt-3 pb-2">
                    <div id="requisicion-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                    <?= $this->render('_form_add_modal_fields', [
                        'model' => $modelRequisicionModal,
                        'form' => $modalForm,
                    ]) ?>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2 flex-shrink-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-requisicion">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar requisición</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$this->registerCss(<<<CSS
/**
 * Scroll del modal de creación: altura máxima en vh sobre .requisicion-add-scroll
 * (evita el problema de modal-dialog-centered que deja crecer el contenido sin tope).
 */
#add_requisicion .requisicion-add-dialog {
    max-width: min(1140px, 96vw);
    margin: 1rem auto;
}
#add_requisicion .requisicion-add-dialog .modal-content {
    display: flex;
    flex-direction: column;
    max-height: calc(100vh - 2rem);
    overflow: hidden;
}
#add_requisicion .requisicion-add-modal-body {
    flex: 1 1 auto;
    min-height: 0;
    overflow: hidden !important;
}
#add_requisicion .requisicion-add-scroll {
    max-height: min(72vh, calc(100vh - 200px));
    overflow-y: auto !important;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    overscroll-behavior: contain;
    touch-action: pan-y;
    position: relative;
    z-index: 0;
}
@media (max-height: 700px) {
    #add_requisicion .requisicion-add-scroll {
        max-height: calc(100vh - 180px);
    }
}
CSS);

$this->registerJs(<<<JS
$(function() {
    var submitActionUrl = '';
    var submitModalEl = document.getElementById('modal-submit-requisicion');
    var submitModal = submitModalEl ? bootstrap.Modal.getOrCreateInstance(submitModalEl) : null;

    function escapeHtml(v) {
        if (v == null) return '';
        return String(v).replace(/[&<>"']/g, function(ch) {
            return ({'&':'&amp;','<':'&lt;','>':'&gt;','\"':'&quot;',"'":'&#39;'})[ch];
        });
    }

    function setSubmitResumen(data) {
        var html = ''
            + '<div class="fw-semibold mb-2">Requisición #' + escapeHtml(data.requisicion || '-') + '</div>'
            + '<div><span class="text-muted">Empresa:</span> ' + escapeHtml(data.empresa || '-') + '</div>'
            + '<div><span class="text-muted">Ciudad / Sede:</span> ' + escapeHtml(data.ciudad || '-') + ' / ' + escapeHtml(data.sede || '-') + '</div>'
            + '<div><span class="text-muted">Área / Cargo:</span> ' + escapeHtml(data.area || '-') + ' / ' + escapeHtml(data.cargo || '-') + '</div>'
            + '<div><span class="text-muted">Fecha ingreso:</span> ' + escapeHtml(data.fecha || '-') + '</div>';
        $('#submit-requisicion-resumen').html(html);
    }

    var addRequisicionModalEl = document.getElementById('add_requisicion');
    if (addRequisicionModalEl) {
        addRequisicionModalEl.addEventListener('show.bs.modal', function() {
            if (this.parentElement !== document.body) {
                document.body.appendChild(this);
            }
        });
    }

    var table = $('#requisicion-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{$dataUrl}',
            data: function(d) {
                var \$form = $('#requisicion-filter-form');
                if (!\$form.length) return;
                var arr = \$form.serializeArray();
                arr.forEach(function(item) {
                    if (item.name === '_csrf') return;
                    d[item.name] = item.value;
                });
            }
        },
        columns: [
            { data: 0 },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2, render: function(d) { return d || ''; } },
            { data: 3, render: function(d) { return d || ''; } },
            { data: 4, render: function(d) { return d || ''; } },
            { data: 5, render: function(d) { return d || ''; } },
            { data: 6, render: function(d) { return d || ''; } },
            { data: 7, render: function(d) { return d || ''; } },
            { data: 8, render: function(d) { return d || ''; } },
            { data: 9, render: function(d) { return d || ''; } },
            { data: 10, orderable: false, class: 'text-end', render: function(d) { return d || ''; } },
        ],
        order: [[0, 'desc']],
        pageLength: 7,
        columnDefs: [{ orderable: false, targets: -1 }],
        language: {
            search: 'Buscar:',
            lengthMenu: 'Mostrar _MENU_',
            info: 'Mostrando _START_ a _END_ de _TOTAL_',
            paginate: { first: 'Primero', last: 'Último', next: 'Siguiente', previous: 'Anterior' }
        }
    });

    function resetRequisicionModal() {
        var form = $('#form-add-requisicion')[0];
        if (form) form.reset();
        $('#requisicion-form-errors').addClass('d-none').empty();
        $('#requisicion-sede_id').html('<option value=\"\">Primero seleccione ciudad</option>').prop('disabled', true);
        $('#requisicion-area_id').html('<option value=\"\">Primero seleccione empresa cliente</option>').prop('disabled', true);
        $('#requisicion-sub_area_id').html('<option value=\"\">Primero seleccione área</option>').prop('disabled', true);
        $('#requisicion-cargo_id').html('<option value=\"\">Primero seleccione área</option>').prop('disabled', true);
    }

    function hasActiveServerFilters() {
        var hasFilters = false;
        $('#requisicion-filter-form').find('select, input[type=\"date\"], input[type=\"text\"], input[type=\"hidden\"]').each(function() {
            if ($(this).attr('name') === '_csrf') return;
            if ($.trim($(this).val() || '') !== '') {
                hasFilters = true;
                return false;
            }
        });
        return hasFilters;
    }

    $(document).on('click', '.btn-requisicion-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-requisicion'));
        $('#modal-view-requisicion-body').html('<div class=\"text-center py-5 px-3\"><span class=\"spinner-border text-primary\"></span><p class=\"text-muted mt-2 mb-0\">Cargando...</p></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-requisicion-body').html(html);
        }).fail(function() {
            $('#modal-view-requisicion-body').html('<div class=\"alert alert-danger border-0 m-3\">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-requisicion-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-requisicion'));
        $('#modal-edit-requisicion-body').html('<div class=\"text-center py-4\"><span class=\"spinner-border text-primary\"></span></div>');
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-requisicion-body').html(html);
            $('#btn-save-edit-requisicion').data('id', id);
        }).fail(function() {
            $('#modal-edit-requisicion-body').html('<div class=\"alert alert-danger\">Error al cargar el formulario.</div>');
        });
    });

    $(document).on('click', '#btn-save-edit-requisicion', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-requisicion-modal');
        var \$btn = $('#btn-save-edit-requisicion');
        var \$errors = $('#requisicion-edit-form-errors');

        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-requisicion')).hide();
                    table.ajax.reload(null, false);
                } else {
                    var errors = [];
                    if (res.errors) {
                        Object.keys(res.errors).forEach(function(k) {
                            var v = res.errors[k];
                            errors.push($.isArray(v) ? v.join(' ') : v);
                        });
                    }
                    \$errors.html(errors.join('<br>')).removeClass('d-none');
                }
            },
            error: function() {
                \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });

    $(document).on('click', '.btn-requisicion-delete', function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre') || 'este registro';

        Swal.fire({
            title: '¿Está seguro?',
            text: 'Se eliminará la requisición \"' + nombre + '\". Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (!result.isConfirmed) return;

            $.ajax({
                url: '{$deleteUrl}',
                type: 'POST',
                data: { id: id, '{$csrfParam}': '{$csrfToken}' },
                dataType: 'json',
                success: function() {
                    table.ajax.reload(null, false);
                    Swal.fire({ title: 'Eliminado', text: 'La requisición ha sido eliminada.', icon: 'success', timer: 1500, showConfirmButton: false });
                },
                error: function() {
                    Swal.fire({ title: 'Error', text: 'No se pudo eliminar. Intente nuevamente.', icon: 'error' });
                }
            });
        });
    });

    $(document).on('click', '.btn-requisicion-submit', function() {
        var \$btn = $(this);
        submitActionUrl = (\$btn.data('url') || '').toString();
        if (!submitActionUrl || !submitModal) return;
        setSubmitResumen({
            requisicion: (\$btn.data('requisicion') || '').toString(),
            empresa: (\$btn.data('empresa') || '').toString(),
            ciudad: (\$btn.data('ciudad') || '').toString(),
            sede: (\$btn.data('sede') || '').toString(),
            area: (\$btn.data('area') || '').toString(),
            cargo: (\$btn.data('cargo') || '').toString(),
            fecha: (\$btn.data('fecha') || '').toString()
        });
        submitModal.show();
    });

    $('#btn-confirm-submit-requisicion').on('click', function() {
        if (!submitActionUrl) return;
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = submitActionUrl;
        var csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '{$csrfParam}';
        csrfInput.value = '{$csrfToken}';
        form.appendChild(csrfInput);
        document.body.appendChild(form);
        form.submit();
    });

    $('#form-add-requisicion').on('submit', function(e) {
        e.preventDefault();

        var \$form = $(this);
        var \$btn = $('#btn-save-requisicion');
        var \$errors = $('#requisicion-form-errors');

        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var \$disabled = \$form.find('select:disabled');
        \$disabled.prop('disabled', false);

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: \$form.serialize(),
            dataType: 'json',
            success: function(res) {
                if (!res.success) {
                    var errors = [];
                    if (res.errors) {
                        Object.keys(res.errors).forEach(function(key) {
                            var value = res.errors[key];
                            errors.push($.isArray(value) ? value.join(' ') : value);
                        });
                    }
                    \$errors.html(errors.join('<br>') || 'No fue posible guardar la requisición.').removeClass('d-none');
                    return;
                }

                var modalEl = document.getElementById('add_requisicion');
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();

                if (res.canAppendToList) {
                    table.ajax.reload(null, false);
                } else if (res.viewUrl) {
                    window.location.href = res.viewUrl;
                }

                resetRequisicionModal();
            },
            error: function() {
                \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
            },
            complete: function() {
                var c = $('#requisicion-ciudad_id').val();
                $('#requisicion-sede_id').prop('disabled', !c);
                var a = $('#requisicion-area_id').val();
                $('#requisicion-sub_area_id').prop('disabled', !a);
                var s = $('#requisicion-sub_area_id').val();
                var \$cargo = $('#requisicion-cargo_id');
                \$cargo.prop('disabled', !s || \$cargo.find('option').length <= 1);
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });

    $('#add_requisicion').on('hidden.bs.modal', function() {
        resetRequisicionModal();
    });
});
JS, \yii\web\View::POS_READY);
?>