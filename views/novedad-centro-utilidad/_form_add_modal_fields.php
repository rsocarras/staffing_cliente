<?php

/** @var yii\web\View $this */
/** @var app\models\NovedadCentroUtilidad $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array<int, string> $areaOptions */
/** @var array<int, string> $empresaClienteOptions */

echo $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'areaOptions' => $areaOptions,
    'empresaClienteOptions' => $empresaClienteOptions ?? [],
    'isEdit' => false,
]);
