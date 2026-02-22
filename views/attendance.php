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
                                <li class="breadcrumb-item active" aria-current="page">Attendance</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->
                        
                    <!-- start row -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-lg bg-soft-primary rounded me-2 flex-shrink-0">
                                                <i class="ti ti-user-star text-primary fs-24 fw-normal"></i>
                                            </div>
                                            <div>
                                                <span class="mb-1 d-block">Total Attendance</span>
                                                <h4 class="fw-bold m-0">2520</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-lg bg-soft-success rounded-1 me-2 flex-shrink-0">
                                                <i class="ti ti-user-bolt text-success fs-24 fw-normal"></i>
                                            </div>
                                            <div>
                                                <span class="mb-1 d-block">Total Present</span>
                                                <h4 class="fw-bold m-0">2502</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card flex-fill ">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-lg bg-soft-danger rounded-1 me-2 flex-shrink-0">
                                                <i class="ti ti-user-x text-danger fs-24 fw-normal"></i>
                                            </div>
                                            <div>
                                                <span class="mb-1 d-block">Total Absentees</span>
                                                <h4 class="fw-bold m-0">65</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->


                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-lg bg-soft-secondary rounded-1 me-2 flex-shrink-0">
                                                <i class="ti ti-user-share text-secondary fs-24 fw-normal"></i>
                                            </div>
                                            <div>
                                                <span class="mb-1 d-block">Total Late Login</span>
                                                <h4 class="fw-bold m-0">15</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

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
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_attendance"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Clock In</th>
                                    <th>Clock Out</th>
                                    <th>Location</th>
                                    <th>Total Worked (H)</th>
                                    <th></th>
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
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Shaun Farley</a></h6>
                                                <p class="fs-13 m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>24 Dec 2025</td>
                                    <td>09:05 AM</td>
                                    <td>07:40 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-home me-1"></i>Remote</span></td>
                                    <td><h6 class="fw-medium">09h 45m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Jenny Ellis</a></h6>
                                                <p class="fs-13 m-0">PHP Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>10 Dec 2025</td>
                                    <td class="text-danger">09:20 AM</td>
                                    <td>07:45 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">09h 10m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Leon Baxter</a></h6>
                                                <p class="fs-13 m-0">Senior Manager</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>27 Nov 2025</td>
                                    <td class="text-danger">09:30 AM</td>
                                    <td>07:15 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">09h 14m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Karen Flores</a></h6>
                                                <p class="fs-13 m-0">SEO Analyst</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>27 Nov 2025</td>
                                    <td>09:01 AM</td>
                                    <td>08:30 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">09h 11m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Charles Cline</a></h6>
                                                <p class="fs-13 m-0">HR Assistant</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>06 Nov 2025</td>
                                    <td>08:50 AM</td>
                                    <td>08:40 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">09h 12m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Aliza Duncan</a></h6>
                                                <p class="fs-13 m-0">Application Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>25 Oct 2025</td>
                                    <td>08:45 AM</td>
                                    <td>08:00 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">08h 15m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar bg-violet-500 online avatar-rounded">
                                                <img src="/assets/img/users/user-16.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Leslie Hensley</a></h6>
                                                <p class="fs-13 m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>14 Oct 2025</td>
                                    <td>09:00 AM</td>
                                    <td>08:10 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">09h 12m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Karen Galvan</a></h6>
                                                <p class="fs-13 m-0">Android Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>03 Oct 2025</td>
                                    <td>08:55 AM</td>
                                    <td>07:45 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">09h 15m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">Thomas Ward</a></h6>
                                                <p class="fs-13 m-0">IOS Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>20 Sep 2025</td>
                                    <td>08:40 AM</td>
                                    <td>07:20 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">09h 41m</h6></td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#">James Higham</a></h6>
                                                <p class="fs-13 m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>10 Sep 2025</td>
                                    <td>09:04 AM</td>
                                    <td>07:20 PM</td>
                                    <td><span class="badge badge-md bg-light py-1 px-2 text-dark fs-12 fw-normal"><i class="ti ti-building me-1"></i>Office</span></td>
                                    <td><h6 class="fw-medium">08h 45m</h6></td>
                                    <td>
                                        <a class="dropdown-toggle drop-arrow-none" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_attendance"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                            </li>
                                        </ul>
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
