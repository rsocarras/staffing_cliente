<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MallasHorarios $model */

$this->title = 'Update Mallas Horarios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mallas Horarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mallas-horarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
