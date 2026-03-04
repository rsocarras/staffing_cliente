<?php

use Da\User\Model\SessionHistory;
use Da\User\Widget\SessionStatusWidget;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var Da\User\Search\SessionHistorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var app\models\User $user */
/** @var \Da\User\Module $module */

?>
<?php $this->beginContent($module->viewPath . '/admin/update.php', ['user' => $user]) ?>

<div class="mb-3">
    <?= Html::a(Yii::t('usuario', 'Terminate all sessions'), ['/user/admin/terminate-sessions', 'id' => $user->id], ['class' => 'btn btn-danger btn-sm', 'data-method' => 'post']) ?>
</div>

<?php Pjax::begin(); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'user_agent',
        'ip',
        [
            'label' => Yii::t('usuario', 'Status'),
            'value' => function (SessionHistory $model) {
                return SessionStatusWidget::widget(['model' => $model]);
            },
        ],
        ['attribute' => 'updated_at', 'format' => 'datetime'],
    ],
]); ?>
<?php Pjax::end(); ?>

<?php $this->endContent() ?>
