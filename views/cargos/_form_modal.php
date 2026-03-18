<?php

use app\models\Area;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/** @var app\models\Cargos $model */
/** @var yii\web\View $this */

$empresaId = $model->empresa_id;
$areasQuery = Area::find()
    ->where(['or', ['area_padre' => null], ['area_padre' => 0]])
    ->orderBy('nombre');
if ($empresaId) {
    $areasQuery->andWhere(['empresas_id' => $empresaId]);
}
$areasList = ArrayHelper::map($areasQuery->all(), 'id', 'nombre');
$subAreasList = [];
if ($model->area_id) {
    $subAreasList = ArrayHelper::map(
        Area::find()->where(['area_padre' => $model->area_id])->orderBy('nombre')->all(),
        'id',
        'nombre'
    );
}

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
]) ?>

<?php ActiveForm::end(); ?>
