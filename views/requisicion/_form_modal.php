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

<div id="requisicion-edit-form-errors" class="alert alert-danger d-none"></div>

<?= $this->render('_form_fields', [
    'model' => $model,
    'form' => $form,
    'esCreacion' => $esCreacion,
]) ?>

<div class="mt-3 d-flex justify-content-between gap-2">
    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-primary" id="btn-save-edit-requisicion">
        <span class="btn-text">Guardar</span>
        <span class="btn-loading d-none">
            <span class="spinner-border spinner-border-sm me-1"></span>
            Guardando...
        </span>
    </button>
</div>

<?php ActiveForm::end(); ?>

