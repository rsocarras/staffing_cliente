<?php

use app\models\LocationCountry;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\City $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array|null $countries */
?>

<?php
$countries = $countries ?? ArrayHelper::map(LocationCountry::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
?>

<?= $form->field($model, 'country_id')->dropDownList($countries, ['prompt' => 'Seleccione país...']) ?>

<?= $form->field($model, 'region_id')->textInput() ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'is_capital')->checkbox() ?>

<?= $form->field($model, 'is_active')->checkbox() ?>
