<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NovedadOpcionesDependientes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-opciones-dependientes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'campo_hijo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'campo_padre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor_padre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'etiqueta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orden')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
