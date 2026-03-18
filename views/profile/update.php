<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = 'Editar perfil: ' . ($model->name ?: 'Mi perfil');
$this->params['breadcrumbs'][] = ['label' => 'Mi perfil', 'url' => ['view']];
$this->params['breadcrumbs'][] = 'Editar';
?>
<div class="profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
