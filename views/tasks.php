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
                            <h4 class="fs-20 fw-bold mb-0">Tasks</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Tasks</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="tasks" class="nav-link active">
                                <span class="d-md-inline-block"><i class="ti ti-box fs-16 me-2"></i>Active</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tasks-onhold" class="nav-link ">
                                <span class="d-md-inline-block"><i class="ti ti-hourglass-empty fs-16 me-2"></i>On Hold</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tasks-completed" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-checkbox fs-16 me-2"></i>Completed</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tasks-archived" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-archive fs-16 me-2"></i>Archived</span>
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
                                <a href="tasks" class="p-1 rounded-2 d-flex align-items-center justify-content-center active bg-dark text-white"><i class="ti ti-list-tree fs-16"></i></a>
                                <a href="tasks-grid" class="p-1 rounded-2 d-flex align-items-center justify-content-center"><i class="ti ti-layout-grid fs-16"></i></a>
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
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-task"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table mb-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox" id="select-all">
                                        </div>
                                    </th>
                                    <th>Task ID</th>
                                    <th>Project & Task</th>
                                    <th>Created On</th>
                                    <th>Total Hours</th>
                                    <th>Priority</th>
                                    <th>Assignee</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox" id="select-all">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23174</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Office Management</a>
                                        <br> Creating Application Modules
                                    </td>
                                    <td>24 Dec 2025</td>
                                    <td class="fw-medium text-dark">30h 00m</td>
                                    <td>
                                        <span class="badge badge-soft-primary"><i class="ti ti-flag-filled me-1"></i> Low</span>

                                    </td>
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

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item"><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23173</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Service Management App</a>
                                        <br> Creating Application Modules
                                    </td>

                                    <td>10 Dec 2025</td>
                                    <td class="fw-medium text-dark">22h 30m</td>
                                    <td>
                                        <span class="badge badge-soft-danger "><i class="ti ti-flag-filled me-1"></i> High</span>

                                    </td>
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

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23172</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Advanced Booking System</a>
                                        <br> Develop Workflows & Rules
                                    </td>

                                    <td>27 Nov 2025</td>
                                    <td class="fw-medium text-dark">15h 30m</td>
                                    <td>
                                        <span class="badge badge-soft-info "><i class="ti ti-flag-filled me-1"></i> Medium</span>

                                    </td>
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

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23171</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Food Order App</a>
                                        <br> Ad Setup & Campaign Management
                                    </td>

                                    <td>27 Nov 2025</td>
                                    <td class="fw-medium text-dark">22h 15m</td>
                                    <td>
                                        <span class="badge badge-soft-primary "><i class="ti ti-flag-filled me-1"></i> Low</span>

                                    </td>
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

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23170</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Truelysell</a>
                                        <br> Integration & API Testing
                                    </td>

                                    <td>06 Nov 2025</td>
                                    <td class="fw-medium text-dark">12h 50m</td>
                                    <td>
                                        <span class="badge badge-soft-danger "><i class="ti ti-flag-filled me-1"></i> High</span>

                                    </td>
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

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23169</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Dreamschat</a>
                                        <br> Performance Monitoring & Optimization
                                    </td>

                                    <td>25 Oct 2025</td>
                                    <td class="fw-medium text-dark">15h 30m</td>
                                    <td>
                                        <span class="badge badge-soft-danger "><i class="ti ti-flag-filled me-1"></i> High</span>

                                    </td>
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

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23168</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Doccure</a>
                                        <br> Testing & Bug Fixing
                                    </td>

                                    <td>14 Oct 2025</td>
                                    <td class="fw-medium text-dark">22h 15m</td>
                                    <td>
                                        <span class="badge badge-soft-danger "><i class="ti ti-flag-filled me-1"></i> High</span>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Leslie Hensley</a></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23167</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Service Booking App</a>
                                        <br> Creating Application Modules
                                    </td>

                                    <td>03 Oct 2025</td>
                                    <td class="fw-medium text-dark">12h 15m</td>
                                    <td>
                                        <span class="badge badge-soft-danger "><i class="ti ti-flag-filled me-1"></i> High</span>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Karen Galvan</a></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23166</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Doctor Appointment</a>
                                        <br> Creating Icons for Application
                                    </td>

                                    <td>20 Sep 2025</td>
                                    <td class="fw-medium text-dark">12h 15m</td>
                                    <td>
                                        <span class="badge badge-soft-info "><i class="ti ti-flag-filled me-1"></i> Medium</span>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Thomas Ward</a></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <a href="project-details" class="text-primary">#TA23165</a>
                                    </td>
                                    <td>
                                        <a href="project-details" class="fw-medium">Time Tacking</a>
                                        <br> Testing & Bug Fixing
                                    </td>

                                    <td>10 Sep 2025</td>
                                    <td class="fw-medium text-dark">60h 00m</td>
                                    <td>
                                        <span class="badge badge-soft-info text-info "><i class="ti ti-flag-filled me-1"></i> Medium</span>

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">James Higham</a></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-task"><i class="ti ti-edit me-2 "></i>Edit Task</a>
                                            </li>
                                            <li>
                                                <a href="project-details-task" class="dropdown-item "><i class="ti ti-eye me-2 "></i>View Task</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete Task</a>
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