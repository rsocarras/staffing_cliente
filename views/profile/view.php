<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Profile $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'user_id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id], [
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
            'user_id',
            'tipo_doc',
            'num_doc',
            'name',
            'public_email:email',
            'gravatar_email:email',
            'gravatar_id',
            'location',
            'timezone',
            'bio:ntext',
            'sexo',
            'empresas_id',
            'about:ntext',
            'estado',
            'telefono',
            'birthday',
            'position',
            'photo_',
            'instagram',
            'tiktok',
            'linkedin',
            'youtube',
            'website',
            'address',
            'data_json',
            'sede_id',
            'cargo_id',
            'centro_costo_id',
            'centro_utilidad_id',
            'city',
            'area_id',
        ],
    ]) ?>

</div>
