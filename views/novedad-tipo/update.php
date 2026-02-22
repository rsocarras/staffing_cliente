<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipo $model */

$this->title = 'Update Novedad Tipo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Novedad Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="novedad-tipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
