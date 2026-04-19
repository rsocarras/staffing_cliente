<?php

use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NovedadCentroCosto $model */
/** @var array<int, string> $sedeOptions */
/** @var array<int, string> $empresaClienteOptions */
/** @var string $sedesOptionsUrl */

$sedesOptionsUrl = $sedesOptionsUrl ?? '';

$form = ActiveForm::begin([
    'id' => 'form-edit-ncc-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
    'options' => $sedesOptionsUrl !== '' ? ['data-sedes-options-url' => $sedesOptionsUrl] : [],
]);
?>

<div id="ncc-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
<?= $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'sedeOptions' => $sedeOptions,
    'empresaClienteOptions' => $empresaClienteOptions ?? [],
    'isEdit' => true,
]) ?>

<?php ActiveForm::end(); ?>
