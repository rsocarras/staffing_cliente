<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var app\models\User $model */
/** @var app\models\Profile $profile */
/** @var array $profileFormOptions */
/** @var \yii\rbac\Role[] $allRoles */
/** @var bool $isNew */
/** @var int[] $profileSedeIds */
/** @var array<int, string> $sedesMap */

$profileSedeIds = $profileSedeIds ?? [];
$sedesMap = $sedesMap ?? [];

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<ul class="nav nav-tabs nav-tabs-custom mb-3" role="tablist">
    <li class="nav-item" role="presentation">
        <button type="button" class="nav-link active" id="fullpage-tab-user-btn" data-bs-toggle="tab" data-bs-target="#fullpage-tab-user" role="tab">Usuario</button>
    </li>
    <li class="nav-item" role="presentation">
        <button type="button" class="nav-link" id="fullpage-tab-profile-btn" data-bs-toggle="tab" data-bs-target="#fullpage-tab-profile" role="tab">Perfil</button>
    </li>
    <?php if (!$isNew): ?>
    <li class="nav-item" role="presentation">
        <button type="button" class="nav-link" id="fullpage-tab-sedes-btn" data-bs-toggle="tab" data-bs-target="#fullpage-tab-sedes" role="tab">Sedes</button>
    </li>
    <?php endif; ?>
</ul>

<div class="tab-content">
    <div class="tab-pane fade show active" id="fullpage-tab-user" role="tabpanel">
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-user fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Datos del usuario</h6>
                    <p class="text-muted small mb-0">Usuario, correo y confirmación.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <?= $form->field($model, 'username', [
                        'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-at text-primary"></i></span>{input}</div>{error}{hint}',
                        'options' => ['class' => 'mb-0'],
                        'labelOptions' => ['class' => 'form-label fw-medium'],
                    ])->textInput(['maxlength' => true, 'class' => 'form-control bg-light', 'readonly' => !$isNew]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'email', [
                        'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-mail text-primary"></i></span>{input}</div>{error}{hint}',
                        'options' => ['class' => 'mb-0'],
                        'labelOptions' => ['class' => 'form-label fw-medium'],
                    ])->textInput(['maxlength' => true, 'type' => 'email', 'class' => 'form-control']) ?>
                </div>
                <div class="col-12">
                    <?= $form->field($model, 'isConfirmed', [
                        'template' => '<div class="form-check form-switch">{input}{label}</div>{error}',
                        'options' => ['class' => 'mb-0'],
                    ])->checkbox(['class' => 'form-check-input', 'label' => 'Usuario confirmado (puede iniciar sesión)', 'labelOptions' => ['class' => 'form-check-label']]) ?>
                </div>
                <div class="col-12">
                    <?php if ($isNew): ?>
                        <?= $form->field($model, 'new_password', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-lock text-primary"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->passwordInput(['maxlength' => true, 'class' => 'form-control'])->hint('Mínimo 6 caracteres') ?>
                    <?php else: ?>
                        <?= $form->field($model, 'new_password', [
                            'template' => '{label}<div class="input-group"><span class="input-group-text bg-white"><i class="ti ti-lock text-primary"></i></span>{input}</div>{error}{hint}',
                            'options' => ['class' => 'mb-0'],
                            'labelOptions' => ['class' => 'form-label fw-medium'],
                        ])->passwordInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Dejar en blanco para no cambiar'])->hint('Dejar en blanco para no cambiar la contraseña') ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-shield fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Roles</h6>
                    <p class="text-muted small mb-0">Asigne los roles de este usuario.</p>
                </div>
            </div>
            <div class="rounded-3 border bg-white p-3" style="max-height: 220px; overflow-y: auto;">
                <?php foreach ($allRoles as $name => $role): ?>
                    <div class="form-check py-2 border-bottom border-opacity-25">
                        <?= Html::checkbox('User[roleNames][]', in_array($name, (array) $model->roleNames, true), [
                            'value' => $name,
                            'id' => 'role-' . preg_replace('/[^a-z0-9_]/i', '_', $name),
                            'class' => 'form-check-input',
                        ]) ?>
                        <label class="form-check-label ms-2" for="role-<?= Html::encode(preg_replace('/[^a-z0-9_]/i', '_', $name)) ?>">
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

    <div class="tab-pane fade" id="fullpage-tab-profile" role="tabpanel">
        <?= $this->render('_profile_fields', ['profile' => $profile, 'profileFormOptions' => $profileFormOptions]) ?>
    </div>

    <?php if (!$isNew): ?>
    <div class="tab-pane fade" id="fullpage-tab-sedes" role="tabpanel">
        <?= $this->render('_profile_sedes_tab', [
            'profileSedeIds' => $profileSedeIds,
            'sedesMap' => $sedesMap,
        ]) ?>
    </div>
    <?php endif; ?>
</div>

<div class="form-group mt-3">
    <?= Html::submitButton($isNew ? 'Crear' : 'Guardar', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-light']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php
if (!$isNew && !empty($sedesMap)) {
    $this->registerJs(
        'if (typeof syncProfileSedeTiles === "function") { syncProfileSedeTiles(jQuery(document)); }',
        \yii\web\View::POS_READY
    );
}
?>
