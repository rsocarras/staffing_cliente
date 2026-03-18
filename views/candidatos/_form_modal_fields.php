<?php

use app\models\Candidato;
use app\models\Profile;

/** @var yii\web\View $this */
/** @var app\models\Candidato $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $isEdit */

$isEdit = !empty($isEdit);
$pfx = $isEdit ? 'candidato-edit' : 'candidato-add';
?>

<div class="candidato-modal-form">
    <!-- Datos personales -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-user fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Datos personales</h6>
                <p class="text-muted small mb-0">Nombre, apellidos y datos de contacto.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <?= $form->field($model, 'nombres', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-id text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Nombres']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'apellidos', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-id text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Apellidos']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'correo', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-mail text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['maxlength' => true, 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'correo@ejemplo.com']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'telefono', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-phone text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Teléfono']) ?>
            </div>
        </div>
    </div>

    <!-- Documento y nacimiento -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-id-badge fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Documento y nacimiento</h6>
                <p class="text-muted small mb-0">Tipo y número de documento, fecha de nacimiento y sexo.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <?= $form->field($model, 'tipo_documento', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-file-certificate text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList(Profile::optsTipoDoc(), [
                    'prompt' => 'Seleccione',
                    'id' => $pfx . '-tipo_documento',
                    'class' => 'form-select',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'num_documento', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hash text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Número']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'birthday', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-calendar text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->input('date', ['class' => 'form-control']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sexo', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-gender-bigender text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList(Candidato::optsSexo(), [
                    'prompt' => 'Seleccione',
                    'id' => $pfx . '-sexo',
                    'class' => 'form-select',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'estado', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-toggle-right text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList(Candidato::optsEstado(), [
                    'id' => $pfx . '-estado',
                    'class' => 'form-select',
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Observaciones -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-notes fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Observaciones</h6>
                <p class="text-muted small mb-0">Notas adicionales sobre el candidato (opcional).</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <?= $form->field($model, 'observaciones', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white align-items-start pt-3"><i class="ti ti-notes text-warning"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textarea(['rows' => 3, 'class' => 'form-control', 'placeholder' => 'Observaciones']) ?>
            </div>
        </div>
    </div>
</div>
