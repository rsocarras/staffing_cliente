<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContabilidadCentroUtilidad $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contabilidad-centro-utilidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->isNewRecord): ?>
    <?= $form->field($model, 'empresa_id')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    <?php endif; ?>

    <?= $this->render('_form_fields', [
        'model' => $model,
        'form' => $form,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
