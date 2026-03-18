<?php
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $content string */
?>
<?php
$requestedRoute = Yii::$app->requestedRoute;
// Bloquea acceso a este layout si el usuario no está logueado
// (excepto login/logout/recovery y errores).
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

