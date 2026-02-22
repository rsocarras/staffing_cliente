<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Empresas $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Empresas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="empresas-view">

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
            'social_name',
            'entity',
            'ref_int',
            'ref_ext',
            'status',
            'tms',
            'datec',
            'dateu',
            'code',
            'address',
            'url:url',
            'twitter',
            'instagram',
            'phone_1',
            'phone_2',
            'email:email',
            'description_s',
            'description_l:ntext',
            'idu',
            'supplier_only',
            'slug',
            'user_owner',
        ],
    ]) ?>

</div>
