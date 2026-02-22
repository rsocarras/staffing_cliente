<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CompanySetting $model */

$this->title = 'Update Company Setting: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-setting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
