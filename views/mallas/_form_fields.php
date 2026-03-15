<?php

/** @var yii\web\View $this */
/** @var app\models\Mallas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tipo')->dropDownList([
    'fija' => 'Fija',
    'rotativa' => 'Rotativa',
], ['prompt' => 'Seleccione tipo']) ?>

<?= $form->field($model, 'activo')->dropDownList([1 => 'Sí', 0 => 'No']) ?>

<?= $form->field($model, 'config_json')->textarea(['rows' => 4]) ?>
