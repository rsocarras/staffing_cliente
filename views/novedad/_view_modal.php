<?php

use app\models\Novedad;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */

$conceptoNombre = $model->concepto ? $model->concepto->nombre : ('#' . $model->concepto_id);
$tipoNombre = $model->novedadTipo ? $model->novedadTipo->nombre : ('#' . $model->novedad_tipo_id);
$flujoNombre = '-';
if (Novedad::hasNovedadFlujoIdColumn() && $model->novedadFlujo) {
    $flujoNombre = $model->novedadFlujo->nombre;
}
$pasoNombre = '-';
if ($model->pasoActual) {
    $pasoNombre = $model->pasoActual->nombre ?: $model->pasoActual->codigo;
}
$datosPreview = $model->datos;
if (strlen($datosPreview) > 500) {
    $datosPreview = substr($datosPreview, 0, 500) . '…';
}
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-bell me-2 text-primary"></i>
            <?= Html::encode('Novedad') ?>
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
                <span class="fw-medium"><?= Html::encode($model->displayEstado()) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block">Concepto</small>
                <span class="fw-medium"><?= Html::encode($conceptoNombre) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block">Tipo</small>
                <span class="fw-medium"><?= Html::encode($tipoNombre) ?></span>
            </div>
            <?php if (Novedad::hasNovedadFlujoIdColumn()): ?>
            <div class="col-md-6">
                <small class="text-muted d-block">Flujo</small>
                <span class="fw-medium"><?= Html::encode($flujoNombre) ?></span>
            </div>
            <div class="col-md-6">
                <small class="text-muted d-block">Paso actual</small>
                <span class="fw-medium"><?= Html::encode($pasoNombre) ?></span>
            </div>
            <?php endif; ?>
            <div class="col-12">
                <small class="text-muted d-block">Datos (JSON)</small>
                <pre class="small bg-light border rounded p-2 mb-0 font-monospace" style="max-height:200px;overflow:auto;"><?= Html::encode($datosPreview) ?></pre>
            </div>
        </div>
    </div>
</div>
