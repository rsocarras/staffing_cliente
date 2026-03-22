<?php

use Yii;
use app\models\Presupuesto;
use app\models\PresupuestoConceptoDia;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Presupuesto $model */
/** @var app\models\PresupuestoConcepto[] $conceptos */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Presupuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$dias = PresupuestoConceptoDia::optsDiaSemana();

$estadoCls = 'bg-secondary';
if ($model->estado === Presupuesto::ESTADO_APROBADO) {
    $estadoCls = 'bg-success';
} elseif ($model->estado === Presupuesto::ESTADO_PENDIENTE_APROBACION) {
    $estadoCls = 'bg-warning text-dark';
} elseif ($model->estado === Presupuesto::ESTADO_RECHAZADO) {
    $estadoCls = 'bg-danger';
} elseif ($model->estado === Presupuesto::ESTADO_BORRADOR) {
    $estadoCls = 'bg-info text-dark';
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex flex-wrap gap-2 pb-3 align-items-center">
            <h4 class="mb-0 flex-grow-1"><?= Html::encode($model->nombre) ?></h4>
            <div>
                <?= Html::a('Volver al listado', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
                <?php if (Yii::$app->user->can('presupuesto_update') && $model->isEditable()): ?>
                    <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
                <?php if (Yii::$app->user->can('presupuesto_submit') && $model->isEditable()): ?>
                    <?= Html::beginForm(['submit', 'id' => $model->id], 'post', ['class' => 'd-inline']) ?>
                    <?= Html::submitButton('Enviar a aprobación', ['class' => 'btn btn-success', 'data-confirm' => '¿Enviar este presupuesto a aprobación?']) ?>
                    <?= Html::endForm() ?>
                <?php endif; ?>
                <?php if (Yii::$app->user->can('presupuesto_clone')): ?>
                    <?= Html::beginForm(['clone', 'id' => $model->id], 'post', ['class' => 'd-inline']) ?>
                    <?= Html::submitButton('Clonar', ['class' => 'btn btn-outline-primary']) ?>
                    <?= Html::endForm() ?>
                <?php endif; ?>
                <?php if (Yii::$app->user->can('presupuesto_cancel') && !in_array($model->estado, [Presupuesto::ESTADO_INACTIVO], true)): ?>
                    <?= Html::beginForm(['cancel', 'id' => $model->id], 'post', ['class' => 'd-inline']) ?>
                    <?= Html::textInput('comentario', '', ['class' => 'd-none', 'placeholder' => 'Motivo']) ?>
                    <?= Html::submitButton('Anular', [
                        'class' => 'btn btn-outline-danger',
                        'data-confirm' => '¿Anular este presupuesto?',
                    ]) ?>
                    <?= Html::endForm() ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-2">
                    <div class="col-md-4">
                        <div class="text-muted small">Estado</div>
                        <div><span class="badge <?= $estadoCls ?>"><?= Html::encode($model->getEstadoLabel()) ?></span>
                            v<?= (int) $model->version ?>
                            <?php if (!$model->activo): ?>
                                <span class="badge bg-dark">Inactivo</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Sede</div>
                        <div><?= Html::encode($model->locationSede ? $model->locationSede->nombre : '') ?></div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-muted small">Cliente empresa</div>
                        <div><?= Html::encode($model->empresaCliente ? $model->empresaCliente->nombre : '—') ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Vigencia</div>
                        <div><?= Html::encode($model->fecha_inicio_vigencia) ?> → <?= Html::encode($model->fecha_fin_vigencia) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Observaciones</div>
                        <div><?= nl2br(Html::encode((string) $model->observacion)) ?></div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Aprobación</div>
                        <div>
                            <?php if ($model->aprobado_at): ?>
                                <?= Html::encode($model->aprobado_at) ?>
                                <?php if ($model->aprobadoPor): ?>
                                    — <?= Html::encode($model->aprobadoPor->username ?? '') ?>
                                <?php endif; ?>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="text-muted small">Rechazo</div>
                        <div>
                            <?php if ($model->rechazado_at): ?>
                                <?= Html::encode($model->rechazado_at) ?>
                                <?php if ($model->rechazadoPor): ?>
                                    — <?= Html::encode($model->rechazadoPor->username ?? '') ?>
                                <?php endif; ?>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (Yii::$app->user->can('presupuesto_approve') && $model->estado === Presupuesto::ESTADO_PENDIENTE_APROBACION): ?>
            <div class="card mb-3 border-success">
                <div class="card-header bg-light">Aprobación</div>
                <div class="card-body">
                    <?= Html::beginForm(['approve', 'id' => $model->id], 'post') ?>
                    <div class="mb-2">
                        <label class="form-label">Comentario (opcional)</label>
                        <?= Html::textarea('comentario', '', ['class' => 'form-control', 'rows' => 2]) ?>
                    </div>
                    <?= Html::submitButton('Aprobar', ['class' => 'btn btn-success']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->user->can('presupuesto_reject') && $model->estado === Presupuesto::ESTADO_PENDIENTE_APROBACION): ?>
            <div class="card mb-3 border-danger">
                <div class="card-header bg-light">Rechazo</div>
                <div class="card-body">
                    <?= Html::beginForm(['reject', 'id' => $model->id], 'post') ?>
                    <div class="mb-2">
                        <label class="form-label">Comentario <span class="text-danger">*</span></label>
                        <?= Html::textarea('comentario', '', ['class' => 'form-control', 'rows' => 2, 'required' => true]) ?>
                    </div>
                    <?= Html::submitButton('Rechazar', ['class' => 'btn btn-danger']) ?>
                    <?= Html::endForm() ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (Yii::$app->user->can('presupuesto_reopen') && $model->estado === Presupuesto::ESTADO_RECHAZADO): ?>
            <div class="mb-3">
                <?= Html::beginForm(['reopen', 'id' => $model->id], 'post') ?>
                <?= Html::submitButton('Reabrir como borrador', ['class' => 'btn btn-warning']) ?>
                <?= Html::endForm() ?>
            </div>
        <?php endif; ?>

        <div class="card mb-3">
            <div class="card-header"><h5 class="mb-0">Matriz horas máximas</h5></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Concepto</th>
                                <?php foreach ($dias as $lab): ?>
                                    <th class="text-center"><?= Html::encode($lab) ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($conceptos as $pc): ?>
                                <tr>
                                    <td><?= Html::encode($pc->novedadConcepto ? $pc->novedadConcepto->nombre : $pc->novedad_concepto_id) ?></td>
                                    <?php
                                    $byDay = [];
                                    foreach ($pc->dias as $dia) {
                                        $byDay[(int) $dia->dia_semana] = $dia->horas_maximas;
                                    }
                                    ?>
                                    <?php for ($d = 1; $d <= 7; $d++): ?>
                                        <td class="text-center"><?= Html::encode($byDay[$d] ?? '0') ?></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h5 class="mb-0">Historial</h5></div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Acción</th>
                                <th>Estado</th>
                                <th>Usuario</th>
                                <th>Comentario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model->historiales as $h): ?>
                                <tr>
                                    <td><?= Html::encode($h->created_at) ?></td>
                                    <td><?= Html::encode($h->accion) ?></td>
                                    <td><?= Html::encode(trim(($h->estado_anterior ?? '') . ' → ' . ($h->estado_nuevo ?? ''), '→ ')) ?></td>
                                    <td><?= Html::encode($h->actor ? $h->actor->username : '') ?></td>
                                    <td><?= nl2br(Html::encode((string) $h->comentario)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
