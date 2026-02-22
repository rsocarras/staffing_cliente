<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\EmpresasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="empresas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'social_name') ?>

    <?= $form->field($model, 'entity') ?>

    <?= $form->field($model, 'ref_int') ?>

    <?php // echo $form->field($model, 'ref_ext') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'tms') ?>

    <?php // echo $form->field($model, 'datec') ?>

    <?php // echo $form->field($model, 'dateu') ?>

    <?php // echo $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'twitter') ?>

    <?php // echo $form->field($model, 'instagram') ?>

    <?php // echo $form->field($model, 'phone_1') ?>

    <?php // echo $form->field($model, 'phone_2') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'description_s') ?>

    <?php // echo $form->field($model, 'description_l') ?>

    <?php // echo $form->field($model, 'idu') ?>

    <?php // echo $form->field($model, 'supplier_only') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'user_owner') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
