<?php
/**
 * Layout parcial para índices con DataTables.
 * Uso: $this->render('//layouts/_datatable_index', [
 *   'title' => '...',
 *   'breadcrumbParent' => '...',
 *   'createLabel' => '...',
 *   'tableId' => '...',
 *   'dataProvider' => $dataProvider,
 *   'columns' => [['label' => '...', 'value' => function($m) { return $m->attr; }], ...],
 *   'actionParams' => function($model) { return ['id' => $model->id]; },
 * ]);
 */
use yii\helpers\Html;
use yii\helpers\Url;

$tableId = $tableId ?? 'datatable-index';
?>
<?php
$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['yii\bootstrap5\BootstrapAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($title) ?></h4>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><?= Html::encode($breadcrumbParent ?? $title) ?></a></li>
                    <li class="breadcrumb-item active"><?= Html::encode($title) ?></li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <div>
                            <h4 class="card-title mb-1"><?= Html::encode($title) ?></h4>
                            <p class="card-text mb-0"><?= Yii::t('app', 'List with search, sort and pagination.') ?></p>
                        </div>
                        <div>
                            <?= Html::a('<i class="ti ti-plus me-1 align-middle"></i>' . ($createLabel ?? 'Create'), ['create'], ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap" id="<?= Html::encode($tableId) ?>">
                                <thead>
                                    <tr>
                                        <?php foreach ($columns as $col): ?>
                                        <th><?= Html::encode($col['label']) ?></th>
                                        <?php endforeach; ?>
                                        <th class="text-end"><?= Yii::t('app', 'Actions') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dataProvider->getModels() as $model): ?>
                                    <tr>
                                        <?php foreach ($columns as $col): ?>
                                        <td><?= is_callable($col['value']) ? $col['value']($model) : Html::encode($model->{$col['value']} ?? '') ?></td>
                                        <?php endforeach; ?>
                                        <td class="text-end">
                                            <?php $params = $actionParams($model); ?>
                                            <?= Html::a('<i class="ti ti-eye"></i>', array_merge(['view'], $params), ['class' => 'btn btn-icon btn-sm btn-soft-info rounded-pill', 'title' => Yii::t('app', 'View')]) ?>
                                            <?= Html::a('<i class="ti ti-edit"></i>', array_merge(['update'], $params), ['class' => 'btn btn-icon btn-sm btn-soft-primary rounded-pill', 'title' => Yii::t('app', 'Update')]) ?>
                                            <?= Html::a('<i class="ti ti-trash"></i>', array_merge(['delete'], $params), ['class' => 'btn btn-icon btn-sm btn-soft-danger rounded-pill', 'title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?'), 'method' => 'post']]) ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>
<?php
$js = <<<JS
$(document).ready(function() {
    if (typeof $.fn.DataTable !== 'undefined' && $('#{$tableId}').length) {
        $('#{$tableId}').DataTable({
            order: [[0, 'asc']],
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
    }
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
