<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MallasHorarios $model */

$this->title = 'Create Mallas Horarios';
$this->params['breadcrumbs'][] = ['label' => 'Mallas Horarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mallas-horarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
