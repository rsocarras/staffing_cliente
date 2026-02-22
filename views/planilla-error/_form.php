<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PlanillaError $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="planilla-error-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'import_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'row_number')->textInput() ?>

    <?= $form->field($model, 'col_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'error_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'raw_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
