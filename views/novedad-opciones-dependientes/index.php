<?php

use app\models\NovedadOpcionesDependientes;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\NovedadOpcionesDependientesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Opciones Dependientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-opciones-dependientes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Novedad Opciones Dependientes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'campo_hijo',
            'campo_padre',
            'valor_padre',
            'valor',
            //'etiqueta',
            //'orden',
            //'activo',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NovedadOpcionesDependientes $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
