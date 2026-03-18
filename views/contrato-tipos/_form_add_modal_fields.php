<?php

/** @var yii\web\View $this */
/** @var app\models\ContratoTipos $model */
/** @var yii\widgets\ActiveForm $form */

echo $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'isEdit' => false,
]);
