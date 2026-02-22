<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Archivos $model */

$this->title = 'Create Archivos';
$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
