<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\IntegrationLog $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="integration-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'empresa_integration_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'request_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'endpoint')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'method')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_code')->textInput() ?>

    <?= $form->field($model, 'duration_ms')->textInput() ?>

    <?= $form->field($model, 'request_json')->textInput() ?>

    <?= $form->field($model, 'response_json')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
