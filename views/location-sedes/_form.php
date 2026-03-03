<?php

use app\models\City;
use app\models\LocationCountry;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LocationSedes $model */
/** @var yii\widgets\ActiveForm $form */

$countries = ArrayHelper::map(LocationCountry::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
$getCitiesUrl = Url::to(['location-sedes/get-cities']);

$initialCountryId = null;
$initialCities = [];
if ($model->city_id && $model->city) {
    $initialCountryId = $model->city->country_id;
    $initialCities = ArrayHelper::map(City::find()->where(['country_id' => $initialCountryId])->orderBy('name')->all(), 'id', 'name');
}
?>

<div class="location-sedes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!$model->isNewRecord): ?>
    <?= $form->field($model, 'empresa_id')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-locationsedes-country_id">
        <label class="form-label">País</label>
        <?= Html::dropDownList('country_id', $initialCountryId, $countries, [
            'id' => 'sede-country_id',
            'class' => 'form-control',
            'prompt' => 'Seleccione país...',
        ]) ?>
    </div>

    <?= $form->field($model, 'city_id')->dropDownList($initialCities, ['prompt' => 'Seleccione ciudad...', 'id' => 'sede-city_id']) ?>

    <?= $form->field($model, 'centro_costo')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'centro_costo_staffing')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'codigo_externo')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'activo')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<<JS
(function() {
    var getCitiesUrl = '{$getCitiesUrl}';
    var \$country = $('#sede-country_id');
    var \$city = $('#sede-city_id');
    if (typeof jQuery === 'undefined' || !\$country.length) return;
    \$country.on('change', function() {
        var countryId = \$country.val();
        \$city.html('<option value="">Seleccione ciudad...</option>');
        if (!countryId) return;
        \$.get(getCitiesUrl, { country_id: countryId }, function(data) {
            \$.each(data, function(i, c) {
                \$city.append($('<option></option>').val(c.id).text(c.name));
            });
        });
    });
})();
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
