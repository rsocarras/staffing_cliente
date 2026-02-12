<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\helpers\JsonHelper;
use yii\web\Response;
use yii\filters\VerbFilter;

class PagesController extends Controller
{

    public function Index()
    {
        $this->layout = 'main';
        return $this->render('/index');
    }

    public function actionActivityLogs()
    {
        $this->layout = 'main';
        return $this->render('/activity-logs');
    }

    public function actionActivitySummaryMonth()
    {
        $this->layout = 'main';
        return $this->render('/activity-summary-month');
    }

    public function actionActivitySummaryWeek()
    {
        $this->layout = 'main';
        return $this->render('/activity-summary-week');
    }

    public function actionActivitySummary()
    {
        $this->layout = 'main';
        return $this->render('/activity-summary');
    }

    public function actionAddInvoice()
    {
        $this->layout = 'main';
        return $this->render('/add-invoice');
    }

    public function actionAddProject()
    {
        $this->layout = 'main';
        return $this->render('/add-project');
    }

    public function actionApiKeys()
    {
        $this->layout = 'main';
        return $this->render('/api-keys');
    }

    public function actionAppearanceSettings()
    {
        $this->layout = 'main';
        return $this->render('/appearance-settings');
    }

    public function actionAttendanceReportMonth()
    {
        $this->layout = 'main';
        return $this->render('/attendance-report-month');
    }

    public function actionAttendanceReportWeek()
    {
        $this->layout = 'main';
        return $this->render('/attendance-report-week');
    }

    public function actionAttendanceReport()
    {
        $this->layout = 'main';
        return $this->render('/attendance-report');
    }

    public function actionAttendance()
    {
        $this->layout = 'main';
        return $this->render('/attendance');
    }

    public function actionBlogCategories()
    {
        $this->layout = 'main';
        return $this->render('/blog-categories');
    }

    public function actionBlogComments()
    {
        $this->layout = 'main';
        return $this->render('/blog-comments');
    }

    public function actionBlogDetail()
    {
        $this->layout = 'main';
        return $this->render('/blog-detail');
    }

    public function actionBlogTags()
    {
        $this->layout = 'main';
        return $this->render('/blog-tags');
    }

    public function actionBlogs()
    {
        $this->layout = 'main';
        return $this->render('/blogs');
    }

    public function actionCalendar()
    {
        $this->layout = 'main';
        return $this->render('/calendar');
    }

    public function actionChartApex()
    {
        $this->layout = 'main';
        return $this->render('/chart-apex');
    }

    public function actionChartC3()
    {
        $this->layout = 'main';
        return $this->render('/chart-c3');
    }

    public function actionChartFlot()
    {
        $this->layout = 'main';
        return $this->render('/chart-flot');
    }

    public function actionChartJs()
    {
        $this->layout = 'main';
        return $this->render('/chart-js');
    }

    public function actionChartMorris()
    {
        $this->layout = 'main';
        return $this->render('/chart-morris');
    }

    public function actionChat()
    {
        $this->layout = 'main';
        return $this->render('/chat');
    }

    public function actionCities()
    {
        $this->layout = 'main';
        return $this->render('/cities');
    }

    public function actionClientsGrid()
    {
        $this->layout = 'main';
        return $this->render('/clients-grid');
    }

    public function actionClients()
    {
        $this->layout = 'main';
        return $this->render('/clients');
    }

    public function actionComingSoon()
    {
        $this->layout = 'auth_main';
        return $this->render('/coming-soon');
    }

    public function actionCompanySettings()
    {
        $this->layout = 'main';
        return $this->render('/company-settings');
    }

    public function actionContactList()
    {
        $this->layout = 'main';
        return $this->render('/contact-list');
    }

    public function actionContacts()
    {
        $this->layout = 'main';
        return $this->render('/contacts');
    }

    public function actionCountries()
    {
        $this->layout = 'main';
        return $this->render('/countries');
    }

    public function actionCurrenciesSettings()
    {
        $this->layout = 'main';
        return $this->render('/currencies-settings');
    }

    public function actionCustomFieldsSettings()
    {
        $this->layout = 'main';
        return $this->render('/custom-fields-settings');
    }

    public function actionDataTables()
    {
        $this->layout = 'main';
        return $this->render('/data-tables');
    }

    public function actionDeleteAccount()
    {
        $this->layout = 'main';
        return $this->render('/delete-account');
    }

    public function actionDepartmentSettings()
    {
        $this->layout = 'main';
        return $this->render('/department-settings');
    }

