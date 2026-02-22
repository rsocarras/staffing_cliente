    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <div class="card mb-0">
                <div class="card-body">

                    <!-- Page Header -->
                    <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold mb-0">Timeline</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>   
                                <li class="breadcrumb-item"><a href="reports">Reports</a></li>                             
                                <li class="breadcrumb-item active" aria-current="page">Timeline</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Start Filter-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        <div class="d-flex align-items-center flex-wrap gap-2">

                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-outline-light bg-white text-dark" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                                    All Employees
                                </a>
                                <ul class="dropdown-menu dropdown-menu-md p-2 dropdown-employee">
                                    <li>
                                        <div class="mb-2">
                                            <input type="text" class="form-control form-control-sm" placeholder="Search">
                                        </div>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
                                        </label>
                                    </li>
                                </ul>
                            </div>

                            <div class="input-group input-group-flat custom-date">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                                <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" value="15 jun 2025">
                            </div>
                        </div> <!-- end filter -->
                    </div>
                    <!-- End Filter -->

                    <!-- Start Filter -->
                    <div class="d-flex justify-content-between g-3 align-items-center flex-wrap mb-3">
                        <span>Employee Name : <a href="#" class="fw-medium">James Higham</a></span>
                        <span>Total Time Worked : <strong class="fw-medium text-dark">08h 35m</strong></span>
                    </div>
                    <!-- End Filter -->

                    <!-- Start Filter -->
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="d-flex gap-2 gap-sm-3">
                                <div class="mb-3">
                                    <p class="d-flex align-items-center mb-1"><i class="ti ti-point-filled text-success me-1"></i>Total Working hours</p>
                                    <h5 class="fw-medium">06h 45m</h5>
                                </div>
                                <div class="mb-3">
                                    <p class="d-flex align-items-center mb-1"><i class="ti ti-point-filled text-warning me-1"></i>Edited hours</p>
                                    <h5 class="fw-medium">00h 45m</h5>
                                </div>
                            </div>
                            <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 23%;"></div>
                                <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 2%;"></div>
                                <div class="progress-bar bg-warning rounded me-3" role="progressbar" style="width: 25%;"></div>
                                <div class="progress-bar bg-success rounded me-4" role="progressbar" style="width: 30%;"></div>
                                <div class="progress-bar bg-success rounded me-4" role="progressbar" style="width: 35%;"></div>
                                <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>
                                <div class="progress-bar bg-light rounded" role="progressbar" style="width: 10%;"></div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <span class="fs-13">06:00</span>
                                <span class="fs-13">07:00</span>
                                <span class="fs-13">08:00</span>
                                <span class="fs-13">09:00</span>
                                <span class="fs-13">10:00</span>
                                <span class="fs-13">11:00</span>
                                <span class="fs-13">12:00</span>
                                <span class="fs-13">01:00</span>
                                <span class="fs-13">02:00</span>
                                <span class="fs-13">03:00</span>
                                <span class="fs-13">04:00</span>
                                <span class="fs-13">05:00</span>
                                <span class="fs-13">06:00</span>
                                <span class="fs-13">07:00</span>
                                <span class="fs-13">08:00</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Filter -->

                    <!-- Start Subheader -->
                    <div class="d-flex justify-content-between g-3 align-items-center flex-wrap mb-3">
                        <span>Employee Name : <a href="#" class="fw-medium">Component Creation</a></span>
                        <span>Total Time Worked : <strong class="fw-medium text-dark">00h 07m</strong></span>
                    </div>
                    <!-- End Subheade r-->
                    
                    <!-- Start Tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">
                            <a href="timeline-details" class="nav-link"><i class="ti ti-photo fs-13 me-1"></i> Screenshots</a>
                        </li>
                        <li class="nav-item">
                            <a href="usage-timeline-details" class="nav-link active"><i class="ti ti-chart-pie fs-13 me-1"></i>Usage</a>
                        </li>
                    </ul>
                    <!-- End Tab -->

                    <!-- start row -->
                    <div class="row">

                        <div class="col-xl-7 col-md-12 col-sm-12 d-flex">
                            <div class="card mb-xl-0 flex-fill mb-3">
                                <div class="card-header border-bottom-0">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold mb-0">Top Web App & Usage</h5>
                                        <a href="web-app-usage" class="text-primary text-decoration-underline">View all</a>
                                    </div>
                                </div>
                                <div class="card-body details-item">
                                    
                                    <!-- Items -->
                                    <div class="list-group-item bg-light rounded mb-2 p-2">
                                        <!-- start row -->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-lg-0 gap-md-0 gap-2">
                                            <div class="col-lg-5">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-lg flex-shrink-0 me-2">
                                                        <img src="/assets/img/icons/figma.svg" alt="">
                                                    </span>
                                                    <div>
                                                        <h6 class="fw-medium mb-1">Figma</h6>
                                                        <a href="#" class="fs-13 text-truncate">https://www.figma.com/desi </a>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Design</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Neutral</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-lg-end justify-content-md-end justify-content-start">
                                                    <p class="text-dark m-0"><i class="ti ti-clock me-1"></i>21h 05m</p>
                                                </div>
                                            </div> <!-- end col -->

                                        </div>
                                        <!-- end row -->
                                    </div>

                                    <!-- Items -->
                                    <div class="list-group-item bg-light rounded mb-2 p-2">
                                        <!-- start row -->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-lg-0 gap-md-0 gap-2">
                                            <div class="col-lg-5">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-lg flex-shrink-0 me-2">
                                                        <img src="/assets/img/icons/google.svg" alt="">
                                                    </span>
                                                    <div>
                                                        <h6 class="fw-medium mb-1">Google</h6>
                                                        <a href="#" class="fs-13 text-truncate" >https://www.google.com/ </a>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Browser</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Neutral</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-lg-end justify-content-md-end justify-content-start">
                                                    <p class="text-dark m-0"><i class="ti ti-clock me-1"></i>01h 32m</p>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>

                                    <!-- Items -->
                                    <div class="list-group-item bg-light rounded mb-2 p-2">
                                        <!-- start row -->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-lg-0 gap-md-0 gap-2">
                                            <div class="col-lg-5">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-lg flex-shrink-0 me-2">
                                                        <img src="/assets/img/icons/slack.svg" alt="">
                                                    </span>
                                                    <div>
                                                        <h6 class="fw-medium mb-1">Slack</h6>
                                                        <a href="#" class="fs-13 text-truncate">https://app.slack.com/client/ </a>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Communication</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Productive</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-lg-end justify-content-md-end justify-content-start">
                                                    <p class="text-dark m-0"><i class="ti ti-clock me-1"></i>00h 12m</p>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>

                                    <!-- Items -->
                                    <div class="list-group-item bg-light rounded mb-2 p-2">
                                        <!-- start row -->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-lg-0 gap-md-0 gap-2">
                                            <div class="col-lg-5">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-lg flex-shrink-0 me-2">
                                                        <img src="/assets/img/icons/freepik.svg" alt="">
                                                    </span>
                                                    <div>
                                                        <h6 class="fw-medium mb-1">Freepik</h6>
                                                        <a href="#" class="fs-13 text-truncate">https://www.freepik.com</a>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Design</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Non Productive</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-lg-end justify-content-md-end justify-content-start">
                                                    <p class="text-dark m-0"><i class="ti ti-clock me-1"></i>00h 37m</p>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>

                                    <!-- Items -->
                                    <div class="list-group-item bg-light rounded mb-0 p-2">

                                        <!-- start row -->
                                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-lg-0 gap-md-0 gap-2">
                                            <div class="col-lg-5">
                                                <div class="d-flex align-items-center">
                                                    <span class="avatar avatar-lg flex-shrink-0 me-2">
                                                        <img src="/assets/img/icons/google-doc.svg" alt="">
                                                    </span>
                                                    <div>
                                                        <h6 class="fw-medium mb-1">Google Docs</h6>
                                                        <a href="#" class="fs-13 text-truncate">https://docs.google</a>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-3">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Office Suite</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="text-truncate">Productive</span>
                                                </div>
                                            </div> <!-- end col -->

                                            <div class="col-lg-2">
                                                <div class="d-flex align-items-center justify-content-lg-end justify-content-md-end justify-content-start">
                                                    <p class="text-dark m-0"><i class="ti ti-clock me-1"></i>00h 41m</p>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>

                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div>  <!-- end col -->

                        <div class="col-xl-5 col-md-12 col-sm-12 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-header border-bottom-0">
                                    <div class="d-flex align-items-center">
                                        <h5 class="fw-bold">Top Web App Chart</h5>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="mb-3 d-flex justify-content-center">
                                        <div id="web_chart"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="f-13 mb-2">
                                                    <i class="ti ti-circle-filled text-secondary me-1"></i> Figma <span>(41%)</span>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="f-13 mb-2">
                                                    <i class="ti ti-circle-filled text-teal me-1"></i> Slack <span>(11%)</span>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="f-13 mb-2">
                                                    <i class="ti ti-circle-filled text-purple me-1"></i> Freepik <span>(7%)</span>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <p class="f-13 mb-2">
                                                    <i class="ti ti-circle-filled text-warning me-1"></i> Chrome <span>(18%)</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="f-13 mb-2">
                                                    <i class="ti ti-circle-filled text-danger me-1"></i> Codecanyon <span>(06%)</span>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="f-13 mb-2">
                                                    <i class="ti ti-circle-filled text-purple me-1"></i> Explorer <span>(12%)</span>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <p class="f-13 mb-2">
                                                    <i class="ti ti-circle-filled text-violet me-1"></i> Gmail <span>(4%)</span>
                                                </p>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <p class="f-13 mb-2">
                                                    <i class="ti ti-circle-filled text-primary me-1"></i> Dribble <span>(16%)</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                </div> <!-- end card body -->
                            </div> <!-- end card -->
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