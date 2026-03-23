<?php

use app\models\NovedadFlujo;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var NovedadFlujo $model */
/** @var ActiveForm $form */
/** @var bool $isEdit */

$isEdit = !empty($isEdit);
$estados = NovedadFlujo::estadoLista();
?>

<div class="novedad-flujo-modal-form">
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-git-branch fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1">Flujo de novedad</h6>
                <p class="text-muted small mb-0">Nombre, descripción y estado del flujo.</p>
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
                    'placeholder' => 'Ej. Aprobación vacaciones',
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
                    'placeholder' => 'Opcional',
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'estado', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-toggle-right text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList($estados, [
                    'class' => 'form-select',
                ]) ?>
            </div>
        </div>
    </div>
</div>
