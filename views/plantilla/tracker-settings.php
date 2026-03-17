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
                            <h4 class="fs-20 fw-semibold mb-0 d-flex align-items-center gap-2"><a href="javascript:void(0);" class="settings-collapse-bar d-flex align-items-center text-body" aria-label="Settings"><i class="ti ti-menu-4 fs-24"></i></a>Settings</h4>
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
                                                <a href="leave-types-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Leave Types</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="shift-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Shift</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="working-hours-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Working Hours</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="tracker-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Tracker Settings</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="productivity-ratings-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Productivity Ratings</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->

                                        <div class="card flex-fill mb-0 border-0 bg-transparent shadow-none">
                                            <div class="card-body p-0">
                                                <div>
                                                    <!-- start row -->
                                                    <div class="row mb-3 gy-3">

                                                        <div class="col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Late Coming Time</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-sm-5">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <input type="text" class="form-control">
                                                                <p class="mb-0">Minutes</p>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <!-- start row -->
                                                    <div class="row mb-3 gy-3">

                                                        <div class="col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Daily Overtime Limit</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-sm-5">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <input type="text" class="form-control">
                                                                <p class="mb-0">Hours</p>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <!-- start row -->
                                                    <div class="row mb-3 gy-3">

                                                        <div class="col-9 col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Screenshots</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-3 col-sm-5">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" checked>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <!-- start row -->
                                                    <div class="row mb-3 gy-3">

                                                        <div class="col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Screenshot Interval</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-sm-5">
                                                            <div class="d-flex align-items-center gap-3">
                                                                <input type="text" class="form-control">
                                                                <p class="mb-0">Minutes</p>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <!-- start row -->
                                                    <div class="row mb-3 gy-3">

                                                        <div class="col-9 col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Screenshot Delete Option</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-3 col-sm-5">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" checked>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <!-- start row -->
                                                    <div class="row mb-3 gy-3">

                                                        <div class="col-9 col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Blur Screenshots</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-3 col-sm-5">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" checked>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <!-- start row -->
                                                    <div class="row mb-3 gy-3">

                                                        <div class="col-9 col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Employee Edit Option</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-3 col-sm-5">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" checked>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <!-- start row -->
                                                    <div class="row mb-3 gy-3">

                                                        <div class="col-9 col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Work Schedule</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-3 col-sm-5">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" checked>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <!-- start row -->
                                                    <div class="row mb-4 gy-3">

                                                        <div class="col-9 col-sm-7">
                                                            <p class="text-dark fw-medium mb-0">Website & Appliation</p>
                                                        </div> <!-- end col -->

                                                        <div class="col-3 col-sm-5">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" checked>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->

                                                    <div class="d-flex align-items-center justify-content-end flex-wrap row-gap-2 border-top pt-4">
                                                        <button type="button" class="btn btn-light me-2">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->

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