<?php

use app\models\NovedadTipoCampoOpcion;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\NovedadTipoCampoOpcionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Tipo Campo Opcions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-tipo-campo-opcion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Novedad Tipo Campo Opcion', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'novedad_tipo_campo_id',
            'valor',
            'etiqueta',
            'orden',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NovedadTipoCampoOpcion $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
