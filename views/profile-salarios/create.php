<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProfileSalarios $model */

$this->title = 'Create Profile Salarios';
$this->params['breadcrumbs'][] = ['label' => 'Profile Salarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-salarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
