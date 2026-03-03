<?php

use app\models\City;
use app\models\LocationCountry;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocationSedes $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $countries */
/** @var int|null $initialCountryId */
/** @var array $initialCities */
?>

<?php if (!$model->isNewRecord): ?>
<?= $form->field($model, 'empresa_id')->textInput(['maxlength' => true, 'readonly' => true]) ?>
<?php endif; ?>

<?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

<div class="form-group field-locationsedes-country_id">
    <label class="form-label">País</label>
    <?= Html::dropDownList('country_id', $initialCountryId ?? null, $countries ?? [], [
        'id' => 'sede-country_id',
        'class' => 'form-control',
        'prompt' => 'Seleccione país...',
    ]) ?>
</div>

<?= $form->field($model, 'city_id')->dropDownList($initialCities ?? [], ['prompt' => isset($initialCountryId) ? 'Seleccione ciudad...' : 'Seleccione país primero...', 'id' => 'sede-city_id']) ?>

<?= $form->field($model, 'centro_costo')->textInput(['type' => 'number']) ?>

<?= $form->field($model, 'centro_costo_staffing')->textInput(['type' => 'number']) ?>

<?= $form->field($model, 'codigo_externo')->textInput(['maxlength' => 50]) ?>

<?= $form->field($model, 'activo')->checkbox() ?>
