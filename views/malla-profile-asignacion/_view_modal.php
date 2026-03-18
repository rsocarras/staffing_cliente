<?php
use app\models\MallaProfileAsignacion;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var MallaProfileAsignacion $model */
?>

<?php
$estado = $model->displayEstadoAprobacion();
$actualLabel = (int) $model->es_actual === 1 ? 'Sí' : 'No';
$empleado = $model->profile ? ($model->profile->name ?: '-') : ($model->profile_id ?? '-');
$malla = $model->malla ? ($model->malla->nombre ?: '-') : ($model->malla_id ?? '-');
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-user me-2 text-primary"></i>
            <?= Html::encode('Asignación malla por empleado') ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-hash small"></i></span>
                    <div>
                        <small class="text-muted d-block">ID</small>
                        <span class="fw-medium"><?= Html::encode((string) $model->id) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-status-question small"></i></span>
                    <div>
                        <small class="text-muted d-block">Estado</small>
                        <span class="fw-medium"><?= Html::encode((string) $estado) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-user small"></i></span>
                    <div>
                        <small class="text-muted d-block">Empleado</small>
                        <span class="fw-medium"><?= Html::encode((string) $empleado) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-layout-grid small"></i></span>
                    <div>
                        <small class="text-muted d-block">Malla</small>
                        <span class="fw-medium"><?= Html::encode((string) $malla) ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-circle-check small"></i></span>
                    <div>
                        <small class="text-muted d-block">Actual</small>
                        <span class="fw-medium"><?= Html::encode((string) $actualLabel) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

