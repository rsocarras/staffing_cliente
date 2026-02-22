<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MaestrosConceptos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="maestros-conceptos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList([ 'ingreso' => 'Ingreso', 'deduccion' => 'Deduccion', 'aporte' => 'Aporte', 'provision' => 'Provision', 'otro' => 'Otro', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <?= $form->field($model, 'config_json')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
