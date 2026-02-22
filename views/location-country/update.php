<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocationCountry $model */

$this->title = 'Update Location Country: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Location Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
