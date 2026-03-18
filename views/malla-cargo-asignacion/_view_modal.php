<?php
use app\models\MallaCargoAsignacion;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var MallaCargoAsignacion $model */
?>

<?php
$cargo = $model->cargo ? $model->cargo->nombre : ($model->cargo_id ?? '-');
$malla = $model->malla ? $model->malla->nombre : ($model->malla_id ?? '-');
$estado = $model->displayEstadoAprobacion();
?>

<div class="card border-0 shadow-sm mb-0">
    <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
        <h6 class="mb-0 fw-semibold">
            <i class="ti ti-layout-grid me-2 text-primary"></i>
            <?= Html::encode('Asignación malla por cargo') ?>
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

            <div class="col-md-12">
                <div class="d-flex align-items-start">
                    <span class="badge bg-light text-dark me-2 px-2 py-1"><i class="ti ti-briefcase small"></i></span>
                    <div>
                        <small class="text-muted d-block">Cargo / Malla</small>
                        <span class="fw-medium"><?= Html::encode((string) $cargo) ?> / <?= Html::encode((string) $malla) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

