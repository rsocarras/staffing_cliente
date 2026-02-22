<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NovedadFlujoPaso $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-flujo-paso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'novedad_tipo_id')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_paso')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_notif')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'es_inicio')->textInput() ?>

    <?= $form->field($model, 'siguiente_id')->textInput() ?>

    <?= $form->field($model, 'siguiente_si_id')->textInput() ?>

    <?= $form->field($model, 'siguiente_no_id')->textInput() ?>

    <?= $form->field($model, 'condicion_campo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condicion_op')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condicion_valor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
