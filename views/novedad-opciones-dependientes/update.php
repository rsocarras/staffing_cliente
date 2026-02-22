<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadOpcionesDependientes $model */

$this->title = 'Update Novedad Opciones Dependientes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Novedad Opciones Dependientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="novedad-opciones-dependientes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
