<?php

use yii\helpers\Html;

/** @var app\models\Cargos $model */
/** @var list<array{tipo: \app\models\NovedadTipo, conceptos: list<\app\models\NovedadConcepto>}> $conceptosPorAgrupador */
/** @var int[] $selectedIdsConceptosCargo */

$areaName = $model->area ? $model->area->nombre : '—';
$subAreaName = $model->subArea ? $model->subArea->nombre : '—';
$conceptosPorAgrupador = $conceptosPorAgrupador ?? [];
$selectedIdsConceptosCargo = $selectedIdsConceptosCargo ?? [];
$selectedSet = array_fill_keys($selectedIdsConceptosCargo, true);
$totalConceptos = count($selectedIdsConceptosCargo);
?>

<div class="card border-0 shadow-none mb-0 w-100 rounded-0">
    <div class="card-body pt-0 px-3 px-md-4 pb-4">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-bottom mb-3" id="cargo-view-tab-nav" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="cargo-view-info-tab"
                        data-bs-toggle="tab" data-bs-target="#cargo-view-info"
                        type="button" role="tab" aria-controls="cargo-view-info" aria-selected="true">
                    <i class="ti ti-info-circle me-1"></i>Información
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="cargo-view-conceptos-tab"
                        data-bs-toggle="tab" data-bs-target="#cargo-view-conceptos"
                        type="button" role="tab" aria-controls="cargo-view-conceptos" aria-selected="false">
                    <i class="ti ti-list-check me-1"></i>Conceptos de novedad
                    <?php if ($totalConceptos > 0): ?>
                        <span class="badge bg-warning text-dark ms-1"><?= $totalConceptos ?></span>
                    <?php endif; ?>
                </button>
            </li>
        </ul>

        <div class="tab-content" id="cargo-view-tab-content">
            <!-- Tab: Información -->
            <div class="tab-pane fade show active" id="cargo-view-info" role="tabpanel" aria-labelledby="cargo-view-info-tab">
                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-briefcase fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Identificación</h6>
                            <p class="text-muted small mb-0">Código, nombre y estado.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <small class="text-muted d-block">ID</small>
                            <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Código</small>
                            <span class="fw-medium"><?= Html::encode((string) ($model->codigo ?: '—')) ?></span>
                        </div>
                        <div class="col-md-4">
                            <small class="text-muted d-block">Activo</small>
                            <?php if ($model->activo): ?>
                                <span class="badge badge-soft-success">Sí</span>
                            <?php else: ?>
                                <span class="badge badge-soft-danger">No</span>
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <small class="text-muted d-block">Nombre</small>
                            <span class="fw-medium"><?= Html::encode((string) ($model->nombre ?: '—')) ?></span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-sitemap fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Estructura organizacional</h6>
                            <p class="text-muted small mb-0">Área y subárea asociadas.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Área</small>
                            <span class="fw-medium"><?= Html::encode($areaName) ?></span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Subárea</small>
                            <span class="fw-medium"><?= Html::encode($subAreaName) ?></span>
                        </div>
                    </div>
                </div>

                <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-success text-success rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-notes fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Descripción</h6>
                            <p class="text-muted small mb-0">Detalle del cargo.</p>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-12">
                            <span class="fw-medium"><?= Html::encode((string) ($model->descripcion ?: '—')) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab: Conceptos de novedad (solo lectura) -->
            <div class="tab-pane fade" id="cargo-view-conceptos" role="tabpanel" aria-labelledby="cargo-view-conceptos-tab">
                <div class="rounded-3 border border-dashed p-3 p-md-4 bg-light">
                    <div class="d-flex align-items-start gap-3 mb-3">
                        <span class="avatar avatar-md bg-soft-warning text-warning rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-list-check fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Conceptos de novedad asignados</h6>
                            <p class="text-muted small mb-0">Conceptos de novedad que aplican a este cargo.</p>
                        </div>
                    </div>

                    <?php if ($conceptosPorAgrupador === [] || $totalConceptos === 0): ?>
                        <div class="alert alert-light border small mb-0">
                            <?= Html::encode(Yii::t('app', 'No hay conceptos de novedad asignados a este cargo.')) ?>
                        </div>
                    <?php else: ?>
                        <div class="accordion" id="cargo-view-conceptos-acc-<?= Html::encode((string) $model->id) ?>">
                            <?php foreach ($conceptosPorAgrupador as $idx => $grupo): ?>
                                <?php
                                $tipo = $grupo['tipo'];
                                $conceptos = $grupo['conceptos'];
                                $conceptosSeleccionados = array_filter($conceptos, fn($c) => isset($selectedSet[(int) $c->id]));
                                if ($conceptosSeleccionados === []) {
                                    continue;
                                }
                                $tid = (int) $tipo->id;
                                $collapseId = 'cargo-view-acc-' . $model->id . '-c-' . $tid;
                                $headingId = 'cargo-view-acc-' . $model->id . '-h-' . $tid;
                                ?>
                                <div class="accordion-item border">
                                    <h2 class="accordion-header" id="<?= Html::encode($headingId) ?>">
                                        <button
                                            class="accordion-button <?= $idx === 0 ? '' : 'collapsed' ?> shadow-none"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#<?= Html::encode($collapseId) ?>"
                                            aria-expanded="<?= $idx === 0 ? 'true' : 'false' ?>"
                                            aria-controls="<?= Html::encode($collapseId) ?>"
                                        >
                                            <span><?= Html::encode((string) ($tipo->nombre ?? '')) ?></span>
                                            <span class="badge bg-warning text-dark ms-2"><?= count($conceptosSeleccionados) ?></span>
                                        </button>
                                    </h2>
                                    <div id="<?= Html::encode($collapseId) ?>" class="accordion-collapse collapse <?= $idx === 0 ? 'show' : '' ?>" aria-labelledby="<?= Html::encode($headingId) ?>">
                                        <div class="accordion-body pt-2">
                                            <div class="d-flex flex-wrap gap-2">
                                                <?php foreach ($conceptosSeleccionados as $c): ?>
                                                    <span class="badge badge-soft-warning fs-12 fw-medium px-2 py-1">
                                                        <i class="ti ti-check me-1"></i><?= Html::encode((string) ($c->nombre ?? '')) ?>
                                                    </span>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
