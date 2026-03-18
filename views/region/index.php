<?php

use app\models\LocationCountry;
use app\models\Region;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Regiones';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'));
$this->registerCssFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css'));
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['region/create-ajax']);
$dataUrl = Url::to(['region/data']);
$viewAjaxUrl = Url::to(['region/view-ajax']);
$formAjaxUrl = Url::to(['region/form-ajax']);
$updateAjaxUrl = Url::to(['region/update-ajax']);
$parentRegionsUrl = Url::to(['region/get-parent-regions']);
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
                    <table class="table table-nowrap bg-white border mb-0" id="region-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>País</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
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

<!-- Modal Ver Región -->
<div class="modal fade" id="modal-view-region">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content position-relative">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body" id="modal-view-region-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Región -->
<div class="modal fade" id="modal-edit-region">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Región</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-edit-region-body">
                <div class="text-center py-4"><span class="spinner-border text-primary"></span></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn-save-edit-region">
                    <span class="btn-text">Guardar</span>
                    <span class="btn-loading d-none"><span class="spinner-border spinner-border-sm me-1"></span>Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Región -->
<div class="modal fade" id="add_region">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Región</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
            </div>
            <?php
            $modelRegionModal = new Region();
            $modelRegionModal->loadDefaultValues();
            $formRegion = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-region',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body">
                <div id="region-form-errors" class="alert alert-danger d-none"></div>
                <?= $this->render('_form_fields', [
                    'model' => $modelRegionModal,
                    'form' => $formRegion,
                    'countries' => $countries,
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-region">
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
    var table = $('#region-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{$dataUrl}',
        columns: [
            { data: 0 },
            { data: 1, render: function(d) { return d || ''; } },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5, class: 'text-center', orderable: false, render: function(d) { return d || ''; } }
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

    $(document).on('click', '.btn-region-view', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-view-region'));
        $('#modal-view-region-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        modal.show();
        $.get('{$viewAjaxUrl}', { id: id }, function(html) {
            $('#modal-view-region-body').html(html);
        }).fail(function() {
            $('#modal-view-region-body').html('<div class="alert alert-danger">Error al cargar los datos.</div>');
        });
    });

    $(document).on('click', '.btn-region-edit', function() {
        var id = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('modal-edit-region'));
        $('#modal-edit-region-body').html('<div class="text-center py-4"><span class="spinner-border text-primary"></span></div>');
        $('#btn-save-edit-region').data('id', id);
        modal.show();
        $.get('{$formAjaxUrl}', { id: id }, function(html) {
            $('#modal-edit-region-body').html(html);
            $('#region-edit-country_id').on('change', function() {
                var cid = $(this).val();
                var \$sel = $('#region-edit-parent_region_id');
                \$sel.html('<option value="">Ninguna</option>');
                if (!cid) return;
                $.get('{$parentRegionsUrl}', { country_id: cid, exclude_id: id }, function(data) {
                    data.forEach(function(r) {
                        \$sel.append('<option value="'+r.id+'">'+r.name+'</option>');
                    });
                });
            });
        }).fail(function() {
            $('#modal-edit-region-body').html('<div class="alert alert-danger">Error al cargar el formulario.</div>');
        });
    });

    $('#btn-save-edit-region').on('click', function() {
        var id = $(this).data('id');
        var \$form = $('#form-edit-region-modal');
        var \$btn = $(this);
        var \$errors = $('#region-edit-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');
        var formData = \$form.serialize() + '&{$csrfParam}={$csrfToken}';
        if (!\$form.find('input[name="Region[is_active]"]').is(':checked')) {
            formData += '&Region[is_active]=0';
        }
        $.ajax({
            url: '{$updateAjaxUrl}'.replace(/\/$/, '') + '?id=' + id,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('modal-edit-region'));
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

    $('#form-add-region').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-region');
        var \$errors = $('#region-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize();
        if (!\$('#region-is_active').is(':checked')) {
            formData += '&Region[is_active]=0';
        }

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('add_region'));
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

    $('#add_region').on('hidden.bs.modal', function() {
        $('#form-add-region')[0].reset();
        $('#region-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>