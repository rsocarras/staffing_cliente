<?php

use app\models\Candidato;
use app\models\Profile;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Candidato $model */
/** @var yii\widgets\ActiveForm $form */
?>

<?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'correo')->textInput(['maxlength' => true, 'type' => 'email']) ?>

<?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'tipo_documento')->dropDownList(
    Profile::optsTipoDoc(),
    ['prompt' => 'Seleccione', 'id' => 'candidato-tipo_documento']
) ?>

<?= $form->field($model, 'num_documento')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'birthday')->input('date') ?>

<?= $form->field($model, 'sexo')->dropDownList(
    Candidato::optsSexo(),
    ['prompt' => 'Seleccione', 'id' => 'candidato-sexo']
) ?>

<?= $form->field($model, 'estado')->dropDownList(
    Candidato::optsEstado(),
    ['id' => 'candidato-estado']
) ?>

<?= $form->field($model, 'observaciones')->textarea(['rows' => 3]) ?>
