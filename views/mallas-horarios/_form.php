<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MallasHorarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mallas-horarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'malla_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dia_semana')->textInput() ?>

    <?= $form->field($model, 'hora_inicio')->textInput() ?>

    <?= $form->field($model, 'hora_fin')->textInput() ?>

    <?= $form->field($model, 'minutos_descanso')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
