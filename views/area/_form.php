<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Area $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="area-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area_padre')->textInput() ?>

    <?= $form->field($model, 'centro_utilidad')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'referencia_externa')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'centro_utilidad_staffing')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
