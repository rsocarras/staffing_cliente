<?php

use app\models\LocationSedes;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var LocationSedes[] $sedes */
/** @var int $sedeId */
/** @var string $date */
/** @var array|null $dayData */

$this->title = 'Timesheet';

if (!function_exists('formatMinutesMalla')) {
    function formatMinutesMalla(int $minutes): string
    {
        $h = intdiv($minutes, 60);
        $m = $minutes % 60;
        return sprintf('%02dh %02dm', $h, $m);
    }
}

if (!function_exists('formatMinuteLabelMalla')) {
    function formatMinuteLabelMalla(int $minutes): string
    {
        $h = intdiv($minutes, 60);
        $m = $minutes % 60;
        return sprintf('%02d:%02d', $h, $m);
    }
}
?>
<div class="page-wrapper">
    <div class="content">
        <div class="card mb-0">
            <div class="card-body">
                <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
                    <div class="flex-grow-1">
                        <h4 class="fs-20 fw-bold mb-0">Timesheet</h4>
                    </div>
                    <div class="text-end">
                        <ol class="breadcrumb m-0 py-0">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['/']) ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Timesheet</li>
                        </ol>
                    </div>
                </div>

                <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                    <li class="nav-item">
                        <a href="<?= Url::to(['pages/timesheet', 'sede_id' => $sedeId, 'date' => $date]) ?>" class="nav-link active">
                            <span class="d-md-inline-block">By Day</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['pages/timesheet-week', 'sede_id' => $sedeId, 'date' => $date]) ?>" class="nav-link">
                            <span class="d-md-inline-block">By Week</span>
                        </a>
                    </li>
                </ul>

                <form method="get" action="<?= Url::to(['pages/timesheet']) ?>" class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <select name="sede_id" class="form-select">
                            <option value="">Seleccione sede</option>
                            <?php foreach ($sedes as $sede): ?>
                                <option value="<?= (int) $sede->id ?>" <?= (int) $sedeId === (int) $sede->id ? 'selected' : '' ?>>
                                    <?= Html::encode($sede->nombre) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="date" name="date" class="form-control" value="<?= Html::encode($date) ?>">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </div>
                </form>

                <?php if ((int) $sedeId <= 0): ?>
                    <div class="alert alert-info mb-0">Selecciona una sede para ver la malla diaria de los empleados.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-nowrap bg-white border mb-0">
                            <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Cargo</th>
                                <th>Malla</th>
                                <th>Total día</th>
                                <th>Distribución (00:00 - 24:00)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!$dayData || empty($dayData['rows'])): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No hay empleados activos en esta sede para la fecha seleccionada.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($dayData['rows'] as $row): ?>
                                    <tr>
                                        <td><?= Html::encode($row['name']) ?></td>
                                        <td><?= Html::encode($row['cargo'] ?: '-') ?></td>
                                        <td>
                                            <?php if (!$row['has_malla']): ?>
                                                <span class="badge bg-warning">Sin malla asignada</span>
                                            <?php else: ?>
                                                <?= Html::encode($row['malla']->nombre) ?>
                                                <small class="text-muted">(<?= Html::encode($row['source']) ?>)</small>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= formatMinutesMalla((int) $row['total_minutes']) ?></td>
                                        <td style="min-width: 420px;">
                                            <div class="progress bg-soft-light py-1 px-1" style="height: 33px;">
                                                <?php if (!empty($row['segments'])): ?>
                                                    <?php foreach ($row['segments'] as $segment): ?>
                                                        <?php
                                                        $width = max(1, (($segment['end'] - $segment['start']) / 1440) * 100);
                                                        $title = formatMinuteLabelMalla($segment['start']) . ' - ' . formatMinuteLabelMalla($segment['end']);
                                                        ?>
                                                        <div
                                                            class="progress-bar bg-success rounded me-1"
                                                            role="progressbar"
                                                            style="width: <?= number_format($width, 2) ?>%;"
                                                            data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            title="<?= Html::encode($title) ?>">
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?= $this->render('layouts/partials/footer') ?>
</div>
