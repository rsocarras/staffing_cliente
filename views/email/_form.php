<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Email $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="email-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'to_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cc_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bcc_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body_html')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'queued' => 'Queued', 'sent' => 'Sent', 'failed' => 'Failed', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'provider')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'external_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'error_message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'sent_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
