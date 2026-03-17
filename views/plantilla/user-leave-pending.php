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
                            <a href="user-leave-approved" class="nav-link">
                                <span class="d-md-inline-block">Approved</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-leave-rejected" class="nav-link">
                                <span class="d-md-inline-block">Rejected</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-leave-pending" class="nav-link active">
                                <span class="d-md-inline-block">Pending</span>
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

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table table-nowrap border bg-white mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Type</th>
                                    <th>Reason</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Duration</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Casual Leave</td>
                                    <td>Going To Hospital</td>
                                    <td>15 May 2024</td>
                                    <td>15 May 2024</td>
                                    <td>1 Day</td>
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#delete_leave">Cancel</a></td>
                                </tr>
                                <tr>
                                    <td>Sick Leave</td>
                                    <td>Fever</td>
                                    <td>15 May 2024</td>
                                    <td>15 May 2024</td>
                                    <td>1st Half</td>
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#delete_leave">Cancel</a></td>
                                </tr>
                                <tr>
                                    <td>Annual Leave</td>
                                    <td>Stomach Pain</td>
                                    <td>15 May 2024</td>
                                    <td>15 May 2024</td>
                                    <td>1 Day</td>
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#delete_leave">Cancel</a></td>
                                </tr>
                                <tr>
                                    <td>Casual Leave</td>
                                    <td>Fever</td>
                                    <td>15 May 2024</td>
                                    <td>15 May 2024</td>
                                    <td>1 Day</td>
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#delete_leave">Cancel</a></td>
                                </tr>
                                <tr>
                                    <td>Sick Leave</td>
                                    <td>Health Issue</td>
                                    <td>15 May 2024</td>
                                    <td>15 May 2024</td>
                                    <td>1 Day</td>
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#delete_leave">Cancel</a></td>
                                </tr>
                                <tr>
                                    <td>Annual Leave</td>
                                    <td>Going To Hospital</td>
                                    <td>15 May 2024</td>
                                    <td>15 May 2024</td>
                                    <td>1 Day</td>
                                    <td><a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#delete_leave">Cancel</a></td>
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