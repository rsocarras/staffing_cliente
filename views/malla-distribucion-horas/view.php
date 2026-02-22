<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\MallaDistribucionHoras $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Malla Distribucion Horas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="malla-distribucion-horas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'empresa_id',
            'payroll_period_id',
            'profile_id',
            'sede_id',
            'cargo_id',
            'centro_costo_id',
            'centro_utilidad_id',
            'fecha',
            'horas',
            'created_by',
            'created_at',
        ],
    ]) ?>

</div>
