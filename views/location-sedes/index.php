<?php

use app\models\LocationCountry;
use app\models\LocationSedes;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var int $total */
/** @var int $activos */
/** @var int $inactivos */

$this->title = 'Sedes';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['location-sedes/create-ajax']);
$dataUrl = Url::to(['location-sedes/data']);
$viewAjaxUrl = Url::to(['location-sedes/view-ajax']);
$formAjaxUrl = Url::to(['location-sedes/form-ajax']);
$updateAjaxUrl = Url::to(['location-sedes/update-ajax']);
$deleteUrl = Url::to(['location-sedes/delete']);
$getCitiesUrl = Url::to(['location-sedes/get-cities']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;

$countries = ArrayHelper::map(LocationCountry::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
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
                                    <p class="mb-0 text-muted fs-13">Total sedes</p>
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
                                    <p class="mb-0 text-muted fs-13">Activas</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($activos ?? 0) ?></h4>
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
                                    <p class="mb-0 text-muted fs-13">Inactivas</p>
                                    <h4 class="mb-0 fw-bold"><?= (int) ($inactivos ?? 0) ?></h4>
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
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_sede"><i class="ti ti-plus me-1"></i>Agregar Nueva</a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="sedes-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Tipo Sede</th>
                                <th>Ciudad</th>
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

<!-- Modal Ver Sede -->
<div class="modal fade" id="modal-view-sede">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 py-2 px-3">
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0" id="modal-view-sede-body">
                <div class="text-center py-5 px-3">
                    <span class="spinner-border text-primary" role="status"></span>
                    <p class="text-muted mt-2 mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Sede -->
<div class="modal fade" id="modal-edit-sede">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-edit fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Editar sede</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Actualiza datos, ubicación e integración de la sede.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3 px-4 pb-2" id="modal-edit-sede-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-sede">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar cambios</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Sede (scroll en .sede-add-scroll; sin modal-dialog-centered para respetar max-height) -->
<div class="modal fade" id="add_sede" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg sede-add-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0 align-items-start flex-shrink-0">
                <div class="me-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="avatar avatar-sm bg-primary text-white rounded d-inline-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="ti ti-building-store fs-16"></i>
                        </span>
                        <h5 class="modal-title fw-bold mb-0">Nueva sede</h5>
                    </div>
                    <p class="text-muted small mb-0 ps-1">Registra la sede con su ubicación y códigos de integración.</p>
                </div>
                <button type="button" class="btn-close mt-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?php
            $modelSedeModal = new LocationSedes();
            $modelSedeModal->loadDefaultValues();
            $formSede = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-sede',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body p-0 d-flex flex-column sede-add-modal-body">
                <div class="sede-add-scroll px-4 pt-3 pb-2">
                    <div id="sede-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
                    <?= $this->render('_form_add_modal_fields', [
                        'model' => $modelSedeModal,
                        'form' => $formSede,
                        'countries' => $countries,
                        'initialCountryId' => null,
                        'initialCities' => [],
                    ]) ?>
                </div>
            </div>
            <div class="modal-footer border-0 bg-light bg-opacity-50 pt-2 pb-3 px-4 gap-2 flex-shrink-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="ti ti-x me-1"></i>Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="btn-save-sede">
                    <span class="btn-text"><i class="ti ti-device-floppy me-1"></i>Guardar sede</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$this->registerCss(<<<'CSS'
/**
 * Scroll del modal de nueva sede: tope en vh sobre .sede-add-scroll
 * (modal-dialog-centered rompe la altura máxima y el scroll del body).
 */
#add_sede .sede-add-dialog {
    max-width: min(800px, 96vw);
    margin: 1rem auto;
}
#add_sede .sede-add-dialog .modal-content {
    display: flex;
    flex-direction: column;
    max-height: calc(100vh - 2rem);
    overflow: hidden;
}
#add_sede .sede-add-modal-body {
    flex: 1 1 auto;
    min-height: 0;
    overflow: hidden !important;
}
#add_sede .sede-add-scroll {
    max-height: min(72vh, calc(100vh - 200px));
    overflow-y: auto !important;
    overflow-x: hidden;
    -webkit-overflow-scrolling: touch;
    overscroll-behavior: contain;
    touch-action: pan-y;
    position: relative;
    z-index: 0;
}
@media (max-height: 700px) {
    #add_sede .sede-add-scroll {
        max-height: calc(100vh - 180px);
    }
}

/* Evita que el dropdown de acciones se recorte dentro de la tabla responsive */
#sedes-table_wrapper .table-responsive {
    overflow-x: auto;
    overflow-y: visible;
}
#sedes-table_wrapper .dropdown-menu {
    z-index: 1080;
}
CSS
);

