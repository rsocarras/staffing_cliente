<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \yii\rbac\Role[] $allRoles */
/** @var User $modelAdd */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$dataUrl = Url::to(['data']);
$formAjaxUrl = Url::to(['form-ajax']);
$createAjaxUrl = Url::to(['create-ajax']);
$updateAjaxUrl = Url::to(['update-ajax']);
$blockUrl = Url::to(['block']);
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
                            <li class="breadcrumb-item">Administración</li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_user"><i class="ti ti-plus me-1"></i>Agregar usuario</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="users-table">
                        <thead>
                            <tr>
                                <th class="no-sort"></th>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Fecha creación</th>
                                <th>Rol</th>
                                <th>Confirmado</th>
                                <th>Estado</th>
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

<!-- Modal Agregar Usuario -->
<div class="modal fade" id="add_user">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-user-plus fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nuevo usuario</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Complete los datos del usuario y asigne roles.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php $formAdd = ActiveForm::begin(['id' => 'form-add-user', 'action' => '#', 'method' => 'post']); ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="user-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-user fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Datos del usuario</h6>
                            <p class="text-muted small mb-0">Usuario, correo, teléfono y contraseña.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= $formAdd->field($modelAdd, 'username', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-at text-primary"></i></span>{input}</div>{error}{hint}',
                                'options' => ['class' => 'mb-0'],
                                'labelOptions' => ['class' => 'form-label fw-medium'],
                            ])->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $formAdd->field($modelAdd, 'email', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-mail text-primary"></i></span>{input}</div>{error}{hint}',
                                'options' => ['class' => 'mb-0'],
                                'labelOptions' => ['class' => 'form-label fw-medium'],
                            ])->textInput(['maxlength' => true, 'type' => 'email', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-12">
                            <?= $formAdd->field($modelAdd, 'phone', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-phone text-primary"></i></span>{input}</div>{error}{hint}',
                                'options' => ['class' => 'mb-0'],
                                'labelOptions' => ['class' => 'form-label fw-medium'],
                            ])->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-12">
                            <?= $formAdd->field($modelAdd, 'isConfirmed', [
                                'template' => '<div class="form-check form-switch">{input}{label}</div>{error}',
                                'options' => ['class' => 'mb-0'],
                            ])->checkbox(['class' => 'form-check-input', 'label' => 'Usuario confirmado (puede iniciar sesión)', 'labelOptions' => ['class' => 'form-check-label']]) ?>
                        </div>
                        <div class="col-12">
                            <?= $formAdd->field($modelAdd, 'new_password', [
                                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-lock text-primary"></i></span>{input}</div>{error}{hint}',
                                'options' => ['class' => 'mb-0'],
                                'labelOptions' => ['class' => 'form-label fw-medium'],
                            ])->passwordInput(['maxlength' => true, 'class' => 'form-control'])->hint('Mínimo 6 caracteres') ?>
                        </div>
                    </div>
                </div>
                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-shield fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Roles</h6>
                            <p class="text-muted small mb-0">Asigne los roles de este usuario.</p>
                        </div>
                    </div>
                    <div class="rounded-3 border bg-white p-3" style="max-height: 180px; overflow-y: auto;">
                        <?php foreach ($allRoles as $name => $role): ?>
                            <div class="form-check py-2 border-bottom border-opacity-25">
                                <?= Html::checkbox('User[roleNames][]', false, [
                                    'value' => $name,
                                    'id' => 'user-add-role-' . preg_replace('/[^a-z0-9_]/', '_', $name),
                                    'class' => 'form-check-input',
                                ]) ?>
                                <label class="form-check-label ms-2" for="user-add-role-<?= preg_replace('/[^a-z0-9_]/', '_', $name) ?>">
                                    <?= Html::encode($name) ?>
                                    <?php if (!empty($role->description)): ?>
                                        <span class="text-muted small">— <?= Html::encode($role->description) ?></span>
                                    <?php endif; ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($allRoles)): ?>
                            <p class="text-muted mb-0">No hay roles definidos.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i>Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-user">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar usuario</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<!-- Modal Editar Usuario -->
