<?php

use yii\widgets\ActiveForm;

/** @var app\models\Cargos $model */
/** @var yii\web\View $this */
/** @var array $areasList id => nombre */
/** @var array $subAreasList id => nombre */

$areasList = $areasList ?? [];
$subAreasList = $subAreasList ?? [];

$form = ActiveForm::begin([
    'id' => 'form-edit-cargo-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="cargo-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
<?= $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'isEdit' => true,
    'areasList' => $areasList,
    'subAreasList' => $subAreasList,
]) ?>

<?php ActiveForm::end(); ?>
