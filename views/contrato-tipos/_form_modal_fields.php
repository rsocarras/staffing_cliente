<?php

/** @var yii\web\View $this */
/** @var app\models\ContratoTipos $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $isEdit */

$isEdit = !empty($isEdit);
$sfx = $isEdit ? 'edit' : 'add';
?>

<div class="contrato-tipo-modal-form">
    <!-- Identificación -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-file-text fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Identificación</h6>
                <p class="text-muted small mb-0">Código único, nombre y descripción del tipo.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <?= $form->field($model, 'code', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-code text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Ej. INDEF',
                    'id' => 'ctt-' . $sfx . '-code',
                ]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'nombre', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-tag text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Nombre del tipo',
                    'id' => 'ctt-' . $sfx . '-nombre',
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'descripcion', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white align-items-start pt-3"><i class="ti ti-notes text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textarea([
                    'rows' => 2,
                    'maxlength' => 255,
                    'class' => 'form-control',
                    'placeholder' => 'Opcional (máx. 255 caracteres)',
                    'id' => 'ctt-' . $sfx . '-descripcion',
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Vigencia y reglas -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-calendar-event fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Vigencia y reglas</h6>
                <p class="text-muted small mb-0">Comportamiento del contrato respecto a fechas y duración.</p>
            </div>
        </div>
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <div class="rounded-3 border bg-white p-3 h-100">
                    <div class="form-check form-switch ps-0 mb-0">
                        <?= $form->field($model, 'requiere_fecha_fin', [
                            'template' => '{input}{error}',
                            'options' => ['class' => 'mb-0'],
                        ])->checkbox([
                            'class' => 'form-check-input ms-0',
                            'id' => 'ctt-' . $sfx . '-req-fin',
                            'label' => '<span class="form-check-label fw-medium ms-2">Requiere fecha fin</span>',
                            'encode' => false,
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="rounded-3 border bg-white p-3 h-100">
                    <div class="form-check form-switch ps-0 mb-0">
                        <?= $form->field($model, 'es_indefinido', [
                            'template' => '{input}{error}',
                            'options' => ['class' => 'mb-0'],
                        ])->checkbox([
                            'class' => 'form-check-input ms-0',
                            'id' => 'ctt-' . $sfx . '-indef',
                            'label' => '<span class="form-check-label fw-medium ms-2">Contrato indefinido</span>',
                            'encode' => false,
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'duracion_dias_default', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-clock text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'class' => 'form-control',
                    'placeholder' => 'Días por defecto',
                    'id' => 'ctt-' . $sfx . '-duracion',
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
                    <p class="text-muted small mb-0">Tipo disponible para asignación en el sistema.</p>
                </div>
            </div>
            <div class="form-check form-switch ps-0 mb-0">
                <?= $form->field($model, 'activo', [
                    'template' => '{input}{error}',
                    'options' => ['class' => 'mb-0'],
                ])->checkbox([
                    'class' => 'form-check-input ms-0',
                    'id' => 'ctt-' . $sfx . '-activo',
                    'label' => '<span class="form-check-label fw-medium ms-2">Activo</span>',
                    'encode' => false,
                ]) ?>
            </div>
        </div>
    </div>
</div>
