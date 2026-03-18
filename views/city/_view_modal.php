<?php

use yii\helpers\Html;

/** @var app\models\City $model */
?>

<?php
$countryName = $model->country ? $model->country->name : '-';
$regionName = $model->region ? $model->region->name : '-';
$isCapital = $model->is_capital ? 'Sí' : 'No';
$isActive = $model->is_active ? 'Sí' : 'No';
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-building me-2 text-primary"></i>
            <?= Html::encode('Ciudad') ?>
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
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-flag small"></i></span>
                    <div>
                        <small class="text-muted d-block">País</small>
                        <span class="fw-medium"><?= Html::encode((string) $countryName) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-map-pin small"></i></span>
                    <div>
                        <small class="text-muted d-block">Región</small>
                        <span class="fw-medium"><?= Html::encode((string) $regionName) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-tag small"></i></span>
                    <div>
                        <small class="text-muted d-block">Nombre</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->name ?: '-')) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-star small"></i></span>
                    <div>
                        <small class="text-muted d-block">Capital</small>
                        <span class="fw-medium"><?= Html::encode((string) $isCapital) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-toggle-right small"></i></span>
                    <div>
                        <small class="text-muted d-block">Activo</small>
                        <span class="fw-medium"><?= Html::encode((string) $isActive) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
