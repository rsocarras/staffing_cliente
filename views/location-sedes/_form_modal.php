<?php

use yii\widgets\ActiveForm;

/** @var app\models\LocationSedes $model */
/** @var yii\web\View $this */
/** @var array $countries */
/** @var int|null $initialCountryId */
/** @var array $initialCities */

$form = ActiveForm::begin([
    'id' => 'form-edit-sede-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="sede-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
<?= $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'isEdit' => true,
    'countries' => $countries,
    'initialCountryId' => $initialCountryId ?? null,
    'initialCities' => $initialCities ?? [],
]) ?>

<?php ActiveForm::end(); ?>
