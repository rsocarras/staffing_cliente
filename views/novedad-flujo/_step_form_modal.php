<?php

use app\models\NovedadFlujo;
use app\models\NovedadStep;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var NovedadFlujo $flujo */
/** @var NovedadStep $step */
/** @var array $profiles */

$formId = $step->isNewRecord ? 'form-add-novedad-step' : 'form-edit-novedad-step';
?>

<?php
$form = ActiveForm::begin([
    'id' => $formId,
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="novedad-step-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>

<?= Html::activeHiddenInput($step, 'novedad_flujo_id', ['value' => $flujo->id]) ?>
<?php if (!$step->isNewRecord): ?>
    <?= Html::activeHiddenInput($step, 'id') ?>
<?php endif; ?>

<div class="row g-3">
    <div class="col-md-6">
        <?= $form->field($step, 'codigo')->textInput([
            'maxlength' => 64,
            'class' => 'form-control',
            'placeholder' => 'ej. aprob_gerencia',
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($step, 'nombre')->textInput([
            'maxlength' => true,
            'class' => 'form-control',
            'placeholder' => 'Etiqueta visible',
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($step, 'tipo_paso')->dropDownList(NovedadStep::tipoPasoLista(), ['class' => 'form-select']) ?>
        <p class="form-text text-muted small mt-1 mb-0">Solo puede existir un paso de <strong>Aprobación</strong> por flujo y debe ser el <strong>último</strong> en el orden.</p>
    </div>
    <div class="col-md-6">
        <?= $form->field($step, 'profile_id')->dropDownList($profiles, [
            'prompt' => 'Sin responsable fijo',
            'class' => 'form-select',
        ]) ?>
    </div>
    <div class="col-12">
        <?= $form->field($step, 'estado')->dropDownList(NovedadStep::estadoLista(), ['class' => 'form-select']) ?>
        <p class="form-text text-muted small mt-1 mb-0">Define el color y la etiqueta de la tarjeta en el tablero Kanban cuando la novedad está en este paso.</p>
    </div>
</div>

<?php ActiveForm::end(); ?>
