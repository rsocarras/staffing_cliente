<?php

use yii\helpers\Html;

/** @var app\models\Area $model */

$areaPadre = $model->areaPadre ? $model->areaPadre->nombre : '—';
$centroUtilidad = $model->centro_utilidad !== null ? (string) $model->centro_utilidad : '—';
$refExterna = $model->referencia_externa !== null ? (string) $model->referencia_externa : '—';
$centroUtilidadStaffing = $model->centro_utilidad_staffing !== null ? (string) $model->centro_utilidad_staffing : '—';
$descripcion = $model->descripcion !== null && $model->descripcion !== '' ? $model->descripcion : '—';
$nombre = $model->nombre ?: '—';
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-building fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Identificación</h6>
                    <p class="text-muted small mb-0">Código interno y nombre del área.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">ID</small>
                    <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                </div>
                <div class="col-md-8">
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
                    <p class="text-muted small mb-0">Texto descriptivo del área.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <span class="fw-medium"><?= Html::encode($descripcion) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-sitemap fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Jerarquía y referencias</h6>
                    <p class="text-muted small mb-0">Área padre, centros de utilidad e integración.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Área padre</small>
                    <span class="fw-medium"><?= Html::encode($areaPadre) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Centro utilidad</small>
                    <span class="fw-medium"><?= Html::encode($centroUtilidad) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Ref. externa</small>
                    <span class="fw-medium"><?= Html::encode($refExterna) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Centro utilidad Staffing</small>
                    <span class="fw-medium"><?= Html::encode($centroUtilidadStaffing) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
