<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\ProfileEventosLogSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-eventos-log-search">

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

    <?= $form->field($model, 'event_type') ?>

    <?= $form->field($model, 'entity_type') ?>

    <?php // echo $form->field($model, 'entity_id') ?>

    <?php // echo $form->field($model, 'actor_user_id') ?>

    <?php // echo $form->field($model, 'before_json') ?>

    <?php // echo $form->field($model, 'after_json') ?>

    <?php // echo $form->field($model, 'contexto_json') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
