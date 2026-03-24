<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Requisicion $model */
/** @var yii\widgets\ActiveForm $form */

$tenantEmpresaId = Yii::$app->user->empresas_id ?? null;
$empresas = ArrayHelper::map(\app\models\EmpresaCliente::getActivos($tenantEmpresaId ? (int) $tenantEmpresaId : null), 'id', 'nombre');
$motivos = ArrayHelper::map(\app\models\MotivoVinculacion::getActivos(), 'id', 'nombre');
$ciudades = ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name');
$areas = ArrayHelper::map(\app\models\Area::find()->where(['or', ['area_padre' => null], ['area_padre' => 0]])->orderBy('nombre')->all(), 'id', 'nombre');
$esquemas = ArrayHelper::map(\app\models\EsquemaVariable::getActivos(), 'id', 'nombre');
?>

<!-- Empresa y ubicación -->
<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-building-community fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Empresa y ubicación</h6>
            <p class="text-muted small mb-0">Cliente, motivo de vinculación, fecha de ingreso, ciudad y sede.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'empresa_cliente_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-building text-primary"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($empresas, ['prompt' => 'Seleccione empresa cliente', 'class' => 'form-select']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'motivo_vinculacion_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-handshake text-primary"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($motivos, ['prompt' => 'Opcional', 'class' => 'form-select']) ?>
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
        <div class="col-12">
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
            <p class="text-muted small mb-0">Área, subárea y cargo solicitado (cargo según subárea).</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <?= $form->field($model, 'area_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-sitemap text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($areas, ['prompt' => 'Seleccione área', 'id' => 'requisicion-area_id', 'class' => 'form-select']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sub_area_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-hierarchy text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList([], ['prompt' => 'Primero seleccione área', 'id' => 'requisicion-sub_area_id', 'class' => 'form-select', 'disabled' => true]) ?>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'cargo_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-briefcase text-info"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList([], ['prompt' => 'Primero seleccione subárea', 'id' => 'requisicion-cargo_id', 'class' => 'form-select', 'disabled' => true]) ?>
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
            ])->dropDownList(\app\models\Requisicion::optsTipoContrato(), ['prompt' => 'Seleccione tipo de contrato', 'class' => 'form-select']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'jornada', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-clock text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'salario', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-currency-dollar text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'auxilio', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-cash text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'esquema_variable_id', [
                'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-chart-line text-success"></i></span>{input}</div>{error}{hint}',
                'options' => ['class' => 'mb-0'],
                'labelOptions' => ['class' => 'form-label fw-medium'],
            ])->dropDownList($esquemas, ['prompt' => 'Opcional', 'class' => 'form-select']) ?>
        </div>
    </div>
</div>

<!-- Vacantes (creación) -->
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
            ])->textInput(['type' => 'number', 'min' => 1, 'class' => 'form-control'])->hint('Se crearán N requisiciones (1 por vacante)') ?>
        </div>
    </div>
</div>

<?php
$sedesUrl = Url::to(['sedes-por-ciudad']);
$subAreasUrl = Url::to(['sub-areas-por-area']);
$cargosUrl = Url::to(['cargos-por-sub-area']);
$ciudadId = $model->ciudad_id ?: '';
$areaId = $model->area_id ?: '';
$sedeId = $model->sede_id ?: '';
$subAreaId = $model->sub_area_id ?: '';
$cargoId = $model->cargo_id ?: '';

$js = <<<JS
(function() {
    var sedesUrl = '{$sedesUrl}';
    var subAreasUrl = '{$subAreasUrl}';
    var cargosUrl = '{$cargosUrl}';
    var ciudadId = '{$ciudadId}';
    var areaId = '{$areaId}';
    var sedeId = '{$sedeId}';
    var subAreaId = '{$subAreaId}';
    var cargoId = '{$cargoId}';

    var \$sede = $('#requisicion-sede_id');
    var \$sub = $('#requisicion-sub_area_id');
    var \$cargo = $('#requisicion-cargo_id');

    function resetSelect(\$el, prompt, placeholderDisabled) {
        \$el.html('<option value="">' + prompt + '</option>');
        if (placeholderDisabled) {
            \$el.prop('disabled', true);
        }
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

    function loadSubAreas(aid, preserveVal) {
        resetSelect(\$sub, 'Seleccione sub-área', true);
        resetSelect(\$cargo, 'Primero seleccione subárea', true);
        if (!aid) return;
        \$sub.prop('disabled', false);
        $.get(subAreasUrl, { area_id: aid }, function(data) {
            data.forEach(function(a) {
                \$sub.append('<option value="' + a.id + '">' + $('<div/>').text(a.nombre).html() + '</option>');
            });
            if (preserveVal) \$sub.val(preserveVal);
            if (preserveVal) loadCargos(preserveVal, cargoId);
        });
    }

    function loadCargos(subId, preserveVal) {
        resetSelect(\$cargo, 'Seleccione cargo', true);
        if (!subId) return;
        \$cargo.prop('disabled', false);
        $.get(cargosUrl, { sub_area_id: subId }, function(data) {
            if (!data || !data.length) {
                \$cargo.html('<option value="">No hay cargos para esta subárea</option>');
                \$cargo.prop('disabled', true);
                return;
            }
            \$cargo.html('<option value="">Seleccione cargo</option>');
            data.forEach(function(c) {
                \$cargo.append('<option value="' + c.id + '">' + $('<div/>').text(c.nombre).html() + '</option>');
            });
            if (preserveVal) \$cargo.val(preserveVal);
        }).fail(function() {
            resetSelect(\$cargo, 'Error al cargar cargos', true);
        });
    }

    $('#requisicion-ciudad_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {
        var v = $(this).val();
        if (v) loadSedes(v);
        else {
            resetSelect(\$sede, 'Primero seleccione ciudad', true);
        }
    });

    $('#requisicion-area_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {
        var v = $(this).val();
        if (v) loadSubAreas(v);
        else {
            resetSelect(\$sub, 'Primero seleccione área', true);
            resetSelect(\$cargo, 'Primero seleccione subárea', true);
        }
    });

    $('#requisicion-sub_area_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {
        var v = $(this).val();
        if (v) loadCargos(v);
        else {
            resetSelect(\$cargo, 'Primero seleccione subárea', true);
        }
    });

    $('#requisicion-sede_id').off('change.requisicionAdd').on('change.requisicionAdd', function() {});

    if (ciudadId) {
        loadSedes(ciudadId, sedeId);
    }
    if (areaId) {
        loadSubAreas(areaId, subAreaId);
    } else {
        resetSelect(\$sub, 'Primero seleccione área', true);
        resetSelect(\$cargo, 'Primero seleccione subárea', true);
    }
})();
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>
