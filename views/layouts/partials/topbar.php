<?php
use yii\helpers\Html;
use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
// Handle root path - if empty, treat as index page
$page = empty($path) ? 'index' : basename($path);
?>

    <!-- Topbar Start -->
    <header class="navbar-header">
        <div class="topbar-menu">
            <div class="d-flex align-items-center gap-2">

                <!-- Logo -->
                <a href="index" class="logo">

                    <!-- Logo Normal -->
                    <span class="logo-light">
                        <span class="logo-lg"><img src="/assets/img/logo.svg" alt="logo"></span>
                        <span class="logo-sm"><img src="/assets/img/logo-small.svg" alt="small logo"></span>
                    </span>

                    <!-- Logo Dark -->
                    <span class="logo-dark">
                        <span class="logo-lg"><img src="/assets/img/logo-white.svg" alt="dark logo"></span>
                    </span>
                </a>

                <!-- Sidebar Toggle Button -->
                <button class="sidenav-toggle-btn btn border-0 p-0" id="toggle_btn"> 
                    <i class="ti ti-menu-4 fs-24"></i>
                </button>

                <!-- Sidebar Mobile Button -->
                <a id="mobile_btn" class="mobile-btn" href="#sidebar">
                    <i class="ti ti-menu-deep fs-24"></i>
                </a>    
                
                <!-- Search -->
                <div class="header-search d-lg-flex d-none">
                    <div class="input-group input-group-sm input-group-flat">
                        <input id="topbar-search" name="q" type="text" class="form-control" placeholder="Search Keyword" autocomplete="off" aria-label="Search">
                        <span class="input-group-text">
                            <kbd>ctrl + K</kbd>
                        </span>
                    </div>
                </div>
                
            </div>

            <div class="d-flex align-items-center gap-1">
            
                <!-- Search for Mobile -->
                <div class="header-item d-flex d-xl-none">
                    <button class="topbar-link btn btn-icon" data-bs-toggle="modal" data-bs-target="#searchModal" type="button">
                        <i class="ti ti-search fs-16"></i>
                    </button>
                </div>
                
                <!-- Language Dropdown -->
                <div class="header-item">
                    <div class="dropdown">
                        <button class="topbar-link btn btn-icon" data-bs-toggle="dropdown" data-bs-offset="0,24" type="button" aria-haspopup="false" aria-expanded="false">
                            <img src="/assets/img/flags/us.svg" alt="Language" height="16">
                        </button>
                        
                        <div class="dropdown-menu dropdown-menu-end p-2">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="/assets/img/flags/us.svg" alt="" class="me-1" height="16"> <span class="align-middle">English</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="/assets/img/flags/de.svg" alt="" class="me-1" height="16"> <span class="align-middle">German</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="/assets/img/flags/fr.svg" alt="" class="me-1" height="16"> <span class="align-middle">French</span>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <img src="/assets/img/flags/ae.svg" alt="" class="me-1" height="16"> <span class="align-middle">Arabic</span>
                            </a>
                            
                        </div>
                    </div>
                </div>

                <?php if ($page !== 'layout-mini' && $page !== 'layout-hoverview'  && $page !== 'layout-hidden' && $page !== 'layout-fullwidth' && $page !== 'layout-rtl' && $page !== 'layout-dark') {   ?>
                <!-- Light/Dark Mode Button -->
                <div class="header-item d-none d-sm-flex">
                    <button class="topbar-link btn btn-icon" id="light-dark-mode" type="button">
                        <i class="ti ti-moon fs-16"></i>
                    </button>
                </div>
                <?php } ?>
                <!-- Notification Dropdown -->
                <div class="header-item">
                    <div class="dropdown">
                    
                        <button class="topbar-link btn btn-icon dropdown-toggle drop-arrow-none" data-bs-toggle="dropdown" data-bs-offset="0,24" type="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ti ti-bell-check fs-16 animate-ring"></i>
                            <span class="notification-badge"></span>
                        </button>
                        
                        <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="min-height: 300px;">
                        
                            <div class="p-3 border-bottom">
                                <div class="row align-items-center">
                                    <div class="col justify-content-between d-flex align-items-center gap-2 flex-wrap">
                                        <h6 class="m-0 fs-16 fw-semibold"> Notifications</h6>
                                        <span class="badge badge-sm bg-danger">2 Unread</span>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <!-- Notification Body -->
                            <div class="notification-body position-relative z-2 rounded-0" data-simplebar>
                                
                                <!-- Item-->
                                <div class="dropdown-item notification-item py-2 text-wrap border-bottom" id="notification-1">
                                    <div class="d-flex">
                                        <div class="me-2 position-relative flex-shrink-0">
                                            <img src="/assets/img/profiles/avatar-02.jpg" class="avatar-md rounded-circle" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 fw-semibold text-dark">Jerry Manas</p>
                                            <p class="mb-1 text-wrap fs-14">
                                                Added a new task on <span class="fw-semibold">Login Pages</span>
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-12 d-flex align-items-center"><i class="ti ti-clock me-1"></i>4 min ago</span>
                                                <div class="notification-action d-flex align-items-center float-end gap-2">
                                                    <a href="javascript:void(0);" class="notification-read rounded-circle bg-danger" data-bs-toggle="tooltip" title="" data-bs-original-title="Make as Read" aria-label="Make as Read"></a>
                                                    <button class="btn rounded-circle text-danger p-0" data-dismissible="#notification-1">
                                                        <i class="ti ti-x fs-12"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <!-- Item-->
                                <div class="dropdown-item notification-item py-2 text-wrap border-bottom" id="notification-2">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm me-2">
                                                    <span class="avatar-title bg-soft-info text-info fs-18 rounded-circle">D</span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 fw-semibold text-dark">Donoghue Susan</p>
                                            <p class="mb-0 text-wrap fs-14">
                                                Hi, How are you? What about our next meeting
                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-12 d-flex align-items-center"><i class="ti ti-clock me-1"></i>4 min ago</span>
                                                <div class="notification-action d-flex align-items-center float-end gap-2">
                                                    <a href="javascript:void(0);" class="notification-read rounded-circle bg-danger" data-bs-toggle="tooltip" title="" data-bs-original-title="Make as Read" aria-label="Make as Read"></a>
                                                    <button class="btn rounded-circle text-danger p-0" data-dismissible="#notification-2">
                                                        <i class="ti ti-x fs-12"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Item-->
                                <div class="dropdown-item notification-item py-2 text-wrap border-bottom" id="notification-3">
                                    <div class="d-flex">
                                        <span class="me-2 position-relative flex-shrink-0">
                                            <img src="/assets/img/profiles/avatar-10.jpg" class="avatar-md rounded-circle" alt="">
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 fw-semibold text-dark">Robert Fox </p>
                                            <p class="mb-1 text-wrap fs-14"> marked as late login <span class="fw-semibold">09:55 AM</span></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-12 d-flex align-items-center"><i class="ti ti-clock me-1"></i>4 min ago</span>
                                                <div class="notification-action d-flex align-items-center float-end gap-2">
                                                    <a href="javascript:void(0);" class="notification-read rounded-circle bg-danger" data-bs-toggle="tooltip" title="" data-bs-original-title="Make as Read" aria-label="Make as Read"></a>
                                                    <button class="btn rounded-circle text-danger p-0" data-dismissible="#notification-3">
                                                        <i class="ti ti-x fs-12"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Item-->
                                <div class="dropdown-item notification-item py-2 text-wrap border-bottom" id="notification-4">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title bg-soft-warning text-warning fs-18 rounded-circle">
                                                    <i class="ti ti-message"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 text-wrap fs-14">You have received <span class="fw-semibold">20</span> new messages in the conversation</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-12 d-flex align-items-center"><i class="ti ti-clock me-1"></i>4 min ago</span>
                                                <div class="notification-action d-flex align-items-center float-end gap-2">
                                                    <a href="javascript:void(0);" class="notification-read rounded-circle bg-danger" data-bs-toggle="tooltip" title="" data-bs-original-title="Make as Read" aria-label="Make as Read"></a>
                                                    <button class="btn rounded-circle text-danger p-0" data-dismissible="#notification-4">
                                                        <i class="ti ti-x fs-12"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Item-->
                                <div class="dropdown-item notification-item py-2 text-wrap border-bottom" id="notification-5">
                                    <div class="d-flex">
                                        <div class="me-2 position-relative flex-shrink-0">
                                            <img src="/assets/img/profiles/avatar-19.jpg" class="avatar-md rounded-circle" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 fw-semibold text-dark">Robert Fox </p>
                                            <p class="mb-1 text-wrap fs-14">Requested leave on <span class="fw-semibold">12 May 2025</span></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-12 d-flex align-items-center"><i class="ti ti-clock me-1"></i>4 min ago</span>
                                                <div class="notification-action d-flex align-items-center float-end gap-2">
                                                    <a href="javascript:void(0);" class="notification-read rounded-circle bg-danger" data-bs-toggle="tooltip" title="" data-bs-original-title="Make as Read" aria-label="Make as Read"></a>
                                                    <button class="btn rounded-circle text-danger p-0" data-dismissible="#notification-5">
                                                        <i class="ti ti-x fs-12"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Item-->
                                <div class="dropdown-item notification-item py-2 text-wrap" id="notification-6">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-sm me-2">
                                                <span class="avatar-title bg-soft-danger text-danger fs-20 rounded-circle">
                                                    <i class="ti ti-alert-triangle"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-1 text-wrap fs-14">You have received <b>20</b> new messages in the conversation</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="fs-12 d-flex align-items-center"><i class="ti ti-clock me-1"></i>4 min ago</span>
                                                <div class="notification-action d-flex align-items-center float-end gap-2">
                                                    <a href="javascript:void(0);" class="notification-read rounded-circle bg-danger" data-bs-toggle="tooltip" title="" data-bs-original-title="Make as Read" aria-label="Make as Read"></a>
                                                    <button class="btn rounded-circle text-danger p-0" data-dismissible="#notification-6">
                                                        <i class="ti ti-x fs-12"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- View All-->
                            <div class="p-2 rounded-bottom border-top text-center">
                                <a href="notifications" class="text-center fw-medium fs-14 mb-0">
                                    View All
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <!-- User Dropdown -->
                <div class="dropdown profile-dropdown d-flex align-items-center justify-content-center">
                    <a class="topbar-link dropdown-toggle drop-arrow-none" href="#" data-bs-toggle="dropdown" data-bs-offset="0,22" aria-haspopup="false" aria-expanded="false">
                        <img src="/assets/img/profiles/avatar-01.jpg" width="24" class="rounded-circle d-flex" alt="user-image">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-3">
                        <div class="d-flex align-items-center justify-content-between bg-light rounded mb-3 p-3">
                            <div class="d-flex align-items-center">
                                <img src="/assets/img/profiles/avatar-01.jpg" class="rounded-circle" width="42" height="42" alt="">
                                <div class="ms-2">
                                    <h5 class="mb-1 fs-14">Shaun Farley</h5>
                                    <span class="d-block fs-13">Manager</span>
                                </div>
                            </div>
                            <span class="badge badg-sm bg-success d-flex align-items-center gap-2"> <i class="ti ti-bolt"></i>  Pro</span>
                        </div>

                        <!-- Item-->
                        <a href="profile" class="dropdown-item">
                            <i class="ti ti-user me-1 fs-17 align-middle"></i>
                            <span class="align-middle">Profile Settings</span>
                        </a>

                        <!-- Item-->
                        <a href="profile-settings" class="dropdown-item">
                            <i class="ti ti-settings-2 me-1 fs-17 align-middle"></i>
                            <span class="align-middle">Settings</span>
                        </a>

                        <!-- Item-->
                        <a href="email" class="dropdown-item">
                            <i class="ti ti-mail me-1 fs-17 align-middle"></i>
                            <span class="align-middle">Mail Box</span>
                        </a>
                        <div class="my-2 py-2 border-top border-bottom">
                            <!-- Item-->
                            <a href="activity-logs" class="dropdown-item">
                                <i class="ti ti-lifebuoy me-1 fs-17 align-middle"></i>
                                <span class="align-middle">Activity Log</span>
                            </a>
                            <!-- Item-->
                            <a href="javascript:void(0);" class="dropdown-item">
                                <i class="ti ti-file-pencil me-1 fs-17 align-middle"></i>
                                <span class="align-middle">Documentation</span>
                            </a>
                        </div>
                        <!-- Item-->
                        <a href="login" class="dropdown-item">
                            <i class="ti ti-logout me-1 fs-17 align-middle text-danger"></i>
                            <span class="align-middle text-danger">Sign Out</span>
                        </a>
                    </div>
                </div>
                    
            </div>
        </div>
    </header>
    <!-- Topbar End -->

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-transparent">
                <div class="card shadow-none mb-0">
                    <div class="px-3 py-2 d-flex flex-row align-items-center" id="search-top">
                        <i class="ti ti-search fs-22"></i>
                        <input id="search-modal-input" name="q_modal" type="search" class="form-control border-0" placeholder="Search" aria-label="Search">
                        <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x fs-22"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
