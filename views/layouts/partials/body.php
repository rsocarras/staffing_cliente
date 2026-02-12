<?php
use yii\helpers\Html;
use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
$page = empty($path) ? 'index' : basename($path);

if ($page === 'chat') {
    echo '<body class="chat-page">';
} elseif ($page === 'layout-mini') {
    echo '<body class="mini-sidebar">';
} elseif ($page === 'lock-screen') {
    echo '<body class="bg-light">';
} elseif ($page === 'login' || $page === 'login-2' || $page === 'register' || $page === 'register-2' || $page == 'forgot-password' || $page == 'forgot-password-2' || $page == 'reset-password' || $page == 'reset-password-2' || $page == 'email-verification' || $page == 'email-verification-2' || $page == 'two-step-verification' || $page == 'two-step-verification-2' || $page == 'free-trial' || $page == 'free-trial-2' || $page == 'success' || $page == 'success-2') {
    echo '<body class="bg-white">';
} else {
    echo '<body>';
}
?>
