<?php

use app\models\LocationCountry;
use yii\helpers\Html;

/** @var LocationCountry $model */
?>
<div class="d-flex gap-1 justify-content-end">
    <?= Html::a(
        '<i class="ti ti-eye"></i>',
        ['view', 'id' => $model->id],
        ['class' => 'btn btn-icon btn-sm btn-soft-info rounded-pill', 'title' => Yii::t('app', 'View')]
    ) ?>
    <?= Html::a(
        '<i class="ti ti-edit"></i>',
        ['update', 'id' => $model->id],
        ['class' => 'btn btn-icon btn-sm btn-soft-primary rounded-pill', 'title' => Yii::t('app', 'Update')]
    ) ?>
    <?= Html::a(
        '<i class="ti ti-trash"></i>',
        ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-icon btn-sm btn-soft-danger rounded-pill',
            'title' => Yii::t('app', 'Delete'),
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]
    ) ?>
</div>
