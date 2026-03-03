<?php

use yii\helpers\Html;

$this->title = 'Reportes RRHH';
$this->params['breadcrumbs'][] = ['label' => 'Requisiciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
    <div class="content pb-0">
        <h4 class="mb-3"><?= Html::encode($this->title) ?></h4>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Nuevas contrataciones</h5>
                        <p class="card-text">Listado de contrataciones activadas por rango de fechas.</p>
                        <?= Html::a('Ver reporte', ['nuevas-contrataciones'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Activos por mes</h5>
                        <p class="card-text">Personas activadas agrupadas por mes de fecha de ingreso.</p>
                        <?= Html::a('Ver reporte', ['activos-por-mes'], ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
