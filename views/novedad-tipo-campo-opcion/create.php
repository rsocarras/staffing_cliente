<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipoCampoOpcion $model */

$this->title = 'Create Novedad Tipo Campo Opcion';
$this->params['breadcrumbs'][] = ['label' => 'Novedad Tipo Campo Opcions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-tipo-campo-opcion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