<div class="modal fade" id="modal-edit-user">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar usuario</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualice los datos y roles del usuario.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-user-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i>Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-user">
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
    var blockUrl = '{$blockUrl}';
    var csrfParam = '{$csrfParam}';
    var csrfToken = '{$csrfToken}';

    var table = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: dataUrl,
        columns: [
            { data: 0, orderable: false },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5 },
            { data: 6 },
            { data: 7, class: 'text-center', orderable: false }
        ],
        order: [[1, 'asc']],
        pageLength: 10,
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" },
            zeroRecords: "No hay usuarios registrados.",
            processing: "Procesando..."
        }
    });

    $(document).on('click', '.btn-user-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-user'));
        $('#modal-edit-user-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-user').data('id', id);
        modal.show();
        $.get(formAjaxUrl, { id: id }, function(html) {
            $('#modal-edit-user-body').html(html);
        }).fail(function() {
            $('#modal-edit-user-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-user').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-user-modal');
        var \$btn = $(this);
        var \$errors = $('#user-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true).find('.btn-text').addClass('d-none').end().find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize() + '&' + csrfParam + '=' + encodeURIComponent(csrfToken);
        $.ajax({
            url: updateAjaxUrl.replace(/\/$/, '') + (updateAjaxUrl.indexOf('?') >= 0 ? '&' : '?') + 'id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-user')).hide();
                    table.ajax.reload(null, false);
                } else {
                    var msg = (res.errors && res.errors.general) ? res.errors.general.join(' ') : '';
                    if (!msg && res.errors) {
                        for (var k in res.errors) { msg += (res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]) + ' '; }
                    }
                    \$errors.html(msg || 'Error al guardar.').removeClass('d-none');
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

    $('#form-add-user').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-user');
        var \$errors = $('#user-form-errors');
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
                    bootstrap.Modal.getInstance(document.getElementById('add_user')).hide();
                    \$form[0].reset();
                    table.ajax.reload(null, false);
                } else {
                    var msg = '';
                    if (res.errors) {
                        for (var k in res.errors) { msg += (res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]) + '<br>'; }
                    }
                    \$errors.html(msg || 'Error al guardar.').removeClass('d-none');
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

    $(document).on('click', '.btn-user-block', function() {
        var id = $(this).data('id');
        var username = $(this).data('username') || '';
        var active = $(this).data('active') === 1;
        var action = active ? 'inactivar' : 'activar';
        var url = blockUrl + (blockUrl.indexOf('?') >= 0 ? '&' : '?') + 'id=' + id;
        if (typeof Swal === 'undefined') {
            if (confirm('¿Desea ' + action + ' al usuario \"' + username + '\"?')) {
                $.post(url, { [csrfParam]: csrfToken }, function(res) {
                    if (res && res.success) table.ajax.reload(null, false);
                });
            }
            return;
        }
        Swal.fire({
            title: action === 'inactivar' ? '¿Inactivar usuario?' : '¿Activar usuario?',
            text: 'Se ' + action + 'á al usuario \"' + username + '\".',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, ' + action,
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post(url, { [csrfParam]: csrfToken }, function(res) {
                    if (res && res.success) {
                        Swal.fire({ title: 'Listo', text: action === 'inactivar' ? 'Usuario inactivado.' : 'Usuario activado.', icon: 'success', timer: 1500, showConfirmButton: false });
                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire({ title: 'Error', text: 'No se pudo realizar la acción.', icon: 'error' });
                    }
                }).fail(function() {
                    Swal.fire({ title: 'Error', text: 'No se pudo realizar la acción. Intente nuevamente.', icon: 'error' });
                });
            }
        });
    });

    $('#add_user').on('hidden.bs.modal', function() {
        $('#form-add-user')[0].reset();
        $('#user-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
