<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\models\StaffingPlanta $model */
/** @var array $sedes */
/** @var array $areas */
/** @var array $subAreas */
/** @var array $cargos */
?>

<div class="card">
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'empresa_id')->hiddenInput()->label(false) ?>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'location_sede_id')->dropDownList(
                    ArrayHelper::map($sedes, 'id', 'nombre'),
                    ['prompt' => 'Seleccione sede']
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'area_id')->dropDownList(
                    ArrayHelper::map($areas, 'id', 'nombre'),
                    ['prompt' => 'Seleccione área', 'id' => 'staffingplanta-area_id']
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sub_area_id')->dropDownList(
                    ArrayHelper::map($subAreas, 'id', 'nombre'),
                    ['prompt' => 'Seleccione subárea', 'id' => 'staffingplanta-sub_area_id']
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'cargo_id')->dropDownList(
                    ArrayHelper::map($cargos, 'id', 'nombre'),
                    ['prompt' => 'Seleccione cargo', 'id' => 'staffingplanta-cargo_id']
                ) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'cantidad_autorizada')->textInput(['type' => 'number', 'step' => '0.01', 'min' => '0']) ?>
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <?= $form->field($model, 'activo')->checkbox() ?>
            </div>
        </div>

        <?php if ($model->getCargoStructureWarning()): ?>
            <div class="alert alert-warning">
                <?= Html::encode($model->getCargoStructureWarning()) ?>
            </div>
        <?php endif; ?>

        <div class="d-flex gap-2">
            <?= Html::submitButton($model->isNewRecord ? 'Guardar planta' : 'Actualizar planta', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$subAreasUrl = Url::to(['sub-areas']);
$cargosUrl = Url::to(['cargos-por-estructura']);
$js = <<<JS
(function() {
    function rebuildSelect(selector, items, prompt) {
        var \$select = $(selector);
        var currentValue = \$select.val();
        \$select.html('<option value="">' + prompt + '</option>');
        items.forEach(function(item) {
            \$select.append('<option value="' + item.id + '">' + item.nombre + '</option>');
        });
        if (currentValue) {
            \$select.val(currentValue);
        }
    }

    function loadSubAreas(areaId) {
        rebuildSelect('#staffingplanta-sub_area_id', [], 'Seleccione subárea');
        rebuildSelect('#staffingplanta-cargo_id', [], 'Seleccione cargo');
        if (!areaId) {
            return;
        }

        $.getJSON('{$subAreasUrl}', {area_id: areaId}, function(data) {
            rebuildSelect('#staffingplanta-sub_area_id', data, 'Seleccione subárea');
            loadCargos(areaId, $('#staffingplanta-sub_area_id').val());
        });
    }

    function loadCargos(areaId, subAreaId) {
        rebuildSelect('#staffingplanta-cargo_id', [], 'Seleccione cargo');
        if (!areaId) {
            return;
        }

        $.getJSON('{$cargosUrl}', {area_id: areaId, sub_area_id: subAreaId}, function(data) {
            rebuildSelect('#staffingplanta-cargo_id', data, 'Seleccione cargo');
        });
    }

    $(document).on('change', '#staffingplanta-area_id', function() {
        loadSubAreas($(this).val());
    });

    $(document).on('change', '#staffingplanta-sub_area_id', function() {
        loadCargos($('#staffingplanta-area_id').val(), $(this).val());
    });
})();
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
