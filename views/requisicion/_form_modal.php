<?php
use app\models\Requisicion;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var Requisicion $model */
/** @var bool $esCreacion */

$esCreacion = isset($esCreacion) ? (bool) $esCreacion : false;

$form = ActiveForm::begin([
    'id' => 'form-edit-requisicion-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="requisicion-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>

<?= $this->render('_form_add_modal_fields', [
    'model' => $model,
    'form' => $form,
    'esCreacion' => false,
]) ?>

<?php ActiveForm::end(); ?>

