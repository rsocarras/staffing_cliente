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
                                                <a href="localization-settings" class="nav-link active">
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
                                        
                                        <div>
                                            <h6 class="fw-bold mb-3">Basic Information</h6>
                                            <!-- start row -->
                                            <div class="row align-items-center row-gap-2">

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body text-body">Time Zone<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>(+5:30) GMT</option>
                                                            <option>(GMT -10:00) Hawaii</option>
                                                            <option>(GMT -9:30) Taiohae</option>
                                                            <option>(GMT -9:00) Alaska </option>
                                                            <option>(GMT -8:00) Pacific Time, Canada</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Start Week On<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>Monday</option>
                                                            <option>Tuesday</option>
                                                            <option>Wednesday</option>
                                                            <option>Thursday</option>
                                                            <option>Friday</option>
                                                            <option>Saturday</option>
                                                            <option>Sunday</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Date Format<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>18 Mar 2025</option>
                                                            <option>Mar 18 2025</option>
                                                            <option>2025 Mar 18</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Time Format<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>12 hrs</option>
                                                            <option>24hrs</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Default Language<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>English</option>
                                                            <option>German</option>
                                                            <option>Arabic</option>
                                                            <option>French</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-md-12">
                                                    <div class="border-top pt-3 mt-3">
                                                        <h6 class="fw-bold">Currency Settings</h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Currency<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>USD</option>
                                                            <option>Dollar</option>
                                                            <option>Euro</option>
                                                            <option>Pound</option>
                                                            <option>Rupee</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Currency Symbol <span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>$</option>
                                                            <option>₹</option>
                                                            <option>£</option>
                                                            <option>€</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Currency Position<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>$100</option>
                                                            <option>100$</option>
                                                            <option>$ 100</option>
                                                            <option>100 $</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Decimal Separator<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select">
                                                            <option>.</option>
                                                            <option>,</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-9 col-sm-7">
                                                    <div>
                                                        <h6 class="fs-14 fw-medium mb-0 text-body">Thousand Separator<span class="text-danger ms-1">*</span></h6>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-3 col-sm-5 float-sm-end">
                                                    <div>
                                                        <select class="select lh-2">
                                                            <option>.</option>
                                                            <option>,</option>
                                                            <option>'</option>
                                                        </select>
                                                    </div>
                                                </div> <!-- end col -->

                                            </div>
                                            <!-- end row -->

                                            <div class="d-flex align-items-center justify-content-end flex-wrap row-gap-2 border-top pt-4 mt-4">
                                                <button type="button" class="btn btn-light me-2">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
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