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
                    <div class="row row-gap-3">
                        <div class="col-xl-12">
                            <div class="settings-wrapper d-flex">

                                <?= $this->render('layouts/partials/settings-sidebar') ?>

                                <div class="card flex-fill mb-0 bg-soft-light border shadow-none mb-0">
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
                                                <a href="preference-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Preference</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="appearance-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Appearance</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="notifications-settings" class="nav-link active">
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
                                        <div>
                                            <h5 class="mb-3 fs-16 fw-bold">Email Notifications</h5>
                                            <div class="row align-items-center row-gap-3">
                                                <div class="col-9">
                                                    <div>
                                                        <h6 class="fw-medium mb-1 fs-14 fs-14">News & Updates</h6>
                                                        <p class="fs-13 mb-0">News about product and feature updates</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input m-0" type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div>
                                                        <h6 class="fw-medium mb-1 fs-14">Tips & Tutorials</h6>
                                                        <p class="fs-13 mb-0">Tips on getting more out of product</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input m-0" type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div>
                                                        <h6 class="fw-medium mb-1 fs-14">Manual Time</h6>
                                                        <p class="fs-13 mb-0">Comments on posts on Manual Time</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input m-0" type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div>
                                                        <h6 class="fw-medium mb-1 fs-14">Reminders</h6>
                                                        <p class="fs-13 mb-0">Notifications to remind you of updates you might have missed</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input m-0" type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="border-top pt-4 mb-3 mt-4">
                                                        <h5 class="fs-16 fw-bold">Push Notifications</h5>
                                                    </div>
                                                </div>

                                                <div class="col-9">
                                                    <div>
                                                        <h6 class="fw-medium mb-1 fs-14">News & Updates</h6>
                                                        <p class="fs-13 mb-0">News about product and feature updates</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input m-0" type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div>
                                                        <h6 class="fw-medium mb-1 fs-14">More activity about you</h6>
                                                        <p class="fs-13 mb-0">Notifications for Adding Time, Low Activity, Performance, Unwanted Apps Usage</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input m-0" type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-9">
                                                    <div>
                                                        <h6 class="fw-medium mb-1 fs-14">Manual Time</h6>
                                                        <p class="fs-13 mb-0">Comments on posts on Manual Time</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input m-0" type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-9">
                                                    <div>
                                                        <h6 class="fw-medium mb-1 fs-14">Reminders</h6>
                                                        <p class="fs-13 mb-0">Notifications to remind you of updates you might have missed</p>
                                                    </div>
                                                </div>
                                                <div class="col-3 text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input m-0" type="checkbox" checked="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end flex-wrap row-gap-2 border-top pt-4 mt-4">
                                            <button type="button" class="btn btn-light me-2">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
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