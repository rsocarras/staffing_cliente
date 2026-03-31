<?php

use app\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Profile $model */
/** @var array $profileFormOptions */
/** @var \app\models\Contrato[] $contratos */
/** @var \app\models\Contrato $contratoNew */
/** @var array $contratoOptions */
/** @var bool $canManageContratos */
/** @var int $userId */

$avatarUrl = $model->photo_ ? Url::to($model->photo_) : Url::to('@web/assets/img/users/user-13.jpg');
$empresaNombre = $model->empresas ? trim((string) ($model->empresas->name ?? $model->empresas->social_name ?? '')) : '';
$empresaNombre = $empresaNombre !== '' ? $empresaNombre : '—';

$tipoLabel = $model->tipo_doc ? (Profile::optsTipoDoc()[$model->tipo_doc] ?? $model->tipo_doc) : '—';
$cargoNombre = $model->cargo ? $model->cargo->nombre : ($model->position ?: '—');
$estadoLabelPlain = $model->estado ? (Profile::optsEstado()[$model->estado] ?? $model->estado) : '—';
$estadoBadgeClass = $model->estado ? Profile::estadoBadgeSoftClass($model->estado) : '';
?>

<div class="w-100">
    <div class="px-3 px-md-4 pt-3 pb-2 border-bottom bg-white">
        <h5 class="fw-bold mb-1"><?= Html::encode($model->name ?: 'Colaborador') ?></h5>
        <p class="text-muted small mb-0">ID de usuario <?= Html::encode((string) $model->user_id) ?> · <?= Html::encode(\Yii::t('app', 'datos de la empresa actual')) ?></p>
    </div>

    <ul class="nav nav-tabs nav-tabs-custom mx-3 mx-md-4 mt-3 mb-0" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="emp-view-tab-resumen" data-bs-toggle="tab" data-bs-target="#emp-view-resumen" type="button" role="tab"><?= Html::encode(\Yii::t('app', 'Resumen')) ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="emp-view-tab-perfil" data-bs-toggle="tab" data-bs-target="#emp-view-perfil" type="button" role="tab"><?= Html::encode(\Yii::t('app', 'Perfil')) ?></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="emp-view-tab-contratos" data-bs-toggle="tab" data-bs-target="#emp-view-contratos" type="button" role="tab"><?= Html::encode(\Yii::t('app', 'Contratos')) ?></button>
        </li>
    </ul>

    <div class="tab-content px-3 px-md-4 pb-4 pt-3">
        <div class="tab-pane fade show active" id="emp-view-resumen" role="tabpanel">
            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-user fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Identificación')) ?></h6>
                        <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Foto y nombre como en la ficha del colaborador.')) ?></p>
                    </div>
                </div>
                <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-3 mb-3">
                    <div class="avatar avatar-xl rounded-circle flex-shrink-0">
                        <img class="rounded-circle" src="<?= Html::encode($avatarUrl) ?>" alt="<?= Html::encode($model->name ?: 'Colaborador') ?>" style="width: 72px; height: 72px; object-fit: cover;">
                    </div>
                    <div class="flex-grow-1 min-w-0 w-100">
                        <label class="form-label fw-medium mb-1" for="emp-view-name"><?= Html::encode($model->getAttributeLabel('name')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-user text-primary"></i></span>
                            <input id="emp-view-name" type="text" class="form-control bg-light" readonly value="<?= Html::encode($model->name ?: '—') ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-id fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Documento y contacto')) ?></h6>
                        <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Datos principales de contacto y documento.')) ?></p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-tipo-doc"><?= Html::encode($model->getAttributeLabel('tipo_doc')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-file-text text-primary"></i></span>
                            <input id="emp-view-tipo-doc" type="text" class="form-control bg-light" readonly value="<?= Html::encode($tipoLabel) ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-num-doc"><?= Html::encode($model->getAttributeLabel('num_doc')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-numbers text-primary"></i></span>
                            <input id="emp-view-num-doc" type="text" class="form-control bg-light" readonly value="<?= Html::encode($model->num_doc ?: '—') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-email"><?= Html::encode($model->getAttributeLabel('public_email')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-mail text-primary"></i></span>
                            <input id="emp-view-email" type="text" class="form-control bg-light" readonly value="<?= Html::encode($model->public_email ?: '—') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-tel"><?= Html::encode($model->getAttributeLabel('telefono')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-phone text-primary"></i></span>
                            <input id="emp-view-tel" type="text" class="form-control bg-light" readonly value="<?= Html::encode($model->telefono ?: '—') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-cargo"><?= Html::encode(\Yii::t('app', 'Cargo')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-briefcase text-primary"></i></span>
                            <input id="emp-view-cargo" type="text" class="form-control bg-light" readonly value="<?= Html::encode($cargoNombre) ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1 d-block"><?= Html::encode($model->getAttributeLabel('estado')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-flag text-primary"></i></span>
                            <div class="form-control bg-light d-flex align-items-center min-h-auto py-2">
                                <?php if ($model->estado && $estadoBadgeClass !== ''): ?>
                                    <span class="badge badge-soft-<?= Html::encode($estadoBadgeClass) ?>"><?= Html::encode($estadoLabelPlain) ?></span>
                                <?php else: ?>
                                    <span class="text-body"><?= Html::encode($estadoLabelPlain) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-building fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Organización')) ?></h6>
                        <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Sede, área y empresa.')) ?></p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-sede"><?= Html::encode($model->getAttributeLabel('sede_id')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-map-pin text-primary"></i></span>
                            <input id="emp-view-sede" type="text" class="form-control bg-light" readonly value="<?= Html::encode($model->sede ? $model->sede->nombre : '—') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-area"><?= Html::encode($model->getAttributeLabel('area_id')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-layout-grid text-primary"></i></span>
                            <input id="emp-view-area" type="text" class="form-control bg-light" readonly value="<?= Html::encode($model->area ? $model->area->nombre : '—') ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-medium mb-1" for="emp-view-empresa"><?= Html::encode(\Yii::t('app', 'Empresa')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-building-community text-primary"></i></span>
                            <input id="emp-view-empresa" type="text" class="form-control bg-light" readonly value="<?= Html::encode($empresaNombre) ?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-map-2 fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1"><?= Html::encode(\Yii::t('app', 'Ubicación')) ?></h6>
                        <p class="text-muted small mb-0"><?= Html::encode(\Yii::t('app', 'Dirección y ciudad.')) ?></p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label fw-medium mb-1" for="emp-view-address"><?= Html::encode($model->getAttributeLabel('address')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white align-items-start pt-2"><i class="ti ti-home text-primary"></i></span>
                            <textarea id="emp-view-address" class="form-control bg-light" readonly rows="2"><?= Html::encode($model->address ?: '—') ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-city"><?= Html::encode($model->getAttributeLabel('city')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-building-store text-primary"></i></span>
                            <input id="emp-view-city" type="text" class="form-control bg-light" readonly value="<?= Html::encode($model->city ?: '—') ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-medium mb-1" for="emp-view-location"><?= Html::encode($model->getAttributeLabel('location')) ?></label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-world text-primary"></i></span>
                            <input id="emp-view-location" type="text" class="form-control bg-light" readonly value="<?= Html::encode($model->location ?: '—') ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="emp-view-perfil" role="tabpanel">
            <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light">
                <h6 class="fw-semibold mb-3"><?= Html::encode(\Yii::t('app', 'Datos del perfil')) ?></h6>
                <?= $this->render('//user-management/_profile_fields_readonly', [
                    'profile' => $model,
                    'profileFormOptions' => $profileFormOptions,
                    'photoEditHint' => \Yii::t('app', 'Puede cambiar la foto y el resto de campos desde «Editar» en esta pantalla o desde Gestión de usuarios.'),
                ]) ?>
            </div>
        </div>

        <div class="tab-pane fade" id="emp-view-contratos" role="tabpanel">
            <?= $this->render('_contratos_panel', [
                'contratos' => $contratos,
                'contratoNew' => $contratoNew,
                'contratoOptions' => $contratoOptions,
                'canManageContratos' => $canManageContratos,
                'userId' => $userId,
            ]) ?>
        </div>
    </div>
</div>
