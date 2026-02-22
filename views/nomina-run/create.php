<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NominaRun $model */

$this->title = 'Create Nomina Run';
$this->params['breadcrumbs'][] = ['label' => 'Nomina Runs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomina-run-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
