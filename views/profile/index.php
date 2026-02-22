<?php

use app\models\Profile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\search\ProfileSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Profile', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'tipo_doc',
            'num_doc',
            'name',
            'public_email:email',
            //'gravatar_email:email',
            //'gravatar_id',
            //'location',
            //'timezone',
            //'bio:ntext',
            //'sexo',
            //'empresas_id',
            //'about:ntext',
            //'estado',
            //'telefono',
            //'birthday',
            //'position',
            //'photo_',
            //'instagram',
            //'tiktok',
            //'linkedin',
            //'youtube',
            //'website',
            //'address',
            //'data_json',
            //'sede_id',
            //'cargo_id',
            //'centro_costo_id',
            //'centro_utilidad_id',
            //'city',
            //'area_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Profile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
