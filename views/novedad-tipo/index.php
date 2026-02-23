<?php

use app\models\NovedadTipo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\search\NovedadTipoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Tipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-tipo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Novedad Tipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'empresa_id',
            'nombre',
            'descripcion:ntext',
            'icono',
            //'orden',
            //'activo',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NovedadTipo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>