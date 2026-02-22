<?php

use app\models\EmpleadoVenueHistory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\EmpleadoVenueHistorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Empleado Venue Histories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empleado-venue-history-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Empleado Venue History', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'empresa_id',
            'profile_id',
            'fecha_efectiva',
            'sede_id',
            //'centro_costo_id',
            //'centro_utilidad_id',
            //'motivo',
            //'actor_user_id',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, EmpleadoVenueHistory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
