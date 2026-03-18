<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EmpleadoVenueHistory $model */

$this->title = 'Create Empleado Venue History';
$this->params['breadcrumbs'][] = ['label' => 'Empleado Venue Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleado-venue-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
