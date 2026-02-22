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
                            <h4 class="fs-20 fw-bold mb-0">Edit Time</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Edit Time</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="edit-time" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-clock me-2"></i>Manual Time</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit-time-waiting" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-clock-stop me-2"></i>Waiting for approval</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit-time-approved" class="nav-link ">
                                <span class="d-md-inline-block"><i class="ti ti-clock-edit me-2"></i>Approved Edit Time</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit-time-request" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-clock-share me-2"></i>Manual Time Requests<span class="badge bg-danger rounded-circle fs-12 text-white value-item ms-2">5</span></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit-shift" class="nav-link active">
                                <span class="d-md-inline-block"><i class="ti ti-clock-pause me-2"></i>Schedule</span>
                            </a>
                        </li>
                    </ul>
                    <!-- end tab -->

                    <!-- Start Search and Filter -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <h6 class="fw-bold mb-0">Schedule</h6>
                        <div class="d-flex align-items-center gap-3"> 
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
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Schedule</th>
                                    <th>Shift Begins At</th>
                                    <th>Shift Ends At</th>
                                    <th>Min Hours</th>
                                    <th>Break Time</th>
                                    <th>Late Status</th>
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
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Shaun Farley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Jenny Ellis</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Leon Baxter</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Karen Flores</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Charles Cline</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Aliza Duncan</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Leslie Hensley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Karen Galvan</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Thomas Ward</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/profiles/avatar-20.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">James Higham</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                Mon - Fri<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Fri</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">Mon - Sat</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                09:30 AM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:00 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">09:30 AM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10:00 AM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                06:30 PM<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:00 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06:30 PM</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">07:00 PM</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                08 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">04 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">06 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">08 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">10 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-white border d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                                01 hr<i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">01 hr</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item">02 hr</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->

                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
