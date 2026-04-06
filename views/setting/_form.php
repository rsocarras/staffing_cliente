<?php

use Yii;
use app\models\LocationCountry;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Setting $model */
/** @var yii\widgets\ActiveForm $form */

$paises = ArrayHelper::map(
    LocationCountry::find()->orderBy(['name' => SORT_ASC])->all(),
    'id',
    'name'
);
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <h5 class="mt-0"><?= Html::encode(Yii::t('app', 'Contexto')) ?></h5>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'year')->input('number', ['min' => 1900, 'max' => 2100, 'step' => 1]) ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'location_country_id')->dropDownList(
                $paises,
                ['prompt' => Yii::t('app', 'Seleccione…')]
            ) ?>
        </div>
    </div>

    <h5><?= Html::encode(Yii::t('app', 'Franja nocturna')) ?></h5>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'hora_inicio_nocturna')->input('time') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'fin_hora_nocturna')->input('time') ?>
        </div>
    </div>

    <h5><?= Html::encode(Yii::t('app', 'Salarios y porcentajes')) ?></h5>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'salario_minimo')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'salario_minimo_integral')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'porcentaje_salud')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'porcentaje_pension')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'porcentaje_cajas')->input('number', ['step' => 'any']) ?>
        </div>
    </div>

    <h5><?= Html::encode(Yii::t('app', 'Provisiones')) ?></h5>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'provision_prima_anual')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'provision_cesantias')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'provision_vacaciones')->input('number', ['step' => 'any']) ?>
        </div>
    </div>

    <h5><?= Html::encode(Yii::t('app', 'Límites horas extra')) ?></h5>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'max_horas_extra_dia')->input('number', ['min' => 0, 'max' => 255, 'step' => 1]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'max_horas_extra_semana')->input('number', ['min' => 0, 'step' => 1]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'max_horas_extra_mes')->input('number', ['min' => 0, 'step' => 1]) ?>
        </div>
    </div>

    <h5><?= Html::encode(Yii::t('app', 'Recargos')) ?></h5>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'recargo_dominical_festivo')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'recargo_nocturno')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'recargo_nocturno_dominical_festivo')->input('number', ['step' => 'any']) ?>
        </div>
    </div>

    <h5><?= Html::encode(Yii::t('app', 'Valores hora extra y dominical')) ?></h5>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'valor_hora_extra_diurna')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'valor_hora_extra_nocturna')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'valor_hora_extra_dia_festivo')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'valor_hora_extra_nocturno_festivo')->input('number', ['step' => 'any']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'valor_dominical_compensatorio')->input('number', ['step' => 'any']) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
