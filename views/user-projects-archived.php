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
                            <h4 class="fs-20 fw-bold mb-0">Projects</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Projects</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="user-projects" class="nav-link">
                                <span class="d-md-inline-block">Active</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-projects-archived" class="nav-link active">
                                <span class="d-md-inline-block">Archived</span>
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
                        <div class="d-flex align-items-center gap-3"> 
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
                        </div>
                    </div>
                    <!-- End Search and Filter -->  

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table table-nowrap border bg-white mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Project Code</th>
                                    <th>Project Name</th>
                                    <th>Client Name</th>
                                    <th>Created Date</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PR23174</td>
                                    <td><a href="javascript:void(0);" class="fw-medium">Office Management</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-21.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);">Brian Thompson</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>15 May 2024</td>
                                    <td>54h 20m </td>
                                </tr>
                                <tr>
                                    <td>PR23173</td>
                                    <td><a href="javascript:void(0);" class="fw-medium">Clinic Management</a></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-13.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);">Jerry Palmer</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>17 May 2024</td>
                                    <td>60h 32m </td>
                                </tr>
                                <tr>
                                    <td>PR23172</td>
                                    <td><a href="javascript:void(0);" class="fw-medium">Educational Platform</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-22.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);">Florence Haith</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>06 Jan 2025</td>
                                    <td>52h 45m</td>
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