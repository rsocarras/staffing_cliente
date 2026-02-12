<?php
use yii\helpers\Html;
use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
// Handle root path - if empty, treat as index page
$page = empty($path) ? 'index' : basename($path);
?>

<?php
if ($page === 'layout-mini') {
    echo '<html lang="en" data-layout="mini">';
} elseif ($page === 'layout-hoverview') {
    echo '<html lang="en" data-layout="hoverview">';
} elseif ($page === 'layout-hidden') {
    echo '<html lang="en" data-layout="hidden">';
} elseif ($page === 'layout-fullwidth') {
    echo '<html lang="en" data-layout="full-width">';
} elseif ($page === 'layout-rtl') {
    echo '<html lang="en" dir="rtl">';
} elseif ($page === 'layout-dark') {
    echo '<html lang="en" data-bs-theme="dark">';
} else {
    echo '<html lang="en">';
}
?>
