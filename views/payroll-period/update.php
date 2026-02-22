<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PayrollPeriod $model */

$this->title = 'Update Payroll Period: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payroll Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payroll-period-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
