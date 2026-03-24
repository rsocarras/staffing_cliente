<?php

use yii\helpers\Html;

/** @var app\models\Contrato $model */
/** @var array $scope */
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <!-- Empleado y tipo -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-user fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Empleado y tipo de contrato</h6>
                    <p class="text-muted small mb-0">Persona y tipo contractual.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Empleado</small>
                    <span class="fw-medium"><?= Html::encode($model->getProfileDisplayName()) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Tipo de contrato</small>
                    <span class="fw-medium"><?= Html::encode($model->contratoTipo ? $model->contratoTipo->nombre : '—') ?></span>
                </div>
            </div>
        </div>

        <!-- Sede, estado y vigencia -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-calendar-event fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Sede, estado y vigencia</h6>
                    <p class="text-muted small mb-0">Sede principal, estado, vigencia por fechas y planta.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6 col-lg-4">
                    <small class="text-muted d-block">Sede principal</small>
                    <span class="fw-medium"><?= Html::encode($model->sede ? $model->sede->nombre : '—') ?></span>
                </div>
                <div class="col-md-6 col-lg-4">
                    <small class="text-muted d-block">Estado</small>
                    <span class="badge badge-soft-<?= Html::encode($model->getEstadoBadgeClass()) ?>"><?= Html::encode($model->getDisplayEstado()) ?></span>
                </div>
                <div class="col-md-6 col-lg-4">
                    <small class="text-muted d-block">Vigencia</small>
                    <span class="badge badge-soft-<?= $model->isCurrentByDate() ? 'success' : 'secondary' ?>"><?= Html::encode($model->getVigenciaLabel()) ?></span>
                </div>
                <div class="col-md-6 col-lg-4">
                    <small class="text-muted d-block">Ocupa planta</small>
                    <span class="badge badge-soft-<?= $model->isOccupyingPlanta() ? 'success' : 'secondary' ?>"><?= $model->isOccupyingPlanta() ? 'Sí' : 'No' ?></span>
                </div>
                <div class="col-md-6 col-lg-4">
                    <small class="text-muted d-block">Fecha inicio</small>
                    <span class="fw-medium"><?= Yii::$app->formatter->asDate($model->fecha_inicio) ?></span>
                </div>
                <div class="col-md-6 col-lg-4">
                    <small class="text-muted d-block">Fecha fin</small>
                    <span class="fw-medium"><?= $model->fecha_fin ? Yii::$app->formatter->asDate($model->fecha_fin) : '—' ?></span>
                </div>
            </div>
        </div>

        <!-- Estructura organizacional -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-sitemap fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Estructura organizacional</h6>
                    <p class="text-muted small mb-0">Área, subárea y cargo asignados al contrato.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">Área</small>
                    <span class="fw-medium"><?= Html::encode($model->area ? $model->area->nombre : '—') ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Subárea</small>
                    <span class="fw-medium"><?= Html::encode($model->subArea ? $model->subArea->nombre : '—') ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Cargo</small>
                    <span class="fw-medium"><?= Html::encode($model->cargo ? $model->cargo->nombre : '—') ?></span>
                </div>
            </div>
        </div>

        <!-- Distribución por sedes -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-chart-pie fs-20"></i>
                </span>
                <div class="flex-grow-1">
                    <h6 class="fw-semibold mb-1">Distribución por sedes</h6>
                    <p class="text-muted small mb-0">Si no hay filas, el contrato cuenta al 100% en la sede principal.</p>
                </div>
            </div>
            <?php if (empty($model->contratoDistribucionSedes)): ?>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">Asignación</span>
                    <span class="badge badge-soft-info">Principal 100%</span>
                </div>
            <?php else: ?>
                <div class="table-responsive rounded-2 border bg-white">
                    <table class="table table-sm align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Sede</th>
                                <th class="text-end pe-3" style="width: 120px;">Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model->contratoDistribucionSedes as $d): ?>
                                <tr>
                                    <td class="ps-3"><?= Html::encode($d->sede ? $d->sede->nombre : '—') ?></td>
                                    <td class="text-end pe-3 fw-medium"><?= Yii::$app->formatter->asDecimal($d->porcentaje, 2) ?>%</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>