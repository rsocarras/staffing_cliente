<?php

use app\models\Area;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Areas';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['area/create-ajax']);
$dataUrl = Url::to(['area/data']);
$viewAjaxUrl = Url::to(['area/view-ajax']);
$formAjaxUrl = Url::to(['area/form-ajax']);
$updateAjaxUrl = Url::to(['area/update-ajax']);
$deleteUrl = Url::to(['area/delete']);
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
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i> </a></li>
                            <li class="breadcrumb-item">Configuración</li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Start Search and Filter -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_area"><i class="ti ti-plus me-1"></i>Agregar Nueva</a>
                    </div>
                </div>
                <!-- End Search and Filter -->

                <!-- start table -->
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="area-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Área Padre</th>
                                <th>Centro Utilidad</th>
                                <th>Ref. Externa</th>
                                <th>Centro Utilidad Staffing</th>
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

<!-- Modal Agregar Área -->
<div class="modal fade" id="add_area">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-building-community fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nueva área</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Completa los datos para registrar un área en la organización.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $modelAreaModal = new \app\models\Area();
            $modelAreaModal->loadDefaultValues();
            $formArea = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-area',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="area-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <?= $this->render('_form_add_modal_fields', [
                    'model' => $modelAreaModal,
                    'form' => $formArea,
                ]) ?>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-area">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar área</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal Ver Área -->
<div class="modal fade" id="modal-view-area">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal-view-area-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Área -->
<div class="modal fade" id="modal-edit-area">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar área</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualiza los datos del área seleccionada.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-area-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-area">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cambios</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    var table = $('#area-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{$dataUrl}',
        columns: [
            { data: 0 },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 },
            { data: 6 },
            { data: 7, class: 'text-center', orderable: false, render: function(d) { return d || ''; } }
        ],
        order: [[1, 'asc']],
        pageLength: 7,
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

    function getActionsHtml(id, nombre) {
        nombre = nombre || '';
        return '<div class="dropdown">' +
            '<button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm btn-outline-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Acciones"><i class="ti ti-dots-vertical fs-16"></i></button>' +
            '<ul class="dropdown-menu dropdown-menu-end">' +
                '<li><a href="javascript:void(0);" class="dropdown-item btn-area-view" data-id="' + id + '"><i class="ti ti-eye me-2"></i>Ver</a></li>' +
                '<li><a href="javascript:void(0);" class="dropdown-item btn-area-edit" data-id="' + id + '"><i class="ti ti-edit me-2"></i>Editar</a></li>' +
                '<li><a href="javascript:void(0);" class="dropdown-item text-danger btn-area-delete" data-id="' + id + '" data-nombre="' + nombre.replace(/"/g, '&quot;') + '"><i class="ti ti-trash me-2"></i>Eliminar</a></li>' +
            '</ul></div>';
    }

    $(document).on('click', '.btn-area-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-area'));
        $('#modal-view-area-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-area-body').html(html);
        }).fail(function() {
            $('#modal-view-area-body').html('<div class="alert alert-danger">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-area-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-area'));
        $('#modal-edit-area-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-area').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-area-body').html(html);
        }).fail(function() {
            $('#modal-edit-area-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-area').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-area-modal');
        var \$btn = $(this);
        var \$errors = $('#area-edit-form-errors');
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
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal-edit-area'));
                    modal.hide();
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

    $(document).on('click', '.btn-area-delete', function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre') || 'este registro';
        var \$btn = $(this);
        if (typeof Swal === 'undefined') {
            if (confirm('¿Está seguro que desea eliminar ' + nombre + '?')) {
                doDelete(id, \$btn, table);
            }
            return;
        }
        Swal.fire({
            title: '¿Está seguro?',
            text: 'Se eliminará el área "' + nombre + '". Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) {
                doDelete(id, \$btn, table);
            }
        });
    });

    function doDelete(id, \$btn, table) {
        $.ajax({
            url: '{$deleteUrl}',
            type: 'POST',
            data: { id: id, '{$csrfParam}': '{$csrfToken}' },
            dataType: 'json',
            success: function() {
                table.ajax.reload(null, false);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Eliminado', text: 'El área ha sido eliminada.', icon: 'success', timer: 1500, showConfirmButton: false });
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

    $('#form-add-area').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-area');
        var \$errors = $('#area-form-errors');
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
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('add_area'));
                    modal.hide();
                    \$form[0].reset();
                    var \$select = $('#area-area_padre');
                    if (\$select.length && res.model.nombre) {
                        \$select.append($('<option></option>').val(res.model.id).text(res.model.nombre));
                    }
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
            error: function(xhr) {
                \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });

    $('#add_area').on('hidden.bs.modal', function() {
        $('#form-add-area')[0].reset();
        $('#area-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>