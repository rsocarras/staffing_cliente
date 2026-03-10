<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\models\Contrato $model */
/** @var array $distributionRows */
/** @var array $options */

$profileItems = ArrayHelper::map($options['profiles'], 'user_id', function ($item) {
    $parts = array_filter([
        $item->name,
        $item->user ? '@' . $item->user->username : null,
        $item->num_doc ? 'Doc ' . $item->num_doc : null,
    ]);

    return implode(' | ', $parts);
});
$contratoTipoItems = ArrayHelper::map($options['contratoTipos'], 'id', 'nombre');
$sedeItems = ArrayHelper::map($options['sedes'], 'id', 'nombre');
$areaItems = ArrayHelper::map($options['areas'], 'id', 'nombre');
$subAreaItems = ArrayHelper::map($options['subAreas'], 'id', 'nombre');
$cargoItems = ArrayHelper::map($options['cargos'], 'id', 'nombre');
$estadoItems = $options['estados'];
$sedeJson = json_encode($sedeItems);
?>

<div class="card">
    <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= Html::errorSummary($model, ['class' => 'alert alert-danger']) ?>
        <?= $form->field($model, 'empresa_id')->hiddenInput()->label(false) ?>

        <div class="row g-3">
            <div class="col-lg-6">
                <?= $form->field($model, 'profile_id')->dropDownList($profileItems, ['prompt' => 'Seleccione empleado']) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'contrato_tipo_id')->dropDownList($contratoTipoItems, ['prompt' => 'Seleccione tipo de contrato']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'sede_id')->dropDownList($sedeItems, ['prompt' => 'Seleccione sede principal']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'estado')->dropDownList($estadoItems, ['prompt' => 'Seleccione estado']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'fecha_inicio')->textInput(['type' => 'date']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'fecha_fin')->textInput(['type' => 'date']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'area_id')->dropDownList($areaItems, ['prompt' => 'Seleccione area', 'id' => 'contrato-area_id']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'sub_area_id')->dropDownList($subAreaItems, ['prompt' => 'Seleccione subarea', 'id' => 'contrato-sub_area_id']) ?>
            </div>
            <div class="col-lg-12">
                <?= $form->field($model, 'cargo_id')->dropDownList($cargoItems, ['prompt' => 'Seleccione cargo', 'id' => 'contrato-cargo_id']) ?>
            </div>
        </div>

        <div class="border rounded p-3 mt-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <div>
                    <h5 class="mb-1">Distribucion por sedes</h5>
                    <p class="text-muted mb-0">Si no agrega filas, el contrato cuenta al 100% en la sede principal.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-info" id="distribution-total-badge">Total: 0%</span>
                    <button type="button" class="btn btn-outline-primary btn-sm" id="add-distribution-row">
                        <i class="ti ti-plus me-1"></i>Agregar distribucion
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-sm align-middle mb-0" id="distribution-table">
                    <thead>
                        <tr>
                            <th>Sede</th>
                            <th style="width: 180px;">Porcentaje</th>
                            <th class="text-end" style="width: 80px;">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($distributionRows as $index => $row): ?>
                            <tr>
                                <td>
                                    <?= Html::dropDownList(
                                        "DistribucionSede[{$index}][sede_id]",
                                        $row['sede_id'] ?? '',
                                        $sedeItems,
                                        ['class' => 'form-select distribution-sede', 'prompt' => 'Seleccione sede']
                                    ) ?>
                                </td>
                                <td>
                                    <?= Html::input(
                                        'number',
                                        "DistribucionSede[{$index}][porcentaje]",
                                        $row['porcentaje'] ?? '',
                                        ['class' => 'form-control distribution-porcentaje', 'step' => '0.01', 'min' => '0', 'max' => '100']
                                    ) ?>
                                </td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-icon btn-sm btn-outline-danger remove-distribution-row">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <?= Html::submitButton($model->isNewRecord ? 'Guardar contrato' : 'Actualizar contrato', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$subAreasUrl = Url::to(['sub-areas']);
$cargosUrl = Url::to(['cargos-por-estructura']);
$distributionRowTemplate = <<<'HTML'
<tr>
    <td>
        <select class="form-select distribution-sede" name="DistribucionSede[__index__][sede_id]">
            <option value="">Seleccione sede</option>
        </select>
    </td>
    <td>
        <input type="number" class="form-control distribution-porcentaje" name="DistribucionSede[__index__][porcentaje]" step="0.01" min="0" max="100">
    </td>
    <td class="text-end">
        <button type="button" class="btn btn-icon btn-sm btn-outline-danger remove-distribution-row">
            <i class="ti ti-trash"></i>
        </button>
    </td>
</tr>
HTML;
$distributionRowTemplateJson = json_encode($distributionRowTemplate);
$js = <<<JS
(function() {
    var distributionIndex = $('#distribution-table tbody tr').length;
    var sedes = {$sedeJson};

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

    function updateDistributionTotal() {
        var total = 0;
        $('.distribution-porcentaje').each(function() {
            var value = parseFloat($(this).val());
            if (!isNaN(value)) {
                total += value;
            }
        });
        $('#distribution-total-badge').text('Total: ' + total.toFixed(2) + '%');
        $('#distribution-total-badge')
            .removeClass('bg-info bg-success bg-danger')
            .addClass(total === 0 ? 'bg-info' : (Math.abs(total - 100) < 0.01 ? 'bg-success' : 'bg-danger'));
    }

    function addDistributionRow(values) {
        var html = {$distributionRowTemplateJson};
        html = html.replace(/__index__/g, distributionIndex++);
        var \$row = $(html);
        var \$select = \$row.find('.distribution-sede');
        Object.keys(sedes).forEach(function(id) {
            \$select.append('<option value="' + id + '">' + sedes[id] + '</option>');
        });

        if (values) {
            \$select.val(values.sede_id || '');
            \$row.find('.distribution-porcentaje').val(values.porcentaje || '');
        }

        $('#distribution-table tbody').append(\$row);
        updateDistributionTotal();
    }

    $(document).on('change', '#contrato-area_id', function() {
        var areaId = $(this).val();
        rebuildSelect('#contrato-sub_area_id', [], 'Seleccione subarea');
        rebuildSelect('#contrato-cargo_id', [], 'Seleccione cargo');
        if (!areaId) {
            return;
        }
        $.getJSON('{$subAreasUrl}', {area_id: areaId}, function(data) {
            rebuildSelect('#contrato-sub_area_id', data, 'Seleccione subarea');
        });
    });

    $(document).on('change', '#contrato-sub_area_id', function() {
        var areaId = $('#contrato-area_id').val();
        var subAreaId = $(this).val();
        rebuildSelect('#contrato-cargo_id', [], 'Seleccione cargo');
        if (!areaId) {
            return;
        }
        $.getJSON('{$cargosUrl}', {area_id: areaId, sub_area_id: subAreaId}, function(data) {
            rebuildSelect('#contrato-cargo_id', data, 'Seleccione cargo');
        });
    });

    $('#add-distribution-row').on('click', function() {
        addDistributionRow();
    });

    $(document).on('click', '.remove-distribution-row', function() {
        var rows = $('#distribution-table tbody tr');
        if (rows.length === 1) {
            $(this).closest('tr').find('select, input').val('');
        } else {
            $(this).closest('tr').remove();
        }
        updateDistributionTotal();
    });

    $(document).on('input change', '.distribution-porcentaje, .distribution-sede', updateDistributionTotal);
    updateDistributionTotal();
})();
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
