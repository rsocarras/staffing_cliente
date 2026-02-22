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
                            <h4 class="fs-20 fw-bold mb-0">Leave</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Leave</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="leave" class="nav-link active">
                                <span class="d-md-inline-block">Requested</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="leave-approved" class="nav-link">
                                <span class="d-md-inline-block">Approved</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="leave-rejected" class="nav-link">
                                <span class="d-md-inline-block">Rejected</span>
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
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_leave"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- start table -->
                    <div class="table-responsive">
                        <table class="table table-nowrap bg-white border mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Duration</th>
                                    <th>Reason</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Shaun Farley</a></h6>
                                                <p class="fs-13 mb-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Casual Leave</td>
                                    <td>15 May 2025</td>
                                    <td>15 May 2025</td>
                                    <td>1 Day</td>
                                    <td><a href="javascript:void(0);" class="link-reset fs-20 p-1" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text"></i></a></td>
                                    <td>
                                        <div class="d-inline-flex gap-2">
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16" data-bs-toggle="modal" data-bs-target="#leave-accept-modal"><i class="ti ti-check"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-danger fs-16" data-bs-toggle="modal" data-bs-target="#leave-reject-modal"><i class="ti ti-x"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Jenny Ellis</a></h6>
                                                <p class="fs-13 mb-0">PHP Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Sick Leave</td>
                                    <td>13 May 2025</td>
                                    <td>13 May 2025</td>
                                    <td>1st Half</td>
                                    <td><a href="javascript:void(0);" class="link-reset fs-20 p-1" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text"></i></a></td>
                                    <td>
                                        <div class="d-inline-flex gap-2">
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16" data-bs-toggle="modal" data-bs-target="#leave-accept-modal"><i class="ti ti-check"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-danger fs-16" data-bs-toggle="modal" data-bs-target="#leave-reject-modal"><i class="ti ti-x"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Leon Baxter</a></h6>
                                                <p class="fs-13 mb-0">Senior Manager</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Maternity</td>
                                    <td>11 May 2025</td>
                                    <td>11 Jul 2025</td>
                                    <td>2 Months</td>
                                    <td><a href="javascript:void(0);" class="link-reset fs-20 p-1" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text"></i></a></td>
                                    <td>
                                        <div class="d-inline-flex gap-2">
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16" data-bs-toggle="modal" data-bs-target="#leave-accept-modal"><i class="ti ti-check"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-danger fs-16" data-bs-toggle="modal" data-bs-target="#leave-reject-modal"><i class="ti ti-x"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Karen Flores</a></h6>
                                                <p class="fs-13 mb-0">SEO Analyst</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Annual Leave</td>
                                    <td>26 Apr 2025</td>
                                    <td>28 Apr 2025</td>
                                    <td>3 Days</td>
                                    <td><a href="javascript:void(0);" class="link-reset fs-20 p-1" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text"></i></a></td>
                                    <td>
                                        <div class="d-inline-flex gap-2">
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16" data-bs-toggle="modal" data-bs-target="#leave-accept-modal"><i class="ti ti-check"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-danger fs-16" data-bs-toggle="modal" data-bs-target="#leave-reject-modal"><i class="ti ti-x"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Charles Cline</a></h6>
                                                <p class="fs-13 mb-0">HR Assistant</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Permission</td>
                                    <td>24 Apr 2025</td>
                                    <td>24 Apr 2025</td>
                                    <td>02:00 Hours</td>
                                    <td><a href="javascript:void(0);" class="link-reset fs-20 p-1" data-bs-toggle="modal" data-bs-target="#view-request"><i class="ti ti-file-text"></i></a></td>
                                    <td>
                                        <div class="d-inline-flex gap-2">
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-primary fs-16" data-bs-toggle="modal" data-bs-target="#leave-accept-modal"><i class="ti ti-check"></i></a>
                                            <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-outline-light rounded-pill text-danger fs-16" data-bs-toggle="modal" data-bs-target="#leave-reject-modal"><i class="ti ti-x"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end table -->

                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->