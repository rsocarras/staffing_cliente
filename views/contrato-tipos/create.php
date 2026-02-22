<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContratoTipos $model */

$this->title = 'Create Contrato Tipos';
$this->params['breadcrumbs'][] = ['label' => 'Contrato Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-tipos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
