<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Empresas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="empresas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'social_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entity')->textInput() ?>

    <?= $form->field($model, 'ref_int')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ref_ext')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'tms')->textInput() ?>

    <?= $form->field($model, 'datec')->textInput() ?>

    <?= $form->field($model, 'dateu')->textInput() ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_s')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description_l')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'idu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'supplier_only')->textInput() ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_owner')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
