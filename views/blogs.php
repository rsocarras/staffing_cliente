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
                            <h4 class="fs-20 fw-bold mb-0">Edit Time</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Edit Time</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

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
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_blog"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- start row -->
                    <div class="row">

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-1.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Efficiency</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">15 Dec 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">Boost Productivity with Time Tracking</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">3000</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">454</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">102</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">350</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-2.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Time Management</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">05 Dec 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">Time Management Made Easy</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">2540</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">300</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">102</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">140</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-3.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Productivity</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">02 Sep 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">How Time Tracking Improves Focus</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">3276</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">310</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">276</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">258</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3 w-100">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-4.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Time Management</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">27 Nov 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">Track Your Time, Reduce Burnout</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">2130</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">395</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">274</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">417</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3 w-100">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-5.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Efficiency</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">22 Nov 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">Time Audits for Smarter Budgeting</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">3163</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">486</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">363</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">482</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3 w-100">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-6.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Time Management</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">12 Nov 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">Time Management for Collaboration</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">2748</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">315</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">153</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">274</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3 w-100">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-7.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Productivity</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">30 Oct 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">How to Track Billable Hours Right</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">2645</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">274</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">158</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">230</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3 w-100">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-8.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Time Management</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">25 Oct 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">Get Paid Fairly with Time Tracking</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">2538</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">317</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">286</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">374</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-4 col-md-6 d-flex">
                            <div class="card flex-fill">
                                <div class="card-body">
                                    <div class="card-image position-relative mb-3 w-100">
                                        <a href="blog-detail"><img class="rounded-1 w-100" src="assets/img/blog/blog-9.jpg" alt="img"></a>
                                        <div class="position-absolute start-0 end-0 top-0 d-flex align-items-center justify-content-between p-2">
                                            <span class="badge badge-soft-primary p-1">Efficiency</span>
                                            <span class="badge bg-success p-1">Active</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="d-flex position-relative align-items-center">
                                                <i class="ti ti-calendar text-dark me-1"></i>
                                                <p class="mb-0">11 Oct 2025</p>
                                            </div>
                                            <div class="d-flex position-relative align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-xs avatar-rounded flex-shrink-0 me-1">
                                                    <img src="assets/img/users/user-10.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <p class="mb-0"><a href="javascript:void(0);" class="text-gray-5">Gertrude Bowie</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_blog"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_blog"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-medium mb-3"><a href="blog-detail">Time Tracking for Better Workflow</a></h5>
                                    <div class="border-top pt-3 like-share">
                                        <ul class="d-flex align-items-center justify-content-between text-center mb-0">
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">2784</h6>
                                                    <span class="fs-13">Likes</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">273</h6>
                                                    <span class="fs-13">Comments</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">414</h6>
                                                    <span class="fs-13">Share</span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="me-3">
                                                    <h6 class="fw-medium fs-16 mb-0">256</h6>
                                                    <span class="fs-13">Views</span>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div> <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                    
                    <div class="text-center">
                        <a href="javascript:void(0);" class="btn btn-dark"><i class="ti ti-loader me-1"></i>Load More</a>
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
