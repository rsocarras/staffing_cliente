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

                                        <!-- start tab -->
                                        <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                                            <li class="nav-item">
                                                <a href="localization-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Localization</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="custom-fields-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Custom Fields</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="preference-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Preference</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="appearance-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Appearance</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="notifications-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Notifications</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="integrations-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Integrations</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->

                                        <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-4">
                                            <h5 class="fw-bold mb-0">Custom Fields</h5>
                                            <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#add_custom_field"><i class="ti ti-plus me-1"></i>Add New</a>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-nowrap bg-white border mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Module</th>
                                                        <th>Label</th>
                                                        <th>Type</th>
                                                        <th>Default Value</th>
                                                        <th>Required</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Members</td>
                                                        <td>Member Type</td>
                                                        <td>Select</td>
                                                        <td>Full Time</td>
                                                        <td>Required</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <div>
                                                                <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                    <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_custom_field"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Projects</td>
                                                        <td>Project Type</td>
                                                        <td>Select</td>
                                                        <td>Internal</td>
                                                        <td>Required</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <div>
                                                                <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                    <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_custom_field"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-medium text-dark">Teams</td>
                                                        <td>Communication</td>
                                                        <td>Select</td>
                                                        <td>Gmail</td>
                                                        <td>Required</td>
                                                        <td><span class="badge badge-soft-success">Active</span></td>
                                                        <td>
                                                            <div>
                                                                <button class="dropdown-toggle drop-arrow-none btn-icon btn-sm btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Actions">
                                                                    <i class="ti ti-dots-vertical fs-16 text-dark" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right">
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit_custom_field"><i class="ti ti-edit me-2"></i>Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-2"></i>Delete</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div> <!-- end table responsive -->
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
