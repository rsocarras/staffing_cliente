<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */
?>
<?php
$requestedRoute = Yii::$app->requestedRoute;
// Si por algún motivo se renderiza este layout para rutas que no son de auth,
// bloquea el acceso hasta que el usuario esté logueado.
$allowedWhenGuestPattern = '#^(user/security/(login|logout)$|user/recovery/|site/error)$#';
if (Yii::$app->user->isGuest && !preg_match($allowedWhenGuestPattern, $requestedRoute)) {
    Yii::$app->response->redirect(Url::to(['/user/security/login']));
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

<div class="main-wrapper">
    <?= $content ?>
</div>

<?= $this->render('partials/vendor-scripts') ?>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>