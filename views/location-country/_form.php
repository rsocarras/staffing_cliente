<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LocationCountry $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="location-country-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'official_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'common_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iso_alpha2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iso_alpha3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'iso_numeric')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calling_code_primary')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'calling_codes')->textInput() ?>

    <?= $form->field($model, 'flag_emoji')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag_svg_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flag_png_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'capital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subregion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'currencies')->textInput() ?>

    <?= $form->field($model, 'languages')->textInput() ?>

    <?= $form->field($model, 'tld')->textInput() ?>

    <?= $form->field($model, 'timezones')->textInput() ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
