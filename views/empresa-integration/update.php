<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EmpresaIntegration $model */

$this->title = 'Update Empresa Integration: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Empresa Integrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empresa-integration-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
