<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Requisicion $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $esCreacion */

$esCreacion = isset($esCreacion) ? $esCreacion : $model->isNewRecord;
$tenantEmpresaId = Yii::$app->user->empresas_id ?? null;
$tiposContratoRows = \app\models\ContratoTipos::find()
    ->where(['activo' => 1])
    ->orderBy(['nombre' => SORT_ASC])
    ->all();
$tiposContrato = ArrayHelper::map($tiposContratoRows, 'id', 'nombre');
$tiposContratoCodeMap = [];
foreach ($tiposContratoRows as $tc) {
    $tiposContratoCodeMap[(string) $tc->id] = (string) ($tc->code ?? '');
}
$empresaClienteId = $model->empresa_cliente_id ? (int) $model->empresa_cliente_id : '';
$areaId = $model->area_id ? (int) $model->area_id : '';
$subAreaId = $model->sub_area_id ? (int) $model->sub_area_id : '';
$cargoId = $model->cargo_id ? (int) $model->cargo_id : '';
$jornadaSelector = $model->jornada_selector ?: '';
?>
<div class="row">
    <div class="col-md-12">
        <h5 class="mb-3">Datos de la vacante</h5>
        <?= $form->field($model, 'empresa_cliente_id')->dropDownList(
            ArrayHelper::map(\app\models\EmpresaCliente::getActivos($tenantEmpresaId ? (int) $tenantEmpresaId : null), 'id', 'nombre'),
            ['prompt' => 'Seleccione empresa cliente', 'id' => 'requisicion-empresa_cliente_id', 'class' => 'form-select']
        ) ?>
        <?= $form->field($model, 'fecha_ingreso')->input('datetime-local') ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'ciudad_id')->dropDownList(ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name'), ['prompt' => 'Seleccione ciudad', 'id' => 'requisicion-ciudad_id', 'class' => 'form-select']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sede_id')->dropDownList([], ['prompt' => 'Primero seleccione ciudad', 'id' => 'requisicion-sede_id', 'class' => 'form-select', 'disabled' => true]) ?>
            </div>
        </div>
        <?= $form->field($model, 'area_id')->dropDownList([], [
            'prompt' => 'Primero seleccione empresa cliente',
            'id' => 'requisicion-area_id',
            'class' => 'form-select',
            'disabled' => true,
        ]) ?>
        <?= $form->field($model, 'sub_area_id')->dropDownList([], ['prompt' => 'Primero seleccione área', 'id' => 'requisicion-sub_area_id', 'class' => 'form-select', 'disabled' => true]) ?>
        <?= $form->field($model, 'cargo_id')->dropDownList([], ['prompt' => 'Primero seleccione área', 'id' => 'requisicion-cargo_id', 'class' => 'form-select', 'disabled' => true]) ?>
        <?= $form->field($model, 'tipo_contrato')->dropDownList(\app\models\Requisicion::optsTipoContrato(), ['prompt' => 'Seleccione modalidad de vinculación']) ?>
        <?= $form->field($model, 'contrato_tipo_id')->dropDownList($tiposContrato, ['prompt' => 'Seleccione tipo de contrato']) ?>
        <?= $form->field($model, 'jornada_selector', ['options' => ['id' => 'requisicion-jornada-selector-wrap']])->dropDownList([
            '110' => '110',
            '220' => '220',
            'otro' => 'Otro',
        ], ['prompt' => 'Seleccione jornada', 'id' => 'requisicion-jornada_selector']) ?>
        <div id="requisicion-jornada-otro-wrap" class="d-none">
            <?= $form->field($model, 'jornada_otro')->textInput([
                'type' => 'number',
                'step' => '0.01',
                'min' => 100,
                'max' => 300,
                'id' => 'requisicion-jornada_otro',
            ])->hint('Debe estar entre 100 y 300.') ?>
        </div>
        <?= $form->field($model, 'jornada')->hiddenInput(['id' => 'requisicion-jornada'])->label(false) ?>
        <?= $form->field($model, 'salario')->textInput(['type' => 'text', 'inputmode' => 'numeric', 'autocomplete' => 'off']) ?>
        <?= $form->field($model, 'auxilio')->textInput(['type' => 'text', 'inputmode' => 'numeric', 'autocomplete' => 'off']) ?>
        <?= $form->field($model, 'esquema_variable_id')->dropDownList(ArrayHelper::map(\app\models\EsquemaVariable::getActivos(), 'id', 'nombre'), ['prompt' => 'Opcional']) ?>
        <?= $form->field($model, 'motivo_vinculacion_id')->dropDownList(ArrayHelper::map(\app\models\MotivoVinculacion::getActivos(), 'id', 'nombre'), ['prompt' => 'Opcional']) ?>
        <?php if ($esCreacion): ?>
            <?= $form->field($model, 'numero_vacantes')->textInput(['type' => 'number', 'min' => 1])->hint('Se crearán N requisiciones (1 por vacante)') ?>
        <?php endif; ?>
    </div>
