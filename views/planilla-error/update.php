<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlanillaError $model */

$this->title = 'Update Planilla Error: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Planilla Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="planilla-error-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
