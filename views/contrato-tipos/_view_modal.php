<?php

use yii\helpers\Html;

/** @var app\models\ContratoTipos $model */
?>

<?php
$requiereFechaFin = $model->requiere_fecha_fin ? 'Sí' : 'No';
$esIndefinido = $model->es_indefinido ? 'Sí' : 'No';
$activoLabel = $model->activo ? 'Sí' : 'No';
?>

<?php
$empresaId = $model->empresa_id ?: '-';
$code = $model->code ?: '-';
$nombre = $model->nombre ?: '-';
$descripcion = $model->descripcion ?: '-';
$duracion = $model->duracion_dias_default ?: '-';
$createdAt = $model->created_at ?: '-';
$updatedAt = $model->updated_at ?: '-';
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-file-invoice me-2 text-primary"></i>
            <?= Html::encode('Tipo de contrato') ?>
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
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-building small"></i></span>
                    <div>
                        <small class="text-muted d-block">Empresa ID</small>
                        <span class="fw-medium"><?= Html::encode((string) $empresaId) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-code small"></i></span>
                    <div>
                        <small class="text-muted d-block">Code</small>
                        <span class="fw-medium"><?= Html::encode((string) $code) ?></span>
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
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-toggle-right small"></i></span>
                    <div>
                        <small class="text-muted d-block">Requiere fecha fin</small>
                        <span class="fw-medium"><?= Html::encode((string) $requiereFechaFin) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-help small"></i></span>
                    <div>
                        <small class="text-muted d-block">Indefinido</small>
                        <span class="fw-medium"><?= Html::encode((string) $esIndefinido) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-clock small"></i></span>
                    <div>
                        <small class="text-muted d-block">Duración (días)</small>
                        <span class="fw-medium"><?= Html::encode((string) $duracion) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-toggle-right small"></i></span>
                    <div>
                        <small class="text-muted d-block">Activo</small>
                        <span class="fw-medium"><?= Html::encode((string) $activoLabel) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-calendar small"></i></span>
                    <div>
                        <small class="text-muted d-block">Created at</small>
                        <span class="fw-medium"><?= Html::encode((string) $createdAt) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-calendar small"></i></span>
                    <div>
                        <small class="text-muted d-block">Updated at</small>
                        <span class="fw-medium"><?= Html::encode((string) $updatedAt) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
