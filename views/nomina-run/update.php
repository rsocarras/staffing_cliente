<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NominaRun $model */

$this->title = 'Update Nomina Run: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nomina Runs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nomina-run-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
