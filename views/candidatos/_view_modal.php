<?php

use yii\helpers\Html;

/** @var app\models\Candidato $model */
$estadoLabels = \app\models\Candidato::optsEstado();
$sexoLabels = \app\models\Candidato::optsSexo();
?>

<?php
$tipoDocumento = $model->tipo_documento ?? '-';
$numDocumento = $model->num_documento ?? '-';
$birthday = $model->birthday ? Yii::$app->formatter->asDate($model->birthday) : '-';
$sexoLabel = isset($sexoLabels[$model->sexo]) ? $sexoLabels[$model->sexo] : ($model->sexo ?? '-');
$estadoLabel = $estadoLabels[$model->estado] ?? $model->estado;
$observaciones = $model->observaciones ?: '-';
$nombres = $model->nombres ?: '-';
$apellidos = $model->apellidos ?: '-';
$correo = $model->correo ?: '-';
$telefono = $model->telefono ?: '-';
$fullName = trim($nombres . ' ' . $apellidos) ?: '-';
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-user me-2 text-primary"></i>
            <?= Html::encode('Candidato') ?>
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
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-id-badge small"></i></span>
                    <div>
                        <small class="text-muted d-block">Nombre completo</small>
                        <span class="fw-medium"><?= Html::encode((string) $fullName) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-mail small"></i></span>
                    <div>
                        <small class="text-muted d-block">Correo</small>
                        <span class="fw-medium"><?= Html::encode((string) $correo) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-phone small"></i></span>
                    <div>
                        <small class="text-muted d-block">Teléfono</small>
                        <span class="fw-medium"><?= Html::encode((string) $telefono) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-file-text small"></i></span>
                    <div>
                        <small class="text-muted d-block">Tipo documento</small>
                        <span class="fw-medium"><?= Html::encode((string) $tipoDocumento) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-hash small"></i></span>
                    <div>
                        <small class="text-muted d-block">Número documento</small>
                        <span class="fw-medium"><?= Html::encode((string) $numDocumento) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-calendar small"></i></span>
                    <div>
                        <small class="text-muted d-block">Fecha nacimiento</small>
                        <span class="fw-medium"><?= Html::encode((string) $birthday) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-genderless small"></i></span>
                    <div>
                        <small class="text-muted d-block">Sexo</small>
                        <span class="fw-medium"><?= Html::encode((string) $sexoLabel) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-toggle-right small"></i></span>
                    <div>
                        <small class="text-muted d-block">Estado</small>
                        <span class="fw-medium"><?= Html::encode((string) $estadoLabel) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-notes small"></i></span>
                    <div>
                        <small class="text-muted d-block">Observaciones</small>
                        <span class="fw-medium"><?= Html::encode((string) $observaciones) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
