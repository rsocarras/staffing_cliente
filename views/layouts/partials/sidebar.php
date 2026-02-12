<?php
use yii\helpers\Html;
use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
// Handle root path - if empty, treat as index page
$page = empty($path) ? 'index' : basename($path);
?>

    <!-- Sidenav Menu Start -->
    <div class="sidebar" id="sidebar">

        <!-- Start Logo -->
        <div class="sidebar-logo">

            <!-- Logo Normal -->
            <a href="index" class="logo logo-normal">
                <img src="assets/img/logo.svg" alt="Logo">
            </a>

            <!-- Logo Small -->
            <a href="index" class="logo-small">
                <img src="assets/img/logo-small.svg" alt="Logo">
            </a>

            <!-- Logo Dark -->
            <a href="index" class="dark-logo">
                <img src="assets/img/logo-white.svg" alt="Logo">
            </a>

            <!-- Sidebar Menu Close -->
            <button class="sidebar-close">
                <i class="ti ti-x align-middle"></i>
            </button>

        </div>
        <!-- End Logo -->

        <?php if (
            $page != 'user-dashboard' && $page != 'user-timesheet' && $page != 'user-attendance' && $page != 'user-leave-approved'
            && $page != 'user-leave-rejected' && $page != 'user-leave-pending'
            && $page != 'user-projects' && $page != 'user-tasks' && $page != 'user-tasks' && $page != 'user-timesheet-report'
            && $page != 'user-attendance-report' && $page != 'user-activity-summary' && $page != 'user-unusual-activity'
            && $page != 'user-hours-tracked-report' && $page != 'user-projects-and-tasks' && $page != 'user-timeline-report'
            && $page != 'user-manual-time-report' && $page != 'user-poor-time-use-report' && $page != 'user-web-and-app-usage'
            && $page != 'user-low-activity-report' && $page != 'user-idle-time-report' && $page != 'user-overlimit-time-report'
            && $page != 'user-working-on-weekends' && $page != 'user-profile-settings' && $page != 'user-security-settings'
            && $page != 'user-tasks-grid' && $page != 'user-teams-settings' && $page != 'user-timeline-screenshots' && $page != 'user-timeline-usage' && $page != 'user-timeline-week'
            && $page != 'user-timesheet-month' && $page != 'user-timesheet-week' && $page != 'user-timesheet-year'
            && $page != 'user-timesheet-report' && $page != 'user-attendance-report' && $page != 'user-activity-summary' && $page != 'user-unusual-activity'
            && $page != 'user-hours-tracked-report' && $page != 'user-projects-and-tasks' && $page != 'user-timeline-report'
            && $page != 'user-manual-time-report' && $page != 'user-poor-time-use-report' && $page != 'user-web-and-app-usage'
            && $page != 'user-low-activity-report' && $page != 'user-idle-time-report' && $page != 'user-overlimit-time-report'
            && $page != 'user-working-on-weekends' && $page != 'user-hours-tracked-month' && $page != 'user-hours-tracked-week'
            && $page != 'user-manual-time-report-month' && $page != 'user-manual-time-report-week' && $page != 'user-timeline-screenshots' && $page != 'user-timeline-usage' && $page != 'user-timeline-week'
            && $page != 'user-poor-time-use-report-month' && $page != 'user-poor-time-use-report-week' && $page != 'user-activity-summary-month' && $page != 'user-activity-summary-week'
            && $page != 'user-attendance-report-month' && $page != 'user-attendance-report-week' && $page != 'user-security-settings' && $page != 'user-teams-settings'
            && $page != 'user-manual-time-month' && $page != 'user-manual-time-week'
        ) { ?>
            <!--- Sidenav Menu -->
            <div class="sidebar-inner" data-simplebar>
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title"><span>Main</span></li>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="<?php echo ($page == 'index') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-layout-grid-add"></i><span>Dashboard</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="index" class="<?php echo ($page == 'index') ? 'active' : ''; ?>">Admin
                                        Dashboard</a></li>
                                <li><a href="user-dashboard">User Dashboard</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="<?php echo ($page == 'projects' || $page == 'chat' || $page == 'calendar' || $page == 'invoices' || $page == 'add-invoice' || $page == 'file-manager' || $page == 'notes'
                                || $page == 'todo' || $page == 'kanban-view' || $page == 'social-feed' || $page == 'email' || $page == 'contacts' || $page == 'contact-list'
                                || $page == 'video-call' || $page == 'voice-call' || $page == 'edit-invoice' || $page == 'email-compose' || $page == 'email-details' || $page == 'invoice-details'
                                || $page == 'projects-grid') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-layout-list"></i><span>Applications</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="projects"
                                        class="<?php echo ($page == 'projects' || $page == 'projects-grid') ? 'active' : ''; ?>">Projects</a>
                                </li>
                                <li><a href="chat" class="<?php echo ($page == 'chat') ? 'active' : ''; ?>">Chat</a>
                                </li>
                                <li><a href="calendar"
                                        class="<?php echo ($page == 'calendar') ? 'active' : ''; ?>">Calendar</a></li>
                                <li><a href="invoices"
                                        class="<?php echo ($page == 'invoices' || $page == 'add-invoice' || $page == 'edit-invoice' || $page == 'invoice-details') ? 'active' : ''; ?>">Invoices</a>
                                </li>
                                <li><a href="file-manager"
                                        class="<?php echo ($page == 'file-manager') ? 'active' : ''; ?>">File Manager</a>
                                </li>
                                <li><a href="notes" class="<?php echo ($page == 'notes') ? 'active' : ''; ?>">Notes</a>
                                </li>
                                <li><a href="todo"
                                        class="<?php echo ($page == 'todo' || $page == 'todo-list') ? 'active' : ''; ?>">To
                                        Do</a>
                                </li>
                                <li><a href="kanban-view"
                                        class="<?php echo ($page == 'kanban-view') ? 'active' : ''; ?>">Kanban Board</a>
                                </li>
                                <li><a href="social-feed"
                                        class="<?php echo ($page == 'social-feed') ? 'active' : ''; ?>">Social Feed</a></li>
                                <li><a href="email"
                                        class="<?php echo ($page == 'email' || $page == 'email-compose' || $page == 'email-details') ? 'active' : ''; ?>">Email</a>
                                </li>
                                <li><a href="contacts"
                                        class="<?php echo ($page == 'contacts' || $page == 'contact-list') ? 'active' : ''; ?>">Contacts</a>
                                </li>
                                <li><a href="video-call"
                                        class="<?php echo ($page == 'video-call') ? 'active' : ''; ?>">Video Call</a></li>
                                <li><a href="voice-call"
                                        class="<?php echo ($page == 'voice-call') ? 'active' : ''; ?>">Voice Call</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'layout-mini' || $page == 'layout-hoverview' || $page == 'layout-hidden' || $page == 'layout-fullwidth' || $page == 'layout-rtl' || $page == 'layout-dark') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-layout-board-split"></i><span>Layouts</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="layout-mini"
                                        class="<?php echo ($page == 'layout-mini') ? 'active' : ''; ?>">Mini Sidebar</a>
                                </li>
                                <li>
                                    <a href="layout-hoverview"
                                        class="<?php echo ($page == 'layout-hoverview') ? 'active' : ''; ?>">Hover View</a>
                                </li>
                                <li>
                                    <a href="layout-hidden"
                                        class="<?php echo ($page == 'layout-hidden') ? 'active' : ''; ?>">Hidden Menu</a>
                                </li>
                                <li>
                                    <a href="layout-fullwidth"
                                        class="<?php echo ($page == 'layout-fullwidth') ? 'active' : ''; ?>">Full Width</a>
                                </li>
                                <li>
                                    <a href="layout-rtl"
                                        class="<?php echo ($page == 'layout-rtl') ? 'active' : ''; ?>">RTL Support</a>
                                </li>
                                <li>
                                    <a href="layout-dark"
                                        class="<?php echo ($page == 'layout-dark') ? 'active' : ''; ?>">Dark Mode</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="https://dreamstimer.dreamstechnologies.com/saas-landing/index.html" target="_blank">
                                <i class="ti ti-brand-pagekit"></i><span>Sass Landing</span>
                            </a>
                        </li>                
                        <li class="menu-title"><span>Track</span></li>
                        <li>
                            <a href="live-tracking" class="<?php echo ($page == 'live-tracking' || $page == 'live-tracking-minute') ? 'active' : ''; ?>">
                                <i class="ti ti-chart-infographic"></i><span>Live Tracking</span><span class="track-icon"></span>
                            </a>
                        </li>
                        <li>
                            <a href="timesheet"
                                class="<?php echo ($page == 'timesheet' || $page == 'timesheet-week') ? 'active' : ''; ?>">
                                <i class="ti ti-calendar-time"></i><span>Timesheet</span>
                            </a>
                        </li>
                        <li>
                            <a href="leave"
                                class="<?php echo ($page == 'leave' || $page == 'leave-approved' || $page == 'leave-rejected') ? 'active' : ''; ?>">
                                <i class="ti ti-beach"></i><span>Leave</span>
                            </a>
                        </li>
                        <li>
                            <a href="attendance" class="<?php echo ($page == 'attendance') ? 'active' : ''; ?>">
                                <i class="ti ti-user-check"></i><span>Attendance</span>
                            </a>
                        </li>
                        <li>
                            <a href="expense" class="<?php echo ($page == 'expense' || $page == 'expense-approved' || $page == 'expense-rejected' || $page == 'expense-requested'
                                || $page == 'expense') ? 'active' : ''; ?>">
                                <i class="ti ti-receipt-2"></i><span>Expense</span>
                            </a>
                        </li>
                        <li class="menu-title"><span>Manage</span></li>
                        <li>
                            <a href="project" class="<?php echo ($page == 'project' || $page == 'add-project' || $page == 'edit-project' || $page == 'project-archived'
                                || $page == 'project-completed' || $page == 'project-details-milestones-grid' || $page == 'project-details-milestones'
                                || $page == 'project-details-screenshots' || $page == 'project-details-task-list' || $page == 'project-details-task' || $page == 'project-details-usage' || $page == 'project-details'
                                || $page == 'project-hold' || $page == 'project') ? 'active' : ''; ?>">
                                <i class="ti ti-briefcase"></i><span>Projects</span>
                            </a>
                        </li>
                        <li>
                            <a href="tasks"
                                class="<?php echo ($page == 'tasks' || $page == 'tasks-archived' || $page == 'tasks-completed' || $page == 'tasks-onhold' || $page == 'tasks-grid') ? 'active' : ''; ?>">
                                <i class="ti ti-checklist"></i><span>Tasks</span>
                            </a>
                        </li>
                        <li>
                            <a href="screenshots" class="<?php echo ($page == 'screenshots') ? 'active' : ''; ?>">
                                <i class="ti ti-camera"></i><span>Screenshots</span>
                            </a>
                        </li>
                        <li>
                            <a href="edit-time"
                                class="<?php echo ($page == 'edit-time' || $page == 'edit-shift' || $page == 'edit-time-approved' || $page == 'edit-time-request' || $page == 'edit-time-waiting') ? 'active' : ''; ?>">
                                <i class="ti ti-clock-edit"></i><span>Edit Time</span>
                            </a>
                        </li>
                        <li>
                            <a href="download" class="<?php echo ($page == 'download') ? 'active' : ''; ?>">
                                <i class="ti ti-download"></i><span>Download</span>
                            </a>
                        </li>
                        <li class="menu-title"><span>Workforce</span></li>
                        <li>
                            <a href="employees"
                                class="<?php echo ($page == 'employees' || $page == 'employees-grid' || $page == 'employee-details' || $page == 'employees-deactivated' || $page == 'employees-archived') ? 'active' : ''; ?>">
                                <i class="ti ti-user-bolt"></i><span>Employees</span><span class="track-icon"></span>
                            </a>
                        </li>
                        <li>
                            <a href="teams"
                                class="<?php echo ($page == 'teams' || $page == 'teams-grid') ? 'active' : ''; ?>">
                                <i class="ti ti-users-group"></i><span>Teams</span>
                            </a>
                        </li>
                        <li>
                            <a href="clients"
                                class="<?php echo ($page == 'clients' || $page == 'clients-grid') ? 'active' : ''; ?>">
                                <i class="ti ti-users"></i><span>Clients</span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'users' || $page == 'edit-user' || $page == 'invite-users' || $page == 'user-archived' || $page == 'user-invite-status'
                                    || $page == 'roles-permissions' || $page == 'permissions') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-user-plus"></i><span>Users</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="users"
                                        class="<?php echo ($page == 'users' || $page == 'edit-user' || $page == 'invite-users' || $page == 'user-archived' || $page == 'user-invite-status') ? 'active' : ''; ?>">Users</a>
                                </li>
                                <li>
                                    <a href="roles-permissions"
                                        class="<?php echo ($page == 'roles-permissions' || $page == 'permissions') ? 'active' : ''; ?>">Roles
                                        &
                                        Permissions</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="activity-logs" class="<?php echo ($page == 'activity-logs') ? 'active' : ''; ?>">
                                <i class="ti ti-topology-bus"></i><span>Activity Logs</span>
                            </a>
                        </li>
                        <li class="menu-title"><span>Administrator</span></li>
                        <li>
                            <a href="notifications" class="<?php echo ($page == 'notifications') ? 'active' : ''; ?>">
                                <i class="ti ti-bell-down"></i><span>Notifications</span>
                            </a>
                        </li>
                        <li>
                            <a href="invoice" class="<?php echo ($page == 'invoice') ? 'active' : ''; ?>">
                                <i class="ti ti-file-invoice"></i><span>Invoices</span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'reports' || $page == 'timesheet-report' || $page == 'attendance-report' || $page == 'activity-summary' || $page == 'activity-summary-month' || $page == 'activity-summary-week'
                                    || $page == 'unusual-activity' || $page == 'hours-tracked' || $page == 'projects-tasks' || $page == 'timeline-report' || $page == 'manual-time' || $page == 'manual-time-week' || $page == 'poor-time-use'
                                    || $page == 'web-app-usage' || $page == 'low-activity' || $page == 'idle-time' || $page == 'overtime-limit' || $page == 'working-on-weekends' || $page == 'expense-report'
                                    || $page == 'attendance-report-month' || $page == 'attendance-report-week' || $page == 'hours-tracked-month' || $page == 'hours-tracked-week' || $page == 'poor-time-month'
                                    || $page == 'poor-time-week' || $page == 'poor-time-use' || $page == 'timesheet-report-week' || $page == 'timesheet-report-weekly') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-report-analytics"></i><span>Reports</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="reports"
                                        class="<?php echo ($page == 'reports') ? 'active' : ''; ?>">Reports</a>
                                </li>
                                <li>
                                    <a href="timesheet-report"
                                        class="<?php echo ($page == 'timesheet-report' || $page == 'timesheet-report-week') ? 'active' : ''; ?>">Timesheets</a>
                                </li>
                                <li>
                                    <a href="attendance-report"
                                        class="<?php echo ($page == 'attendance-report' || $page == 'attendance-report-month' || $page == 'attendance-report-week') ? 'active' : ''; ?>">Attendance</a>
                                </li>
                                <li>
                                    <a href="activity-summary" class="<?php echo ($page == 'activity-summary' || $page == 'activity-summary-month' || $page == 'activity-summary-week'
                                        || $page == 'activity-summary-year') ? 'active' : ''; ?>">Activity
                                        Summary</a>
                                </li>
                                <li>
                                    <a href="unusual-activity"
                                        class="<?php echo ($page == 'unusual-activity') ? 'active' : ''; ?>">Unusual
                                        Activity</a>
                                </li>
                                <li>
                                    <a href="hours-tracked"
                                        class="<?php echo ($page == 'hours-tracked' || $page == 'hours-tracked-month' || $page == 'hours-tracked-week') ? 'active' : ''; ?>">Hours
                                        Tracked</a>
                                </li>
                                <li>
                                    <a href="projects-tasks"
                                        class="<?php echo ($page == 'projects-tasks') ? 'active' : ''; ?>">Projects &
                                        Tasks</a>
                                </li>
                                <li>
                                    <a href="timeline-report"
                                        class="<?php echo ($page == 'timeline-report' || $page == 'timeline-details' || $page == 'usage-timeline-details') ? 'active' : ''; ?>">Timeline</a>
                                </li>
                                <li>
                                    <a href="manual-time"
                                        class="<?php echo ($page == 'manual-time' || $page == 'manual-time-week') ? 'active' : ''; ?>">Manual
                                        Time</a>
                                </li>
                                <li>
                                    <a href="poor-time-use"
                                        class="<?php echo ($page == 'poor-time-use' || $page == 'poor-time-week' || $page == 'poor-time-month') ? 'active' : ''; ?>">Poor
                                        Time Use</a>
                                </li>
                                <li>
                                    <a href="web-app-usage"
                                        class="<?php echo ($page == 'web-app-usage') ? 'active' : ''; ?>">Web & App
                                        Usage</a>
                                </li>
                                <li>
                                    <a href="low-activity"
                                        class="<?php echo ($page == 'low-activity') ? 'active' : ''; ?>">Low Activity</a>
                                </li>
                                <li>
                                    <a href="idle-time"
                                        class="<?php echo ($page == 'idle-time') ? 'active' : ''; ?>">Idle Time</a>
                                </li>
                                <li>
                                    <a href="overtime-limit"
                                        class="<?php echo ($page == 'overtime-limit') ? 'active' : ''; ?>">Overtime
                                        Limit</a>
                                </li>
                                <li>
                                    <a href="working-on-weekends"
                                        class="<?php echo ($page == 'working-on-weekends') ? 'active' : ''; ?>">Working on
                                        Weekends</a>
                                </li>
                                <li>
                                    <a href="expense-report"
                                        class="<?php echo ($page == 'expense-report') ? 'active' : ''; ?>">Expense
                                        Report</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="profile-settings" class="<?php echo ($page == 'profile-settings' || $page == 'company-settings' || $page == 'leave-types-settings' || $page == 'leave-types' || $page == 'expense-category-settings'
                                || $page == 'localization-settings' || $page == 'plans-and-billings' || $page == 'delete-account' || $page == 'appearance-settings'
                                || $page == 'currencies-settings' || $page == 'custom-fields-settings' || $page == 'department-settings' || $page == 'employee-settings' || $page == 'expense-type-settings'
                                || $page == 'integrations-settings' || $page == 'location-settings' || $page == 'notifications-settings' || $page == 'payment-method-settings'
                                || $page == 'preference-settings' || $page == 'productivity-ratings-settings' || $page == 'project-settings' || $page == 'security-settings'
                                || $page == 'shift-settings' || $page == 'shifts-leave-types' || $page == 'taxes-settings' || $page == 'tracker-settings'
                                || $page == 'working-hours-settings') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-settings-cog"></i><span>Settings</span>
                            </a>
                        </li>
                        <li class="menu-title"><span>Content</span></li>
                        <li>
                            <a href="pages" class="<?php echo ($page == 'pages') ? 'active' : ''; ?>">
                                <i class="ti ti-file-description"></i><span>Pages</span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'blogs' || $page == 'blog-categories' || $page == 'blog-tags' || $page == 'blog-comments' || $page == 'blog-detail') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-notes"></i><span>Blogs</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="blogs"
                                        class="<?php echo ($page == 'blogs' || $page == 'blog-detail') ? 'active' : ''; ?>">Blogs</a>
                                </li>
                                <li>
                                    <a href="blog-categories"
                                        class="<?php echo ($page == 'blog-categories') ? 'active' : ''; ?>">Blog
                                        Categories</a>
                                </li>
                                <li>
                                    <a href="blog-tags"
                                        class="<?php echo ($page == 'blog-tags') ? 'active' : ''; ?>">Blog Tags</a>
                                </li>
                                <li>
                                    <a href="blog-comments"
                                        class="<?php echo ($page == 'blog-comments') ? 'active' : ''; ?>">Blog Comments</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'countries' || $page == 'states' || $page == 'cities') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-map-pin"></i><span>Locations</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="countries"
                                        class="<?php echo ($page == 'countries') ? 'active' : ''; ?>">Countries</a>
                                </li>
                                <li>
                                    <a href="states"
                                        class="<?php echo ($page == 'states') ? 'active' : ''; ?>">States</a>
                                </li>
                                <li>
                                    <a href="cities"
                                        class="<?php echo ($page == 'cities') ? 'active' : ''; ?>">Cities</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="testimonials" class="<?php echo ($page == 'testimonials') ? 'active' : ''; ?>">
                                <i class="ti ti-message-dots"></i><span>Testimonials</span>
                            </a>
                        </li>
                        <li>
                            <a href="faq" class="<?php echo ($page == 'faq') ? 'active' : ''; ?>">
                                <i class="ti ti-help-circle"></i><span>FAQ's</span>
                            </a>
                        </li>
                        <li class="menu-title"><span>Pages</span></li>
                        <li>
                            <a href="starter" class="<?php echo ($page == 'starter') ? 'active' : ''; ?>">
                                <i class="ti ti-file-power"></i><span>Starter</span>
                            </a>
                        </li>
                        <li>
                            <a href="profile" class="<?php echo ($page == 'profile') ? 'active' : ''; ?>">
                                <i class="ti ti-user-circle"></i><span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <a href="gallery" class="<?php echo ($page == 'gallery') ? 'active' : ''; ?>">
                                <i class="ti ti-photo"></i><span>Gallery</span>
                            </a>
                        </li>
                        <li>
                            <a href="search-results" class="<?php echo ($page == 'search-results') ? 'active' : ''; ?>">
                                <i class="ti ti-search"></i><span>Search Results</span>
                            </a>
                        </li>
                        <li>
                            <a href="timeline" class="<?php echo ($page == 'timeline') ? 'active' : ''; ?>">
                                <i class="ti ti-timeline"></i><span>Timeline</span>
                            </a>
                        </li>
                        <li>
                            <a href="pricing" class="<?php echo ($page == 'pricing') ? 'active' : ''; ?>">
                                <i class="ti ti-currency-dollar"></i><span>Pricing</span>
                            </a>
                        </li>
                        <li>
                            <a href="coming-soon" class="<?php echo ($page == 'coming-soon') ? 'active' : ''; ?>">
                                <i class="ti ti-clock-hour-4"></i><span>Coming Soon</span>
                            </a>
                        </li>
                        <li>
                            <a href="under-maintenance"
                                class="<?php echo ($page == 'under-maintenance') ? 'active' : ''; ?>">
                                <i class="ti ti-tool"></i><span>Under Maintenance</span>
                            </a>
                        </li>
                        <li>
                            <a href="api-keys" class="<?php echo ($page == 'api-keys') ? 'active' : ''; ?>">
                                <i class="ti ti-key"></i><span>API Keys</span>
                            </a>
                        </li>
                        <li>
                            <a href="privacy-policy" class="<?php echo ($page == 'privacy-policy') ? 'active' : ''; ?>">
                                <i class="ti ti-shield-lock"></i><span>Privacy Policy</span>
                            </a>
                        </li>
                        <li>
                            <a href="terms-condition"
                                class="<?php echo ($page == 'terms-condition') ? 'active' : ''; ?>">
                                <i class="ti ti-scale"></i><span>Terms & Conditions</span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-alert-triangle"></i><span>Error Pages</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li>
                                    <a href="error-404">404 Error</a>
                                </li>
                                <li>
                                    <a href="error-500">500 Error</a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-title"><span>Authentication</span></li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-lock"></i><span>Login</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="login">Cover</a></li>
                                <li><a href="login-2">Illustration</a></li>
                                <li><a href="login-3">Basic</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-user-cog"></i><span>Register</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="register">Cover</a></li>
                                <li><a href="register-2">Illustration</a></li>
                                <li><a href="register-3">Basic</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-crown"></i><span>Free Trail</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="free-trial">Cover</a></li>
                                <li><a href="free-trial-2">Illustration</a></li>
                                <li><a href="free-trial-3">Basic</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-help-triangle"></i><span>Forgot Password</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="forgot-password">Cover</a></li>
                                <li><a href="forgot-password-2">Illustration</a></li>
                                <li><a href="forgot-password-3">Basic</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-arrow-forward-up-double"></i><span>Reset Password</span><span
                                    class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="reset-password">Cover</a></li>
                                <li><a href="reset-password-2">Illustration</a></li>
                                <li><a href="reset-password-3">Basic</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-mail"></i><span>Email Verification</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="email-verification">Cover</a></li>
                                <li><a href="email-verification-2">Illustration</a></li>
                                <li><a href="email-verification-3">Basic</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-checklist"></i><span>2 Step Verification</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="two-step-verification">Cover</a></li>
                                <li><a href="two-step-verification-2">Illustration</a></li>
                                <li><a href="two-step-verification-3">Basic</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="lock-screen" class="<?php echo ($page == 'lock-screen') ? 'active' : ''; ?>">
                                <i class="ti ti-layout-navbar-collapse"></i><span>Lock Screen</span>
                            </a>
                        </li>
                        <li class="menu-title"><span>UI Interface</span></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'ui-accordion' || $page == 'ui-alerts' || $page == 'ui-avatar' || $page == 'ui-badges' || $page == 'ui-breadcrumb' || $page == 'ui-buttons' || $page == 'ui-buttons-group' || $page == 'ui-cards' || $page == 'ui-carousel' || $page == 'ui-collapse' || $page == 'ui-dropdowns' || $page == 'ui-ratio' || $page == 'ui-grid' || $page == 'ui-images' || $page == 'ui-links' || $page == 'ui-list-group' || $page == 'ui-modals' || $page == 'ui-offcanvas' || $page == 'ui-pagination' || $page == 'ui-placeholders' || $page == 'ui-popovers' || $page == 'ui-progress' || $page == 'ui-scrollspy' || $page == 'ui-spinner' || $page == 'ui-nav-tabs' || $page == 'ui-toasts' || $page == 'ui-tooltips' || $page == 'ui-typography' || $page == 'ui-utilities') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-hierarchy"></i><span>Base UI</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="ui-accordion"
                                        class="<?php echo ($page == 'ui-accordion') ? 'active' : ''; ?>">Accordion</a></li>
                                <li><a href="ui-alerts"
                                        class="<?php echo ($page == 'ui-alerts') ? 'active' : ''; ?>">Alerts</a></li>
                                <li><a href="ui-avatar"
                                        class="<?php echo ($page == 'ui-avatar') ? 'active' : ''; ?>">Avatar</a></li>
                                <li><a href="ui-badges"
                                        class="<?php echo ($page == 'ui-badges') ? 'active' : ''; ?>">Badges</a></li>
                                <li><a href="ui-breadcrumb"
                                        class="<?php echo ($page == 'ui-breadcrumb') ? 'active' : ''; ?>">Breadcrumb</a>
                                </li>
                                <li><a href="ui-buttons"
                                        class="<?php echo ($page == 'ui-buttons') ? 'active' : ''; ?>">Buttons</a></li>
                                <li><a href="ui-buttons-group"
                                        class="<?php echo ($page == 'ui-buttons-group') ? 'active' : ''; ?>">Button
                                        Group</a>
                                </li>
                                <li><a href="ui-cards"
                                        class="<?php echo ($page == 'ui-cards') ? 'active' : ''; ?>">Card</a></li>
                                <li><a href="ui-carousel"
                                        class="<?php echo ($page == 'ui-carousel') ? 'active' : ''; ?>">Carousel</a></li>
                                <li><a href="ui-collapse"
                                        class="<?php echo ($page == 'ui-collapse') ? 'active' : ''; ?>">Collapse</a></li>
                                <li><a href="ui-dropdowns"
                                        class="<?php echo ($page == 'ui-dropdowns') ? 'active' : ''; ?>">Dropdowns</a></li>
                                <li><a href="ui-ratio"
                                        class="<?php echo ($page == 'ui-ratio') ? 'active' : ''; ?>">Ratio</a></li>
                                <li><a href="ui-grid"
                                        class="<?php echo ($page == 'ui-grid') ? 'active' : ''; ?>">Grid</a></li>
                                <li><a href="ui-images"
                                        class="<?php echo ($page == 'ui-images') ? 'active' : ''; ?>">Images</a></li>
                                <li><a href="ui-links"
                                        class="<?php echo ($page == 'ui-links') ? 'active' : ''; ?>">Links</a></li>
                                <li><a href="ui-list-group"
                                        class="<?php echo ($page == 'ui-list-group') ? 'active' : ''; ?>">List Group</a>
                                </li>
                                <li><a href="ui-modals"
                                        class="<?php echo ($page == 'ui-modals') ? 'active' : ''; ?>">Modals</a></li>
                                <li><a href="ui-offcanvas"
                                        class="<?php echo ($page == 'ui-offcanvas') ? 'active' : ''; ?>">Offcanvas</a></li>
                                <li><a href="ui-pagination"
                                        class="<?php echo ($page == 'ui-pagination') ? 'active' : ''; ?>">Pagination</a>
                                </li>
                                <li><a href="ui-placeholders"
                                        class="<?php echo ($page == 'ui-placeholders') ? 'active' : ''; ?>">Placeholders</a>
                                </li>
                                <li><a href="ui-popovers"
                                        class="<?php echo ($page == 'ui-popovers') ? 'active' : ''; ?>">Popovers</a></li>
                                <li><a href="ui-progress"
                                        class="<?php echo ($page == 'ui-progress') ? 'active' : ''; ?>">Progress</a></li>
                                <li><a href="ui-scrollspy"
                                        class="<?php echo ($page == 'ui-scrollspy') ? 'active' : ''; ?>">Scrollspy</a></li>
                                <li><a href="ui-spinner"
                                        class="<?php echo ($page == 'ui-spinner') ? 'active' : ''; ?>">Spinner</a></li>
                                <li><a href="ui-nav-tabs"
                                        class="<?php echo ($page == 'ui-nav-tabs') ? 'active' : ''; ?>">Tabs</a></li>
                                <li><a href="ui-toasts"
                                        class="<?php echo ($page == 'ui-toasts') ? 'active' : ''; ?>">Toasts</a></li>
                                <li><a href="ui-tooltips"
                                        class="<?php echo ($page == 'ui-tooltips') ? 'active' : ''; ?>">Tooltips</a></li>
                                <li><a href="ui-typography"
                                        class="<?php echo ($page == 'ui-typography') ? 'active' : ''; ?>">Typography</a>
                                </li>
                                <li><a href="ui-utilities"
                                        class="<?php echo ($page == 'ui-utilities') ? 'active' : ''; ?>">Utilities</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'ui-dragula' || $page == 'ui-clipboard' || $page == 'ui-rangeslider' || $page == 'ui-sweetalerts' || $page == 'ui-lightbox' || $page == 'ui-rating' || $page == 'ui-scrollbar') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-whirl"></i><span>Advanced UI</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="ui-dragula"
                                        class="<?php echo ($page == 'ui-dragula') ? 'active' : ''; ?>">Dragula</a></li>
                                <li><a href="ui-clipboard"
                                        class="<?php echo ($page == 'ui-clipboard') ? 'active' : ''; ?>">Clipboard</a></li>
                                <li><a href="ui-rangeslider"
                                        class="<?php echo ($page == 'ui-rangeslider') ? 'active' : ''; ?>">Range Slider</a>
                                </li>
                                <li><a href="ui-sweetalerts"
                                        class="<?php echo ($page == 'ui-sweetalerts') ? 'active' : ''; ?>">Sweet Alerts</a>
                                </li>
                                <li><a href="ui-lightbox"
                                        class="<?php echo ($page == 'ui-lightbox') ? 'active' : ''; ?>">Lightbox</a></li>
                                <li><a href="ui-rating"
                                        class="<?php echo ($page == 'ui-rating') ? 'active' : ''; ?>">Rating</a></li>
                                <li><a href="ui-scrollbar"
                                        class="<?php echo ($page == 'ui-scrollbar') ? 'active' : ''; ?>">Scrollbar</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'form-basic-inputs' || $page == 'form-checkbox-radios' || $page == 'form-input-groups' || $page == 'form-grid-gutters' || $page == 'form-mask' || $page == 'form-fileupload' || $page == 'form-horizontal' || $page == 'form-vertical' || $page == 'form-floating-labels' || $page == 'form-validation' || $page == 'form-select' || $page == 'form-pickers' || $page == 'form-editors') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-forms"></i><span>Forms</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);"
                                        class="<?php echo ($page == 'form-basic-inputs' || $page == 'form-checkbox-radios' || $page == 'form-input-groups' || $page == 'form-grid-gutters' || $page == 'form-mask' || $page == 'form-fileupload') ? 'active subdrop' : ''; ?>">Form
                                        Elements<span class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="form-basic-inputs"
                                                class="<?php echo ($page == 'form-basic-inputs') ? 'active' : ''; ?>">Basic
                                                Inputs</a></li>
                                        <li><a href="form-checkbox-radios"
                                                class="<?php echo ($page == 'form-checkbox-radios') ? 'active' : ''; ?>">Checkbox
                                                & Radios</a></li>
                                        <li><a href="form-input-groups"
                                                class="<?php echo ($page == 'form-input-groups') ? 'active' : ''; ?>">Input
                                                Groups</a></li>
                                        <li><a href="form-grid-gutters"
                                                class="<?php echo ($page == 'form-grid-gutters') ? 'active' : ''; ?>">Grid &
                                                Gutters</a></li>
                                        <li><a href="form-mask"
                                                class="<?php echo ($page == 'form-mask') ? 'active' : ''; ?>">Input
                                                Masks</a>
                                        </li>
                                        <li><a href="form-fileupload"
                                                class="<?php echo ($page == 'form-fileupload') ? 'active' : ''; ?>">File
                                                Uploads</a></li>
                                    </ul>
                                </li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);"
                                        class="<?php echo ($page == 'form-horizontal' || $page == 'form-vertical' || $page == 'form-floating-labels') ? 'active subdrop' : ''; ?>">Layouts<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="form-horizontal"
                                                class="<?php echo ($page == 'form-horizontal') ? 'active' : ''; ?>">Horizontal
                                                Form</a></li>
                                        <li><a href="form-vertical"
                                                class="<?php echo ($page == 'form-vertical') ? 'active' : ''; ?>">Vertical
                                                Form</a></li>
                                        <li><a href="form-floating-labels"
                                                class="<?php echo ($page == 'form-floating-labels') ? 'active' : ''; ?>">Floating
                                                Labels</a></li>
                                    </ul>
                                </li>
                                <li><a href="form-validation"
                                        class="<?php echo ($page == 'form-validation') ? 'active' : ''; ?>">Form
                                        Validation</a></li>
                                <li><a href="form-select"
                                        class="<?php echo ($page == 'form-select') ? 'active' : ''; ?>">Form Select</a></li>
                                <li><a href="form-pickers"
                                        class="<?php echo ($page == 'form-pickers') ? 'active' : ''; ?>">Form Picker</a>
                                </li>
                                <li><a href="form-editors"
                                        class="<?php echo ($page == 'form-editors') ? 'active' : ''; ?>">Form Editors</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'tables-basic' || $page == 'data-tables') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-table"></i><span>Tables</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="tables-basic"
                                        class="<?php echo ($page == 'tables-basic') ? 'active' : ''; ?>">Basic Tables </a>
                                </li>
                                <li><a href="data-tables"
                                        class="<?php echo ($page == 'data-tables') ? 'active' : ''; ?>">Data Table </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'chart-apex' || $page == 'chart-c3' || $page == 'chart-morris' || $page == 'chart-flot') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-chart-pie-3"></i><span>Charts</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="chart-apex"
                                        class="<?php echo ($page == 'chart-apex') ? 'active' : ''; ?>">Apex Charts</a></li>
                                <li><a href="chart-c3"
                                        class="<?php echo ($page == 'chart-c3') ? 'active' : ''; ?>">Chart
                                        C3</a></li>
                                <li><a href="chart-morris"
                                        class="<?php echo ($page == 'chart-morris') ? 'active' : ''; ?>">Morris Charts</a>
                                </li>
                                <li><a href="chart-flot"
                                        class="<?php echo ($page == 'chart-flot') ? 'active' : ''; ?>">Flot Charts</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'icon-fontawesome' || $page == 'icon-tabler' || $page == 'icon-bootstrap' || $page == 'icon-remix' || $page == 'icon-feather' || $page == 'icon-ionic' || $page == 'icon-material' || $page == 'icon-pe7' || $page == 'icon-simpleline' || $page == 'icon-themify' || $page == 'icon-weather' || $page == 'icon-typicon' || $page == 'icon-flag') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-icons"></i><span>Icons</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="icon-fontawesome"
                                        class="<?php echo ($page == 'icon-fontawesome') ? 'active' : ''; ?>">Fontawesome
                                        Icons</a></li>
                                <li><a href="icon-tabler"
                                        class="<?php echo ($page == 'icon-tabler') ? 'active' : ''; ?>">Tabler Icons</a>
                                </li>
                                <li><a href="icon-bootstrap"
                                        class="<?php echo ($page == 'icon-bootstrap') ? 'active' : ''; ?>">Bootstrap
                                        Icons</a></li>
                                <li><a href="icon-remix"
                                        class="<?php echo ($page == 'icon-remix') ? 'active' : ''; ?>">Remix Icons</a></li>
                                <li><a href="icon-feather"
                                        class="<?php echo ($page == 'icon-feather') ? 'active' : ''; ?>">Feather Icons</a>
                                </li>
                                <li><a href="icon-ionic"
                                        class="<?php echo ($page == 'icon-ionic') ? 'active' : ''; ?>">Ionic Icons</a></li>
                                <li><a href="icon-material"
                                        class="<?php echo ($page == 'icon-material') ? 'active' : ''; ?>">Material Icons</a>
                                </li>
                                <li><a href="icon-pe7" class="<?php echo ($page == 'icon-pe7') ? 'active' : ''; ?>">Pe7
                                        Icons</a></li>
                                <li><a href="icon-simpleline"
                                        class="<?php echo ($page == 'icon-simpleline') ? 'active' : ''; ?>">Simpleline
                                        Icons</a></li>
                                <li><a href="icon-themify"
                                        class="<?php echo ($page == 'icon-themify') ? 'active' : ''; ?>">Themify Icons</a>
                                </li>
                                <li><a href="icon-weather"
                                        class="<?php echo ($page == 'icon-weather') ? 'active' : ''; ?>">Weather Icons</a>
                                </li>
                                <li><a href="icon-typicon"
                                        class="<?php echo ($page == 'icon-typicon') ? 'active' : ''; ?>">Typicon Icons</a>
                                </li>
                                <li><a href="icon-flag"
                                        class="<?php echo ($page == 'icon-flag') ? 'active' : ''; ?>">Flag Icons</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="widgets" class="<?php echo ($page == 'widgets') ? 'active' : ''; ?>">
                                <i class="ti ti-map-2"></i><span>Widgets</span><span class="track-icon"></span>
                            </a>
                        </li>
                        <li class="menu-title"><span>Extras</span></li>
                        <li>
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'documentation') ? 'active' : ''; ?>"><i
                                    class="ti ti-file-shredder"></i><span>Documentation</span></a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);">
                                <i class="ti ti-menu-2"></i><span>Multi Level</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="javascript:void(0);">Multilevel 1</a></li>
                                <li class="submenu submenu-two">
                                    <a href="javascript:void(0);">Multilevel 2<span
                                            class="menu-arrow inside-submenu"></span></a>
                                    <ul>
                                        <li><a href="javascript:void(0);">Multilevel 2.1</a></li>
                                        <li class="submenu submenu-two submenu-three">
                                            <a href="javascript:void(0);">Multilevel 2.2<span
                                                    class="menu-arrow inside-submenu inside-submenu-two"></span></a>
                                            <ul>
                                                <li><a href="javascript:void(0);">Multilevel 2.2.1</a></li>
                                                <li><a href="javascript:void(0);">Multilevel 2.2.2</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);">Multilevel 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        <?php } ?>

        <?php if (
            $page == 'user-dashboard' || $page == 'user-timesheet' || $page == 'user-attendance' || $page == 'user-leave-approved'
            || $page == 'user-leave-rejected' || $page == 'user-leave-pending'
            || $page == 'user-projects' || $page == 'user-tasks' || $page == 'user-tasks' || $page == 'user-timesheet-report'
            || $page == 'user-attendance-report' || $page == 'user-activity-summary' || $page == 'user-unusual-activity'
            || $page == 'user-hours-tracked-report' || $page == 'user-projects-and-tasks' || $page == 'user-timeline-report'
            || $page == 'user-manual-time-report' || $page == 'user-poor-time-use-report' || $page == 'user-web-and-app-usage'
            || $page == 'user-low-activity-report' || $page == 'user-idle-time-report' || $page == 'user-overlimit-time-report'
            || $page == 'user-working-on-weekends' || $page == 'user-profile-settings' || $page == 'user-security-settings'
            || $page == 'user-tasks-grid' || $page == 'user-teams-settings' || $page == 'user-timeline-screenshots' || $page == 'user-timeline-usage' || $page == 'user-timeline-week'
            || $page == 'user-timesheet-month' || $page == 'user-timesheet-week' || $page == 'user-timesheet-year'
            || $page == 'user-timesheet-report' || $page == 'user-attendance-report' || $page == 'user-activity-summary' || $page == 'user-unusual-activity'
            || $page == 'user-hours-tracked-report' || $page == 'user-projects-and-tasks' || $page == 'user-timeline-report'
            || $page == 'user-manual-time-report' || $page == 'user-poor-time-use-report' || $page == 'user-web-and-app-usage'
            || $page == 'user-low-activity-report' || $page == 'user-idle-time-report' || $page == 'user-overlimit-time-report'
            || $page == 'user-working-on-weekends' || $page == 'user-hours-tracked-month' || $page == 'user-hours-tracked-week'
            || $page == 'user-manual-time-report-month' || $page == 'user-manual-time-report-week' || $page == 'user-timeline-screenshots' || $page == 'user-timeline-usage' || $page == 'user-timeline-week'
            || $page == 'user-poor-time-use-report-month' || $page == 'user-poor-time-use-report-week' || $page == 'user-activity-summary-month' || $page == 'user-activity-summary-week'
            || $page == 'user-attendance-report-month' || $page == 'user-attendance-report-week' || $page == 'user-security-settings' || $page == 'user-teams-settings'
            || $page == 'user-manual-time-month' || $page == 'user-manual-time-week'
        ) { ?>
            <!-- User Dashboard Sidebar -->
            <div class="sidebar-inner" data-simplebar>
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title"><span>Main</span></li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'user-dashboard') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-layout-grid-add"></i><span>Dashboard</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="index">Admin Dashboard</a></li>
                                <li><a href="user-dashboard"
                                        class="<?php echo ($page == 'user-dashboard') ? 'active' : ''; ?>">User
                                        Dashboard</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="user-timesheet"
                                class="<?php echo ($page == 'user-timesheet' || $page == 'user-timesheet-month' || $page == 'user-timesheet-week') ? 'active' : ''; ?>">
                                <i class="ti ti-calendar-time"></i><span>Timesheet</span>
                            </a>
                        </li>
                        <li>
                            <a href="user-attendance"
                                class="<?php echo ($page == 'user-attendance') ? 'active' : ''; ?>">
                                <i class="ti ti-user-check"></i><span>Attendance</span>
                            </a>
                        </li>
                        <li>
                            <a href="user-leave-approved"
                                class="<?php echo ($page == 'user-leave-approved' || $page == 'user-leave-pending' || $page == 'user-leave-rejected') ? 'active' : ''; ?>">
                                <i class="ti ti-beach"></i><span>Leave</span>
                            </a>
                        </li>
                        <li>
                            <a href="user-projects"
                                class="<?php echo ($page == 'user-projects' || $page == 'user-projects-archived') ? 'active' : ''; ?>">
                                <i class="ti ti-briefcase"></i><span>Projects</span>
                            </a>
                        </li>
                        <li>
                            <a href="user-tasks"
                                class="<?php echo ($page == 'user-tasks' || $page == 'user-tasks-grid') ? 'active' : ''; ?>">
                                <i class="ti ti-checklist"></i><span>Tasks</span>
                            </a>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"
                                class="<?php echo ($page == 'user-timesheet-report' || $page == 'user-attendance-report' || $page == 'user-activity-summary' || $page == 'user-unusual-activity'
                                    || $page == 'user-hours-tracked-report' || $page == 'user-projects-and-tasks' || $page == 'user-timeline-report'
                                    || $page == 'user-manual-time-report' || $page == 'user-poor-time-use-report' || $page == 'user-web-and-app-usage'
                                    || $page == 'user-low-activity-report' || $page == 'user-idle-time-report' || $page == 'user-overlimit-time-report'
                                    || $page == 'user-working-on-weekends' || $page == 'user-hours-tracked-month' || $page == 'user-hours-tracked-week'
                                    || $page == 'user-manual-time-report-month' || $page == 'user-manual-time-report-week' || $page == 'user-timeline-screenshots' || $page == 'user-timeline-usage' || $page == 'user-timeline-week'
                                    || $page == 'user-poor-time-use-report-month' || $page == 'user-poor-time-use-report-week' || $page == 'user-activity-summary-month' || $page == 'user-activity-summary-week'
                                    || $page == 'user-attendance-report-month' || $page == 'user-attendance-report-week' || $page == 'user-manual-time-month' || $page == 'user-manual-time-week') ? 'active subdrop' : ''; ?>">
                                <i class="ti ti-report-analytics"></i><span>Reports</span><span class="menu-arrow"></span>
                            </a>
                            <ul>
                                <li><a href="user-timesheet-report"
                                        class="<?php echo ($page == 'user-timesheet-report') ? 'active' : ''; ?>">Timesheets</a>
                                </li>
                                <li><a href="user-attendance-report"
                                        class="<?php echo ($page == 'user-attendance-report' || $page == 'user-attendance-report-month' || $page == 'user-attendance-report-week') ? 'active' : ''; ?>">Attendance</a>
                                </li>
                                <li><a href="user-activity-summary"
                                        class="<?php echo ($page == 'user-activity-summary' || $page == 'user-activity-summary-month' || $page == 'user-activity-summary-week') ? 'active' : ''; ?>">Activity
                                        Summary</a></li>
                                <li><a href="user-unusual-activity"
                                        class="<?php echo ($page == 'user-unusual-activity') ? 'active' : ''; ?>">Unusual
                                        Activity</a></li>
                                <li><a href="user-hours-tracked-report"
                                        class="<?php echo ($page == 'user-hours-tracked-report' || $page == 'user-hours-tracked-month' || $page == 'user-hours-tracked-week') ? 'active' : ''; ?>">Hours
                                        Tracked</a></li>
                                <li><a href="user-projects-and-tasks"
                                        class="<?php echo ($page == 'user-projects-and-tasks') ? 'active' : ''; ?>">Projects
                                        & Tasks</a></li>
                                <li><a href="user-timeline-report"
                                        class="<?php echo ($page == 'user-timeline-report' || $page == 'user-timeline-screenshots' || $page == 'user-timeline-usage' || $page == 'user-timeline-week') ? 'active' : ''; ?>">Timeline</a>
                                </li>
                                <li><a href="user-manual-time-report"
                                        class="<?php echo ($page == 'user-manual-time-report' || $page == 'user-manual-time-report-month' || $page == 'user-manual-time-report-week' || $page == 'user-manual-time-month' || $page == 'user-manual-time-week'
                                            || $page == 'user-manual-time-month' || $page == 'user-manual-time-week') ? 'active' : ''; ?>">Manual
                                        Time</a></li>
                                <li><a href="user-poor-time-use-report"
                                        class="<?php echo ($page == 'user-poor-time-use-report' || $page == 'user-poor-time-use-report-month' || $page == 'user-poor-time-use-report-week') ? 'active' : ''; ?>">Poor
                                        Time Use</a></li>
                                <li><a href="user-web-and-app-usage"
                                        class="<?php echo ($page == 'user-web-and-app-usage') ? 'active' : ''; ?>">Web & App
                                        Usage</a></li>
                                <li><a href="user-low-activity-report"
                                        class="<?php echo ($page == 'user-low-activity-report') ? 'active' : ''; ?>">Low
                                        Activity</a></li>
                                <li><a href="user-idle-time-report"
                                        class="<?php echo ($page == 'user-idle-time-report') ? 'active' : ''; ?>">Idle
                                        Time</a></li>
                                <li><a href="user-overlimit-time-report"
                                        class="<?php echo ($page == 'user-overlimit-time-report') ? 'active' : ''; ?>">Overlimit
                                        Time</a></li>
                                <li><a href="user-working-on-weekends"
                                        class="<?php echo ($page == 'user-working-on-weekends') ? 'active' : ''; ?>">Working
                                        on Weekends</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="user-profile-settings"
                                class="<?php echo ($page == 'user-profile-settings' || $page == 'user-security-settings' || $page == 'user-teams-settings') ? 'active' : ''; ?>">
                                <i class="ti ti-settings"></i><span>Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php } ?>

    </div>
    <!-- Sidenav Menu End -->
