<?php

use yii\bootstrap5\Nav;
use yii\helpers\Html;

?>
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <?= Html::a(Yii::t('usuario', 'Users'), ['/user/admin/index'], ['class' => 'nav-link active']) ?>
    </li>
    <li class="nav-item">
        <?= Html::a(Yii::t('usuario', 'Roles'), ['/user/role/index'], ['class' => 'nav-link']) ?>
    </li>
    <li class="nav-item">
        <?= Html::a(Yii::t('usuario', 'Permissions'), ['/user/permission/index'], ['class' => 'nav-link']) ?>
    </li>
    <li class="nav-item">
        <?= Html::a(Yii::t('usuario', 'Rules'), ['/user/rule/index'], ['class' => 'nav-link']) ?>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><?= Yii::t('usuario', 'Create') ?></a>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#user-create-modal">
                    <?= Yii::t('usuario', 'New user') ?> (modal)
                </a>
            </li>
            <li><?= Html::a(Yii::t('usuario', 'New user'), ['/user/admin/create'], ['class' => 'dropdown-item']) ?></li>
            <li><?= Html::a(Yii::t('usuario', 'New role'), ['/user/role/create'], ['class' => 'dropdown-item']) ?></li>
            <li><?= Html::a(Yii::t('usuario', 'New permission'), ['/user/permission/create'], ['class' => 'dropdown-item']) ?></li>
            <li><?= Html::a(Yii::t('usuario', 'New rule'), ['/user/rule/create'], ['class' => 'dropdown-item']) ?></li>
        </ul>
    </li>
</ul>
