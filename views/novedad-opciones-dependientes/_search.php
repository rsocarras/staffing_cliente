<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadOpcionesDependientesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-opciones-dependientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'campo_hijo') ?>

    <?= $form->field($model, 'campo_padre') ?>

    <?= $form->field($model, 'valor_padre') ?>

    <?= $form->field($model, 'valor') ?>

    <?php // echo $form->field($model, 'etiqueta') ?>

    <?php // echo $form->field($model, 'orden') ?>

    <?php // echo $form->field($model, 'activo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
