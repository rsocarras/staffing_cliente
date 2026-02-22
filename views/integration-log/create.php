<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\IntegrationLog $model */

$this->title = 'Create Integration Log';
$this->params['breadcrumbs'][] = ['label' => 'Integration Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="integration-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
