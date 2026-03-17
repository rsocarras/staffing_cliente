<?php

namespace app\controllers;

use app\models\LocationSedes;
use app\models\Profile;
use app\services\MallaTimesheetService;
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
        return $this->render('/plantilla/index');
    }

    public function actionActivityLogs()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/activity-logs');
    }

    public function actionActivitySummaryMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/activity-summary-month');
    }

    public function actionActivitySummaryWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/activity-summary-week');
    }

    public function actionActivitySummary()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/activity-summary');
    }

    public function actionAddInvoice()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/add-invoice');
    }

    public function actionAddProject()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/add-project');
    }

    public function actionApiKeys()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/api-keys');
    }

    public function actionAppearanceSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/appearance-settings');
    }

    public function actionAttendanceReportMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/attendance-report-month');
    }

    public function actionAttendanceReportWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/attendance-report-week');
    }

    public function actionAttendanceReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/attendance-report');
    }

    public function actionAttendance()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/attendance');
    }

    public function actionBlogCategories()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/blog-categories');
    }

    public function actionBlogComments()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/blog-comments');
    }

    public function actionBlogDetail()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/blog-detail');
    }

    public function actionBlogTags()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/blog-tags');
    }

    public function actionBlogs()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/blogs');
    }

    public function actionCalendar()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/calendar');
    }

    public function actionChartApex()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/chart-apex');
    }

    public function actionChartC3()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/chart-c3');
    }

    public function actionChartFlot()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/chart-flot');
    }

    public function actionChartJs()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/chart-js');
    }

    public function actionChartMorris()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/chart-morris');
    }

    public function actionChat()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/chat');
    }

    public function actionCities()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/cities');
    }

    public function actionClientsGrid()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/clients-grid');
    }

    public function actionClients()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/clients');
    }

    public function actionComingSoon()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/coming-soon');
    }

    public function actionCompanySettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/company-settings');
    }

    public function actionContactList()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/contact-list');
    }

    public function actionContacts()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/contacts');
    }

    public function actionCountries()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/countries');
    }

    public function actionCurrenciesSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/currencies-settings');
    }

    public function actionCustomFieldsSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/custom-fields-settings');
    }

    public function actionDataTables()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/data-tables');
    }

    public function actionDeleteAccount()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/delete-account');
    }

    public function actionDepartmentSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/department-settings');
    }

    public function actionDownload()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/download');
    }

    public function actionEditInvoice()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/edit-invoice');
    }

    public function actionEditProject()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/edit-project');
    }

    public function actionEditShift()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/edit-shift');
    }

    public function actionEditTimeApproved()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/edit-time-approved');
    }

    public function actionEditTimeRequest()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/edit-time-request');
    }

    public function actionEditTimeWaiting()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/edit-time-waiting');
    }

    public function actionEditTime()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/edit-time');
    }

    public function actionEditUser()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/edit-user');
    }

    public function actionEmailCompose()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/email-compose');
    }

    public function actionEmailDetails()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/email-details');
    }

    public function actionEmailVerification2()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/email-verification-2');
    }

    public function actionEmailVerification3()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/email-verification-3');
    }

    public function actionEmailVerification()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/email-verification');
    }

    public function actionEmail()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/email');
    }

    public function actionEmployeeDetails()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/employee-details');
    }    

    public function actionEmployeeSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/employee-settings');
    }

    public function actionEmployeesArchived()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/employees-archived');
    }  
    
    public function actionEmployeesDeactivated()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/employees-deactivated');
    }    

    public function actionEmployees()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/employees');
    }

    public function actionError404()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/error-404');
    }

    public function actionError500()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/error-500');
    }

    public function actionExpenseApproved()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/expense-approved');
    }

    public function actionExpenseCategorySettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/expense-category-settings');
    }

    public function actionExpenseRejected()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/expense-rejected');
    }

    public function actionExpenseReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/expense-report');
    }

    public function actionExpenseRequested()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/expense-requested');
    }

    public function actionExpenseTypeSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/expense-type-settings');
    }

    public function actionExpense()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/expense');
    }

    public function actionFaq()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/faq');
    }

    public function actionFileManager()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/file-manager');
    }

    public function actionForgotPassword2()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/forgot-password-2');
    }

    public function actionForgotPassword3()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/forgot-password-3');
    }

    public function actionForgotPassword()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/forgot-password');
    }

    public function actionFormBasicInputs()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-basic-inputs');
    }

    public function actionFormCheckboxRadios()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-checkbox-radios');
    }

    public function actionFormEditors()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-editors');
    }

    public function actionFormFileupload()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-fileupload');
    }

    public function actionFormFloatingLabels()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-floating-labels');
    }

    public function actionFormGridGutters()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-grid-gutters');
    }

    public function actionFormHorizontal()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-horizontal');
    }

    public function actionFormInputGroups()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-input-groups');
    }

    public function actionFormMask()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-mask');
    }

    public function actionFormPickers()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-pickers');
    }

    public function actionFormSelect()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-select');
    }

    public function actionFormValidation()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-validation');
    }

    public function actionFormVertical()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/form-vertical');
    }

    public function actionFreeTrial2()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/free-trial-2');
    }

    public function actionFreeTrial3()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/free-trial-3');
    }

    public function actionFreeTrial()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/free-trial');
    }

    public function actionGallery()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/gallery');
    }

    public function actionHoursTrackedMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/hours-tracked-month');
    }

    public function actionHoursTrackedWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/hours-tracked-week');
    }

    public function actionHoursTracked()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/hours-tracked');
    }

    public function actionIconBootstrap()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-bootstrap');
    }

    public function actionIconFeather()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-feather');
    }

    public function actionIconFlag()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-flag');
    }

    public function actionIconFontawesome()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-fontawesome');
    }

    public function actionIconIonic()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-ionic');
    }

    public function actionIconMaterial()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-material');
    }

    public function actionIconPe7()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-pe7');
    }

    public function actionIconRemix()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-remix');
    }

    public function actionIconSimpleline()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-simpleline');
    }

    public function actionIconTabler()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-tabler');
    }

    public function actionIconThemify()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-themify');
    }

    public function actionIconTypicon()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-typicon');
    }

    public function actionIconWeather()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/icon-weather');
    }

    public function actionIdleTime()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/idle-time');
    }

    public function actionIndex()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/index');
    }

    public function actionIntegrationsSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/integrations-settings');
    }

    public function actionInviteUsers()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/invite-users');
    }

    public function actionInvoiceDetails()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/invoice-details');
    }

    public function actionInvoice()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/invoice');
    }

    public function actionInvoices()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/invoices');
    }

    public function actionKanbanView()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/kanban-view');
    }

    public function actionLayoutDark()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/layout-dark');
    }

    public function actionLayoutFullwidth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/layout-fullwidth');
    }

    public function actionLayoutHidden()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/layout-hidden');
    }

    public function actionLayoutHoverview()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/layout-hoverview');
    }

    public function actionLayoutMini()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/layout-mini');
    }

    public function actionLayoutRtl()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/layout-rtl');
    }

    public function actionLeaveApproved()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/leave-approved');
    }

    public function actionLeaveRejected()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/leave-rejected');
    }

    public function actionLeaveTypesSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/leave-types-settings');
    }

    public function actionLeaveTypes()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/leave-types');
    }

    public function actionLeave()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/leave');
    }

    public function actionLiveTracking()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/live-tracking');
    } 
    
    public function actionLiveTrackingMinute()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/live-tracking-minute');
    }    

    public function actionLocalizationSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/localization-settings');
    }

    public function actionLocationSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/location-settings');
    }

    public function actionLockScreen()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/lock-screen');
    }

    public function actionLogin2()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/login-2');
    }

    public function actionLogin3()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/login-3');
    }

    public function actionLogin()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/login');
    }

    public function actionLowActivity()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/low-activity');
    }

    public function actionManualTimeWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/manual-time-week');
    }

    public function actionManualTime()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/manual-time');
    }

    public function actionNotes()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/notes');
    }

    public function actionNotificationsSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/notifications-settings');
    }

    public function actionNotifications()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/notifications');
    }

    public function actionOvertimeLimit()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/overtime-limit');
    }

    public function actionPages()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/pages');
    }

    public function actionPaymentMethodSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/payment-method-settings');
    }

    public function actionPermissions()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/permissions');
    }

    public function actionPlansAndBillings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/plans-and-billings');
    }

    public function actionPlugin()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/plugin');
    }

    public function actionPoorTimeMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/poor-time-month');
    }

    public function actionPoorTimeUse()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/poor-time-use');
    }    

    public function actionPoorTimeWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/poor-time-week');
    }

    public function actionPreferenceSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/preference-settings');
    }

    public function actionPricing()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/pricing');
    }

    public function actionPrivacyPolicy()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/privacy-policy');
    }

    public function actionProductivityRatingsSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/productivity-ratings-settings');
    }

    public function actionProfileSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/profile-settings');
    }

    public function actionProfile()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/profile');
    }

    public function actionProjectArchived()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-archived');
    }

    public function actionProjectCompleted()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-completed');
    }

    public function actionProjectDetailsMilestonesGrid()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-details-milestones-grid');
    }

    public function actionProjectDetailsMilestones()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-details-milestones');
    }

    public function actionProjectDetailsScreenshots()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-details-screenshots');
    }

    public function actionProjectDetailsTaskList()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-details-task-list');
    }

    public function actionProjectDetailsTask()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-details-task');
    }

    public function actionProjectDetailsUsage()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-details-usage');
    }

    public function actionProjectDetails()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-details');
    }

    public function actionProjectHold()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project-hold');
    }

    public function actionProject()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/project');
    }

    public function actionProjectsGrid()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/projects-grid');
    }

    public function actionProjectsTasks()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/projects-tasks');
    }

    public function actionProjects()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/projects');
    }

    public function actionRegister2()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/register-2');
    }

    public function actionRegister3()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/register-3');
    }

    public function actionRegister()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/register');
    }

    public function actionReports()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/reports');
    }

    public function actionResetPassword2()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/reset-password-2');
    }

    public function actionResetPassword3()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/reset-password-3');
    }

    public function actionResetPassword()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/reset-password');
    }

    public function actionRolesPermissions()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/roles-permissions');
    }

    public function actionScreenshots()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/screenshots');
    }

    public function actionSearchResults()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/search-results');
    }

    public function actionSecuritySettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/security-settings');
    }

    public function actionShiftSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/shift-settings');
    }

    public function actionShiftsLeaveTypes()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/shifts-leave-types');
    }

    public function actionSocialFeed()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/social-feed');
    }

    public function actionStarter()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/starter');
    }

    public function actionStates()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/states');
    }

    public function actionSuccess2()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/success-2');
    }

    public function actionSuccess3()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/success-3');
    }

    public function actionSuccess()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/success');
    }

    public function actionTablesBasic()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/tables-basic');
    }

    public function actionTasksArchived()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/tasks-archived');
    }

    public function actionTasksCompleted()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/tasks-completed');
    }

    public function actionTasksGrid()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/tasks-grid');
    }

    public function actionTasksOnhold()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/tasks-onhold');
    }

    public function actionTasks()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/tasks');
    }

    public function actionTaxesSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/taxes-settings');
    }

    public function actionTeamsGrid()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/teams-grid');
    }

    public function actionTeams()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/teams');
    }

    public function actionTermsCondition()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/terms-condition');
    }

    public function actionTestimonials()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/testimonials');
    }

    public function actionTimelineDetails()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/timeline-details');
    }

    public function actionTimelineReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/timeline-report');
    }

    public function actionTimeline()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/timeline');
    }

    public function actionTimesheetReportWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/timesheet-report-week');
    }

    public function actionTimesheetReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/timesheet-report');
    }

    public function actionTimesheetWeek()
    {
        $this->layout = 'main';
        $empresaId = $this->currentEmpresaId();
        $sedes = $empresaId ? LocationSedes::find()->where(['empresa_id' => $empresaId, 'activo' => 1])->orderBy(['nombre' => SORT_ASC])->all() : [];
        $sedeId = (int) $this->request->get('sede_id', 0);
        $anchorDate = $this->request->get('date', date('Y-m-d'));
        $weekData = null;
        if ($empresaId && $sedeId > 0) {
            $weekData = MallaTimesheetService::buildWeek($empresaId, $sedeId, $anchorDate);
        }

        return $this->render('/plantilla/timesheet-week', [
            'sedes' => $sedes,
            'sedeId' => $sedeId,
            'anchorDate' => $anchorDate,
            'weekData' => $weekData,
        ]);
    }

    public function actionTimesheet()
    {
        $this->layout = 'main';
        $empresaId = $this->currentEmpresaId();
        $sedes = $empresaId ? LocationSedes::find()->where(['empresa_id' => $empresaId, 'activo' => 1])->orderBy(['nombre' => SORT_ASC])->all() : [];
        $sedeId = (int) $this->request->get('sede_id', 0);
        $date = $this->request->get('date', date('Y-m-d'));
        $dayData = null;
        if ($empresaId && $sedeId > 0) {
            $dayData = MallaTimesheetService::buildDay($empresaId, $sedeId, $date);
        }

        return $this->render('/plantilla/timesheet', [
            'sedes' => $sedes,
            'sedeId' => $sedeId,
            'date' => $date,
            'dayData' => $dayData,
        ]);
    }

    public function actionTodoList()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/todo-list');
    }

    public function actionTodo()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/todo');
    }

    public function actionTrackerSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/tracker-settings');
    }

    public function actionTwoStepVerification2()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/two-step-verification-2');
    }

    public function actionTwoStepVerification3()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/two-step-verification-3');
    }

    public function actionTwoStepVerification()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/two-step-verification');
    }

    public function actionUiAccordion()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-accordion');
    }

    public function actionUiAlerts()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-alerts');
    }

    public function actionUiAvatar()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-avatar');
    }

    public function actionUiBadges()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-badges');
    }

    public function actionUiBreadcrumb()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-breadcrumb');
    }

    public function actionUiButtonsGroup()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-buttons-group');
    }

    public function actionUiButtons()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-buttons');
    }

    public function actionUiCards()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-cards');
    }

    public function actionUiCarousel()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-carousel');
    }

    public function actionUiClipboard()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-clipboard');
    }

    public function actionUiCollapse()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-collapse');
    }

    public function actionUiDragula()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-dragula');
    }

    public function actionUiDropdowns()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-dropdowns');
    }

    public function actionUiGrid()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-grid');
    }

    public function actionUiImages()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-images');
    }

    public function actionUiLightbox()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-lightbox');
    }

    public function actionUiLinks()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-links');
    }

    public function actionUiListGroup()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-list-group');
    }

    public function actionUiModals()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-modals');
    }

    public function actionUiNavTabs()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-nav-tabs');
    }

    public function actionUiOffcanvas()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-offcanvas');
    }

    public function actionUiPagination()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-pagination');
    }

    public function actionUiPlaceholders()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-placeholders');
    }

    public function actionUiPopovers()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-popovers');
    }

    public function actionUiProgress()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-progress');
    }

    public function actionUiRangeslider()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-rangeslider');
    }

    public function actionUiRating()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-rating');
    }

    public function actionUiRatio()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-ratio');
    }

    public function actionUiScrollbar()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-scrollbar');
    }

    public function actionUiScrollspy()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-scrollspy');
    }

    public function actionUiSpinner()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-spinner');
    }

    public function actionUiSweetalerts()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-sweetalerts');
    }

    public function actionUiToasts()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-toasts');
    }

    public function actionUiTooltips()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-tooltips');
    }

    public function actionUiTypography()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-typography');
    }

    public function actionUiUtilities()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/ui-utilities');
    }

    public function actionUnderConstruction()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/under-construction');
    }

    public function actionUnderMaintenance()
    {
        $this->layout = 'auth_main';
        return $this->render('/plantilla/under-maintenance');
    }

    public function actionUnusualActivity()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/unusual-activity');
    }

    public function actionUsageTimelineDetails()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/usage-timeline-details');
    }

    public function actionUserActivitySummaryMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-activity-summary-month');
    }

    public function actionUserActivitySummaryWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-activity-summary-week');
    }

    public function actionUserActivitySummary()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-activity-summary');
    }

    public function actionUserArchived()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-archived');
    }

    public function actionUserAttendanceReportMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-attendance-report-month');
    }

    public function actionUserAttendanceReportWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-attendance-report-week');
    }

    public function actionUserAttendanceReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-attendance-report');
    }

    public function actionUserAttendance()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-attendance');
    }

    public function actionUserDashboard()
    {
        //$this->layout = '../main';
        return $this->render('/plantilla/user-dashboard');
    }

    public function actionUserHoursTrackedMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-hours-tracked-month');
    }

    public function actionUserHoursTrackedWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-hours-tracked-week');
    }

    public function actionUserHoursTrackedReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-hours-tracked-report');
    }

    public function actionUserIdleTimeReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-idle-time-report');
    }

    public function actionUserInviteStatus()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-invite-status');
    }

    public function actionUserLeaveApproved()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-leave-approved');
    }

    public function actionUserLeavePending()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-leave-pending');
    }

    public function actionUserLeaveRejected()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-leave-rejected');
    }

    public function actionUserLowActivityReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-low-activity-report');
    }

    public function actionUserManualTimeMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-manual-time-month');
    }

    public function actionUserManualTimeReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-manual-time-report');
    }

    public function actionUserManualTimeWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-manual-time-week');
    }

    public function actionUserOverlimitTimeReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-overlimit-time-report');
    }

    public function actionUserPoorTimeMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-poor-time-month');
    }

    public function actionUserPoorTimeUseReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-poor-time-use-report');
    }

    public function actionUserPoorTimeWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-poor-time-week');
    }

    public function actionUserProfileSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-profile-settings');
    }

    public function actionUserProjectsAndTasks()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-projects-and-tasks');
    }

    public function actionUserProjectsArchived()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-projects-archived');
    }

    public function actionUserProjects()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-projects');
    }

    public function actionUserSecuritySettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-security-settings');
    }

    public function actionUserTasksGrid()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-tasks-grid');
    }

    public function actionUserTasks()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-tasks');
    }

    public function actionUserTeamsSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-teams-settings');
    }

    public function actionUserTimelineReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-timeline-report');
    }

    public function actionUserTimelineScreenshots()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-timeline-screenshots');
    }

    public function actionUserTimelineUsage()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-timeline-usage');
    }

    public function actionUserTimelineWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-timeline-week');
    }

    public function actionUserTimesheetMonth()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-timesheet-month');
    }

    public function actionUserTimesheetReport()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-timesheet-report');
    }

    public function actionUserTimesheetWeek()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-timesheet-week');
    }

    public function actionUserTimesheet()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-timesheet');
    }

    public function actionUserUnusualActivity()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-unusual-activity');
    }

    public function actionUserWebAndAppUsage()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-web-and-app-usage');
    }

    public function actionUserWorkingOnWeekends()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/user-working-on-weekends');
    }

    public function actionUsers()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/users');
    }

    public function actionVideoCall()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/video-call');
    }

    public function actionVoiceCall()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/voice-call');
    }

    public function actionWebAppUsage()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/web-app-usage');
    }

    public function actionWidgets()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/widgets');
    }

    public function actionWorkingHoursSettings()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/working-hours-settings');
    }

    public function actionWorkingOnWeekends()
    {
        $this->layout = 'main';
        return $this->render('/plantilla/working-on-weekends');
    }

    private function currentEmpresaId(): ?int
    {
        if (Yii::$app->user->isGuest) {
            return null;
        }
        $profile = Profile::findOne(['user_id' => Yii::$app->user->id]);
        return $profile ? (int) $profile->empresas_id : null;
    }

}