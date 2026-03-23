<?php

/** @var yii\web\View $this */
/** @var app\models\NovedadTipo $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $isEdit */

$isEdit = !empty($isEdit);
$activoId = $isEdit ? 'nvt-edit-activo' : 'nvt-add-activo';
?>

<div class="novedad-tipo-modal-form">
    <!-- Identificación -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-tag fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Identificación</h6>
                <p class="text-muted small mb-0">Nombre, descripción e icono del tipo de novedad.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <?= $form->field($model, 'nombre', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-tag text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Nombre del tipo',
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'descripcion', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white align-items-start pt-3"><i class="ti ti-notes text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textarea([
                    'rows' => 3,
                    'class' => 'form-control',
                    'placeholder' => 'Descripción (opcional)',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'icono', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-mood-smile text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => 'Clase o nombre de icono',
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Orden y estado -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-sort-ascending fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Orden y estado</h6>
                <p class="text-muted small mb-0">Orden de visualización y disponibilidad del tipo.</p>
            </div>
        </div>
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <?= $form->field($model, 'orden', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-sort-descending text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'class' => 'form-control',
                    'placeholder' => '0',
                ]) ?>
            </div>
            <div class="col-md-8">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 rounded-3 border bg-white p-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="avatar avatar-sm bg-soft-success text-success rounded d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                            <i class="ti ti-toggle-right fs-18"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-0">Estado</h6>
                            <p class="text-muted small mb-0">Tipo visible en el sistema.</p>
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
    </div>
</div>