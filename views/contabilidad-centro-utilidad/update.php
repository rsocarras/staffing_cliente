<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContabilidadCentroUtilidad $model */

$this->title = 'Update Contabilidad Centro Utilidad: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contabilidad Centro Utilidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contabilidad-centro-utilidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
