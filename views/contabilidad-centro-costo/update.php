<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContabilidadCentroCosto $model */

$this->title = 'Update Contabilidad Centro Costo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contabilidad Centro Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contabilidad-centro-costo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
