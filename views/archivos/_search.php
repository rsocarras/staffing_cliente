<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\ArchivosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="archivos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa_id') ?>

    <?= $form->field($model, 'storage') ?>

    <?= $form->field($model, 'path') ?>

    <?= $form->field($model, 'filename') ?>

    <?php // echo $form->field($model, 'mime') ?>

    <?php // echo $form->field($model, 'size_bytes') ?>

    <?php // echo $form->field($model, 'sha256') ?>

    <?php // echo $form->field($model, 'uploaded_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
