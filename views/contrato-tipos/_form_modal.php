<?php

use yii\widgets\ActiveForm;

/** @var app\models\ContratoTipos $model */
/** @var yii\web\View $this */

$form = ActiveForm::begin([
    'id' => 'form-edit-contrato-tipo-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="contrato-tipo-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
<?= $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'isEdit' => true,
]) ?>

<?php ActiveForm::end(); ?>
