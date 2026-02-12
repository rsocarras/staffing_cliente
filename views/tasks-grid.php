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
                                <a href="tasks" class="p-1 rounded-2 d-flex align-items-center justify-content-center"><i class="ti ti-list-tree fs-16"></i></a>
                                <a href="tasks-grid" class="p-1 rounded-2 d-flex align-items-center justify-content-center active bg-dark text-white"><i class="ti ti-layout-grid fs-16"></i></a>
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

                    <div class="d-flex overflow-auto gap-3">

                        <!-- Start Todo -->
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-semibold d-flex align-items-center mb-0">To Do<span class="badge bg-dark ms-2 rounded-circle px-2">4</span> </h6>
                                <a href="javascript:void(0);" class="bg-light p-2 rounded-circle d-flex align-items-center justify-content-center"><i class="ti ti-plus" data-bs-toggle="modal" data-bs-target="#add-task"></i></a>
                            </div>
                            <div class="kanban-drag-wrap">
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3"> 
                                                    <span class="badge badge-soft-info">Design</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 0%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>07 Jan 2025</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-01.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                                    <span class="badge badge-soft-info bg-transparent-purple">Documentation</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 0%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>07 Jan 2025</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-01.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                                    <span class="badge badge-soft-info">Design</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 0%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>07 Jan 2025</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-01.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#add-task">Add Task</a>
                        </div>
                        <!-- End Todo -->

                        <!-- Start On Hold -->
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-semibold d-flex align-items-center mb-0">On Hold<span class="badge bg-dark ms-2 rounded-circle flex-shrink-0">3</span> </h6>
                                <a href="javascript:void(0);" class="bg-light p-2 rounded-circle d-flex align-items-center justify-content-center"><i class="ti ti-plus" data-bs-toggle="modal" data-bs-target="#add-task"></i></a>
                            </div>
                            <div class="kanban-drag-wrap">
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                                    <span class="badge badge-soft-info bg-pink-transparent">Design</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-danger" style="width: 20%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>07 Jan 2025</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-12.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                                    <span class="badge badge-soft-info bg-pink-transparent">Design</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 60%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>07 Jan 2025</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-01.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="#" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#add-task">Add Task</a>
                        </div>
                        <!-- End On Hold -->

                        <!-- Start In Progress -->
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-semibold d-flex align-items-center mb-0">In Progress<span class="badge bg-dark ms-2 rounded-circle flex-shrink-0">2</span> </h6>
                                <a href="javascript:void(0);" class="bg-light p-2 rounded-circle d-flex align-items-center justify-content-center"><i class="ti ti-plus" data-bs-toggle="modal" data-bs-target="#add-task"></i></a>
                            </div>
                            <div class="kanban-drag-wrap">
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                                    <span class="badge badge-soft-info bg-pink-transparent">Design</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-warning" style="width: 30%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>Today</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-08.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                                    <span class="badge badge-soft-info bg-pink-transparent">Design</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-pink" style="width: 70%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>Today</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-09.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                                    <span class="badge badge-soft-info bg-pink-transparent">Design</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar" style="width: 60%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>Tomorrow</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-03.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#add-task">Add Task</a>
                        </div>
                        <!-- End In Progress -->

                        <!-- Start Done -->
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-semibold d-flex align-items-center mb-0">Done<span class="badge bg-dark ms-2 rounded-circle px-2 flex-shrink-0">1</span> </h6>
                                <a href="javascript:void(0);" class="bg-light p-2 rounded-circle d-flex align-items-center justify-content-center"><i class="ti ti-plus" data-bs-toggle="modal" data-bs-target="#add-task"></i></a>
                            </div>
                            <div class="kanban-drag-wrap">
                                <div>
                                    <div class="card mb-3 kanban-card">
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                                    <span class="badge badge-soft-info bg-pink-transparent">Design</span>
                                                    <div>
                                                        <a data-bs-toggle="dropdown" href="javascript:void(0);" >
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit-task">
                                                                    <i class="ti ti-edit me-2"></i>Edit Task
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="ti ti-trash me-2"></i>Delete Task
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6 class="mb-1">Task Management</h6>
                                                <p class="fs-13">Create, assign, track, and manage tasks with deadlines.</p>
                                            </div>
                                            <div class="progress progress-sm mb-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-success" style="width: 100%"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                <p class="d-flex align-items-center mb-0"><i class="ti ti-flag text-danger me-1"></i>02 Jan 2025</p>
                                                <a href="javascript:void(0);" class="avatar avatar-sm">
                                                    <img src="assets/img/users/user-09.jpg" alt="img" class="rounded-circle">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#add-task">Add Task</a>
                        </div>
                        <!-- End Done -->

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