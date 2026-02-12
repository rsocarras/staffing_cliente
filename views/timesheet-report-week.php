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
                            <h4 class="fs-20 fw-bold mb-0">Time Sheet Report</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>       
                                <li class="breadcrumb-item"><a href="reports">Report</a></li>                       
                                <li class="breadcrumb-item active" aria-current="page">Time Sheet Report</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">                                             
                            <a href="timesheet-report" class="nav-link d-flex align-items-center"><i class="ti ti-clock me-2"></i>Time Sheet Report Day</a>
                        </li>
                        <li class="nav-item">
                            <a href="timesheet-report-week" class="nav-link d-flex align-items-center active"><i class="ti ti-clock me-2"></i>Time Sheet Report Week</a>
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
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
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
                        <table class="table mb-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total Time (H)</th>
                                    <th>13 Jan 2025</th>
                                    <th>14 Jan 2025</th>
                                    <th>15 Jan 2025</th>
                                    <th>16 Jan 2025</th>
                                    <th>17 Jan 2025</th>
                                    <th>18 Jan 2025</th>
                                    <th>19 Jan 2025</th>
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
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Shaun Farley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>51h 35m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 70%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 25%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 45%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 75%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 40m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 65%;"></div>
                                            <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 15%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 25m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Jenny Ellis</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>51h 15m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 20m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 70%;"></div>
                                            <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 15%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 25m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 65%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 00m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 00m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Leon Baxter</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>49h 50m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 00m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 00m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 70%;"></div>
                                            <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 10%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 25m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 70%;"></div>
                                            <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 10%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 25m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 40%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 30%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 45m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Karen Flores</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>53h 25m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 70%;"></div>
                                            <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 10%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 25m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 20m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 00m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 40m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Charles Cline</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>50h 45m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 40%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 20m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 70%;"></div>
                                            <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 10%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 25m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 00m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Aliza Duncan</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>51h 55m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 35%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 20m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 20m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar bg-info online avatar-rounded">
                                                <span class="avatar-title text-white">LH</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Leslie Hensley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>52h 22m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 22m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 20%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 00m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 25%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 35%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Karen Galvan</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>52h 20m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 86%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 40m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 25%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 35%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 45m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 40m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 35%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 90%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Thomas Ward</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>51h 16m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 22m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 22m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 40m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 45%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 20%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 45m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 22m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 45%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 45m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">James Higham</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>51h 09m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 45%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 25%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 45m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 40m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 45%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 10%;"></div>
                                            <div class="progress-bar bg-success rounded-end" role="progressbar" style="width: 25%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 45m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 22m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 22m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
                                        </div>
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