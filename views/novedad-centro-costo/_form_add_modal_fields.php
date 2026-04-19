<?php

/** @var yii\web\View $this */
/** @var app\models\NovedadCentroCosto $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array<int, string> $sedeOptions */
/** @var array<int, string> $empresaClienteOptions */

echo $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'sedeOptions' => $sedeOptions,
    'empresaClienteOptions' => $empresaClienteOptions ?? [],
    'isEdit' => false,
]);
