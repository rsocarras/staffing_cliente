    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="card mb-0">
                <div class="card-body">
                    <!-- Page Header -->
                    <div class="d-flex align-items-center flex-row gap-2 mb-4">
                        <div class="flex-grow-1">
                            <h4 class="fs-20 fw-semibold mb-0 d-flex align-items-center gap-2"><a href="javascript:void(0);" class="settings-collapse-bar d-flex align-items-center text-body"><i class="ti ti-menu-4 fs-24"></i></a>Settings</h4>
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

                                <?= $this->render('layouts/partials/settings-sidebar') ?>

                                <div class="card flex-fill mb-0 setting-custom-bg border shadow-none">
                                    <div class="card-body">
                                        <!-- start tab -->
                                        <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                                            <li class="nav-item">
                                                <a href="profile-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Profile Settings</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="security-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Security</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->
                                        <form action="profile-settings">
                                            
                                            <!-- Item -1-->
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="mb-3 fw-bold">Change Password</h6>
                                                    <!-- start row -->
                                                    <div class="row row-gap-3 mb-3">
                                                        <div class="col-xl-4 col-lg-6 col-md-6">
                                                            <div>
                                                                <label class="form-label">Current Password <span class="text-danger ms-1">*</span></label>
                                                                <div class="input-group input-group-flat pass-group">
                                                                    <input type="password" class="form-control pass-input">
                                                                    <span class="input-group-text toggle-password ">
                                                                        <i class="ti ti-eye-off"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6">
                                                            <div>
                                                                <label class="form-label">New Password <span class="text-danger ms-1">*</span></label>
                                                                <div class="input-group input-group-flat pass-group">
                                                                    <input type="password" class="form-control pass-input">
                                                                    <span class="input-group-text toggle-password ">
                                                                        <i class="ti ti-eye-off"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-6 col-md-6">
                                                            <div>
                                                                <label class="form-label">Confirm Password <span class="text-danger ms-1">*</span></label>
                                                                <div class="input-group input-group-flat pass-group">
                                                                    <input type="password" class="form-control pass-input">
                                                                    <span class="input-group-text toggle-password ">
                                                                        <i class="ti ti-eye-off"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end row -->
                                                    <div class="d-flex align-items-center gap-2 flex-wrap gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-light">Cancel</a>
                                                        <a href="javascript:void(0);" class="btn btn-primary">Save Changes</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Item -2-->
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="mb-3">
                                                        <h6 class="fs-16 fw-bold mb-1">Two Step Verification</h6>
                                                        <p class="mb-2">Add an extra layer of security to your workspace account by enabling two factor authentication.</p>
                                                    </div>
                                                    <div class="d-flex align-items-center gap-2 flex-wrap gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">Cancel</a>
                                                        <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#two-step-verification">Set Up</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- start row -->
                                            <div class="row row-gap-4">
                                                <div class="col-xl-6 col-lg-12">
                                                    <!-- Item -3-->
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <h6 class="fs-16 fw-bold mb-1">Phone Number Verification</h6>
                                                                <p class="mb-2">Verify your phone number to enhance security, enable password recovery, & receive important security alerts..</p>
                                                                <span class="badge badge-soft-success fw-medium  d-inline-flex align-items-center gap-2 text-wrap"> <i class="ti ti-circle-check"></i> Verified Mobile Number : +81699799974</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-2 flex-wrap gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">Remove</a>
                                                                <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#phone-verification">Change</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12">
                                                    <!-- Item -4-->
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <h6 class="fs-16 fw-bold mb-1">Email Verification</h6>
                                                                <p class="mb-2">Verify your email address to secure your account, receive notifications, and enable password recovery options.</p>
                                                                <span class="badge badge-soft-success fw-medium  d-inline-flex align-items-center gap-2 text-wrap"> <i class="ti ti-circle-check"></i> Verified Email : steven@example.com</span>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-2 flex-wrap gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">Remove</a>
                                                                <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#email-verification">Change</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12">
                                                    <!-- Item - 4-->
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <h6 class="fs-16 fw-bold mb-1">Delete Account</h6>
                                                                <p class="mb-0">Permanently deletes the user account along with all associated data from the app</p>
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete_account">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-12">
                                                    <!-- Item - 5-->
                                                    <div class="card mb-0">
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <h6 class="fs-16 fw-bold mb-1">Deactivate Account</h6>
                                                                <p class="mb-0">Deactivate your account to temporarily disable access your data will be saved and can be restored.</p>
                                                            </div>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deactivate_modal">Deactivate</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                        </form>
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