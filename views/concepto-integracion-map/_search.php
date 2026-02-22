<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\ConceptoIntegracionMapSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="concepto-integracion-map-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa_id') ?>

    <?= $form->field($model, 'provider') ?>

    <?= $form->field($model, 'concepto_id') ?>

    <?= $form->field($model, 'remote_code') ?>

    <?php // echo $form->field($model, 'remote_name') ?>

    <?php // echo $form->field($model, 'config_json') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
