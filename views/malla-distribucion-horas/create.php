<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MallaDistribucionHoras $model */

$this->title = 'Create Malla Distribucion Horas';
$this->params['breadcrumbs'][] = ['label' => 'Malla Distribucion Horas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="malla-distribucion-horas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
