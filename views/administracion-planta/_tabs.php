<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var string $activeTab */
?>

<ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
    <li class="nav-item">
        <a href="<?= Url::to(['dashboard']) ?>" class="nav-link <?= $activeTab === 'dashboard' ? 'active' : '' ?>">
            <span class="d-md-inline-block">Dashboard global</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= Url::to(['resumen-sede']) ?>" class="nav-link <?= $activeTab === 'resumen-sede' ? 'active' : '' ?>">
            <span class="d-md-inline-block">Resumen por sede</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= Url::to(['resumen-area']) ?>" class="nav-link <?= $activeTab === 'resumen-area' ? 'active' : '' ?>">
            <span class="d-md-inline-block">Resumen por área</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= Url::to(['index']) ?>" class="nav-link <?= $activeTab === 'index' ? 'active' : '' ?>">
            <span class="d-md-inline-block">Administración de planta</span>
        </a>
    </li>
    <?php if (Yii::$app->user->can('administracion_planta_history') || Yii::$app->user->can('admin') || Yii::$app->user->can('administrator')): ?>
    <li class="nav-item">
        <a href="<?= Url::to(['historial']) ?>" class="nav-link <?= $activeTab === 'historial' ? 'active' : '' ?>">
            <span class="d-md-inline-block">Historial</span>
        </a>
    </li>
    <?php endif; ?>
</ul>
