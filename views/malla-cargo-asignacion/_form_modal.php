<?php
use app\models\MallaCargoAsignacion;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var MallaCargoAsignacion $model */
/** @var bool $esCreacion */
?>

<?php
$form = ActiveForm::begin([
    'id' => 'form-edit-malla-cargo-asignacion-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="malla-cargo-asignacion-edit-form-errors" class="alert alert-danger d-none"></div>

<?= $this->render('_form_fields', [
    'model' => $model,
    'form' => $form,
]) ?>

<?php ActiveForm::end(); ?>

