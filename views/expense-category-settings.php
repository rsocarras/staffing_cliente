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
                                                <a href="expense-category-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Expense Category</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="expense-type-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Expense Type</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="payment-method-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Payment Method</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="currencies-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Currencies</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="taxes-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Taxes</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->

                                        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
                                            <h6 class="mb-0 ">Expense Category</h6>
                                            <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_expense_category"><i class="ti ti-plus me-1"></i>Add New</a>
                                        </div>

                                        <!-- start table -->
                                        <div class="table-responsive">
                                            <table class="table table-nowrap bg-white border mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Depreciation</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_expense_category"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Advertising</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_expense_category"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Maintenance</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_expense_category"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Travel</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_expense_category"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Office supplies</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_expense_category"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Utilities</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_expense_category"><i class="ti ti-edit me-2"></i>Edit</a>
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
