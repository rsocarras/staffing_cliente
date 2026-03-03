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

    <?= $this->render('_form_fields', [
        'model' => $model,
        'form' => $form,
        'countries' => $countries,
        'initialCountryId' => $initialCountryId,
        'initialCities' => $initialCities,
    ]) ?>

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
