<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlanillaTemplate $model */

$this->title = 'Create Planilla Template';
$this->params['breadcrumbs'][] = ['label' => 'Planilla Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilla-template-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
