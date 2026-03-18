<?php

use app\models\LocationCountry;
use app\models\Region;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var app\models\Region $model */
$countries = ArrayHelper::map(LocationCountry::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
$parentRegions = [];
if ($model->country_id) {
    $parentQuery = Region::find()->where(['country_id' => $model->country_id])->andWhere(['!=', 'id', $model->id]);
    $parentRegions = ArrayHelper::map($parentQuery->orderBy('name')->all(), 'id', 'name');
}

$form = ActiveForm::begin([
    'id' => 'form-edit-region-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="region-edit-form-errors" class="alert alert-danger d-none"></div>
<?= $form->field($model, 'country_id')->dropDownList($countries, ['prompt' => 'Seleccione país...', 'id' => 'region-edit-country_id']) ?>
<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'parent_region_id')->dropDownList($parentRegions, ['prompt' => 'Ninguna', 'id' => 'region-edit-parent_region_id']) ?>
<?= $form->field($model, 'is_active')->checkbox() ?>

<?php ActiveForm::end(); ?>
