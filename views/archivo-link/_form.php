<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ArchivoLink $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="archivo-link-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'archivo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entidad_type')->dropDownList([ 'empleado' => 'Empleado', 'contrato' => 'Contrato', 'novedad' => 'Novedad', 'ss_ausentismo' => 'Ss ausentismo', 'nomina' => 'Nomina', 'otro' => 'Otro', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'entidad_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'etiqueta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
