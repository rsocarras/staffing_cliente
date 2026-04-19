<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $summaryCounts */
/** @var app\models\NovedadCentroCosto $modelModal */
/** @var array<int, string> $sedeOptions */
/** @var array<int, string> $empresaClienteOptions */
/** @var string $sedesOptionsUrl */
/** @var bool $puedeCrear */
/** @var bool $puedeVer */
/** @var bool $puedeEditar */
/** @var bool $puedeEliminar */

$this->title = Yii::t('app', 'Centros de costo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuración'), 'url' => ['/configuracion/sedes']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['novedad-centro-costo/create-ajax']);
$dataUrl = Url::to(['novedad-centro-costo/data']);
$viewAjaxUrl = Url::to(['novedad-centro-costo/view-ajax']);
$formAjaxUrl = Url::to(['novedad-centro-costo/form-ajax']);
$updateAjaxUrl = Url::to(['novedad-centro-costo/update-ajax']);
$deleteUrlTpl = Url::to(['novedad-centro-costo/delete', 'id' => 999999001]);

$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;
$promptSedeJson = Json::htmlEncode(Yii::t('app', 'Seleccione la sede'));
?>

<div class="page-wrapper">
    <div class="content">
        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                    </div>
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>"><i class="ti ti-home"></i></a></li>
                            <li class="breadcrumb-item"><?= Html::encode(Yii::t('app', 'Configuración')) ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="row row-gap-4">
                    <div class="col-xl-4 col-lg-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-dark flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-building-bank fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13"><?= Yii::t('app', 'Total') ?></p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['total'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-success flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-circle-check fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13"><?= Yii::t('app', 'Activos') ?></p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['activos'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-danger flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-circle-x fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13"><?= Yii::t('app', 'Inactivos') ?></p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($summaryCounts['inactivos'] ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-0">
            <div class="card-body py-3">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="input-group w-auto input-group-flat">
                        <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control form-control-sm" id="ncc-search" placeholder="<?= Html::encode(Yii::t('app', 'Buscar por sede, código o nombre…')) ?>">
                    </div>
                    <?php if (!empty($puedeCrear)): ?>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_ncc_modal">
                                <i class="ti ti-plus me-1"></i><?= Yii::t('app', 'Agregar') ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="ncc-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><?= Yii::t('app', 'Sede') ?></th>
                                <th><?= Yii::t('app', 'Empresa cliente') ?></th>
                                <th><?= Yii::t('app', 'Código') ?></th>
                                <th><?= Yii::t('app', 'Nombre') ?></th>
                                <th><?= Yii::t('app', 'Activo') ?></th>
                                <th class="text-end"><?= Yii::t('app', 'Acciones') ?></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-ncc">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 py-2 px-3">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="modal-view-ncc-body">
                <div class="text-center py-5 px-3">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0"><?= Yii::t('app', 'Cargando...') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-ncc">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0"><?= Yii::t('app', 'Editar centro de costo') ?></h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1"><?= Yii::t('app', 'Actualice sede, código y estado.') ?></p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-ncc-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i><?= Yii::t('app', 'Cancelar') ?>
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-ncc">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i><?= Yii::t('app', 'Guardar cambios') ?></span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span><?= Yii::t('app', 'Guardando...') ?></span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_ncc_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-building-bank fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0"><?= Yii::t('app', 'Nuevo centro de costo') ?></h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1"><?= Yii::t('app', 'Asocie una sede y defina código y nombre.') ?></p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $formModal = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-ncc',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
                'options' => !empty($sedesOptionsUrl) ? ['data-sedes-options-url' => $sedesOptionsUrl] : [],
            ]);
            ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="ncc-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <?= $this->render('_form_add_modal_fields', [
                    'model' => $modelModal,
                    'form' => $formModal,
                    'sedeOptions' => $sedeOptions,
                    'empresaClienteOptions' => $empresaClienteOptions,
                ]) ?>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i><?= Yii::t('app', 'Cancelar') ?>
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-ncc">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i><?= Yii::t('app', 'Guardar') ?></span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span><?= Yii::t('app', 'Guardando...') ?></span>
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    var promptSede = {$promptSedeJson};
    function reloadNccSedes(\$form) {
        var base = \$form.attr('data-sedes-options-url');
        if (!base) {
            return;
        }
        var ec = \$form.find('.js-ncc-empresa-cliente').val();
        var url = base + (base.indexOf('?') >= 0 ? '&' : '?') + (ec ? 'empresa_cliente_id=' + encodeURIComponent(ec) : '');
        \$.getJSON(url, function(data) {
            var \$sede = \$form.find('.js-ncc-sede');
            var prev = \$sede.val();
            \$sede.empty();
            \$sede.append(\$('<option></option>').attr('value', '').text(promptSede));
            if (data && typeof data === 'object') {
                Object.keys(data).forEach(function(k) {
                    \$sede.append(\$('<option></option>').attr('value', k).text(data[k]));
                });
            }
            if (prev && \$sede.find('option[value="' + prev + '"]').length) {
                \$sede.val(prev);
            }
        });
    }
    $(document).on('change', '#form-add-ncc .js-ncc-empresa-cliente, #form-edit-ncc-modal .js-ncc-empresa-cliente', function() {
        reloadNccSedes($(this).closest('form'));
    });

    var table = $('#ncc-table').DataTable({
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
        order: [[0, 'desc']],
        pageLength: 10,
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

    $('#ncc-search').on('keyup', function() {
        table.search(this.value).draw();
    });

    $(document).on('click', '.btn-ncc-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-ncc'));
        $('#modal-view-ncc-body').html('<div class="text-center py-5 px-3"><span class="spinner-border text-primary"></span><p class="text-muted mt-2 mb-0">Cargando...</p></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-ncc-body').html(html);
        }).fail(function() {
            $('#modal-view-ncc-body').html('<div class="alert alert-danger border-0 m-3">Error al cargar.</div>');
        });
    });

    $(document).on('click', '.btn-ncc-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-ncc'));
        $('#modal-edit-ncc-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-ncc').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-ncc-body').html(html);
        }).fail(function() {
            $('#modal-edit-ncc-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-ncc').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-ncc-modal');
        var \$btn = $(this);
        var \$errors = $('#ncc-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        if (!\$form.find('#ncc-edit-activo').is(':checked')) {
            formData += '&NovedadCentroCosto[activo]=0';
        }
        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var m = bootstrap.Modal.getInstance(document.getElementById('modal-edit-ncc'));
                    m.hide();
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
                \$errors.html('Error al guardar.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });

    $(document).on('click', '.btn-ncc-delete', function() {
        var id = $(this).data('id');
        var nombre = $(this).data('nombre') || 'este registro';
        var \$btn = $(this);
        if (typeof Swal === 'undefined') {
            if (confirm('¿Eliminar ' + nombre + '?')) doDeleteNcc(id, \$btn, table);
            return;
        }
        Swal.fire({
            title: '¿Está seguro?',
            text: 'Se eliminará «' + nombre + '».',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function(result) {
            if (result.isConfirmed) doDeleteNcc(id, \$btn, table);
        });
    });

    function doDeleteNcc(id, \$btn, table) {
        var url = '{$deleteUrlTpl}'.replace('999999001', String(id));
        $.ajax({
            url: url,
            type: 'POST',
            data: { '{$csrfParam}': '{$csrfToken}' },
            dataType: 'json',
            success: function() {
                table.ajax.reload(null, false);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Eliminado', text: 'El registro fue eliminado.', icon: 'success', timer: 1500, showConfirmButton: false });
                }
            },
            error: function() {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Error', text: 'No se pudo eliminar.', icon: 'error' });
                }
            }
        });
    }

    $('#form-add-ncc').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-ncc');
        var \$errors = $('#ncc-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize();
        if (!\$form.find('#ncc-add-activo').is(':checked')) {
            formData += '&NovedadCentroCosto[activo]=0';
        }
        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('add_ncc_modal'));
                    modal.hide();
                    \$form[0].reset();
                    $('#ncc-add-activo').prop('checked', true);
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
                \$errors.html('Error al guardar.').removeClass('d-none');
            },
            complete: function() {
                \$btn.prop('disabled', false);
                \$btn.find('.btn-text').removeClass('d-none');
                \$btn.find('.btn-loading').addClass('d-none');
            }
        });
    });

    $('#add_ncc_modal').on('hidden.bs.modal', function() {
        $('#form-add-ncc')[0].reset();
        $('#ncc-add-activo').prop('checked', true);
        $('#ncc-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
