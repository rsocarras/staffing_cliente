<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NominaRetencionImpuesto $model */

$this->title = 'Create Nomina Retencion Impuesto';
$this->params['breadcrumbs'][] = ['label' => 'Nomina Retencion Impuestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomina-retencion-impuesto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
