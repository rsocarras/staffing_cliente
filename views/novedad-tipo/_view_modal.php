<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipo $model */

$descripcion = $model->descripcion !== null && $model->descripcion !== '' ? $model->descripcion : '—';
$icono = $model->icono !== null && $model->icono !== '' ? $model->icono : '—';
$orden = $model->orden !== null ? (string) $model->orden : '—';
$nombre = $model->nombre !== null && $model->nombre !== '' ? $model->nombre : '—';
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <!-- Identificación -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-tag fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Identificación</h6>
                    <p class="text-muted small mb-0">Nombre del tipo</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-12">
                    <small class="text-muted d-block">Nombre</small>
                    <span class="fw-medium"><?= Html::encode($nombre) ?></span>
                </div>
            </div>
        </div>

        <!-- Descripción -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-notes fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Descripción</h6>
                    <p class="text-muted small mb-0">Texto explicativo del tipo de novedad.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <span class="fw-medium"><?= Html::encode($descripcion) ?></span>
                </div>
            </div>
        </div>

        <!-- Icono y orden -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-layout-grid fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Presentación y orden</h6>
                    <p class="text-muted small mb-0">Icono (clase Tabler) y posición en listados.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Icono</small>
                    <span class="fw-medium"><i class="<?= Html::encode($icono) ?> fs-20"></i></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Orden</small>
                    <span class="fw-medium"><?= Html::encode($orden) ?></span>
                </div>
            </div>
        </div>

        <!-- Estado -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-toggle-right fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Estado</h6>
                    <p class="text-muted small mb-0">Si el tipo está disponible para usar en novedades.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <small class="text-muted d-block">Activo</small>
                    <?php if ($model->activo): ?>
                        <span class="badge badge-soft-success">Sí</span>
                    <?php else: ?>
                        <span class="badge badge-soft-danger">No</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>