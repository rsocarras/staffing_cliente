<?php
use yii\helpers\Html;
use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
// Handle root path - if empty, treat as index page
$page = empty($path) ? 'index' : basename($path);
?>

    <!-- Settings Sidebar -->
    <div class="settings-sidebar" id="sidebar2">
        <div class="sidebar-inner">
            <!-- toggle item -->
            <div class="settings-sidebar-header">
                <h6 class="mb-0 ">Settings Menu</h6>
                <button class="settings-sidebar-close d-lg-none" id="settings-sidebar-close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <div id="sidebar-menu5" class="sidebar-menu p-0">
                <ul>
                    <li class="submenu-open">
                        <ul>
                            <li class="<?php echo ($page =='profile-settings' || $page == 'security-settings') ? 'active' : '' ;?>">
                                <a href="profile-settings">
                                    <i class="ti ti-user-circle fs-14"></i>
                                    <span class="fs-14 fw-medium ms-2">Account Settings</span>
                                </a>
                            </li>
                            <li class="<?php echo ($page =='company-settings' || $page == 'department-settings' || $page == 'location-settings' || $page == 'employee-settings') ? 'active' : '' ;?>">
                                <a href="company-settings">
                                    <i class="ti ti-building-skyscraper fs-14"></i>
                                    <span class="fs-14 fw-medium ms-2">Company Settings</span>
                                </a>
                            </li>
                            <li class="<?php echo ($page =='leave-types-settings' || $page == 'leave-types' || $page == 'working-hours-settings' || $page == 'shift-settings' || $page == 'tracker-settings' || $page == 'productivity-ratings-settings') ? 'active' : '' ;?>">
                                <a href="leave-types-settings">
                                    <i class="ti ti-activity fs-14"></i>
                                    <span class="fs-14 fw-medium ms-2">Work Settings</span>
                                </a>
                            </li>
                            <li class="<?php echo ($page =='expense-category-settings' || $page == 'expense-type-settings' || $page == 'payment-method-settings' || $page == 'currencies-settings' || $page == 'taxes-settings') ? 'active' : '' ;?>">
                                <a href="expense-category-settings">
                                    <i class="ti ti-settings-dollar fs-14"></i>
                                    <span class="fs-14 fw-medium ms-2">Finance & Accounts</span>
                                </a>
                            </li>
                            <li class="<?php echo ($page =='localization-settings' || $page == 'custom-fields-settings' || $page == 'preference-settings' || $page == 'notifications-settings' || $page == 'integrations-settings' || $page == 'appearance-settings') ? 'active' : '' ;?>"> 
                                <a href="localization-settings">
                                    <i class="ti ti-device-desktop fs-14"></i>
                                    <span class="fs-14 fw-medium ms-2">System Settings</span>
                                </a>
                            </li>
                            <li class="<?php echo ($page =='plans-and-billings') ? 'active' : '' ;?>">
                                <a href="plans-and-billings">
                                    <i class="ti ti-file-invoice fs-14"></i>
                                    <span class="fs-14 fw-medium ms-2">Plans & Billing</span>
                                </a>
                            </li>
                            <li class="<?php echo ($page =='delete-account') ? 'active' : '' ;?>">
                                <a href="delete-account">
                                    <i class="ti ti-trash-x fs-14"></i>
                                    <span class="fs-14 fw-medium ms-2">Delete Account</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div> <!-- end settings sidebar -->
