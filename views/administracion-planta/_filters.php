<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\models\search\AdministracionPlantaDashboardSearch $searchModel */
/** @var array $filterOptions */
/** @var string $exportScope */
?>

<div class="card mb-4">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title mb-0">Filtros</h5>
        <button class="btn btn-outline-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#filtros-planta">
            <i class="ti ti-adjustments me-1"></i>Mostrar / ocultar
        </button>
    </div>
    <div id="filtros-planta" class="collapse show">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'method' => 'get',
                'action' => [Yii::$app->controller->action->id],
                'options' => ['class' => 'row g-3'],
            ]); ?>

            <div class="col-md-2">
                <?= $form->field($searchModel, 'region_id')->dropDownList(
                    ArrayHelper::map($filterOptions['regiones'], 'id', 'name'),
                    ['prompt' => 'Región']
                ) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($searchModel, 'city_id')->dropDownList(
                    ArrayHelper::map($filterOptions['ciudades'], 'id', 'name'),
                    ['prompt' => 'Ciudad']
                ) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($searchModel, 'sede_id')->dropDownList(
                    ArrayHelper::map($filterOptions['sedes'], 'id', 'nombre'),
                    ['prompt' => 'Sede']
                ) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($searchModel, 'tipo_sede')->dropDownList($filterOptions['tipoSede'], ['prompt' => 'Tipo sede']) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($searchModel, 'area_id')->dropDownList(
                    ArrayHelper::map($filterOptions['areas'], 'id', 'nombre'),
                    ['prompt' => 'Área', 'id' => 'filtroplanta-area_id']
                ) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($searchModel, 'sub_area_id')->dropDownList(
                    ArrayHelper::map($filterOptions['subAreas'], 'id', 'nombre'),
                    ['prompt' => 'Subárea', 'id' => 'filtroplanta-sub_area_id']
                ) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($searchModel, 'cargo_id')->dropDownList(
                    ArrayHelper::map($filterOptions['cargos'], 'id', 'nombre'),
                    ['prompt' => 'Cargo', 'id' => 'filtroplanta-cargo_id']
                ) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($searchModel, 'estado_cobertura')->dropDownList($filterOptions['estadosCobertura'], ['prompt' => 'Cobertura']) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($searchModel, 'modo_ocupacion')->dropDownList($filterOptions['modosOcupacion']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($searchModel, 'texto')->textInput(['placeholder' => 'Buscar sede o cargo']) ?>
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check me-3">
                    <?= Html::activeCheckbox($searchModel, 'solo_vacantes', ['class' => 'form-check-input', 'label' => 'Solo vacantes']) ?>
                </div>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <?= Html::activeCheckbox($searchModel, 'solo_sobredotacion', ['class' => 'form-check-input', 'label' => 'Solo sobredotación']) ?>
                </div>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2">
                <?= Html::submitButton('<i class="ti ti-search me-1"></i>Aplicar filtros', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Limpiar', [Yii::$app->controller->action->id], ['class' => 'btn btn-outline-secondary']) ?>
                <?= Html::a('<i class="ti ti-file-export me-1"></i>Excel', ['export', 'scope' => $exportScope, 'format' => 'excel'] + Yii::$app->request->queryParams, ['class' => 'btn btn-outline-success']) ?>
                <?= Html::a('<i class="ti ti-printer me-1"></i>PDF / Imprimir', ['export', 'scope' => $exportScope, 'format' => 'pdf'] + Yii::$app->request->queryParams, ['class' => 'btn btn-outline-dark', 'target' => '_blank']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$subAreasUrl = Url::to(['sub-areas']);
$cargosUrl = Url::to(['cargos-por-estructura']);
$js = <<<JS
(function() {
    var areaSelector = '#filtroplanta-area_id';
    var subAreaSelector = '#filtroplanta-sub_area_id';
    var cargoSelector = '#filtroplanta-cargo_id';

    function fillSelect(selector, items, prompt) {
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
        fillSelect(subAreaSelector, [], 'Subárea');
        fillSelect(cargoSelector, [], 'Cargo');
        if (!areaId) {
            return;
        }

        $.getJSON('{$subAreasUrl}', {area_id: areaId}, function(data) {
            fillSelect(subAreaSelector, data, 'Subárea');
            loadCargos(areaId, $(subAreaSelector).val());
        });
    }

    function loadCargos(areaId, subAreaId) {
        fillSelect(cargoSelector, [], 'Cargo');
        if (!areaId) {
            return;
        }

        $.getJSON('{$cargosUrl}', {area_id: areaId, sub_area_id: subAreaId}, function(data) {
            fillSelect(cargoSelector, data, 'Cargo');
        });
    }

    $(document).on('change', areaSelector, function() {
        loadSubAreas($(this).val());
    });

    $(document).on('change', subAreaSelector, function() {
        loadCargos($(areaSelector).val(), $(this).val());
    });
})();
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