    public function actionDownload()
    {
        $this->layout = 'main';
        return $this->render('/download');
    }

    public function actionEditInvoice()
    {
        $this->layout = 'main';
        return $this->render('/edit-invoice');
    }

    public function actionEditProject()
    {
        $this->layout = 'main';
        return $this->render('/edit-project');
    }

    public function actionEditShift()
    {
        $this->layout = 'main';
        return $this->render('/edit-shift');
    }

    public function actionEditTimeApproved()
    {
        $this->layout = 'main';
        return $this->render('/edit-time-approved');
    }

    public function actionEditTimeRequest()
    {
        $this->layout = 'main';
        return $this->render('/edit-time-request');
    }

    public function actionEditTimeWaiting()
    {
        $this->layout = 'main';
        return $this->render('/edit-time-waiting');
    }

    public function actionEditTime()
    {
        $this->layout = 'main';
        return $this->render('/edit-time');
    }

    public function actionEditUser()
    {
        $this->layout = 'main';
        return $this->render('/edit-user');
    }

    public function actionEmailCompose()
    {
        $this->layout = 'main';
        return $this->render('/email-compose');
    }

    public function actionEmailDetails()
    {
        $this->layout = 'main';
        return $this->render('/email-details');
    }

    public function actionEmailVerification2()
    {
        $this->layout = 'auth_main';
        return $this->render('/email-verification-2');
    }

    public function actionEmailVerification3()
    {
        $this->layout = 'auth_main';
        return $this->render('/email-verification-3');
    }

    public function actionEmailVerification()
    {
        $this->layout = 'auth_main';
        return $this->render('/email-verification');
    }

    public function actionEmail()
    {
        $this->layout = 'main';
        return $this->render('/email');
    }

    public function actionEmployeeDetails()
    {
        $this->layout = 'main';
        return $this->render('/employee-details');
    }    

    public function actionEmployeeSettings()
    {
        $this->layout = 'main';
        return $this->render('/employee-settings');
    }

    public function actionEmployeesArchived()
    {
        $this->layout = 'main';
        return $this->render('/employees-archived');
    }  
    
    public function actionEmployeesDeactivated()
    {
        $this->layout = 'main';
        return $this->render('/employees-deactivated');
    }    

    public function actionEmployees()
    {
        $this->layout = 'main';
        return $this->render('/employees');
    }

    public function actionError404()
    {
        $this->layout = 'auth_main';
        return $this->render('/error-404');
    }

    public function actionError500()
    {
        $this->layout = 'auth_main';
        return $this->render('/error-500');
    }

    public function actionExpenseApproved()
    {
        $this->layout = 'main';
        return $this->render('/expense-approved');
    }

    public function actionExpenseCategorySettings()
    {
        $this->layout = 'main';
        return $this->render('/expense-category-settings');
    }

    public function actionExpenseRejected()
    {
        $this->layout = 'main';
        return $this->render('/expense-rejected');
    }

    public function actionExpenseReport()
    {
        $this->layout = 'main';
        return $this->render('/expense-report');
    }

    public function actionExpenseRequested()
    {
        $this->layout = 'main';
        return $this->render('/expense-requested');
    }

    public function actionExpenseTypeSettings()
    {
        $this->layout = 'main';
        return $this->render('/expense-type-settings');
    }

    public function actionExpense()
    {
        $this->layout = 'main';
        return $this->render('/expense');
    }

    public function actionFaq()
    {
        $this->layout = 'main';
        return $this->render('/faq');
    }

    public function actionFileManager()
    {
        $this->layout = 'main';
        return $this->render('/file-manager');
    }

    public function actionForgotPassword2()
    {
        $this->layout = 'auth_main';
        return $this->render('/forgot-password-2');
    }

    public function actionForgotPassword3()
    {
        $this->layout = 'auth_main';
        return $this->render('/forgot-password-3');
    }

    public function actionForgotPassword()
    {
        $this->layout = 'auth_main';
        return $this->render('/forgot-password');
    }

    public function actionFormBasicInputs()
    {
        $this->layout = 'main';
        return $this->render('/form-basic-inputs');
    }

    public function actionFormCheckboxRadios()
    {
        $this->layout = 'main';
        return $this->render('/form-checkbox-radios');
    }

    public function actionFormEditors()
    {
        $this->layout = 'main';
        return $this->render('/form-editors');
    }

    public function actionFormFileupload()
    {
        $this->layout = 'main';
        return $this->render('/form-fileupload');
    }

