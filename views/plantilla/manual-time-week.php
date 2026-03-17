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
                            <h4 class="fs-18 fw-semibold mb-0">Manual Time</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>    
                                <li class="breadcrumb-item"><a href="reports">Report</a></li>                          
                                <li class="breadcrumb-item active" aria-current="page">Manual Time</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->
            
                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">                                             
                            <a href="manual-time" class="nav-link d-flex align-items-center"><i class="ti ti-clock me-2"></i>Manual Time Report Day</a>
                        </li>
                        <li class="nav-item">
                            <a href="manual-time-week" class="nav-link d-flex align-items-center active"><i class="ti ti-clock me-2"></i>Manual Time Report Week</a>
                        </li>
                    </ul>

                    <!-- Start Filter-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-end gap-2">
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
                            <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Filter-->

                    <!-- item 1 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 02 Jan 2025</h6>
                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Leon Baxter</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Clinic Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-danger fs-10"><i class="ti ti-point-filled me-1"></i>Rejected</span></td>
                                        <td>Meeting With Client</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 1 -->

                    <!-- item 2 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 03 Jan 2025</h6>
                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Shaun Farley</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Office Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Jenny Ellis</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 30m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Travel Planning Website</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-warning fs-10"><i class="ti ti-point-filled me-1"></i>Pending</span></td>
                                        <td>Project Not Added</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 2 -->

                    <!-- item 3 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 04 Jan 2025</h6>
                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Shaun Farley</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Office Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Jenny Ellis</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 30m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Travel Planning Website</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-warning fs-10"><i class="ti ti-point-filled me-1"></i>Pending</span></td>
                                        <td>Project Not Added</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Leon Baxter</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Clinic Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-danger fs-10"><i class="ti ti-point-filled me-1"></i>Rejected</span></td>
                                        <td>Meeting With Client</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 3 -->

                    <!-- item 4 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 05 Jan 2025</h6>
                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Shaun Farley</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Office Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 4 -->

                    <!-- item 5 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 06 Jan 2025</h6>
                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Leon Baxter</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Clinic Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-danger fs-10"><i class="ti ti-point-filled me-1"></i>Rejected</span></td>
                                        <td>Meeting With Client</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 5 -->

                    <!-- item 6 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 07 Jan 2025</h6>
                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Charles Cline</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 30m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-danger fs-10"><i class="ti ti-point-filled me-1"></i>Rejected</span></td>
                                        <td>Meeting With Client</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 6 -->

                    <!-- item 7 -->
                    <div class="mb-0">
                        <h6 class="fs-14 fw-medium mb-3">Date : 08 Jan 2025</h6>
                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Shaun Farley</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Office Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10"><i class="ti ti-point-filled me-1"></i>Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 7 -->

                </div>
            </div>
                            
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->