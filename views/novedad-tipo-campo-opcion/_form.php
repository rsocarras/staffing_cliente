<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipoCampoOpcion $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-tipo-campo-opcion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'novedad_tipo_campo_id')->textInput() ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'etiqueta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orden')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
