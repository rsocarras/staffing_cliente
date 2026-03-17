<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\Requisicion $model */
/** @var bool $esCreacion */

$esCreacion = isset($esCreacion) ? $esCreacion : $model->isNewRecord;
?>
<div class="requisicion-form">
    <?php $form = ActiveForm::begin(['id' => 'requisicion-form']); ?>

    <?= $this->render('_form_fields', [
        'model' => $model,
        'form' => $form,
        'esCreacion' => $esCreacion,
    ]) ?>

    <div class="form-group mt-3">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Requisición' : 'Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
