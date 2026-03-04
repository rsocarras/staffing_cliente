<?php

use app\models\LocationCountry;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Location Countries');
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['yii\bootstrap5\BootstrapAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['location-country/create-ajax']);
$baseViewUrl = Url::to(['location-country/view']);
$baseUpdateUrl = Url::to(['location-country/update']);
$baseDeleteUrl = Url::to(['location-country/delete']);
?>
<div class="page-wrapper">

    <!-- Start Content -->
    <div class="content pb-0">

        <!-- Page Header -->
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><?= Yii::t('app', 'Location') ?></a></li>
                    <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
                </ol>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Start Search and Filter -->
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
            <div class="input-group w-auto input-group-flat">
                <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                <input type="text" class="form-control form-control-sm" id="location-country-search" placeholder="Buscar...">
            </div>
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_location_country"><i class="ti ti-plus me-1"></i><?= Yii::t('app', 'Agregar País') ?></a>
            </div>
        </div>
        <!-- End Search and Filter -->

        <!-- start row -->
        <div class="row">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <div>
                            <h4 class="card-title mb-1"><?= Yii::t('app', 'Countries') ?></h4>
                            <p class="card-text mb-0">
                                <?= Yii::t('app', 'List of countries with search, sort and pagination.') ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap" id="location-country-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th><?= Yii::t('app', 'Name') ?></th>
                                        <th><?= Yii::t('app', 'Official Name') ?></th>
                                        <th><?= Yii::t('app', 'ISO Alpha2') ?></th>
                                        <th><?= Yii::t('app', 'ISO Alpha3') ?></th>
                                        <th><?= Yii::t('app', 'Region') ?></th>
                                        <th><?= Yii::t('app', 'Active') ?></th>
                                        <th class="text-end"><?= Yii::t('app', 'Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataProvider->getModels() as $model): ?>
                                    <tr>
                                        <td><?= $model->id ?></td>
                                        <td><?= Html::encode($model->name) ?></td>
                                        <td><?= Html::encode($model->official_name) ?></td>
                                        <td><?= Html::encode($model->iso_alpha2) ?></td>
                                        <td><?= Html::encode($model->iso_alpha3) ?></td>
                                        <td><?= Html::encode($model->region) ?></td>
                                        <td>
                                            <?php if ($model->is_active): ?>
                                                <span class="badge bg-success"><?= Yii::t('app', 'Yes') ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary"><?= Yii::t('app', 'No') ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <?= $this->render('_actions', ['model' => $model]) ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

        </div>
        <!-- end row -->

    </div>
    <!-- End Content -->

    <?= $this->render('//layouts/partials/footer') ?>

</div>

<!-- Modal Agregar País -->
<div class="modal fade" id="add_location_country">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= Yii::t('app', 'Agregar País') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
            </div>
            <?php
            $modelCountryModal = new LocationCountry();
            $modelCountryModal->loadDefaultValues();
            $formCountry = \yii\widgets\ActiveForm::begin([
                'id' => 'form-add-location-country',
                'action' => '',
                'method' => 'post',
                'enableClientValidation' => false,
            ]);
            ?>
            <div class="modal-body">
                <div id="location-country-form-errors" class="alert alert-danger d-none"></div>
                <?= $this->render('_form_fields', [
                    'model' => $modelCountryModal,
                    'form' => $formCountry,
                    'modal' => true,
                ]) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary" id="btn-save-location-country">
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
    var table = $('#location-country-table').DataTable({
        order: [[1, 'asc']],
        pageLength: 25,
        columnDefs: [{ orderable: false, targets: -1 }],
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            infoEmpty: "Mostrando 0 a 0 de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros totales)",
            paginate: { first: "Primero", last: "Último", next: "Siguiente", previous: "Anterior" },
            zeroRecords: "No se encontraron registros"
        }
    });

    $('#location-country-search').on('keyup', function() {
        table.search(this.value).draw();
    });

    $('#form-add-location-country').on('submit', function(e) {
        e.preventDefault();
        var \$form = $(this);
        var \$btn = $('#btn-save-location-country');
        var \$errors = $('#location-country-form-errors');
        \$errors.addClass('d-none').empty();
        \$btn.prop('disabled', true);
        \$btn.find('.btn-text').addClass('d-none');
        \$btn.find('.btn-loading').removeClass('d-none');

        var formData = \$form.serialize();
        if (!\$('#locationcountry-is_active').is(':checked')) {
            formData += '&LocationCountry[is_active]=0';
        }

        $.ajax({
            url: '{$createAjaxUrl}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('add_location_country'));
                    modal.hide();
                    \$form[0].reset();
                    var isActiveBadge = res.model.is_active ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-secondary">No</span>';
                    table.row.add([
                        res.model.id,
                        res.model.name,
                        res.model.official_name || '-',
                        res.model.iso_alpha2,
                        res.model.iso_alpha3,
                        res.model.region || '-',
                        isActiveBadge,
                        '<div class="d-inline-flex gap-2">' +
                            '<a href="{$baseViewUrl}?id=' + res.model.id + '" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16" title="Ver"><i class="ti ti-eye"></i></a>' +
                            '<a href="{$baseUpdateUrl}?id=' + res.model.id + '" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16" title="Editar"><i class="ti ti-edit"></i></a>' +
                            '<a href="{$baseDeleteUrl}?id=' + res.model.id + '" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-danger fs-16" title="Eliminar" data-confirm="¿Está seguro que desea eliminar?" data-method="post"><i class="ti ti-trash"></i></a>' +
                        '</div>'
                    ]).draw(false);
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
                \$btn.find('.btn-loading').removeClass('d-none');
            }
        });
    });

    $('#add_location_country').on('hidden.bs.modal', function() {
        $('#form-add-location-country')[0].reset();
        $('#location-country-form-errors').addClass('d-none').empty();
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
