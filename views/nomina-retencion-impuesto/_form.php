<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NominaRetencionImpuesto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="nomina-retencion-impuesto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'config_json')->textInput() ?>

    <?= $form->field($model, 'activo')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
