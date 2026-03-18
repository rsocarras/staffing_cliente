<?php

/** @var yii\web\View $this */
/** @var app\models\LocationSedes $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $countries */
/** @var int|null $initialCountryId */
/** @var array $initialCities */

echo $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'isEdit' => false,
    'countries' => $countries,
    'initialCountryId' => $initialCountryId ?? null,
    'initialCities' => $initialCities ?? [],
]);
