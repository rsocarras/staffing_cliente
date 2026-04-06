<?php

use app\models\Area;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\Cargos $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array|null $areasForSelect */
/** @var list<array{tipo: \app\models\NovedadTipo, conceptos: list<\app\models\NovedadConcepto>}>|null $conceptosPorAgrupador */
/** @var int[]|null $selectedIdsConceptosCargo */
/** @var string|null $cargoAccordionSuffix */
/** @var string|null $urlAjaxConceptosCargoHtml */

if (isset($areasForSelect)) {
    $areasList = $areasForSelect;
} else {
    $empresaId = $model->empresa_id;
    $areasQuery = Area::find()->orderBy(['nombre' => SORT_ASC]);
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
    'conceptosPorAgrupador' => $conceptosPorAgrupador ?? [],
    'selectedIdsConceptosCargo' => $selectedIdsConceptosCargo ?? [],
    'cargoAccordionSuffix' => $cargoAccordionSuffix ?? 'new',
    'urlAjaxConceptosCargoHtml' => $urlAjaxConceptosCargoHtml ?? \yii\helpers\Url::to(['/cargos/ajax-conceptos-cargo-html']),
]);
