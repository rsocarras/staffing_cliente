<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NominaRetencionImpuesto $model */

$this->title = 'Update Nomina Retencion Impuesto: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Nomina Retencion Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="nomina-retencion-impuesto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
