<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $permissions */

$this->title = 'Permisos';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$dataUrl = Url::to(['permission-data']);
$formAjaxUrl = Url::to(['permission-form-ajax']);
$createAjaxUrl = Url::to(['permission-create-ajax']);
$updateAjaxUrl = Url::to(['permission-update-ajax']);
$deleteUrl = Url::to(['permission-delete']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;
?>
<div class="page-wrapper">
    <div class="content">
        <div class="card mb-0">
            <div class="card-body">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                    </div>
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item"><?= Html::a('User Management', ['/user-management/index']) ?></li>
                            <li class="breadcrumb-item"><?= Html::a('Roles', ['roles']) ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_permission"><i class="ti ti-plus me-1"></i>Agregar permiso</a>
                        <?= Html::a('<i class="ti ti-users me-1"></i>Roles', ['roles'], ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="permissions-table">
                        <thead>
                            <tr>
                                <th>Permiso</th>
                                <th>Descripción</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Permiso -->
<div class="modal fade" id="add_permission">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-key fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nuevo permiso</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Define el nombre y la descripción del permiso.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= Html::beginForm('#', 'post', ['id' => 'form-add-permission']) ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="permission-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-key fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Datos del permiso</h6>
                            <p class="text-muted small mb-0">Nombre (identificador) y descripción.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="permission-add-name" class="form-label fw-medium">Nombre (identificador)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-tag text-primary"></i></span>
                                <input type="text" class="form-control" name="name" id="permission-add-name" maxlength="64" placeholder="Ej. app/config/update" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="permission-add-description" class="form-label fw-medium">Descripción</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-notes text-primary"></i></span>
                                <input type="text" class="form-control" name="description" id="permission-add-description" maxlength="255" placeholder="Opcional">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i>Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-permission">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar permiso</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<!-- Modal Editar Permiso -->
<div class="modal fade" id="modal-edit-permission">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar permiso</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualiza la descripción del permiso.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-permission-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i>Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-permission">
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
    var dataUrl = '{$dataUrl}';
    var formAjaxUrl = '{$formAjaxUrl}';
    var createAjaxUrl = '{$createAjaxUrl}';
    var updateAjaxUrl = '{$updateAjaxUrl}';
    var deleteUrl = '{$deleteUrl}';
    var csrfParam = '{$csrfParam}';
    var csrfToken = '{$csrfToken}';

    var table = $('#permissions-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: dataUrl,
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2, class: 'text-center', orderable: false }
        ],
        order: [[0, 'asc']],
        pageLength: 10,
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" },
            zeroRecords: "No hay permisos definidos.",
            processing: "Procesando..."
        }
    });

    $(document).on('click', '.btn-permission-edit', function() {
        var name = $(this).data('name');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-permission'));
        $('#modal-edit-permission-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-permission').data('name', name);
        modal.show();
        $.get(formAjaxUrl, { name: name }, function(html) {
            $('#modal-edit-permission-body').html(html);
        }).fail(function() {
            $('#modal-edit-permission-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-permission').on('click', function() {
        var name = $(this).data('name');
        var \$form = $('#form-edit-permission-modal');
        var \$btn = $(this);
        var \$errors = $('#permission-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true).find('.btn-text').addClass('d-none').end().find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize() + '&' + csrfParam + '=' + encodeURIComponent(csrfToken);
        $.ajax({
            url: updateAjaxUrl.replace(/\/$/, '') + '?name=' + encodeURIComponent(name),
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-permission')).hide();
                    table.ajax.reload(null, false);
                } else {
                    var err = res.errors && res.errors.name ? res.errors.name.join(' ') : (res.message || 'Error al guardar.');
                    \$errors.html(err).removeClass('d-none');
                }
            },
            error: function() {
                \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false).find('.btn-text').removeClass('d-none').end().find('.btn-loading').addClass('d-none');
            }
        });
    });

    $('#form-add-permission').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-permission');
        var \$errors = $('#permission-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true).find('.btn-text').addClass('d-none').end().find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize() + '&' + csrfParam + '=' + encodeURIComponent(csrfToken);
        $.ajax({
            url: createAjaxUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('add_permission')).hide();
                    \$form[0].reset();
                    table.ajax.reload(null, false);
                } else {
                    var msg = res.errors && res.errors.name ? res.errors.name.join(' ') : 'Error al guardar.';
                    \$errors.html(msg).removeClass('d-none');
                }
            },
            error: function() {
                \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false).find('.btn-text').removeClass('d-none').end().find('.btn-loading').addClass('d-none');
            }
        });
    });

    $(document).on('click', '.btn-permission-delete', function() {
        var name = $(this).data('name');
        if (typeof Swal === 'undefined') {
            if (confirm('¿Eliminar el permiso \"' + name + '\"?')) {
                $.post(deleteUrl, { name: name, [csrfParam]: csrfToken }, function(res) {
                    if (res && res.success) table.ajax.reload(null, false);
                });
            }
            return;
        }
        Swal.fire({
            title: '¿Eliminar permiso?',
            text: 'Se eliminará el permiso \"' + name + '\". Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post(deleteUrl, { name: name, [csrfParam]: csrfToken }, function(res) {
                    if (res && res.success) {
                        Swal.fire({ title: 'Eliminado', text: 'El permiso ha sido eliminado.', icon: 'success', timer: 1500, showConfirmButton: false });
                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire({ title: 'Error', text: (res && res.message) || 'No se pudo eliminar.', icon: 'error' });
                    }
                }).fail(function() {
                    Swal.fire({ title: 'Error', text: 'No se pudo eliminar. Intente nuevamente.', icon: 'error' });
                });
            }
        });
    });

    $('#add_permission').on('hidden.bs.modal', function() {
        $('#form-add-permission')[0].reset();
        $('#permission-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
