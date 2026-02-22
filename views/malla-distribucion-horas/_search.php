<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\MallaDistribucionHorasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="malla-distribucion-horas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa_id') ?>

    <?= $form->field($model, 'payroll_period_id') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'sede_id') ?>

    <?php // echo $form->field($model, 'cargo_id') ?>

    <?php // echo $form->field($model, 'centro_costo_id') ?>

    <?php // echo $form->field($model, 'centro_utilidad_id') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'horas') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
