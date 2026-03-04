<?php

use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ContratoTipos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'requiere_fecha_fin')->checkbox() ?>

<?= $form->field($model, 'es_indefinido')->checkbox() ?>

<?= $form->field($model, 'duracion_dias_default')->textInput(['type' => 'number']) ?>

<?= $form->field($model, 'activo')->checkbox() ?>
