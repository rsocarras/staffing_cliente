<?php

use app\models\Empresas;
use app\models\Profile;
use yii\bootstrap5\ActiveForm;
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
$tenantEmpresaId = Yii::$app->user->empresas_id ?? null;
$tenantEmpresa = $tenantEmpresaId ? Empresas::findOne($tenantEmpresaId) : null;
$tenantName = $tenantEmpresa ? $tenantEmpresa->name : 'Tenant no disponible';
$profile->empresas_id = $tenantEmpresaId;
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
        <?= Html::activeHiddenInput($profile, 'empresas_id', ['value' => $tenantEmpresaId]) ?>
        <div class="mb-3">
            <label class="form-label" for="tenant-empresa-label"><?= Html::encode($profile->getAttributeLabel('empresas_id')) ?></label>
            <input id="tenant-empresa-label" type="text" class="form-control" value="<?= Html::encode($tenantName) ?>" readonly>
            <div class="form-text">El usuario quedará asociado al tenant actual.</div>
        </div>
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
