<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Location Countries');
$this->params['breadcrumbs'][] = $this->title;

// Asegurar que DataTables se cargue (independiente del path)
$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['yii\bootstrap5\BootstrapAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
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
                        <div>
                            <?= Html::a(
                                '<i class="ti ti-plus me-1 align-middle"></i>' . Yii::t('app', 'Create Location Country'),
                                ['create'],
                                ['class' => 'btn btn-primary']
                            ) ?>
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

<?php
$js = <<<JS
$(document).ready(function() {
    if (typeof $.fn.DataTable !== 'undefined' && $('#location-country-table').length) {
        $('#location-country-table').DataTable({
            order: [[1, 'asc']],
            pageLength: 25,
            columnDefs: [{ orderable: false, targets: -1 }],
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 a 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                },
                zeroRecords: "No se encontraron registros"
            }
        });
    }
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
