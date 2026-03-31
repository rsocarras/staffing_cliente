<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\User $model */
/** @var app\models\Profile $profile */
/** @var array $profileFormOptions */
/** @var \yii\rbac\Role[] $allRoles */
/** @var bool $isNew */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<ul class="nav nav-tabs mb-3" role="tablist">
    <li class="nav-item" role="presentation">
        <button type="button" class="nav-link active" data-bs-toggle="tab" data-bs-target="#fullpage-tab-user" role="tab">Usuario</button>
    </li>
    <li class="nav-item" role="presentation">
        <button type="button" class="nav-link" data-bs-toggle="tab" data-bs-target="#fullpage-tab-profile" role="tab">Perfil</button>
    </li>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="fullpage-tab-user">
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>
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
                        <?= Html::checkbox('User[roleNames][]', in_array($name, (array) $model->roleNames, true), [
                            'value' => $name,
                            'id' => 'role-' . preg_replace('/[^a-z0-9_]/i', '_', $name),
                            'class' => 'form-check-input',
                        ]) ?>
                        <label class="form-check-label" for="role-<?= Html::encode(preg_replace('/[^a-z0-9_]/i', '_', $name)) ?>">
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
    </div>

    <div class="tab-pane fade" id="fullpage-tab-profile">
        <?= $this->render('_profile_fields', ['profile' => $profile, 'profileFormOptions' => $profileFormOptions]) ?>
    </div>
</div>

<div class="form-group mt-3">
    <?= Html::submitButton($isNew ? 'Crear' : 'Guardar', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-light']) ?>
</div>

<?php ActiveForm::end(); ?>
