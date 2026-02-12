    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="card">
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

                                <div class="card flex-fill mb-0 bg-soft-light border shadow-none">
                                    <div class="card-body">

                                        <!-- start tab -->
                                        <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                                            <li class="nav-item">
                                                <a href="localization-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Localization</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="custom-fields-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Custom Fields</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="preference-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Preference</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="appearance-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Appearance</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="notifications-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Notifications</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="integrations-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Integrations</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->

                                            <!-- start row -->
                                        <div class="row">

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Live Tracking</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Timesheet</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Leave</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Attendance</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Expense</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Screenshots</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Projects</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Tasks</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Manual Time</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Employees</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Teams</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            
                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Clients</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Users</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Invoices</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-xxl-4 col-xl-4 col-sm-6">
                                                <div class="d-flex justify-content-between align-items-center border rounded bg-white p-3 mb-3">
                                                    <h6 class="fw-medium mb-0">Reports</h6>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                        </div>
                                        <!-- end row -->

                                        <div class="d-flex align-items-center justify-content-end flex-wrap row-gap-2 border-top pt-4 mt-2">
                                            <button type="button" class="btn btn-light me-2">Cancel</button>
                                            <a href="preference-settings" class="btn btn-primary">Save Changes</a>
                                        </div>
                                        
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