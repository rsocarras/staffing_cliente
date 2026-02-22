<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'tipo_doc')->dropDownList([ 'CC' => 'CC', 'CE' => 'CE', 'NIT' => 'NIT', 'PAS' => 'PAS', 'TI' => 'TI', 'OTRO' => 'OTRO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'num_doc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'public_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gravatar_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gravatar_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timezone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sexo')->dropDownList([ 'M' => 'M', 'F' => 'F', 'X' => 'X', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'empresas_id')->textInput() ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'activo' => 'Activo', 'inactivo' => 'Inactivo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birthday')->textInput() ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo_')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tiktok')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'linkedin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'youtube')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_json')->textInput() ?>

    <?= $form->field($model, 'sede_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cargo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centro_costo_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'centro_utilidad_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
