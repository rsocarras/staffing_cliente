<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $user */
/** @var app\models\Profile $profile */
/** @var \Da\User\Module $module */

?>
<?php $this->beginContent($module->viewPath . '/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => ActiveForm::LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'fieldConfig' => ['horizontalCssClasses' => ['label' => 'col-sm-3', 'wrapper' => 'col-sm-9']],
]); ?>

<?= $form->field($profile, 'name') ?>
<?= $form->field($profile, 'public_email') ?>
<?= $form->field($profile, 'website') ?>
<?= $form->field($profile, 'location') ?>
<?= $form->field($profile, 'gravatar_email') ?>
<?= $form->field($profile, 'bio')->textarea() ?>
<?= $form->field($profile, 'empresas_id')->textInput() ?>
<?= $form->field($profile, 'num_doc') ?>
<?= $form->field($profile, 'telefono') ?>
<?= $form->field($profile, 'position') ?>

<div class="mb-3">
    <div class="col-sm-9 offset-sm-3">
        <?= Html::submitButton(Yii::t('usuario', 'Update'), ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
