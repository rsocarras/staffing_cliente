<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\NovedadFlujoPaso $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Novedad Flujo Pasos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="novedad-flujo-paso-view">

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
            'novedad_tipo_id',
            'nombre',
            'tipo_paso',
            'rol',
            'email_notif:email',
            'es_inicio',
            'siguiente_id',
            'siguiente_si_id',
            'siguiente_no_id',
            'condicion_campo',
            'condicion_op',
            'condicion_valor',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
