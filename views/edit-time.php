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

                        <!-- start row -->
                    <div class="row gx-0 custom-edit-time">
                        <div class="col-xl col-lg-6 d-flex">
                            <div class="card rounded-start shadow-none flex-fill manual-time-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2 flex-wrap">
                                        <span class="p-1 rounded bg-warning d-flex align-items-center justify-content-center me-2"><i class="ti ti-clock-plus text-white fs-16"></i></span>
                                        <span>Edit Hours</span>
                                    </div>
                                    <h4 class="fw-bold mb-0">59h 25m</h4>
                                </div> <!-- end card body -->
                            </div>  <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl col-lg-6 d-flex">
                            <div class="card shadow-none flex-fill manual-time-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="p-1 rounded bg-primary d-flex text-white align-items-center justify-content-center me-2"><i class="ti ti-clock-record fs-16"></i></span>
                                        <span>Edit Hours Today</span>
                                    </div>
                                    <h4 class="fw-bold mb-0">02h 15m</h4>
                                </div> <!-- end card body -->
                            </div>  <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl col-lg-6 d-flex">
                            <div class="card shadow-none flex-fill manual-time-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="p-1 rounded bg-success d-flex align-items-center justify-content-center me-2"><i class="ti ti-clock-share text-white fs-16"></i></span>
                                        <span>Approved Hours</span>
                                    </div>
                                    <h4 class="fw-bold mb-0">25h 21m</h4>
                                </div> <!-- end card body -->
                            </div>  <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl col-lg-6 d-flex">
                            <div class="card shadow-none flex-fill manual-time-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="p-1 rounded bg-danger d-flex align-items-center justify-content-center me-2"><i class="ti ti-clock-x text-white fs-16"></i></span>
                                        <span>Rejected Hours</span>
                                    </div>
                                    <h4 class="fw-bold mb-0">05h 10m</h4>
                                </div> <!-- end card body -->
                            </div>  <!-- end card -->
                        </div> <!-- end col -->


                        <div class="col-xl col-lg-6 d-flex">
                            <div class="card rounded-end border-end shadow-none flex-fill manual-time-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="p-1 rounded bg-info text-white d-flex align-items-center justify-content-center me-2"><i class="ti ti-clock-x text-white fs-16"></i></span>
                                        <span>Pending Approval</span>
                                    </div>
                                    <h4 class="fw-bold mb-0">15h 45m</h4>
                                </div> <!-- end card body -->
                            </div>  <!-- end card -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="edit-time" class="nav-link active">
                                <span class="d-md-inline-block"><i class="ti ti-clock me-2"></i>Manual Time</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit-time-waiting" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-clock-stop me-2"></i>Waiting for approval</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit-time-approved" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-clock-edit me-2"></i>Approved Edit Time</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit-time-request" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-clock-share me-2"></i>Manual Time Requests<span class="badge bg-danger rounded-circle fs-12 text-white value-item ms-2">5</span></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="edit-shift" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-clock-pause me-2"></i>Schedule</span>
                            </a>
                        </li>
                    </ul>
                    <!-- end tab -->

                    <!-- Start Search and Filter -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="btn btn-outline-light text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-sort-descending-2 me-1 "></i>Sort By : <span class="ms-1">Newest</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1">Newest</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" class="dropdown-item rounded-1">Oldest</a>
                                    </li>
                                </ul>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-manual-time"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- Start Search and Filter -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <h6 class="fw-bold mb-0">Waiting for Approval</h6>
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
                            <div class="input-group input-group-flat custom-date">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" value="15 jun 2025">
                            </div>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <div class="bg-white border rounded p-3 mb-4">
                        <div class="d-flex align-items-center mb-3 flex-wrap gap-1">
                            <div class="me-4">
                                <span class="mb-1"><i class="ti ti-point-filled text-success fs-14 me-1"></i>Total Working hours</span>
                                <h6 class="fs-16 fw-semibold">06h 45m</h6>
                            </div>
                            <div>
                                <span class="mb-1"><i class="ti ti-point-filled text-warning fs-14 me-1"></i>Edited hours</span>
                                <h6 class="fs-16 fw-semibold">00h 45m</h6>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table text-nowrap rounded-2 border overflow-hidden mb-0">
                                <tr>
                                    <td class="border-0 pb-1 p-0">
                                        <div class="progress mb-1 py-1 px-1 custom-progress-bar-height">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 1%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 12:35 AM - 01:25 AM<br>Duration : 00h 44m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 20%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr >
                                    <td class="border-0 pb-2 p-0"> 
                                        <div>
                                            <span class="fs-13 me-3">06:00 AM</span>
                                            <span class="fs-13 me-3">07:00 AM</span>
                                            <span class="fs-13 me-3">08:00 AM</span>
                                            <span class="fs-13 me-3">09:00 AM</span>
                                            <span class="fs-13 me-3">10:00 AM</span>
                                            <span class="fs-13 me-3">11:00 AM</span>
                                            <span class="fs-13 me-3">12:00 PM</span>
                                            <span class="fs-13 me-3">01:00 PM</span>
                                            <span class="fs-13 me-3">02:00 PM</span>
                                            <span class="fs-13 me-3">03:00 PM</span>
                                            <span class="fs-13 me-3">04:00 PM</span>
                                            <span class="fs-13 me-3">05:00 PM</span>
                                            <span class="fs-13 me-3">06:00 PM</span>
                                            <span class="fs-13 me-3">07:00 PM</span>
                                            <span class="fs-13 me-3">08:00 PM</span>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Start Table List -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Start Time (H)</th>
                                    <th>End Time (H)</th>
                                    <th>Total Time (H)</th>
                                    <th>Project Name</th>
                                    <th>Tasks</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        12:00 AM
                                    </td>
                                    <td>
                                        09:10 AM
                                    </td>
                                    <td>
                                        09h 10m 14s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Office Management</a>
                                    </td>
                                    <td>
                                        -Not Working-
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#add_time"><i class="ti ti-plus me-1"></i> Add Time</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        09:10 AM
                                    </td>
                                    <td>
                                        09:17 AM
                                    </td>
                                    <td>
                                        00h 07m 21s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Clinic Management</a>
                                    </td>
                                    <td>
                                        Component Creation
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm text-danger bg-transparent border-danger d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        09:17 AM
                                    </td>
                                    <td>
                                        11:19 AM
                                    </td>
                                    <td>
                                        02h 02m 26s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                    </td>
                                    <td>
                                        New Pages Design
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm text-danger bg-transparent border-danger d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        11:19 AM
                                    </td>
                                    <td>
                                        11:30 AM
                                    </td>
                                    <td>
                                        00h 09m 17s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Travel Planning Website</a>
                                    </td>
                                    <td>
                                        -Not Working-
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_time"><i class="ti ti-plus me-1"></i> Add Time</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        11:30 AM
                                    </td>
                                    <td>
                                        02:00 PM
                                    </td>
                                    <td>
                                        02h 30m 40s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Travel Planning Website</a>
                                    </td>
                                    <td>
                                        New Pages Design
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm text-danger bg-transparent border-danger d-inline-flex align-items-center justify-content-center " data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        02:00 PM
                                    </td>
                                    <td>
                                        02:30 PM
                                    </td>
                                    <td>
                                        00h 30m 15s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Travel Planning Website</a>
                                    </td>
                                    <td>
                                        -Not Working-
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_time"><i class="ti ti-plus me-1"></i> Add Time</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        02:30 PM
                                    </td>
                                    <td>
                                        05:30 PM
                                    </td>
                                    <td>
                                        03h 00m 35s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Food Order App</a>
                                    </td>
                                    <td>
                                        New Pages Design
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm text-danger bg-transparent border-danger d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        05:30 PM
                                    </td>
                                    <td>
                                        05:45 PM
                                    </td>
                                    <td>
                                        00h 15m 10s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Food Order App</a>
                                    </td>
                                    <td>
                                        -Not Working-
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_time"><i class="ti ti-plus me-1"></i> Add Time</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        05:45 PM
                                    </td>
                                    <td>
                                        07:59 PM
                                    </td>
                                    <td>
                                        02h 14m 14s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Food Order App</a>
                                    </td>
                                    <td>
                                        New Pages Design
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm text-danger bg-transparent border-danger d-inline-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        07:59 PM
                                    </td>
                                    <td>
                                        11:59 PM
                                    </td>
                                    <td>
                                        04h 00m 14s
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Food Order App</a>
                                    </td>
                                    <td>
                                        -Not Working-
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#add_time"><i class="ti ti-plus me-1"></i> Add Time</a>
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
