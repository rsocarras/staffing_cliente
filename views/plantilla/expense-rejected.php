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
                            <a href="expense" class="nav-link">
                                <span class="d-md-inline-block">Expense</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="expense-approved" class="nav-link">
                                <span class="d-md-inline-block">Approved</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="expense-rejected" class="nav-link active">
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
                                    <th>Name</th>
                                    <th>Entry Date</th>
                                    <th>Submitted Date</th>
                                    <th>Project</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a class="fw-medium" href="javascript:void(0);">Flight Travel</a>
                                        <span class="d-block fs-13">Category : Travel</span>
                                    </td>
                                    <td>15 May 2025</td>
                                    <td>15 May 2025</td>
                                    <td><a href="javascript:void(0);">Doccure</a></td>
                                    <td>USD</td>
                                    <td>5000</td>
                                    <td>
                                        <a class="reason-icon" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view-reject"><i class="ti ti-file-text"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="fw-medium" href="javascript:void(0);">Auto Rental</a>
                                        <span class="d-block fs-13">Category : Advertising</span>
                                    </td>
                                    <td>13 May 2025</td>
                                    <td>13 May 2025</td>
                                    <td><a href="javascript:void(0);">Tour & Travel</a></td>
                                    <td>Euro</td>
                                    <td>1459</td>
                                    <td>
                                        <a class="reason-icon" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view-reject"><i class="ti ti-file-text"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="fw-medium" href="javascript:void(0);">Entertainment</a>
                                        <span class="d-block fs-13">Category : Advertising</span>
                                    </td>
                                    <td>11 May 2025</td>
                                    <td>11 May 2025</td>
                                    <td><a href="javascript:void(0);">CSPSC</a></td>
                                    <td>Dhirams</td>
                                    <td>6589</td>
                                    <td>
                                        <a class="reason-icon" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view-reject"><i class="ti ti-file-text"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="fw-medium" href="javascript:void(0);">Food</a>
                                        <span class="d-block fs-13">Category : Utilities</span>
                                    </td>
                                    <td>26 Apr 2025</td>
                                    <td>26 Apr 2025</td>
                                    <td><a href="javascript:void(0);">Law Maker</a></td>
                                    <td>Euro</td>
                                    <td>4754</td>
                                    <td>
                                        <a class="reason-icon" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view-reject"><i class="ti ti-file-text"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a class="fw-medium" href="javascript:void(0);">Others</a>
                                        <span class="d-block fs-13">Category : Utilities</span>
                                    </td>
                                    <td>16 Feb 2025</td>
                                    <td>16 Feb 2025</td>
                                    <td><a href="javascript:void(0);">Booking App Mobile</a></td>
                                    <td>USD</td>
                                    <td>3659</td>
                                    <td>
                                        <a class="reason-icon" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#view-reject"><i class="ti ti-file-text"></i></a>
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
