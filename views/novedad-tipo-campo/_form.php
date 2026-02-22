<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipoCampo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-tipo-campo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'novedad_tipo_id')->textInput() ?>

    <?= $form->field($model, 'orden')->textInput() ?>

    <?= $form->field($model, 'campo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_dato')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'requerido')->textInput() ?>

    <?= $form->field($model, 'calculado')->textInput() ?>

    <?= $form->field($model, 'formula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_length')->textInput() ?>

    <?= $form->field($model, 'val_min')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'val_max')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alerta_max')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fuente_opciones')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'depende_de')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visible_si_campo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visible_si_op')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visible_si_valor')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
