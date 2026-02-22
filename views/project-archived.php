    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <div class="card mb-0">
                <div class="card-body">
                    <!-- Start Page Header -->
                    <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold mb-0">Projects</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Projects</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 d-flex">
                            <div class="card flex-fill shadow-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between overflow-hidden">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md bg-indigo rounded-1 me-2 flex-shrink-0">
                                                <i class="ti ti-user-star text-white fs-24"></i>
                                            </div>
                                            <div>
                                                <span class="fs-13 table-nowrap text-truncate">Projects</span>
                                                <h3 class="fs-20 fw-bold">2520</h3>
                                            </div>
                                        </div>
                                        <div class="chart-set" id="chart-col-11"></div>
                                    </div>
                                </div>  <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-3 col-md-6 d-flex">
                            <div class="card flex-fill shadow-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between overflow-hidden">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md bg-orange rounded-1 me-2 flex-shrink-0">
                                                <i class="ti ti-user-bolt text-white fs-24"></i>
                                            </div>
                                            <div>
                                                <span class="fs-13 table-nowrap">Active</span>
                                                <h3 class="fs-20 fw-bold">2502</h3>
                                            </div>
                                        </div>
                                        <div class="chart-set" id="chart-col-12"></div>
                                    </div>
                                </div>  <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-3 col-md-6 d-flex">
                            <div class="card flex-fill shadow-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between overflow-hidden">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md bg-primary rounded-1 me-2 flex-shrink-0">
                                                <i class="ti ti-user-x text-white fs-24"></i>
                                            </div>
                                            <div>
                                                <span class="fs-13 table-nowrap">InProgress</span>
                                                <h3 class="fs-20 fw-bold">65</h3>
                                            </div>
                                        </div>
                                        <div class="chart-set" id="chart-col-13"></div>
                                    </div>
                                </div>  <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->

                        <div class="col-xl-3 col-md-6 d-flex">
                            <div class="card flex-fill shadow-none">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between overflow-hidden">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-md bg-pink rounded-1 me-2 flex-shrink-0">
                                                <i class="ti ti-user-share text-white fs-24"></i>
                                            </div>
                                            <div>
                                                <span class="fs-13 table-nowrap">Completed</span>
                                                <h3 class="fs-20 fw-bold">15</h3>
                                            </div>
                                        </div>
                                        <div class="chart-set" id="chart-col-14"></div>
                                    </div>
                                </div>  <!-- end card body -->
                            </div> <!-- end card -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <!-- Start Tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">
                            <a href="project" class="nav-link"><i class="ti ti-box fs-16 me-2"></i> Active</a>
                        </li>
                        <li class="nav-item">
                            <a href="project-archived" class="nav-link active"><i class="ti ti-archive fs-16 me-2"></i>Archived</a>
                        </li>
                        <li class="nav-item">
                            <a href="project-completed" class="nav-link"><i class="ti ti-checkbox fs-16 me-2"></i>Completed</a>
                        </li>
                        <li class="nav-item">
                            <a href="project-hold" class="nav-link"><i class="ti ti-hourglass-empty fs-16 me-2"></i>On Hold</a>
                        </li>
                    </ul>
                    <!-- End Tab -->

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
                            <a href="add-project" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Add New</a>
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
                                    <th>Project Code</th>
                                    <th>Name</th>
                                    <th>Project Name</th>
                                    <th>Priority</th>
                                    <th>Spent Time (H)</th>
                                    <th>Created Date</th>
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
                                    <td><a href="project-details">#PRJ0012</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fs-14 fw-medium m-0"><a href="#">Thomas Ward</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="project-details" class="fw-medium">Invoice & Billing Software</a></td>
                                    <td>
                                        <span class="badge badge-soft-info"><i class="ti ti-flag me-1"></i>Low</span>
                                    </td>
                                    <td>43h 32m</td>
                                    <td>20 Sep 2025</td>
                                    <td>
                                        <a class="dropdown-toggle drop-arrow-none" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ti ti-creative-commons-sa fs-18 text-muted"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-refresh me-2 "></i>Restart</a>
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
                                    <td><a href="project-details">#PRJ0016</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fs-14 fw-medium m-0"><a href="#">Charles Cline</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="project-details" class="fw-medium">Travel Planning Website</a></td>
                                    <td>
                                        <span class="badge badge-soft-orange"><i class="ti ti-flag me-1"></i>High</span>
                                    </td>
                                    <td>38h 15m</td>
                                    <td>06 Nov 2025</td>
                                    <td>
                                        <a class="dropdown-toggle drop-arrow-none" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ti ti-creative-commons-sa fs-18 text-muted"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-refresh me-2 "></i>Restart</a>
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
                                    <td><a href="project-details">#PRJ0019</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fs-14 fw-medium m-0"><a href="#">Jenny Ellis</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="project-details" class="fw-medium">Clinic Management</a></td>
                                    <td>
                                        <span class="badge badge-soft-orange"><i class="ti ti-flag me-1"></i>High</span>
                                    </td>
                                    <td>80h 45m</td>
                                    <td>10 Dec 2025</td>
                                    <td>
                                        <a class="dropdown-toggle drop-arrow-none" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ti ti-creative-commons-sa fs-18 text-muted"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-refresh me-2 "></i>Restart</a>
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
                                    <td><a href="project-details">#PRJ0018</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fs-14 fw-medium m-0"><a href="#">Leon Baxter</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="project-details" class="fw-medium">Educational Platform</a></td>
                                    <td>
                                        <span class="badge badge-soft-danger"><i class="ti ti-flag me-1"></i>Medium</span>
                                    </td>
                                    <td>60h 20m</td>
                                    <td>27 Nov 2025</td>
                                    <td>
                                        <a class="dropdown-toggle drop-arrow-none" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ti ti-creative-commons-sa fs-18 text-muted"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-refresh me-2 "></i>Restart</a>
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
                                    <td><a href="project-details">#PRJ0014</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar bg-info online avatar-rounded">
                                                <span class="avatar-title text-white">LH</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fs-14 fw-medium m-0"><a href="#">Leslie Hensley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="project-details" class="fw-medium">Car & Bike Rental Software</a></td>
                                    <td>
                                        <span class="badge badge-soft-info"><i class="ti ti-flag me-1"></i>Low</span>
                                    </td>
                                    <td>62h 40m</td>
                                    <td>14 Oct 2025</td>
                                    <td>
                                        <a class="dropdown-toggle drop-arrow-none" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ti ti-creative-commons-sa fs-18 text-muted"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-refresh me-2 "></i>Restart</a>
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
                                    <td><a href="project-details">#PRJ0020</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fs-14 fw-medium m-0"><a href="#">Shaun Farley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="project-details" class="fw-medium">Office Management</a></td>
                                    <td>
                                        <span class="badge badge-soft-info"><i class="ti ti-flag me-1"></i>Low</span>
                                    </td>
                                    <td>90h 40m</td>
                                    <td>24 Dec 2025</td>
                                    <td>
                                        <a class="dropdown-toggle drop-arrow-none" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ti ti-creative-commons-sa fs-18 text-muted"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-refresh me-2 "></i>Restart</a>
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