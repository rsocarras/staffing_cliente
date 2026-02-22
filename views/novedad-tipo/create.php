<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipo $model */

$this->title = 'Create Novedad Tipo';
$this->params['breadcrumbs'][] = ['label' => 'Novedad Tipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-tipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
