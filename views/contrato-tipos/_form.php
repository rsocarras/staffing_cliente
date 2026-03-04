<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContratoTipos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contrato-tipos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $this->render('_form_fields', [
        'model' => $model,
        'form' => $form,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
