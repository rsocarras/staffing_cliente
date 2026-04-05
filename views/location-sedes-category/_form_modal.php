<?php

use yii\widgets\ActiveForm;

/** @var app\models\LocationSedesCategory $model */
/** @var yii\web\View $this */
/** @var array<int,string> $sedesMap */
/** @var array<int,string> $empresaClientesMap */

$form = ActiveForm::begin([
    'id' => 'form-edit-sede-category-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="sede-category-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
<?= $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'sedesMap' => $sedesMap,
    'empresaClientesMap' => $empresaClientesMap,
]) ?>

<?php ActiveForm::end(); ?>
