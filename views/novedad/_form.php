<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'concepto_id')->textInput() ?>

    <?= $form->field($model, 'novedad_tipo_id')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'borrador' => 'Borrador', 'pendiente' => 'Pendiente', 'aprobada' => 'Aprobada', 'rechazada' => 'Rechazada', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'datos')->textInput() ?>

    <?= $form->field($model, 'schema_snapshot')->textInput() ?>

    <?= $form->field($model, 'alertas')->textInput() ?>

    <?= $form->field($model, 'paso_actual_id')->textInput() ?>

    <?= $form->field($model, 'es_masivo')->textInput() ?>

    <?= $form->field($model, 'lote_masivo_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
