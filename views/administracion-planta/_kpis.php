<?php

use yii\helpers\Html;

/** @var array $kpis */
?>

<div class="row row-gap-4 mb-4">
    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
        <div class="card mb-0 flex-fill">
            <div class="card-body">
                <p class="mb-1 text-muted">Planta total</p>
                <h4 class="mb-0 fw-bold"><?= Yii::$app->formatter->asDecimal($kpis['planta_total'], 2) ?></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
        <div class="card mb-0 flex-fill">
            <div class="card-body">
                <p class="mb-1 text-muted">Ocupados</p>
                <h4 class="mb-0 fw-bold"><?= Yii::$app->formatter->asDecimal($kpis['ocupados_total'], 2) ?></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
        <div class="card mb-0 flex-fill">
            <div class="card-body">
                <p class="mb-1 text-muted">Vacantes</p>
                <h4 class="mb-0 fw-bold <?= $kpis['vacantes_total'] < 0 ? 'text-danger' : 'text-warning' ?>">
                    <?= Yii::$app->formatter->asDecimal($kpis['vacantes_total'], 2) ?>
                </h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
        <div class="card mb-0 flex-fill">
            <div class="card-body">
                <p class="mb-1 text-muted">% cobertura</p>
                <h4 class="mb-0 fw-bold"><?= Yii::$app->formatter->asDecimal($kpis['cobertura_total'], 2) ?>%</h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
        <div class="card mb-0 flex-fill">
            <div class="card-body">
                <p class="mb-1 text-muted">Sobredotación total</p>
                <h4 class="mb-0 fw-bold text-danger"><?= Yii::$app->formatter->asDecimal($kpis['sobredotacion_total'], 2) ?></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
        <div class="card mb-0 flex-fill">
            <div class="card-body">
                <p class="mb-1 text-muted">Sedes con vacantes</p>
                <h4 class="mb-0 fw-bold text-warning"><?= (int) $kpis['sedes_con_vacantes'] ?></h4>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
        <div class="card mb-0 flex-fill">
            <div class="card-body">
                <p class="mb-1 text-muted">Sedes sobredotadas</p>
                <h4 class="mb-0 fw-bold text-danger"><?= (int) $kpis['sedes_sobredotadas'] ?></h4>
            </div>
        </div>
    </div>
</div>
