<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EmpresaIntegration $model */

$this->title = 'Create Empresa Integration';
$this->params['breadcrumbs'][] = ['label' => 'Empresa Integrations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-integration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
