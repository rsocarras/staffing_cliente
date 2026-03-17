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
                                <a href="projects" class="p-1 rounded-2 d-flex align-items-center justify-content-center"><i class="ti ti-list-tree fs-16"></i></a>
                                <a href="projects-grid" class="p-1 rounded-2 d-flex align-items-center justify-content-center active bg-dark text-white"><i class="ti ti-layout-grid fs-16"></i></a>
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
                    <div class="row row-gap-4 justify-content-center custom-btn-icons mb-4">
                        <!-- Item 1 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo6.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Service Booking Software</a></h6>
                                                <span>Tasks : 04/08</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Simplify scheduling and manage service bookings.</p>
                                        <p class="mb-1">Progress : 50%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 16.6%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 20 Jul 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 50 hrs</p>
                                        </div>
                                        
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded">
                                                    <img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img">
                                                </span>
                                                <span class="avatar avatar-rounded">
                                                    <img class="border border-white" src="assets/img/profiles/avatar-15.jpg" alt="img">
                                                </span>
                                                <span class="avatar avatar-rounded">
                                                    <img class="border border-white" src="assets/img/profiles/avatar-01.jpg" alt="img">
                                                </span>
                                                <span class="avatar avatar-rounded">
                                                    <img class="border border-white" src="assets/img/profiles/avatar-12.jpg" alt="img">
                                                </span>
                                                <a class="avatar bg-primary avatar-rounded text-fixed-white fs-10 fw-medium" href="javascript:void(0);">
                                                    +1
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo2.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Clinic Management</a></h6>
                                                <span>Tasks : 12/24</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Manage patient records, appointments, prescriptions.</p>
                                        <p class="mb-1">Progress : 60%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 14 Jun 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 95 hrs</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-04.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-01.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-08.jpg" class="border border-white" alt="img"></span>
                                                <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo3.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Educational Platform</a></h6>
                                                <span>Tasks : 09/09</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Empower learning through course modules, tests.</p>
                                        <p class="mb-1">Progress : 100%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 03 Jul 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 30 hrs</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-05.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-09.jpg" class="border border-white" alt="img"></span>
                                                <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 4 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo4.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Chat & Call Mobile App</a></h6>
                                                <span>Tasks : 12/14</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Real-time messaging, voice/video call features.</p>
                                        <p class="mb-1">Progress : 70%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 70%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 28 May 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 95 hrs</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-07.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-11.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-12.jpg" class="border border-white" alt="img"></span>
                                                <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Item 5 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo5.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Travel Planning Website</a></h6>
                                                <span>Tasks : 12/20</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Plan, book, and manage travel itineraries.</p>
                                        <p class="mb-1">Progress : 20%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 20%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 14 May 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 60 hrs</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-13.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-14.jpg" class="border border-white" alt="img"></span>
                                                <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Item 6 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo6.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Service Booking Software</a></h6>
                                                <span>Tasks : 04/08</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Allow customers to book appointments.</p>
                                        <p class="mb-1">Progress : 50%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 50%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 20 Jul 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 50 hrs</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-10.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-15.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-01.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-12.jpg" class="border border-white" alt="img"></span>
                                                <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Item 7 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo7.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Car & Bike Rental Admin.</a></h6>
                                                <span>Tasks : 15/25</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Manage rental bookings, vehicle tracking.</p>
                                        <p class="mb-1">Progress : 45%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 45%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 25 Aug 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 80 hrs</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-03.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-09.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-16.jpg" class="border border-white" alt="img"></span>
                                                <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Item 8 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo8.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Food Order Management</a></h6>
                                                <span>Tasks : 09/15</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Track restaurant menus, manage food orders.</p>
                                        <p class="mb-1">Progress : 60%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 60%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 10 Sep 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 70 hrs</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-05.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-12.jpg" class="border border-white" alt="img"></span>
                                                <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+3</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Iitem- 9 -->
                        <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                            <div class="card mb-0 flex-fill flex-fill">
                                <div class="card-body w-100">
                                    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-shrink-0 me-2">
                                                <a href="javascript:void(0);" class="avatar avatar-lg rounded-circle border">
                                                    <img class="img-fluid rounded-circle" src="./assets/img/icons/project-logo9.svg" alt="img">
                                                </a>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1"><a href="javascript:void(0);">Invoice & Billing Software</a></h6>
                                                <span>Tasks : 05/10</span>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#view_details"><i class="ti ti-eye me-2"></i>View</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#edit_new"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="mb-3 pb-3 border-bottom">
                                        <p class="mb-3">Generate invoices, track payments, and billing records.</p>
                                        <p class="mb-1">Progress : 30%</p>
                                        <div class="progress mb-3" style="height: 5px;">
                                            <div class="progress-bar bg-info" style="width: 30%;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center flex-wrap justify-content-between gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-calendar text-body"></i> 05 Oct 2025</p>
                                            <p class="d-flex align-items-center gap-1 text-dark mb-0"><i class="ti ti-clock text-body"></i> 40 hrs</p>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-list-stacked avatar-group-sm">
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-06.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-08.jpg" class="border border-white" alt="img"></span>
                                                <span class="avatar avatar-rounded"><img src="/assets/img/profiles/avatar-11.jpg" class="border border-white" alt="img"></span>
                                                <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+2</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    <div class="d-flex align-items-center justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-dark">Load More</a>
                    </div>
                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->