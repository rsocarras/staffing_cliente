<?php

use yii\helpers\Html;

/** @var app\models\LocationSedes $model */
/** @var string $date */
/** @var string $tab */
/** @var array $dayData */
/** @var array $weekData */
?>

<div class="sede-view-modal-content" data-sede-id="<?= $model->id ?>">
    <div class="card border-0 shadow-none mb-0 w-100 rounded-0">
        <div class="card-body pt-0 px-3 px-md-4 pb-4">
            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-3 bg-light">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <span class="avatar avatar-md bg-soft-primary text-primary rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="ti ti-building-store fs-20"></i>
                    </span>
                    <div>
                        <h6 class="fw-semibold mb-1">Datos de la sede</h6>
                        <p class="text-muted small mb-0">Identificación, ubicación e integración.</p>
                    </div>
                </div>
                <p class="fw-semibold fs-16 mb-3"><?= Html::encode($model->nombre) ?></p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <small class="text-muted d-block">Código</small>
                        <span class="fw-medium"><?= Html::encode($model->codigo ?: '—') ?></span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block">Dirección</small>
                        <span class="fw-medium"><?= Html::encode($model->direccion ?: '—') ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Tipo</small>
                        <span class="fw-medium"><?= Html::encode($model->getTipoSedeLabel()) ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Ciudad</small>
                        <span class="fw-medium"><?= $model->city ? Html::encode($model->city->name) : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Estado</small>
                        <?php if ($model->activo): ?>
                            <span class="badge badge-soft-success">Activa</span>
                        <?php else: ?>
                            <span class="badge badge-soft-danger">Inactiva</span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Centro costo</small>
                        <span class="fw-medium"><?= $model->centro_costo !== null ? Html::encode($model->centro_costo) : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Centro costo Staffing</small>
                        <span class="fw-medium"><?= $model->centro_costo_staffing !== null ? Html::encode($model->centro_costo_staffing) : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Cód. externo</small>
                        <span class="fw-medium"><?= Html::encode($model->codigo_externo ?: '—') ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block">Máx. horas clases grupales</small>
                        <span class="fw-medium"><?= $model->max_horas_clases_grupales !== null ? Html::encode(number_format((float) $model->max_horas_clases_grupales, 2, '.', ',')) : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('valor_hora_diurna')) ?></small>
                        <span class="fw-medium"><?= $model->valor_hora_diurna !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_diurna, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('valor_hora_diurna_domingo_festivos')) ?></small>
                        <span class="fw-medium"><?= $model->valor_hora_diurna_domingo_festivos !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_diurna_domingo_festivos, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('valor_hora_nocturna')) ?></small>
                        <span class="fw-medium"><?= $model->valor_hora_nocturna !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_nocturna, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('valor_hora_nocturna_domingo_festiva')) ?></small>
                        <span class="fw-medium"><?= $model->valor_hora_nocturna_domingo_festiva !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_nocturna_domingo_festiva, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('valor_hora_especial')) ?></small>
                        <span class="fw-medium"><?= $model->valor_hora_especial !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_hora_especial, 'COP') : '—' ?></span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted d-block"><?= Html::encode($model->getAttributeLabel('valor_movilizacion')) ?></small>
                        <span class="fw-medium"><?= $model->valor_movilizacion !== null ? Yii::$app->formatter->asCurrency((float) $model->valor_movilizacion, 'COP') : '—' ?></span>
                    </div>
                </div>
            </div>

            <div class="rounded-3 border border-dashed p-3 p-md-4 mb-0 bg-light">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                    <div class="d-flex align-items-start gap-3">
                        <span class="avatar avatar-md bg-soft-info text-info rounded flex-shrink-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="ti ti-users-group fs-20"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-1">Mallas de empleados</h6>
                            <p class="text-muted small mb-0">Turnos por día o semana según la fecha.</p>
                        </div>
                    </div>
                    <form class="sede-view-date-form d-flex align-items-center gap-2 flex-wrap" data-sede-id="<?= $model->id ?>">
                        <input type="hidden" name="tab" value="<?= Html::encode($tab) ?>">
                        <label for="sede-modal-date" class="mb-0 small text-muted">Fecha:</label>
                        <input id="sede-modal-date" type="date" name="date" class="form-control form-control-sm" value="<?= Html::encode($date) ?>" style="max-width: 150px;">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="ti ti-filter me-1"></i>Aplicar</button>
                    </form>
                </div>

                <ul class="nav nav-pills mb-3">
                    <li class="nav-item">
                        <a class="nav-link sede-view-tab <?= $tab === 'day' ? 'active' : '' ?>" href="#" data-tab="day" data-sede-id="<?= $model->id ?>" data-date="<?= Html::encode($date) ?>">
                            <i class="ti ti-calendar-day me-1"></i>Por día
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link sede-view-tab <?= $tab === 'week' ? 'active' : '' ?>" href="#" data-tab="week" data-sede-id="<?= $model->id ?>" data-date="<?= Html::encode($date) ?>">
                            <i class="ti ti-calendar-week me-1"></i>Por semana
                        </a>
                    </li>
                </ul>

                <?php if ($tab === 'week'): ?>
                    <div class="table-responsive rounded-2 border bg-white">
                        <table class="table table-hover table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-semibold ps-3">Empleado</th>
                                    <th class="fw-semibold">Cargo</th>
                                    <th class="fw-semibold">Malla</th>
                                    <?php foreach ($weekData['dates'] as $d): ?>
                                        <th class="fw-semibold text-center"><?= Html::encode(date('d M', strtotime($d))) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($weekData['rows'])): ?>
                                    <tr>
                                        <td colspan="<?= count($weekData['dates']) + 3 ?>" class="text-center py-4 text-muted">
                                            <i class="ti ti-users-off fs-1 d-block mb-2 opacity-50"></i>
                                            No hay empleados activos en esta sede.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($weekData['rows'] as $row): ?>
                                        <tr>
                                            <td class="ps-3"><span class="fw-medium"><?= Html::encode($row['name']) ?></span></td>
                                            <td><?= Html::encode($row['cargo'] ?: '-') ?></td>
                                            <td><?= $row['has_malla'] ? '<span class="badge bg-primary bg-opacity-10 text-primary">' . Html::encode($row['malla']->nombre) . '</span>' : '<span class="badge bg-warning bg-opacity-25 text-warning">Sin malla</span>' ?></td>
                                            <?php foreach ($weekData['dates'] as $d): ?>
                                                <?php $day = $row['days'][$d]; ?>
                                                <td class="text-center">
                                                    <?php if (empty($day['segments'])): ?>
                                                        <span class="text-muted">-</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-light text-dark"><?= Html::encode(sprintf('%02d:%02d', intdiv($day['segments'][0]['start'], 60), $day['segments'][0]['start'] % 60)) ?>...</span>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="table-responsive rounded-2 border bg-white">
                        <table class="table table-hover table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="fw-semibold ps-3">Empleado</th>
                                    <th class="fw-semibold">Cargo</th>
                                    <th class="fw-semibold">Malla</th>
                                    <th class="fw-semibold">Turnos del día</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($dayData['rows'])): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="ti ti-users-off fs-1 d-block mb-2 opacity-50"></i>
                                            No hay empleados activos en esta sede.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($dayData['rows'] as $row): ?>
                                        <tr>
                                            <td class="ps-3"><span class="fw-medium"><?= Html::encode($row['name']) ?></span></td>
                                            <td><?= Html::encode($row['cargo'] ?: '-') ?></td>
                                            <td><?= $row['has_malla'] ? '<span class="badge bg-primary bg-opacity-10 text-primary">' . Html::encode($row['malla']->nombre) . '</span>' : '<span class="badge bg-warning bg-opacity-25 text-warning">Sin malla</span>' ?></td>
                                            <td>
                                                <?php if (empty($row['segments'])): ?>
                                                    <span class="text-muted">Sin turno</span>
                                                <?php else: ?>
                                                    <?php foreach ($row['segments'] as $segment): ?>
                                                        <div class="d-inline-block me-2 mb-1">
                                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                                <?= Html::encode(sprintf('%02d:%02d', intdiv($segment['start'], 60), $segment['start'] % 60)) ?>
                                                                - <?= Html::encode(sprintf('%02d:%02d', intdiv($segment['end'], 60), $segment['end'] % 60)) ?>
                                                            </span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
