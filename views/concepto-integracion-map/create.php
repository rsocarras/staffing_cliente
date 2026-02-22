<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ConceptoIntegracionMap $model */

$this->title = 'Create Concepto Integracion Map';
$this->params['breadcrumbs'][] = ['label' => 'Concepto Integracion Maps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concepto-integracion-map-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
