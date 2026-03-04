<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContabilidadCentroCosto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?= $form->field($model, 'codigo')->textInput(['maxlength' => true, 'id' => 'centro-costo-codigo']) ?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'id' => 'centro-costo-nombre']) ?>

<?= $form->field($model, 'activo')->checkbox(['id' => 'centro-costo-activo']) ?>
