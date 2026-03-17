<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-tipo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->isNewRecord && $model->hasAttribute('empresa_id')): ?>
        <?= $form->field($model, 'empresa_id')->textInput(['readonly' => true]) ?>
    <?php elseif (!$model->isNewRecord && $model->hasAttribute('empresas_id')): ?>
        <?= $form->field($model, 'empresas_id')->textInput(['readonly' => true]) ?>
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
