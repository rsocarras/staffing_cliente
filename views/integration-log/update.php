<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\IntegrationLog $model */

$this->title = 'Update Integration Log: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Integration Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="integration-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
