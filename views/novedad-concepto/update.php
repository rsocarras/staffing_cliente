<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadConcepto $model */

$this->title = 'Update Novedad Concepto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Novedad Conceptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="novedad-concepto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
