<?php

use yii\helpers\Html;

/** @var app\models\Contrato $model */
/** @var array $distributionRows */
/** @var array $options */

$this->title = 'Nuevo contrato';
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-wrapper">
    <div class="content">
        <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
            <div class="flex-grow-1">
                <h4 class="fs-20 fw-bold mb-0"><?= Html::encode($this->title) ?></h4>
                <p class="mb-0 text-muted">Cree el contrato base y, si aplica, distribuya su ocupacion entre sedes.</p>
            </div>
        </div>

        <?= $this->render('_form', [
            'model' => $model,
            'distributionRows' => $distributionRows,
            'options' => $options,
        ]) ?>
    </div>
    <?= $this->render('//layouts/partials/footer') ?>
</div>
