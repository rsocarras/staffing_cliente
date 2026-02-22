<?php

use app\models\ConceptoIntegracionMap;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\ConceptoIntegracionMapSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Concepto Integracion Maps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="concepto-integracion-map-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Concepto Integracion Map', ['create'], ['class' => 'btn btn-success']) ?>
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
            'provider',
            'concepto_id',
            'remote_code',
            //'remote_name',
            //'config_json',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ConceptoIntegracionMap $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
