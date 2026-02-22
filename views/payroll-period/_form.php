<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\PayrollPeriod $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="payroll-period-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'month')->textInput() ?>

    <?= $form->field($model, 'start_date')->textInput() ?>

    <?= $form->field($model, 'end_date')->textInput() ?>

    <?= $form->field($model, 'cutoff_date')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'pendiente_cargar' => 'Pendiente cargar', 'cargada_pendiente_aut' => 'Cargada pendiente aut', 'procesada' => 'Procesada', 'cerrada' => 'Cerrada', 'pagada' => 'Pagada', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'generated_at')->textInput() ?>

    <?= $form->field($model, 'authorized_at')->textInput() ?>

    <?= $form->field($model, 'closed_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
