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
                            <h4 class="fs-20 fw-bold mb-0">Poor Time Use</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>       
                                <li class="breadcrumb-item"><a href="reports">Report</a></li>                         
                                <li class="breadcrumb-item active" aria-current="page">Poor Time Use</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">                                             
                            <a href="poor-time-use" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Day</a>
                        </li>
                        <li class="nav-item">
                            <a href="poor-time-week" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Week</a>
                        </li>
                        <li class="nav-item">
                            <a href="poor-time-month" class="nav-link d-flex align-items-center active"><i class="ti ti-calendar me-2"></i>By Month</a>
                        </li>
                    </ul>  
                    
                    <!-- Start Search and Filter -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        <div class="d-flex align-items-center flex-wrap gap-3"> 
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
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- start table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Websites</th>
                                    <th>Date & Time</th>
                                    <th>Total Time (H)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);">Shaun Farley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>youtube.com-Google Chrome</td>
                                    <td>
                                        <div class="d-inline-flex flex-column">
                                            <div class="badge badge-soft-primary fw-normal mb-1">
                                                15 Jan 2025, 11:15 AM <span class="text-danger">00h 00m 15s </span>
                                            </div>
                                            <div class="badge badge-soft-primary fw-normal mb-1">
                                                17 Jan 2025, 03:20 PM <span class="text-danger">00h 01m 00s </span>
                                            </div>
                                            <div class="badge badge-soft-primary fw-normal">
                                                21 Jan 2025, 04:00 PM <span class="text-danger">00h 00m 15s</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>00h 00m 15s</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-inline-flex flex-column">
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);">Shaun Farleyy</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>instagram.com-Google Chrome</td>
                                    <td>
                                        <div class="d-inline-flex flex-column">
                                            <div class="badge badge-soft-primary fw-normal mb-1">
                                                13 Jan 2025, 11:30 AM <span class="text-danger">00h 00m 20s </span>
                                            </div>
                                            <div class="badge badge-soft-primary fw-normal mb-1">
                                                10 Jan 2025, 02:10 PM <span class="text-danger">00h 00m 10s </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>00h 00m 30s</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);">Shaun Farleyy</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>facebook.com-Google Chrome</td>
                                    <td>
                                        <div class="d-inline-flex flex-column">
                                            <div class="badge badge-soft-primary fw-normal mb-1">
                                                08 Jan 2025, 05:40 PM <span class="text-danger">00h 00m 15s </span>
                                            </div>
                                            <div class="badge badge-soft-primary fw-normal mb-1">
                                                03 Jan 2025, 08:30 AM <span class="text-danger">00h 00m 30s </span>
                                            </div>
                                            <div class="badge badge-soft-primary fw-normal mb-1">
                                                02 Jan 2025, 06:00 PM <span class="text-danger">00h 00m 10s </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>00h 00m 55s</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table -->

                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->