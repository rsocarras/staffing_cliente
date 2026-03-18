<?php

use yii\widgets\ActiveForm;

/** @var app\models\LocationCountry $model */
$form = ActiveForm::begin([
    'id' => 'form-edit-location-country-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="location-country-edit-form-errors" class="alert alert-danger d-none"></div>
<?= $this->render('_form_fields', [
    'model' => $model,
    'form' => $form,
    'modal' => true,
]) ?>

<?php ActiveForm::end(); ?>
