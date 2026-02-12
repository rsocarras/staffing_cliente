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
                            <h4 class="fs-20 fw-bold mb-0">Users</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>   
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>                                                         
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">                                             
                            <a href="users" class="nav-link d-flex align-items-center"><i class="ti ti-users me-2"></i>Users List</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-archived" class="nav-link d-flex align-items-center"><i class="ti ti-user-x me-2"></i>Archived</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-invite-status" class="nav-link d-flex align-items-center active"><i class="ti ti-user-star me-2"></i>Invite Status</a>
                        </li>
                    </ul>                         
                        
                    <!-- Start Search and Filter -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search">
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
                            <a href="invite-users" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Last Invited On</th>
                                    <th>Level</th>
                                    <th>Total Invites</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-11.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="#">James Evans</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>11 May 2025, 02:50 PM</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-white d-inline-flex align-items-center emp-name" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Level">
                                                User<i class="ti ti-chevron-down ms-2"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        User
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Manager
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Admin
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>02</td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-send me-2"></i>Resend Invite</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_user"><i class="ti ti-trash me-2"></i>Remove User</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-12.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="#">Jenny Ellis</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>11 May 2025, 02:35 PM</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-white d-inline-flex align-items-center emp-name" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Level">
                                                Manager<i class="ti ti-chevron-down ms-2"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        User
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Manager
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Admin
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>01</td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-send me-2"></i>Resend Invite</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_user"><i class="ti ti-trash me-2"></i>Remove User</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-13.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="#">Leon Baxter</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>11 May 2025, 02:20 PM</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-white d-inline-flex align-items-center emp-name" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Level">
                                                Admin<i class="ti ti-chevron-down ms-2"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        User
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Manager
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Admin
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>01</td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-send me-2"></i>Resend Invite</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_user"><i class="ti ti-trash me-2"></i>Remove User</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-14.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="#">Karen Flores</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>11 May 2025, 02:10 PM</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-white d-inline-flex align-items-center emp-name" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Level">
                                                Manager<i class="ti ti-chevron-down ms-2"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        user
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Manager
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Admin
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>01</td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-send me-2"></i>Resend Invite</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_user"><i class="ti ti-trash me-2"></i>Remove User</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-15.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14"><a href="#">Charles Cline</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>11 May 2025, 02:00 PM</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-white d-inline-flex align-items-center emp-name" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Level">
                                                User<i class="ti ti-chevron-down ms-2"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        User
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Manager
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1 d-flex align-items-center">	
                                                        Admin
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>01</td>
                                    <td>
                                        <div>
                                            <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item"><i class="ti ti-send me-2"></i>Resend Invite</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_user"><i class="ti ti-trash me-2"></i>Remove User</a>
                                                </li>
                                            </ul>
                                        </div>
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