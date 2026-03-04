<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $user */
/** @var \Da\User\Module $module */

?>
<?php $this->beginContent($module->viewPath . '/admin/update.php', ['user' => $user]) ?>

<?php $form = ActiveForm::begin([
    'layout' => ActiveForm::LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'fieldConfig' => ['horizontalCssClasses' => ['label' => 'col-sm-3', 'wrapper' => 'col-sm-9']],
]); ?>

<?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
<?= $form->field($user, 'password')->passwordInput() ?>

<div class="mb-3">
    <div class="col-sm-9 offset-sm-3">
        <?= Html::submitButton(Yii::t('usuario', 'Update'), ['class' => 'btn btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php $this->endContent() ?>
