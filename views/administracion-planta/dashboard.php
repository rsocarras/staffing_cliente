<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\search\AdministracionPlantaDashboardSearch $searchModel */
/** @var array $dashboard */
/** @var array $filterOptions */
/** @var string $activeTab */
?>

<?php
$this->title = 'Administración de planta';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(Url::to('@web/assets/plugins/apexchart/apexcharts.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerCssFile(Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css'), ['depends' => ['app\assets\AppAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
            <div class="flex-grow-1">
                <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                <p class="mb-0 text-muted">Modo analítico base: <?= Html::encode($searchModel->getModoLabel()) ?></p>
            </div>
            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>">Home</a></li>
                    <li class="breadcrumb-item active"><?= Html::encode($this->title) ?></li>
                </ol>
            </div>
        </div>

        <?= $this->render('_tabs', ['activeTab' => $activeTab]) ?>
        <?= $this->render('_filters', ['searchModel' => $searchModel, 'filterOptions' => $filterOptions, 'exportScope' => 'resumen-sede']) ?>
        <?= $this->render('_kpis', ['kpis' => $dashboard['kpis']]) ?>

        <div class="row g-4 mb-4">
            <div class="col-xl-8">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Cobertura por sede</h5>
                    </div>
                    <div class="card-body">
                        <div id="chart-coverage-sede" style="min-height: 340px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Cobertura por área</h5>
                    </div>
                    <div class="card-body">
                        <div id="chart-coverage-area" style="min-height: 340px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-6">
                <div class="card h-100">
                    <div class="card-header"><h5 class="card-title mb-0">Top cargos con vacantes</h5></div>
                    <div class="card-body">
                        <?php if (empty($dashboard['topCargosVacantes'])): ?>
                            <p class="text-muted mb-0">No hay cargos con vacantes bajo los filtros actuales.</p>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($dashboard['topCargosVacantes'] as $item): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><?= Html::encode($item['label']) ?></span>
                                    <span class="badge bg-warning"><?= Yii::$app->formatter->asDecimal($item['vacantes'], 2) ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card h-100">
                    <div class="card-header"><h5 class="card-title mb-0">Top cargos con sobredotación</h5></div>
                    <div class="card-body">
                        <?php if (empty($dashboard['topCargosSobredotacion'])): ?>
                            <p class="text-muted mb-0">No hay cargos sobredotados bajo los filtros actuales.</p>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($dashboard['topCargosSobredotacion'] as $item): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <span><?= Html::encode($item['label']) ?></span>
                                    <span class="badge bg-danger"><?= Yii::$app->formatter->asDecimal(abs($item['vacantes']), 2) ?></span>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Resumen por sede</h5>
                <a href="<?= Url::to(['resumen-sede'] + Yii::$app->request->queryParams) ?>" class="btn btn-outline-primary btn-sm">Ver tabla completa</a>
            </div>
            <div class="card-body">
                <?= $this->render('_summary_table', ['rows' => array_slice($dashboard['resumenSede'], 0, 20), 'tableId' => 'resumen-sede-dashboard']) ?>
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>

<?php
$sedeLabels = array_column($dashboard['chartBySede'], 'label');
$sedeCoverage = array_map('floatval', array_column($dashboard['chartBySede'], 'cobertura'));
$areaLabels = array_column($dashboard['chartByArea'], 'label');
$areaCoverage = array_map('floatval', array_column($dashboard['chartByArea'], 'cobertura'));
$js = <<<JS
$(function() {
    $('#resumen-sede-dashboard').DataTable({
        pageLength: 10,
        order: [[0, 'asc']],
        language: {
            search: 'Buscar:',
            lengthMenu: 'Mostrar _MENU_ registros',
            info: 'Mostrando _START_ a _END_ de _TOTAL_ registros'
        }
    });

    if (document.getElementById('chart-coverage-sede')) {
        new ApexCharts(document.querySelector('#chart-coverage-sede'), {
            chart: { type: 'bar', height: 340, toolbar: { show: false } },
            series: [{ name: '% cobertura', data: %SEDE_COVERAGE% }],
            xaxis: { categories: %SEDE_LABELS% },
            colors: ['#0d6efd'],
            plotOptions: { bar: { borderRadius: 6, horizontal: false } }
        }).render();
    }

    if (document.getElementById('chart-coverage-area')) {
        new ApexCharts(document.querySelector('#chart-coverage-area'), {
            chart: { type: 'bar', height: 340, toolbar: { show: false } },
            series: [{ name: '% cobertura', data: %AREA_COVERAGE% }],
            xaxis: { categories: %AREA_LABELS% },
            colors: ['#198754'],
            plotOptions: { bar: { borderRadius: 6, horizontal: true } }
        }).render();
    }
});
JS;
$js = str_replace(
    ['%SEDE_LABELS%', '%SEDE_COVERAGE%', '%AREA_LABELS%', '%AREA_COVERAGE%'],
    [
        json_encode($sedeLabels),
        json_encode($sedeCoverage),
        json_encode($areaLabels),
        json_encode($areaCoverage),
    ],
    $js
);
$this->registerJs($js, \yii\web\View::POS_READY);
?>
