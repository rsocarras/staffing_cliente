<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MallaDistribucionHoras $model */

$this->title = 'Update Malla Distribucion Horas: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Malla Distribucion Horas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="malla-distribucion-horas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
