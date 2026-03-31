<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var app\models\Contrato $model */
/** @var array $options */

$prefix = 'add';
$distributionRows = [['sede_id' => '', 'porcentaje' => '']];

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

$subAreasUrlJson = Json::encode(Url::to(['contrato/sub-areas']));
$cargosUrlJson = Json::encode(Url::to(['contrato/cargos-por-estructura']));
?>

<?php $form = ActiveForm::begin([
    'id' => 'form-add-contrato',
    'action' => '',
    'method' => 'post',
    'enableClientValidation' => false,
]); ?>

<?= $form->field($model, 'empresa_id')->hiddenInput()->label(false) ?>

<div id="contrato-add-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>

<!-- Empleado y tipo -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-user fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Empleado y tipo de contrato</h6>
            <p class="text-muted small mb-0">Persona y tipo contractual.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-lg-6">
            <?= $form->field($model, 'profile_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-user text-primary"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($profileItems, ['prompt' => 'Seleccione empleado', 'class' => 'form-select']) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'contrato_tipo_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-file-text text-primary"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($contratoTipoItems, ['prompt' => 'Seleccione tipo de contrato', 'class' => 'form-select']) ?>
        </div>
    </div>
</div>

<!-- Sede, estado y fechas -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-calendar-event fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Sede, estado y vigencia</h6>
            <p class="text-muted small mb-0">Sede principal, estado del contrato y fechas de inicio y fin.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-lg-4">
            <?= $form->field($model, 'sede_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building-store text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($sedeItems, ['prompt' => 'Seleccione sede principal', 'class' => 'form-select']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'estado', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-toggle-right text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($estadoItems, ['prompt' => 'Seleccione estado', 'class' => 'form-select']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'fecha_inicio', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-calendar text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput(['type' => 'date', 'class' => 'form-control']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'fecha_fin', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-calendar-due text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput(['type' => 'date', 'class' => 'form-control']) ?>
        </div>
    </div>
</div>

<!-- Área, subárea y cargo -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-sitemap fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Estructura organizacional</h6>
            <p class="text-muted small mb-0">Área, subárea y cargo asignados al contrato.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-lg-4">
            <?= $form->field($model, 'area_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building text-warning"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($areaItems, ['prompt' => 'Seleccione área', 'id' => 'contrato-area_id-' . $prefix, 'class' => 'form-select']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'sub_area_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hierarchy-2 text-warning"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($subAreaItems, [
                'prompt' => 'Seleccione subárea',
                'id' => 'contrato-sub_area_id-' . $prefix,
                'class' => 'form-select contrato-select-subarea',
                'disabled' => true,
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'cargo_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-briefcase text-warning"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($cargoItems, [
                'prompt' => 'Seleccione cargo',
                'id' => 'contrato-cargo_id-' . $prefix,
                'class' => 'form-select contrato-select-cargo',
                'disabled' => true,
            ]) ?>
        </div>
    </div>
</div>

<div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-chart-pie fs-20"></i>
        </span>
        <div class="flex-grow-1">
            <h6 class="fw-semibold mb-1">Distribución por sedes</h6>
            <p class="text-muted mb-0 small">Si no agrega filas, el contrato cuenta al 100% en la sede principal.</p>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <span class="badge bg-info" id="distribution-total-badge-<?= $prefix ?>">Total: 0%</span>
        <button type="button" class="btn btn-outline-primary btn-sm" id="add-distribution-row-<?= $prefix ?>">
            <i class="ti ti-plus me-1"></i>Agregar distribución
        </button>
    </div>
    <div class="table-responsive">
        <table class="table table-sm align-middle mb-0" id="distribution-table-<?= $prefix ?>">
            <thead>
                <tr>
                    <th>Sede</th>
                    <th style="width: 180px;">Porcentaje</th>
                    <th class="text-end" style="width: 80px;">Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?= Html::dropDownList(
                            "DistribucionSede[0][sede_id]",
                            '',
                            $sedeItems,
                            ['class' => 'form-select distribution-sede', 'prompt' => 'Seleccione sede']
                        ) ?>
                    </td>
                    <td>
                        <?= Html::input(
                            'number',
                            "DistribucionSede[0][porcentaje]",
                            '',
                            ['class' => 'form-control distribution-porcentaje', 'step' => '0.01', 'min' => '0', 'max' => '100']
                        ) ?>
                    </td>
                    <td class="text-end">
                        <button type="button" class="btn btn-icon btn-sm btn-outline-danger remove-distribution-row">
                            <i class="ti ti-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php
$prefixJson = Json::encode($prefix);
$this->registerJs(<<<JS
(function() {
    var prefix = {$prefixJson};
    var subAreasUrl = {$subAreasUrlJson};
    var cargosUrl = {$cargosUrlJson};
    var evNs = '.contratoStructura_' + prefix;

    function rebuildSelect(selector, items, prompt, preferredValue) {
        var \$select = \$(selector);
        var prev = preferredValue !== undefined ? preferredValue : \$select.val();
        \$select.empty().append(\$('<option>', {
            value: '',
            text: prompt
        }));
        items.forEach(function(item) {
            \$select.append(\$('<option>', {
                value: item.id,
                text: item.nombre || ''
            }));
        });
        if (prev !== undefined && prev !== null && prev !== '') {
            var s = String(prev);
            if (items.some(function(it) {
                    return String(it.id) === s;
                })) {
                \$select.val(s);
            }
        }
    }

    function setSubAreaEnabled(on) {
        var \$el = \$('#contrato-sub_area_id-' + prefix);
        if (on) {
            \$el.prop('disabled', false).removeAttr('disabled');
        } else {
            \$el.prop('disabled', true);
        }
    }

    function setCargoEnabled(on) {
        var \$el = \$('#contrato-cargo_id-' + prefix);
        if (on) {
            \$el.prop('disabled', false).removeAttr('disabled');
        } else {
            \$el.prop('disabled', true);
        }
    }

    function syncDisabledWithLoadedOptions() {
        var areaId = \$('#contrato-area_id-' + prefix).val();
        var \$cargo = \$('#contrato-cargo_id-' + prefix);
        var cargoHasRows = \$cargo.find('option').filter(function() {
            return \$(this).val() !== '';
        }).length > 0;
        var subAreaId = \$('#contrato-sub_area_id-' + prefix).val();

        if (!areaId) {
            setSubAreaEnabled(false);
            setCargoEnabled(false);
            return;
        }
        setSubAreaEnabled(true);
        setCargoEnabled(!!subAreaId && cargoHasRows);
    }

    function cascadeFromArea() {
        var areaId = \$('#contrato-area_id-' + prefix).val();
        rebuildSelect('#contrato-sub_area_id-' + prefix, [], 'Seleccione subárea');
        rebuildSelect('#contrato-cargo_id-' + prefix, [], 'Seleccione cargo');
        setCargoEnabled(false);
        if (!areaId) {
            setSubAreaEnabled(false);
            return;
        }
        setSubAreaEnabled(true);
        \$.getJSON(subAreasUrl, {
                area_id: areaId
            })
            .done(function(data) {
                data = Array.isArray(data) ? data : [];
                rebuildSelect('#contrato-sub_area_id-' + prefix, data, 'Seleccione subárea');
                setSubAreaEnabled(true);
                setCargoEnabled(false);
                var \$sub = \$('#contrato-sub_area_id-' + prefix);
                if (data.length === 1) {
                    \$sub.val(String(data[0].id));
                    cascadeFromSubArea();
                }
            })
            .fail(function() {
                rebuildSelect('#contrato-sub_area_id-' + prefix, [], 'Seleccione subárea');
                setSubAreaEnabled(true);
                setCargoEnabled(false);
            });
    }

    function cascadeFromSubArea() {
        var areaId = \$('#contrato-area_id-' + prefix).val();
        var subAreaId = \$('#contrato-sub_area_id-' + prefix).val();
        rebuildSelect('#contrato-cargo_id-' + prefix, [], 'Seleccione cargo');
        if (!areaId || !subAreaId) {
            setCargoEnabled(false);
            return;
        }
        setCargoEnabled(false);
        \$.getJSON(cargosUrl, {
                area_id: areaId,
                sub_area_id: subAreaId
            })
            .done(function(data) {
                data = Array.isArray(data) ? data : [];
                rebuildSelect('#contrato-cargo_id-' + prefix, data, 'Seleccione cargo');
                setCargoEnabled(data.length > 0);
                if (data.length === 1) {
                    \$('#contrato-cargo_id-' + prefix).val(String(data[0].id));
                }
            })
            .fail(function() {
                rebuildSelect('#contrato-cargo_id-' + prefix, [], 'Seleccione cargo');
                setCargoEnabled(false);
            });
    }

    \$(document).off('change' + evNs, '#contrato-area_id-' + prefix);
    \$(document).off('change' + evNs, '#contrato-sub_area_id-' + prefix);
    \$(document).on('change' + evNs, '#contrato-area_id-' + prefix, cascadeFromArea);
    \$(document).on('change' + evNs, '#contrato-sub_area_id-' + prefix, cascadeFromSubArea);

    syncDisabledWithLoadedOptions();
    \$(document).on('shown.bs.modal', '#add_contrato', function() {
        syncDisabledWithLoadedOptions();
    });
})();
JS
    , View::POS_READY);
?>