<?php

use app\models\Area;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Area $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $isEdit Edición: excluye el propio id del desplegable área padre */
/** @var array|null $areasForSelect Solo creación: lista fija opcional */

$isEdit = !empty($isEdit);

if ($isEdit) {
    $areasList = ArrayHelper::map(
        Area::find()->where(['!=', 'id', $model->id])->orderBy('nombre')->all(),
        'id',
        'nombre'
    );
    $padreSelectId = 'area-edit-area_padre';
} else {
    $areasList = isset($areasForSelect) && is_array($areasForSelect)
        ? $areasForSelect
        : ArrayHelper::map(Area::find()->orderBy('nombre')->all(), 'id', 'nombre');
    $padreSelectId = 'area-area_padre';
}
?>

<div class="area-modal-form">
    <!-- Información básica -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-building fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Información básica</h6>
                <p class="text-muted small mb-0">Nombre, descripción y jerarquía dentro de la organización.</p>
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
                    'placeholder' => 'Ej. Recursos Humanos',
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'descripcion', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white align-items-start pt-3"><i class="ti ti-notes text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textarea([
                    'rows' => 2,
                    'maxlength' => 45,
                    'class' => 'form-control',
                    'placeholder' => 'Máx. 45 caracteres (opcional)',
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'area_padre', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hierarchy-2 text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList($areasList, [
                    'prompt' => 'Sin área padre (nivel raíz)',
                    'id' => $padreSelectId,
                    'class' => 'form-select',
                ]) ?>
            </div>
        </div>
    </div>

    <!-- Códigos e integración -->
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-code fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Códigos e integración</h6>
                <p class="text-muted small mb-0">Identificadores para sistemas externos y staffing.</p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <?= $form->field($model, 'centro_utilidad', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-target text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'class' => 'form-control',
                    'placeholder' => '—',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'referencia_externa', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-link text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'class' => 'form-control',
                    'placeholder' => '—',
                ]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'centro_utilidad_staffing', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-briefcase text-info"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'type' => 'number',
                    'class' => 'form-control',
                    'placeholder' => '—',
                ]) ?>
            </div>
        </div>
    </div>
</div>
