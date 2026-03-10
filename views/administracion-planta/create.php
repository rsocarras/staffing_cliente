<?php

use yii\helpers\Html;

/** @var app\models\StaffingPlanta $model */
/** @var array $sedes */
/** @var array $areas */
/** @var array $subAreas */
/** @var array $cargos */
/** @var string $activeTab */
?>

<?php
$this->title = 'Nueva planta autorizada';
$this->params['breadcrumbs'][] = ['label' => 'Administración de planta', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
            <div class="flex-grow-1">
                <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
            </div>
        </div>

        <?= $this->render('_tabs', ['activeTab' => $activeTab]) ?>
        <?= $this->render('_form', ['model' => $model, 'sedes' => $sedes, 'areas' => $areas, 'subAreas' => $subAreas, 'cargos' => $cargos]) ?>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>
