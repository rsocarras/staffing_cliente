<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MallaCargoAsignacion $model */

$this->title = 'Crear asignación malla-cargo';
$this->params['breadcrumbs'][] = ['label' => 'Asignación malla por cargo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malla-cargo-asignacion-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', ['model' => $model]) ?>
</div>
