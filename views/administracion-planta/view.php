<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\StaffingPlanta $model */
/** @var string $activeTab */
?>

<?php
$this->title = 'Detalle de planta';
$this->params['breadcrumbs'][] = ['label' => 'Administración de planta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
            <div class="flex-grow-1">
                <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                <p class="mb-0 text-muted"><?= Html::encode($model->getDimensionLabel()) ?></p>
            </div>
            <div class="d-flex gap-2">
                <?php if (Yii::$app->user->can('administracion_planta_manage') || Yii::$app->user->can('admin') || Yii::$app->user->can('administrator')): ?>
                    <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
                <?= Html::a('Volver', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>

        <?= $this->render('_tabs', ['activeTab' => $activeTab]) ?>

        <div class="row g-4">
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Registro maestro</h5></div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Empresa</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->empresa ? $model->empresa->name : '-') ?></dd>
                            <dt class="col-sm-4">Sede</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->locationSede ? $model->locationSede->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Tipo sede</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->locationSede ? $model->locationSede->getTipoSedeLabel() : '-') ?></dd>
                            <dt class="col-sm-4">Área</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->area ? $model->area->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Subárea</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->subArea ? $model->subArea->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Cargo</dt>
                            <dd class="col-sm-8"><?= Html::encode($model->cargo ? $model->cargo->nombre : '-') ?></dd>
                            <dt class="col-sm-4">Planta</dt>
                            <dd class="col-sm-8"><?= Yii::$app->formatter->asDecimal($model->cantidad_autorizada, 2) ?></dd>
                            <dt class="col-sm-4">Estado</dt>
                            <dd class="col-sm-8"><?= (int) $model->activo === 1 ? 'Activo' : 'Inactivo' ?></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Historial</h5></div>
                    <div class="card-body">
                        <?php if (empty($model->historiales)): ?>
                            <p class="text-muted mb-0">No hay movimientos registrados.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Acción</th>
                                            <th>Campo</th>
                                            <th>Valor anterior</th>
                                            <th>Valor nuevo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($model->historiales as $historial): ?>
                                        <tr>
                                            <td><?= Yii::$app->formatter->asDatetime($historial->created_at) ?></td>
                                            <td><?= Html::encode($historial->accion) ?></td>
                                            <td><?= Html::encode($historial->campo) ?></td>
                                            <td><?= Html::encode($historial->valor_anterior ?: '-') ?></td>
                                            <td><?= Html::encode($historial->valor_nuevo ?: '-') ?></td>
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
