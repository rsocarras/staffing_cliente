    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="card mb-0">
                <div class="card-body">
                    <!-- Page Header -->
                    <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 mb-4">
                        <div class="flex-grow-1">
                            <h4 class="fs-20 fw-bold mb-0">Teams</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Teams</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Start Filter-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div> 
                        <div class="d-flex align-items-center flex-wrap gap-3">
                            <div class="p-1 border rounded-2 bg-white d-flex align-items-center justify-content-center gap-1">
                                <a href="teams" class="p-1 rounded-2 d-flex align-items-center justify-content-center active bg-dark text-white"><i class="ti ti-list-tree fs-16"></i></a>
                                <a href="teams-grid" class="p-1 rounded-2 d-flex align-items-center justify-content-center"><i class="ti ti-layout-grid fs-16"></i></a>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="btn btn-outline-light text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ti ti-sort-descending-2 me-1 text-gray-5"></i>Sort By : <span class="ms-1">Newest</span>
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
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_teams"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div> <!-- end filter -->
                    </div>
                    <!-- End Filter-->

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table mb-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Team Name</th>
                                    <th>Team Lead</th>
                                    <th>Members</th>
                                    <th>Performance</th>
                                    <th>Total Worked hours</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- UX Research -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-primary">
                                                <span class="text-primary">UR</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">UX Research</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">John Mitchell</h6>
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
                                    <td><span class="badge bg-success d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-up-right"></i> 97%</span></td>
                                    <td>458h 00m</td>
                                    <td>24 Dec 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-danger">
                                                <span class="text-danger">DO</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">DevOps</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Lisa Thompson</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-04.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-06.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-08.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-up-right"></i> 84%</span></td>
                                    <td>988h 00m</td>
                                    <td>10 Dec 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-warning">
                                                <span class="text-warning">TS</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Testing</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Michael Rodriguez</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-05.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-07.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-09.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-up-right"></i> 64%</span></td>
                                    <td>699h 00m</td>
                                    <td>27 Nov 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-danger">
                                                <span class="text-danger">CC</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Cloud Computing</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Sarah Lee</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-06.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-08.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-purple d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-down-right"></i> 44%</span></td>
                                    <td>36h 00m</td>
                                    <td>27 Nov 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-success">
                                                <span class="text-success">CS</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Cybersecurity</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Natalie Brooks</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-07.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-09.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-11.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-purple d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-down-right"></i> 45%</span></td>
                                    <td>96h 00m</td>
                                    <td>06 Nov 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-warning">
                                                <span class="text-warning">DA</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Data & Analytics</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">David Nguyen</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-08.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-12.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-13.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-down-right"></i> 48%</span></td>
                                    <td>48h 00m</td>
                                    <td>25 Oct 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-warning">
                                                <span class="text-warning">IT</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">IT Support</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Emilen Parker</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-13.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-15.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-purple d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-down-right"></i> 29%</span></td>
                                    <td>99h 00m</td>
                                    <td>14 Oct 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-success">
                                                <span class="text-success">NK</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Networking</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Jason Carter</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-13.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-16.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-18.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-down-right"></i> 35%</span></td>
                                    <td>79h 00m</td>
                                    <td>03 Oct 2025</td>
                                    <td><span class="badge badge-soft-danger">Inactive</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-danger">
                                                <span class="text-danger">MA</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Mobile App</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Amanda Foster</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-list-stacked avatar-group-sm">
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-14.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-18.jpg" alt="img"></span>
                                            <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-20.jpg" alt="img"></span>
                                            <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-purple d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-up-right"></i> 83%</span></td>
                                    <td>88h 00m</td>
                                    <td>20 Sep 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-rounded bg-soft-success">
                                                <span class="text-success">DN</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Design</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <h6 class="fw-medium m-0 fs-14"><a href="javascript:void(0);">Kevin Walker</h6>
                                        </div>
                                    </td>
                                    <td><div class="avatar-list-stacked avatar-group-sm">
                                        <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-19.jpg" alt="img"></span>
                                        <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-24.jpg" alt="img"></span>
                                        <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-26.jpg" alt="img"></span>
                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                    </div></td>
                                    <td><span class="badge bg-success d-inline-flex align-items-center gap-1"><i class="ti ti-arrow-up-right"></i> 93%</span></td>
                                    <td>68h 00m</td>
                                    <td>10 Sep 2025</td>
                                    <td><span class="badge badge-soft-success">Active</span></td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            
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