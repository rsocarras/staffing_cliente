<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $content string */
?>

<?php
$requestedRoute = Yii::$app->requestedRoute;
// Bloquea acceso a la UI principal hasta que el usuario esté logueado.
// Excepciones: login/logout y recuperación de password (y errores).
$allowedWhenGuestPattern = '#^(user/security/(login|logout)$|user/recovery/|site/error)$#';
if (Yii::$app->user->isGuest && !preg_match($allowedWhenGuestPattern, $requestedRoute)) {
    Yii::$app->response->redirect(Url::to(['/login']));
    Yii::$app->end();
}
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<?= $this->render('partials/theme-settings') ?>

<head>
    <?= $this->render('partials/title-meta') ?>
    <?= $this->render('partials/head-css') ?>
    <?php $this->head() ?>
</head>

<?= $this->render('partials/body') ?>
<?php $this->beginBody() ?>

<!-- Begin Wrapper -->
<div class="main-wrapper">

    <?= $this->render('partials/topbar') ?>
    <?= $this->render('partials/sidebar') ?>

    <?php
    $trimmedContent = ltrim($content);
    $controllerId = Yii::$app->controller ? Yii::$app->controller->id : null;
    $skipAutoWrapper = ($controllerId === 'pages');
    $alreadyWrapped = $skipAutoWrapper || str_starts_with($trimmedContent, '<div class="page-wrapper">');
    ?>

    <?php if ($alreadyWrapped): ?>
        <?= $content ?> <!-- Main content of the page -->
    <?php else: ?>
        <div class="page-wrapper">

            <!-- Start Content -->
            <div class="content">

                <?= $content ?> <!-- Main content of the page -->
            </div>
        </div>
    <?php endif; ?>

    <?= $this->render('partials/footer') ?>
</div>
<!-- End Wrapper -->

<?= $this->render('partials/modal-popup') ?>
<?= $this->render('partials/vendor-scripts') ?>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>