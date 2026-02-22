<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ConceptoIntegracionMap $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="concepto-integracion-map-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'provider')->dropDownList([ 'temporapp' => 'Temporapp', 'otro' => 'Otro', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'concepto_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remote_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remote_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'config_json')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
