<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\NovedadOpcionesDependientes $model */

$this->title = 'Create Novedad Opciones Dependientes';
$this->params['breadcrumbs'][] = ['label' => 'Novedad Opciones Dependientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-opciones-dependientes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
