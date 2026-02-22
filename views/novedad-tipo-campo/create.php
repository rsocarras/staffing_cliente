<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadTipoCampo $model */

$this->title = 'Create Novedad Tipo Campo';
$this->params['breadcrumbs'][] = ['label' => 'Novedad Tipo Campos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-tipo-campo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
