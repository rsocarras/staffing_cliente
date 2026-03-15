<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MallaProfileAsignacion $model */

$this->title = 'Crear asignación malla-empleado';
$this->params['breadcrumbs'][] = ['label' => 'Asignación malla por empleado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malla-profile-asignacion-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
