<?php

use yii\helpers\Html;

/** @var app\models\Cargos $model */
?>

<?php
$areaName = $model->area ? $model->area->nombre : '-';
$subAreaName = $model->subArea ? $model->subArea->nombre : '-';
$activoLabel = $model->activo ? 'Sí' : 'No';
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-briefcase me-2 text-primary"></i>
            <?= Html::encode('Cargo') ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-hash small"></i></span>
                    <div>
                        <small class="text-muted d-block">ID</small>
                        <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-code small"></i></span>
                    <div>
                        <small class="text-muted d-block">Código</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->codigo ?: '-')) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-tag small"></i></span>
                    <div>
                        <small class="text-muted d-block">Nombre</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->nombre ?: '-')) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-toggle-right small"></i></span>
                    <div>
                        <small class="text-muted d-block">Estado</small>
                        <span class="fw-medium"><?= Html::encode((string) $activoLabel) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-building small"></i></span>
                    <div>
                        <small class="text-muted d-block">Área</small>
                        <span class="fw-medium"><?= Html::encode((string) $areaName) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-sitemap small"></i></span>
                    <div>
                        <small class="text-muted d-block">Subárea</small>
                        <span class="fw-medium"><?= Html::encode((string) $subAreaName) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-notes small"></i></span>
                    <div>
                        <small class="text-muted d-block">Descripción</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->descripcion ?: '-')) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
