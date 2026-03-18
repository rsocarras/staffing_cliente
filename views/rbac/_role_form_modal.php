<?php

use yii\helpers\Html;

/** @var string $name */
/** @var string $description */
/** @var \yii\rbac\Permission[] $allPermissions */
/** @var array $childNames */
?>
<?= Html::beginForm('#', 'post', ['id' => 'form-edit-role-modal']) ?>
<?= Html::hiddenInput('name', $name, ['readonly' => true]) ?>
<div id="role-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>

<div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-users fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Datos del rol</h6>
            <p class="text-muted small mb-0">Nombre (solo lectura) y descripción.</p>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label fw-medium">Nombre</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-tag text-primary"></i></span>
                <input type="text" class="form-control bg-light" value="<?= Html::encode($name) ?>" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <label for="role-edit-description" class="form-label fw-medium">Descripción</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-notes text-primary"></i></span>
                <input type="text" class="form-control" name="description" id="role-edit-description" value="<?= Html::encode($description) ?>" maxlength="255" placeholder="Descripción opcional">
            </div>
        </div>
    </div>
</div>

<div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-key fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Permisos asignados al rol</h6>
            <p class="text-muted small mb-0">Marque los permisos que tendrá este rol.</p>
        </div>
    </div>
    <div class="rounded-3 border bg-white p-3" style="max-height: 260px; overflow-y: auto;">
        <?php foreach ($allPermissions as $permName => $perm): ?>
            <div class="form-check py-2 border-bottom border-opacity-25">
                <?= Html::checkbox('permissions[]', in_array($permName, $childNames, true), [
                    'value' => $permName,
                    'id' => 'perm-edit-' . preg_replace('/[^a-z0-9_]/', '_', $permName),
                    'class' => 'form-check-input',
                ]) ?>
                <label class="form-check-label ms-2" for="perm-edit-<?= preg_replace('/[^a-z0-9_]/', '_', $permName) ?>">
                    <?= Html::encode($permName) ?>
                    <?php if (!empty($perm->description)): ?>
                        <span class="text-muted small">— <?= Html::encode($perm->description) ?></span>
                    <?php endif; ?>
                </label>
            </div>
        <?php endforeach; ?>
        <?php if (empty($allPermissions)): ?>
            <p class="text-muted mb-0">No hay permisos definidos.</p>
        <?php endif; ?>
    </div>
</div>
<?= Html::endForm() ?>
