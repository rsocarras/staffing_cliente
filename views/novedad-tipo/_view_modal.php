<?php
use app\models\NovedadTipo;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipo $model */
?>

<?php
$descripcion = $model->descripcion ?: '-';
$icono = $model->icono ?: '-';
$orden = $model->orden !== null ? (string) $model->orden : '-';
$nombre = $model->nombre ?: '-';
$activoBadge = $model->activo ? '<span class="badge badge-soft-success">Sí</span>' : '<span class="badge badge-soft-danger">No</span>';
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-bell me-2 text-primary"></i>
            <?= Html::encode('Tipo de Novedad') ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-hash small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">ID</small>
                        <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-tag small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Nombre</small>
                        <span class="fw-medium"><?= Html::encode((string) $nombre) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-notes small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Descripción</small>
                        <span class="fw-medium"><?= Html::encode((string) $descripcion) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-link-2 small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Icono</small>
                        <span class="fw-medium"><?= Html::encode((string) $icono) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-sort-numeric-down small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Orden</small>
                        <span class="fw-medium"><?= Html::encode((string) $orden) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1">
                        <i class="ti ti-circle-check small"></i>
                    </span>
                    <div>
                        <small class="text-muted d-block">Activo</small>
                        <span class="fw-medium"><?= $activoBadge ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

