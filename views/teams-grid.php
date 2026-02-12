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
                                <a href="teams" class="p-1 rounded-2 d-flex align-items-center justify-content-center"><i class="ti ti-list-tree fs-16"></i></a>
                                <a href="teams-grid" class="p-1 rounded-2 d-flex align-items-center justify-content-center active bg-dark text-white"><i class="ti ti-layout-grid fs-16"></i></a>
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

                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">UI / UX Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-09.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-16.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-01.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-12.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 50:20
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">45:24</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">02:24</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">01:24</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">HTML Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-03.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-06.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-15.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-11.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-02.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 47:20
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">42:34</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">02:30</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">02:24</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">React Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-05.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-08.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-11.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-01.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-04.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 49:40
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">40:14</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">02:50</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">03:15</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">Angular Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-09.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-03.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-15.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-07.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-02.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 52:20
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">51:34</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">03:50</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">01:15</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">Vue Js Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-04.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-13.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-08.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-05.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 51:10
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">40:34</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">01:50</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">02:15</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">PHP Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-06.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-10.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-14.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-09.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 52:23
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">46:54</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">03:20</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">02:45</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">Laravel Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-17.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-11.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 50:29
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">48:34</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">01:30</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">01:45</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">Testing Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-19.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-07.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-16.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-02.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-14.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 51:20
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">48:22</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">02:14</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">02:34</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-start justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-16 fw-bold mb-3"><a href="javascript:void(0);">Tailwind Team</a></h6>
                                                <div class="d-flex align-items-center">
                                                    <span class="me-1">Members :</span>
                                                    <div class="avatar-list-stacked avatar-group-sm">
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-19.jpg" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-rounded">
                                                            <img class="border border-white" src="assets/img/profiles/avatar-11.jpg" alt="img">
                                                        </span>
                                                        <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">
                                                            +1
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_team"><i class="ti ti-edit me-2"></i>Edit</a>
                                                </li>
                                                <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_team"><i class="ti ti-trash me-2"></i>Delete</a>                                            </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center bg-light p-2 fw-medium fs-14 text-dark rounded mb-3">
                                        Total Worked (h) : 52:27
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-primary">
                                                <span class="text-truncate d-block">Productive (h)</span>
                                                <h6 class="fw-semibold my-1">50:12</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-warning">
                                                <span class="text-truncate d-block">Manual (h)</span>
                                                <h6 class="fw-semibold my-1">01:14</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="p-1 border-bottom border-3 border-danger">
                                                <span class="text-truncate d-block">Unproductive</span>
                                                <h6 class="fw-semibold my-1">01:34</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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