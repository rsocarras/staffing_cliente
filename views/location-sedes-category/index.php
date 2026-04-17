<?php

use app\models\LocationSedeCargoTarifa;
use app\models\LocationSedesCategory;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var int $total */
/** @var int $withSedes */
/** @var int $withoutSedes */
/** @var array<int,string> $sedesMap */
/** @var array<int,string> $empresaClientesMap */

$this->title = 'Categoría de sedes';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['location-sedes-category/create-ajax']);
$dataUrl = Url::to(['location-sedes-category/data']);
$viewAjaxUrl = Url::to(['location-sedes-category/view-ajax']);
$formAjaxUrl = Url::to(['location-sedes-category/form-ajax']);
$updateAjaxUrl = Url::to(['location-sedes-category/update-ajax']);
$deleteUrl = Url::to(['location-sedes-category/delete']);
$sedesByClienteUrl = Url::to(['location-sedes-category/sedes-by-empresa-cliente']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;
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
                            <li class="breadcrumb-item">Configuración</li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body py-3">
                <div class="row row-gap-4">
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-dark flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-category fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Total categorías</p>
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
                                    <p class="mb-0 text-muted fs-13">Con sedes</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($withSedes ?? 0) ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                        <div class="card mb-0 flex-fill shadow-sm">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-lg rounded-circle bg-warning flex-shrink-0 me-3">
                                    <span class="avatar-title text-white"><i class="ti ti-map-pin-off fs-22"></i></span>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted fs-13">Sin sedes</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($withoutSedes ?? 0) ?></h4>
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
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_sede_category"><i class="ti ti-plus me-1"></i>Agregar Nueva</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="sedes-category-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Sedes asignadas</th>
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

<div class="modal fade" id="modal-view-sede-category">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 py-2 px-3">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="modal-view-sede-category-body">
                <div class="text-center py-5 px-3">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-sede-category">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar categoría</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualiza el nombre y las sedes asociadas.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-sede-category-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-sede-category">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cambios</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add_sede_category" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-category-plus fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nueva categoría de sedes</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Crea una categoría y selecciona sus sedes.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $modelCategoryModal = new LocationSedesCategory();
            $formCategory = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-sede-category',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body pt-3 px-4 pb-2">
                <div id="sede-category-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                <?= $this->render('_form_modal_fields', [
                    'model' => $modelCategoryModal,
                    'form' => $formCategory,
                    'sedesMap' => $sedesMap,
                    'empresaClientesMap' => $empresaClientesMap,
                ]) ?>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-sede-category">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar categoría</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$this->registerCss(
    <<<'CSS'
#sedes-category-table_wrapper .table-responsive {
    overflow-x: auto;
    overflow-y: visible;
}
#sedes-category-table_wrapper .dropdown-menu {
    z-index: 1080;
}
CSS
);

$lfCatPivot = new LocationSedeCargoTarifa();
$pivotFieldMetaForJs = [];
foreach (LocationSedeCargoTarifa::tariffColumnNames() as $f) {
    $pivotFieldMetaForJs[] = ['name' => $f, 'label' => $lfCatPivot->getAttributeLabel($f)];
}
$pivotFieldMetaJson = json_encode($pivotFieldMetaForJs, JSON_UNESCAPED_UNICODE);

