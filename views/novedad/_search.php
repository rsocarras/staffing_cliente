<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'concepto_id') ?>

    <?= $form->field($model, 'novedad_tipo_id') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'datos') ?>

    <?php // echo $form->field($model, 'schema_snapshot') ?>

    <?php // echo $form->field($model, 'alertas') ?>

    <?php // echo $form->field($model, 'paso_actual_id') ?>

    <?php // echo $form->field($model, 'es_masivo') ?>

    <?php // echo $form->field($model, 'lote_masivo_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
