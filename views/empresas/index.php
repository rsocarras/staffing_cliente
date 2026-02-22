<?php

use app\models\Empresas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\EmpresasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Empresas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Empresas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'social_name',
            'entity',
            'ref_int',
            //'ref_ext',
            //'status',
            //'tms',
            //'datec',
            //'dateu',
            //'code',
            //'address',
            //'url:url',
            //'twitter',
            //'instagram',
            //'phone_1',
            //'phone_2',
            //'email:email',
            //'description_s',
            //'description_l:ntext',
            //'idu',
            //'supplier_only',
            //'slug',
            //'user_owner',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Empresas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
