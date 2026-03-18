<?php

use yii\helpers\Html;

/** @var string $name */
/** @var string $description */
?>
<?= Html::beginForm('#', 'post', ['id' => 'form-edit-permission-modal']) ?>
<?= Html::hiddenInput('name', $name) ?>
<div id="permission-edit-form-errors" class="alert alert-danger border-0 d-none mb-3"></div>

<div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
    <div class="d-flex align-items-start gap-3 mb-3">
        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
            <i class="ti ti-key fs-20"></i>
        </span>
        <div>
            <h6 class="fw-semibold mb-1">Datos del permiso</h6>
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
            <label for="permission-edit-description" class="form-label fw-medium">Descripción</label>
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="ti ti-notes text-primary"></i></span>
                <input type="text" class="form-control" name="description" id="permission-edit-description" value="<?= Html::encode($description) ?>" maxlength="255" placeholder="Descripción opcional">
            </div>
        </div>
    </div>
</div>
<?= Html::endForm() ?>
