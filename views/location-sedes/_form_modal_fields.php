<?php

use app\models\LocationSedes;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocationSedes $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $isEdit */
/** @var array $countries */
/** @var int|null $initialCountryId */
/** @var array $initialCities */

$isEdit = !empty($isEdit);
$countryId = $isEdit ? 'sede-edit-country_id' : 'sede-country_id';
$cityId = $isEdit ? 'sede-edit-city_id' : 'sede-city_id';
$activoCheckboxId = $isEdit ? 'sede-modal-edit-activo' : 'sede-modal-add-activo';
?>

<div class="sede-modal-form">
    <?php if (!$model->isNewRecord && $isEdit): ?>
    <div class="rounded-3 border border-dashed p-3 mb-3 bg-light">
        <?= $form->field($model, 'empresa_id', [
            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building text-secondary"></i></span>{input}</div>{error}',
            'options' => ['class' => 'mb-0'],
            'labelOptions' => ['class' => 'form-label fw-medium'],
        ])->textInput(['readonly' => true, 'class' => 'form-control bg-light']) ?>
    </div>
    <?php endif; ?>

    <!-- Identificación -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-building-store fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Identificación</h6>
                <p class="text-muted small mb-0">Código, nombre, dirección y tipo de sede.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <?= $form->field($model, 'codigo', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hash text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Opcional']) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'nombre', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-tag text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Nombre de la sede']) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'direccion', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white align-items-start pt-3"><i class="ti ti-map-pin text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textarea([
                    'rows' => 2,
                    'maxlength' => 255,
                    'class' => 'form-control',
                    'placeholder' => 'Dirección (opcional)',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'tipo_sede', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-category text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList(LocationSedes::optsTipoSede(), [
                    'prompt' => 'Seleccione tipo',
                    'class' => 'form-select',
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Ubicación -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-world fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Ubicación geográfica</h6>
                <p class="text-muted small mb-0">País y ciudad asociados a la sede.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium" for="<?= Html::encode($countryId) ?>">País</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="ti ti-flag text-info"></i></span>
                    <?= Html::dropDownList('country_id', $initialCountryId ?? null, $countries ?? [], [
                        'id' => $countryId,
                        'class' => 'form-select',
                        'prompt' => 'Seleccione país...',
                    ]) ?>
                </div>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'city_id', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building-community text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList($initialCities ?? [], [
                    'prompt' => isset($initialCountryId) ? 'Seleccione ciudad...' : 'Seleccione país primero...',
                    'id' => $cityId,
                    'class' => 'form-select',
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Integración -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-code fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Códigos de integración</h6>
                <p class="text-muted small mb-0">Centros de costo y referencia externa.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <?= $form->field($model, 'centro_costo', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-calculator text-warning"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['type' => 'number', 'class' => 'form-control', 'placeholder' => '—']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'centro_costo_staffing', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-briefcase text-warning"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['type' => 'number', 'class' => 'form-control', 'placeholder' => '—']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'codigo_externo', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-link text-warning"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput(['maxlength' => 50, 'class' => 'form-control', 'placeholder' => '—']) ?>
            </div>
        </div>
    </div>

    <!-- Parámetros de operación -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-secondary text-secondary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-calculator fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Parámetros de operación</h6>
                <p class="text-muted small mb-0">Valores para cálculo de horas y movilización.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <?= $form->field($model, 'valor_hora_diurna', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-currency-dollar text-secondary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'step' => '0.0001',
                    'min' => '0',
                    'class' => 'form-control',
                    'placeholder' => '0.0000',
                    'inputmode' => 'decimal',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'valor_hora_diurna_domingo_festivos', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-calendar-star text-secondary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'step' => '0.0001',
                    'min' => '0',
                    'class' => 'form-control',
                    'placeholder' => '0.0000',
                    'inputmode' => 'decimal',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'valor_hora_nocturna', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-moon text-secondary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'step' => '0.0001',
                    'min' => '0',
                    'class' => 'form-control',
                    'placeholder' => '0.0000',
                    'inputmode' => 'decimal',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'valor_hora_nocturna_dominical_festiva', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-moon-stars text-secondary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'step' => '0.0001',
                    'min' => '0',
                    'class' => 'form-control',
                    'placeholder' => '0.0000',
                    'inputmode' => 'decimal',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'valor_hora_especial', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-star text-secondary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'step' => '0.0001',
                    'min' => '0',
                    'class' => 'form-control',
                    'placeholder' => '0.0000',
                    'inputmode' => 'decimal',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'valor_movilizacion', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-car text-secondary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'step' => '0.0001',
                    'min' => '0',
                    'class' => 'form-control',
                    'placeholder' => '0.0000',
                    'inputmode' => 'decimal',
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Estado -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <span class="avatar avatar-sm bg-soft-success text-success rounded d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                    <i class="ti ti-toggle-right fs-18"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-0">Estado</h6>
                    <p class="text-muted small mb-0">Sede activa u oculta en listados operativos.</p>
                </div>
            </div>
            <div class="form-check form-switch ps-0 mb-0">
                <?= $form->field($model, 'activo', [
                    'template' => '{input}{error}',
                    'options' => ['class' => 'mb-0'],
                ])->checkbox([
                    'class' => 'form-check-input ms-0',
                    'id' => $activoCheckboxId,
                    'label' => '<span class="form-check-label fw-medium ms-2">Activa</span>',
                    'encode' => false,
                ]) ?>
            </div>
        </div>
    </div>
</div>
