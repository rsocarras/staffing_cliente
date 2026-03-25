<?php

use app\models\Area;
use app\models\Cargos;
use app\models\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $summaryCounts */

$this->title = 'Cargos';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['cargos/create-ajax']);
$dataUrl = Url::to(['cargos/data']);
$viewAjaxUrl = Url::to(['cargos/view-ajax']);
$formAjaxUrl = Url::to(['cargos/form-ajax']);
$updateAjaxUrl = Url::to(['cargos/update-ajax']);
$subAreasUrl = Url::to(['cargos/get-sub-areas']);
$deleteUrl = Url::to(['cargos/delete']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;

$profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
$areasForSelect = [];
if ($profile && $profile->empresas_id) {
    $areasForSelect = ArrayHelper::map(
        Area::find()
            ->where(['empresas_id' => $profile->empresas_id])
            ->orderBy(['nombre' => SORT_ASC])
            ->all(),
        'id',
        'nombre'
    );
}
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
                                    <p class="mb-0 text-muted fs-13">Total cargos</p>
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
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_cargo"><i class="ti ti-plus me-1"></i>Agregar Nuevo</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="cargos-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Área</th>
                                <th>Sub-área</th>
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
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Cargo -->
<div class="modal fade" id="modal-view-cargo">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 py-2 px-3">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="modal-view-cargo-body">
                <div class="text-center py-5 px-3">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Cargo -->
<div class="modal fade" id="modal-edit-cargo">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar cargo</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualiza área, datos y estado del cargo.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-cargo-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-cargo">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cambios</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Cargo -->
<div class="modal fade" id="add_cargo">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-briefcase fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nuevo cargo</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Define el cargo, su área y códigos en la organización.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $modelCargoModal = new Cargos();
            $modelCargoModal->loadDefaultValues();
            $formCargo = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-cargo',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="cargo-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <?= $this->render('_form_add_modal_fields', [
                    'model' => $modelCargoModal,
                    'form' => $formCargo,
                    'areasForSelect' => $areasForSelect,
                ]) ?>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-cargo">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cargo</span>
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
    var table = $('#cargos-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{$dataUrl}',
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4, render: function(d) { return d || ''; } },
            { data: 5 },
            { data: 6, render: function(d) { return d || ''; } },
            { data: 7, class: 'text-center', orderable: false, render: function(d) { return d || ''; } }
        ],
        order: [[4, 'asc']],
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
                '<li><a href="javascript:void(0);" class="dropdown-item btn-cargo-view" data-id="' + id + '"><i class="ti ti-eye me-2"></i>Ver</a></li>' +
                '<li><a href="javascript:void(0);" class="dropdown-item btn-cargo-edit" data-id="' + id + '"><i class="ti ti-edit me-2"></i>Editar</a></li>' +
                '<li><a href="javascript:void(0);" class="dropdown-item text-danger btn-cargo-delete" data-id="' + id + '" data-nombre="' + nombre.replace(/"/g, '&quot;') + '"><i class="ti ti-trash me-2"></i>Eliminar</a></li>' +
            '</ul></div>';
    }

    $(document).on('click', '.btn-cargo-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-cargo'));
        $('#modal-view-cargo-body').html('<div class="text-center py-5 px-3"><span class="spinner-border text-primary"></span><p class="text-muted mt-2 mb-0">Cargando...</p></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-cargo-body').html(html);
        }).fail(function() {
            $('#modal-view-cargo-body').html('<div class="alert alert-danger border-0 m-3">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-cargo-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-cargo'));
        $('#modal-edit-cargo-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-cargo').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-cargo-body').html(html);
            $('#cargos-edit-area_id').off('change.cargoSub').on('change.cargoSub', function() {
                loadCargoSubAreas($('#cargos-edit-sub_area_id'), $(this).val());
            });
        }).fail(function() {
            $('#modal-edit-cargo-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-cargo').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-cargo-modal');
        var \$btn = $(this);
        var \$errors = $('#cargo-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        \$form.find('select').prop('disabled', false);
        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal-edit-cargo'));
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

    $(document).on('click', '.btn-cargo-delete', function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre') || 'este registro';
        var \$btn = $(this);
        if (typeof Swal === 'undefined') {
            if (confirm('¿Está seguro que desea eliminar ' + nombre + '?')) {
                doDeleteCargo(id, \$btn, table);
            }
            return;
        }
        Swal.fire({
            title: '¿Está seguro?',
            text: 'Se eliminará el cargo "' + nombre + '". Esta acción no se puede deshacer.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) {
                doDeleteCargo(id, \$btn, table);
            }
        });
    });

    function doDeleteCargo(id, \$btn, table) {
        $.ajax({
            url: '{$deleteUrl}',
            type: 'POST',
            data: { id: id, '{$csrfParam}': '{$csrfToken}' },
            dataType: 'json',
            success: function() {
                table.ajax.reload(null, false);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Eliminado', text: 'El cargo ha sido eliminado.', icon: 'success', timer: 1500, showConfirmButton: false });
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

    function loadCargoSubAreas(\$sel, areaId) {
        \$sel.html('<option value="">Seleccione sub-área</option>');
        if (!areaId) {
            \$sel.prop('disabled', true);
            return;
        }
        \$sel.prop('disabled', false);
        $.getJSON('{$subAreasUrl}', { area_id: areaId }, function(data) {
            (data || []).forEach(function(a) {
                \$sel.append('<option value="' + a.id + '">' + a.nombre + '</option>');
            });
        }).fail(function() {
            \$sel.html('<option value="">Seleccione sub-área</option>');
        });
    }

    $('#cargos-area_id').off('change.cargoSubAdd').on('change.cargoSubAdd', function() {
        loadCargoSubAreas($('#cargos-sub_area_id'), $(this).val());
    });

    $('#form-add-cargo').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-cargo');
        var \$errors = $('#cargo-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        \$form.find('select').prop('disabled', false);

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: \$form.serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('add_cargo'));
                    modal.hide();
                    \$form[0].reset();
                    $('#cargos-sub_area_id').html('<option value="">Seleccione sub-área</option>').prop('disabled', true);
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

    $('#add_cargo').on('hidden.bs.modal', function() {
        $('#form-add-cargo')[0].reset();
        $('#cargos-sub_area_id').html('<option value="">Seleccione sub-área</option>').prop('disabled', true);
        $('#cargo-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>