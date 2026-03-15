<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Mallas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mallas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput(['readonly' => true]) ?>

    <?= $this->render('_form_fields', ['model' => $model, 'form' => $form]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
