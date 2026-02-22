<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\EmpleadoVenueHistory $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Empleado Venue Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empleado-venue-history-view">

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
            'profile_id',
            'fecha_efectiva',
            'sede_id',
            'centro_costo_id',
            'centro_utilidad_id',
            'motivo',
            'actor_user_id',
            'created_at',
        ],
    ]) ?>

</div>
