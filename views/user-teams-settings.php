    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="card mb-0">
                <div class="card-body">
                    <!-- Page Header -->
                    <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-4">
                        <div class="flex-grow-1">
                            <h4 class="fs-20 fw-bold mb-0">Settings</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Settings</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="settings-wrapper d-flex">
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
                                                        <li>
                                                            <a href="user-profile-settings">
                                                                <i class="ti ti-user-circle fs-14"></i>
                                                                <span class="fs-14 fw-medium ms-2">Profile</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="user-security-settings">
                                                                <i class="ti ti-user-cog fs-14"></i>
                                                                <span class="fs-14 fw-medium ms-2">Security</span>
                                                            </a>
                                                        </li>
                                                        <li class="active">
                                                            <a href="user-teams-settings">
                                                                <i class="ti ti-users-group fs-14"></i>
                                                                <span class="fs-14 fw-medium ms-2">Teams</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- end settings sidebar -->

                                <div class="card flex-fill mb-0 bg-soft-light border shadow-none">
                                    <div class="card-body">

                                        <!-- start table -->
                                        <div class="table-responsive">
                                            <table class="table bg-white border table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Team Name</th>
                                                        <th>Role</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="avatar avatar-rounded bg-primary-subtle">
                                                                    <span class="avatar-title text-primary">UI</span>
                                                                </a>
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0 fs-14"><a href="#">UI/UX Designer</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="fs-14 fw-regular text-dark">Member</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="avatar avatar-rounded bg-danger-subtle">
                                                                    <span class="avatar-title text-danger">HT</span>
                                                                </a>
                                                                <div class="ms-2">
                                                                    <h6 class="mb-0 fs-14"><a href="user-teams-details">HTML Team</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="fs-14 fw-regular text-dark">Member</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table -->
                                        
                                    </div> <!-- end card body -->
                                </div> <!-- end card -->

                            </div>
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                    
                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->