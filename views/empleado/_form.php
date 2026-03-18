<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EmpleadoVenueHistory $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="empleado-venue-history-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'fecha_efectiva')->textInput() ?>

    <?= $form->field($model, 'sede_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centro_costo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centro_utilidad_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actor_user_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
