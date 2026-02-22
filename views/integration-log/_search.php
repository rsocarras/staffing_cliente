<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\IntegrationLogSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="integration-log-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa_id') ?>

    <?= $form->field($model, 'empresa_integration_id') ?>

    <?= $form->field($model, 'request_id') ?>

    <?= $form->field($model, 'endpoint') ?>

    <?php // echo $form->field($model, 'method') ?>

    <?php // echo $form->field($model, 'status_code') ?>

    <?php // echo $form->field($model, 'duration_ms') ?>

    <?php // echo $form->field($model, 'request_json') ?>

    <?php // echo $form->field($model, 'response_json') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
