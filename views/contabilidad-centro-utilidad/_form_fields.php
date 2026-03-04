<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContabilidadCentroUtilidad $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?= $form->field($model, 'codigo')->textInput(['maxlength' => true, 'id' => 'centro-utilidad-codigo']) ?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'id' => 'centro-utilidad-nombre']) ?>

<?= $form->field($model, 'activo')->checkbox(['id' => 'centro-utilidad-activo']) ?>
