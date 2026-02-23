<?php
use yii\helpers\Html;
use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
// Handle root path - if empty, treat as index page
$page = empty($path) ? 'index' : basename($path);
?>

    <!-- jQuery -->
    <script src="<?= Url::to('@web/assets/js/jquery-3.7.1.min.js') ?>"></script>

    <!-- Bootstrap Core JS -->
    <script src="<?= Url::to('@web/assets/js/bootstrap.bundle.min.js') ?>"></script>

	<!-- Simplebar JS -->
	<script src="<?= Url::to('@web/assets/plugins/simplebar/simplebar.min.js') ?>"></script>

<?php  if ($page == 'activity-summary' || $page == 'add-invoice' || $page == 'add-project' || $page == 'attendance-report' || $page == 'attendance' || $page == 'blogs' || $page == 'calendar' || $page == 'download' || $page == 'edit-invoice' || $page == 'edit-project' || $page == 'edit-shift' || $page == 'edit-time-approved' || $page == 'edit-time-request' || $page == 'edit-time-waiting' || $page == 'edit-time' || $page == 'edit-user' || $page == 'expense-approved' || $page == 'expense-rejected' || $page == 'expense-requested' || $page == 'expense' || $page == 'form-pickers' || $page == 'hours-tracked' || $page == 'invoice-details' || $page == 'invoice' || $page == 'invoices' || $page == 'kanban-view' || $page == 'leave-approved' || $page == 'leave-rejected' || $page == 'leave-types' || $page == 'leave' || $page == 'live-tracking' || $page == 'live-tracking-minute' || $page == 'low-activity' || $page == 'manual-time' || $page == 'notes' || $page == 'permissions' || $page == 'plans-and-billings' || $page == 'plugin' || $page == 'poor-time-use' || $page == 'productivity-ratings-settings' || $page == 'project-archived' || $page == 'project-completed' || $page == 'project-details-milestones-grid' || $page == 'project-details-milestones' || $page == 'project-details-screenshots' || $page == 'project-details-task-list' || $page == 'project-details-task' || $page == 'project-details-usage' || $page == 'project-details' || $page == 'project-hold' || $page == 'project' || $page == 'projects-grid' || $page == 'projects-tasks' || $page == 'projects' || $page == 'screenshots' || $page == 'search-results' || $page == 'shift-settings' || $page == 'shifts-leave-types' || $page == 'tasks-archived' || $page == 'tasks-completed' || $page == 'tasks-grid' || $page == 'tasks-onhold' || $page == 'tasks' || $page == 'testimonials' || $page == 'timeline-details' || $page == 'timeline-report' || $page == 'timesheet-report' || $page == 'timesheet' || $page == 'todo' || $page == 'tracker-settings' || $page == 'unusual-activity' || $page == 'usage-timeline-details' || $page == 'user-activity-summary' || $page == 'user-attendance-report' || $page == 'user-attendance' || $page == 'user-hours-tracked-report' || $page == 'user-leave-approved' || $page == 'user-leave-pending' || $page == 'user-leave-rejected' || $page == 'user-manual-time-report' || $page == 'user-poor-time-use-report' || $page == 'user-projects-and-tasks' || $page == 'user-projects-archived' || $page == 'user-projects' || $page == 'user-tasks-grid' || $page == 'user-tasks' || $page == 'user-timeline-report' || $page == 'user-timeline-screenshots' || $page == 'user-timeline-usage' || $page == 'user-timesheet-report' || $page == 'user-timesheet' || $page == 'user-unusual-activity' || $page == 'user-web-and-app-usage' || $page == 'web-app-usage' || $page == 'working-hours-settings') {   ?>
    <!-- Flatpickr JS -->
	<script src="<?= Url::to('@web/assets/plugins/flatpickr/flatpickr.min.js') ?>"></script>
<?php }?>

