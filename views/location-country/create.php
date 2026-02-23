<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\LocationCountry $model */

$this->title = Yii::t('app', 'Create Location Country');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Location Countries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-country-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
