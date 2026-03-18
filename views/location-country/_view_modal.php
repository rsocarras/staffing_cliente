<?php

use yii\helpers\Html;

/** @var app\models\LocationCountry $model */
?>

<?php
$isActive = $model->is_active ? (string) Yii::t('app', 'Yes') : (string) Yii::t('app', 'No');
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-flag me-2 text-primary"></i>
            <?= Html::encode('País') ?>
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
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-tag small"></i></span>
                    <div>
                        <small class="text-muted d-block">Nombre</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->name ?: '-')) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-file-text small"></i></span>
                    <div>
                        <small class="text-muted d-block">Nombre oficial</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->official_name ?: '-')) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-key small"></i></span>
                    <div>
                        <small class="text-muted d-block">ISO Alpha2</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->iso_alpha2 ?: '-')) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-key small"></i></span>
                    <div>
                        <small class="text-muted d-block">ISO Alpha3</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->iso_alpha3 ?: '-')) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-map-pin small"></i></span>
                    <div>
                        <small class="text-muted d-block">Región</small>
                        <span class="fw-medium"><?= Html::encode((string) ($model->region ?: '-')) ?></span>
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
