<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Mallas;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var app\models\MallasHorarios $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="mallas-horarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $mallas = ArrayHelper::map(
        Mallas::find()->orderBy(['nombre' => SORT_ASC])->all(),
        'id',
        'nombre'
    );
    ?>
    <?= $form->field($model, 'malla_id')->dropDownList($mallas, ['prompt' => 'Seleccione malla']) ?>

    <?= $form->field($model, 'dia_semana')->dropDownList([
        1 => 'Domingo',
        2 => 'Lunes',
        3 => 'Martes',
        4 => 'Miércoles',
        5 => 'Jueves',
        6 => 'Viernes',
        7 => 'Sábado',
    ]) ?>

    <?= $form->field($model, 'hora_inicio')->input('time') ?>

    <?= $form->field($model, 'hora_fin')->input('time') ?>

    <?= $form->field($model, 'minutos_descanso')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
