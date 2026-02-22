<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContabilidadCentroCosto $model */

$this->title = 'Create Contabilidad Centro Costo';
$this->params['breadcrumbs'][] = ['label' => 'Contabilidad Centro Costos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contabilidad-centro-costo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