</div>

<?php
$sedesUrl = Url::to(['/requisicion/sedes-por-ciudad']);
$areasUrl = Url::to(['/requisicion/areas-por-empresa-cliente']);
$subAreasUrl = Url::to(['/requisicion/sub-areas-por-area']);
$cargosUrl = Url::to(['/requisicion/cargos-por-sub-area']);
$ciudadId = $model->ciudad_id ?: '';
$sedeId = $model->sede_id ?: '';
$tiposContratoCodeMapJson = json_encode($tiposContratoCodeMap, JSON_UNESCAPED_UNICODE);

$js = <<<JS
(function() {
    var sedesUrl = '{$sedesUrl}';
    var areasUrl = '{$areasUrl}';
    var subAreasUrl = '{$subAreasUrl}';
    var cargosUrl = '{$cargosUrl}';
    var ciudadId = '{$ciudadId}';
    var sedeId = '{$sedeId}';
    var empresaClienteId = '{$empresaClienteId}';
    var areaId = '{$areaId}';
    var subAreaId = '{$subAreaId}';
    var cargoId = '{$cargoId}';
    var jornadaSelector = '{$jornadaSelector}';
    var contratoTipoCodeMap = {$tiposContratoCodeMapJson} || {};

    var \$area = $('#requisicion-area_id');
    var \$sede = $('#requisicion-sede_id');
    var \$sub = $('#requisicion-sub_area_id');
    var \$cargo = $('#requisicion-cargo_id');
    var \$jSel = $('#requisicion-jornada_selector');
    var \$jSelWrap = $('#requisicion-jornada-selector-wrap');
    var \$jOtroWrap = $('#requisicion-jornada-otro-wrap');
    var \$jOtro = $('#requisicion-jornada_otro');
    var \$jornada = $('#requisicion-jornada');
    var \$contratoTipo = $('#requisicion-contrato_tipo_id');
    var \$salario = $('#requisicion-salario');
    var \$auxilio = $('#requisicion-auxilio');

    function resetSelect(\$el, prompt, disabled) {
        \$el.html('<option value="">' + prompt + '</option>');
        \$el.prop('disabled', !!disabled);
    }

    function setLabelRequired(inputSelector, required) {
        var \$input = $(inputSelector);
        if (!\$input.length) return;
        var id = \$input.attr('id');
        if (!id) return;
        var \$label = $('label[for="' + id + '"]');
        if (!\$label.length) return;
        var \$star = \$label.find('.req-star');
        if (required) {
            if (!\$star.length) {
                \$label.append(' <span class="text-danger req-star">*</span>');
            }
        } else {
            \$star.remove();
        }
    }

    function applyRequiredLabelRules() {
        var required = [
            '#requisicion-empresa_cliente_id',
            '#requisicion-fecha_ingreso',
            '#requisicion-ciudad_id',
            '#requisicion-sede_id',
            '#requisicion-area_id',
            '#requisicion-cargo_id',
            '#requisicion-tipo_contrato',
            '#requisicion-contrato_tipo_id',
            '#requisicion-jornada_selector',
            '#requisicion-salario',
            '#requisicion-auxilio',
            '#requisicion-numero_vacantes'
        ];
        required.forEach(function (sel) { setLabelRequired(sel, true); });

        var optional = [
            '#requisicion-sub_area_id',
            '#requisicion-motivo_vinculacion_id',
            '#requisicion-esquema_variable_id',
            '#requisicion-jornada_otro'
        ];
        optional.forEach(function (sel) { setLabelRequired(sel, false); });
    }

    function loadSedes(cid, preserveVal) {
        resetSelect(\$sede, 'Seleccione sede', true);
        if (!cid) return;
        \$sede.prop('disabled', false);
        $.get(sedesUrl, { ciudad_id: cid }, function(data) {
            (data || []).forEach(function(s) {
                \$sede.append('<option value="' + s.id + '">' + $('<div/>').text(s.nombre).html() + '</option>');
            });
            if (preserveVal) \$sede.val(preserveVal);
        });
    }

    function loadAreas(ecId, preserveAreaVal, done) {
        resetSelect(\$area, 'Seleccione área', true);
        resetSelect(\$sub, 'Primero seleccione área', true);
        resetSelect(\$cargo, 'Primero seleccione área', true);
        if (!ecId) {
            resetSelect(\$area, 'Primero seleccione empresa cliente', true);
            if (typeof done === 'function') done();
            return;
        }
        \$area.prop('disabled', false);
        $.get(areasUrl, { empresa_cliente_id: ecId }, function(data) {
            var rows = data || [];
            \$area.empty().append('<option value="">Seleccione área</option>');
            rows.forEach(function(a) {
                \$area.append('<option value="' + a.id + '">' + $('<div/>').text(a.nombre).html() + '</option>');
            });
            if (preserveAreaVal) \$area.val(String(preserveAreaVal));
            if (typeof done === 'function') done();
        }).fail(function() {
            resetSelect(\$area, 'Error al cargar áreas', true);
            if (typeof done === 'function') done();
        });
    }

    function loadSubAreas(aid, preserveSubVal, done) {
        resetSelect(\$sub, 'Subárea (opcional)', true);
        resetSelect(\$cargo, 'Seleccione cargo', true);
        if (!aid) {
            resetSelect(\$sub, 'Primero seleccione área', true);
            resetSelect(\$cargo, 'Primero seleccione área', true);
            if (typeof done === 'function') done();
            return;
        }
        \$sub.prop('disabled', false);
        $.get(subAreasUrl, { area_id: aid }, function(data) {
            var rows = data || [];
            \$sub.empty().append('<option value="">Subárea (opcional)</option>');
            rows.forEach(function(a) {
                \$sub.append('<option value="' + a.id + '">' + $('<div/>').text(a.nombre).html() + '</option>');
            });
            if (preserveSubVal) \$sub.val(String(preserveSubVal));
            if (typeof done === 'function') done();
        }).fail(function() {
            resetSelect(\$sub, 'Error al cargar subáreas', true);
            if (typeof done === 'function') done();
        });
    }

    function loadCargos(aid, subId, preserveCargoVal) {
        resetSelect(\$cargo, 'Seleccione cargo', true);
        if (!aid) {
            resetSelect(\$cargo, 'Primero seleccione área', true);
            return;
        }
        \$cargo.prop('disabled', false);
        var params = { area_id: aid };
        if (subId) {
            params.sub_area_id = subId;
        }
        $.get(cargosUrl, params, function(data) {
            var rows = data || [];
            if (!rows.length) {
                \$cargo.html('<option value="">No hay cargos para esta selección</option>');
                \$cargo.prop('disabled', true);
                return;
            }
            \$cargo.empty().append('<option value="">Seleccione cargo</option>');
            rows.forEach(function(c) {
                \$cargo.append('<option value="' + c.id + '">' + $('<div/>').text(c.nombre).html() + '</option>');
            });
            if (preserveCargoVal) \$cargo.val(String(preserveCargoVal));
        }).fail(function() {
            resetSelect(\$cargo, 'Error al cargar cargos', true);
        });
    }

    function currencyDigits(v) {
        return (v || '').toString().replace(/\D/g, '');
    }

    function formatMiles(v) {
        var digits = currencyDigits(v);
        if (!digits) return '';
        return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    function bindCurrencyMask(\$input) {
        if (!\$input.length) return;
        \$input.attr('inputmode', 'numeric');
        var init = \$input.val();
        if (init) {
            \$input.val(formatMiles(init));
        }
        \$input.off('input.requisicionCurrency').on('input.requisicionCurrency', function () {
            var digits = currencyDigits($(this).val());
            $(this).val(formatMiles(digits));
        });
    }

    function unformatCurrencyForSubmit() {
        if (\$salario.length) {
            \$salario.val(currencyDigits(\$salario.val()));
        }
        if (\$auxilio.length) {
            \$auxilio.val(currencyDigits(\$auxilio.val()));
        }
    }

    function syncJornadaHidden() {
        var sel = (\$jSel.val() || '').toString();
        if (sel === '110' || sel === '220') {
            \$jornada.val(sel);
            return;
        }
        if (sel === 'otro') {
            \$jornada.val((\$jOtro.val() || '').toString().trim());
            return;
        }
        \$jornada.val('');
    }

    function toggleJornadaOtro() {
        var sel = (\$jSel.val() || '').toString();
        var showOtro = sel === 'otro';
        \$jOtroWrap.toggleClass('d-none', !showOtro);
        \$jOtro.prop('required', showOtro);
        setLabelRequired('#requisicion-jornada_otro', showOtro);
        if (!showOtro) {
            \$jOtro.val('');
        }
        syncJornadaHidden();
    }

    function contratoTipoEsHoras() {
        var id = (\$contratoTipo.val() || '').toString();
        var code = (contratoTipoCodeMap[id] || '').toString().toUpperCase();
        return code === 'HORAS';
    }

    function applyContratoTipoRules() {
        var esHoras = contratoTipoEsHoras();
        if (esHoras) {
            \$jSel.val('');
            \$jOtro.val('');
            \$jSelWrap.addClass('d-none');
            \$jOtroWrap.addClass('d-none');
            \$jSel.prop('required', false);
            \$jOtro.prop('required', false);
            setLabelRequired('#requisicion-jornada_selector', false);
            setLabelRequired('#requisicion-jornada_otro', false);
            \$jornada.val('');
            \$salario.val('0').prop('readonly', true);
        } else {
            \$jSelWrap.removeClass('d-none');
            \$jSel.prop('required', true);
            setLabelRequired('#requisicion-jornada_selector', true);
            \$salario.prop('readonly', false);
            toggleJornadaOtro();
        }
    }

    $('#requisicion-empresa_cliente_id').off('change.requisicionForm').on('change.requisicionForm', function() {
        loadAreas($(this).val(), null, null);
    });

    $('#requisicion-ciudad_id').off('change.requisicionForm').on('change.requisicionForm', function() {
        var v = $(this).val();
        if (v) loadSedes(v);
        else resetSelect(\$sede, 'Primero seleccione ciudad', true);
    });

    $('#requisicion-area_id').off('change.requisicionForm').on('change.requisicionForm', function() {
        var v = $(this).val();
        if (v) {
            loadSubAreas(v, null, null);
            loadCargos(v, null, null);
        }
        else {
            resetSelect(\$sub, 'Primero seleccione área', true);
            resetSelect(\$cargo, 'Primero seleccione área', true);
        }
    });

    $('#requisicion-sub_area_id').off('change.requisicionForm').on('change.requisicionForm', function() {
        var subVal = $(this).val();
        var aVal = \$area.val();
        if (aVal) loadCargos(aVal, subVal || null);
        else resetSelect(\$cargo, 'Primero seleccione área', true);
    });
    \$jSel.off('change.requisicionForm').on('change.requisicionForm', function () {
        toggleJornadaOtro();
    });
    \$jOtro.off('input.requisicionForm change.requisicionForm').on('input.requisicionForm change.requisicionForm', function () {
        syncJornadaHidden();
    });
    \$contratoTipo.off('change.requisicionForm').on('change.requisicionForm', function () {
        applyContratoTipoRules();
    });
    \$salario.off('input.requisicionForm').on('input.requisicionForm', function () {
        if (contratoTipoEsHoras()) {
            \$salario.val('0');
        }
    });
    $('#requisicion-form, #form-edit-requisicion-modal')
        .off('submit.requisicionCurrency')
        .on('submit.requisicionCurrency', function () {
            unformatCurrencyForSubmit();
        });

    if (ciudadId) {
        loadSedes(ciudadId, sedeId);
    }

    if (empresaClienteId) {
        loadAreas(empresaClienteId, areaId, function () {
            if (areaId) {
                loadSubAreas(areaId, subAreaId, function () {
                    loadCargos(areaId, subAreaId || null, cargoId);
                });
            }
        });
    }
    if (jornadaSelector) {
        \$jSel.val(jornadaSelector);
    }
    applyRequiredLabelRules();
    bindCurrencyMask(\$salario);
    bindCurrencyMask(\$auxilio);
    toggleJornadaOtro();
    applyContratoTipoRules();
})();
JS;
// Script inline: debe ejecutarse también cuando este partial se inyecta por AJAX (modal editar).
echo '<script>' . $js . '</script>';
