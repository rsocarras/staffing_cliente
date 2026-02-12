    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Invoices</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Applications</a></li>                              
                        <li class="breadcrumb-item active" aria-current="page">Invoices</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <!-- start row -->
            <div class="row">

                <div class="col-xl-3 col-sm-6">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between overflow-hidden border-bottom mb-3 pb-3">
                                <div>
                                    <p class="mb-1 text-truncate">Total Invoice</p>
                                    <h3 class="mb-0">$2,45,445</h3>
                                </div>
                                <span class="avatar bg-soft-primary rounded-circle">
                                    <i class="ti ti-components fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-13 text-truncate mb-0"><span class="text-success fw-medium me-1">+31%</span>Last month</p>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-sm-6">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between overflow-hidden border-bottom mb-3 pb-3">
                                <div>
                                    <p class="mb-1 text-truncate">Unpaid Invoice</p>
                                    <h3 class="mb-0">$50,000</h3>
                                </div>
                                <span class="avatar bg-soft-danger rounded-circle">
                                    <i class="ti ti-clipboard-text fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-13 text-truncate mb-0"><span class="text-danger fw-medium me-1">-15%</span>Last month</p>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xl-3 col-sm-6">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between overflow-hidden border-bottom mb-3 pb-3">
                                <div>
                                    <p class="mb-1 text-truncate">Pending Invoice</p>
                                    <h3 class="mb-0">$45,000</h3>
                                </div>
                                <span class="avatar bg-soft-info rounded-circle">
                                    <i class="ti ti-cards fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-13 text-truncate mb-0"><span class="text-success fw-medium me-1">+48%</span>Last month</p>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xl-3 col-sm-6">
                    <div class="card flex-fill">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between overflow-hidden border-bottom mb-3 pb-3">
                                <div>
                                    <p class="mb-1 text-truncate">Overdue Invoice</p>
                                    <h3 class="mb-0">$2,50,550</h3>
                                </div>
                                <span class="avatar bg-soft-orange rounded-circle">
                                    <i class="ti ti-calendar-event fs-18"></i>
                                </span>
                            </div>
                            <div>
                                <p class="fs-13 text-truncate mb-0"><span class="text-success fw-medium me-1">+39%</span>Last month</p>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->

            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-3 mb-3">
                <h5 class="d-flex align-items-center mb-0">Invoices</h5>
                <div class="d-flex align-items-center flex-wrap row-gap-3">
                    <a href="add-invoice" class="btn btn-sm btn-primary"><i class="ti ti-circle-plus me-1"></i>Create Invoices</a>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table border bg-white table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Created On</th>
                            <th>Total</th>
                            <th>Amount Due</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-1453</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-01.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Anthony Lewis</a></h6>
                                        <span class="fs-13">anthony@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>14 Jan 2024, 04:27 AM </td>
                            <td>$300</td>
                            <td>$0</td>
                            <td>14 Jan 2024, 04:27 AM</td>
                            <td>
                                <span class="badge badge-soft-success">
                                Paid
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-6571</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-09.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Brian Villalobos</a></h6>
                                        <span class="fs-13">brian@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>21 Jan 2024, 03:19 AM</td>
                            <td>$547</td>
                            <td>$200</td>
                            <td>21 Jan 2024, 03:19 AM</td>
                            <td>
                                <span class="badge badge-soft-danger">
                                Overdue
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-2245</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-01.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Harvey Smith</a></h6>
                                        <span class="fs-13">harvey@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>20 Feb 2024, 12:15 PM</td>
                            <td>$325</td>
                            <td>$65</td>
                            <td>20 Feb 2024, 12:15 PM</td>
                            <td>
                                <span class="badge badge-soft-primary">
                                Pending
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-1456</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-02.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Stephan Peralt</a></h6>
                                        <span class="fs-13">peral@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>15 Mar 2024, 12:11 AM</td>
                            <td>$471</td>
                            <td>$145</td>
                            <td>15 Mar 2024, 12:11 AM</td>
                            <td>
                                <span class="badge badge-soft-primary">
                                Pending
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-0045</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-03.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Doglas Martini</a></h6>
                                        <span class="fs-13">martniwr@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>12 Apr 2024, 05:48 PM</td>
                            <td>$147</td>
                            <td>$32</td>
                            <td>12 Apr 2024, 05:48 PM</td>
                            <td>
                                <span class="badge badge-soft-danger">
                                Overdue
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-6244</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-02.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Linda Ray</a></h6>
                                        <span class="fs-13">ray456@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>20 Apr 2024, 06:11 PM</td>
                            <td>$654</td>
                            <td>$140</td>
                            <td>20 Apr 2024, 06:11 PM</td>
                            <td>
                                <span class="badge badge-soft-warning">
                                Draft
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-9565</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-06.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Elliot Murray</a></h6>
                                        <span class="fs-13">murray@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>14 Jan 2024, 04:27 AM </td>
                            <td>$300</td>
                            <td>$0</td>
                            <td>14 Jan 2024, 04:27 AM</td>
                            <td>
                                <span class="badge badge-soft-success">
                                Paid
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-6874</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-07.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Rebecca Smtih</a></h6>
                                        <span class="fs-13">smtih@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>02 Sep 2024, 09:21 PM</td>
                            <td>$654</td>
                            <td>$65</td>
                            <td>02 Sep 2024, 09:21 PM</td>
                            <td>
                                <span class="badge badge-soft-success">
                                Paid
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-1454</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-08.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Anthony Lewis</a></h6>
                                        <span class="fs-13">anthony@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>14 Jan 2024, 04:27 AM </td>
                            <td>$300</td>
                            <td>$0</td>
                            <td>14 Jan 2024, 04:27 AM</td>
                            <td>
                                <span class="badge badge-soft-warning">
                                Draft
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-6587</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-09.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Connie Waters</a></h6>
                                        <span class="fs-13">connie@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>15 Nov 2024, 12:44 PM</td>
                            <td>$987</td>
                            <td>$47</td>
                            <td>15 Nov 2024, 12:44 PM</td>
                            <td>
                                <span class="badge badge-soft-primary">
                                    Pending
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="invoice-details" class="tb-data">INV-5879</a>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="invoice-details" class="avatar me-2">
                                        <img src="assets/img/users/user-10.jpg" class="rounded-circle" alt="user">
                                    </a>
                                    <div>
                                        <h6 class="fw-medium mb-0 fs-14"><a href="invoice-details">Lori Broaddus</a></h6>
                                        <span class="fs-13">broaddus@example.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>10 Dec 2024, 11:23 PM</td>
                            <td>$365</td>
                            <td>$21</td>
                            <td>10 Dec 2024, 11:23 PM</td>
                            <td>
                                <span class="badge badge-soft-danger">
                                Overdue
                                </span>
                            </td>
                            <td>
                                <div>
                                    <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                        <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a href="invoice-details" class="dropdown-item"><i class="ti ti-eye me-2"></i>View</a>
                                        </li>
                                        <li>
                                            <a href="edit-invoice" class="dropdown-item"><i class="ti ti-edit me-2"></i>Edit</a>
                                        </li>
                                        <li>
                                            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>                    
                    </tbody>
                </table>
            </div> <!-- end table responsive -->
                            
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->