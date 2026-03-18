<?php

use yii\helpers\Html;

/** @var app\models\Contrato $model */
/** @var array $scope */
?>

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
    <dd class="col-sm-8"><span class="badge badge-soft-<?= $model->isOccupyingPlanta() ? 'success' : 'secondary' ?>"><?= $model->isOccupyingPlanta() ? 'Sí' : 'No' ?></span></dd>
    <dt class="col-sm-4">Sede principal</dt>
    <dd class="col-sm-8"><?= Html::encode($model->sede ? $model->sede->nombre : '-') ?></dd>
    <dt class="col-sm-4">Área</dt>
    <dd class="col-sm-8"><?= Html::encode($model->area ? $model->area->nombre : '-') ?></dd>
    <dt class="col-sm-4">Subárea</dt>
    <dd class="col-sm-8"><?= Html::encode($model->subArea ? $model->subArea->nombre : '-') ?></dd>
    <dt class="col-sm-4">Cargo</dt>
    <dd class="col-sm-8"><?= Html::encode($model->cargo ? $model->cargo->nombre : '-') ?></dd>
    <dt class="col-sm-4">Fecha inicio</dt>
    <dd class="col-sm-8"><?= Yii::$app->formatter->asDate($model->fecha_inicio) ?></dd>
    <dt class="col-sm-4">Fecha fin</dt>
    <dd class="col-sm-8"><?= $model->fecha_fin ? Yii::$app->formatter->asDate($model->fecha_fin) : '-' ?></dd>
    <dt class="col-sm-4">Distribución sedes</dt>
    <dd class="col-sm-8">
        <?php if (empty($model->contratoDistribucionSedes)): ?>
            <span class="text-muted">Principal 100%</span>
        <?php else: ?>
            <?php foreach ($model->contratoDistribucionSedes as $d): ?>
                <?= Html::encode($d->sede ? $d->sede->nombre : '-') ?>: <?= Yii::$app->formatter->asDecimal($d->porcentaje, 2) ?>%<br>
            <?php endforeach; ?>
        <?php endif; ?>
    </dd>
</dl>
