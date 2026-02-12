    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">                

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Todo</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Applications</a></li>                              
                        <li class="breadcrumb-item active" aria-current="page">Todo</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->
            
            <div class="card shadow-none mb-0">
                <div class="card-body p-0">

                    <div class="row g-0">
                        <div class="col-lg-3 col-md-4 d-flex">
                            <div class="p-4 flex-fill">
                                <div>
                                    <div class="mb-3">
                                        <a href="#" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#add_todo"><i class="ti ti-square-rounded-plus me-2"></i>Add Task</a>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="nav flex-column nav-pills">
                                            <a href="#" class="d-flex text-start align-items-center fw-medium fs-14 bg-light rounded p-2 mb-1"><i class="ti ti-inbox me-2"></i>All Tasks <span class="avatar avatar-xs ms-auto bg-danger rounded-circle">6</span></a>
                                            <a href="#" class="d-flex text-start align-items-center fw-medium fs-14 rounded p-2 mb-1"><i class="ti ti-star me-2"></i>Starred</a>
                                            <a href="#" class="d-flex text-start align-items-center fw-medium fs-14 rounded p-2 mb-0"><i class="ti ti-trash me-2"></i>Trash</a>
                                        </div>
                                    </div>

                                    <div class="accordion accordion-flush custom-accordion" id="accordionFlushExample">
                            
                                        <!-- item -->
                                        <div class="accordion-item mb-3 pb-3">
                                            <h2 class="accordion-header mb-0">
                                                <button class="accordion-button fw-semibold p-0 bg-transparent collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Priority
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                <div class="d-flex flex-column mt-3">
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium mb-2"><i class="ti ti-point-filled text-success me-1 fs-18"></i>Low</a>
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium mb-2"><i class="ti ti-point-filled text-warning me-1 fs-18"></i>Medium</a>
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium"><i class="ti ti-point-filled text-danger fs-18 me-1"></i>High</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- item -->
                                        <div class="accordion-item border-0">
                                            <h2 class="accordion-header mb-0">
                                                <button class="accordion-button fw-semibold p-0 bg-transparent collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Categories
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                <div class="d-flex flex-column mt-3">
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium mb-2"><i class="ti ti-point-filled text-purple me-1 fs-18"></i>Social</a>
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium mb-2"><i class="ti ti-point-filled text-info me-1 fs-18"></i>Research</a>
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium mb-2"><i class="ti ti-point-filled text-pink me-1 fs-18"></i>Web Design</a>
                                                    <a href="javascript:void(0);" class="d-flex align-items-center fw-medium"><i class="ti ti-point-filled text-danger me-1 fs-18"></i>Reminder</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div><!-- end card body -->
                            </div><!-- end card -->  
                        </div>
                        <div class="col-lg-9 col-md-8  custom-left-border d-flex">
                            <!-- card start -->
                            <div class="card m-md-4 mx-4 w-100">

                                <div class="card-header d-flex align-items-center flex-wrap gap-2 justify-content-between">
                                    <h5 class="d-inline-flex align-items-center mb-0">Todo<span class="badge bg-danger ms-2">565</span></h5>
                                    <div class="d-flex align-items-center">

                                        <!-- sort by -->
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-outline-light d-inline-flex align-items-center" data-bs-toggle="dropdown">
                                            <i class="ti ti-sort-descending-2 me-1"></i><span class="me-1">Sort By : </span>  Newest
                                            </a>
                                            <ul class="dropdown-menu  dropdown-menu-end p-2">
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

                                <div class="card-body table-custom p-0">
                                <!-- table start -->
                                    <div class="table-responsive table-nowrap">
                                        <table class="table border-0 border">
                                            <thead>
                                                <tr>
                                                    <th>Task Title</th>
                                                    <th class="no-sort">Created Date</th>
                                                    <th>Status</th>
                                                    <th>Due Date</th>
                                                    <th>Progress</th>
                                                    <th class="no-sort"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Update calendar and schedule</td>
                                                    <td>20 Jun 2025</td>
                                                    <td><span class="badge bg-info">Inprogress</span></td>
                                                    <td>25 Jun 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='80'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>80%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Finalize project proposal</td>
                                                    <td>15 Jun 2025</td>
                                                    <td><span class="badge bg-pink">On Hold</span></td>
                                                    <td>20 Jun 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='60'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>60%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Submit to supervisor by EOD</td>
                                                    <td>02 Jun 2025</td>
                                                    <td><span class="badge bg-purple">Pending</span></td>
                                                    <td>07 Jun 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='50'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>50%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Prepare presentation slides</td>
                                                    <td>24 May 2025</td>
                                                    <td><span class="badge bg-success">Completed</span></td>
                                                    <td>30 May 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='100'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>100%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Check and respond to emails</td>
                                                    <td>18 May 2025</td>
                                                    <td><span class="badge bg-purple">Pending</span></td>
                                                    <td>07 Jun 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='55'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>55%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Daily admin tasks organized</td>
                                                    <td>13 May 2025</td>
                                                    <td><span class="badge bg-info">Inprogress</span></td>
                                                    <td>18 May 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='80'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>80%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Verify insurance eligibility</td>
                                                    <td>25 Apr 2025</td>
                                                    <td><span class="badge bg-success">Completed</span></td>
                                                    <td>27 Apr 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='70'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>70%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Send lab results to patient portal</td>
                                                    <td>17 Apr 2025</td>
                                                    <td><span class="badge bg-purple">Pending</span></td>
                                                    <td>27 Apr 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='50'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>50%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Keep tasks clear and specific</td>
                                                    <td>01 Mar 2025</td>
                                                    <td><span class="badge bg-success">Completed</span></td>
                                                    <td>05 Mar 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='100'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>100%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Use reminders for anything time</td>
                                                    <td>21 Mar 2025</td>
                                                    <td><span class="badge bg-info">Inprogress</span></td>
                                                    <td>25 Mar 2025</td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="circle-progress"  data-value='40'>
                                                                <span class="progress-left">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                                <span class="progress-right">
                                                                    <span class="progress-bar border-warning"></span>
                                                                </span>
                                                            </div>
                                                            <div>40%</div>
                                                        </div>
                                                    </td>      
                                                    <td class="text-end">
                                                        <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                                            <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                                                        </button>
                                                        <ul class="dropdown-menu p-2">
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_todo"><i class="ti ti-edit me-1"></i>Edit</a>
                                                            </li>                                       
                                                            <li>
                                                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- table start -->
                                </div>

                            </div>
                            <!-- card start -->
                        </div>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
                            
        </div>
        <!-- End Content --> 

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->