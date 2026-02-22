<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadConcepto $model */

$this->title = 'Create Novedad Concepto';
$this->params['breadcrumbs'][] = ['label' => 'Novedad Conceptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-concepto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
