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
                            <h4 class="fs-20 fw-bold mb-0">Attendance</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>    
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>                          
                                <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">                                             
                            <a href="user-attendance-report" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Day</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-attendance-report-week" class="nav-link d-flex align-items-center active"><i class="ti ti-calendar me-2"></i>By Week</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-attendance-report-month" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Month</a>
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
                                    <th>Date</th>
                                    <th>Shift Start Time</th>
                                    <th>Actual Start Time</th>
                                    <th>Shift End Time</th>
                                    <th>Min Hours</th>
                                    <th>Actual Hours Worked</th>
                                    <th>Break Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01 Jan 2025</td>
                                    <td>09:00 AM</td>
                                    <td>None</td>
                                    <td>06:30 PM</td>
                                    <td>08h 00m</td>
                                    <td>00h 00m 00s</td>
                                    <td>00h 00m</td>
                                    <td>
                                        <span class="badge bg-purple">Holiday</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>02 Jan 2025</td>
                                    <td>09:00 AM</td>
                                    <td>08:00 AM</td>
                                    <td>06:30 PM</td>
                                    <td>08h 00m</td>
                                    <td>11h 15m 09s</td>
                                    <td>01h 10m</td>
                                    <td>
                                        <span class="badge bg-success">Present</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>03 Jan 2025</td>
                                    <td>09:00 AM</td>
                                    <td>08:22 AM</td>
                                    <td>06:30 PM</td>
                                    <td>08h 00m</td>
                                    <td>10h 00m 11s</td>
                                    <td>01h 10m</td>
                                    <td>
                                        <span class="badge bg-success">Present</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>04 Jan 2025</td>
                                    <td>09:00 AM</td>
                                    <td>07:47 AM</td>
                                    <td>06:30 PM</td>
                                    <td>08h 00m</td>
                                    <td>10h 36m 54s</td>
                                    <td>01h 10m</td>
                                    <td>
                                        <span class="badge bg-success">Present</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>05 Jan 2025</td>
                                    <td>09:00 AM</td>
                                    <td>None</td>
                                    <td>06:30 PM</td>
                                    <td>08h 00m</td>
                                    <td>00h 00m 00s</td>
                                    <td>00h 00m</td>
                                    <td>
                                        <span class="badge bg-purple">Holiday</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>06 Jan 2025</td>
                                    <td>09:00 AM</td>
                                    <td>08:05 AM</td>
                                    <td>06:30 PM</td>
                                    <td>08h 00m</td>
                                    <td>09h 23m 34s</td>
                                    <td>01h 10m</td>
                                    <td>
                                        <span class="badge bg-success">Present</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>07 Jan 2025</td>
                                    <td>09:00 AM</td>
                                    <td>08:41 AM</td>
                                    <td>06:30 PM</td>
                                    <td>08h 00m</td>
                                    <td>10h 30m 42s</td>
                                    <td>01h 10m</td>
                                    <td>
                                        <span class="badge bg-success">Present</span>
                                    </td>
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