<?php  if ($page == 'activity-summary-month' || $page == 'activity-summary-week' || $page == 'attendance-report-month' || $page == 'attendance-report-week' || $page == 'employees-archived' || $page == 'employees-deactivated' || $page == 'employees' || $page == 'employees-grid' || $page == 'expense-report' || $page == 'hours-tracked-month' || $page == 'hours-tracked-week' || $page == 'idle-time' || $page == 'invoice' || $page == 'manual-time-week' || $page == 'notifications' || $page == 'overtime-limit' || $page == 'plugin' || $page == 'poor-time-month' || $page == 'poor-time-week' || $page == 'project-details-milestones-grid' || $page == 'project-details-milestones' || $page == 'project-details-screenshots' || $page == 'project-details-task-list' || $page == 'project-details-task' || $page == 'project-details-usage' || $page == 'project-details' || $page == 'projects-tasks' || $page == 'timesheet-report-week' || $page == 'timesheet-week' || $page == 'user-activity-summary-month' || $page == 'user-activity-summary-week' || $page == 'user-attendance-report-month' || $page == 'user-attendance-report-week' || $page == 'user-hours-tracked-month' || $page == 'user-hours-tracked-week' || $page == 'user-idle-time-report' || $page == 'user-manual-time-month' || $page == 'user-manual-time-week' || $page == 'user-overlimit-time-report' || $page == 'user-poor-time-month' || $page == 'user-poor-time-week' || $page == 'user-projects-and-tasks' || $page == 'user-timeline-week' || $page == 'user-timesheet-month' || $page == 'user-timesheet-week' || $page == 'user-working-on-weekends' || $page == 'working-on-weekends') {   ?>
    <!-- Daterangepikcer JS -->
    <script src="<?= Url::to('@web/assets/js/moment.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/daterangepicker/daterangepicker.js') ?>"></script>
<?php }?>

<?php  if ($page == 'calendar' || $page == 'plugin') {   ?>
    <!-- Fullcalendar JS -->
    <script src="<?= Url::to('@web/assets/plugins/fullcalendar/index.global.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/fullcalendar/calendar-data.js') ?>"></script>
<?php }?>

<?php  if ($page == 'data-tables' || $page == 'plugin') {   ?>
    <!-- Datatable JS -->
    <script src="<?= Url::to('@web/assets/plugins/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/datatables/js/dataTables.bootstrap5.min.js') ?>"></script>
<?php }?>

<?php  if ($page == 'add-invoice' || $page == 'blog-detail' || $page == 'blog-tags' || $page == 'blogs' || $page == 'contact-list' || $page == 'contacts' || $page == 'download' || $page == 'edit-invoice' || $page == 'edit-shift' || $page == 'edit-time-approved' || $page == 'edit-time-request' || $page == 'edit-time-waiting' || $page == 'edit-time' || $page == 'edit-user' || $page == 'email-compose' || $page == 'email-details' || $page == 'email' || $page == 'faq' || $page == 'form-select' || $page == 'invite-users' || $page == 'invoice-details' || $page == 'notes' || $page == 'permissions' || $page == 'plugin' || $page == 'project-details-screenshots' || $page == 'project-details-task-list' || $page == 'project-details-task' || $page == 'search-results' || $page == 'tasks-archived' || $page == 'tasks-completed' || $page == 'tasks-grid' || $page == 'tasks-onhold' || $page == 'tasks' || $page == 'teams-grid' || $page == 'teams' || $page == 'testimonials' || $page == 'user-tasks-grid' || $page == 'user-tasks') {   ?>
    <!-- Choices Js -->
    <script src="<?= Url::to('@web/assets/plugins/choices.js/public/assets/scripts/choices.min.js') ?>"></script>
<?php }?>

<?php  if ($page == 'add-invoice' || $page == 'appearance-settings' || $page == 'clients-grid' || $page == 'clients' || $page == 'company-settings' || $page == 'edit-invoice' || $page == 'edit-user' || $page == 'employee-settings' || $page =='free-trial-2' || $page =='free-trial-3' || $page =='free-trial' || $page =='invoice-details' || $page == 'location-settings' || $page =='plans-and-billings' || $page == 'plugin' || $page =='profile-settings' || $page == 'security-settings' || $page == 'user-profile-settings' || $page == 'user-security-settings') {   ?>
    <!-- intel Input -->
    <script src="<?= Url::to('@web/assets/plugins/intltelinput/js/intlTelInput.js') ?>"></script>
<?php }?>

<?php  if ($page == 'email-compose' || $page == 'email-details' || $page == 'file-manager' || $page == 'form-editors' || $page == 'kanban-view' || $page == 'notes' || $page == 'pages' || $page == 'plugin' || $page == 'reports' || $page == 'todo-list' || $page == 'todo') {   ?>
    <!-- Quill Editor JS -->
    <script src="<?= Url::to('@web/assets/plugins/quill/quill.core.js') ?>"></script>

    <!-- Quill JS -->
    <script src="<?= Url::to('@web/assets/js/form-quill.js') ?>"></script>
<?php }?>

<?php  if ($page == 'email-compose' || $page == 'email-details' || $page == 'employee-details' || $page == 'plugin' || $page == 'project-details-screenshots' || $page == 'screenshots' || $page == 'social-feed' || $page == 'timeline-details' ||$page == 'user-timeline-screenshots') {   ?>
    <!-- Fancybox JS -->
    <script src="<?= Url::to('@web/assets/plugins/fancybox/jquery.fancybox.min.js') ?>"></script>
<?php }?>

