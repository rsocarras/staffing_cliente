<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Novedad $model */

$this->title = 'Create Novedad';
$this->params['breadcrumbs'][] = ['label' => 'Novedads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
