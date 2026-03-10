<?php

use yii\helpers\Html;

/** @var app\models\Contrato $model */
/** @var array $scope */

$this->title = 'Contrato #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
            <div class="flex-grow-1">
                <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                <p class="mb-0 text-muted"><?= Html::encode($model->getProfileDisplayName()) ?></p>
            </div>
            <div class="d-flex gap-2">
                <?php if (empty($scope['readonly'])): ?>
                    <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
                <?= Html::a('Volver', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Detalle contractual</h5></div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Empleado</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->getProfileDisplayName()) ?></dd>
                            <dt class="col-sm-4">Tipo contrato</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->contratoTipo ? $model->contratoTipo->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Estado</dt>
                            <dd class="col-sm-8"><span class="badge badge-soft-<?= Html::encode($model->getEstadoBadgeClass()) ?>"><?= Html::encode($model->getDisplayEstado()) ?></span></dd>
                            <dt class="col-sm-4">Vigencia</dt>
                            <dd class="col-sm-8"><span class="badge badge-soft-<?= $model->isCurrentByDate() ? 'success' : 'secondary' ?>"><?= Html::encode($model->getVigenciaLabel()) ?></span></dd>
                            <dt class="col-sm-4">Ocupa planta</dt>
                            <dd class="col-sm-8"><span class="badge badge-soft-<?= $model->isOccupyingPlanta() ? 'success' : 'secondary' ?>"><?= $model->isOccupyingPlanta() ? 'Si' : 'No' ?></span></dd>
                            <dt class="col-sm-4">Sede principal</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->sede ? $model->sede->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Area</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->area ? $model->area->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Subarea</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->subArea ? $model->subArea->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Cargo</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->cargo ? $model->cargo->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Fecha inicio</dt>
                            <dd class="col-sm-8"><?= Yii::$app->formatter->asDate($model->fecha_inicio) ?></dd>
                            <dt class="col-sm-4">Fecha fin</dt>
                            <dd class="col-sm-8"><?= $model->fecha_fin ? Yii::$app->formatter->asDate($model->fecha_fin) : '-' ?></dd>
                            <dt class="col-sm-4">Creado por</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->createdBy ? $model->createdBy->username : '-') ?></dd>
                            <dt class="col-sm-4">Actualizado por</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->updatedBy ? $model->updatedBy->username : '-') ?></dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Distribucion por sedes</h5></div>
                    <div class="card-body">
                        <?php if (empty($model->contratoDistribucionSedes)): ?>
                            <div class="alert alert-info mb-0">
                                El contrato no tiene distribucion registrada. Cuenta al 100% en la sede principal.
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Sede</th>
                                            <th class="text-end">Porcentaje</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($model->contratoDistribucionSedes as $distribution): ?>
                                            <tr>
                                                <td><?= Html::encode($distribution->sede ? $distribution->sede->nombre : '-') ?></td>
                                                <td class="text-end"><?= Yii::$app->formatter->asDecimal($distribution->porcentaje, 2) ?>%</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>
