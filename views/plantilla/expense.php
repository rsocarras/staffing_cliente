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
                            <h4 class="fs-20 fw-bold mb-0">Expense</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Expense</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="expense-requested" class="nav-link">
                                <span class="d-md-inline-block">Requested</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="expense" class="nav-link active">
                                <span class="d-md-inline-block">Expense</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="expense-approved" class="nav-link">
                                <span class="d-md-inline-block">Approved</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="expense-rejected" class="nav-link">
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
                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_expense"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox" id="select-all">
                                        </div>
                                    </th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Entry Date</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th>Project</th>
                                    <th>Billable</th>
                                    <th>Reimburse</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-md">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4521</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Flight Travel</a>
                                        <span class="d-block fs-13">Category : Travel</span>
                                    </td>
                                    <td>15 May 2025</td>
                                    <td>USD</td>
                                    <td>5000</td>
                                    <td><a class="fw-medium" href="project-details">Doccure</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4533</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Auto Rental</a>
                                        <span class="d-block fs-13">Category : Travel</span>
                                    </td>
                                    <td>13 May 2025</td>
                                    <td>Euro</td>
                                    <td>1459</td>
                                    <td><a class="fw-medium" href="project-details">Tour & Travel</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="ti ti-archive me-2"></i>Restore Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4542</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Entertainment</a>
                                        <span class="d-block fs-13">Category : Advertising</span>
                                    </td>
                                    <td>11 May 2025</td>
                                    <td>Dhirams</td>
                                    <td>6589</td>
                                    <td><a class="fw-medium" href="project-details">CSPSC</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4567</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Food</a>
                                        <span class="d-block fs-13">Category : Travel</span>
                                    </td>
                                    <td>26 Apr 2025</td>
                                    <td>Euro</td>
                                    <td>4754</td>
                                    <td><a class="fw-medium" href="project-details">Law Maker</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4531</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Car Booking</a>
                                        <span class="d-block fs-13">Category : Advertising</span>
                                    </td>
                                    <td>24 Apr 2025</td>
                                    <td>Dhirams</td>
                                    <td>2145</td>
                                    <td><a class="fw-medium" href="project-details">Service Marketplace</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4524</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Entertainment</a>
                                        <span class="d-block fs-13">Category : Advertising</span>
                                    </td>
                                    <td>20 Apr 2025</td>
                                    <td>Euro</td>
                                    <td>6589</td>
                                    <td><a class="fw-medium" href="project-details">Chat App</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4547</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Car Booking</a>
                                        <span class="d-block fs-13">Category : Advertising</span>
                                    </td>
                                    <td>23 Mar 2025</td>
                                    <td>USD</td>
                                    <td>1458</td>
                                    <td><a class="fw-medium" href="project-details">Booking Management</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4575</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Auto Rental</a>
                                        <span class="d-block fs-13">Category : Office supplies</span>
                                    </td>
                                    <td>15 Mar 2025</td>
                                    <td>USD</td>
                                    <td>3658</td>
                                    <td><a class="fw-medium" href="project-details">Pilot Rider</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4545</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Others</a>
                                        <span class="d-block fs-13">Category : Office supplies</span>
                                    </td>
                                    <td>21 Feb 2025</td>
                                    <td>USD</td>
                                    <td>4785</td>
                                    <td><a class="fw-medium" href="project-details">Entry Management</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#expense-details">#EP4514</a></td>
                                    <td>
                                        <a href="#" class="fw-medium">Food</a>
                                        <span class="d-block fs-13">Category : Utilities</span>
                                    </td>
                                    <td>16 Feb 2025</td>
                                    <td>USD</td>
                                    <td>3659</td>
                                    <td><a class="fw-medium" href="project-details">Booking App Mobile</a></td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" checked>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </td>
                                    <td>
                                        <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                            <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#expense-details"><i class="ti ti-eye me-2"></i>View Details</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-expense"><i class="ti ti-edit me-2"></i>Edit Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-copy me-2"></i>Clone Expense</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-archive me-2"></i>Archive Expense</a>
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
