<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ContabilidadCentroUtilidad $model */

$this->title = 'Create Contabilidad Centro Utilidad';
$this->params['breadcrumbs'][] = ['label' => 'Contabilidad Centro Utilidads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contabilidad-centro-utilidad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
