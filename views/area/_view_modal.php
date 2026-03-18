<?php

use yii\helpers\Html;

/** @var app\models\Area $model */
?>

<?php
$areaPadre = $model->areaPadre ? $model->areaPadre->nombre : '-';
$centroUtilidad = $model->centro_utilidad !== null ? (string) $model->centro_utilidad : '-';
$refExterna = $model->referencia_externa !== null ? (string) $model->referencia_externa : '-';
$centroUtilidadStaffing = $model->centro_utilidad_staffing !== null ? (string) $model->centro_utilidad_staffing : '-';
$descripcion = $model->descripcion ?: '-';
$nombre = $model->nombre ?: '-';
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-building me-2 text-primary"></i>
            <?= Html::encode('Área') ?>
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
                        <span class="fw-medium"><?= Html::encode((string) $nombre) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-notes small"></i></span>
                    <div>
                        <small class="text-muted d-block">Descripción</small>
                        <span class="fw-medium"><?= Html::encode((string) $descripcion) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-tree small"></i></span>
                    <div>
                        <small class="text-muted d-block">Área Padre</small>
                        <span class="fw-medium"><?= Html::encode((string) $areaPadre) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-target small"></i></span>
                    <div>
                        <small class="text-muted d-block">Centro Utilidad</small>
                        <span class="fw-medium"><?= Html::encode((string) $centroUtilidad) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-link-2 small"></i></span>
                    <div>
                        <small class="text-muted d-block">Ref. Externa</small>
                        <span class="fw-medium"><?= Html::encode((string) $refExterna) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-coins small"></i></span>
                    <div>
                        <small class="text-muted d-block">Centro Utilidad Staffing</small>
                        <span class="fw-medium"><?= Html::encode((string) $centroUtilidadStaffing) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
