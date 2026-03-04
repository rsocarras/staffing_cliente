<?php

use app\models\LocationCountry;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Region $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array|null $countries */
?>

<?php
$countries = $countries ?? ArrayHelper::map(LocationCountry::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
?>

<?= $form->field($model, 'country_id')->dropDownList($countries, ['prompt' => 'Seleccione país...']) ?>

<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'parent_region_id')->textInput() ?>

<?= $form->field($model, 'is_active')->checkbox() ?>