<?php  if ($page == 'gallery' || $page == 'plugin' || $page == 'search-results' || $page == 'social-feed' || $page == 'ui-lightbox') {   ?>
    <!-- Glightbox JS -->
    <script src="<?= Url::to('@web/assets/plugins/lightbox/glightbox.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/lightbox/lightbox.js') ?>"></script>
<?php }?>

<?php  if ($page == 'project-details-milestones-grid' || $page == 'project-details-milestones' || $page == 'project-details-screenshots' || $page == 'project-details-task-list' || $page == 'project-details-task' || $page == 'project-details-usage' || $page == 'tasks-grid' || $page == 'user-tasks-grid' || $page == 'user-tasks') {   ?>
    <!-- drag card -->
    <script src="<?= Url::to('@web/assets/js/jquery-ui.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/js/jquery.ui.touch-punch.min.js') ?>"></script>
<?php }?>

<?php  if ($page == 'kanban-view' || $page == 'plugin' || $page == 'tasks-grid' || $page == 'ui-dragula' || $page == 'user-tasks-grid' || $page == 'user-tasks') {   ?>
    <!-- Dragula Js-->
    <script src="<?= Url::to('@web/assets/plugins/dragula/dragula.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/js/dragula.js') ?>"></script>
<?php }?>

<?php  if ($page == 'video-call' || $page == 'plugin') {   ?>
    <!-- Swiper JS -->
    <script src="<?= Url::to('@web/assets/plugins/swiper/swiper-bundle.min.js') ?>"></script>
<?php }?>

<?php  if ($page !== 'coming-soon' && $page !== 'under-maintenance' && $page !== 'under-construction' && $page !== 'login' && $page !== 'login-2' && $page !== 'login-3' && $page !== 'register' && $page !== 'register-2' && $page !== 'register-3' && $page !== 'forgot-password' && $page !== 'forgot-password-2' && $page !== 'forgot-password-3' && $page !== 'reset-password' && $page !== 'reset-password-2' && $page !== 'reset-password-3' && $page !== 'email-verification' && $page !== 'email-verification-2' && $page !== 'email-verification-3' && $page !== 'two-step-verification' && $page !== 'two-step-verification-2' && $page !== 'two-step-verification-3' && $page !== 'lock-screen' && $page !== 'error-404' && $page !== 'error-500' && $page !== 'success' && $page !== 'success-2' && $page !== 'success-3') {   ?>
    <!-- Select2 JS -->
    <script src="<?= Url::to('@web/assets/plugins/select2/js/select2.min.js') ?>"></script>
<?php }?>

<?php  if ($page == 'file-manager' || $page == 'notes' || $page == 'social-feed') {   ?>
    <!-- Sticky Sidebar JS -->
    <script src="<?= Url::to('@web/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') ?>"></script>
<?php }?>

<?php  if ($page == 'employee-details' || $page == 'plugin') {   ?>
    <!-- Peity Chart JS -->
    <script src="<?= Url::to('@web/assets/plugins/peity/jquery.peity.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/peity/chart-data.js') ?>"></script>
<?php }?>

<?php  if ($page == 'activity-summary' || $page == 'add-project' || $page == 'attendance-report' || $page == 'attendance' || $page == 'chart-apex' || $page == 'edit-project' || $page == 'employee-details' || $page == 'hours-tracked' || $page == 'index' || $page == 'invoice' || $page =='layout-dark' || $page =='layout-fullwidth' || $page =='layout-hidden' || $page =='layout-hoverview' || $page =='layout-mini' || $page =='layout-rtl' || $page == 'live-tracking' || $page == 'live-tracking-minute' || $page == 'low-activity' || $page == 'plugin' || $page == 'poor-time-use' || $page == 'project-archived' || $page == 'project-cmpleted' || $page == 'project-details-milestones' || $page == 'project-details-milestones' || $page == 'project-details-screenshots' || $page == 'projeect-details-task-list' || $page == 'project-details-task' || $page == 'project-details-usage' || $page == 'project-details' || $page == 'project-hold' || $page == 'project' || $page == 'projects-grid' || $page == 'projects' || $page == 'timesheet-report' || $page == 'timesheet-week' || $page == 'timesheet' || $page == 'unusual-activiyty' || $page == 'usage-timeline-details' || $page == 'user-dashboard' || $page == 'user-timeline-usage' || $page == 'web-app-usage' || $page == 'widgets') {   ?>
    <!-- ApexChart JS -->
    <script src="<?= Url::to('@web/assets/plugins/apexchart/apexcharts.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/apexchart/chart-data.js') ?>"></script>
<?php }?>

<?php  if ($page == 'chart-c3' || $page == 'plugin') {   ?>
    <!-- Chart JS -->
    <script src="<?= Url::to('@web/assets/plugins/c3-chart/d3.v5.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/c3-chart/c3.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/c3-chart/chart-data.js') ?>"></script>
<?php }?>

