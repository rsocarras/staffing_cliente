<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\models\Requisicion $model */
/** @var bool $esCreacion */

$esCreacion = isset($esCreacion) ? $esCreacion : $model->isNewRecord;
?>
<div class="requisicion-form">
    <?php $form = ActiveForm::begin(['id' => 'requisicion-form']); ?>

    <div class="row">
        <div class="col-md-12">
            <h5 class="mb-3">Datos de la vacante</h5>
            <?= $form->field($model, 'empresa_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\EmpresaCliente::getActivos(), 'id', 'nombre'), ['prompt' => 'Seleccione empresa']) ?>
            <?= $form->field($model, 'motivo_vinculacion_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\MotivoVinculacion::getActivos(), 'id', 'nombre'), ['prompt' => 'Opcional']) ?>
            <?= $form->field($model, 'fecha_ingreso')->input('datetime-local') ?>
            <?= $form->field($model, 'ciudad_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\City::find()->where(['is_active' => 1])->orderBy('name')->all(), 'id', 'name'), ['prompt' => 'Seleccione ciudad', 'id' => 'requisicion-ciudad_id']) ?>
            <?= $form->field($model, 'sede_id')->dropDownList([], ['prompt' => 'Seleccione sede', 'id' => 'requisicion-sede_id']) ?>
            <?= $form->field($model, 'area_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Area::find()->where(['or', ['area_padre' => null], ['area_padre' => 0]])->orderBy('nombre')->all(), 'id', 'nombre'), ['prompt' => 'Seleccione área', 'id' => 'requisicion-area_id']) ?>
            <?= $form->field($model, 'sub_area_id')->dropDownList([], ['prompt' => 'Seleccione sub-área', 'id' => 'requisicion-sub_area_id']) ?>
            <?= $form->field($model, 'cargo_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Cargos::find()->where(['activo' => 1])->orderBy('nombre')->all(), 'id', 'nombre'), ['prompt' => 'Seleccione cargo']) ?>
            <?= $form->field($model, 'jornada')->textInput(['type' => 'number', 'step' => '0.01']) ?>
            <?= $form->field($model, 'salario')->textInput(['type' => 'number', 'step' => '0.01']) ?>
            <?= $form->field($model, 'auxilio')->textInput(['type' => 'number', 'step' => '0.01']) ?>
            <?= $form->field($model, 'esquema_variable_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\EsquemaVariable::getActivos(), 'id', 'nombre'), ['prompt' => 'Opcional']) ?>
            <?php if ($esCreacion): ?>
                <?= $form->field($model, 'numero_vacantes')->textInput(['type' => 'number', 'min' => 1])->hint('Se crearán N requisiciones (1 por vacante)') ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton($model->isNewRecord ? 'Crear Requisición' : 'Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
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

    function loadSedes(cid, preserveVal) {
        var \$sel = $('#requisicion-sede_id');
        \$sel.html('<option value="">Seleccione sede</option>');
        if (!cid) return;
        $.get(sedesUrl, { ciudad_id: cid }, function(data) {
            data.forEach(function(s) {
                \$sel.append('<option value="'+s.id+'">'+s.nombre+'</option>');
            });
            if (preserveVal) \$sel.val(preserveVal);
        });
    }
    function loadSubAreas(aid, preserveVal) {
        var \$sel = $('#requisicion-sub_area_id');
        \$sel.html('<option value="">Seleccione sub-área</option>');
        if (!aid) return;
        $.get(subAreasUrl, { area_id: aid }, function(data) {
            data.forEach(function(a) {
                \$sel.append('<option value="'+a.id+'">'+a.nombre+'</option>');
            });
            if (preserveVal) \$sel.val(preserveVal);
        });
    }

    $('#requisicion-ciudad_id').on('change', function() {
        loadSedes($(this).val());
    });
    $('#requisicion-area_id').on('change', function() {
        loadSubAreas($(this).val());
    });

    if (ciudadId) loadSedes(ciudadId, sedeId);
    if (areaId) loadSubAreas(areaId, subAreaId);
})();
JS
, \yii\web\View::POS_READY);
?>
