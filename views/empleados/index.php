<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $summaryCounts */

$this->title = 'Empleados / colaboradores';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$dataUrl = Url::to(['empleados/data']);
$viewAjaxUrl = Url::to(['empleados/view-ajax']);
$userFormAjaxUrl = Url::to(['/user-management/form-ajax']);
$userUpdateAjaxUrl = Url::to(['/user-management/update-ajax']);
$subAreasUrl = Url::to(['/sistema/contratos/sub-areas']);
$cargosUrl = Url::to(['/sistema/contratos/cargos-por-estructura']);
?>

<div class="page-wrapper">
    <div class="content">
        <?php if (\Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show"><?= Html::encode((string) \Yii::$app->session->getFlash('success')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if (\Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show"><?= Html::encode((string) \Yii::$app->session->getFlash('error')) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
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
                            <li class="breadcrumb-item">Sistema</li>
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
                                    <p class="mb-0 text-muted fs-13">Total colaboradores</p>
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

        <!-- 3. Contenido: tabla -->
        <div class="card mb-0">
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="empleados-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Tipo doc.</th>
                                <th>Número doc.</th>
                                <th>Cargo</th>
                                <th>Área</th>
                                <th>Sede</th>
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

<div class="modal fade" id="modal-view-empleado">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-soft-primary text-primary rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-users fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0"><?= Html::encode(\Yii::t('app', 'Colaborador')) ?></h5>
                    </div>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0 pt-2" id="modal-view-empleado-body">
                <div class="text-center py-5 px-3">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-empleado">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0"><?= Html::encode(\Yii::t('app', 'Editar colaborador')) ?></h5>
                    </div>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-empleado-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i class="ti ti-x me-1"></i><?= Html::encode(\Yii::t('app', 'Cancelar')) ?></button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-empleado">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i><?= Html::encode(\Yii::t('app', 'Guardar cambios')) ?></span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span><?= Html::encode(\Yii::t('app', 'Guardando...')) ?></span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$(document).ready(function() {
    var table = $('#empleados-table').DataTable({
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
            { data: 7 },
            { data: 8, class: 'text-center', orderable: false, render: function(d) { return d || ''; } }
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
            zeroRecords: "No se encontraron registros",
            processing: "Procesando..."
        }
    });

    var formAjaxUrl = '{$userFormAjaxUrl}';
    var updateAjaxUrl = '{$userUpdateAjaxUrl}';
    var subAreasUrl = '{$subAreasUrl}';
    var cargosPorEstructuraUrl = '{$cargosUrl}';

    function fillContratoEmpleadoSelect(sel, items, prompt) {
        sel.innerHTML = '';
        var o = document.createElement('option');
        o.value = '';
        o.textContent = prompt;
        sel.appendChild(o);
        (items || []).forEach(function (row) {
            var opt = document.createElement('option');
            opt.value = row.id;
            opt.textContent = row.nombre;
            sel.appendChild(opt);
        });
    }

    $(document).on('change', '#contrato-emp-area-id', function () {
        var areaId = $(this).val();
        var \$sub = $('#contrato-emp-sub-area-id');
        var \$cargo = $('#contrato-emp-cargo-id');
        \$sub.empty().append('<option value="">—</option>');
        \$cargo.empty().append('<option value="">—</option>');
        if (!areaId) return;
        $.getJSON(subAreasUrl, { area_id: areaId }, function (rows) {
            fillContratoEmpleadoSelect(\$sub[0], rows || [], '—');
        });
    });

    $(document).on('change', '#contrato-emp-sub-area-id', function () {
        var areaId = $('#contrato-emp-area-id').val();
        var subId = $(this).val();
        var \$cargo = $('#contrato-emp-cargo-id');
        \$cargo.empty().append('<option value="">—</option>');
        if (!areaId) return;
        $.getJSON(cargosPorEstructuraUrl, { area_id: areaId, sub_area_id: subId || '' }, function (rows) {
            fillContratoEmpleadoSelect(\$cargo[0], rows || [], '—');
        });
    });

    $(document).on('click', '.btn-empleado-view', function() {
        var userId = $(this).data('user-id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-empleado'));
        $('#modal-view-empleado-body').html('<div class="text-center py-5 px-3"><span class="spinner-border text-primary"></span><p class="text-muted mt-2 mb-0">Cargando...</p></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: userId }, function(html) {
            $('#modal-view-empleado-body').html(html);
        }).fail(function() {
            $('#modal-view-empleado-body').html('<div class="alert alert-danger border-0 m-3">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-empleado-edit', function() {
        var userId = $(this).data('user-id');
        var viewInst = bootstrap.Modal.getInstance(document.getElementById('modal-view-empleado'));
        if (viewInst) { viewInst.hide(); }
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-empleado'));
        $('#modal-edit-empleado-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-empleado').data('user-id', userId);
        modal.show();
        $.get(formAjaxUrl, { id: userId }, function(html) {
            $('#modal-edit-empleado-body').html(html);
            var \$modalEdit = $('#modal-edit-empleado');
            $('#modal-edit-empleado-body').find('[data-toggle="select2"]').each(function() {
                var \$el = $(this);
                if (\$el.data('select2')) {
                    \$el.select2('destroy');
                }
                var opts = {
                    width: '100%',
                    placeholder: \$el.attr('data-placeholder') || '',
                    allowClear: \$el.attr('data-allow-clear') === 'true',
                    dropdownParent: \$modalEdit.length ? \$modalEdit : undefined
                };
                if (\$el.prop('multiple') || \$el.attr('data-close-on-select') === 'false') {
                    opts.closeOnSelect = false;
                }
                \$el.select2(opts);
            });
            if (typeof syncProfileSedeTiles === 'function') {
                syncProfileSedeTiles($('#modal-edit-empleado-body'));
            }
        }).fail(function() {
            $('#modal-edit-empleado-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-empleado').on('click', function() {
        var userId = $(this).data('user-id');
        var \$form = $('#form-edit-user-modal');
        if (!\$form.length) {
            return;
        }
        var \$btn = $(this);
        var \$errors = $('#user-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true).find('.btn-text').addClass('d-none').end().find('.btn-loading').removeClass('d-none');
        var formEl = document.getElementById('form-edit-user-modal');
        var fd = new FormData(formEl);
        $.ajax({
            url: updateAjaxUrl.replace(/\/$/, '') + (updateAjaxUrl.indexOf('?') >= 0 ? '&' : '?') + 'id=' + userId,
            type: 'POST',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-empleado')).hide();
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
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>