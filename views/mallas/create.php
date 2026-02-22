<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Mallas $model */

$this->title = 'Create Mallas';
$this->params['breadcrumbs'][] = ['label' => 'Mallas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mallas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
