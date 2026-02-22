<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EmpleadoVenueHistory $model */

$this->title = 'Update Empleado Venue History: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Empleado Venue Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empleado-venue-history-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
