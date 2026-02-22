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
                            <h4 class="fs-20 fw-bold mb-0">Download</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Download</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Start row -->
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="card mb-0">
                                <div class="card-body">
                                    <div class="download-item-1 bg-light p-3 rounded mb-3">
                                        <h6 class="mb-2 fs-14 fw-semibold">Download and install on all employee’s computers.</h6>

                                        <!-- start row -->
                                        <div class="row row-gap-3">
                                            <div class="col-xl-4 col-lg-6">
                                                <a href="javascript:void(0);" class="btn w-100 text-center bg-white border rounded-3 p-3 flex-column">
                                                    <img src="/assets/img/icons/windows.svg" alt="img" class="img-fluid mb-3">
                                                    <h6 class="mb-0">Windows</h6>
                                                </a>
                                            </div> <!-- end col -->

                                            <div class="col-xl-4 col-lg-6">
                                                <a href="javascript:void(0);" class="btn w-100 text-center bg-white border rounded-3 p-3 flex-column">
                                                    <img src="/assets/img/icons/mac-os.svg" alt="img" class="img-fluid mb-3">
                                                    <h6 class="mb-0">MacOS</h6>
                                                </a>
                                            </div> <!-- end col -->

                                            <div class="col-xl-4 col-lg-6">
                                                <a href="javascript:void(0);" class="btn w-100 text-center bg-white border rounded-3 p-3 flex-column">
                                                    <img src="/assets/img/icons/linux.svg" alt="img" class="img-fluid mb-3">
                                                    <h6 class="mb-0">Linux</h6>
                                                </a>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>

                                    <div class="download-item-1 bg-light p-3 rounded mb-3">
                                        <h6 class="mb-2 fs-14 fw-semibold">Instructions how to install it on employee’s computers & Mobile.</h6>
                                        <!-- start row -->
                                        <div class="row row-gap-3">
                                            <div class="col-xl-4 col-lg-6">
                                                <a href="javascript:void(0);" class="btn w-100 text-center bg-white border rounded-3 p-3 flex-column">
                                                    <img src="/assets/img/icons/android.svg" alt="img" class="img-fluid mb-3">
                                                    <h6 class="mb-0">Android</h6>
                                                </a>
                                            </div> <!-- end col -->

                                            <div class="col-xl-4 col-lg-6">
                                                <a href="javascript:void(0);" class="btn w-100 text-center bg-white border rounded-3 p-3 flex-column">
                                                    <img src="/assets/img/icons/ios.svg" alt="img" class="img-fluid mb-3">
                                                    <h6 class="mb-0">Ios</h6>
                                                </a>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <div class="text-center mb-3">
                                        <span class="text-dark fs-12 fw-medium">OR</span>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group mb-2 w-100">
                                            <input type="text" class="form-control" id="urlField" value="https://www.dreamstimer.com" readonly>
                                            <button class="btn btn-primary" type="button" onclick="copyURL()">Copy URL</button>
                                        </div>
                                        <span class="fs-13 mt-1 d-flex">Copy installation URL and send it to system administrator or employees</span>
                                    </div>
                                    <div class="alert alert-light mb-0">
                                        <p class="m-0 text-dark">Employees will show up on your dashboard automatically after the installation, no other signups are required.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
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
