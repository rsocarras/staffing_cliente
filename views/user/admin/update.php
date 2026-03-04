<?php

use yii\bootstrap5\Nav;
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var app\models\User $user
 * @var string $content
 */

$this->title = Yii::t('usuario', 'Update user account');
$this->params['breadcrumbs'][] = ['label' => Yii::t('usuario', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$module = Yii::$app->getModule('user');
?>
<div class="clearfix"></div>
<?= $this->render('/shared/_alert', ['module' => $module]) ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><?= Html::encode($this->title) ?></h5>
            </div>
            <div class="card-body">
                <?= $this->render('/shared/_menu') ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="list-group mb-3">
                            <?= Html::a(Yii::t('usuario', 'Account details'), ['/user/admin/update', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action']) ?>
                            <?= Html::a(Yii::t('usuario', 'Profile details'), ['/user/admin/update-profile', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action']) ?>
                            <?= Html::a(Yii::t('usuario', 'Information'), ['/user/admin/info', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action']) ?>
                            <?= Html::a(Yii::t('usuario', 'Assignments'), ['/user/admin/assignments', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action']) ?>
                            <?php if ($module->enableSessionHistory): ?>
                                <?= Html::a(Yii::t('usuario', 'Session history'), ['/user/admin/session-history', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action']) ?>
                            <?php endif ?>
                            <?php if (!$user->isConfirmed): ?>
                                <?= Html::a(Yii::t('usuario', 'Confirm'), ['/user/admin/confirm', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action text-success', 'data-method' => 'post', 'data-confirm' => Yii::t('usuario', 'Are you sure you want to confirm this user?')]) ?>
                            <?php endif ?>
                            <?php if (!$user->isBlocked): ?>
                                <?= Html::a(Yii::t('usuario', 'Block'), ['/user/admin/block', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action text-danger', 'data-method' => 'post', 'data-confirm' => Yii::t('usuario', 'Are you sure you want to block this user?')]) ?>
                            <?php else: ?>
                                <?= Html::a(Yii::t('usuario', 'Unblock'), ['/user/admin/block', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action text-success', 'data-method' => 'post', 'data-confirm' => Yii::t('usuario', 'Are you sure you want to unblock this user?')]) ?>
                            <?php endif ?>
                            <?= Html::a(Yii::t('usuario', 'Delete'), ['/user/admin/delete', 'id' => $user->id], ['class' => 'list-group-item list-group-item-action text-danger', 'data-method' => 'post', 'data-confirm' => Yii::t('usuario', 'Are you sure you want to delete this user?')]) ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <?= $content ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
