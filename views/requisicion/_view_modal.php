<?php

use app\models\Requisicion;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var Requisicion $model */

$estadoLabel = Requisicion::optsEstado()[$model->estado] ?? $model->estado;
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-2 px-4 pb-4">
        <!-- Identificación -->
        <div class="rounded-3 border border-dashed p-4 mb-4 bg-light">
            <div class="d-flex align-items-start gap-3 mb-4">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-receipt fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Identificación</h6>
                    <p class="text-muted small mb-0">Grupo, número de vacante y estado del trámite.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">ID</small>
                    <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">Vacante</small>
                    <span class="fw-medium">#<?= (int) $model->vacante_index ?> de <?= (int) $model->numero_vacantes ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">Estado</small>
                    <span class="badge badge-soft-<?= Html::encode(Requisicion::estadoBadgeClass($model->estado)) ?>"><?= Html::encode($estadoLabel) ?></span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block mb-1">Grupo UUID</small>
                    <span class="fw-medium small font-monospace"><?= $model->group_uuid ? Html::encode($model->group_uuid) : '—' ?></span>
                </div>
            </div>
        </div>

        <!-- Ubicación y empresa -->
        <div class="rounded-3 border border-dashed p-4 mb-4 bg-light">
            <div class="d-flex align-items-start gap-3 mb-4">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-building-store fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Empresa y ubicación</h6>
                    <p class="text-muted small mb-0">Cliente, ciudad y sede de la vacante.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">Empresa</small>
                    <span class="fw-medium"><?= Html::encode($model->empresa->nombre ?? '—') ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">Ciudad</small>
                    <span class="fw-medium"><?= Html::encode($model->ciudad->name ?? '—') ?></span>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">Sede</small>
                    <span class="fw-medium"><?= Html::encode($model->sede->nombre ?? '—') ?></span>
                </div>
            </div>
        </div>

        <!-- Cargo y condiciones -->
        <div class="rounded-3 border border-dashed p-4 mb-4 bg-light">
            <div class="d-flex align-items-start gap-3 mb-4">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-briefcase fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Cargo y condiciones</h6>
                    <p class="text-muted small mb-0">Puesto, área, jornada, salario y fecha prevista.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Área</small>
                    <span class="fw-medium"><?= Html::encode($model->area->nombre ?? '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Subárea</small>
                    <span class="fw-medium"><?= Html::encode($model->subArea->nombre ?? '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Cargo</small>
                    <span class="fw-medium"><?= Html::encode($model->cargo->nombre ?? '—') ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Jornada</small>
                    <span class="fw-medium"><?= $model->jornada !== null ? Html::encode((string) $model->jornada) : '—' ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Salario</small>
                    <span class="fw-medium"><?= Yii::$app->formatter->asCurrency($model->salario) ?></span>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Auxilio</small>
                    <span class="fw-medium"><?= Yii::$app->formatter->asCurrency($model->auxilio) ?></span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block mb-1">Fecha de ingreso</small>
                    <span class="fw-medium"><?= $model->fecha_ingreso ? Yii::$app->formatter->asDatetime($model->fecha_ingreso) : '—' ?></span>
                </div>
            </div>
        </div>

        <!-- Persona asignada -->
        <div class="rounded-3 border border-dashed p-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-4">
                <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-user fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Persona asignada</h6>
                    <p class="text-muted small mb-0">Candidato o empleado vinculado a esta vacante.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-12">
                    <small class="text-muted d-block mb-1">Nombre</small>
                    <span class="fw-medium"><?= Html::encode($model->personaAsignadaNombre) ?></span>
                </div>
                <?php if ($model->profile): ?>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Documento</small>
                        <span class="fw-medium"><?= Html::encode(trim((string) $model->profile->tipo_doc . ' ' . $model->profile->num_doc)) ?></span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Correo</small>
                        <span class="fw-medium"><?= Html::encode($model->profile->public_email ?: '—') ?></span>
                    </div>
                <?php elseif ($c = $model->candidatoAsignado): ?>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Documento</small>
                        <span class="fw-medium"><?= Html::encode(trim((string) $c->tipo_documento . ' ' . $c->num_documento)) ?></span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-1">Correo</small>
                        <span class="fw-medium"><?= Html::encode($c->correo ?: '—') ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?= $this->render('_checklist_resumen', ['model' => $model]) ?>
    </div>
</div>