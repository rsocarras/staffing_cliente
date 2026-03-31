<?php

use yii\helpers\Html;

/** @var app\models\ContratoTipos $model */

$requiereFechaFin = $model->requiere_fecha_fin ? 'Sí' : 'No';
$esIndefinido = $model->es_indefinido ? 'Sí' : 'No';
$activoLabel = $model->activo ? 'Sí' : 'No';
$empresaId = $model->empresa_id !== null ? (string) $model->empresa_id : '—';
$code = $model->code ?: '—';
$nombre = $model->nombre ?: '—';
$descripcion = $model->descripcion !== null && $model->descripcion !== '' ? $model->descripcion : '—';
$duracion = $model->duracion_dias_default !== null ? (string) $model->duracion_dias_default : '—';
$createdAt = $model->created_at ? Yii::$app->formatter->asDatetime($model->created_at) : '—';
$updatedAt = $model->updated_at ? Yii::$app->formatter->asDatetime($model->updated_at) : '—';
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-file-invoice fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Identificación</h6>
                    <p class="text-muted small mb-0">Código interno, empresa y nombre.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <small class="text-muted d-block">ID</small>
                    <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                </div>
                <div class="col-md-6 col-lg-3">
                    <small class="text-muted d-block">Empresa ID</small>
                    <span class="fw-medium"><?= Html::encode($empresaId) ?></span>
                </div>
                <div class="col-md-6 col-lg-3">
                    <small class="text-muted d-block">Código</small>
                    <span class="fw-medium"><?= Html::encode($code) ?></span>
                </div>
                <div class="col-md-6 col-lg-3">
                    <small class="text-muted d-block">Nombre</small>
                    <span class="fw-medium"><?= Html::encode($nombre) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-notes fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Descripción</h6>
                    <p class="text-muted small mb-0">Texto descriptivo del tipo.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <span class="fw-medium"><?= Html::encode($descripcion) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-adjustments fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Reglas de vigencia</h6>
                    <p class="text-muted small mb-0">Fechas, duración indefinida y estado.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6 col-lg-3">
                    <small class="text-muted d-block">Requiere fecha fin</small>
                    <span class="fw-medium"><?= Html::encode($requiereFechaFin) ?></span>
                </div>
                <div class="col-md-6 col-lg-3">
                    <small class="text-muted d-block">Indefinido</small>
                    <span class="fw-medium"><?= Html::encode($esIndefinido) ?></span>
                </div>
                <div class="col-md-6 col-lg-3">
                    <small class="text-muted d-block">Duración (días)</small>
                    <span class="fw-medium"><?= Html::encode($duracion) ?></span>
                </div>
                <div class="col-md-6 col-lg-3">
                    <small class="text-muted d-block">Activo</small>
                    <span class="fw-medium"><?= Html::encode($activoLabel) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-clock fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Auditoría</h6>
                    <p class="text-muted small mb-0">Fechas de creación y última actualización.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Creado</small>
                    <span class="fw-medium"><?= Html::encode($createdAt) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Actualizado</small>
                    <span class="fw-medium"><?= Html::encode($updatedAt) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
