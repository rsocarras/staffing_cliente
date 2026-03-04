<?php

use app\models\MaestrosConceptos;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MaestrosConceptos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?= $form->field($model, 'code')->textInput(['maxlength' => true, 'id' => 'maestro-concepto-code']) ?>

<?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'maestro-concepto-name']) ?>

<?= $form->field($model, 'category')->dropDownList(
    MaestrosConceptos::optsCategory(),
    ['prompt' => '', 'id' => 'maestro-concepto-category']
) ?>

<?= $form->field($model, 'active')->checkbox(['id' => 'maestro-concepto-active']) ?>

<?= $form->field($model, 'config_json')->textarea(['rows' => 2, 'id' => 'maestro-concepto-config_json']) ?>
