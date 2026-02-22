<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CompanySetting $model */

$this->title = 'Create Company Setting';
$this->params['breadcrumbs'][] = ['label' => 'Company Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-setting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
