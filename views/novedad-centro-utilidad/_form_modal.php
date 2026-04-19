<?php

use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\NovedadCentroUtilidad $model */
/** @var array<int, string> $areaOptions */
/** @var array<int, string> $empresaClienteOptions */
/** @var string $areasOptionsUrl */

$areasOptionsUrl = $areasOptionsUrl ?? '';

$form = ActiveForm::begin([
    'id' => 'form-edit-ncu-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
    'options' => $areasOptionsUrl !== '' ? ['data-areas-options-url' => $areasOptionsUrl] : [],
]);
?>

<div id="ncu-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
<?= $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'areaOptions' => $areaOptions,
    'empresaClienteOptions' => $empresaClienteOptions ?? [],
    'isEdit' => true,
]) ?>

<?php ActiveForm::end(); ?>
