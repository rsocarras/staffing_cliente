<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $summaryCounts */
?>

<?php
$this->title = 'Tipo de Novedad';
$this->params['breadcrumbs'][] = $this->title;


$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['novedad-tipo/create-ajax']);
$dataUrl = Url::to(['novedad-tipo/data']);
$viewAjaxUrl = Url::to(['novedad-tipo/view-ajax']);
$formAjaxUrl = Url::to(['novedad-tipo/form-ajax']);
$updateAjaxUrl = Url::to(['novedad-tipo/update-ajax']);
$deleteUrl = Url::to(['novedad-tipo/delete']);

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
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i> </a></li>
                            <li class="breadcrumb-item">Configuración</li>
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
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-dark flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-building fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Total tipos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['total'] ?? 0) ?></h4>
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
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['activos'] ?? 0) ?></h4>
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
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['inactivos'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Contenido: acciones y tabla -->
        <div class="card mb-0">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="input-group w-auto input-group-flat">
                        <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control form-control-sm" id="novedad-tipo-search" placeholder="Buscar...">
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_novedad_tipo"><i class="ti ti-plus me-1"></i>Agregar</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="novedad-tipo-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Icono</th>
                                <th>Orden</th>
                                <th>Activo</th>
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

<!-- Modal Ver Novedad Tipo -->
<div class="modal fade" id="modal-view-novedad-tipo">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 py-2 px-3">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="modal-view-novedad-tipo-body">
                <div class="text-center py-5 px-3">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Novedad Tipo -->
<div class="modal fade" id="modal-edit-novedad-tipo">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar tipo de novedad</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualiza nombre, orden y estado del tipo.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-novedad-tipo-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-novedad-tipo">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cambios</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Novedad Tipo -->
<div class="modal fade" id="add_novedad_tipo">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-tag fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nuevo tipo de novedad</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Define el tipo con nombre, descripción y orden.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $modelModal = new \app\models\NovedadTipo();
            $modelModal->loadDefaultValues();
            $formModal = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-novedad-tipo',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="novedad-tipo-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <?= $this->render('_form_add_modal_fields', [
                    'model' => $modelModal,
                    'form' => $formModal,
                ]) ?>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-novedad-tipo">
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
    var table = $('#novedad-tipo-table').DataTable({
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
            { data: 6, class: 'text-end', orderable: false, render: function(d) { return d || ''; } }
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

    $('#novedad-tipo-search').on('keyup', function() {
        table.search(this.value).draw();
    });

    $(document).on('click', '.btn-novedad-tipo-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-novedad-tipo'));
        $('#modal-view-novedad-tipo-body').html('<div class="text-center py-5 px-3"><span class="spinner-border text-primary"></span><p class="text-muted mt-2 mb-0">Cargando...</p></div>');
        modal.show();

        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-novedad-tipo-body').html(html);
        }).fail(function() {
            $('#modal-view-novedad-tipo-body').html('<div class="alert alert-danger border-0 m-3">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-novedad-tipo-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-novedad-tipo'));
        $('#modal-edit-novedad-tipo-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-novedad-tipo').data('id', id);
        modal.show();

        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-novedad-tipo-body').html(html);
        }).fail(function() {
            $('#modal-edit-novedad-tipo-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-novedad-tipo').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-novedad-tipo-modal');
        var \$btn = $(this);
        var \$errors = $('#novedad-tipo-edit-form-errors');

        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        if (!\$form.find('#nvt-edit-activo').is(':checked')) {
            formData += '&NovedadTipo[activo]=0';
        }

        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal-edit-novedad-tipo'));
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

    $(document).on('click', '.btn-novedad-tipo-delete', function() {
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
            text: 'Se eliminará el tipo de novedad \"' + nombre + '\". Esta acción no se puede deshacer.',
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
                    Swal.fire({ title: 'Eliminado', text: 'El registro ha sido eliminado.', icon: 'success', timer: 1500, showConfirmButton: false });
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

    $('#form-add-novedad-tipo').on('submit', function(e) {
        e.preventDefault();

        var \$form = $(this);
        var \$btn = $('#btn-save-novedad-tipo');
        var \$errors = $('#novedad-tipo-form-errors');

        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize();
        if (!\$form.find('#nvt-add-activo').is(':checked')) {
            formData += '&NovedadTipo[activo]=0';
        }

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('add_novedad_tipo'));
                    modal.hide();
                    \$form[0].reset();
                    $('#nvt-add-activo').prop('checked', true);
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

    $('#add_novedad_tipo').on('hidden.bs.modal', function() {
        $('#form-add-novedad-tipo')[0].reset();
        $('#nvt-add-activo').prop('checked', true);
        $('#novedad-tipo-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>