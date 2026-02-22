<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ArchivoLink $model */

$this->title = 'Create Archivo Link';
$this->params['breadcrumbs'][] = ['label' => 'Archivo Links', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivo-link-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
