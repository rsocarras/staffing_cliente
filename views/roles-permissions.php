    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="card mb-0">
                <div class="card-body">
                    <!-- Page Header -->
                    <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 mb-4">
                        <div class="flex-grow-1">
                            <h4 class="fs-20 fw-bold mb-0">Roles & Permissions</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Roles & Permissions</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Start Filter-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
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
                            <a href="" data-bs-toggle="modal" data-bs-target="#add-role" class="btn btn-primary"><i class="ti ti-plus me-1"></i>Add New</a>
                        </div>
                    </div> <!-- end filter -->

                    <!-- End Filter-->

                    <!-- Start Table-->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Role Name</th>
                                    <th>Created On</th>
                                    <th>No of Users</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><a class="fw-medium" href="javascript:void(0);">Owner</a></td>
                                    <td>11 May 2025, 12:00 PM</td>
                                    <td>01</td>
                                    <td>
                                        <span class="badge badge-soft-success">Active</span>
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-role"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="permissions" class="dropdown-item"><i class="ti ti-shield-plus me-2"></i>Permissions</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_role"><i class="ti ti-trash me-2"></i>Remove Role</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a class="fw-medium" href="javascript:void(0);">Admin</a></td>
                                    <td>11 May 2025, 11:52 AM</td>
                                    <td>02</td>
                                    <td>
                                        <span class="badge badge-soft-success">Active</span>
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-role"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="permissions" class="dropdown-item"><i class="ti ti-shield-plus me-2"></i>Permissions</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_role"><i class="ti ti-trash me-2"></i>Remove Role</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a class="fw-medium" href="javascript:void(0);">Manager</a></td>
                                    <td>11 May 2025, 11:30 AM</td>
                                    <td>01</td>
                                    <td>
                                        <span class="badge badge-soft-success">Active</span>
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-role"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="permissions" class="dropdown-item"><i class="ti ti-shield-plus me-2"></i>Permissions</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_role"><i class="ti ti-trash me-2"></i>Remove Role</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a class="fw-medium" href="javascript:void(0);">User</a></td>
                                    <td>11 May 2025, 11:00 AM</td>
                                    <td>02</td>
                                    <td>
                                        <span class="badge badge-soft-success">Active</span>
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-role"><i class="ti ti-edit me-2"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="permissions" class="dropdown-item"><i class="ti ti-shield-plus me-2"></i>Permissions</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_role"><i class="ti ti-trash me-2"></i>Remove Role</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table-->
                </div>
            </div>
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->