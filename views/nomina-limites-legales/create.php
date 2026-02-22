<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NominaLimitesLegales $model */

$this->title = 'Create Nomina Limites Legales';
$this->params['breadcrumbs'][] = ['label' => 'Nomina Limites Legales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nomina-limites-legales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
