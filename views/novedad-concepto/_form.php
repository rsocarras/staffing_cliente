<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NovedadConcepto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-concepto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'novedad_tipo_id')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'icono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'categoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'permite_masivo')->textInput() ?>

    <?= $form->field($model, 'modo_masivo_ext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sync_temporapp')->textInput() ?>

    <?= $form->field($model, 'va_a_nomina')->textInput() ?>

    <?= $form->field($model, 'correo_notif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tiene_handler')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
