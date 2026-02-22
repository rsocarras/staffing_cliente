<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlanillaError $model */

$this->title = 'Create Planilla Error';
$this->params['breadcrumbs'][] = ['label' => 'Planilla Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilla-error-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
