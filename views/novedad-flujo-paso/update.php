<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadFlujoPaso $model */

$this->title = 'Update Novedad Flujo Paso: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Novedad Flujo Pasos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="novedad-flujo-paso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
