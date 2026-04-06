<?php

use Yii;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Setting $model */

$this->title = Yii::t('app', 'Nuevo parámetro laboral');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Parámetros laborales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
