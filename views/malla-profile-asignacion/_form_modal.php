<?php
use app\models\MallaProfileAsignacion;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var MallaProfileAsignacion $model */
/** @var bool $esCreacion */
?>

<?php
$form = ActiveForm::begin([
    'id' => 'form-edit-malla-profile-asignacion-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="malla-profile-asignacion-edit-form-errors" class="alert alert-danger d-none"></div>

<?= $this->render('_form_fields', [
    'model' => $model,
    'form' => $form,
]) ?>

<?php ActiveForm::end(); ?>

