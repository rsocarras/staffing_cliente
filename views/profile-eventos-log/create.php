<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProfileEventosLog $model */

$this->title = 'Create Profile Eventos Log';
$this->params['breadcrumbs'][] = ['label' => 'Profile Eventos Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-eventos-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
