<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EmpresaWebhook $model */

$this->title = 'Create Empresa Webhook';
$this->params['breadcrumbs'][] = ['label' => 'Empresa Webhooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresa-webhook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
