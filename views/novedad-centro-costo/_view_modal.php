<?php

use yii\helpers\Html;

/** @var app\models\NovedadCentroCosto $model */

$sedeNombre = '—';
$orgNombre = '—';
$ecNombre = '—';
if ($model->empresaCliente !== null) {
    $ecNombre = trim((string) ($model->empresaCliente->nombre ?? '')) ?: ('#' . $model->empresaCliente->id);
}
if ($model->locationSede !== null) {
    $sedeNombre = trim((string) ($model->locationSede->nombre ?? '')) ?: ('#' . $model->locationSede->id);
    if ($model->locationSede->empresa !== null) {
        $orgNombre = trim((string) ($model->locationSede->empresa->name ?? $model->locationSede->empresa->social_name ?? '')) ?: ('#' . $model->locationSede->empresa->id);
    }
}

$activo = (int) $model->activo === 1;
?>

<div class="p-0 ncc-view-modal">
    <div class="px-4 pt-4 pb-3 bg-light border-bottom">
        <div class="d-flex flex-wrap align-items-start gap-3">
            <span class="avatar avatar-lg bg-secondary bg-opacity-10 text-secondary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 52px; height: 52px;" aria-hidden="true">
                <i class="ti ti-building-bank fs-22"></i>
            </span>
            <div class="flex-grow-1 min-w-0">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                    <h4 class="mb-0 fs-18 fw-bold text-dark"><?= Html::encode($model->nombre) ?></h4>
                    <?php if ($model->codigo !== null && $model->codigo !== ''): ?>
                        <span class="badge rounded-pill bg-white text-dark border px-2 py-1 fw-semibold small"><?= Html::encode($model->codigo) ?></span>
                    <?php endif; ?>
                    <?php if ($activo): ?>
                        <span class="badge badge-soft-success"><?= Yii::t('app', 'Activo') ?></span>
                    <?php else: ?>
                        <span class="badge badge-soft-danger"><?= Yii::t('app', 'Inactivo') ?></span>
                    <?php endif; ?>
                </div>
                <p class="text-muted small mb-0"><?= Yii::t('app', 'ID') ?>: <?= (int) $model->id ?></p>
            </div>
        </div>
    </div>

    <div class="p-4">
        <div class="row g-3">
            <div class="col-12 col-lg-6">
                <div class="rounded-3 border border-dashed bg-light p-3 h-100">
                    <h6 class="fw-semibold text-dark mb-3 d-flex align-items-center gap-2 fs-14">
                        <span class="avatar avatar-xs bg-white border rounded d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" aria-hidden="true">
                            <i class="ti ti-building text-secondary fs-14"></i>
                        </span>
                        <?= Html::encode(Yii::t('app', 'Organización y sede')) ?>
                    </h6>
                    <dl class="mb-0">
                        <div class="mb-3 pb-3 border-bottom border-light">
                            <dt class="fw-semibold text-dark small mb-1"><?= Html::encode(Yii::t('app', 'Organización')) ?></dt>
                            <dd class="mb-0 text-body small"><?= Html::encode($orgNombre) ?></dd>
                        </div>
                        <div class="mb-0">
                            <dt class="fw-semibold text-dark small mb-1"><?= Html::encode(Yii::t('app', 'Sede')) ?></dt>
                            <dd class="mb-0 text-body small d-flex align-items-center gap-2">
                                <i class="ti ti-map-pin text-secondary fs-16" aria-hidden="true"></i>
                                <span><?= Html::encode($sedeNombre) ?></span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="rounded-3 border border-dashed bg-light p-3 h-100">
                    <h6 class="fw-semibold text-dark mb-3 d-flex align-items-center gap-2 fs-14">
                        <span class="avatar avatar-xs bg-white border rounded d-inline-flex align-items-center justify-content-center" style="width: 28px; height: 28px;" aria-hidden="true">
                            <i class="ti ti-briefcase text-secondary fs-14"></i>
                        </span>
                        <?= Html::encode(Yii::t('app', 'Empresa cliente')) ?>
                    </h6>
                    <dl class="mb-0">
                        <div class="mb-0">
                            <dt class="fw-semibold text-dark small mb-1"><?= Html::encode(Yii::t('app', 'Cliente')) ?></dt>
                            <dd class="mb-0 text-body small"><?= Html::encode($ecNombre) ?></dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed bg-white p-3 mt-3">
            <h6 class="fw-semibold text-dark mb-3 d-flex align-items-center gap-2 fs-14">
                <i class="ti ti-clock-hour-4 text-secondary fs-16" aria-hidden="true"></i>
                <?= Html::encode(Yii::t('app', 'Registro')) ?>
            </h6>
            <div class="row g-3">
                <div class="col-sm-6">
                    <p class="fw-semibold text-dark small mb-1"><?= Html::encode(Yii::t('app', 'Creado')) ?></p>
                    <p class="mb-0 text-muted small"><?= Html::encode((string) ($model->created_at ?? '—')) ?></p>
                </div>
                <div class="col-sm-6">
                    <p class="fw-semibold text-dark small mb-1"><?= Html::encode(Yii::t('app', 'Actualizado')) ?></p>
                    <p class="mb-0 text-muted small"><?= Html::encode((string) ($model->updated_at ?? '—')) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
