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
                    <div class="col-md-2"><?= $form->field($searchModel, 'ciudad_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name'), ['prompt' => 'Ciudad'])->label(false) ?></div>
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
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-view-requisicion-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
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

<?php
$modelRequisicionModal = new \app\models\Requisicion();
$modelRequisicionModal->estado = \app\models\Requisicion::ESTADO_DRAFT;
$modelRequisicionModal->numero_vacantes = 1;
?>

<!-- Modal Agregar Requisición -->
<div class="modal fade" id="add_requisicion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Requisición</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php $modalForm = ActiveForm::begin([
                'id' => 'form-add-requisicion',
                'action' => ['create'],
                'method' => 'post',
                'enableClientValidation' => false,
            ]); ?>
            <div class="modal-body requisicion-modal-body">
                <div id="requisicion-form-errors" class="alert alert-danger d-none"></div>
                <?= $this->render('_form_fields', [
                    'model' => $modelRequisicionModal,
                    'form' => $modalForm,
                    'esCreacion' => true,
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-requisicion">
                    <span class="btn-text">Guardar</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$this->registerCss(<<<CSS
#add_requisicion .modal-dialog {
    max-width: min(1140px, 96vw);
}
#add_requisicion .requisicion-modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
CSS);

$this->registerJs(<<<JS
$(function() {
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
        pageLength: 25,
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
        $('#requisicion-sede_id').html('<option value=\"\">Seleccione sede</option>');
        $('#requisicion-sub_area_id').html('<option value=\"\">Seleccione sub-área</option>');
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
        $('#modal-view-requisicion-body').html('<div class=\"text-center py-4\"><span class=\"spinner-border text-primary\"></span></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-requisicion-body').html(html);
        }).fail(function() {
            $('#modal-view-requisicion-body').html('<div class=\"alert alert-danger\">Error al cargar los datos.</div>');
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

    $('#form-add-requisicion').on('submit', function(e) {
        e.preventDefault();

        var \$form = $(this);
        var \$btn = $('#btn-save-requisicion');
        var \$errors = $('#requisicion-form-errors');

        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

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