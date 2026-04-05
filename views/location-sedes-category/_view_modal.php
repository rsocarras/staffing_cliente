<?php

use yii\helpers\Html;

/** @var app\models\LocationSedesCategory $model */
/** @var app\models\LocationSedes[] $sedes */
?>
<div class="sede-category-view-modal-content" data-category-id="<?= (int) $model->id ?>">
    <div class="card border-0 shadow-none mb-0 w-100 rounded-0">
        <div class="card-body pt-0 px-3 px-md-4 pb-4">
            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-category fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1">Categoría de sedes</h6>
                        <p class="text-muted small mb-0">Detalle de la categoría y sedes asignadas.</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">ID</small>
                        <span class="fw-medium"><?= (int) $model->id ?></span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Nombre</small>
                        <span class="fw-medium"><?= Html::encode($model->nombre) ?></span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Empresa cliente</small>
                        <span class="fw-medium"><?= $model->empresaCliente ? Html::encode($model->empresaCliente->nombre) : '—' ?></span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Estado</small>
                        <?= (int) $model->activo === 1
                            ? '<span class="badge badge-soft-success">Activa</span>'
                            : '<span class="badge badge-soft-danger">Inactiva</span>' ?>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Valor hora base</small>
                        <span class="fw-medium"><?= $model->valor_hora_base !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_base, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Valor domingo/festivos</small>
                        <span class="fw-medium"><?= $model->valor_hora_domingo_festivos !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_domingo_festivos, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Valor hora nocturna</small>
                        <span class="fw-medium"><?= $model->valor_hora_nocturna !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_nocturna, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Valor nocturna festiva</small>
                        <span class="fw-medium"><?= $model->valor_hora_nocturna_festiva !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_nocturna_festiva, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Valor nocturna dom/fest</small>
                        <span class="fw-medium"><?= $model->valor_hora_nocturna_dominical_festiva !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_nocturna_dominical_festiva, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Valor hora especial</small>
                        <span class="fw-medium"><?= $model->valor_hora_especial !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_especial, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Valor movilización</small>
                        <span class="fw-medium"><?= $model->valor_movilizacion !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_movilizacion, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block mb-2">Sedes asignadas</small>
                        <?php if (empty($sedes)): ?>
                            <span class="text-muted">Sin sedes asignadas.</span>
                        <?php else: ?>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach ($sedes as $sede): ?>
                                    <span class="badge badge-soft-primary"><?= Html::encode($sede->nombre) ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
