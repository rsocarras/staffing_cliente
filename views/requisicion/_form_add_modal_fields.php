<?php

use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Requisicion $model */
/** @var yii\widgets\ActiveForm $form */

$motivos = \yii\helpers\ArrayHelper::map(\app\models\MotivoVinculacion::getActivos(), 'id', 'nombre');
$ciudades = \yii\helpers\ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
$esquemas = \yii\helpers\ArrayHelper::map(\app\models\EsquemaVariable::getActivos(), 'id', 'nombre');
$tenantEmpresaId = Yii::$app->user->empresas_id ?? null;
$tiposContratoRows = \app\models\ContratoTipos::find()
    ->where(['activo' => 1])
    ->orderBy(['nombre' => SORT_ASC])
    ->all();
$tiposContrato = \yii\helpers\ArrayHelper::map($tiposContratoRows, 'id', 'nombre');
$tiposContratoCodeMap = [];
foreach ($tiposContratoRows as $tc) {
    $tiposContratoCodeMap[(string) $tc->id] = (string) ($tc->code ?? '');
}
$empresas = \yii\helpers\ArrayHelper::map(\app\models\EmpresaCliente::getActivos($tenantEmpresaId ? (int) $tenantEmpresaId : null), 'id', 'nombre');
$empresaClienteId = $model->empresa_cliente_id ? (int) $model->empresa_cliente_id : '';
$areaId = $model->area_id ? (int) $model->area_id : '';
$subAreaId = $model->sub_area_id ? (int) $model->sub_area_id : '';
$cargoId = $model->cargo_id ? (int) $model->cargo_id : '';
$jornadaSelector = $model->jornada_selector ?: '';
?>

<!-- Empresa y ubicaci?n -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-building-community fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Empresa y ubicaci?n</h6>
            <p class="text-muted small mb-0">Cliente, motivo de vinculaci?n, fecha de ingreso, ciudad y sede.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'empresa_cliente_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building text-primary"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($empresas, ['prompt' => 'Seleccione empresa cliente', 'class' => 'form-select', 'id' => 'requisicion-empresa_cliente_id']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'fecha_ingreso', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-calendar-event text-primary"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->input('datetime-local', ['class' => 'form-control']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'ciudad_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-map-pin text-primary"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($ciudades, ['prompt' => 'Seleccione ciudad', 'id' => 'requisicion-ciudad_id', 'class' => 'form-select']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sede_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building-store text-primary"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList([], ['prompt' => 'Primero seleccione ciudad', 'id' => 'requisicion-sede_id', 'class' => 'form-select', 'disabled' => true]) ?>
        </div>
    </div>
</div>

<!-- Estructura organizacional -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-hierarchy-2 fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Estructura organizacional</h6>
            <p class="text-muted small mb-0">?rea y sub?rea seg?n la empresa cliente; cargo seg?n organizaci?n (tenant), ?rea y sub?rea.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'area_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-sitemap text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList([], [
                'prompt' => 'Primero seleccione empresa cliente',
                'id' => 'requisicion-area_id',
                'class' => 'form-select',
                'disabled' => true,
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sub_area_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hierarchy text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList([], ['prompt' => 'Primero seleccione ?rea', 'id' => 'requisicion-sub_area_id', 'class' => 'form-select', 'disabled' => true]) ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'cargo_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-briefcase text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList([], ['prompt' => 'Primero seleccione ?rea', 'id' => 'requisicion-cargo_id', 'class' => 'form-select', 'disabled' => true]) ?>
        </div>
    </div>
</div>

