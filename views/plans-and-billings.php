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
                            <h4 class="fs-20 fw-semibold mb-0 d-flex align-items-center gap-2"><a href="javascript:void(0);" class="settings-collapse-bar d-flex align-items-center text-body"><i class="ti ti-menu-4 fs-24"></i></a>Settings</h4>
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

                                <div class="card flex-fill mb-0 bg-soft-light shadow-none border">
                                    <div class="card-body">
                                        <h5 class="fw-bold mb-4">Plans & Billings</h5>
                                        <!-- start row -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card shadow-none">
                                                    <div class="card-body">
                                                        <div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                                            <div>
                                                                <p class="mb-1">Current Plan <span class="badge bg-success">Monthly</span></p>
                                                                <h6 class="fw-bold mb-0">Basic Plan</h6>
                                                            </div>
                                                            <p class="text-dark mb-0">Your Trial is Ending On  : 27 Jan 2026</p>
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between flex-wrap">
                                                            <p class="mb-0">Status : <span class="badge badge-soft-purple ms-1">On Trial</span></p>
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upgrade"> <i class="ti ti-crown me-1"></i> Upgrade</button>
                                                        </div>
                                                    </div> <!-- end card body -->
                                                </div> <!-- end card -->
                                            </div> <!-- end col -->

                                            <div class="col-md-12">
                                                <div class="card shadow-none">
                                                    <div class="card-body pb-0">
                                                        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-3">
                                                            <h5 class="mb-0 fs-18">Saved Cards</h5>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_card" class="btn btn-dark btn-sm">Add New</a>
                                                        </div>

                                                        <!-- start row -->
                                                        <div class="row">

                                                            <div class="col-xl-6">
                                                                <div class="card shadow-none bg-light border">
                                                                    <div class="card-body">
                                                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
                                                                            <a href="javascript:void(0);" class="flex-shrink-0">
                                                                                <img src="assets/img/icons/payment-icon-1.svg" class="img-fluid" alt="payment">
                                                                            </a>
                                                                            <div>
                                                                                <h6 class="fw-semibold mb-1 fs-14">Visa •••• 1568</h6>
                                                                                <span class="fs-13">Exp on 12/25</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                                                            <a href="javascript:void(0);" class="btn btn-sm btn-info">Default</a>
                                                                            <div class="d-flex align-items-center">
                                                                                <button class="btn-icon btn-sm border bg-white rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_card"><i class="ti ti-edit text-body"></i></button>
                                                                                <button class="btn-icon btn-sm border bg-white rounded" data-bs-toggle="modal" data-bs-target="#delete_card"><i class="ti ti-trash text-body"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div> <!-- end card body -->
                                                                </div> <!-- end card -->
                                                            </div> <!-- end col -->

                                                            <div class="col-xl-6">
                                                                <div class="card shadow-none bg-light border">
                                                                    <div class="card-body">
                                                                        <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
                                                                            <a href="javascript:void(0);" class="flex-shrink-0">
                                                                                <img src="assets/img/icons/payment-icon-2.svg" class="img-fluid" alt="payment">
                                                                            </a>
                                                                            <div>
                                                                                <h6 class="fw-medium mb-1 fs-14">Mastercard •••• 1279</h6>
                                                                                <span class="fs-13">Exp on 10/25</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                                                            <a href="javascript:void(0);" class="text-primary fw-medium">Set as Default</a>
                                                                            <div class="d-flex align-items-center">
                                                                                <button class="btn-icon btn-sm border bg-white rounded me-2" data-bs-toggle="modal" data-bs-target="#edit_card"><i class="ti ti-edit text-body"></i></button>
                                                                                <button class="btn-icon btn-sm border bg-white rounded" data-bs-toggle="modal" data-bs-target="#delete_card"><i class="ti ti-trash text-body"></i></button>
                                                                            </div>
                                                                        </div>
                                                                    </div> <!-- end card body -->
                                                                </div> <!-- end card -->
                                                            </div> <!-- end col -->

                                                        </div>
                                                        <!-- end row -->

                                                    </div> <!-- end card body -->
                                                </div> <!-- end card -->
                                            </div> <!-- end col -->

                                            <div class="col-md-12">
                                                <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-3">
                                                    <h5 class="text-dark mb-0">Billing Plans</h5>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap bg-white border mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Plan Name</th>
                                                                <th>Amount</th>
                                                                <th>Purchase Date</th>
                                                                <th>End Date</th>
                                                                <th>Status</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="fw-medium text-dark">Business</td>
                                                                <td>$69</td>
                                                                <td>10 Jan 2025</td>
                                                                <td>10 Jan 2026</td>
                                                                <td><span class="badge badge-soft-pink">Inprogress</span></td>
                                                                <td>
                                                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#purchase-details"><i class="ti ti-eye me-2"></i>View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-download me-2"></i>Download</a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-medium text-dark">Basic</td>
                                                                <td>$29</td>
                                                                <td>05 Feb 2025</td>
                                                                <td>05 Feb 2026</td>
                                                                <td><span class="badge badge-soft-success">Completed</span></td>
                                                                <td>
                                                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#purchase-details"><i class="ti ti-eye me-2"></i>View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-download me-2"></i>Download</a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-medium text-dark">Enterprise</td>
                                                                <td>$99</td>
                                                                <td>20 Mar 2025</td>
                                                                <td>20 Mar 2026</td>
                                                                <td><span class="badge badge-soft-success">Completed</span></td>
                                                                <td>
                                                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#purchase-details"><i class="ti ti-eye me-2"></i>View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-download me-2"></i>Download</a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-medium text-dark">Basic</td>
                                                                <td>$29</td>
                                                                <td>15 Apr 2025</td>
                                                                <td>15 Apr 2026</td>
                                                                <td><span class="badge badge-soft-success">Completed</span></td>
                                                                <td>
                                                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#purchase-details"><i class="ti ti-eye me-2"></i>View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-download me-2"></i>Download</a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-medium text-dark">Basic</td>
                                                                <td>$29</td>
                                                                <td>30 May 2025</td>
                                                                <td>30 May 2026</td>
                                                                <td><span class="badge badge-soft-success">Completed</span></td>
                                                                <td>
                                                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#purchase-details"><i class="ti ti-eye me-2"></i>View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-star me-2"></i>Download</a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table responsive -->

                                            </div> <!-- end col -->

                                        </div>
                                        <!-- end row -->

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