<?php  if ($page == 'chart-flot') {   ?>
    <!-- Chart JS -->
    <script src="<?= Url::to('@web/assets/plugins/flot/jquery.flot.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/flot/jquery.flot.fillbetween.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/flot/jquery.flot.pie.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/flot/chart-data.js') ?>"></script>
<?php }?>

<?php  if ($page == 'chart-js' || $page == 'index' || $page =='layout-dark' || $page =='layout-fullwidth' || $page =='layout-hidden' || $page =='layout-hoverview' || $page =='layout-mini' || $page =='layout-rtl' || $page == 'plugin') {   ?>
    <!-- Chart JS -->
    <script src="<?= Url::to('@web/assets/plugins/chartjs/chart.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/chartjs/chart-data.js') ?>"></script>
<?php }?>

<?php  if ($page == 'chart-morris' || $page == 'plugin') {   ?>
    <!-- Chart JS -->
    <script src="<?= Url::to('@web/assets/plugins/morris/raphael-min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/morris/morris.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/morris/chart-data.js') ?>"></script>
<?php }?>

<?php  if ($page == 'form-fileupload' || $page == 'plugin') {   ?>
    <!-- Dropzone File Js -->
    <script src="<?= Url::to('@web/assets/plugins/dropzone/dropzone.js') ?>"></script>

    <!-- File Upload js -->
    <script src="<?= Url::to('@web/assets/js/form-fileupload.js') ?>"></script>
<?php }?>

<?php  if ($page == 'form-mask' || $page == 'plugin') {   ?>
	<!-- Inputmask JS -->
	<script src="<?= Url::to('@web/assets/plugins/inputmask/inputmask.min.js') ?>"></script>
<?php }?>

<?php  if ($page == 'plugin' || $page == 'ui-clipboard') {   ?>
    <!-- Clipboard JS -->
    <script src="<?= Url::to('@web/assets/plugins/clipboard/clipboard.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/js/clipboard.js') ?>"></script>
<?php }?>

<?php  if ($page == 'plugin' || $page == 'ui-pagination') {   ?>
	<!-- Iconify JS -->
	<script src="<?= Url::to('@web/assets/plugins/iconify-icon/iconify-icon.min.js') ?>"></script>

	<!-- Lucide JS -->
	<script src="<?= Url::to('@web/assets/plugins/lucide/umd/lucide.min.js') ?>"></script>
<?php }?>

<?php  if ($page == 'plugin' || $page == 'ui-rangeslider') {   ?>
    <!-- noUiSlider js -->
    <script src="<?= Url::to('@web/assets/plugins/nouislider/nouislider.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/plugins/wnumb/wNumb.min.js') ?>"></script>

    <!-- Rangeslider JS -->
    <script src="<?= Url::to('@web/assets/js/range-slider.js') ?>"></script>
<?php }?>

<?php  if ($page == 'plugin' || $page == 'ui-rating') {   ?>
    <!-- Rater JS -->
    <script src="<?= Url::to('@web/assets/plugins/rater-js/index.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/js/ratings.js') ?>"></script>
<?php }?>

<?php  if ($page == 'plugin' || $page == 'ui-sweetalerts') {   ?>
    <!-- Sweet Alerts js -->
    <script src="<?= Url::to('@web/assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= Url::to('@web/assets/js/sweetalerts.js') ?>"></script>
<?php }?>

<?php  if ($page == 'chat') {   ?>
    <!-- Chat JS -->
	<script src="<?= Url::to('@web/assets/js/chat.js') ?>"></script>
<?php }?>

<?php  if ($page == 'coming-soon') {   ?>
    <!-- Comingsoon JS -->
    <script src="<?= Url::to('@web/assets/js/coming-soon.js') ?>"></script>
<?php }?>

<?php  if ($page == 'contact-list' || $page == 'contacts' || $page == 'email') {   ?>
    <!-- Email JS -->
    <script src="<?= Url::to('@web/assets/js/email.js') ?>"></script>
<?php }?>

<?php  if ($page == 'email-verification-2' || $page == 'email-verification-3' || $page == 'email-verification' || $page == 'two-step-verification-2' || $page == 'two-step-verification-3' || $page == 'two-step-verification') {   ?>
	<!-- OTP JS -->
	<script src="<?= Url::to('@web/assets/js/otp.js') ?>"></script>
<?php }?>

<?php  if ($page == 'social-feed') {   ?>
    <!-- Socialfeed JS -->
    <script src="<?= Url::to('@web/assets/js/social-feed.js') ?>"></script>
<?php }?>

    <!-- Main JS -->
    <script src="<?= Url::to('@web/assets/js/script.js') ?>"></script>