$js = <<<JS
$(document).ready(function() {
    var table = $('#sedes-category-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{$dataUrl}',
        columns: [
            { data: 0 },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2, render: function(d) { return d || ''; } },
            { data: 3, class: 'text-center', orderable: false, render: function(d) { return d || ''; } }
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

    // ── Dynamic sedes picker ────────────────────────────────────────────────
    var sedesByClienteUrl = '{$sedesByClienteUrl}';
    var pivotFieldMeta = {$pivotFieldMetaJson};

    function escapeHtmlSede(str) {
        return $('<span>').text(str == null ? '' : String(str)).html();
    }

    function buildSedeTile(sede) {
        var name = escapeHtmlSede(sede.nombre);
        var sid = parseInt(sede.id, 10);
        var pivotHtml = '<div class="w-100 mt-2 pt-2 border-top js-dynamic-sede-pivot d-none">';
        pivotFieldMeta.forEach(function (meta) {
            pivotHtml += '<div class="mb-2"><label class="form-label small mb-0">' + escapeHtmlSede(meta.label) + '</label>' +
                '<input type="number" step="0.0001" min="0" class="form-control form-control-sm" name="PivotTariff[' + sid + '][' + meta.name + ']"></div>';
        });
        pivotHtml += '</div>';
        return '<div class="col-12 col-md-4">' +
            '<div class="border rounded p-2 js-dynamic-sede-card">' +
            '<label class="profile-sede-tile w-100 mb-0">' +
            '<input type="checkbox" name="LocationSedesCategory[sedeIds][]" value="' + sid + '" class="visually-hidden js-dynamic-sede-chk">' +
            '<span class="profile-sede-tile-inner d-flex align-items-center gap-2">' +
            '<span class="profile-sede-tile-check flex-shrink-0 d-inline-flex align-items-center justify-content-center" aria-hidden="true">' +
            '<i class="ti ti-square fs-18 profile-sede-icon-off"></i>' +
            '<i class="ti ti-square-check fs-18 profile-sede-icon-on d-none"></i>' +
            '</span>' +
            '<span class="profile-sede-tile-name flex-grow-1">' + name + '</span>' +
            '</span>' +
            '</label>' +
            pivotHtml +
            '</div>' +
            '</div>';
    }

    function loadSedesForCliente(\$form, empresaClienteId) {
        var \$picker = \$form.find('.sede-category-sedes-picker');
        var \$row = \$picker.find('.sede-category-sedes-row');
        var \$toolbar = \$picker.find('.profile-sedes-toolbar');

        if (!empresaClienteId) {
            \$toolbar.addClass('d-none');
            \$row.html('<div class="col-12 py-3 text-muted small text-center"><i class="ti ti-building-factory d-block fs-2 mb-1 opacity-50"></i>Seleccione una empresa cliente para ver las sedes disponibles.</div>');
            return;
        }

        \$row.html('<div class="col-12 text-center py-3"><span class="spinner-border spinner-border-sm text-primary"></span></div>');
        \$toolbar.addClass('d-none');

        $.get(sedesByClienteUrl, { empresa_cliente_id: empresaClienteId }, function(sedes) {
            if (!Array.isArray(sedes) || sedes.length === 0) {
                \$row.html('<div class="col-12"><div class="alert alert-warning mb-0">No hay sedes activas configuradas para esta empresa cliente.</div></div>');
                return;
            }
            \$toolbar.removeClass('d-none');
            var html = '';
            sedes.forEach(function(sede) { html += buildSedeTile(sede); });
            \$row.html(html);
            if (typeof syncProfileSedeTiles === 'function') {
                syncProfileSedeTiles(\$picker);
            }
        }, 'json').fail(function() {
            \$row.html('<div class="col-12"><div class="alert alert-danger mb-0">Error al cargar las sedes. Intente nuevamente.</div></div>');
        });
    }

    $(document).on('change', '#locationsedescategory-empresa_cliente_id', function() {
        var \$form = $(this).closest('.sede-category-modal-form');
        loadSedesForCliente(\$form, $(this).val());
    });

    $(document).on('change', '.sede-category-sedes-picker .js-dynamic-sede-chk', function () {
        var \$card = $(this).closest('.js-dynamic-sede-card');
        if (!\$card.length) return;
        \$card.find('.js-dynamic-sede-pivot').toggleClass('d-none', !this.checked);
        \$card.toggleClass('border-primary', this.checked);
    });

    $(document).on('click', '.sede-category-sedes-picker .js-profile-sedes-select-all', function () {
        setTimeout(function () {
            $('.sede-category-sedes-picker .js-dynamic-sede-chk').each(function () {
                if (this.checked) {
                    var \$c = $(this).closest('.js-dynamic-sede-card');
                    \$c.find('.js-dynamic-sede-pivot').removeClass('d-none');
                    \$c.addClass('border-primary');
                }
            });
        }, 0);
    });

    $(document).on('click', '.sede-category-sedes-picker .js-profile-sedes-clear', function () {
        setTimeout(function () {
            $('.sede-category-sedes-picker .js-dynamic-sede-pivot').addClass('d-none');
            $('.sede-category-sedes-picker .js-dynamic-sede-card').removeClass('border-primary');
        }, 0);
    });
    // ────────────────────────────────────────────────────────────────────────

    $(document).on('show.bs.dropdown', '.sede-category-actions-dropdown', function() {
        var rect = this.getBoundingClientRect();
        var menu = this.querySelector('.dropdown-menu');
        var itemsCount = menu ? menu.querySelectorAll('.dropdown-item').length : 3;
        var estimatedMenuHeight = Math.max((itemsCount * 56) + 16, 180);
        var spaceBelow = window.innerHeight - rect.bottom;
        var spaceAbove = rect.top;
        if (spaceBelow < estimatedMenuHeight && spaceAbove > spaceBelow) {
            this.classList.add('dropup');
        } else {
            this.classList.remove('dropup');
        }
    });

    $(document).on('hidden.bs.dropdown', '.sede-category-actions-dropdown', function() {
        this.classList.remove('dropup');
    });

    $(document).on('click', '.btn-category-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-sede-category'));
        $('#modal-view-sede-category-body').html('<div class="text-center py-5 px-3"><span class="spinner-border text-primary"></span><p class="text-muted mt-2 mb-0">Cargando...</p></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-sede-category-body').html(html);
        }).fail(function() {
            $('#modal-view-sede-category-body').html('<div class="alert alert-danger border-0 m-3">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-category-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-sede-category'));
        $('#modal-edit-sede-category-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-sede-category').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-sede-category-body').html(html);
            if (typeof syncProfileSedeTiles === 'function') {
                syncProfileSedeTiles($('#modal-edit-sede-category-body'));
            }
        }).fail(function() {
            $('#modal-edit-sede-category-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-sede-category').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-sede-category-modal');
        if (!\$form.length) {
            return;
        }
        var \$btn = $(this);
        var \$errors = $('#sede-category-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: \$form.serialize(),
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-sede-category')).hide();
                    table.ajax.reload(null, false);
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            errors.push(res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]);
                        }
                    }
                    \$errors.html(errors.join('<br>') || 'Error al guardar.').removeClass('d-none');
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

    $('#form-add-sede-category').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-sede-category');
        var \$errors = $('#sede-category-form-errors');
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
                    bootstrap.Modal.getInstance(document.getElementById('add_sede_category')).hide();
                    \$form[0].reset();
                    table.ajax.reload(null, false);
                } else {
                    var errors = [];
                    if (res.errors) {
                        for (var k in res.errors) {
                            errors.push(res.errors[k].join ? res.errors[k].join(' ') : res.errors[k]);
                        }
                    }
                    \$errors.html(errors.join('<br>') || 'Error al guardar.').removeClass('d-none');
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

    $('#add_sede_category').on('show.bs.modal', function() {
        var \$form = $(this).find('.sede-category-modal-form');
        var currentVal = \$form.find('#locationsedescategory-empresa_cliente_id').val();
        if (!currentVal) {
            loadSedesForCliente(\$form, '');
        }
    });

    $('#add_sede_category').on('hidden.bs.modal', function() {
        var \$form = $('#form-add-sede-category');
        if (\$form.length && \$form[0]) {
            \$form[0].reset();
            \$form.find('input[type="checkbox"][name="LocationSedesCategory[sedeIds][]"]').prop('checked', false);
            \$form.find('.profile-sede-tile').removeClass('is-selected');
        }
        $('#sede-category-form-errors').addClass('d-none').empty();
        loadSedesForCliente($('#add_sede_category .sede-category-modal-form'), '');
    });

    $(document).on('click', '.btn-category-delete', function() {
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
            text: 'Se eliminará la categoría "' + nombre + '". Esta acción no se puede deshacer.',
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
            success: function(res) {
                if (res && res.success) {
                    table.ajax.reload(null, false);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({ title: 'Eliminado', text: 'La categoría ha sido eliminada.', icon: 'success', timer: 1500, showConfirmButton: false });
                    }
                    return;
                }
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Error', text: 'No se pudo eliminar. Intente nuevamente.', icon: 'error' });
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
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>