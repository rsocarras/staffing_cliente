<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipoCampoOpcion $model */

$this->title = 'Update Novedad Tipo Campo Opcion: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Novedad Tipo Campo Opcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="novedad-tipo-campo-opcion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
