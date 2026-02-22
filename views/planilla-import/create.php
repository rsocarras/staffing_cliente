<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PlanillaImport $model */

$this->title = 'Create Planilla Import';
$this->params['breadcrumbs'][] = ['label' => 'Planilla Imports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="planilla-import-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
