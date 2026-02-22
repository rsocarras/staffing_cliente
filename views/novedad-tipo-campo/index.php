<?php

use app\models\NovedadTipoCampo;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\NovedadTipoCampoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Novedad Tipo Campos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="novedad-tipo-campo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Novedad Tipo Campo', ['create'], ['class' => 'btn btn-success']) ?>
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
            'orden',
            'campo_id',
            'label',
            //'tipo_dato',
            //'requerido',
            //'calculado',
            //'formula',
            //'max_length',
            //'val_min',
            //'val_max',
            //'alerta_max',
            //'fuente_opciones',
            //'depende_de',
            //'visible_si_campo',
            //'visible_si_op',
            //'visible_si_valor:ntext',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, NovedadTipoCampo $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
