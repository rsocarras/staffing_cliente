<?php

use app\models\Area;
use app\models\Cargos;
use app\components\TenantContext;
use app\models\Empresas;
use app\models\LocationSedes;
use app\models\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\ProfileSearch $model */
/** @var yii\widgets\ActiveForm $form */

$tenantEmpresaId = TenantContext::currentEmpresaId();
$tenantEmpresas = $tenantEmpresaId
    ? Empresas::find()->where(['id' => $tenantEmpresaId])->orderBy(['name' => SORT_ASC])->all()
    : [];
$tenantSedes = $tenantEmpresaId
    ? LocationSedes::find()->where(['empresa_id' => $tenantEmpresaId])->orderBy(['nombre' => SORT_ASC])->all()
    : [];
$tenantAreas = $tenantEmpresaId
    ? Area::find()->where(['empresas_id' => $tenantEmpresaId])->orderBy(['nombre' => SORT_ASC])->all()
    : [];
$tenantCargos = $tenantEmpresaId
    ? Cargos::find()->where(['empresa_id' => $tenantEmpresaId])->orderBy(['nombre' => SORT_ASC])->all()
    : [];
?>

<div class="profile-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'row g-3'],
    ]); ?>

    <div class="col-md-3">
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Nombre del empleado']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'num_doc')->textInput(['placeholder' => 'Documento']) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'public_email')->textInput(['placeholder' => 'Correo']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'estado')->dropDownList(Profile::optsEstado(), ['prompt' => 'Todos']) ?>
    </div>
    <div class="col-md-2">
        <?= $form->field($model, 'tipo_doc')->dropDownList(Profile::optsTipoDoc(), ['prompt' => 'Todos']) ?>
    </div>
    <div class="col-md-3">
        <?= Html::activeHiddenInput($model, 'empresas_id', ['value' => $tenantEmpresaId]) ?>
        <?= $form->field($model, 'empresas_id')->dropDownList(
            ArrayHelper::map($tenantEmpresas, 'id', 'name'),
            ['prompt' => 'Sin tenant', 'disabled' => true]
        ) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'sede_id')->dropDownList(
            ArrayHelper::map($tenantSedes, 'id', 'nombre'),
            ['prompt' => 'Todas']
        ) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'area_id')->dropDownList(
            ArrayHelper::map($tenantAreas, 'id', 'nombre'),
            ['prompt' => 'Todas']
        ) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'cargo_id')->dropDownList(
            ArrayHelper::map($tenantCargos, 'id', 'nombre'),
            ['prompt' => 'Todos']
        ) ?>
    </div>

    <div class="col-12">
        <?= Html::submitButton('<i class="ti ti-search me-1"></i>Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
