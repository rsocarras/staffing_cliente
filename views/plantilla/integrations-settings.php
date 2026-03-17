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
                                                <a href="integrations-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Integrations</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->
                                        
                                        <!-- start row -->
                                        <div class="row row-gap-4">

                                            <div class="col-md-6">
                                                <div class="card shadow-none mb-0">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center justify-content-between border-0 mb-3">
                                                            <div class="d-flex align-items-center">
                                                                <span class="avatar avatar-lg p-2 rounded bg-light flex-shrink-0 me-2"><img src="/assets/img/icons/calendar-icon.svg" alt="Img"></span>
                                                                <h6 class="mb-0">Google Calendar</h6>
                                                            </div>
                                                            <div class="form-check form-switch ps-0">
                                                                <input class="form-check-input m-0" type="checkbox" checked="">
                                                            </div>
                                                        </div>
                                                        <p>Google Calendar is a web-based scheduling tool that allows users to create, manage, share events.</p>
                                                        <a class="btn btn-sm btn-danger" href="#">Disconnect</a>
                                                    </div> <!-- end card body -->
                                                </div> <!-- end card -->
                                            </div> <!-- end col -->

                                            <div class="col-md-6">
                                                <div class="card shadow-none mb-0">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center justify-content-between border-0 mb-3">
                                                            <div class="d-flex align-items-center">
                                                                <span class="avatar avatar-lg p-2 bg-light rounded flex-shrink-0 me-2"><img src="/assets/img/icons/mail-icon2.svg" alt="Img"></span>
                                                                <h6 class="mb-0">Gmail</h6>
                                                            </div>
                                                            <div class="form-check form-switch ps-0">
                                                                <input class="form-check-input m-0" type="checkbox" checked="">
                                                            </div>
                                                        </div>
                                                        <p>Gmail is a free email service by Google that offers robust spam protection & 15GB of storage.</p>
                                                        <a class="btn btn-sm btn-dark" href="#">Connect</a>
                                                    </div> <!-- end card body -->
                                                </div> <!-- end card -->
                                            </div> <!-- end col -->

                                        </div>
                                        <!-- end row -->

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