    public function actionFormFloatingLabels()
    {
        $this->layout = 'main';
        return $this->render('/form-floating-labels');
    }

    public function actionFormGridGutters()
    {
        $this->layout = 'main';
        return $this->render('/form-grid-gutters');
    }

    public function actionFormHorizontal()
    {
        $this->layout = 'main';
        return $this->render('/form-horizontal');
    }

    public function actionFormInputGroups()
    {
        $this->layout = 'main';
        return $this->render('/form-input-groups');
    }

    public function actionFormMask()
    {
        $this->layout = 'main';
        return $this->render('/form-mask');
    }

    public function actionFormPickers()
    {
        $this->layout = 'main';
        return $this->render('/form-pickers');
    }

    public function actionFormSelect()
    {
        $this->layout = 'main';
        return $this->render('/form-select');
    }

    public function actionFormValidation()
    {
        $this->layout = 'main';
        return $this->render('/form-validation');
    }

    public function actionFormVertical()
    {
        $this->layout = 'main';
        return $this->render('/form-vertical');
    }

    public function actionFreeTrial2()
    {
        $this->layout = 'auth_main';
        return $this->render('/free-trial-2');
    }

    public function actionFreeTrial3()
    {
        $this->layout = 'auth_main';
        return $this->render('/free-trial-3');
    }

    public function actionFreeTrial()
    {
        $this->layout = 'auth_main';
        return $this->render('/free-trial');
    }

    public function actionGallery()
    {
        $this->layout = 'main';
        return $this->render('/gallery');
    }

    public function actionHoursTrackedMonth()
    {
        $this->layout = 'main';
        return $this->render('/hours-tracked-month');
    }

    public function actionHoursTrackedWeek()
    {
        $this->layout = 'main';
        return $this->render('/hours-tracked-week');
    }

    public function actionHoursTracked()
    {
        $this->layout = 'main';
        return $this->render('/hours-tracked');
    }

    public function actionIconBootstrap()
    {
        $this->layout = 'main';
        return $this->render('/icon-bootstrap');
    }

    public function actionIconFeather()
    {
        $this->layout = 'main';
        return $this->render('/icon-feather');
    }

    public function actionIconFlag()
    {
        $this->layout = 'main';
        return $this->render('/icon-flag');
    }

    public function actionIconFontawesome()
    {
        $this->layout = 'main';
        return $this->render('/icon-fontawesome');
    }

    public function actionIconIonic()
    {
        $this->layout = 'main';
        return $this->render('/icon-ionic');
    }

    public function actionIconMaterial()
    {
        $this->layout = 'main';
        return $this->render('/icon-material');
    }

    public function actionIconPe7()
    {
        $this->layout = 'main';
        return $this->render('/icon-pe7');
    }

    public function actionIconRemix()
    {
        $this->layout = 'main';
        return $this->render('/icon-remix');
    }

    public function actionIconSimpleline()
    {
        $this->layout = 'main';
        return $this->render('/icon-simpleline');
    }

    public function actionIconTabler()
    {
        $this->layout = 'main';
        return $this->render('/icon-tabler');
    }

    public function actionIconThemify()
    {
        $this->layout = 'main';
        return $this->render('/icon-themify');
    }

    public function actionIconTypicon()
    {
        $this->layout = 'main';
        return $this->render('/icon-typicon');
    }

    public function actionIconWeather()
    {
        $this->layout = 'main';
        return $this->render('/icon-weather');
    }

