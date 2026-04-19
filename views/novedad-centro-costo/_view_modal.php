<?php

use yii\helpers\Html;

/** @var app\models\NovedadCentroCosto $model */

$sedeNombre = $model->locationSede
    ? (trim((string) ($model->locationSede->nombre ?? '')) ?: ('#' . $model->locationSede->id))
    : '—';
$ecNombre = $model->empresaCliente
    ? (trim((string) ($model->empresaCliente->nombre ?? '')) ?: ('#' . $model->empresaCliente->id))
    : '—';
?>

<div class="p-4">
    <div class="rounded-3 border bg-light p-3 mb-3">
        <div class="row g-2">
            <div class="col-sm-4 text-muted small"><?= Html::encode($model->getAttributeLabel('empresa_cliente_id')) ?></div>
            <div class="col-sm-8 fw-medium"><?= Html::encode($ecNombre) ?></div>
            <div class="col-sm-4 text-muted small"><?= Html::encode($model->getAttributeLabel('location_sede_id')) ?></div>
            <div class="col-sm-8 fw-medium"><?= Html::encode($sedeNombre) ?></div>
            <div class="col-sm-4 text-muted small"><?= Html::encode($model->getAttributeLabel('codigo')) ?></div>
            <div class="col-sm-8"><?= Html::encode($model->codigo ?? '—') ?></div>
            <div class="col-sm-4 text-muted small"><?= Html::encode($model->getAttributeLabel('nombre')) ?></div>
            <div class="col-sm-8 fw-semibold"><?= Html::encode($model->nombre) ?></div>
            <div class="col-sm-4 text-muted small"><?= Html::encode($model->getAttributeLabel('activo')) ?></div>
            <div class="col-sm-8"><?= $model->activo ? Yii::t('app', 'Sí') : Yii::t('app', 'No') ?></div>
        </div>
    </div>
</div>
