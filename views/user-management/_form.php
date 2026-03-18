<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\User $model */
/** @var \yii\rbac\Role[] $allRoles */
/** @var bool $isNew */
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>
<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'isConfirmed')->checkbox(['label' => 'Usuario confirmado (puede iniciar sesión)']) ?>

<?php if ($isNew): ?>
    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true])->hint('Mínimo 6 caracteres') ?>
<?php else: ?>
    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true, 'placeholder' => 'Dejar en blanco para no cambiar'])->hint('Dejar en blanco para no cambiar la contraseña') ?>
<?php endif; ?>

<div class="form-group">
    <label class="form-label">Roles</label>
    <div class="border rounded p-3">
        <?php foreach ($allRoles as $name => $role): ?>
            <div class="form-check">
                <?= Html::checkbox('User[roleNames][]', in_array($name, (array)$model->roleNames, true), [
                    'value' => $name,
                    'id' => 'role-' . $name,
                    'class' => 'form-check-input',
                ]) ?>
                <label class="form-check-label" for="role-<?= Html::encode($name) ?>">
                    <?= Html::encode($name) ?>
                    <?php if (!empty($role->description)): ?>
                        <span class="text-muted small">— <?= Html::encode($role->description) ?></span>
                    <?php endif; ?>
                </label>
            </div>
        <?php endforeach; ?>
        <?php if (empty($allRoles)): ?>
            <p class="text-muted mb-0">No hay roles definidos.</p>
        <?php endif; ?>
    </div>
</div>

<div class="form-group mt-3">
    <?= Html::submitButton($isNew ? 'Crear' : 'Guardar', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-light']) ?>
</div>

<?php ActiveForm::end(); ?>
