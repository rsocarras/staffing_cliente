<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\Requisicion $model */
/** @var yii\widgets\ActiveForm $form */
/** @var bool $esCreacion */

$esCreacion = isset($esCreacion) ? $esCreacion : $model->isNewRecord;
$tenantEmpresaId = Yii::$app->user->empresas_id ?? null;
?>
<div class="row">
    <div class="col-md-12">
        <h5 class="mb-3">Datos de la vacante</h5>
        <?= $form->field($model, 'empresa_cliente_id')->dropDownList(ArrayHelper::map(\app\models\EmpresaCliente::getActivos($tenantEmpresaId ? (int) $tenantEmpresaId : null), 'id', 'nombre'), ['prompt' => 'Seleccione empresa cliente']) ?>
        <?= $form->field($model, 'motivo_vinculacion_id')->dropDownList(ArrayHelper::map(\app\models\MotivoVinculacion::getActivos(), 'id', 'nombre'), ['prompt' => 'Opcional']) ?>
        <?= $form->field($model, 'fecha_ingreso')->input('datetime-local') ?>
        <?= $form->field($model, 'ciudad_id')->dropDownList(ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name'), ['prompt' => 'Seleccione ciudad', 'id' => 'requisicion-ciudad_id']) ?>
        <?= $form->field($model, 'sede_id')->dropDownList([], ['prompt' => 'Seleccione sede', 'id' => 'requisicion-sede_id']) ?>
        <?= $form->field($model, 'area_id')->dropDownList(ArrayHelper::map(\app\models\Area::find()->where(['or', ['area_padre' => null], ['area_padre' => 0]])->orderBy('nombre')->all(), 'id', 'nombre'), ['prompt' => 'Seleccione área', 'id' => 'requisicion-area_id']) ?>
        <?= $form->field($model, 'sub_area_id')->dropDownList([], ['prompt' => 'Seleccione sub-área', 'id' => 'requisicion-sub_area_id']) ?>
        <?= $form->field($model, 'cargo_id')->dropDownList(ArrayHelper::map(\app\models\Cargos::find()->where(['activo' => 1])->orderBy('nombre')->all(), 'id', 'nombre'), ['prompt' => 'Seleccione cargo']) ?>
        <?= $form->field($model, 'tipo_contrato')->dropDownList(\app\models\Requisicion::optsTipoContrato(), ['prompt' => 'Seleccione tipo de contrato']) ?>
        <?= $form->field($model, 'jornada')->textInput(['type' => 'number', 'step' => '0.01']) ?>
        <?= $form->field($model, 'salario')->textInput(['type' => 'number', 'step' => '0.01']) ?>
        <?= $form->field($model, 'auxilio')->textInput(['type' => 'number', 'step' => '0.01']) ?>
        <?= $form->field($model, 'esquema_variable_id')->dropDownList(ArrayHelper::map(\app\models\EsquemaVariable::getActivos(), 'id', 'nombre'), ['prompt' => 'Opcional']) ?>
        <?php if ($esCreacion): ?>
            <?= $form->field($model, 'numero_vacantes')->textInput(['type' => 'number', 'min' => 1])->hint('Se crearán N requisiciones (1 por vacante)') ?>
        <?php endif; ?>
    </div>
</div>

<?php
$sedesUrl = Url::to(['sedes-por-ciudad']);
$subAreasUrl = Url::to(['sub-areas-por-area']);
$ciudadId = $model->ciudad_id ?: '';
$areaId = $model->area_id ?: '';
$sedeId = $model->sede_id ?: '';
$subAreaId = $model->sub_area_id ?: '';
$this->registerJs(<<<JS
(function() {
    var sedesUrl = '{$sedesUrl}';
    var subAreasUrl = '{$subAreasUrl}';
    var ciudadId = '{$ciudadId}';
    var areaId = '{$areaId}';
    var sedeId = '{$sedeId}';
    var subAreaId = '{$subAreaId}';

    function resetSelect(selector, placeholder) {
        $(selector).html('<option value="">' + placeholder + '</option>');
    }

    function loadSedes(cid, preserveVal) {
        var \$sel = $('#requisicion-sede_id');
        resetSelect('#requisicion-sede_id', 'Seleccione sede');
        if (!cid) {
            return;
        }

        $.get(sedesUrl, { ciudad_id: cid }, function(data) {
            data.forEach(function(s) {
                \$sel.append('<option value="' + s.id + '">' + s.nombre + '</option>');
            });
            if (preserveVal) {
                \$sel.val(preserveVal);
            }
        });
    }

    function loadSubAreas(aid, preserveVal) {
        var \$sel = $('#requisicion-sub_area_id');
        resetSelect('#requisicion-sub_area_id', 'Seleccione sub-área');
        if (!aid) {
            return;
        }

        $.get(subAreasUrl, { area_id: aid }, function(data) {
            data.forEach(function(a) {
                \$sel.append('<option value="' + a.id + '">' + a.nombre + '</option>');
            });
            if (preserveVal) {
                \$sel.val(preserveVal);
            }
        });
    }

    $('#requisicion-ciudad_id').off('change.requisicion').on('change.requisicion', function() {
        loadSedes($(this).val());
    });

    $('#requisicion-area_id').off('change.requisicion').on('change.requisicion', function() {
        loadSubAreas($(this).val());
    });

    if (ciudadId) {
        loadSedes(ciudadId, sedeId);
    } else {
        resetSelect('#requisicion-sede_id', 'Seleccione sede');
    }

    if (areaId) {
        loadSubAreas(areaId, subAreaId);
    } else {
        resetSelect('#requisicion-sub_area_id', 'Seleccione sub-área');
    }
})();
JS, \yii\web\View::POS_READY);
?>
