<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadTipoCampoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="novedad-tipo-campo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'novedad_tipo_id') ?>

    <?= $form->field($model, 'orden') ?>

    <?= $form->field($model, 'campo_id') ?>

    <?= $form->field($model, 'label') ?>

    <?php // echo $form->field($model, 'tipo_dato') ?>

    <?php // echo $form->field($model, 'requerido') ?>

    <?php // echo $form->field($model, 'calculado') ?>

    <?php // echo $form->field($model, 'formula') ?>

    <?php // echo $form->field($model, 'max_length') ?>

    <?php // echo $form->field($model, 'val_min') ?>

    <?php // echo $form->field($model, 'val_max') ?>

    <?php // echo $form->field($model, 'alerta_max') ?>

    <?php // echo $form->field($model, 'fuente_opciones') ?>

    <?php // echo $form->field($model, 'depende_de') ?>

    <?php // echo $form->field($model, 'visible_si_campo') ?>

    <?php // echo $form->field($model, 'visible_si_op') ?>

    <?php // echo $form->field($model, 'visible_si_valor') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
