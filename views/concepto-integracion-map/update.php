<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ConceptoIntegracionMap $model */

$this->title = 'Update Concepto Integracion Map: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Concepto Integracion Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="concepto-integracion-map-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
