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
                            <h4 class="fs-20 fw-bold mb-0">Manual Time</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Manual Time</li>
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
                            <a href="edit-time-waiting" class="nav-link active">
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

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Edit Time (H)</th>
                                    <th>Duration</th>
                                    <th>Project</th>
                                    <th>Task</th>
                                    <th>Created Date</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                    <td>11:00 AM - 12:00 PM</td>
                                    <td>01h 35m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Travel Planning Website</a>
                                    </td>
                                    <td>
                                        New Pages Design
                                    </td>
                                    <td>
                                        10 Sep 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
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
                                    <td>03:00 PM - 04:15 PM</td>
                                    <td>01h 00m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Invoice & Billing Software</a>
                                    </td>
                                    <td>
                                        Components Creation
                                    </td>
                                    <td>
                                        14 Oct 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
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
                                    <td>03:00 PM - 05:00 PM</td>
                                    <td>02h 00m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">POS Admin Software</a>
                                    </td>
                                    <td>
                                        Landing Page
                                    </td>
                                    <td>
                                        10 Dec 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/profiles/avatar-15.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">James Higham</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>04:00PM - 05:10 PM</td>
                                    <td>01h 10m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">POS Admin Software</a>
                                    </td>
                                    <td>
                                        Landing Page
                                    </td>
                                    <td>
                                        03 Oct 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
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
                                    <td>12:00 PM - 01:00PM</td>
                                    <td>01h 35m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">POS Admin Software</a>
                                    </td>
                                    <td>
                                        Components Creation
                                    </td>
                                    <td>
                                        25 Oct 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
                                    </td>
                                </tr>
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
                                    <td>12:00 PM - 01:00PM</td>
                                    <td>00h 45m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Office Management</a>
                                    </td>
                                    <td>
                                        Components Creation
                                    </td>
                                    <td>
                                        24 Dec 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
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
                                    <td>12:00 PM - 01:00PM</td>
                                    <td>00h 30m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Travel Planning Website</a>
                                    </td>
                                    <td>
                                        Components Creation
                                    </td>
                                    <td>
                                        27 Nov 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
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
                                    <td>02:00 PM - 02:25 PM</td>
                                    <td>02h 35m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Food Order App</a>
                                    </td>
                                    <td>
                                        New Pages Design
                                    </td>
                                    <td>
                                        03 Oct 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
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
                                    <td>12:00 PM - 01:00PM</td>
                                    <td>01h 35m</td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Chat & Call Mobile App</a>
                                    </td>
                                    <td>
                                        Components Creation
                                    </td>
                                    <td>
                                        03 Oct 2025
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text fs-18"></i></a>
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
