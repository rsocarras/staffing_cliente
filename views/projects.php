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
                            <h4 class="fs-20 fw-bold mb-0">Projects</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Applications</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Projects</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->
                        
                    <!-- Start row -->
                    <div class="row row-gap-4 mb-4">
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center  gap-2">
                                        <div class="w-100">
                                            <p class="mb-1">Total Projects</p>
                                            <h4 class="mb-0 d-flex align-items-center justify-content-start gap-2 flex-wrap fs-20 fw-bold">2520<span class="fs-12 text-success d-flex align-items-center gap-1 fw-normal"><i class="ti ti-trending-up"></i>15.2%</span></h4>
                                        </div>
                                        <div class="avatar bg-primary rounded flex-shrink-0">
                                            <i class="ti ti-box fs-18 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-set w-100" id="chart-col-1"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="w-100">
                                            <p class="mb-1">Active </p>
                                            <h4 class="mb-0 d-flex align-items-center justify-content-start gap-2 flex-wrap fs-20 fw-bold">2502<span class="fs-12 text-success d-flex align-items-center gap-1 fw-normal"><i class="ti ti-trending-up"></i>11.3%</span></h4>
                                        </div>
                                        <div class="avatar bg-secondary rounded flex-shrink-0">
                                            <i class="ti ti-user-bolt fs-18 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-set" id="chart-col-2"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="w-100">
                                            <p class="mb-1">InProgress</p>
                                            <h4 class="mb-0 d-flex align-items-center justify-content-start gap-2 flex-wrap fs-20 fw-bold">350<span class="fs-12 text-success d-flex align-items-center gap-1 fw-normal"><i class="ti ti-trending-up"></i>13.5%</span></h4>
                                        </div>
                                        <div class="avatar bg-info rounded flex-shrink-0">
                                            <i class="ti ti-user-x fs-18 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-set w-100" id="chart-col-3"></div>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-xl-3 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill overflow-hidden">
                                <div class="card-body">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="w-100">
                                            <p class="mb-1">Completed</p>
                                            <h4 class="mb-0 d-flex align-items-center justify-content-start gap-2 flex-wrap fs-20 fw-bold">170<span class="fs-12 text-danger d-flex align-items-center gap-1 fw-normal"><i class="ti ti-trending-down"></i>01.2%</span></h4>
                                        </div>
                                        <div class="avatar bg-success rounded flex-shrink-0">
                                            <i class="ti ti-user-share fs-18 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart-set w-100" id="chart-col-4"></div>
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
                                <a href="projects" class="p-1 rounded-2 d-flex align-items-center justify-content-center active bg-dark text-white"><i class="ti ti-list-tree fs-16"></i></a>
                                <a href="projects-grid" class="p-1 rounded-2 d-flex align-items-center justify-content-center"><i class="ti ti-layout-grid fs-16"></i></a>
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
                        <table class="table mb-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Project Code</th>
                                    <th>Project Name</th>
                                    <th>Team Members</th>
                                    <th>Budget</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a href="javascript:void(0);">#PR0001</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo1.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">Office Management</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-03.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-06.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-02.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td>$42,000</td>
                                    <td>24 Dec 2025</td>
                                    <td><span class="badge badge-soft-success">Completed</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0002</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo2.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">Clinic Management</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-01.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-02.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-04.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                        </div>
                                    </td>
                                    <td>$50,000</td>
                                    <td>10 Dec 2025</td>
                                    <td><span class="badge badge-soft-info">In Progress</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0003</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo3.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">Educational Platform</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-05.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-06.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                        </div>
                                    </td>
                                    <td>$27,000</td>
                                    <td>27 Nov 2025</td>
                                    <td><span class="badge badge-soft-success">Completed</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0004</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo4.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">Chat & Call Mobile App</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-07.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-08.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                        </div>
                                    </td>
                                    <td>$48,000</td>
                                    <td>27 Nov 2025</td>
                                    <td><span class="badge badge-soft-danger">New</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0005</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo5.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">Travel Planning Website</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-07.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-08.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-09.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td>$36,000</td>
                                    <td>06 Nov 2025</td>
                                    <td><span class="badge badge-soft-danger">New</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0006</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo6.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">Service Booking Software</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-11.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-12.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-13.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                        </div>
                                    </td>
                                    <td>$11,000</td>
                                    <td>25 Oct 2025</td>
                                    <td><span class="badge badge-soft-success">Completed</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0007</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo7.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details" data-bs-toggle="offcanvas" data-bs-target="#view_details">Car & Bike Rental Software</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-14.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-15.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-15.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+4</a>
                                        </div>
                                    </td>
                                    <td>$18,000</td>
                                    <td>14 Oct 2025</td>
                                    <td><span class="badge badge-soft-info">In Progress</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0008</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo8.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">Food Order App</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-15.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-16.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-17.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td>$14,000</td>
                                    <td>03 Oct 2025</td>
                                    <td><span class="badge badge-soft-danger">New</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0009</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo9.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">Invoice & Billing Software</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-17.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-18.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-19.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                        </div>
                                    </td>
                                    <td>$12,000</td>
                                    <td>20 Sep 2025</td>
                                    <td><span class="badge badge-soft-danger">New</span></td>
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
                                    <td><a href="javascript:void(0);">#PR0010</a></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm border avatar-rounded" data-bs-toggle="offcanvas" data-bs-target="#view_details">
                                                <img src="./assets/img/icons/project-logo10.svg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#view_details">POS Admin Software</a></h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-20.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-21.jpg" class="border border-white" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img src="assets/img/profiles/avatar-22.jpg" class="border border-white" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+3</a>
                                        </div>
                                    </td>
                                    <td>$22,000</td>
                                    <td>10 Sep 2025</td>
                                    <td><span class="badge badge-soft-success">Completed</span></td>
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
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->