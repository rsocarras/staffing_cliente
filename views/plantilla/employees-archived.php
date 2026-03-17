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
                            <h4 class="fs-20 fw-bold mb-0">Employees</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>    
                                <li class="breadcrumb-item active" aria-current="page">Employees</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    <!-- Start row -->
                    <div class="row row-gap-4 mb-4">
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-xl-nowrap flex-wrap gap-2">
                                        <img src="/assets/img/icons/member-01.svg" alt="member-01" class="img-fluid">
                                        <div class="w-100">
                                            <p class="mb-1">Total Employees</p>
                                            <h4 class="mb-0 d-flex align-items-center justify-content-between gap-2 flex-wrap fs-20 fw-bold">2520<span class="fs-12 text-success d-flex align-items-center gap-1 fw-normal"><i class="ti ti-trending-up"></i>22.5%</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-xl-nowrap flex-wrap gap-2">
                                        <img src="/assets/img/icons/member-02.svg" alt="member-01" class="img-fluid">
                                        <div class="w-100">
                                            <p class="mb-1">Active Employees</p>
                                            <h4 class="mb-0 d-flex align-items-center justify-content-between gap-2 flex-wrap fs-20 fw-bold">2000<span class="fs-12 text-success d-flex align-items-center gap-1 fw-normal"><i class="ti ti-trending-up"></i>15.2%</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-xl-nowrap flex-wrap gap-2">
                                        <img src="/assets/img/icons/member-03.svg" alt="member-01" class="img-fluid">
                                        <div class="w-100">
                                            <p class="mb-1">Inactive Employees</p>
                                            <h4 class="mb-0 d-flex align-items-center justify-content-between gap-2 flex-wrap fs-20 fw-bold">350<span class="fs-12 text-success d-flex align-items-center gap-1 fw-normal"><i class="ti ti-trending-up"></i>16.3%</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center flex-xl-nowrap flex-wrap gap-2">
                                        <img src="/assets/img/icons/member-04.svg" alt="member-01" class="img-fluid">
                                        <div class="w-100">
                                            <p class="mb-1">Archieved Employees</p>
                                            <h4 class="mb-0 d-flex align-items-center justify-content-between gap-2 flex-wrap fs-20 fw-bold">170<span class="fs-12 text-danger d-flex align-items-center gap-1 fw-normal"><i class="ti ti-trending-down"></i>10.5%</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- End row -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="employees" class="nav-link">
                                <span class="d-md-inline-block">Active Employees</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="employees-deactivated" class="nav-link">
                                <span class="d-md-inline-block">Deactivated Employees</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="employees-archived" class="nav-link active">
                                <span class="d-md-inline-block">Archived Employees</span>
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
                            <div class="p-1 border rounded-2 bg-white d-flex align-items-center justify-content-center gap-1">
                                <a href="employees" class="p-1 rounded-2 d-flex align-items-center justify-content-center active bg-dark text-white"><i class="ti ti-list-tree fs-16"></i></a>
                                <a href="employees-grid" class="p-1 rounded-2 d-flex align-items-center justify-content-center"><i class="ti ti-layout-grid fs-16"></i></a>
                            </div>
                            <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                            </div>
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
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#add_new"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- End Search and Filter -->
                    
                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Team</th>
                                    <th>Work Location</th>
                                    <th>Email Address</th>
                                    <th>Phone Number</th>
                                    <th>Experience</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Shaun Farley</a></h6>
                                                <p class="fs-13 mb-0">Frontend Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>UX Research</td>
                                    <td>Remote</td>
                                    <td>shaurn@example.com</td>
                                    <td>+1 578 209 4965</td>
                                    <td>2 years</td>
                                    <td><span class="badge badge-soft-info">Archived</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded"><img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img"></a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Jenny Ellis</a></h6>
                                                <p class="fs-13 mb-0">DevOps Engineer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>DevOps</td>
                                    <td>Office</td>
                                    <td>jenny@example.com</td>
                                    <td>+1 278 301 7284</td>
                                    <td>5 years</td>
                                    <td><span class="badge badge-soft-info">Archived</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded"><img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img"></a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Adrian Travon</a></h6>
                                                <p class="fs-13 mb-0">Cloud Architect</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Cloud Computing</td>
                                    <td>Remote</td>
                                    <td>adrian@example.com</td>
                                    <td>+1 310 555 0148</td>
                                    <td>4 years</td>
                                    <td><span class="badge badge-soft-info">Archived</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded"><img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img"></a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Aliza Duncan</a></h6>
                                                <p class="fs-13 mb-0">Data Analyst</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Data & Analytics</td>
                                    <td>Remote</td>
                                    <td>aliza@example.com</td>
                                    <td>+1 702 555 0189</td>
                                    <td>3 years</td>
                                    <td><span class="badge badge-soft-info">Archived</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded"><img src="/assets/img/users/user-08.jpg" class="img-fluid" alt="img"></a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Karen Galvan</a></h6>
                                                <p class="fs-13 mb-0">Network Engineer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Networking</td>
                                    <td>Remote</td>
                                    <td>karen@example.com</td>
                                    <td>+1 832 555 0166</td>
                                    <td>6 years</td>
                                    <td><span class="badge badge-soft-info">Archived</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->

                </div>
            </div> <!-- end card -->
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->