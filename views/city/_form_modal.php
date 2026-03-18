<?php

use app\models\LocationCountry;
use app\models\Region;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var app\models\City $model */
$countries = ArrayHelper::map(LocationCountry::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
$regionsList = [];
if ($model->country_id) {
    $regionsList = ArrayHelper::map(
        Region::find()->where(['country_id' => $model->country_id, 'is_active' => 1])->orderBy('name')->all(),
        'id',
        'name'
    );
}

$form = ActiveForm::begin([
    'id' => 'form-edit-city-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="city-edit-form-errors" class="alert alert-danger d-none"></div>
<?= $form->field($model, 'country_id')->dropDownList($countries, ['prompt' => 'Seleccione país...', 'id' => 'city-edit-country_id']) ?>
<?= $form->field($model, 'region_id')->dropDownList($regionsList, ['prompt' => 'Seleccione región...', 'id' => 'city-edit-region_id']) ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'is_capital')->checkbox() ?>
<?= $form->field($model, 'is_active')->checkbox() ?>

<?php ActiveForm::end(); ?>
