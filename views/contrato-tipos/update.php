<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContratoTipos $model */

$this->title = 'Update Contrato Tipos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contrato Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contrato-tipos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
