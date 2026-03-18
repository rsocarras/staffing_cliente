<?php

/** @var yii\web\View $this */
/** @var app\models\Area $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array|null $areasForSelect */

echo $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'isEdit' => false,
    'areasForSelect' => $areasForSelect ?? null,
]);
