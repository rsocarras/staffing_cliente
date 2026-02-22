<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PlanillaImport $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="planilla-import-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'payroll_period_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'template_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'archivo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'uploaded' => 'Uploaded', 'validated' => 'Validated', 'imported' => 'Imported', 'failed' => 'Failed', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'resumen_json')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'processed_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
