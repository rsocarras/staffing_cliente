<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var Da\User\Search\UserSearch $searchModel
 * @var Da\User\Module $module
 */

$this->title = Yii::t('usuario', 'Manage users');
$this->params['breadcrumbs'][] = $this->title;

$createFormUrl = Url::to(['/user/admin/create-form']);
$createAjaxUrl = Url::to(['/user/admin/create-ajax']);
?>

<?php $this->beginContent($module->viewPath . '/shared/admin_layout.php') ?>

<?php Pjax::begin(['id' => 'user-admin-pjax']) ?>
<div class="table-responsive">
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => "{items}\n{pager}",
    'columns' => [
        'username',
        'email:email',
        [
            'attribute' => 'registration_ip',
            'value' => function ($model) {
                return $model->registration_ip == null
                    ? '<span class="text-muted">' . Yii::t('usuario', '(not set)') . '</span>'
                    : $model->registration_ip;
            },
            'format' => 'html',
            'visible' => !$module->disableIpLogging,
        ],
        [
            'attribute' => 'created_at',
            'value' => function ($model) {
                if (extension_loaded('intl')) {
                    return Yii::t('usuario', '{0, date, MMM dd, YYYY HH:mm}', [$model->created_at]);
                }
                return date('Y-m-d G:i:s', $model->created_at);
            },
        ],
        [
            'attribute' => 'last_login_at',
            'value' => function ($model) {
                if (!$model->last_login_at || $model->last_login_at == 0) {
                    return Yii::t('usuario', 'Never');
                } elseif (extension_loaded('intl')) {
                    return Yii::t('usuario', '{0, date, MMM dd, YYYY HH:mm}', [$model->last_login_at]);
                }
                return date('Y-m-d G:i:s', $model->last_login_at);
            },
        ],
        [
            'attribute' => 'last_login_ip',
            'value' => function ($model) {
                return $model->last_login_ip == null
                    ? '<span class="text-muted">' . Yii::t('usuario', '(not set)') . '</span>'
                    : $model->last_login_ip;
            },
            'format' => 'html',
            'visible' => !$module->disableIpLogging,
        ],
        [
            'header' => Yii::t('usuario', 'Confirmation'),
            'value' => function ($model) {
                if ($model->isConfirmed) {
                    return '<span class="text-success">' . Yii::t('usuario', 'Confirmed') . '</span>';
                }
                return Html::a(
                    Yii::t('usuario', 'Confirm'),
                    ['confirm', 'id' => $model->id],
                    ['class' => 'btn btn-sm btn-success', 'data-method' => 'post', 'data-confirm' => Yii::t('usuario', 'Are you sure you want to confirm this user?')]
                );
            },
            'format' => 'raw',
            'visible' => Yii::$app->getModule('user')->enableEmailConfirmation,
        ],
        'password_age',
        [
            'header' => Yii::t('usuario', 'Block status'),
            'value' => function ($model) {
                if ($model->isBlocked) {
                    return Html::a(Yii::t('usuario', 'Unblock'), ['block', 'id' => $model->id],
                        ['class' => 'btn btn-sm btn-success', 'data-method' => 'post', 'data-confirm' => Yii::t('usuario', 'Are you sure you want to unblock this user?')]);
                }
                return Html::a(Yii::t('usuario', 'Block'), ['block', 'id' => $model->id],
                    ['class' => 'btn btn-sm btn-danger', 'data-method' => 'post', 'data-confirm' => Yii::t('usuario', 'Are you sure you want to block this user?')]);
            },
            'format' => 'raw',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{switch} {reset} {force-password-change} {update} {delete}',
            'buttons' => [
                'switch' => function ($url, $model) use ($module) {
                    if ($model->id != Yii::$app->user->id && $module->enableSwitchIdentities) {
                        return Html::a('<span class="glyphicon glyphicon-user"></span>', ['/user/admin/switch-identity', 'id' => $model->id],
                            ['title' => Yii::t('usuario', 'Impersonate this user'), 'data-confirm' => Yii::t('usuario', 'Are you sure you want to switch to this user for the rest of this Session?'), 'data-method' => 'POST']);
                    }
                    return null;
                },
                'reset' => function ($url, $model) use ($module) {
                    if ($module->allowAdminPasswordRecovery) {
                        return Html::a('<span class="glyphicon glyphicon-flash"></span>', ['/user/admin/password-reset', 'id' => $model->id],
                            ['title' => Yii::t('usuario', 'Send password recovery email'), 'data-confirm' => Yii::t('usuario', 'Are you sure you wish to send a password recovery email to this user?'), 'data-method' => 'POST']);
                    }
                    return null;
                },
                'force-password-change' => function ($url, $model) use ($module) {
                    if (is_null($module->maxPasswordAge)) return null;
                    return Html::a('<span class="glyphicon glyphicon-time"></span>', ['/user/admin/force-password-change', 'id' => $model->id],
                        ['title' => Yii::t('usuario', 'Force password change at next login'), 'data-method' => 'POST']);
                },
            ],
        ],
    ],
]); ?>
</div>
<?php Pjax::end() ?>

<!-- Modal Crear Usuario -->
<div class="modal fade" id="user-create-modal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= Yii::t('usuario', 'Create a user account') ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="user-create-modal-body">
                <div class="text-center py-4"><span class="spinner-border spinner-border-sm"></span> Cargando...</div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
$('#user-create-modal').on('show.bs.modal', function() {
    var \$body = $('#user-create-modal-body');
    \$body.html('<div class="text-center py-4"><span class="spinner-border spinner-border-sm"></span> Cargando...</div>');
    $.get('{$createFormUrl}', function(html) {
        \$body.html(html);
        \$body.find('#user-create-modal-form').on('submit', function(e) {
            e.preventDefault();
            var \$form = $(this);
            var \$btn = \$form.find('button[type=submit]');
            var \$errors = \$form.find('.alert-danger');
            if (!\$errors.length) \$errors = $('<div class="alert alert-danger d-none"></div>').prependTo(\$form);
            \$errors.addClass('d-none').empty();
            \$btn.prop('disabled', true);
            $.ajax({
                url: '{$createAjaxUrl}',
                type: 'POST',
                data: \$form.serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        bootstrap.Modal.getInstance(document.getElementById('user-create-modal')).hide();
                        \$form[0].reset();
                        $.pjax.reload({container: '#user-admin-pjax'});
                    } else {
                        var errs = [];
                        if (res.errors) {
                            for (var k in res.errors) {
                                var v = res.errors[k];
                                errs.push((Array.isArray(v) ? v.join(' ') : v));
                            }
                        }
                        \$errors.html(errs.join('<br>')).removeClass('d-none');
                    }
                },
                error: function() {
                    \$errors.html('Error al guardar. Intente nuevamente.').removeClass('d-none');
                },
                complete: function() {
                    \$btn.prop('disabled', false);
                }
            });
        });
    });
});
JS;
$this->registerJs($js, \yii\web\View::POS_READY);
?>

<?php $this->endContent() ?>
