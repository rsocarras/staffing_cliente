<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\EmpresaIntegrationSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="empresa-integration-search">

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

    <?= $form->field($model, 'base_url') ?>

    <?= $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'password_enc') ?>

    <?php // echo $form->field($model, 'token') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <?php // echo $form->field($model, 'config_json') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
