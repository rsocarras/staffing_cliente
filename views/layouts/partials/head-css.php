<?php
use yii\helpers\Html;
use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
// Handle root path - if empty, treat as index page
$page = empty($path) ? 'index' : basename($path);
?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= Url::to('@web/assets/img/favicon.png') ?>">

    <!-- Apple Icon -->
    <link rel="apple-touch-icon" href="<?= Url::to('@web/assets/img/apple-icon.png') ?>">

<?php  if ($page !== 'layout-mini' && $page !== 'layout-hoverview'  && $page !== 'layout-hidden' && $page !== 'layout-fullwidth' && $page !== 'layout-rtl' && $page !== 'layout-dark' && $page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'under-construction' && $page !== 'login' && $page !== 'login-2' && $page !== 'login-3' && $page !== 'register' && $page !== 'register-2' && $page !== 'register-3' && $page !== 'forgot-password' && $page !== 'forgot-password-2' && $page !== 'forgot-password-3' && $page !== 'reset-password' && $page !== 'reset-password-2' && $page !== 'reset-password-3' && $page !== 'email-verification' && $page !== 'email-verification-2' && $page !== 'email-verification-3' && $page !== 'two-step-verification' && $page !== 'two-step-verification-2' && $page !== 'two-step-verification-3' && $page !== 'lock-screen' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'free-trial' && $page !== 'free-trial-2' && $page !== 'free-trial-3' && $page !== 'success' && $page !== 'success-2' && $page !== 'success-3') {   ?>
    <!-- Theme Config Js -->
    <script src="<?= Url::to('@web/assets/js/theme-script.js') ?>"></script>
<?php }?>

<?php  if ($page !== 'layout-rtl') {   ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/css/bootstrap.min.css') ?>">
<?php }?>

<?php  if ($page == 'layout-rtl') {   ?>
    <!-- Bootstrap-RTL CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/css/bootstrap.rtl.min.css') ?>">
<?php }?>

    <!-- Tabler Icon CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/tabler-icons/tabler-icons.min.css') ?>">

<?php  if ($page == 'icon-bootstrap') {   ?>
    <!-- Bootstrap Icon CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/bootstrap/bootstrap-icons.min.css') ?>">
<?php }?>

<?php  if ($page == 'icon-feather') {   ?>
    <!-- Feather CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/feather/feather.css') ?>">
<?php }?>

<?php  if ($page == 'icon-flag') {   ?>
    <!-- Flag CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/flags/flags.css') ?>">
<?php }?>

<?php  if ($page == 'icon-fontawesome') {   ?>
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/fontawesome/css/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/fontawesome/css/all.min.css') ?>">
<?php }?>

<?php  if ($page == 'icon-ionic') {   ?>
    <!-- Ionic CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/ionic/ionicons.css') ?>">
<?php }?>

<?php  if ($page == 'icon-material') {   ?>
    <!-- Material CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/material/materialdesignicons.css') ?>">
<?php }?>

<?php  if ($page == 'icon-pe7') {   ?>
    <!-- Pe7 CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/pe7/pe-icon-7.css') ?>">
<?php }?>

<?php  if ($page == 'icon-remix') {   ?>
    <!-- Remix Icon CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/remix/remixicon.css') ?>">
<?php }?>

<?php  if ($page == 'icon-simpleline') {   ?>
    <!-- Simpleline CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/simpleline/simple-line-icons.css') ?>">
<?php }?>

<?php  if ($page == 'icon-themify') {   ?>
    <!-- Themify CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/themify/themify.css') ?>">
<?php }?>

<?php  if ($page == 'icon-typicon') {   ?>
    <!-- Typicon CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/typicons/typicons.css') ?>">
<?php }?>

<?php  if ($page == 'icon-weather') {   ?>
    <!-- Weather CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/icons/weather/weathericons.css') ?>">
<?php }?>

