<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ProfileEventosLog $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-eventos-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_id')->textInput() ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'event_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entity_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entity_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'actor_user_id')->textInput() ?>

    <?= $form->field($model, 'before_json')->textInput() ?>

    <?= $form->field($model, 'after_json')->textInput() ?>

    <?= $form->field($model, 'contexto_json')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
