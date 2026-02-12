<?php
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */
?>

<!DOCTYPE html>
<?= $this->render('partials/theme-settings') ?>

<head>
    <?= $this->render('partials/title-meta') ?>
    <?= $this->render('partials/head-css') ?>
</head>

<?= $this->render('partials/body') ?>

    <!-- Begin Wrapper -->
    <div class="main-wrapper">

        <?= $this->render('partials/topbar') ?>
        <?= $this->render('partials/sidebar') ?>

        <?= $content ?> <!-- Main content of the page -->

    </div>
    <!-- End Wrapper -->

    <?= $this->render('partials/modal-popup') ?>
    <?= $this->render('partials/vendor-scripts') ?>
</body>
</html>
