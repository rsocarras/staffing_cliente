<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MallaDistribucionHoras $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="malla-distribucion-horas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'payroll_period_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'sede_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cargo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centro_costo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centro_utilidad_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'horas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
