<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadFlujoPasoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-flujo-paso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'novedad_tipo_id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'tipo_paso') ?>

    <?= $form->field($model, 'rol') ?>

    <?php // echo $form->field($model, 'email_notif') ?>

    <?php // echo $form->field($model, 'es_inicio') ?>

    <?php // echo $form->field($model, 'siguiente_id') ?>

    <?php // echo $form->field($model, 'siguiente_si_id') ?>

    <?php // echo $form->field($model, 'siguiente_no_id') ?>

    <?php // echo $form->field($model, 'condicion_campo') ?>

    <?php // echo $form->field($model, 'condicion_op') ?>

    <?php // echo $form->field($model, 'condicion_valor') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
