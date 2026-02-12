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
                            <h4 class="mb-0">FAQ</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 table-header mb-4">
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-sort-descending-2 me-1 text-gray-5"></i>Sort By : <span class="ms-1">Newest</span>
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

                        <div class="d-flex align-items-center flex-wrap">
                            <div>
                                <a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-faq"><i class="ti ti-plus me-1"></i>Add New FAQ</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table table-nowrap bg-white border mb-0">
                            <thead>
                                <tr>
                                    <th>Questions</th>
                                    <th>Answers</th>
                                    <th>Category</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">What is a time tracking and management app?</p>
                                    </td>
                                    <td>It tracks and records time spent on tasks or projects to improve productivity</td>
                                    <td>
                                        General
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">How does time tracking improve productivity?</p>
                                    </td>
                                    <td>It helps identify time-wasting activities and optimize task management.</td>
                                    <td>
                                        Productivity
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">Can I track billable hours with this app?</p>
                                    </td>
                                    <td>Yes, the app allows tracking of billable hours for accurate client billing.</td>
                                    <td>
                                        Productivity
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">Is my data secure in the app?</p>
                                    </td>
                                    <td>Yes, data is protected through secure measures and industry standards.</td>
                                    <td>
                                        Security
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">Does the app integrate with other tools?</p>
                                    </td>
                                    <td>Yes, it integrates with project management and payroll software</td>
                                    <td>
                                        Integration
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">How do I set up the app for my team?</p>
                                    </td>
                                    <td>Create user accounts, assign tasks, and customize settings.</td>
                                    <td>
                                        Usage
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">Can I generate reports from tracked time?</p>
                                    </td>
                                    <td>Yes, it provides detailed reports on time usage for analysis.</td>
                                    <td>
                                        Reporting
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">Can the app track overtime?</p>
                                    </td>
                                    <td>Yes, it tracks both regular and overtime hours for accurate payroll.</td>
                                    <td>
                                        Reporting
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">Does it offer automatic time tracking?</p>
                                    </td>
                                    <td>Yes, it can automatically track time based on activity or app usage.</td>
                                    <td>
                                        Usage
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="fw-medium text-dark mb-0">Can I export my time logs?</p>
                                    </td>
                                    <td>Yes, time logs can be exported in formats like Excel or PDF.</td>
                                    <td>
                                        Export
                                    </td>
                                    <td>
                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                            <i class="ti ti-dots-vertical fs-18 text-muted"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#edit-faq"><i class="ti ti-edit me-1"></i>Edit</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#delete-modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table responsive -->

                </div>
            </div>
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
