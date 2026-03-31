<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $snapshot */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(Url::to('@web/assets/plugins/apexchart/apexcharts.min.js'), ['depends' => ['yii\web\JqueryAsset']]);
$this->registerCss('.dashboard-kpi-card{transition:box-shadow .2s ease,transform .15s ease}.dashboard-kpi-card:hover{box-shadow:0 .35rem 1rem rgba(15,23,42,.12)!important;transform:translateY(-2px)}.dashboard-donut-grid .dashboard-donut-chart{min-height:min(260px,55vw)}');

$empresaOk = !empty($snapshot['empresaResolved']);
$kpis = $snapshot['kpis'] ?? [];
$charts = $snapshot['charts'] ?? [];

$novedadesEst = $charts['novedadesPorEstado'] ?? [];
$reqEst = $charts['requisicionesPorEstado'] ?? [];
$contratosEst = $charts['contratosPorEstado'] ?? [];
$presupEst = $charts['presupuestosPorEstado'] ?? [];
$mallasEst = $charts['mallasPorEstado'] ?? [];
$novedadesMes = $charts['novedadesUltimosMeses'] ?? ['labels' => [], 'series' => []];

$sumPairs = static function (array $rows): int {
    $s = 0;
    foreach ($rows as $r) {
        $s += (int) ($r['value'] ?? 0);
    }

    return $s;
};

$hasNovedadesEst = $sumPairs($novedadesEst) > 0;
$hasReqEst = $sumPairs($reqEst) > 0;
$hasContratosEst = $sumPairs($contratosEst) > 0;
$hasPresupEst = $sumPairs($presupEst) > 0;
$hasMallasEst = $sumPairs($mallasEst) > 0;
$hasNovedadesMes = array_sum($novedadesMes['series'] ?? []) > 0;
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
            <div class="flex-grow-1">
                <h4 class="fs-20 fw-bold mb-1"><?= Html::encode($this->title) ?></h4>
            </div>
        </div>

        <?php if (!$empresaOk): ?>
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="ti ti-alert-circle fs-4 me-2"></i>
                <div>
                    No se pudo determinar la empresa de la sesión. Los indicadores y gráficos no están disponibles hasta que el usuario tenga un perfil con empresa asignada.
                </div>
            </div>
        <?php else: ?>

            <?php if (empty($kpis)): ?>
                <div class="alert alert-info mb-4" role="alert">
                    No hay indicadores disponibles: ninguna de las tablas de los módulos del dashboard está presente en la base de datos de este entorno (por ejemplo, migraciones pendientes).
                </div>
            <?php endif; ?>

            <div class="row g-3 mb-4">
                <?php foreach ($kpis as $kpi): ?>
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <a href="<?= Html::encode(Url::to($kpi['route'])) ?>" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 dashboard-kpi-card">
                                <div class="card-body d-flex align-items-center gap-3">
                                    <span class="avatar avatar-md bg-primary-subtle text-primary rounded-circle">
                                        <i class="ti <?= Html::encode($kpi['icon']) ?> fs-4"></i>
                                    </span>
                                    <div class="flex-grow-1 min-w-0">
                                        <p class="text-muted mb-0 small text-truncate"><?= Html::encode($kpi['label']) ?></p>
                                        <h3 class="fw-bold mb-0"><?= Html::encode((string) (int) $kpi['value']) ?></h3>
                                    </div>
                                    <i class="ti ti-chevron-right text-muted"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="card h-100">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title mb-0">Requisiciones por estado</h5>
                            <p class="text-muted small mb-0">Pipeline de contratación</p>
                        </div>
                        <div class="card-body">
                            <?php if (!$hasReqEst): ?>
                                <p class="text-muted mb-0">No hay datos registrados.</p>
                            <?php else: ?>
                                <div id="chart-requisiciones-estado" style="min-height: 320px;"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3 mb-4 align-items-stretch dashboard-donut-grid">
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title mb-0">Novedades por estado</h5>
                            <p class="text-muted small mb-0">Distribución de novedades registradas</p>
                        </div>
                        <div class="card-body">
                            <?php if (!$hasNovedadesEst): ?>
                                <p class="text-muted mb-0">No hay datos registrados.</p>
                            <?php else: ?>
                                <div id="chart-novedades-estado" class="dashboard-donut-chart"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title mb-0">Contratos por estado</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!$hasContratosEst): ?>
                                <p class="text-muted mb-0">No hay datos registrados.</p>
                            <?php else: ?>
                                <div id="chart-contratos-estado" class="dashboard-donut-chart"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header border-0 pb-0">
                            <h5 class="card-title mb-0">Mallas por estado de aprobación</h5>
                        </div>
                        <div class="card-body">
                            <?php if (!$hasMallasEst): ?>
                                <p class="text-muted mb-0">No hay datos registrados.</p>
                            <?php else: ?>
                                <div id="chart-mallas-estado" class="dashboard-donut-chart"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col d-none d-md-block" aria-hidden="true"></div>
            </div>

        <?php endif; ?>
    </div>
</div>

<?php
if ($empresaOk && ($hasNovedadesEst || $hasReqEst || $hasContratosEst || $hasMallasEst)) {
    $palette = ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1', '#fd7e14', '#20c997', '#6c757d'];

    $donutSeries = static function (array $rows): array {
        return array_map(static fn($r) => (int) ($r['value'] ?? 0), $rows);
    };
    $donutLabels = static function (array $rows): array {
        return array_map(static fn($r) => (string) ($r['label'] ?? ''), $rows);
    };

    $payload = [
        'novedadesEst' => $hasNovedadesEst ? ['series' => $donutSeries($novedadesEst), 'labels' => $donutLabels($novedadesEst)] : null,
        'reqEst' => $hasReqEst ? ['series' => $donutSeries($reqEst), 'labels' => $donutLabels($reqEst)] : null,
        'contratosEst' => $hasContratosEst ? ['series' => $donutSeries($contratosEst), 'labels' => $donutLabels($contratosEst)] : null,
        'mallasEst' => $hasMallasEst ? ['series' => $donutSeries($mallasEst), 'labels' => $donutLabels($mallasEst)] : null,
        'palette' => $palette,
    ];

    $json = Json::encode($payload);
    $js = <<<JS
(function() {
    var data = $json;
    var pal = data.palette || [];

    function donut(id, pack) {
        if (!pack || !document.querySelector(id)) return;
        new ApexCharts(document.querySelector(id), {
            chart: { type: 'donut', height: 260 },
            labels: pack.labels,
            series: pack.series,
            colors: pal,
            legend: { position: 'bottom', fontSize: '11px' },
            dataLabels: { enabled: true },
            plotOptions: { pie: { donut: { size: '62%' } } }
        }).render();
    }

    donut('#chart-novedades-estado', data.novedadesEst);
    donut('#chart-contratos-estado', data.contratosEst);
    donut('#chart-mallas-estado', data.mallasEst);

    if (data.reqEst && document.querySelector('#chart-requisiciones-estado')) {
        new ApexCharts(document.querySelector('#chart-requisiciones-estado'), {
            chart: { type: 'bar', height: 340, toolbar: { show: false } },
            series: [{ name: 'Requisiciones', data: data.reqEst.series }],
            xaxis: { categories: data.reqEst.labels },
            colors: ['#0d6efd'],
            plotOptions: { bar: { borderRadius: 4, horizontal: true, barHeight: '70%' } },
            dataLabels: { enabled: true },
            yaxis: { labels: { maxWidth: 220 } }
        }).render();
    }

})();
JS;
    $this->registerJs($js, \yii\web\View::POS_READY);
}
?>