<?php

use yii\helpers\Html;

/** @var app\models\Cargos $model */

$areaName = $model->area ? $model->area->nombre : '—';
$subAreaName = $model->subArea ? $model->subArea->nombre : '—';
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-briefcase fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Identificación</h6>
                    <p class="text-muted small mb-0">Código, nombre y estado.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">ID</small>
                    <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Código</small>
                    <span class="fw-medium"><?= Html::encode((string) ($model->codigo ?: '—')) ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Activo</small>
                    <?php if ($model->activo): ?>
                        <span class="badge badge-soft-success">Sí</span>
                    <?php else: ?>
                        <span class="badge badge-soft-danger">No</span>
                    <?php endif; ?>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Nombre</small>
                    <span class="fw-medium"><?= Html::encode((string) ($model->nombre ?: '—')) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-sitemap fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Estructura organizacional</h6>
                    <p class="text-muted small mb-0">Área y subárea asociadas.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Área</small>
                    <span class="fw-medium"><?= Html::encode($areaName) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Subárea</small>
                    <span class="fw-medium"><?= Html::encode($subAreaName) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-notes fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Descripción</h6>
                    <p class="text-muted small mb-0">Detalle del cargo.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <span class="fw-medium"><?= Html::encode((string) ($model->descripcion ?: '—')) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
