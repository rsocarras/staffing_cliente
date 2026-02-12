    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content pb-0">

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Admin Dashboard</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- start row -->
            <div class="row">

                <div class="col-xxl-3 col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span class="d-block mb-1">Working Hours</span>
                                            <h4 class="mb-0">950h 41m</h4>
                                        </div>
                                    </div>
                                        <div id="hours-chart"></div>
                                </div>
                                <div class="mt-3 d-inline-flex align-items-center flex-wrap">
                                    <span class="badge badge-pill bg-success me-2"><i class="ti ti-arrow-up-right me-1"></i>20%</span>
                                    <p class="mb-0">in Last 7 Days</p>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xxl-3 col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row align-items-center">
                                    <div class="col d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span class="d-block mb-1">Production</span>
                                            <h4 class="mb-0">400h 15m</h4>
                                        </div>
                                    </div>
                                    <div id="productive-hour"></div>
                                </div>
                                <div class="mt-3 d-inline-flex align-items-center flex-wrap">
                                    <span class="badge badge-pill bg-danger me-2"><i class="ti ti-arrow-down-left me-1"></i>20%</span>
                                    <p class="mb-0">in Last 7 Days</p>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xxl-3 col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row align-items-center">
                                    <div class="col d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span class="d-block mb-1">Unproductive</span>
                                            <h4 class="mb-0">210h 15m</h4>
                                        </div>
                                    </div>
                                        <div id="unproductive-hour"></div>
                                </div>
                                <div class="mt-3 d-inline-flex align-items-center flex-wrap">
                                    <span class="badge badge-pill bg-success me-2"><i class="ti ti-arrow-up-right me-1"></i>45%</span>
                                    <p class="mb-0">in Last 7 Days</p>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xxl-3 col-xl-3 col-sm-6 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="row align-items-center">
                                    <div class="col d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <span class="d-block mb-1">Manual Added</span>
                                            <h4 class="mb-0">46h 45m</h4>
                                        </div>
                                    </div>
                                        <div id="manual-hour"></div>
                                </div>
                                <div class="mt-3 d-inline-flex align-items-center flex-wrap">
                                    <span class="badge badge-pill bg-success me-2"><i class="ti ti-arrow-up-right me-1"></i>22%</span>
                                    <p class="mb-0">in Last 7 Days</p>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->

            <!-- start row -->
            <div class="row">

                <div class="col-lg-12 col-xl-4 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Top Employees</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-02.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-0"><a href="#">Leon Baxter</a></h6>
                                        <span class="fs-13">Test Lead</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="d-block fs-13 mb-1">Salary</span>
                                    <h6 class="fw-semibold mb-0">$6595</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-20.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-0"><a href="#">Charles Cline</a></h6>
                                        <span class="fs-13">Security Engineer</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="d-block fs-13 mb-1">Salary</span>
                                    <h6 class="fw-semibold mb-0">$5145</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-26.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-0"><a href="#">James Higham</a></h6>
                                        <span class="fs-13">Android Developer</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="d-block fs-13 mb-1">Salary</span>
                                    <h6 class="fw-semibold mb-0">$7478</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-23.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-0"><a href="#">Thomas Ward</a></h6>
                                        <span class="fs-13">UI Designer</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="d-block fs-13 mb-1">Salary</span>
                                    <h6 class="fw-semibold mb-0">$4589</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between  flex-wrap gap-1">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-22.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-0"><a href="#">Aliza Duncan</a></h6>
                                        <span class="fs-13">Backend Developer</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="d-block fs-13 mb-1">Salary</span>
                                    <h6 class="fw-semibold mb-0">$6987</h6>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-lg-6 col-xl-4 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Employees Overview</h5>
                        </div>
                        <div class="card-body pb-0">
                            <div id="members-overview"></div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-lg-6 col-xl-4 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Request Approval</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-13.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Jonathan King</a></h6>
                                        <span class="fs-13">14 Sep 2025</span>
                                    </div>
                                </div>
                                <div class="d-inline-flex gap-2">
					<a href="#" class="btn btn-icon btn-sm btn-soft-success rounded-pill border-0 fs-16" aria-label="Approve"><i class="ti ti-check"></i></a>
					<a href="#" class="btn btn-icon btn-sm btn-soft-danger rounded-pill border-0 fs-16" aria-label="Reject"><i class="ti ti-x"></i></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-14.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Peter Brooks</a></h6>
                                        <span class="fs-13">28 Aug 2025</span>
                                    </div>
                                </div>
                                <div class="d-inline-flex gap-2">
									<a href="#" class="btn btn-icon btn-sm btn-soft-success rounded-pill border-0 fs-16" aria-label="Approve"><i class="ti ti-check"></i></a>
									<a href="#" class="btn btn-icon btn-sm btn-soft-danger rounded-pill border-0 fs-16" aria-label="Reject"><i class="ti ti-x"></i></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-11.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Cindy Mateo</a></h6>
                                        <span class="fs-13">20 Aug 2025</span>
                                    </div>
                                </div>
                                <div class="d-inline-flex gap-2">
									<a href="#" class="btn btn-icon btn-sm btn-soft-success rounded-pill border-0 fs-16" aria-label="Approve"><i class="ti ti-check"></i></a>
									<a href="#" class="btn btn-icon btn-sm btn-soft-danger rounded-pill border-0 fs-16" aria-label="Reject"><i class="ti ti-x"></i></a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-15.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Thomas Walsh</a></h6>
                                        <span class="fs-13">10 Aug 2025</span>
                                    </div>
                                </div>
                                <div class="d-inline-flex gap-2">
									<a href="#" class="btn btn-icon btn-sm btn-soft-success rounded-pill border-0 fs-16" aria-label="Approve">
										<i class="ti ti-check" aria-hidden="true"></i>
									</a>
									<a href="#" class="btn btn-icon btn-sm btn-soft-danger rounded-pill border-0 fs-16" aria-label="Reject">
										<i class="ti ti-x" aria-hidden="true"></i>
									</a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-12.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="#">Eliz Hiltner</a></h6>
                                        <span class="fs-13">25 Jul 2025</span>
                                    </div>
                                </div>
                                <div class="d-inline-flex gap-2">
									<a href="#" class="btn btn-icon btn-sm btn-soft-success rounded-pill border-0 fs-16" aria-label="Approve">
										<i class="ti ti-check" aria-hidden="true"></i>
									</a>
									<a href="#" class="btn btn-icon btn-sm btn-soft-danger rounded-pill border-0 fs-16" aria-label="Reject">
										<i class="ti ti-x" aria-hidden="true"></i>
									</a>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->

            <!-- start row -->
            <div class="row">

                <div class="col-lg-12 col-xl-7 col-md-6 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Project Statistics</h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap">
                                <span><i class="ti ti-circle-filled me-2 text-primary fs-12"></i>Active</span>
                                <span><i class="ti ti-circle-filled me-2 text-secondary fs-12"></i>Inprogress</span>
                                <span><i class="ti ti-circle-filled me-2 text-success fs-12"></i>Completed</span>
                            </div>
                            <div id="project-chart" class="chart-set"></div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-lg-12 col-xl-5 col-md-6 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Projects</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-primary fs-14 fw-medium me-2">TZ</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">TaskZen - Productivity</a></h6>
                                        <div class="d-inline-flex align-items-center">
                                            <span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-subtask me-1"></i>08 Tasks</span><span class="mx-2">|</span><span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-moneybag me-1"></i>$3500</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="avatar-list-stacked avatar-group-sm">
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-15.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-01.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-12.jpg" alt="img">
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-orange fs-14 fw-medium me-2">FS</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">FlowSpark - Workflow tools</a></h6>
                                        <div class="d-inline-flex align-items-center">
                                            <span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-subtask me-1"></i>32 Tasks</span><span class="mx-2">|</span><span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-moneybag me-1"></i>$8966</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="avatar-list-stacked avatar-group-sm">
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-01.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-02.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-03.jpg" alt="img">
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-pink fs-14 fw-medium me-2">CL</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">Corelytics - Data tools</a></h6>
                                        <div class="d-inline-flex align-items-center">
                                            <span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-subtask me-1"></i>56 Tasks</span><span class="mx-2">|</span><span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-moneybag me-1"></i>$7896</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="avatar-list-stacked avatar-group-sm">
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-15.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-01.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-12.jpg" alt="img">
                                    </span>
                                    <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="#">
                                        +1
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-teal fs-14 fw-medium me-2">CP</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">CodePulse - Cloud tools</a></h6>
                                        <div class="d-inline-flex align-items-center">
                                            <span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-subtask me-1"></i>40 Tasks</span><span class="mx-2">|</span><span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-moneybag me-1"></i>$4124</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="avatar-list-stacked avatar-group-sm">
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-15.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-01.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-20.jpg" alt="img">
                                    </span>
                                </div>
                            </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-0">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-indigo fs-14 fw-medium me-2">PD</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">Office Management</a></h6>
                                        <div class="d-inline-flex align-items-center">
                                            <span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-subtask me-1"></i>48 Tasks</span><span class="mx-2">|</span><span class="fs-13 d-inline-flex align-items-center"><i class="ti ti-moneybag me-1"></i>$4578</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="avatar-list-stacked avatar-group-sm">
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img">
                                    </span>
                                    <span class="avatar avatar-rounded">
                                        <img class="border border-white" src="assets/img/profiles/avatar-04.jpg" alt="img">
                                    </span>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row-->

            <!-- start row -->
            <div class="row">

                <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-4 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header d-flex align-items-center justify-content-between gap-3 flex-wrap">
                            <h5 class="mb-0">Top Teams</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap flex-sm-nowrap mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-indigo avatar-rounded">
                                        <span class="fa-14 fw-medium">UR</span>
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">UX Research</a></h6>
                                        <span class="fs-13">Hours Logged : 312h</span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fs-14 fw-medium mb-1">97%</h6>
                                    <span class="fs-13">Productivity</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap flex-sm-nowrap mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-orange avatar-rounded">
                                        <span class="fa-14 fw-medium text-orange">TS</span>
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">Testing</a></h6>
                                        <span class="fs-13">Hours Logged : 287h</span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fs-14 fw-medium mb-1">94%</h6>
                                    <span class="fs-13">Productivity</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap flex-sm-nowrap mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-teal avatar-rounded">
                                        <span class="fa-14 fw-medium text-teal">DN</span>
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">Design</a></h6>
                                        <span class="fs-13">Hours Logged : 274h</span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fs-14 fw-medium mb-1">92%</h6>
                                    <span class="fs-13">Productivity</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap flex-sm-nowrap mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-pink avatar-rounded">
                                        <span class="fa-14 fw-medium">DO</span>
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">DevOps</a></h6>
                                        <span class="fs-13">Hours Logged : 259h</span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fs-14 fw-medium mb-1">91%</h6>
                                    <span class="fs-13">Productivity</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-between flex-wrap flex-sm-nowrap">
                                <div class="d-flex align-items-center">
                                    <a href="#" class="avatar bg-soft-orange avatar-rounded">
                                        <span class="fs-14 fw-medium">IT</span>
                                    </a>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1"><a href="#">IT Support</a></h6>
                                        <span class="fs-13">Hours Logged : 243h</span>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="fs-14 fw-medium mb-1">88%</h6>
                                    <span class="fs-13">Productivity</span>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-4 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Task Details</h5>
                        </div>
                        <div class="card-body">
                            <div id="task-overview"></div>
                        </div> <!-- end card body -->
                        <div class="card-footer p-0">
                            <div class="row g-0">
                                <div class="col">
                                    <div class="p-3 text-center border-end">
                                        <p class="fs-13 d-inline-flex align-items-center mb-1">Ongoing</p>
                                        <h4 class="mb-0">496</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="p-3 text-center border-end">
                                        <p class="fs-13 d-inline-flex align-items-center mb-1">On hold</p>
                                        <h4 class="mb-0">165</h4>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="p-3 text-center">
                                        <p class="fs-13 d-inline-flex align-items-center mb-1">Completed</p>
                                        <h4 class="mb-0">127</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-12  col-xl-12 col-xxl-4 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Top Web App & Usage</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-2 justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-sm avatar-rounded flex-shrink-0">
                                        <img src="assets/img/icons/figma-icon.svg" alt="img">
                                    </span>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1">Figma</h6>
                                        <span class="fs-13">Design</span>
                                    </div>
                                </div>
                                <div class="w-50 text-end">
                                    <span class="text-dark fw-medium mb-1 d-block">36h 40m</span>
                                    <div class="progress progress-sm progress-animate w-100" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-success" style="width: 60%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-sm avatar-rounded flex-shrink-0">
                                        <img src="assets/img/icons/google2.svg" alt="img">
                                    </span>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1">Google</h6>
                                        <span class="fs-13">Browser</span>
                                    </div>
                                </div>
                                <div class="w-50 text-end">
                                    <span class="text-dark fw-medium mb-1 d-block">24h 40m</span>
                                    <div class="progress progress-sm progress-animate w-100" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-purple" style="width: 50%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                        <img src="assets/img/icons/illustrator-01.svg" alt="img">
                                    </span>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1">Adobe illustrator</h6>
                                        <span class="fs-13">Design</span>
                                    </div>
                                </div>
                                <div class="w-50 text-end">
                                    <span class="text-dark fw-medium mb-1 d-block">20h 40m</span>
                                    <div class="progress progress-sm progress-animate w-100" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-indigo" style="width: 30%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                        <img src="assets/img/icons/slack-01.svg" alt="img">
                                    </span>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1">Slack</h6>
                                        <span class="fs-13">Communication</span>
                                    </div>
                                </div>
                                <div class="w-50 text-end">
                                    <span class="text-dark fw-medium mb-1 d-block">22h 40m</span>
                                    <div class="progress progress-sm progress-animate w-100" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-info" style="width: 40%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span class="avatar avatar-sm flex-shrink-0">
                                        <img src="assets/img/icons/teams.svg" alt="img">
                                    </span>
                                    <div class="ms-2">
                                        <h6 class="fs-14 fw-medium mb-1">Teams</h6>
                                        <span class="fs-13">Communication</span>
                                    </div>
                                </div>
                                <div class="w-50 text-end">
                                    <span class="text-dark fw-medium mb-1 d-block">18h 40m</span>
                                    <div class="progress progress-sm progress-animate w-100" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-warning" style="width: 20%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-none w-100">
                        <div class="card-header d-flex align-items-center justify-content-between gap-3 flex-wrap">
                            <h5 class="mb-0">Employees</h5>
                            <a href="#" class="btn btn-sm btn-primary d-inline-flex align-items-center" data-bs-toggle="offcanvas" data-bs-target="#add_new"><i class="ti ti-plus me-1"></i>Add New </a>
                        </div>
                        <div class="card-body">

                            <!-- Start Table -->
                            <div class="table-responsive">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Email Address</th>
                                            <th>Phone Number</th>
                                            <th>Experience</th>
                                            <th>Work Location</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fs-14 fw-medium mb-0"><a href="#">Shaun Farley</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Usability Specialist</td>
                                            <td>shaunfarley@example.com</td>
                                            <td>+1 578 209 4965</td>
                                            <td>2 years</td>
                                            <td>Remote</td>
                                            <td><span class="badge badge-soft-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded"><img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img"></a>
                                                    <div class="ms-2">
                                                        <h6 class="fs-14 fw-medium mb-0"><a href="#">Jenny Ellis</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>DevOps</td>
                                            <td>jenny@example.com</td>
                                            <td>+1 278 301 7284</td>
                                            <td>5 years</td>
                                            <td>Office</td>
                                            <td><span class="badge badge-soft-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded"><img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img"></a>
                                                    <div class="ms-2">
                                                        <h6 class="fs-14 fw-medium mb-0"><a href="#">Aliza Duncan</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Data & Analytics</td>
                                            <td>aliza@example.com</td>
                                            <td>+1 702 555 0189</td>
                                            <td>3 years</td>
                                            <td>Office</td>
                                            <td><span class="badge badge-soft-success">Active</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar offline avatar-rounded fs-14 fw-medium bg-soft-indigo">LH</a>
                                                    <div class="ms-2">
                                                        <h6 class="fs-14 fw-medium mb-0"><a href="#">Leslie Hensley</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>IT Support</td>
                                            <td>leslie@example.com</td>
                                            <td>+1 617 555 0134</td>
                                            <td>9 years</td>
                                            <td>Remote</td>
                                            <td><span class="badge badge-soft-danger">Inactive</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded"><img src="assets/img/users/user-08.jpg" class="img-fluid" alt="img"></a>
                                                    <div class="ms-2">
                                                        <h6 class="fs-14 fw-medium mb-0"><a href="#">Karen Galvan</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Networking</td>
                                            <td>karen@example.com</td>
                                            <td>+1 832 555 0166</td>
                                            <td>6 years</td>
                                            <td>Office</td>
                                            <td><span class="badge badge-soft-danger">Inactive</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>

        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
