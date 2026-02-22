<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocationSedes $model */

$this->title = 'Create Location Sedes';
$this->params['breadcrumbs'][] = ['label' => 'Location Sedes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-sedes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
