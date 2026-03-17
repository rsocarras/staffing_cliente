<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MallaCargoAsignacion $model */

$this->title = 'Actualizar asignación malla-cargo';
$this->params['breadcrumbs'][] = ['label' => 'Asignación malla por cargo', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="malla-cargo-asignacion-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
