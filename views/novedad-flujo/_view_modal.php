<?php

use app\models\NovedadFlujo;
use app\models\NovedadStep;
use yii\helpers\Html;

/** @var app\models\NovedadFlujo $model */

$estados = NovedadFlujo::estadoLista();
$estadoTexto = $estados[$model->estado] ?? $model->estado;
$estadoBadgeCls = NovedadFlujo::estadoBadgeSoftClass($model->estado);
$tipoLabels = NovedadStep::tipoPasoLista();
$steps = $model->novedadSteps;
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-git-branch fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Identificación</h6>
                    <p class="text-muted small mb-0">Código interno y estado del flujo.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">ID</small>
                    <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                </div>
                <div class="col-md-8">
                    <small class="text-muted d-block">Estado</small>
                    <span class="badge badge-soft-<?= Html::encode($estadoBadgeCls) ?>"><?= Html::encode($estadoTexto) ?></span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Nombre</small>
                    <span class="fw-medium"><?= Html::encode($model->nombre) ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-notes fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Descripción</h6>
                    <p class="text-muted small mb-0">Texto explicativo del flujo.</p>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-12">
                    <span class="fw-medium"><?= Html::encode($model->descripcion ?: '—') ?></span>
                </div>
            </div>
        </div>

        <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
            <div class="d-flex align-items-start gap-3 mb-3">
                <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                    <i class="ti ti-list-numbers fs-20"></i>
                </span>
                <div>
                    <h6 class="fw-semibold mb-1">Pasos del flujo</h6>
                    <p class="text-muted small mb-0">Orden, tipo y responsable de cada paso configurado.</p>
                </div>
            </div>
            <?php if (empty($steps)): ?>
                <p class="text-muted small mb-0">No hay pasos configurados aún.</p>
            <?php else: ?>
                <ul class="list-group list-group-flush rounded-2 border">
                    <?php foreach ($steps as $s): ?>
                        <?php
                        $tipoTxt = $tipoLabels[$s->tipo_paso] ?? $s->tipo_paso;
                        $resp = $s->profile ? trim(($s->profile->name ?: '') . ' — ' . $s->profile->num_doc) : '—';
                        ?>
                        <li class="list-group-item px-3 py-2">
                            <div class="d-flex flex-wrap align-items-start gap-2">
                                <span class="badge bg-secondary flex-shrink-0"><?= (int) $s->orden ?></span>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="fw-medium text-dark"><?= Html::encode($s->nombre ?: $s->codigo) ?></div>
                                    <div class="small text-muted">
                                        <code><?= Html::encode($s->codigo) ?></code>
                                        · <?= Html::encode($tipoTxt) ?>
                                        · <?= Html::encode($resp) ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
