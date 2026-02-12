    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="card mb-0">
                <div class="card-body">
                    <!-- Page Header -->
                    <div class="d-flex align-items-center flex-row gap-2 mb-4">
                        <div class="flex-grow-1">
                            <h4 class="fs-20 fw-semibold mb-0 d-flex align-items-center gap-2"><a href="javascript:void(0);" class="settings-collapse-bar d-flex align-items-center text-body" aria-label="Settings"><i class="ti ti-menu-4 fs-24"></i></a>Settings</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Settings</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="settings-wrapper d-flex">

                                <?= $this->render('layouts/partials/settings-sidebar') ?>

                                <div class="card flex-fill mb-0 bg-soft-light border shadow-none">
                                    <div class="card-body">

                                        <!-- start tab -->
                                        <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                                            <li class="nav-item">
                                                <a href="leave-types-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Leave Types</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="shift-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Shift</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="working-hours-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Working Hours</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="tracker-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Tracker Settings</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="productivity-ratings-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Productivity Ratings</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->

                                        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
                                            <h6 class="mb-0 ">Leave Type</h6>
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="leave-types" class="btn btn-dark"><i class="ti ti-polygon me-1"></i>Leave type</a>
                                                <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-leave"><i class="ti ti-plus me-1"></i>Add New</a>
                                            </div>
                                        </div>

                                        <!-- start table -->
                                        <div class="table-responsive">
                                            <table class="table table-nowrap bg-white border mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Leave Type</th>
                                                        <th>Created Date</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Casual Leave</td>
                                                        <td>25 Nov 2025</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_leave_type"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Sick Leave</td>
                                                        <td>24 Sep 2025</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_leave_type"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Maternity</td>
                                                        <td>21 Jul 2025</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_leave_type"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Paternity</td>
                                                        <td>15 Mar 2025</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_leave_type"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Annual Leave</td>
                                                        <td>16 Feb 2025</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_leave_type"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Permission</td>
                                                        <td>18 Feb 2025</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_leave_type"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table -->
                                        
                                    </div> <!-- end card body -->
                                </div> <!-- end card -->
                            </div>
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->