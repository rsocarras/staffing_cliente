<?php

/** @var yii\web\View $this */
/** @var app\models\Cargos $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $isEdit */
/** @var array $areasList id => nombre */
/** @var array $subAreasList id => nombre (sub-áreas del área seleccionada) */

$isEdit = !empty($isEdit);
$subAreasList = $subAreasList ?? [];
$areaIdAttr = $isEdit ? 'cargos-edit-area_id' : 'cargos-area_id';
$subAreaIdAttr = $isEdit ? 'cargos-edit-sub_area_id' : 'cargos-sub_area_id';
$activoId = $isEdit ? 'cargos-edit-activo' : 'cargos-add-activo';
?>

<div class="cargo-modal-form">
    <!-- Organización -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-map-pin fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Ubicación organizacional</h6>
                <p class="text-muted small mb-0">Área principal y sub-área a la que pertenece el cargo.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <?= $form->field($model, 'area_id', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList($areasList, [
                    'prompt' => 'Seleccione área',
                    'id' => $areaIdAttr,
                    'class' => 'form-select',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sub_area_id', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-sitemap text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList($subAreasList, [
                    'prompt' => 'Seleccione sub-área',
                    'id' => $subAreaIdAttr,
                    'class' => 'form-select',
                    'disabled' => !$model->area_id,
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Datos del cargo -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-briefcase fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Datos del cargo</h6>
                <p class="text-muted small mb-0">Código interno, nombre y descripción.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <?= $form->field($model, 'codigo', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hash text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Opcional',
                ]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'nombre', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-tag text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Nombre del cargo',
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'descripcion', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white align-items-start pt-3"><i class="ti ti-notes text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textarea([
                    'rows' => 3,
                    'maxlength' => 255,
                    'class' => 'form-control',
                    'placeholder' => 'Descripción breve (opcional, máx. 255 caracteres)',
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
                    <h6 class="fw-semibold mb-0">Estado del cargo</h6>
                    <p class="text-muted small mb-0">Los cargos inactivos no se suelen ofrecer en listas operativas.</p>
                </div>
            </div>
            <div class="form-check form-switch ps-0 mb-0">
                <?= $form->field($model, 'activo', [
                    'template' => '{input}{error}',
                    'options' => ['class' => 'mb-0'],
                ])->checkbox([
                    'class' => 'form-check-input ms-0',
                    'id' => $activoId,
                    'label' => '<span class="form-check-label fw-medium ms-2">Activo</span>',
                    'encode' => false,
                ]) ?>
            </div>
        </div>
    </div>
</div>
