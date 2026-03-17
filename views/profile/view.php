<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */
/** @var array $weekSchedule */
/** @var string $anchorDate */

$this->title = $model->name ?: ('Empleado #' . $model->user_id);
$this->params['breadcrumbs'][] = ['label' => 'Empleados / colaboradores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
            <div class="flex-grow-1">
                <h4 class="mb-0"><?= Html::encode($this->title) ?></h4>
                <div class="text-muted small">
                    <?= Html::encode($model->displayTipoDoc()) ?> <?= Html::encode($model->num_doc) ?>
                </div>
            </div>
            <div class="text-end">
                <?= Html::a('<i class="ti ti-arrow-left me-1"></i> Volver al listado', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Datos básicos</h5>
                    </div>
                    <div class="card-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table table-striped table-bordered detail-view mb-0'],
                            'attributes' => [
                                'user_id',
                                [
                                    'label' => 'Documento',
                                    'value' => trim(($model->displayTipoDoc() ?: '-') . ' ' . ($model->num_doc ?: '')),
                                ],
                                [
                                    'attribute' => 'name',
                                    'label' => 'Nombre',
                                    'value' => $model->name ?: '-',
                                ],
                                [
                                    'attribute' => 'public_email',
                                    'label' => 'Correo',
                                    'format' => 'email',
                                    'value' => $model->public_email ?: null,
                                ],
                                [
                                    'attribute' => 'telefono',
                                    'label' => 'Teléfono',
                                    'value' => $model->telefono ?: '-',
                                ],
                                [
                                    'attribute' => 'sexo',
                                    'label' => 'Sexo',
                                    'value' => $model->sexo ? $model->displaySexo() : '-',
                                ],
                                [
                                    'attribute' => 'birthday',
                                    'label' => 'Fecha de nacimiento',
                                    'value' => $model->birthday ?: '-',
                                ],
                                [
                                    'attribute' => 'estado',
                                    'label' => 'Estado',
                                    'value' => $model->displayEstado(),
                                ],
                                [
                                    'attribute' => 'position',
                                    'label' => 'Posición',
                                    'value' => $model->position ?: '-',
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Información organizacional</h5>
                    </div>
                    <div class="card-body">
                        <?= DetailView::widget([
                            'model' => $model,
                            'options' => ['class' => 'table table-striped table-bordered detail-view mb-0'],
                            'attributes' => [
                                [
                                    'label' => 'Empresa',
                                    'value' => $model->empresas->name ?? '-',
                                ],
                                [
                                    'label' => 'Sede',
                                    'value' => $model->sede->nombre ?? '-',
                                ],
                                [
                                    'label' => 'Área',
                                    'value' => $model->area->nombre ?? '-',
                                ],
                                [
                                    'label' => 'Cargo',
                                    'value' => $model->cargo->nombre ?? '-',
                                ],
                                [
                                    'label' => 'Centro de costo',
                                    'value' => $model->centroCosto->nombre ?? $model->centro_costo_id ?? '-',
                                ],
                                [
                                    'label' => 'Centro de utilidad',
                                    'value' => $model->centroUtilidad->nombre ?? $model->centro_utilidad_id ?? '-',
                                ],
                                [
                                    'attribute' => 'city',
                                    'label' => 'Ciudad',
                                    'value' => $model->city ?: '-',
                                ],
                                [
                                    'attribute' => 'address',
                                    'label' => 'Dirección',
                                    'value' => $model->address ?: '-',
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header d-flex flex-wrap justify-content-between gap-2 align-items-center">
                <div>
                    <h5 class="card-title mb-0">Malla semanal</h5>
                    <?php if (!empty($weekSchedule['malla'])): ?>
                        <div class="small text-muted">
                            <?= Html::encode($weekSchedule['malla']->nombre) ?> · origen <?= Html::encode($weekSchedule['source']) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <form method="get" action="<?= Url::to(['profile/view', 'user_id' => $model->user_id]) ?>" class="d-flex align-items-center gap-2">
                    <label for="week-date" class="mb-0">Semana de:</label>
                    <input id="week-date" type="date" name="date" class="form-control" value="<?= Html::encode($anchorDate) ?>">
                    <button type="submit" class="btn btn-primary">Ver</button>
                </form>
            </div>
            <div class="card-body">
                <?php if (empty($weekSchedule['malla'])): ?>
                    <div class="alert alert-warning mb-0">Sin malla asignada.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead>
                                <tr>
                                    <?php foreach ($weekSchedule['dates'] as $date): ?>
                                        <th><?= Html::encode(date('D d M', strtotime($date))) ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php foreach ($weekSchedule['dates'] as $date): ?>
                                        <?php $day = $weekSchedule['days'][$date] ?? ['segments' => [], 'total_minutes' => 0]; ?>
                                        <td>
                                            <?php if (empty($day['segments'])): ?>
                                                <span class="text-muted">Sin turno</span>
                                            <?php else: ?>
                                                <?php foreach ($day['segments'] as $segment): ?>
                                                    <div>
                                                        <?= Html::encode(sprintf('%02d:%02d', intdiv($segment['start'], 60), $segment['start'] % 60)) ?>
                                                        -
                                                        <?= Html::encode(sprintf('%02d:%02d', intdiv($segment['end'], 60), $segment['end'] % 60)) ?>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>
