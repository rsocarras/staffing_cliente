<?php

use app\models\ContratoTipos;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var int $total */
/** @var int $activos */
/** @var int $inactivos */

$this->title = 'Tipos de Contrato';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['contrato-tipos/create-ajax']);
$dataUrl = Url::to(['contrato-tipos/data']);
$viewAjaxUrl = Url::to(['contrato-tipos/view-ajax']);
$formAjaxUrl = Url::to(['contrato-tipos/form-ajax']);
$updateAjaxUrl = Url::to(['contrato-tipos/update-ajax']);
$deleteUrl = Url::to(['contrato-tipos/delete']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;
?>

<div class="page-wrapper">
    <div class="content">
        <div class="card mb-0">
            <div class="card-body">
                <!-- Page Header -->
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                    </div>
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item">Configuración</li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Summary Cards -->
                <div class="row row-gap-4 mb-4">
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-dark flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-file-text fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Total tipos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($total ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-success flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-circle-check fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Activos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($activos ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-danger flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-circle-x fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Inactivos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($inactivos ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Summary Cards -->

                <!-- Start Search and Filter -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_contrato_tipo"><i class="ti ti-plus me-1"></i>Agregar Nuevo</a>
                    </div>
                </div>
                <!-- End Search and Filter -->

                <!-- start table -->
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="contrato-tipos-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Empresa ID</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Activo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- end table -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Tipo de Contrato -->
<div class="modal fade" id="modal-view-contrato-tipo">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal-view-contrato-tipo-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Tipo de Contrato -->
<div class="modal fade" id="modal-edit-contrato-tipo">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar tipo de contrato</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Ajusta código, reglas de vigencia y estado.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-contrato-tipo-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-contrato-tipo">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cambios</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Tipo de Contrato -->
<div class="modal fade" id="add_contrato_tipo">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-file-text fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nuevo tipo de contrato</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Define el tipo y cómo aplica fechas y duración.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $modelContratoModal = new ContratoTipos();
            $modelContratoModal->loadDefaultValues();
            $formContrato = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-contrato-tipo',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="contrato-tipo-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <?= $this->render('_form_add_modal_fields', [
                    'model' => $modelContratoModal,
                    'form' => $formContrato,
                ]) ?>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-contrato-tipo">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar tipo</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    var table = $('#contrato-tipos-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{$dataUrl}',
        columns: [
            { data: 0 },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2, render: function(d) { return d || ''; } },
            { data: 3, render: function(d) { return d || ''; } },
            { data: 4, render: function(d) { return d || ''; } },
            { data: 5, render: function(d) { return d || ''; } },
            { data: 6, class: 'text-center', orderable: false, render: function(d) { return d || ''; } }
        ],
        order: [[3, 'asc']],
        pageLength: 25,
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" },
            zeroRecords: "No se encontraron registros",
            processing: "Procesando..."
        }
    });

    $(document).on('click', '.btn-contrato-tipo-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-contrato-tipo'));
        $('#modal-view-contrato-tipo-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-contrato-tipo-body').html(html);
        }).fail(function() {
            $('#modal-view-contrato-tipo-body').html('<div class="alert alert-danger">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-contrato-tipo-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-contrato-tipo'));
        $('#modal-edit-contrato-tipo-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-contrato-tipo').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-contrato-tipo-body').html(html);
        }).fail(function() {
            $('#modal-edit-contrato-tipo-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-contrato-tipo').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-contrato-tipo-modal');
        var \$btn = $(this);
        var \$errors = $('#contrato-tipo-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        if (!\$form.find('[name="ContratoTipos[requiere_fecha_fin]"]').is(':checked')) {
            formData += '&ContratoTipos[requiere_fecha_fin]=0';
        }
        if (!\$form.find('[name="ContratoTipos[es_indefinido]"]').is(':checked')) {
            formData += '&ContratoTipos[es_indefinido]=0';
        }
        if (!\$form.find('[name="ContratoTipos[activo]"]').is(':checked')) {
            formData += '&ContratoTipos[activo]=0';
        }
        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-contrato-tipo')).hide();
                    table.ajax.reload(null, false);
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            errors.push(res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]);
                        }
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

    $(document).on('click', '.btn-contrato-tipo-delete', function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre') || 'este registro';
        if (typeof Swal === 'undefined') {
            if (confirm('¿Está seguro que desea eliminar ' + nombre + '?')) {
                doDelete(id);
            }
            return;
        }
        Swal.fire({
            title: '¿Está seguro?',
            text: 'Se eliminará el tipo de contrato "' + nombre + '". Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) {
                doDelete(id);
            }
        });
    });

    function doDelete(id) {
        $.ajax({
            url: '{$deleteUrl}',
            type: 'POST',
            data: { id: id, '{$csrfParam}': '{$csrfToken}' },
            dataType: 'json',
            success: function() {
                table.ajax.reload(null, false);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Eliminado', text: 'El tipo de contrato ha sido eliminado.', icon: 'success', timer: 1500, showConfirmButton: false });
                }
            },
            error: function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Error', text: 'No se pudo eliminar. Intente nuevamente.', icon: 'error' });
                } else {
                    alert('Error al eliminar.');
                }
            }
        });
    }

    $('#form-add-contrato-tipo').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-contrato-tipo');
        var \$errors = $('#contrato-tipo-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize();
        if (!\$form.find('[name="ContratoTipos[requiere_fecha_fin]"]').is(':checked')) {
            formData += '&ContratoTipos[requiere_fecha_fin]=0';
        }
        if (!\$form.find('[name="ContratoTipos[es_indefinido]"]').is(':checked')) {
            formData += '&ContratoTipos[es_indefinido]=0';
        }
        if (!\$form.find('[name="ContratoTipos[activo]"]').is(':checked')) {
            formData += '&ContratoTipos[activo]=0';
        }

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('add_contrato_tipo')).hide();
                    \$form[0].reset();
                    table.ajax.reload(null, false);
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            errors.push(res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]);
                        }
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

    $('#add_contrato_tipo').on('hidden.bs.modal', function() {
        $('#form-add-contrato-tipo')[0].reset();
        $('#contrato-tipo-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
