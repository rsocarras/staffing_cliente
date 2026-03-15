<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MallaProfileAsignacion $model */

$this->title = 'Actualizar asignación malla-empleado';
$this->params['breadcrumbs'][] = ['label' => 'Asignación malla por empleado', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="malla-profile-asignacion-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