<?php  if ($page == 'activity-summary' || $page == 'add-invoice' || $page == 'add-project' || $page == 'attendance-report' || $page == 'attendance' || $page == 'blogs' || $page == 'calendar' || $page == 'download' || $page == 'edit-invoice' || $page == 'edit-project' || $page == 'edit-shift' || $page == 'edit-time-approved' || $page == 'edit-time-request' || $page == 'edit-time-waiting' || $page == 'edit-time' || $page == 'edit-user' || $page == 'expense-approved' || $page == 'expense-rejected' || $page == 'expense-requested' || $page == 'expense' || $page == 'form-pickers' || $page == 'hours-tracked' || $page == 'invoice-details' || $page == 'invoice' || $page == 'invoices' || $page == 'kanban-view' || $page == 'leave-approved' || $page == 'leave-rejected' || $page == 'leave-types' || $page == 'leave' || $page == 'live-tracking' || $page == 'live-tracking-minute' || $page == 'low-activity' || $page == 'manual-time' || $page == 'notes' || $page == 'permissions' || $page == 'plans-and-billings' || $page == 'plugin' || $page == 'poor-time-use' || $page == 'productivity-ratings-settings' || $page == 'project-archived' || $page == 'project-completed' || $page == 'project-details-milestones-grid' || $page == 'project-details-milestones' || $page == 'project-details-screenshots' || $page == 'project-details-task-list' || $page == 'project-details-task' || $page == 'project-details-usage' || $page == 'project-details' || $page == 'project-hold' || $page == 'project' || $page == 'projects-grid' || $page == 'projects-tasks' || $page == 'projects' || $page == 'screenshots' || $page == 'search-results' || $page == 'shift-settings' || $page == 'shifts-leave-types' || $page == 'tasks-archived' || $page == 'tasks-completed' || $page == 'tasks-grid' || $page == 'tasks-onhold' || $page == 'tasks' || $page == 'testimonials' || $page == 'timeline-details' || $page == 'timeline-report' || $page == 'timesheet-report' || $page == 'timesheet' || $page == 'todo' || $page == 'tracker-settings' || $page == 'unusual-activity' || $page == 'usage-timeline-details' || $page == 'user-activity-summary' || $page == 'user-attendance-report' || $page == 'user-attendance' || $page == 'user-hours-tracked-report' || $page == 'user-leave-approved' || $page == 'user-leave-pending' || $page == 'user-leave-rejected' || $page == 'user-manual-time-report' || $page == 'user-poor-time-use-report' || $page == 'user-projects-and-tasks' || $page == 'user-projects-archived' || $page == 'user-projects' || $page == 'user-tasks-grid' || $page == 'user-tasks' || $page == 'user-timeline-report' || $page == 'user-timeline-screenshots' || $page == 'user-timeline-usage' || $page == 'user-timesheet-report' || $page == 'user-timesheet' || $page == 'user-unusual-activity' || $page == 'user-web-and-app-usage' || $page == 'web-app-usage' || $page == 'working-hours-settings') {   ?>
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/flatpickr/flatpickr.min.css') ?>">
<?php }?>

<?php  if ($page == 'activity-summary-month' || $page == 'activity-summary-week' || $page == 'attendance-report-month' || $page == 'attendance-report-week' || $page == 'employees-archived' || $page == 'employees-deactivated' || $page == 'employees' || $page == 'employees-grid' || $page == 'expense-report' || $page == 'hours-tracked-month' || $page == 'hours-tracked-week' || $page == 'idle-time' || $page == 'invoice' || $page == 'manual-time-week' || $page == 'notifications' || $page == 'overtime-limit' || $page == 'plugin' || $page == 'poor-time-month' || $page == 'poor-time-week' || $page == 'project-details-milestones-grid' || $page == 'project-details-milestones' || $page == 'project-details-screenshots' || $page == 'project-details-task-list' || $page == 'project-details-task' || $page == 'project-details-usage' || $page == 'project-details' || $page == 'projects-tasks' || $page == 'timesheet-report-week' || $page == 'timesheet-week' || $page == 'user-activity-summary-month' || $page == 'user-activity-summary-week' || $page == 'user-attendance-report-month' || $page == 'user-attendance-report-week' || $page == 'user-hours-tracked-month' || $page == 'user-hours-tracked-week' || $page == 'user-idle-time-report' || $page == 'user-manual-time-month' || $page == 'user-manual-time-week' || $page == 'user-overlimit-time-report' || $page == 'user-poor-time-month' || $page == 'user-poor-time-week' || $page == 'user-projects-and-tasks' || $page == 'user-timeline-week' || $page == 'user-timesheet-month' || $page == 'user-timesheet-week' || $page == 'user-working-on-weekends' || $page == 'working-on-weekends') {   ?>
    <!-- Daterangepikcer CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/daterangepicker/daterangepicker.css') ?>">
<?php }?>

<?php  if ($page == 'data-tables' || $page == 'plugin') {   ?>
    <!-- Datatable CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/datatables/css/dataTables.bootstrap5.min.css') ?>">
 <?php }?>

