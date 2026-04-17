<?php

use app\models\LocationSedeCargoTarifa;
use yii\helpers\Html;

/** @var app\models\LocationSedesCategory $model */
/** @var app\models\LocationSedes[] $sedes */

$pivotBySede = $model->getPivotTariffsBySedeId();
$tarifaFields = LocationSedeCargoTarifa::tariffColumnNames();
$tarifaLabels = (new LocationSedeCargoTarifa())->attributeLabels();
?>
<div class="sede-category-view-modal-content" data-category-id="<?= (int) $model->id ?>">
    <div class="card border-0 shadow-none mb-0 w-100 rounded-0">
        <div class="card-body pt-0 px-3 px-md-4 pb-4">

            <!-- Tabs -->
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="cat-view-tab-info" data-bs-toggle="pill" data-bs-target="#cat-view-pane-info" type="button" role="tab" aria-controls="cat-view-pane-info" aria-selected="true">
                        <i class="ti ti-category me-1"></i>Categoría
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="cat-view-tab-sedes" data-bs-toggle="pill" data-bs-target="#cat-view-pane-sedes" type="button" role="tab" aria-controls="cat-view-pane-sedes" aria-selected="false">
                        <i class="ti ti-building-store me-1"></i>Sedes
                        <?php if (!empty($sedes)): ?>
                            <span class="badge bg-primary bg-opacity-10 text-primary ms-1"><?= count($sedes) ?></span>
                        <?php endif; ?>
                    </button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Tab: Información de la categoría -->
                <div class="tab-pane fade show active" id="cat-view-pane-info" role="tabpanel" aria-labelledby="cat-view-tab-info">
                    <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                <i class="ti ti-category fs-20"></i>
                            </span>
                            <div>
                                <h6 class="fw-semibold mb-1">Categoría de sedes</h6>
                                <p class="text-muted small mb-0">Datos generales. Las tarifas por tipo de hora están en cada sede (pivote).</p>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <small class="text-muted d-block">ID</small>
                                <span class="fw-medium"><?= (int) $model->id ?></span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Nombre</small>
                                <span class="fw-medium"><?= Html::encode($model->nombre) ?></span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Empresa cliente</small>
                                <span class="fw-medium"><?= $model->empresaCliente ? Html::encode($model->empresaCliente->nombre) : '—' ?></span>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Estado</small>
                                <?= (int) $model->activo === 1
                                    ? '<span class="badge badge-soft-success">Activa</span>'
                                    : '<span class="badge badge-soft-danger">Inactiva</span>' ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab: Sedes asignadas -->
                <div class="tab-pane fade" id="cat-view-pane-sedes" role="tabpanel" aria-labelledby="cat-view-tab-sedes">
                    <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                                <i class="ti ti-building-store fs-20"></i>
                            </span>
                            <div>
                                <h6 class="fw-semibold mb-1">Sedes y tarifas (pivote)</h6>
                                <p class="text-muted small mb-0">Valores configurados por sede en esta categoría.</p>
                            </div>
                        </div>
                        <?php if (empty($sedes)): ?>
                            <div class="text-center py-3 text-muted">
                                <i class="ti ti-building-off fs-2 d-block mb-2 opacity-50"></i>
                                Sin sedes asignadas.
                            </div>
                        <?php else: ?>
                            <?php foreach ($sedes as $sede): ?>
                                <?php
                                $sid = (int) $sede->id;
                                $row = $pivotBySede[$sid] ?? [];
                                ?>
                                <div class="mb-4 pb-3 border-bottom border-light-subtle">
                                    <p class="fw-semibold mb-2"><?= Html::encode($sede->nombre) ?></p>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <?php foreach ($tarifaFields as $f): ?>
                                                        <th class="small"><?= Html::encode((string) ($tarifaLabels[$f] ?? $f)) ?></th>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <?php foreach ($tarifaFields as $f): ?>
                                                        <?php $val = $row[$f] ?? null; ?>
                                                        <td class="text-end small">
                                                            <?= $val !== null && $val !== '' ? Html::encode(Yii::$app->formatter->asDecimal((float) $val, 4)) : '—' ?>
                                                        </td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
