<?php

use app\models\Area;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Cargos $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array|null $areasForSelect */

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

echo $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'isEdit' => false,
    'areasList' => $areasList,
    'subAreasList' => [],
]);
