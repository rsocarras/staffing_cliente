<?php

use app\models\MallaProfileAsignacion;
use app\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
?>

<?php
$this->title = 'Asignación malla por empleado';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['malla-profile-asignacion/create-ajax']);
$dataUrl = Url::to(['malla-profile-asignacion/data']);
$viewAjaxUrl = Url::to(['malla-profile-asignacion/view-ajax']);
$formAjaxUrl = Url::to(['malla-profile-asignacion/form-ajax']);
$updateAjaxUrl = Url::to(['malla-profile-asignacion/update-ajax']);
$deleteUrl = Url::to(['malla-profile-asignacion/delete']);

$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;

$profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
$empresaId = $profile ? (int) $profile->empresas_id : null;
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
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_malla_profile_asignacion">
                            <i class="ti ti-plus me-1"></i>Agregar Nueva
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="malla-profile-asignacion-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Empleado</th>
                                <th>Malla</th>
                                <th>Estado</th>
                                <th>Actual</th>
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

<!-- Modal Ver -->
<div class="modal fade" id="modal-view-malla-profile-asignacion">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal-view-malla-profile-asignacion-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modal-edit-malla-profile-asignacion">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar asignación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-edit-malla-profile-asignacion-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-malla-profile-asignacion">
                    <span class="btn-text">Guardar</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$modelAdd = new MallaProfileAsignacion();
$modelAdd->loadDefaultValues();
$modelAdd->empresa_id = $empresaId;
?>

<!-- Modal Agregar -->
<div class="modal fade" id="add_malla_profile_asignacion">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva asignación malla-empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
            </div>
            <?php
            $formAdd = ActiveForm::begin([
                'id' => 'form-add-malla-profile-asignacion',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body">
                <div id="malla-profile-asignacion-form-errors" class="alert alert-danger d-none"></div>
                <?= $this->render('_form_fields', ['model' => $modelAdd, 'form' => $formAdd]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-add-malla-profile-asignacion">
                    <span class="btn-text">Guardar</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    var table = $('#malla-profile-asignacion-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{$dataUrl}',
        columns: [
            { data: 0, render: function(d) { return d || ''; } },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2, render: function(d) { return d || ''; } },
            { data: 3, render: function(d) { return d || ''; } },
            { data: 4, render: function(d) { return d || ''; } },
            { data: 5, class: 'text-end', orderable: false, render: function(d) { return d || ''; } }
        ],
        order: [[0, 'desc']],
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

    $(document).on('click', '.btn-malla-profile-asignacion-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-malla-profile-asignacion'));
        $('#modal-view-malla-profile-asignacion-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-malla-profile-asignacion-body').html(html);
        }).fail(function() {
            $('#modal-view-malla-profile-asignacion-body').html('<div class="alert alert-danger">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-malla-profile-asignacion-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-malla-profile-asignacion'));
        $('#modal-edit-malla-profile-asignacion-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-malla-profile-asignacion').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-malla-profile-asignacion-body').html(html);
        }).fail(function() {
            $('#modal-edit-malla-profile-asignacion-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-malla-profile-asignacion').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-malla-profile-asignacion-modal');
        var \$btn = $(this);
        var \$errors = $('#malla-profile-asignacion-edit-form-errors');

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
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-malla-profile-asignacion')).hide();
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

    $(document).on('click', '.btn-malla-profile-asignacion-delete', function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre') || 'esta asignación';

        Swal.fire({
            title: '¿Está seguro?',
            text: 'Se eliminará la asignación \"' + nombre + '\". Esta acción no se puede deshacer.',
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
                    Swal.fire({ title: 'Eliminado', text: 'La asignación ha sido eliminada.', icon: 'success', timer: 1500, showConfirmButton: false });
                },
                error: function() {
                    Swal.fire({ title: 'Error', text: 'No se pudo eliminar. Intente nuevamente.', icon: 'error' });
                }
            });
        });
    });

    $('#form-add-malla-profile-asignacion').on('submit', function(e) {
        e.preventDefault();

        var \$form = $(this);
        var \$btn = $('#btn-save-add-malla-profile-asignacion');
        var \$errors = $('#malla-profile-asignacion-form-errors');

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
                    var modal = bootstrap.Modal.getInstance(document.getElementById('add_malla_profile_asignacion'));
                    modal.hide();
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

    $('#add_malla_profile_asignacion').on('hidden.bs.modal', function() {
        $('#form-add-malla-profile-asignacion')[0].reset();
        $('#malla-profile-asignacion-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>