<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'id' => 'novedad-tipo-nombre']) ?>

<?= $form->field($model, 'descripcion')->textarea(['rows' => 3, 'id' => 'novedad-tipo-descripcion']) ?>

<?= $form->field($model, 'icono')->textInput(['maxlength' => true, 'id' => 'novedad-tipo-icono']) ?>

<?= $form->field($model, 'orden')->textInput(['type' => 'number', 'id' => 'novedad-tipo-orden']) ?>

<?= $form->field($model, 'activo')->checkbox(['id' => 'novedad-tipo-activo']) ?>
