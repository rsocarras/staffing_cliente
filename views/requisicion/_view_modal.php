<?php

use app\models\Requisicion;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Requisicion $model */

$estadoLabel = Requisicion::optsEstado()[$model->estado] ?? $model->estado;
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <!-- Identificación -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-receipt fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Identificación</h6>
                    <p class="text-muted small mb-0">Grupo, número de vacante y estado del trámite.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">ID</small>
                    <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Vacante</small>
                    <span class="fw-medium">#<?= (int) $model->vacante_index ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Estado</small>
                    <span class="badge badge-soft-<?= Html::encode(Requisicion::estadoBadgeClass($model->estado)) ?>"><?= Html::encode($estadoLabel) ?></span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Grupo UUID</small>
                    <span class="fw-medium small font-monospace"><?= $model->group_uuid ? Html::encode($model->group_uuid) : '—' ?></span>
                </div>
            </div>
        </div>

        <!-- Ubicación y empresa -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-building-store fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Empresa y ubicación</h6>
                    <p class="text-muted small mb-0">Cliente, ciudad y sede de la vacante.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">Empresa</small>
                    <span class="fw-medium"><?= Html::encode($model->empresa->nombre ?? '—') ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Ciudad</small>
                    <span class="fw-medium"><?= Html::encode($model->ciudad->name ?? '—') ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Sede</small>
                    <span class="fw-medium"><?= Html::encode($model->sede->nombre ?? '—') ?></span>
                </div>
            </div>
        </div>

        <!-- Cargo y fecha -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-briefcase fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Cargo y fecha de ingreso</h6>
                    <p class="text-muted small mb-0">Puesto solicitado y fecha prevista.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Cargo</small>
                    <span class="fw-medium"><?= Html::encode($model->cargo->nombre ?? '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Fecha de ingreso</small>
                    <span class="fw-medium"><?= $model->fecha_ingreso ? Yii::$app->formatter->asDate($model->fecha_ingreso) : '—' ?></span>
                </div>
            </div>
        </div>

        <!-- Persona -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-user fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Persona asignada</h6>
                    <p class="text-muted small mb-0">Candidato o empleado vinculado a esta vacante.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <small class="text-muted d-block">Nombre</small>
                    <span class="fw-medium"><?= Html::encode($model->profile ? ($model->profile->name ?: '—') : '—') ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
