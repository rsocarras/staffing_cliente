<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProfileSalarios $model */

$this->title = 'Update Profile Salarios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Profile Salarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profile-salarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
