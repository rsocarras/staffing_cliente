<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\LocationCountry $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Location Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="location-country-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'official_name',
            'common_name',
            'iso_alpha2',
            'iso_alpha3',
            'iso_numeric',
            'calling_code_primary',
            'calling_codes',
            'flag_emoji',
            'flag_svg_url:url',
            'flag_png_url:url',
            'capital',
            'region',
            'subregion',
            'currencies',
            'languages',
            'tld',
            'timezones',
            'is_active',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
