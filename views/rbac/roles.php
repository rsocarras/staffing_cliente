<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $roles */
/** @var \yii\rbac\Permission[] $allPermissions */
/** @var array $summaryCounts */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$dataUrl = Url::to(['role-data']);
$formAjaxUrl = Url::to(['role-form-ajax']);
$createAjaxUrl = Url::to(['role-create-ajax']);
$updateAjaxUrl = Url::to(['role-update-ajax']);
$deleteUrl = Url::to(['role-delete']);
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
                            <li class="breadcrumb-item"><?= Html::a('User Management', ['/user-management/index']) ?></li>
                            <li class="breadcrumb-item"><?= Html::a('Permisos', ['permissions']) ?></li>
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
                                    <span class="avatar-title text-white"><i class="ti ti-users fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Roles definidos</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['roles'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-primary flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-key fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Permisos (sistema)</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['permissions'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-success flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-user fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Usuarios empresa</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['users'] ?? 0) ?></h4>
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
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_role"><i class="ti ti-plus me-1"></i>Agregar rol</a>
                        <?= Html::a('<i class="ti ti-key me-1"></i>Permisos', ['permissions'], ['class' => 'btn btn-outline-secondary']) ?>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="roles-table">
                        <thead>
                            <tr>
                                <th>Rol</th>
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

<!-- Modal Agregar Rol -->
<div class="modal fade" id="add_role">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-users fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nuevo rol</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Define el rol y asigna permisos.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= Html::beginForm('#', 'post', ['id' => 'form-add-role']) ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="role-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-tag fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Datos del rol</h6>
                            <p class="text-muted small mb-0">Nombre (identificador) y descripción.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="role-add-name" class="form-label fw-medium">Nombre (identificador)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-tag text-primary"></i></span>
                                <input type="text" class="form-control" name="name" id="role-add-name" maxlength="64" placeholder="Ej. gerente" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="role-add-description" class="form-label fw-medium">Descripción</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="ti ti-notes text-primary"></i></span>
                                <input type="text" class="form-control" name="description" id="role-add-description" maxlength="255" placeholder="Opcional">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-key fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Permisos asignados al rol</h6>
                            <p class="text-muted small mb-0">Marque los permisos que tendrá este rol.</p>
                        </div>
                    </div>
                    <div class="rounded-3 border bg-white p-3" style="max-height: 220px; overflow-y: auto;">
                        <?php foreach ($allPermissions as $permName => $perm): ?>
                            <div class="form-check py-2 border-bottom border-opacity-25">
                                <?= Html::checkbox('permissions[]', false, ['value' => $permName, 'id' => 'role-add-perm-' . preg_replace('/[^a-z0-9_]/', '_', $permName), 'class' => 'form-check-input']) ?>
                                <label class="form-check-label ms-2" for="role-add-perm-<?= preg_replace('/[^a-z0-9_]/', '_', $permName) ?>">
                                    <?= Html::encode($permName) ?>
                                    <?php if (!empty($perm->description)): ?>
                                        <span class="text-muted small">— <?= Html::encode($perm->description) ?></span>
                                    <?php endif; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($allPermissions)): ?>
                            <p class="text-muted mb-0">No hay permisos definidos.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i>Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-role">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar rol</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>
</div>

<!-- Modal Editar Rol -->
<div class="modal fade" id="modal-edit-role">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar rol</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualiza descripción y permisos del rol.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-role-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i>Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-role">
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

    var table = $('#roles-table').DataTable({
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
            zeroRecords: "No hay roles definidos.",
            processing: "Procesando..."
        }
    });

    $(document).on('click', '.btn-role-edit', function() {
        var name = $(this).data('name');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-role'));
        $('#modal-edit-role-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-role').data('name', name);
        modal.show();
        $.get(formAjaxUrl, { name: name }, function(html) {
            $('#modal-edit-role-body').html(html);
        }).fail(function() {
            $('#modal-edit-role-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-role').on('click', function() {
        var name = $(this).data('name');
        var \$form = $('#form-edit-role-modal');
        var \$btn = $(this);
        var \$errors = $('#role-edit-form-errors');
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
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-role')).hide();
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

    $('#form-add-role').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-role');
        var \$errors = $('#role-form-errors');
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
                    bootstrap.Modal.getInstance(document.getElementById('add_role')).hide();
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

    $(document).on('click', '.btn-role-delete', function() {
        var name = $(this).data('name');
        if (typeof Swal === 'undefined') {
            if (confirm('¿Eliminar el rol \"' + name + '\"? Se quitará la asignación a todos los usuarios.')) {
                $.post(deleteUrl, { name: name, [csrfParam]: csrfToken }, function(res) {
                    if (res && res.success) table.ajax.reload(null, false);
                });
            }
            return;
        }
        Swal.fire({
            title: '¿Eliminar rol?',
            text: 'Se eliminará el rol \"' + name + '\" y se quitará la asignación a todos los usuarios. Esta acción no se puede deshacer.',
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
                        Swal.fire({ title: 'Eliminado', text: 'El rol ha sido eliminado.', icon: 'success', timer: 1500, showConfirmButton: false });
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

    $('#add_role').on('hidden.bs.modal', function() {
        $('#form-add-role')[0].reset();
        $('#role-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
