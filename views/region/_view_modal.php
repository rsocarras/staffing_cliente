<?php

use yii\helpers\Html;

/** @var app\models\Region $model */
?>

<?php
$countryName = $model->country ? $model->country->name : '-';
$parentRegionName = $model->parentRegion ? $model->parentRegion->name : '-';
$isActive = $model->is_active ? 'Sí' : 'No';
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-world me-2 text-primary"></i>
            <?= Html::encode('Región') ?>
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
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-code small"></i></span>
                    <div>
                        <small class="text-muted d-block">Código</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->code ?: '-')) ?></span>
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
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-category small"></i></span>
                    <div>
                        <small class="text-muted d-block">Tipo</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->type ?: '-')) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-tree small"></i></span>
                    <div>
                        <small class="text-muted d-block">Región padre</small>
                        <span class="fw-medium"><?= Html::encode((string) $parentRegionName) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-toggle-right small"></i></span>
                    <div>
                        <small class="text-muted d-block">Estado</small>
                        <span class="fw-medium"><?= Html::encode((string) $isActive) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