<?php  if ($page == 'add-invoice' || $page == 'blog-detail' || $page == 'blog-tags' || $page == 'blogs' || $page == 'contact-list' || $page == 'contacts' || $page == 'download' || $page == 'edit-invoice' || $page == 'edit-shift' || $page == 'edit-time-approved' || $page == 'edit-time-request' || $page == 'edit-time-waiting' || $page == 'edit-time' || $page == 'edit-user' || $page == 'email-compose' || $page == 'email-details' || $page == 'email' || $page == 'faq' || $page == 'form-select' || $page == 'invite-users' || $page == 'invoice-details' || $page == 'notes' || $page == 'permissions' || $page == 'plugin' || $page == 'project-details-screenshots' || $page == 'project-details-task-list' || $page == 'project-details-task' || $page == 'search-results' || $page == 'tasks-archived' || $page == 'tasks-completed' || $page == 'tasks-grid' || $page == 'tasks-onhold' || $page == 'tasks' || $page == 'teams-grid' || $page == 'teams' || $page == 'testimonials' || $page == 'user-tasks-grid' || $page == 'user-tasks') {   ?>
    <!-- Choices CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/choices.js/public/assets/styles/choices.min.css') ?>">
<?php }?>

<?php  if ($page == 'add-invoice' || $page == 'appearance-settings' || $page == 'clients-grid' || $page == 'clients' || $page == 'company-settings' || $page == 'edit-invoice' || $page == 'edit-user' || $page == 'employee-settings' || $page =='free-trial-2' || $page =='free-trial-3' || $page =='free-trial' || $page =='invoice-details' || $page == 'location-settings' || $page =='plans-and-billings' || $page == 'plugin' || $page =='profile-settings' || $page == 'security-settings' || $page == 'user-profile-settings' || $page == 'user-security-settings') {   ?>
    <!-- intel input -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/intltelinput/css/intlTelInput.css') ?>">
<?php }?>

<?php  if ($page == 'email-compose' || $page == 'email-details' || $page == 'file-manager' || $page == 'kanban-view' || $page == 'notes' || $page == 'pages' || $page == 'plugin' || $page == 'reports' || $page == 'todo-list' || $page == 'todo') {   ?>
    <!-- Quill css -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/quill/quill.core.css') ?>">
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/quill/quill.snow.css') ?>">
<?php }?>

<?php  if ($page == 'form-editors' || $page == 'plugin') {   ?>
    <!-- Quill css -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/quill/quill.core.css') ?>">
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/quill/quill.snow.css') ?>">
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/quill/quill.bubble.css') ?>">
<?php }?>

<?php  if ($page == 'email-compose' || $page == 'email-details' || $page == 'employee-details' || $page == 'plugin' || $page == 'project-details-screenshots' || $page == 'screenshots' || $page == 'social-feed' || $page == 'timeline-details' || $page == 'user-timeline-screenshots') {   ?>
    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/fancybox/jquery.fancybox.min.css') ?>">
<?php }?>

<?php  if ($page == 'gallery' || $page == 'plugin' || $page == 'search-results' || $page == 'social-feed' || $page == 'ui-lightbox') {   ?>
    <!-- Glightbox CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/lightbox/glightbox.min.css') ?>">
<?php }?>

<?php  if ($page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'under-construction' && $page !== 'login' && $page !== 'login-2' && $page !== 'login-3' && $page !== 'register' && $page !== 'register-2' && $page !== 'register-3' && $page !== 'forgot-password' && $page !== 'forgot-password-2' && $page !== 'forgot-password-3' && $page !== 'reset-password' && $page !== 'reset-password-2' && $page !== 'reset-password-3' && $page !== 'email-verification' && $page !== 'email-verification-2' && $page !== 'email-verification-3' && $page !== 'two-step-verification' && $page !== 'two-step-verification-2' && $page !== 'two-step-verification-3' && $page !== 'lock-screen' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'success' && $page !== 'success-2' && $page !== 'success-3') {   ?>
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/select2/css/select2.min.css') ?>">
<?php }?>

<?php  if ($page == 'video-call' || $page == 'plugin') {   ?>
    <!-- Swiper css -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/swiper/swiper-bundle.min.css') ?>">
<?php }?>

<?php  if ($page == 'chart-c3' || $page == 'plugin') {   ?>
    <!-- ChartC3 CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/c3-chart/c3.min.css') ?>">
<?php }?>

<?php  if ($page == 'chart-morris' || $page == 'plugin') {   ?>
    <!-- Morris CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/morris/morris.css') ?>">
<?php }?>

<?php  if ($page == 'plugin' || $page == 'ui-rangeslider') {   ?>
    <!-- Rangeslider CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/nouislider/nouislider.min.css') ?>">
<?php }?>

<?php  if ($page == 'plugin' || $page == 'ui-sweetalerts') {   ?>
    <!-- Sweetalert2 CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.css') ?>">
<?php }?>

    <!-- Simplebar CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/plugins/simplebar/simplebar.min.css') ?>">

    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= Url::to('@web/assets/css/style.css') ?>" id="app-style">