<?php

use yii\widgets\ActiveForm;

/** @var app\models\Novedad $model */
/** @var app\models\NovedadConcepto[] $conceptos */
/** @var app\models\NovedadTipo[] $tipos */
/** @var app\models\NovedadFlujo[] $flujos */

$form = ActiveForm::begin([
    'id' => 'form-edit-novedad-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="novedad-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
<?= $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'conceptos' => $conceptos,
    'tipos' => $tipos,
    'flujos' => $flujos,
]) ?>

<?php ActiveForm::end(); ?>
