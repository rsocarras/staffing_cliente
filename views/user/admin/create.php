<?php

use app\models\Empresas;
use app\models\Profile;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\User $user
 */

$this->title = Yii::t('usuario', 'Create a user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('usuario', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$profile = new Profile();
$profile->loadDefaultValues();
$empresasList = ArrayHelper::map(Empresas::find()->orderBy('name')->all(), 'id', 'name');
$module = Yii::$app->getModule('user');
?>

<?php $this->beginContent($module->viewPath . '/shared/admin_layout.php') ?>

<div class="alert alert-info">
    <?= Yii::t('usuario', 'Credentials will be sent to the user by email') ?>.
    <?= Yii::t('usuario', 'A password will be generated automatically if not provided') ?>.
</div>

<?php $form = ActiveForm::begin([
    'layout' => ActiveForm::LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'fieldConfig' => [
        'horizontalCssClasses' => [
            'label' => 'col-sm-3',
            'wrapper' => 'col-sm-9',
        ],
    ],
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
        <?= $form->field($profile, 'empresas_id')->dropDownList($empresasList, ['prompt' => 'Seleccione empresa...']) ?>
        <?= $form->field($profile, 'num_doc')->textInput(['maxlength' => 40]) ?>
        <?= $form->field($profile, 'name')->textInput(['maxlength' => 255]) ?>
        <?= $form->field($profile, 'tipo_doc')->dropDownList(Profile::optsTipoDoc(), ['prompt' => '']) ?>
        <?= $form->field($profile, 'telefono')->textInput(['maxlength' => 45]) ?>
        <?= $form->field($profile, 'position')->textInput(['maxlength' => 245]) ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton(Yii::t('usuario', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
