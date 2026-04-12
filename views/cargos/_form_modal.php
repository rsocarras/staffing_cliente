<?php

use yii\widgets\ActiveForm;

/** @var app\models\Cargos $model */
/** @var yii\web\View $this */
/** @var array $areasList id => nombre */
/** @var array $subAreasList id => nombre */
/** @var list<array{tipo: \app\models\NovedadTipo, conceptos: list<\app\models\NovedadConcepto>}> $conceptosPorAgrupador */
/** @var int[]|null $selectedIdsConceptosCargo */
/** @var string|null $cargoAccordionSuffix */
/** @var string|null $urlAjaxConceptosCargoHtml */

$areasList = $areasList ?? [];
$subAreasList = $subAreasList ?? [];
$conceptosPorAgrupador = $conceptosPorAgrupador ?? [];
$selectedIdsConceptosCargo = $selectedIdsConceptosCargo ?? [];
$cargoAccordionSuffix = $cargoAccordionSuffix ?? ($model->isNewRecord ? 'new' : (string) (int) $model->id);
$urlAjaxConceptosCargoHtml = $urlAjaxConceptosCargoHtml ?? \yii\helpers\Url::to(['/cargos/ajax-conceptos-cargo-html']);

$form = ActiveForm::begin([
    'id' => 'form-edit-cargo-modal',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]);
?>

<div id="cargo-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>
<?= $this->render('_form_modal_fields', [
    'model' => $model,
    'form' => $form,
    'isEdit' => true,
    'areasList' => $areasList,
    'subAreasList' => $subAreasList,
    'conceptosPorAgrupador' => $conceptosPorAgrupador,
    'selectedIdsConceptosCargo' => $selectedIdsConceptosCargo,
    'cargoAccordionSuffix' => $cargoAccordionSuffix,
    'urlAjaxConceptosCargoHtml' => $urlAjaxConceptosCargoHtml,
]) ?>

<?php ActiveForm::end(); ?>