    public function actionIdleTime()
    {
        $this->layout = 'main';
        return $this->render('/idle-time');
    }

    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('/index');
    }

    public function actionIntegrationsSettings()
    {
        $this->layout = 'main';
        return $this->render('/integrations-settings');
    }

    public function actionInviteUsers()
    {
        $this->layout = 'main';
        return $this->render('/invite-users');
    }

    public function actionInvoiceDetails()
    {
        $this->layout = 'main';
        return $this->render('/invoice-details');
    }

    public function actionInvoice()
    {
        $this->layout = 'main';
        return $this->render('/invoice');
    }

    public function actionInvoices()
    {
        $this->layout = 'main';
        return $this->render('/invoices');
    }

    public function actionKanbanView()
    {
        $this->layout = 'main';
        return $this->render('/kanban-view');
    }

    public function actionLayoutDark()
    {
        $this->layout = 'main';
        return $this->render('/layout-dark');
    }

    public function actionLayoutFullwidth()
    {
        $this->layout = 'main';
        return $this->render('/layout-fullwidth');
    }

    public function actionLayoutHidden()
    {
        $this->layout = 'main';
        return $this->render('/layout-hidden');
    }

    public function actionLayoutHoverview()
    {
        $this->layout = 'main';
        return $this->render('/layout-hoverview');
    }

    public function actionLayoutMini()
    {
        $this->layout = 'main';
        return $this->render('/layout-mini');
    }

    public function actionLayoutRtl()
    {
        $this->layout = 'main';
        return $this->render('/layout-rtl');
    }

    public function actionLeaveApproved()
    {
        $this->layout = 'main';
        return $this->render('/leave-approved');
    }

    public function actionLeaveRejected()
    {
        $this->layout = 'main';
        return $this->render('/leave-rejected');
    }

    public function actionLeaveTypesSettings()
    {
        $this->layout = 'main';
        return $this->render('/leave-types-settings');
    }

    public function actionLeaveTypes()
    {
        $this->layout = 'main';
        return $this->render('/leave-types');
    }

    public function actionLeave()
    {
        $this->layout = 'main';
        return $this->render('/leave');
    }

    public function actionLiveTracking()
    {
        $this->layout = 'main';
        return $this->render('/live-tracking');
    } 
    
    public function actionLiveTrackingMinute()
    {
        $this->layout = 'main';
        return $this->render('/live-tracking-minute');
    }    

    public function actionLocalizationSettings()
    {
        $this->layout = 'main';
        return $this->render('/localization-settings');
    }

    public function actionLocationSettings()
    {
        $this->layout = 'main';
        return $this->render('/location-settings');
    }

    public function actionLockScreen()
    {
        $this->layout = 'auth_main';
        return $this->render('/lock-screen');
    }

    public function actionLogin2()
    {
        $this->layout = 'auth_main';
        return $this->render('/login-2');
    }

    public function actionLogin3()
    {
        $this->layout = 'auth_main';
        return $this->render('/login-3');
    }

    public function actionLogin()
    {
        $this->layout = 'auth_main';
        return $this->render('/login');
    }

    public function actionLowActivity()
    {
        $this->layout = 'main';
        return $this->render('/low-activity');
    }

    public function actionManualTimeWeek()
    {
        $this->layout = 'main';
        return $this->render('/manual-time-week');
    }

    public function actionManualTime()
    {
        $this->layout = 'main';
        return $this->render('/manual-time');
    }

    public function actionNotes()
    {
        $this->layout = 'main';
        return $this->render('/notes');
    }

    public function actionNotificationsSettings()
    {
        $this->layout = 'main';
        return $this->render('/notifications-settings');
    }

    public function actionNotifications()
    {
        $this->layout = 'main';
        return $this->render('/notifications');
    }

    public function actionOvertimeLimit()
    {
        $this->layout = 'main';
        return $this->render('/overtime-limit');
    }

    public function actionPages()
    {
        $this->layout = 'main';
        return $this->render('/pages');
    }

    public function actionPaymentMethodSettings()
    {
        $this->layout = 'main';
        return $this->render('/payment-method-settings');
    }

    public function actionPermissions()
    {
        $this->layout = 'main';
        return $this->render('/permissions');
    }

    public function actionPlansAndBillings()
    {
        $this->layout = 'main';
        return $this->render('/plans-and-billings');
    }

    public function actionPlugin()
    {
        $this->layout = 'main';
        return $this->render('/plugin');
    }

    public function actionPoorTimeMonth()
    {
        $this->layout = 'main';
        return $this->render('/poor-time-month');
    }

    public function actionPoorTimeUse()
    {
        $this->layout = 'main';
        return $this->render('/poor-time-use');
    }    

    public function actionPoorTimeWeek()
    {
        $this->layout = 'main';
        return $this->render('/poor-time-week');
    }

    public function actionPreferenceSettings()
    {
        $this->layout = 'main';
        return $this->render('/preference-settings');
    }

    public function actionPricing()
    {
        $this->layout = 'main';
        return $this->render('/pricing');
    }

    public function actionPrivacyPolicy()
    {
        $this->layout = 'main';
        return $this->render('/privacy-policy');
    }

    public function actionProductivityRatingsSettings()
    {
        $this->layout = 'main';
        return $this->render('/productivity-ratings-settings');
    }

    public function actionProfileSettings()
    {
        $this->layout = 'main';
        return $this->render('/profile-settings');
    }

    public function actionProfile()
    {
        $this->layout = 'main';
        return $this->render('/profile');
    }

    public function actionProjectArchived()
    {
        $this->layout = 'main';
        return $this->render('/project-archived');
    }

    public function actionProjectCompleted()
    {
        $this->layout = 'main';
        return $this->render('/project-completed');
    }

    public function actionProjectDetailsMilestonesGrid()
    {
        $this->layout = 'main';
        return $this->render('/project-details-milestones-grid');
    }

    public function actionProjectDetailsMilestones()
    {
        $this->layout = 'main';
        return $this->render('/project-details-milestones');
    }

    public function actionProjectDetailsScreenshots()
    {
        $this->layout = 'main';
        return $this->render('/project-details-screenshots');
    }

    public function actionProjectDetailsTaskList()
    {
        $this->layout = 'main';
        return $this->render('/project-details-task-list');
    }

    public function actionProjectDetailsTask()
    {
        $this->layout = 'main';
        return $this->render('/project-details-task');
    }

    public function actionProjectDetailsUsage()
    {
        $this->layout = 'main';
        return $this->render('/project-details-usage');
    }

    public function actionProjectDetails()
    {
        $this->layout = 'main';
        return $this->render('/project-details');
    }

    public function actionProjectHold()
    {
        $this->layout = 'main';
        return $this->render('/project-hold');
    }

    public function actionProject()
    {
        $this->layout = 'main';
        return $this->render('/project');
    }

    public function actionProjectsGrid()
    {
        $this->layout = 'main';
        return $this->render('/projects-grid');
    }

    public function actionProjectsTasks()
    {
        $this->layout = 'main';
        return $this->render('/projects-tasks');
    }

    public function actionProjects()
    {
        $this->layout = 'main';
        return $this->render('/projects');
    }

    public function actionRegister2()
    {
        $this->layout = 'auth_main';
        return $this->render('/register-2');
    }

    public function actionRegister3()
    {
        $this->layout = 'auth_main';
        return $this->render('/register-3');
    }

    public function actionRegister()
    {
        $this->layout = 'auth_main';
        return $this->render('/register');
    }

    public function actionReports()
    {
        $this->layout = 'main';
        return $this->render('/reports');
    }

    public function actionResetPassword2()
    {
        $this->layout = 'auth_main';
        return $this->render('/reset-password-2');
    }

    public function actionResetPassword3()
    {
        $this->layout = 'auth_main';
        return $this->render('/reset-password-3');
    }

    public function actionResetPassword()
    {
        $this->layout = 'auth_main';
        return $this->render('/reset-password');
    }

    public function actionRolesPermissions()
    {
        $this->layout = 'main';
        return $this->render('/roles-permissions');
    }

    public function actionScreenshots()
    {
        $this->layout = 'main';
        return $this->render('/screenshots');
    }

    public function actionSearchResults()
    {
        $this->layout = 'main';
        return $this->render('/search-results');
    }

    public function actionSecuritySettings()
    {
        $this->layout = 'main';
        return $this->render('/security-settings');
    }

    public function actionShiftSettings()
    {
        $this->layout = 'main';
        return $this->render('/shift-settings');
    }

    public function actionShiftsLeaveTypes()
    {
        $this->layout = 'main';
        return $this->render('/shifts-leave-types');
    }

    public function actionSocialFeed()
    {
        $this->layout = 'main';
        return $this->render('/social-feed');
    }

    public function actionStarter()
    {
        $this->layout = 'main';
        return $this->render('/starter');
    }

    public function actionStates()
    {
        $this->layout = 'main';
        return $this->render('/states');
    }

    public function actionSuccess2()
    {
        $this->layout = 'auth_main';
        return $this->render('/success-2');
    }

    public function actionSuccess3()
    {
        $this->layout = 'auth_main';
        return $this->render('/success-3');
    }

    public function actionSuccess()
    {
        $this->layout = 'auth_main';
        return $this->render('/success');
    }

    public function actionTablesBasic()
    {
        $this->layout = 'main';
        return $this->render('/tables-basic');
    }

    public function actionTasksArchived()
    {
        $this->layout = 'main';
        return $this->render('/tasks-archived');
    }

    public function actionTasksCompleted()
    {
        $this->layout = 'main';
        return $this->render('/tasks-completed');
    }

    public function actionTasksGrid()
    {
        $this->layout = 'main';
        return $this->render('/tasks-grid');
    }

    public function actionTasksOnhold()
    {
        $this->layout = 'main';
        return $this->render('/tasks-onhold');
    }

    public function actionTasks()
    {
        $this->layout = 'main';
        return $this->render('/tasks');
    }

    public function actionTaxesSettings()
    {
        $this->layout = 'main';
        return $this->render('/taxes-settings');
    }

    public function actionTeamsGrid()
    {
        $this->layout = 'main';
        return $this->render('/teams-grid');
    }

    public function actionTeams()
    {
        $this->layout = 'main';
        return $this->render('/teams');
    }

    public function actionTermsCondition()
    {
        $this->layout = 'main';
        return $this->render('/terms-condition');
    }

    public function actionTestimonials()
    {
        $this->layout = 'main';
        return $this->render('/testimonials');
    }

    public function actionTimelineDetails()
    {
        $this->layout = 'main';
        return $this->render('/timeline-details');
    }

    public function actionTimelineReport()
    {
        $this->layout = 'main';
        return $this->render('/timeline-report');
    }

    public function actionTimeline()
    {
        $this->layout = 'main';
        return $this->render('/timeline');
    }

    public function actionTimesheetReportWeek()
    {
        $this->layout = 'main';
        return $this->render('/timesheet-report-week');
    }

    public function actionTimesheetReport()
    {
        $this->layout = 'main';
        return $this->render('/timesheet-report');
    }

    public function actionTimesheetWeek()
    {
        $this->layout = 'main';
        return $this->render('/timesheet-week');
    }

    public function actionTimesheet()
    {
        $this->layout = 'main';
        return $this->render('/timesheet');
    }

    public function actionTodoList()
    {
        $this->layout = 'main';
        return $this->render('/todo-list');
    }

    public function actionTodo()
    {
        $this->layout = 'main';
        return $this->render('/todo');
    }

    public function actionTrackerSettings()
    {
        $this->layout = 'main';
        return $this->render('/tracker-settings');
    }

    public function actionTwoStepVerification2()
    {
        $this->layout = 'auth_main';
        return $this->render('/two-step-verification-2');
    }

    public function actionTwoStepVerification3()
    {
        $this->layout = 'auth_main';
        return $this->render('/two-step-verification-3');
    }

    public function actionTwoStepVerification()
    {
        $this->layout = 'auth_main';
        return $this->render('/two-step-verification');
    }

    public function actionUiAccordion()
    {
        $this->layout = 'main';
        return $this->render('/ui-accordion');
    }

    public function actionUiAlerts()
    {
        $this->layout = 'main';
        return $this->render('/ui-alerts');
    }

    public function actionUiAvatar()
    {
        $this->layout = 'main';
        return $this->render('/ui-avatar');
    }

    public function actionUiBadges()
    {
        $this->layout = 'main';
        return $this->render('/ui-badges');
    }

    public function actionUiBreadcrumb()
    {
        $this->layout = 'main';
        return $this->render('/ui-breadcrumb');
    }

    public function actionUiButtonsGroup()
    {
        $this->layout = 'main';
        return $this->render('/ui-buttons-group');
    }

    public function actionUiButtons()
    {
        $this->layout = 'main';
        return $this->render('/ui-buttons');
    }

    public function actionUiCards()
    {
        $this->layout = 'main';
        return $this->render('/ui-cards');
    }

    public function actionUiCarousel()
    {
        $this->layout = 'main';
        return $this->render('/ui-carousel');
    }

    public function actionUiClipboard()
    {
        $this->layout = 'main';
        return $this->render('/ui-clipboard');
    }

    public function actionUiCollapse()
    {
        $this->layout = 'main';
        return $this->render('/ui-collapse');
    }

    public function actionUiDragula()
    {
        $this->layout = 'main';
        return $this->render('/ui-dragula');
    }

    public function actionUiDropdowns()
    {
        $this->layout = 'main';
        return $this->render('/ui-dropdowns');
    }

    public function actionUiGrid()
    {
        $this->layout = 'main';
        return $this->render('/ui-grid');
    }

    public function actionUiImages()
    {
        $this->layout = 'main';
        return $this->render('/ui-images');
    }

    public function actionUiLightbox()
    {
        $this->layout = 'main';
        return $this->render('/ui-lightbox');
    }

    public function actionUiLinks()
    {
        $this->layout = 'main';
        return $this->render('/ui-links');
    }

    public function actionUiListGroup()
    {
        $this->layout = 'main';
        return $this->render('/ui-list-group');
    }

    public function actionUiModals()
    {
        $this->layout = 'main';
        return $this->render('/ui-modals');
    }

    public function actionUiNavTabs()
    {
        $this->layout = 'main';
        return $this->render('/ui-nav-tabs');
    }

    public function actionUiOffcanvas()
    {
        $this->layout = 'main';
        return $this->render('/ui-offcanvas');
    }

    public function actionUiPagination()
    {
        $this->layout = 'main';
        return $this->render('/ui-pagination');
    }

    public function actionUiPlaceholders()
    {
        $this->layout = 'main';
        return $this->render('/ui-placeholders');
    }

    public function actionUiPopovers()
    {
        $this->layout = 'main';
        return $this->render('/ui-popovers');
    }

    public function actionUiProgress()
    {
        $this->layout = 'main';
        return $this->render('/ui-progress');
    }

    public function actionUiRangeslider()
    {
        $this->layout = 'main';
        return $this->render('/ui-rangeslider');
    }

    public function actionUiRating()
    {
        $this->layout = 'main';
        return $this->render('/ui-rating');
    }

    public function actionUiRatio()
    {
        $this->layout = 'main';
        return $this->render('/ui-ratio');
    }

    public function actionUiScrollbar()
    {
        $this->layout = 'main';
        return $this->render('/ui-scrollbar');
    }

    public function actionUiScrollspy()
    {
        $this->layout = 'main';
        return $this->render('/ui-scrollspy');
    }

    public function actionUiSpinner()
    {
        $this->layout = 'main';
        return $this->render('/ui-spinner');
    }

    public function actionUiSweetalerts()
    {
        $this->layout = 'main';
        return $this->render('/ui-sweetalerts');
    }

    public function actionUiToasts()
    {
        $this->layout = 'main';
        return $this->render('/ui-toasts');
    }

    public function actionUiTooltips()
    {
        $this->layout = 'main';
        return $this->render('/ui-tooltips');
    }

    public function actionUiTypography()
    {
        $this->layout = 'main';
        return $this->render('/ui-typography');
    }

    public function actionUiUtilities()
    {
        $this->layout = 'main';
        return $this->render('/ui-utilities');
    }

    public function actionUnderConstruction()
    {
        $this->layout = 'auth_main';
        return $this->render('/under-construction');
    }

    public function actionUnderMaintenance()
    {
        $this->layout = 'auth_main';
        return $this->render('/under-maintenance');
    }

    public function actionUnusualActivity()
    {
        $this->layout = 'main';
        return $this->render('/unusual-activity');
    }

    public function actionUsageTimelineDetails()
    {
        $this->layout = 'main';
        return $this->render('/usage-timeline-details');
    }

    public function actionUserActivitySummaryMonth()
    {
        $this->layout = 'main';
        return $this->render('/user-activity-summary-month');
    }

    public function actionUserActivitySummaryWeek()
    {
        $this->layout = 'main';
        return $this->render('/user-activity-summary-week');
    }

    public function actionUserActivitySummary()
    {
        $this->layout = 'main';
        return $this->render('/user-activity-summary');
    }

    public function actionUserArchived()
    {
        $this->layout = 'main';
        return $this->render('/user-archived');
    }

    public function actionUserAttendanceReportMonth()
    {
        $this->layout = 'main';
        return $this->render('/user-attendance-report-month');
    }

    public function actionUserAttendanceReportWeek()
    {
        $this->layout = 'main';
        return $this->render('/user-attendance-report-week');
    }

    public function actionUserAttendanceReport()
    {
        $this->layout = 'main';
        return $this->render('/user-attendance-report');
    }

    public function actionUserAttendance()
    {
        $this->layout = 'main';
        return $this->render('/user-attendance');
    }

    public function actionUserDashboard()
    {
        $this->layout = 'main';
        return $this->render('/user-dashboard');
    }

    public function actionUserHoursTrackedMonth()
    {
        $this->layout = 'main';
        return $this->render('/user-hours-tracked-month');
    }

    public function actionUserHoursTrackedWeek()
    {
        $this->layout = 'main';
        return $this->render('/user-hours-tracked-week');
    }

    public function actionUserHoursTrackedReport()
    {
        $this->layout = 'main';
        return $this->render('/user-hours-tracked-report');
    }

    public function actionUserIdleTimeReport()
    {
        $this->layout = 'main';
        return $this->render('/user-idle-time-report');
    }

    public function actionUserInviteStatus()
    {
        $this->layout = 'main';
        return $this->render('/user-invite-status');
    }

    public function actionUserLeaveApproved()
    {
        $this->layout = 'main';
        return $this->render('/user-leave-approved');
    }

    public function actionUserLeavePending()
    {
        $this->layout = 'main';
        return $this->render('/user-leave-pending');
    }

    public function actionUserLeaveRejected()
    {
        $this->layout = 'main';
        return $this->render('/user-leave-rejected');
    }

    public function actionUserLowActivityReport()
    {
        $this->layout = 'main';
        return $this->render('/user-low-activity-report');
    }

    public function actionUserManualTimeMonth()
    {
        $this->layout = 'main';
        return $this->render('/user-manual-time-month');
    }

    public function actionUserManualTimeReport()
    {
        $this->layout = 'main';
        return $this->render('/user-manual-time-report');
    }

    public function actionUserManualTimeWeek()
    {
        $this->layout = 'main';
        return $this->render('/user-manual-time-week');
    }

    public function actionUserOverlimitTimeReport()
    {
        $this->layout = 'main';
        return $this->render('/user-overlimit-time-report');
    }

    public function actionUserPoorTimeMonth()
    {
        $this->layout = 'main';
        return $this->render('/user-poor-time-month');
    }

    public function actionUserPoorTimeUseReport()
    {
        $this->layout = 'main';
        return $this->render('/user-poor-time-use-report');
    }

    public function actionUserPoorTimeWeek()
    {
        $this->layout = 'main';
        return $this->render('/user-poor-time-week');
    }

    public function actionUserProfileSettings()
    {
        $this->layout = 'main';
        return $this->render('/user-profile-settings');
    }

    public function actionUserProjectsAndTasks()
    {
        $this->layout = 'main';
        return $this->render('/user-projects-and-tasks');
    }

    public function actionUserProjectsArchived()
    {
        $this->layout = 'main';
        return $this->render('/user-projects-archived');
    }

    public function actionUserProjects()
    {
        $this->layout = 'main';
        return $this->render('/user-projects');
    }

    public function actionUserSecuritySettings()
    {
        $this->layout = 'main';
        return $this->render('/user-security-settings');
    }

    public function actionUserTasksGrid()
    {
        $this->layout = 'main';
        return $this->render('/user-tasks-grid');
    }

    public function actionUserTasks()
    {
        $this->layout = 'main';
        return $this->render('/user-tasks');
    }

    public function actionUserTeamsSettings()
    {
        $this->layout = 'main';
        return $this->render('/user-teams-settings');
    }

    public function actionUserTimelineReport()
    {
        $this->layout = 'main';
        return $this->render('/user-timeline-report');
    }

    public function actionUserTimelineScreenshots()
    {
        $this->layout = 'main';
        return $this->render('/user-timeline-screenshots');
    }

    public function actionUserTimelineUsage()
    {
        $this->layout = 'main';
        return $this->render('/user-timeline-usage');
    }

    public function actionUserTimelineWeek()
    {
        $this->layout = 'main';
        return $this->render('/user-timeline-week');
    }

    public function actionUserTimesheetMonth()
    {
        $this->layout = 'main';
        return $this->render('/user-timesheet-month');
    }

    public function actionUserTimesheetReport()
    {
        $this->layout = 'main';
        return $this->render('/user-timesheet-report');
    }

    public function actionUserTimesheetWeek()
    {
        $this->layout = 'main';
        return $this->render('/user-timesheet-week');
    }

    public function actionUserTimesheet()
    {
        $this->layout = 'main';
        return $this->render('/user-timesheet');
    }

    public function actionUserUnusualActivity()
    {
        $this->layout = 'main';
        return $this->render('/user-unusual-activity');
    }

    public function actionUserWebAndAppUsage()
    {
        $this->layout = 'main';
        return $this->render('/user-web-and-app-usage');
    }

    public function actionUserWorkingOnWeekends()
    {
        $this->layout = 'main';
        return $this->render('/user-working-on-weekends');
    }

    public function actionUsers()
    {
        $this->layout = 'main';
        return $this->render('/users');
    }

    public function actionVideoCall()
    {
        $this->layout = 'main';
        return $this->render('/video-call');
    }

    public function actionVoiceCall()
    {
        $this->layout = 'main';
        return $this->render('/voice-call');
    }

    public function actionWebAppUsage()
    {
        $this->layout = 'main';
        return $this->render('/web-app-usage');
    }

    public function actionWidgets()
    {
        $this->layout = 'main';
        return $this->render('/widgets');
    }

    public function actionWorkingHoursSettings()
    {
        $this->layout = 'main';
        return $this->render('/working-hours-settings');
    }

    public function actionWorkingOnWeekends()
    {
        $this->layout = 'main';
        return $this->render('/working-on-weekends');
    }

}