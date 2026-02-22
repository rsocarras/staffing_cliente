<?php

use app\models\NovedadFlujoPaso;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\NovedadFlujoPasoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Flujo Pasos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-flujo-paso-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Novedad Flujo Paso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'novedad_tipo_id',
            'nombre',
            'tipo_paso',
            'rol',
            //'email_notif:email',
            //'es_inicio',
            //'siguiente_id',
            //'siguiente_si_id',
            //'siguiente_no_id',
            //'condicion_campo',
            //'condicion_op',
            //'condicion_valor',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NovedadFlujoPaso $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
