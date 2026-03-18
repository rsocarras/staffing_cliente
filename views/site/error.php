<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
// Variables provistas por `yii\web\ErrorAction`:
// - $name: nombre del error (ej. Not Found)
// - $message: mensaje del error
// - $exception: excepción (opcional)
// - $statusCode: código HTTP (ej. 404, 500)
$this->title = isset($statusCode) ? ($statusCode . ' ' . ($name ?? 'Error')) : ($name ?? 'Error');
?>

<div class="page-wrapper">
    <div class="content">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="min-height: 60vh;">
                <div class="col-lg-6 col-md-8 text-center">
                    <img
                        src="<?= Url::to('@web/assets/img/auth/error-404.svg') ?>"
                        alt="<?= Html::encode($this->title) ?>"
                        class="img-fluid"
                        style="max-height: 260px;" />

                    <h1 class="mt-3 mb-2 fw-bold">
                        <?= Html::encode('Error ' . ($statusCode ?? '')) ?>
                        <?= Html::encode($name ? (' ' . $name) : '') ?>
                    </h1>

                    <?php
                    $friendlyLabel = 'Error';
                    $friendlyMessage = $message ?? '';
                    if ((int)($statusCode ?? 0) === 404) {
                        $friendlyLabel = 'Page not found';
                        if (trim((string)$friendlyMessage) === '') {
                            $friendlyMessage = "Sorry, the page you were looking for doesn't exist or has been moved.";
                        }
                    } elseif ((int)($statusCode ?? 0) === 500) {
                        $friendlyLabel = 'Internal server error';
                        if (trim((string)$friendlyMessage) === '') {
                            $friendlyMessage = 'Sorry, something went wrong.';
                        }
                    }
                    ?>

                    <p class="text-muted mb-3">
                        <strong><?= Html::encode($friendlyLabel) ?></strong>
                        <?php if (!empty($friendlyMessage)): ?>
                            <span class="d-block mt-1"><?= Html::encode($friendlyMessage) ?></span>
                        <?php endif; ?>
                    </p>

                    <div class="d-grid gap-2">
                        <?= Html::a(
                            'Back to Dashboard',
                            ['/site/index'],
                            ['class' => 'btn btn-primary mt-2']
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>