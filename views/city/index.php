<?php
use app\models\City;
use app\models\LocationCountry;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\search\CitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Cities';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['yii\bootstrap5\BootstrapAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);

$createAjaxUrl = Url::to(['city/create-ajax']);
$baseViewUrl = Url::to(['city/view']);
$baseUpdateUrl = Url::to(['city/update']);
$baseDeleteUrl = Url::to(['city/delete']);

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
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Location</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= Html::encode($this->title) ?></li>
                        </ol>
                    </div>
                </div>
                <!-- End Page Header -->

                <!-- Start Search and Filter -->
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="input-group w-auto input-group-flat">
                        <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                        <input type="text" class="form-control form-control-sm" id="city-search" placeholder="Buscar...">
                    </div>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_city"><i class="ti ti-plus me-1"></i>Agregar Nueva</a>
                    </div>
                </div>
                <!-- End Search and Filter -->

                <!-- start table -->
                <div class="table-responsive">
                    <table class="table table-nowrap bg-white border mb-0" id="city-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Country ID</th>
                                <th>Region ID</th>
                                <th>Name</th>
                                <th>Is Capital</th>
                                <th>Is Active</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->getModels() as $model): ?>
                            <tr>
                                <td><?= Html::encode($model->id) ?></td>
                                <td><?= Html::encode($model->country_id) ?></td>
                                <td><?= Html::encode($model->region_id ?? '-') ?></td>
                                <td class="fw-medium text-dark"><?= Html::encode($model->name) ?></td>
                                <td><?= $model->is_capital ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-secondary">No</span>' ?></td>
                                <td><?= $model->is_active ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-danger">No</span>' ?></td>
                                <td>
                                    <div class="d-inline-flex gap-2">
                                        <?= Html::a('<i class="ti ti-eye"></i>', ['view', 'id' => $model->id], ['class' => 'btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16', 'title' => 'Ver']) ?>
                                        <?= Html::a('<i class="ti ti-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16', 'title' => 'Editar']) ?>
                                        <?= Html::a('<i class="ti ti-trash"></i>', ['delete', 'id' => $model->id], [
                                            'class' => 'btn btn-icon btn-sm btn-outline-light rounded-pill text-danger fs-16',
                                            'title' => 'Eliminar',
                                            'data' => ['confirm' => '¿Está seguro que desea eliminar este registro?', 'method' => 'post'],
                                        ]) ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- end table -->
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
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
        order: [[3, 'asc']],
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

    $('#city-search').on('keyup', function() {
        table.search(this.value).draw();
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
                    var isCapitalBadge = res.model.is_capital ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-secondary">No</span>';
                    var isActiveBadge = res.model.is_active ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-danger">No</span>';
                    table.row.add([
                        res.model.id,
                        res.model.country_id,
                        res.model.region_id || '-',
                        res.model.name,
                        isCapitalBadge,
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
