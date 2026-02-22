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
                                                <a href="appearance-settings" class="nav-link active">
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

                                        <form action="appearance-settings">
                                            <div class="mb-3">

                                                <!-- start row -->
                                                <div class="row">

                                                    <div class="col-xl-4 col-md-4">
                                                        <div class="mb-4">
                                                            <h6 class="mb-1 fs-16">Select Theme</h6>
                                                            <span class="fs-14">Choose theme of website</span>
                                                        </div>
                                                    </div> <!-- end col -->

                                                    <div class="col-xl-8 col-md-8">
                                                        
                                                        <!-- start row -->
                                                        <div class="row align-items-center">
                                                            <div class="col-md-4 col-lg-6 col-xl-4">
                                                                <div class="card theme-image active">
                                                                    <div class="card-body p-2">
                                                                        <a href="#">
                                                                            <div class="border rounded border-gray mb-2">
                                                                                <img src="/assets/img/theme/light.jpg" class="img-fluid rounded" alt="theme">
                                                                            </div>
                                                                            <p class="text-center fw-medium mb-0">Light</p>
                                                                        </a>
                                                                    </div> <!-- end card body -->
                                                                </div> <!-- end card -->
                                                            </div> <!-- end col -->

                                                            <div class="col-md-4 col-lg-6 col-xl-4">
                                                                <div class="card theme-image">
                                                                    <div class="card-body p-2">
                                                                        <a href="#">
                                                                            <div class="border rounded border-gray mb-2">
                                                                                <img src="/assets/img/theme/dark.jpg" class="img-fluid rounded" alt="theme">
                                                                            </div>
                                                                            <p class="text-center fw-medium mb-0">Dark</p>
                                                                        </a>
                                                                    </div> <!-- end card body -->
                                                                </div> <!-- end card -->
                                                            </div> <!-- end col -->

                                                            <div class="col-md-4 col-lg-6 col-xl-4">
                                                                <div class="card theme-image">
                                                                    <div class="card-body p-2">
                                                                        <a href="#">
                                                                            <div class="border rounded border-gray mb-2">
                                                                                <img src="/assets/img/theme/automatic.jpg" class="img-fluid rounded" alt="theme">
                                                                            </div>
                                                                            <p class="text-center fw-medium mb-0">Automatic</p>
                                                                        </a>
                                                                    </div> <!-- end card body -->
                                                                </div> <!-- end card -->
                                                            </div> <!-- end col -->
                                                        </div>
                                                        <!-- end row -->

                                                    </div> <!-- end col -->

                                                </div>
                                                <!-- end row -->

                                                <!-- start row -->
                                                <div class="row align-items-center row-gap-3 mb-4">
                                                    <div class="col-xl-4 col-md-4">
                                                        <div>
                                                            <h6 class="mb-1">Accent Color</h6>
                                                            <span>Choose accent colour of website</span>
                                                        </div>
                                                    </div> <!-- end col -->

                                                    <div class="col-xl-8 col-md-8">
                                                        <div class="d-flex align-items-center flex-wrap gap-3">
                                                            <div class="theme-colorsset">
                                                                <input type="radio" name="color" id="primarycolor" checked>
                                                                <label for="primarycolor" class="primary-clr"></label>
                                                            </div>
                                                            <div class="theme-colorsset">
                                                                <input type="radio" name="color" id="secondarycolor">
                                                                <label for="secondarycolor" class="secondary-clr"></label>
                                                            </div>
                                                            <div class="theme-colorsset">
                                                                <input type="radio" name="color" id="successcolor">
                                                                <label for="successcolor" class="success-clr"></label>
                                                            </div>
                                                            <div class="theme-colorsset">
                                                                <input type="radio" name="color" id="dangercolor">
                                                                <label for="dangercolor" class="danger-clr"></label>
                                                            </div>
                                                            <div class="theme-colorsset">
                                                                <input type="radio" name="color" id="infocolor">
                                                                <label for="infocolor" class="info-clr"></label>
                                                            </div>
                                                            <div class="theme-colorsset">
                                                                <input type="radio" name="color" id="warningcolor">
                                                                <label for="warningcolor" class="warning-clr"></label>
                                                            </div>  
                                                        </div>
                                                    </div> <!-- end col -->

                                                </div>
                                                <!-- end row -->

                                                <!-- start row -->
                                                <div class="row align-items-center gy-2 mb-4">
                                                    <div class="col-xl-4 col-md-4">
                                                        <div>
                                                            <h6 class="mb-1">Sidebar Size</h6>
                                                            <span>Select size of the sidebar to display</span>
                                                        </div>
                                                    </div> <!-- end col -->

                                                    <div class="col-xl-3 col-md-4">
                                                        <select class="select">
                                                            <option>Small - 200px </option>
                                                            <option>Medium - 250px</option>
                                                            <option>Large - 300px</option>
                                                        </select>
                                                    </div> <!-- end col -->
                                                </div>
                                                <!-- end row -->

                                                <!-- start row -->
                                                <div class="row align-items-center gy-2">
                                                    <div class="col-xl-4 col-md-4">
                                                        <div>
                                                            <h6 class="mb-1">Font Family</h6>
                                                            <span>Select font family of website</span>
                                                        </div>
                                                    </div> <!-- end col -->

                                                    <div class="col-xl-3 col-md-4">
                                                        <div>
                                                            <select class="select">
                                                                <option>Albert Sans</option>
                                                                <option>Nunito</option>
                                                                <option>Poppins</option>
                                                            </select>
                                                        </div>
                                                    </div> <!-- end col -->

                                                </div>
                                                <!-- end row -->
                                            </div>
                                            <div class="d-flex align-items-center justify-content-end flex-wrap row-gap-2 border-top pt-4 mt-4">
                                                <button type="button" class="btn btn-light me-2">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
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
