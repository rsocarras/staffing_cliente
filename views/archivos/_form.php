<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Archivos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="archivos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'storage')->dropDownList([ 'local' => 'Local', 's3' => 'S3', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'size_bytes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sha256')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'uploaded_by')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
