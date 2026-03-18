<?php
use app\models\Requisicion;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Requisicion $model */

$parts = explode('-', $model->group_uuid ?? '');
$shortUuid = $model->group_uuid ? (end($parts) ?: $model->group_uuid) : '-';
$estadoLabel = Requisicion::optsEstado()[$model->estado] ?? $model->estado;
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-receipt me-2 text-primary"></i>
            <?= Html::encode('Requisición ' . $shortUuid . ' #' . (int) $model->vacante_index) ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-hash small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">ID</small>
                        <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-info-circle small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Estado</small>
                        <span class="badge bg-<?= Html::encode(Requisicion::estadoBadgeClass($model->estado)) ?>">
                            <?= Html::encode($estadoLabel) ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-building small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Empresa</small>
                        <span class="fw-medium"><?= Html::encode($model->empresa->nombre ?? '-') ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-map-2 small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Ciudad</small>
                        <span class="fw-medium"><?= Html::encode($model->ciudad->name ?? '-') ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-map-location small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Sede</small>
                        <span class="fw-medium"><?= Html::encode($model->sede->nombre ?? '-') ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-briefcase small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Cargo</small>
                        <span class="fw-medium"><?= Html::encode($model->cargo->nombre ?? '-') ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-calendar small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">F. Ingreso</small>
                        <span class="fw-medium"><?= Html::encode($model->fecha_ingreso ? Yii::$app->formatter->asDate($model->fecha_ingreso) : '-') ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-user small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Persona</small>
                        <span class="fw-medium"><?= Html::encode($model->profile ? ($model->profile->name ?: '-') : '-') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

