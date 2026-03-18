<?php

use app\models\City;
use app\models\LocationCountry;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Ciudades';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['city/create-ajax']);
$dataUrl = Url::to(['city/data']);
$viewAjaxUrl = Url::to(['city/view-ajax']);
$formAjaxUrl = Url::to(['city/form-ajax']);
$updateAjaxUrl = Url::to(['city/update-ajax']);
$regionsUrl = Url::to(['city/get-regions']);
$csrfToken = Yii::$app->request->csrfToken;
$csrfParam = Yii::$app->request->csrfParam;

$countries = ArrayHelper::map(LocationCountry::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
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
                            <li class="breadcrumb-item">Configuración</li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- start table -->
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="city-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>País</th>
                                <th>Región</th>
                                <th>Nombre</th>
                                <th>Capital</th>
                                <th>Activo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- end table -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Ciudad -->
<div class="modal fade" id="modal-view-city">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal-view-city-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Ciudad -->
<div class="modal fade" id="modal-edit-city">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-edit-city-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-city">
                    <span class="btn-text">Guardar</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Ciudad -->
<div class="modal fade" id="add_city">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Ciudad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
            </div>
            <?php
            $modelCityModal = new City();
            $modelCityModal->loadDefaultValues();
            $formCity = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-city',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body">
                <div id="city-form-errors" class="alert alert-danger d-none"></div>
                <?= $this->render('_form_fields', [
                    'model' => $modelCityModal,
                    'form' => $formCity,
                    'countries' => $countries,
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-city">
                    <span class="btn-text">Guardar</span>
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
    var table = $('#city-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{$dataUrl}',
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3, render: function(d) { return d || ''; } },
            { data: 4, render: function(d) { return d || ''; } },
            { data: 5, render: function(d) { return d || ''; } },
            { data: 6, class: 'text-center', orderable: false, render: function(d) { return d || ''; } }
        ],
        order: [[3, 'asc']],
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
                '<li><a href="javascript:void(0);" class="dropdown-item btn-city-view" data-id="' + id + '"><i class="ti ti-eye me-2"></i>Ver</a></li>' +
                '<li><a href="javascript:void(0);" class="dropdown-item btn-city-edit" data-id="' + id + '"><i class="ti ti-edit me-2"></i>Editar</a></li>' +
            '</ul></div>';
    }

    $(document).on('click', '.btn-city-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-city'));
        $('#modal-view-city-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-city-body').html(html);
        }).fail(function() {
            $('#modal-view-city-body').html('<div class="alert alert-danger">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-city-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-city'));
        $('#modal-edit-city-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-city').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-city-body').html(html);
            $('#city-edit-country_id').on('change', function() {
                var cid = $(this).val();
                var \$sel = $('#city-edit-region_id');
                \$sel.html('<option value="">Seleccione región...</option>');
                if (!cid) return;
                $.get('{$regionsUrl}', { country_id: cid }, function(data) {
                    data.forEach(function(r) {
                        \$sel.append('<option value="'+r.id+'">'+r.name+'</option>');
                    });
                });
            });
        }).fail(function() {
            $('#modal-edit-city-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-city').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-city-modal');
        var \$btn = $(this);
        var \$errors = $('#city-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        if (!\$form.find('input[name="City[is_capital]"]').is(':checked')) {
            formData += '&City[is_capital]=0';
        }
        if (!\$form.find('input[name="City[is_active]"]').is(':checked')) {
            formData += '&City[is_active]=0';
        }
        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal-edit-city'));
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

    $('#form-add-city').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-city');
        var \$errors = $('#city-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize();
        if (!\$('#city-is_capital').is(':checked')) {
            formData += '&City[is_capital]=0';
        }
        if (!\$('#city-is_active').is(':checked')) {
            formData += '&City[is_active]=0';
        }

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('add_city'));
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

    $('#add_city').on('hidden.bs.modal', function() {
        $('#form-add-city')[0].reset();
        $('#city-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>