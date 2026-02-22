<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MaestrosConceptos $model */

$this->title = 'Create Maestros Conceptos';
$this->params['breadcrumbs'][] = ['label' => 'Maestros Conceptos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maestros-conceptos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
