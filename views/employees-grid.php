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
                                        <img src="assets/img/icons/member-01.svg" alt="member-01" class="img-fluid">
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
                                        <img src="assets/img/icons/member-02.svg" alt="member-01" class="img-fluid">
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
                                        <img src="assets/img/icons/member-03.svg" alt="member-01" class="img-fluid">
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
                                        <img src="assets/img/icons/member-04.svg" alt="member-01" class="img-fluid">
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
                        
                    <!-- Start Search and Filter -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div class="p-1 border rounded-2 bg-white d-flex align-items-center justify-content-center gap-1">
                                <a href="employees" class="p-1 rounded-2 d-flex align-items-center justify-content-center"><i class="ti ti-list-tree fs-16"></i></a>
                                <a href="employees-grid" class="p-1 rounded-2 d-flex align-items-center justify-content-center active bg-dark text-white"><i class="ti ti-layout-grid fs-16"></i></a>
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
                    <!-- Start row -->
                    <div class="row row-gap-4 mb-4">
                        <!-- Item 1 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Shaun Farley</p>
                                                <p class="mb-0 fs-13 text-muted">Usability Specialist</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">UX Research</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">2 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i> shaurn@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 578 209 4965</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Jenny Ellis</p>
                                                <p class="mb-0 fs-13 text-muted">DevOps Engineer</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">DevOps</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">5 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i> jenny@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 278 301 7284</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Leon Baxter</p>
                                                <p class="mb-0 fs-13 text-muted">Test Lead</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Testing</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">6 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>leon@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 212 555 0173</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Adrian Travon</p>
                                                <p class="mb-0 fs-13 text-muted">Cloud Architect</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Cloud</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">4 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>adrian@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 310 555 0148</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Item 5 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Charles Cline</p>
                                                <p class="mb-0 fs-13 text-muted">Security Engineer</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Cybersecurity</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">7 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i> charles@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 548 209 6578</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 6 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Aliza Duncan</p>
                                                <p class="mb-0 fs-13 text-muted">Data Analyst</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Analytics</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">3 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>aliza@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 702 555 0189</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 7 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <span class="avatar-title bg-soft-info text-info fs-18 rounded-circle">LH</span>
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Leslie Hensley</p>
                                                <p class="mb-0 fs-13 text-muted">Technician</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">IT Support</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">9 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>leslie@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 617 555 0134</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 8 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Karen Galvan</p>
                                                <p class="mb-0 fs-13 text-muted">Network Engineer</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Networking</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">6 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>karen@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 832 555 0166</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 9 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-23.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">James Higham</p>
                                                <p class="mb-0 fs-13 text-muted">Android Developer</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Mobile App</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">5 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>james@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 404 555 0102</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 10 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-21.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Thomas Ward</p>
                                                <p class="mb-0 fs-13 text-muted">UI Designer</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Design</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">10 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>thomas@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 503 555 0157</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 11 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-11.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Megan Rawls</p>
                                                <p class="mb-0 fs-13 text-muted">Test Analyst</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Quality</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">6 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>megan@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 475 027 9758</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Item 12 -->
                        <div class="col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-6 d-flex">
                            <div class="card mb-0 flex-fill">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap mb-3 p-2 bg-light rounded">
                                        <div class="d-flex align-items-center gap-2 flex-wrap flex-xl-nowrap">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded flex-shrink-0">
                                                <img src="assets/img/users/user-12.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="w-100">
                                                <p class="mb-1 fw-medium text-dark">Alan Taylor</p>
                                                <p class="mb-0 fs-13 text-muted">Business Director</p>
                                            </div>
                                        </div>
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
                                    </div>
                                    <div class="row row-gap-2 mb-3 pb-3 border-bottom">
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Team</h6>
                                            <p class="mb-0">Business</p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="fs-13 fw-semibold mb-1">Experience</h6>
                                            <p class="mb-0">8 Years</p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <p class="d-flex align-items-center gap-1 mb-2"><i class="ti ti-mail text-dark"></i>alan@example.com</p>
                                        <p class="d-flex align-items-center gap-1 mb-0"><i class="ti ti-device-mobile text-dark"></i>+1 865 347 0975</p>
                                    </div>
                                    <a href="employee-details" class="btn btn-outline-light fw-medium d-flex align-items-center gap-2">View Details<i class="ti ti-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    <div class="text-center">
                        <a href="javascript:void(0);" class="btn btn-dark"> Load More</a>
                    </div>
                </div>
            </div> <!-- end card -->
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->