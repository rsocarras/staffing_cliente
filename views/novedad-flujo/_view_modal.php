<?php

use app\models\NovedadFlujo;
use yii\helpers\Html;

/** @var app\models\NovedadFlujo $model */

$estados = NovedadFlujo::estadoLista();
$estadoTexto = $estados[$model->estado] ?? $model->estado;
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-git-branch me-2 text-primary"></i>
            <?= Html::encode('Flujo de novedad') ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <small class="text-muted d-block">ID</small>
                <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block">Estado</small>
                <span class="fw-medium"><?= Html::encode($estadoTexto) ?></span>
            </div>
            <div class="col-12">
                <small class="text-muted d-block">Nombre</small>
                <span class="fw-medium"><?= Html::encode($model->nombre) ?></span>
            </div>
            <div class="col-12">
                <small class="text-muted d-block">Descripción</small>
                <span class="fw-medium"><?= Html::encode($model->descripcion ?: '—') ?></span>
            </div>
        </div>
    </div>
</div>
