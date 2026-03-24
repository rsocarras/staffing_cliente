<?php

use app\models\Profile;
use yii\helpers\Html;

/** @var app\models\Profile $model */

$avatarUrl = $model->getPhotoPublicUrl();
?>

<!-- Profile -->
<div class="row">
    <div class="col-xl-4">
        <div class="mb-3">
            <h6 class="fw-medium mb-1">Profile</h6>
            <span class="fs-13">Foto de perfil</span>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="d-flex align-items-center mb-3">
            <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                <img class="rounded-circle" src="<?= Html::encode($avatarUrl) ?>" alt="img">
            </div>
            <div class="d-inline-flex flex-column align-items-start">
                <span class="fs-13 text-muted">Tamaño recomendado 80px x 80px</span>
            </div>
        </div>
    </div>
</div>

<hr class="mt-0 mb-3">

<!-- Basic Information -->
<div class="row">
    <div class="col-xl-4">
        <div class="mb-3">
            <h6 class="fw-medium mb-1">Información básica</h6>
            <span class="fs-13">Tu información personal</span>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Nombre</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->name ?: '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Tipo documento</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->tipo_doc ? (Profile::optsTipoDoc()[$model->tipo_doc] ?? $model->tipo_doc) : '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Número documento</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->num_doc ?: '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Email</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->public_email ?: '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Teléfono</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->telefono ?: '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Cargo</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->cargo ? $model->cargo->nombre : ($model->position ?: '-')) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<hr class="mt-0 mb-3">

<!-- Address Information -->
<div class="row">
    <div class="col-xl-4">
        <div class="mb-3">
            <h6 class="fw-medium mb-1">Información de dirección</h6>
            <span class="fs-13">Detalles de tu dirección</span>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label text-muted">Dirección</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->address ?: '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Ciudad</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->city ?: '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Ubicación</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->location ?: '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Área</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->area ? $model->area->nombre : '-') ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label text-muted">Empresa</label>
                    <p class="mb-0 fw-medium"><?= Html::encode($model->empresas ? ($model->empresas->name ?? $model->empresas->social_name ?? '') : '-') ?></p>
                </div>
            </div>
        </div>
    </div>
</div>