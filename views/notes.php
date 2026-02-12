    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Notes</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Applications</a></li>                              
                        <li class="breadcrumb-item active" aria-current="page">Notes</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="card shadow-none mb-0">
                <div class="card-body p-0">

                    <div class="row g-0">
                        <div class="col-lg-3 col-md-4 d-flex">
                            <div class="p-4 flex-fill">
                                <div>
                                    <div class="mb-3">
                                        <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add_note"><i class="ti ti-square-rounded-plus me-2"></i>Add Task</a>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="nav flex-column nav-pills">
                                            <a href="#" class="d-flex text-start align-items-center fw-medium fs-14 bg-light rounded p-2 mb-1"><i class="ti ti-inbox me-2"></i>All Notes <span class="avatar avatar-xs ms-auto bg-danger rounded-circle">6</span></a>
                                            <a href="#" class="d-flex text-start align-items-center fw-medium fs-14 rounded p-2 mb-1"><i class="ti ti-star me-2"></i>Starred</a>
                                            <a href="#" class="d-flex text-start align-items-center fw-medium fs-14 rounded p-2 mb-0"><i class="ti ti-trash me-2"></i>Trash</a>
                                            <a href="#" class="d-flex text-start align-items-center fw-medium fs-14 rounded p-2 mb-0"><i class="ti ti-files me-2"></i>Draft</a>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-flush custom-accordion" id="accordionFlushExample">
                            
                                        <!-- item -->
                                        <div class="accordion-item bg">
                                            <h2 class="accordion-header mb-0">
                                                <button class="accordion-button fw-semibold p-0 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Labels
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                                <div class="d-flex flex-column mt-3">
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium mb-2"><i class="ti ti-point-filled text-success me-1 fs-18"></i>Low</a>
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium mb-2"><i class="ti ti-point-filled text-warning me-1 fs-18"></i>Medium</a>
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium"><i class="ti ti-point-filled text-danger fs-18 me-1"></i>High</a>
                                                </div>
                                            </div>
                                        </div>                                                                  
                                    </div>

                                </div><!-- end card body -->
                            </div><!-- end card -->  
                        </div>
                        <div class="col-lg-9 col-md-8 d-flex">
                            <div class="p-4 pt-0 pt-md-4 pb-0 w-100 custom-left-border">
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-success">Low</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Meeting with Product Team</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">Discuss dashboard revamp and analytics tracking.</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-01.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-success">Low</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Submit Quarterly Report</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">Compile a comprehensive report for covering sales performance.

                                                    </p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star-filled text-warning"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-02.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-purple">Medium</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Follow-up with HR</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap"> Review and verify the current onboarding status of all hires.

                                                    </p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star-filled text-warning"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-03.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-purple">Medium</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Design Feedback Notes</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">Adjust the form layout to reduce vertical and horizontal spacing</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star-filled text-warning"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-04.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-danger">High</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Call Vendor Support</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">The printer maintenance issue is still pending requires attention.</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-05.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-success">Low</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Give me the staff guide</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">The patient contacted us to request a rescheduling.</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-06.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-danger">High</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Insurance Update</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">We have received the updated insurance card from the patient.</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star-filled text-warning"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-07.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-purple">Medium</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Staff Reminder</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">A reminder was sent to the team regarding the scheduled meeting</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star-filled text-warning"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-08.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-danger">High</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">General Task Tracking</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">Printer cartridges and paper stock have been ordered.</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-09.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-success">Low</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Insurance Inquiry</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">Patient called to check status of last insurance claim for lab tests.</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/profiles/avatar-10.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-danger">High</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Maintenance Request</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">Noted recurring jam in front desk printer. Called vendor support.</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/users/user-03.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                    <div class="col-xl-4 col-md-6 d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="badge bg-purple">Medium</span>
                                                    <div>
                                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                            <i class="ti ti-dots-vertical fs-14 text-muted" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_note"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center"><i class="ti ti-star me-1"></i>Not Important</a>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#view-note"><i class="ti ti-eye me-1"></i>View</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="my-3">
                                                    <h6 class="fs-16 text-truncate mb-1"><a href="javascript:void(0);">Internal Task</a></h6>
                                                    <p class="text-truncate line-clamb-2 text-wrap">Ordered toner, copy paper, and cleaning supplies.</p>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light">
                                                            <i class="ti ti-star"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                    <a href="javascript:void(0);" class="avatar avatar-sm">
                                                        <img src="./assets/img/users/user-02.jpg" alt="Profile" class="img-fluid">
                                                    </a>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                    </div> <!-- end col -->

                                </div>
                            </div>
                            <!-- card start -->
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->

        </div>
        <!-- End Content --> 

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->