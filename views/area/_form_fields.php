<?php

use app\models\Area;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Area $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array|null $areasForSelect Lista de áreas para area_padre (id => nombre), null para cargar todas */
?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'area_padre')->dropDownList(
    $areasForSelect ?? ArrayHelper::map(Area::find()->orderBy('nombre')->all(), 'id', 'nombre'),
    ['prompt' => 'Ninguna', 'id' => 'area-area_padre']
) ?>

<?= $form->field($model, 'centro_utilidad')->textInput(['type' => 'number']) ?>

<?= $form->field($model, 'referencia_externa')->textInput(['type' => 'number']) ?>

<?= $form->field($model, 'centro_utilidad_staffing')->textInput(['type' => 'number']) ?>
