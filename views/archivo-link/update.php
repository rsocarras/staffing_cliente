<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ArchivoLink $model */

$this->title = 'Update Archivo Link: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Archivo Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="archivo-link-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
