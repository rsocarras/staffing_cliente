<?php

use app\models\Area;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Cargos $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array|null $areasForSelect Lista de áreas principales (id => nombre) de la empresa, null para calcular desde model.empresa_id */
?>

<?php
if (isset($areasForSelect)) {
    $areasList = $areasForSelect;
} else {
    $empresaId = $model->empresa_id;
    $areasQuery = Area::find()
        ->where(['or', ['area_padre' => null], ['area_padre' => 0]])
        ->orderBy('nombre');
    if ($empresaId) {
        $areasQuery->andWhere(['empresas_id' => $empresaId]);
    }
    $areasList = ArrayHelper::map($areasQuery->all(), 'id', 'nombre');
}
?>

<?= $form->field($model, 'area_id')->dropDownList(
    $areasList,
    ['prompt' => 'Seleccione área', 'id' => 'cargos-area_id']
) ?>

<?= $form->field($model, 'sub_area_id')->dropDownList(
    [],
    ['prompt' => 'Seleccione sub-área', 'id' => 'cargos-sub_area_id']
) ?>

<?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'descripcion')->textarea(['rows' => 3]) ?>

<?= $form->field($model, 'activo')->checkbox() ?>
