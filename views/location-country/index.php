<?php

use app\models\LocationCountry;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\LocationCountrySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Location Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="location-country-index">

                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Create Location Country', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'official_name',
                        'common_name',
                        'iso_alpha2',
                        //'iso_alpha3',
                        //'iso_numeric',
                        //'calling_code_primary',
                        //'calling_codes',
                        //'flag_emoji',
                        //'flag_svg_url:url',
                        //'flag_png_url:url',
                        //'capital',
                        //'region',
                        //'subregion',
                        //'currencies',
                        //'languages',
                        //'tld',
                        //'timezones',
                        //'is_active',
                        //'created_at',
                        //'updated_at',
                        [
                            'class' => ActionColumn::className(),
                            'urlCreator' => function ($action, LocationCountry $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                             }
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
