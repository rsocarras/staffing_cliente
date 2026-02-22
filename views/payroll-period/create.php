<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PayrollPeriod $model */

$this->title = 'Create Payroll Period';
$this->params['breadcrumbs'][] = ['label' => 'Payroll Periods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payroll-period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
