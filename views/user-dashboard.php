    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content pb-0">

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">User Dashboard</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                        <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- start row -->
            <div class="row row-cols-xl-4 row-cols-sm-2 row-cols-1 justify-content-center">
                
                <div class="col d-flex">
                    <div class="card overflow-hidden z-1 flex-fill shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between gap-1">
                                <div>
                                    <p class="mb-1">Total Working Hours</p>
                                    <h4 class="mb-0">95h 41m</h4>
                                </div>
                                <span class="avatar rounded bg-primary flex-shrink-0 mb-2">
                                    <i class="ti ti-clock-share fs-24"></i>
                                </span>
                            </div>
                        </div> <!-- end card body -->
                        <img src="assets/img/icons/dash-icon.svg" alt="icon" class="position-absolute top-0 end-0 z-n1">
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col d-flex">
                    <div class="card overflow-hidden z-1 flex-fill shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between gap-1">
                                <div>
                                    <p class="mb-1">Manual Added Time </p>
                                    <h4 class="mb-0">6h 33m</h4>
                                </div>
                                <span class="avatar rounded bg-secondary flex-shrink-0 mb-2">
                                    <i class="ti ti-clock-plus fs-24"></i>
                                </span>
                            </div>
                        </div> <!-- end card body -->
                        <img src="assets/img/icons/dash-icon.svg" alt="icon" class="position-absolute top-0 end-0 z-n1">
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col d-flex">
                    <div class="card overflow-hidden z-1 flex-fill shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between gap-1">
                                <div>
                                    <p class="mb-1">Unproductive Time</p>
                                    <h4 class="mb-0">21h 15m</h4>
                                </div>
                                <span class="avatar rounded bg-danger flex-shrink-0 mb-2">
                                    <i class="ti ti-clock-x fs-24"></i>
                                </span>
                            </div>
                        </div> <!-- end card body -->
                        <img src="assets/img/icons/dash-icon.svg" alt="icon" class="position-absolute top-0 end-0 z-n1">
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col d-flex">
                    <div class="card overflow-hidden z-1 flex-fill shadow-none">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between gap-1">
                                <div>
                                    <p class="mb-1">Productive Time</p>
                                    <h4 class="mb-0">40h 22m</h4>
                                </div>
                                <span class="avatar rounded bg-purple flex-shrink-0 mb-2">
                                    <i class="ti ti-briefcase fs-24"></i>
                                </span>
                            </div>
                        </div> <!-- end card body -->
                        <img src="assets/img/icons/dash-icon.svg" alt="icon" class="position-absolute top-0 end-0 z-n1">
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->

                <!-- start row -->
                <div class="row">

                <!-- Total Tasks -->
                <div class="col-xl-8 col-md-12 d-flex">
                    <div class="card shadow-none flex-fill">
                        <div class="card-header">
                            <h5 class="mb-0">Performance Statistics</h5>
                        </div>
                        <div class="card-body pb-0">
                            <div id="performance-stats"></div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-12  col-xl-4 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header d-flex align-items-center justify-content-between gap-3 flex-wrap">
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
            <!-- end row -->

            <!-- start row -->
            <div class="row">

                <div class="col-xxl-4 col-lg-12 col-xl-12 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Tasks</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar bg-soft-orange fs-14 fw-medium me-2">FS</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="javascript:void(0);">FlowSpark - Workflow tools</a></h6>
                                        <span class="fs-13">Inner pages demo</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="fs-14 fw-medium mb-1">4h 22m</h6>
                                    <span class="badge badge-soft-pink">Ongoing</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar bg-soft-primary fs-14 fw-medium me-2">TZ</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="javascript:void(0);">TaskZen - Productivity</a></h6>
                                        <span class="fs-13">Creating Login Pages</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="fs-14 fw-medium mb-1">2h 33m</h6>
                                    <span class="badge badge-soft-success">Completed</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar bg-soft-teal fs-14 fw-medium me-2">CP</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="javascript:void(0);">CodePulse - Cloud tools</a></h6>
                                        <span class="fs-13">Design a Service Detail Page</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="fs-14 fw-medium mb-1">4h 33m</h6>
                                    <span class="badge badge-soft-success">Completed</span>
                                </div>
                            </div>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar bg-soft-indigo fs-14 fw-medium me-2">PD</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="javascript:void(0);">PulseDesk - Helpdesk</a></h6>
                                        <span class="fs-13">Creating Admin Dashbaord</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="fs-14 fw-medium mb-1">16h 33m</h6>
                                    <span class="badge badge-soft-success">Completed</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-0">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar bg-soft-pink fs-14 fw-medium me-2">CL</a>
                                    <div>
                                        <h6 class="fs-14 fw-medium mb-1"><a href="javascript:void(0);">Corelytics - Data tools</a></h6>
                                        <span class="fs-13">Write Function on Hover</span>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <h6 class="fs-14 fw-medium mb-1">42h 33m</h6>
                                    <span class="badge badge-soft-success">Completed</span>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->                 

                <div class="col-xxl-5 col-xl-6 col-md-12 d-flex">
                    <div class="card shadow-none flex-fill">
                        <div class="card-header">
                            <h5 class="mb-0">Work By Hours</h5>
                        </div>
                        <div class="card-body pb-0">
                            <div id="summary_chart"></div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-12 col-lg-12 col-xl-6 col-xxl-3 d-flex">
                    <div class="card shadow-none flex-fill">
                        <div class="card-header">
                            <h5 class="mb-0">Task Statistics</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div id="task-statistics" class="mb-4"></div>
                            <ul class="list-group pt-2">
                                <li class="list-group-item">
                                    <span class="d-inline-flex align-items-center">
                                        <i class="ti ti-circle-filled fs-8 me-2 text-primary"></i>Ongoing Tasks
                                    </span>
                                    <span class="fs-14 fw-medium text-dark float-end">49</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="d-inline-flex align-items-center">
                                        <i class="ti ti-circle-filled fs-8 me-2 text-secondary"></i>To Do Tasks
                                    </span>                                        
                                    <span class="fs-14 fw-medium text-dark float-end">35</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="d-inline-flex align-items-center">
                                        <i class="ti ti-circle-filled fs-8 me-2 text-success"></i>Completed Tasks
                                    </span>                                        
                                    <span class="fs-14 fw-medium text-dark float-end">64</span>
                                </li>
                                <li class="list-group-item">
                                    <span class="d-inline-flex align-items-center">
                                        <i class="ti ti-circle-filled fs-8 me-2 text-indigo"></i>Incompleted Tasks
                                    </span>                                          
                                    <span class="fs-14 fw-medium text-dark float-end">32</span>
                                </li>
                            </ul>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->

            <!-- start row -->
            <div class="row">

                <div class="col-xxl-4 col-lg-12 col-xl-6 d-flex">
                    <div class="card shadow-none flex-fill w-100">
                        <div class="card-header">
                            <h5 class="mb-0">Team Members</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-02.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <div>
                                            <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="javascript:void(0);">Leon Baxter</a></h6>
                                            <span class="fs-13">Test Lead</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge badge-sm badge-soft-primary">Fresher</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-20.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <div>
                                            <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="javascript:void(0);">Charles Cline</a></h6>
                                            <span class="fs-13">Security Engineer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge badge-sm badge-soft-purple ms-2">8+ Years</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-26.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <div>
                                            <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="javascript:void(0);">James Higham</a></h6>
                                            <span class="fs-13">Android Developer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge badge-sm badge-soft-info ms-2">12+ Years</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-23.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <div>
                                            <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="javascript:void(0);">Thomas Ward</a></h6>
                                            <span class="fs-13">UI Designer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge badge-sm badge-soft-pink ms-2">2+ Years</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <a href="javascript:void(0);" class="avatar flex-shrink-0">
                                        <img src="assets/img/profiles/avatar-22.jpg" class="rounded-circle" alt="img">
                                    </a>
                                    <div class="ms-2">
                                        <div>
                                            <h6 class="fs-14 fw-medium text-truncate mb-1"><a href="javascript:void(0);">Aliza Duncan</a></h6>
                                            <span class="fs-13">Backend Developer</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="badge badge-sm badge-soft-orange">4+ years</span>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->   

                <div class="col-md-12 col-lg-6 col-xl-6 col-xxl-4 d-flex">
                    <div class="card shadow-none flex-fill">
                        <div class="card-header">
                            <h5 class="mb-0">Production Statistics</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center">
                                <div id="production-statistics"></div>
                            </div>
                            <div class="border rounded d-flex align-items-center justify-content-center flex-wrap gap-3">
                                <div class="flex-fill p-2 text-center border-end">
                                    <p class="fs-13 mb-1">Production hours</p>
                                    <h4 class="mb-0">265</h4>
                                </div>
                                <div class="flex-fill p-2 text-center">
                                    <p class="fs-13 mb-1">Manual Hours</p>
                                    <h4 class="mb-0">82</h4>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-md-12 col-lg-6 col-xl-12 col-xxl-4 d-flex">
                    <div class="card shadow-none flex-fill">
                        <div class="card-header">
                            <h5 class="mb-0">Recent Activity</h5>
                        </div>
                        <div class="card-body">
                                <div class="log-wrap">
                                <div class="position-relative log-item">
                                    <div class="d-flex align-items-lg-center align-items-start gap-2 flex-sm-row flex-column mb-4">
                                        <span class="avatar avatar-rounded flex-shrink-0 position-relative z-2 bg-primary fs-16 border border-4 border-primary-subtle">
                                            <i class="ti ti-files"></i>
                                        </span>
                                        <div class="w-100 overflow-hidden">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-medium fs-14 text-dark mb-1">Leave approved</h6>
                                                <span class="fs-13 d-block mb-1">20 Mins Ago</span>
                                            </div>
                                            <p class="mb-0 fs-13">Medical Leave (Aug 1–2) by HR Manager</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-lg-center align-items-start gap-2 flex-sm-row flex-column mb-4">
                                        <span class="avatar avatar-rounded flex-shrink-0 position-relative z-2 bg-secondary fs-16 border border-4 border-secondary-subtle">
                                            <i class="ti ti-moneybag"></i>
                                        </span>
                                        <div class="w-100 overflow-hidden">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-medium fs-14 text-dark mb-1">Appraisal</h6>
                                                <span class="fs-13 d-block mb-1">10 Mins Ago</span>
                                            </div>
                                            <p class="mb-0 fs-13">Performance Review submitted for Q2 FY25</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-lg-center align-items-start gap-2 flex-sm-row flex-column mb-4">
                                        <span class="avatar avatar-rounded flex-shrink-0 position-relative z-2 bg-success fs-16 border border-4 border-success-subtle">
                                            <i class="ti ti-swipe"></i>
                                        </span>
                                        <div class="w-100 overflow-hidden">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-medium fs-14 text-dark mb-1">Payslip For July</h6>
                                                <span class="fs-13 d-block mb-1">25 Mins Ago</span>
                                            </div>
                                            <p class="mb-0 fs-13">Payslip for July 2025 generated – Download</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-lg-center align-items-start gap-2 flex-sm-row flex-column mb-4">
                                        <span class="avatar avatar-rounded flex-shrink-0 position-relative z-2 bg-indigo fs-16 border border-4 border-indigo-subtle">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                        <div class="w-100 overflow-hidden">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-medium fs-14 text-dark mb-1">Updated Time Sheet</h6>
                                                <span class="fs-13 d-block mb-1">6 Aug 2025</span>
                                            </div>
                                            <p class="mb-0 fs-13 text-truncate">Added comment to Project Phoenix Timesheet</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-lg-center align-items-start gap-2 flex-sm-row flex-column mb-0">
                                        <span class="avatar avatar-rounded flex-shrink-0 position-relative z-2 bg-pink fs-16 border border-4 border-pink-subtle">
                                            <i class="ti ti-user-edit"></i>
                                        </span>
                                        <div class="w-100 overflow-hidden">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="fw-medium fs-14 text-dark mb-1">Contact Changed</h6>
                                                <span class="fs-13 d-block mb-1">5 Aug 2025</span>
                                            </div>
                                            <p class="mb-0 fs-13">Changed emergency contact info</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->

        </div>
        <!-- End Content -->            

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->