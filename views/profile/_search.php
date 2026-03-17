<?php

use app\models\Area;
use app\models\Cargos;
use app\models\Empresas;
use app\models\LocationSedes;
use app\models\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\ProfileSearch $model */
/** @var yii\widgets\ActiveForm $form */
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
        <?= $form->field($model, 'empresas_id')->dropDownList(
            ArrayHelper::map(Empresas::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
            ['prompt' => 'Todas']
        ) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'sede_id')->dropDownList(
            ArrayHelper::map(LocationSedes::find()->orderBy(['nombre' => SORT_ASC])->all(), 'id', 'nombre'),
            ['prompt' => 'Todas']
        ) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'area_id')->dropDownList(
            ArrayHelper::map(Area::find()->orderBy(['nombre' => SORT_ASC])->all(), 'id', 'nombre'),
            ['prompt' => 'Todas']
        ) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'cargo_id')->dropDownList(
            ArrayHelper::map(Cargos::find()->orderBy(['nombre' => SORT_ASC])->all(), 'id', 'nombre'),
            ['prompt' => 'Todos']
        ) ?>
    </div>

    <div class="col-12">
        <?= Html::submitButton('<i class="ti ti-search me-1"></i>Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Limpiar', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
