<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\search\AdministracionPlantaDashboardSearch $searchModel */
/** @var array $rows */
/** @var array $dashboard */
/** @var array $filterOptions */
/** @var string $activeTab */
?>

<?php
$this->title = 'Resumen por sede';
$this->params['breadcrumbs'][] = ['label' => 'Administración de planta', 'url' => ['dashboard']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
            <div class="flex-grow-1">
                <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
        </div>

        <?= $this->render('_tabs', ['activeTab' => $activeTab]) ?>
        <?= $this->render('_filters', ['searchModel' => $searchModel, 'filterOptions' => $filterOptions, 'exportScope' => 'resumen-sede']) ?>
        <?= $this->render('_kpis', ['kpis' => $dashboard['kpis']]) ?>

        <div class="card">
            <div class="card-body">
                <?= $this->render('_summary_table', ['rows' => $rows, 'tableId' => 'resumen-sede-table']) ?>
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>

<?php
$this->registerJs("$('#resumen-sede-table').DataTable({pageLength: 25, order: [[0,'asc']]});", \yii\web\View::POS_READY);
?>
