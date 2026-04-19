<?php

/** @var yii\web\View $this */
/** @var app\models\NovedadCentroUtilidad $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array<int, string> $areaOptions */
/** @var array<int, string> $empresaClienteOptions */
/** @var bool $isEdit */

$isEdit = !empty($isEdit);
$empresaClienteOptions = $empresaClienteOptions ?? [];
$activoId = $isEdit ? 'ncu-edit-activo' : 'ncu-add-activo';
?>

<div class="ncu-modal-form">
    <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-white">
        <div class="d-flex align-items-start gap-3 mb-3">
            <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                <i class="ti ti-building-community fs-20"></i>
            </span>
            <div>
                <h6 class="fw-semibold mb-1"><?= Yii::t('app', 'Centro de utilidad') ?></h6>
                <p class="text-muted small mb-0"><?= Yii::t('app', 'Un área solo puede tener un centro de utilidad asociado.') ?></p>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-12">
                <?= $form->field($model, 'empresa_cliente_id', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-briefcase text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList($empresaClienteOptions, [
                    'prompt' => Yii::t('app', 'Seleccione la empresa cliente'),
                    'class' => 'form-select js-ncu-empresa-cliente',
                ]) ?>
            </div>
            <div class="col-12">
                <?= $form->field($model, 'area_id', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-folders text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->dropDownList($areaOptions, [
                    'prompt' => Yii::t('app', 'Seleccione el área'),
                    'class' => 'form-select js-ncu-area',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'codigo', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hash text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => Yii::t('app', 'Código interno'),
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'nombre', [
                    'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-typography text-primary"></i></span>{input}</div>{error}{hint}',
                    'options' => ['class' => 'mb-0'],
                    'labelOptions' => ['class' => 'form-label fw-medium'],
                ])->textInput([
                    'maxlength' => true,
                    'class' => 'form-control',
                    'placeholder' => Yii::t('app', 'Nombre visible'),
                ]) ?>
            </div>
            <div class="col-12">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 rounded-3 border bg-white p-3">
                    <div class="d-flex align-items-center gap-3">
                        <span class="avatar avatar-sm bg-soft-success text-success rounded d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                            <i class="ti ti-toggle-right fs-18"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-0"><?= Yii::t('app', 'Estado') ?></h6>
                            <p class="text-muted small mb-0"><?= Yii::t('app', 'Disponible para selección en novedades.') ?></p>
                        </div>
                    </div>
                    <div class="form-check form-switch ps-0 mb-0">
                        <?= $form->field($model, 'activo', [
                            'template' => '{input}{error}',
                            'options' => ['class' => 'mb-0'],
                        ])->checkbox([
                            'class' => 'form-check-input ms-0',
                            'id' => $activoId,
                            'label' => '<span class="form-check-label fw-medium ms-2">' . Yii::t('app', 'Activo') . '</span>',
                            'encode' => false,
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