$js = <<<JS
$(document).ready(function() {
    $(document).on('show.bs.dropdown', '.sede-actions-dropdown', function() {
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

    $(document).on('hidden.bs.dropdown', '.sede-actions-dropdown', function() {
        this.classList.remove('dropup');
    });

    var addSedeModalEl = document.getElementById('add_sede');
    if (addSedeModalEl) {
        addSedeModalEl.addEventListener('show.bs.modal', function() {
            if (this.parentElement !== document.body) {
                document.body.appendChild(this);
            }
        });
    }

    var table = $('#sedes-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{$dataUrl}',
        columns: [
            { data: 0 },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2, render: function(d) { return d || ''; } },
            { data: 3, render: function(d) { return d || ''; } },
            { data: 4 },
            { data: 5, render: function(d) { return d || ''; } },
            { data: 6, render: function(d) { return d || ''; } },
            { data: 7, class: 'text-center', orderable: false, render: function(d) { return d || ''; } }
        ],
        order: [[2, 'asc']],
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

    function loadSedeViewModal(id, date, tab) {
        date = date || new Date().toISOString().slice(0, 10);
        tab = tab || 'day';
        var url = '{$viewAjaxUrl}?id=' + id + '&date=' + encodeURIComponent(date) + '&tab=' + encodeURIComponent(tab);
        $('#modal-view-sede-body').html('<div class="text-center py-5 px-3"><span class="spinner-border text-primary"></span><p class="text-muted mt-2 mb-0">Cargando...</p></div>');
        $.get(url, function(html) {
            $('#modal-view-sede-body').html(html);
        }).fail(function() {
            $('#modal-view-sede-body').html('<div class="alert alert-danger border-0 m-3">Error al cargar los datos.</div>');
        });
    }

    $(document).on('click', '.btn-sede-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-sede'));
        loadSedeViewModal(id);
        modal.show();
    });

    $(document).on('submit', '.sede-view-date-form', function(e) {
        e.preventDefault();
        var id = $(this).data('sede-id');
        var date = $(this).find('input[name="date"]').val();
        var tab = $(this).find('input[name="tab"]').val();
        loadSedeViewModal(id, date, tab);
    });

    $(document).on('click', '.sede-view-tab', function(e) {
        e.preventDefault();
        var id = $(this).data('sede-id');
        var tab = $(this).data('tab');
        var date = $('#modal-view-sede #sede-modal-date').val() || $(this).data('date');
        loadSedeViewModal(id, date, tab);
    });

    $('#sede-country_id').on('change', function() {
        var countryId = $(this).val();
        var \$city = $('#sede-city_id');
        \$city.html('<option value="">Seleccione ciudad...</option>');
        if (!countryId) {
            \$city.html('<option value="">Seleccione país primero...</option>');
            return;
        }
        $.get('{$getCitiesUrl}', { country_id: countryId }, function(data) {
            $.each(data, function(i, c) {
                \$city.append($('<option></option>').val(c.id).text(c.name));
            });
        });
    });

    $(document).on('click', '.btn-sede-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-sede'));
        $('#modal-edit-sede-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-sede').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-sede-body').html(html);
            $('#sede-edit-country_id').off('change.sedeCity').on('change.sedeCity', function() {
                var countryId = $(this).val();
                var \$city = $('#sede-edit-city_id');
                \$city.html('<option value="">Seleccione ciudad...</option>');
                if (!countryId) {
                    \$city.html('<option value="">Seleccione país primero...</option>');
                    return;
                }
                $.get('{$getCitiesUrl}', { country_id: countryId }, function(data) {
                    $.each(data, function(i, c) {
                        \$city.append($('<option></option>').val(c.id).text(c.name));
                    });
                });
            });
        }).fail(function() {
            $('#modal-edit-sede-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-sede').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-sede-modal');
        var \$btn = $(this);
        var \$errors = $('#sede-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        if (!\$form.find('input[name="LocationSedes[activo]"]').filter(':checkbox').is(':checked')) {
            formData += '&LocationSedes[activo]=0';
        }
        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('modal-edit-sede')).hide();
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

    $(document).on('click', '.btn-sede-delete', function() {
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
            text: 'Se eliminará la sede "' + nombre + '". Esta acción no se puede deshacer.',
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
            success: function() {
                table.ajax.reload(null, false);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({ title: 'Eliminado', text: 'La sede ha sido eliminada.', icon: 'success', timer: 1500, showConfirmButton: false });
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

    $('#form-add-sede').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-sede');
        var \$errors = $('#sede-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize();
        if (!\$form.find('input[name="LocationSedes[activo]"]').filter(':checkbox').is(':checked')) {
            formData += '&LocationSedes[activo]=0';
        }

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    bootstrap.Modal.getInstance(document.getElementById('add_sede')).hide();
                    \$form[0].reset();
                    \$('#sede-modal-add-activo').prop('checked', true);
                    \$('#sede-city_id').html('<option value="">Seleccione país primero...</option>');
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

    $('#add_sede').on('hidden.bs.modal', function() {
        $('#form-add-sede')[0].reset();
        $('#sede-modal-add-activo').prop('checked', true);
        $('#sede-city_id').html('<option value="">Seleccione país primero...</option>');
        $('#sede-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>