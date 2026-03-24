<?php

use app\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Profile $model */

$avatarUrl = $model->photo_ ? Url::to($model->photo_) : Url::to('@web/assets/img/users/user-13.jpg');
$empresaNombre = $model->empresas ? trim((string) ($model->empresas->name ?? $model->empresas->social_name ?? '')) : '';
$empresaNombre = $empresaNombre !== '' ? $empresaNombre : '—';
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <!-- Foto y nombre -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-user fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Colaborador</h6>
                    <p class="text-muted small mb-0">Identificación visual y nombre.</p>
                </div>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-3">
                <div class="avatar avatar-xxl rounded-circle flex-shrink-0">
                    <img class="rounded-circle" src="<?= Html::encode($avatarUrl) ?>" alt="<?= Html::encode($model->name ?: 'Colaborador') ?>">
                </div>
                <div class="flex-grow-1 min-w-0">
                    <p class="fw-semibold fs-16 mb-1"><?= Html::encode($model->name ?: '—') ?></p>
                    <small class="text-muted d-block">User ID <?= Html::encode((string) $model->user_id) ?></small>
                </div>
            </div>
        </div>

        <!-- Documento, contacto y puesto -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-id fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Documento y contacto</h6>
                    <p class="text-muted small mb-0">Identificación, datos de contacto, cargo y estado.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Tipo documento</small>
                    <span class="fw-medium"><?= Html::encode($model->tipo_doc ? (Profile::optsTipoDoc()[$model->tipo_doc] ?? $model->tipo_doc) : '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Número documento</small>
                    <span class="fw-medium"><?= Html::encode($model->num_doc ?: '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Email</small>
                    <span class="fw-medium"><?= Html::encode($model->public_email ?: '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Teléfono</small>
                    <span class="fw-medium"><?= Html::encode($model->telefono ?: '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Cargo</small>
                    <span class="fw-medium"><?= Html::encode($model->cargo ? $model->cargo->nombre : ($model->position ?: '—')) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Estado</small>
                    <?php if ($model->estado): ?>
                        <?php
                        $lbl = Profile::optsEstado()[$model->estado] ?? $model->estado;
                        $cls = Html::encode(Profile::estadoBadgeSoftClass($model->estado));
                        ?>
                        <span class="badge badge-soft-<?= $cls ?>"><?= Html::encode($lbl) ?></span>
                    <?php else: ?>
                        <span class="fw-medium">—</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Organización -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-building fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Ubicación y organización</h6>
                    <p class="text-muted small mb-0">Sede y área asignadas.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Sede</small>
                    <span class="fw-medium"><?= Html::encode($model->sede ? $model->sede->nombre : '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Área</small>
                    <span class="fw-medium"><?= Html::encode($model->area ? $model->area->nombre : '—') ?></span>
                </div>
            </div>
        </div>

        <!-- Dirección y empresa -->
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-map-pin fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Dirección y empresa</h6>
                    <p class="text-muted small mb-0">Domicilio, ciudad y empresa.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <small class="text-muted d-block">Dirección</small>
                    <span class="fw-medium"><?= Html::encode($model->address ?: '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Ciudad</small>
                    <span class="fw-medium"><?= Html::encode($model->city ?: '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Ubicación</small>
                    <span class="fw-medium"><?= Html::encode($model->location ?: '—') ?></span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Empresa</small>
                    <span class="fw-medium"><?= Html::encode($empresaNombre) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
