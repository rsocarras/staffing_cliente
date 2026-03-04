<?php

use app\models\Empresas;
use app\models\Profile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\User $user
 * @var app\models\Profile $profile
 */

$empresasList = ArrayHelper::map(Empresas::find()->orderBy('name')->all(), 'id', 'name');
?>

<?php $form = ActiveForm::begin([
    'id' => 'user-create-modal-form',
    'action' => ['/user/admin/create-ajax'],
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'validateOnSubmit' => true,
    'options' => ['class' => 'user-create-form'],
]); ?>

<div class="row">
    <div class="col-md-6">
        <h5 class="mb-3"><?= Yii::t('usuario', 'Account details') ?></h5>
        <?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($user, 'email')->textInput(['maxlength' => 255, 'type' => 'email']) ?>
        <?= $form->field($user, 'password')->passwordInput() ?>
    </div>
    <div class="col-md-6">
        <h5 class="mb-3"><?= Yii::t('usuario', 'Profile details') ?></h5>
        <?= $form->field($profile, 'empresas_id')->dropDownList($empresasList, [
            'prompt' => 'Seleccione empresa...',
            'required' => true,
        ]) ?>
        <?= $form->field($profile, 'num_doc')->textInput(['maxlength' => 40]) ?>
        <?= $form->field($profile, 'name')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($profile, 'tipo_doc')->dropDownList(Profile::optsTipoDoc(), ['prompt' => '']) ?>
        <?= $form->field($profile, 'telefono')->textInput(['maxlength' => 45]) ?>
        <?= $form->field($profile, 'position')->textInput(['maxlength' => 245]) ?>
    </div>
</div>

<div class="form-group mt-3">
    <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-success']) ?>
    <?= Html::button(Yii::t('usuario', 'Cancel'), ['class' => 'btn btn-secondary', 'data-bs-dismiss' => 'modal']) ?>
</div>

<?php ActiveForm::end(); ?>