<!-- Condiciones laborales -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-file-invoice fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Condiciones laborales</h6>
            <p class="text-muted small mb-0">Tipo de contrato, jornada, salario, auxilio y esquema variable.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'tipo_contrato', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-file-text text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList(\app\models\Requisicion::optsTipoContrato(), ['prompt' => 'Seleccione modalidad de vinculaci?n', 'class' => 'form-select']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'contrato_tipo_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-id-badge text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($tiposContrato, ['prompt' => 'Seleccione tipo de contrato', 'class' => 'form-select']) ?>
        </div>
        <div class="col-md-4" id="requisicion-jornada-selector-wrap">
            <?= $form->field($model, 'jornada_selector', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-clock text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList([
                '110' => '110',
                '220' => '220',
                'otro' => 'Otro',
            ], ['prompt' => 'Seleccione jornada', 'class' => 'form-select', 'id' => 'requisicion-jornada_selector']) ?>
        </div>
        <div class="col-md-4 d-none" id="requisicion-jornada-otro-wrap">
            <?= $form->field($model, 'jornada_otro', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-clock text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput([
                'type' => 'number',
                'step' => '0.01',
                'min' => 100,
                'max' => 300,
                'class' => 'form-control',
                'id' => 'requisicion-jornada_otro',
            ])->hint('Debe estar entre 100 y 300.') ?>
        </div>
        <?= $form->field($model, 'jornada')->hiddenInput(['id' => 'requisicion-jornada'])->label(false) ?>
        <div class="col-md-4">
            <?= $form->field($model, 'salario', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-currency-dollar text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput(['type' => 'text', 'inputmode' => 'numeric', 'autocomplete' => 'off', 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'auxilio', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-cash text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput(['type' => 'text', 'inputmode' => 'numeric', 'autocomplete' => 'off', 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'esquema_variable_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-chart-line text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($esquemas, ['prompt' => 'Opcional', 'class' => 'form-select']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'motivo_vinculacion_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-handshake text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($motivos, ['prompt' => 'Opcional', 'class' => 'form-select']) ?>
        </div>
    </div>
</div>

<!-- Vacantes (creaci?n) -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-users fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Vacantes</h6>
            <p class="text-muted small mb-0">Cantidad de requisiciones a generar (una por vacante).</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'numero_vacantes', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hash text-warning"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput(['type' => 'number', 'min' => 1, 'class' => 'form-control'])->hint('Se crear?n N requisiciones (1 por vacante)') ?>
        </div>
    </div>
</div>

<?php
$sedesUrl = Url::to(['sedes-por-ciudad']);
$areasUrl = Url::to(['areas-por-empresa-cliente']);
$subAreasUrl = Url::to(['sub-areas-por-area']);
$cargosUrl = Url::to(['cargos-por-sub-area']);
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
            data.forEach(function(s) {
                \$sede.append('<option value="' + s.id + '">' + $('<div/>').text(s.nombre).html() + '</option>');
            });
            if (preserveVal) \$sede.val(preserveVal);
        });
    }

    function loadAreas(ecId, preserveAreaVal, done) {
        resetSelect(\$area, 'Seleccione ?rea', true);
        resetSelect(\$sub, 'Primero seleccione ?rea', true);
        resetSelect(\$cargo, 'Primero seleccione ?rea', true);
        if (!ecId) {
            resetSelect(\$area, 'Primero seleccione empresa cliente', true);
            if (typeof done === 'function') done();
            return;
        }
        \$area.prop('disabled', false);
        $.get(areasUrl, { empresa_cliente_id: ecId }, function(data) {
            var rows = data || [];
            \$area.empty().append('<option value="">Seleccione ?rea</option>');
            rows.forEach(function(a) {
                \$area.append('<option value="' + a.id + '">' + $('<div/>').text(a.nombre).html() + '</option>');
            });
            if (preserveAreaVal) \$area.val(String(preserveAreaVal));
            if (typeof done === 'function') done();
        }).fail(function() {
            resetSelect(\$area, 'Error al cargar ?reas', true);
            if (typeof done === 'function') done();
        });
    }

    function loadSubAreas(aid, preserveSubVal, done) {
        resetSelect(\$sub, 'Sub?rea (opcional)', true);
        resetSelect(\$cargo, 'Seleccione cargo', true);
        if (!aid) {
            resetSelect(\$sub, 'Primero seleccione ?rea', true);
            resetSelect(\$cargo, 'Primero seleccione ?rea', true);
            if (typeof done === 'function') done();
            return;
        }
        \$sub.prop('disabled', false);
        $.get(subAreasUrl, { area_id: aid }, function(data) {
            var rows = data || [];
            \$sub.empty().append('<option value="">Sub?rea (opcional)</option>');
            rows.forEach(function(a) {
                \$sub.append('<option value="' + a.id + '">' + $('<div/>').text(a.nombre).html() + '</option>');
            });
            if (preserveSubVal) \$sub.val(String(preserveSubVal));
            if (typeof done === 'function') done();
        }).fail(function() {
            resetSelect(\$sub, 'Error al cargar sub?reas', true);
            if (typeof done === 'function') done();
        });
    }

    function loadCargos(aid, subId, preserveCargoVal) {
        resetSelect(\$cargo, 'Seleccione cargo', true);
        if (!aid) {
            resetSelect(\$cargo, 'Primero seleccione ?rea', true);
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
                \$cargo.html('<option value="">No hay cargos para esta selecci?n</option>');
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

    $('#requisicion-empresa_cliente_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {
        var ec = $(this).val();
        loadAreas(ec, null, null);
    });

    $('#requisicion-ciudad_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {
        var v = $(this).val();
        if (v) loadSedes(v);
        else resetSelect(\$sede, 'Primero seleccione ciudad', true);
    });

    $('#requisicion-area_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {
        var v = $(this).val();
        if (v) {
            loadSubAreas(v, null, null);
            loadCargos(v, null, null);
        }
        else {
            resetSelect(\$sub, 'Primero seleccione ?rea', true);
            resetSelect(\$cargo, 'Primero seleccione ?rea', true);
        }
    });

    $('#requisicion-sub_area_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {
        var subVal = $(this).val();
        var aVal = \$area.val();
        if (aVal) loadCargos(aVal, subVal || null);
        else resetSelect(\$cargo, 'Primero seleccione ?rea', true);
    });
    \$jSel.off('change.requisicionAdd').on('change.requisicionAdd', function () {
        toggleJornadaOtro();
    });
    \$jOtro.off('input.requisicionAdd change.requisicionAdd').on('input.requisicionAdd change.requisicionAdd', function () {
        syncJornadaHidden();
    });
    \$contratoTipo.off('change.requisicionAdd').on('change.requisicionAdd', function () {
        applyContratoTipoRules();
    });
    \$salario.off('input.requisicionAdd').on('input.requisicionAdd', function () {
        if (contratoTipoEsHoras()) {
            \$salario.val('0');
        }
    });
    $('#form-add-requisicion')
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

    $('#requisicion-sede_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {});
})();
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
