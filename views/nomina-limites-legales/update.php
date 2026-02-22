<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NominaLimitesLegales $model */

$this->title = 'Update Nomina Limites Legales: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nomina Limites Legales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nomina-limites-legales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
