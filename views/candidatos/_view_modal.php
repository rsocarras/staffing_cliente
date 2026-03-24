<?php

use yii\helpers\Html;

/** @var app\models\Candidato $model */

$estadoLabels = \app\models\Candidato::optsEstado();
$sexoLabels = \app\models\Candidato::optsSexo();
$tipoDocumento = $model->tipo_documento ?? '—';
$numDocumento = $model->num_documento ?? '—';
$birthday = $model->birthday ? Yii::$app->formatter->asDate($model->birthday) : '—';
$sexoLabel = isset($sexoLabels[$model->sexo]) ? $sexoLabels[$model->sexo] : ($model->sexo ?? '—');
$estadoLabel = $estadoLabels[$model->estado] ?? $model->estado;
$estadoBadgeCls = \app\models\Candidato::estadoBadgeSoftClass($model->estado);
$observaciones = $model->observaciones !== null && $model->observaciones !== '' ? $model->observaciones : '—';
$nombres = $model->nombres ?: '';
$apellidos = $model->apellidos ?: '';
$fullName = trim($nombres . ' ' . $apellidos) ?: '—';
$correo = $model->correo ?: '—';
$telefono = $model->telefono ?: '—';
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-user fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Identificación</h6>
                    <p class="text-muted small mb-0">Datos principales y estado del candidato.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">ID</small>
                    <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                </div>
                <div class="col-md-8">
                    <small class="text-muted d-block">Nombre completo</small>
                    <span class="fw-medium"><?= Html::encode($fullName) ?></span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Estado</small>
                    <span class="badge badge-soft-<?= Html::encode($estadoBadgeCls) ?>"><?= Html::encode((string) $estadoLabel) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-mail fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Contacto</h6>
                    <p class="text-muted small mb-0">Correo y teléfono.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Correo</small>
                    <span class="fw-medium"><?= Html::encode($correo) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Teléfono</small>
                    <span class="fw-medium"><?= Html::encode($telefono) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-id fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Documento e identidad</h6>
                    <p class="text-muted small mb-0">Documento, fechas y sexo.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block">Tipo documento</small>
                    <span class="fw-medium"><?= Html::encode($tipoDocumento) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Número documento</small>
                    <span class="fw-medium"><?= Html::encode($numDocumento) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Fecha de nacimiento</small>
                    <span class="fw-medium"><?= Html::encode($birthday) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Sexo</small>
                    <span class="fw-medium"><?= Html::encode($sexoLabel) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-notes fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Observaciones</h6>
                    <p class="text-muted small mb-0">Notas adicionales.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <span class="fw-medium"><?= Html::encode($observaciones) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
