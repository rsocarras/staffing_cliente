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
                            <h4 class="fs-20 fw-semibold mb-0 d-flex align-items-center gap-2"><a href="javascript:void(0);" class="settings-collapse-bar d-flex align-items-center text-body" aria-label="Settings"><i class="ti ti-menu-4 fs-24"></i></a>Settings</h4>
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

                                <div class="card flex-fill mb-0 bg-soft-light border shadow-none">
                                    <div class="card-body">

                                        <!-- start tab -->
                                        <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                                            <li class="nav-item">
                                                <a href="leave-types-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Leave Types</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="shift-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Shift</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="working-hours-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Working Hours</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="tracker-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Tracker Settings</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="productivity-ratings-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Productivity Ratings</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->

                                        <div class="card flex-fill mb-0 border-0 bg-transparent shadow-none">
                                            <div class="card-body p-0">
                                                <div>
                                                    <div class="d-flex align-items-center gap-2 flex-wrap justify-content-between mb-3">
                                                        <h6 class="fw-medium mb-0 fs-14">Expected Productive Time<span class="text-danger ms-1">*</span></h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="input-group w-auto input-group-flat">
                                                                <span class="input-group-text">
                                                                    <i class="ti ti-clock"></i>
                                                                </span>
                                                                <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                                            </div>
                                                            <span class="ms-2">Hours / Day</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="card border-0">
                                                        <div class="card-body">
                                                            <h6 class="mb-3">Working Days</h6>
                                                            <div class="mb-3 d-flex gap-2 flex-wrap align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" checked="">
                                                                    </div>
                                                                    <span>Monday</span>
                                                                </div>
                                                                <div class="d-flex align-items-center flex-wrap flex-sm-nowrap row-gap-2">
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="09:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="mx-3">to</span>
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="06:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 d-flex gap-2 flex-wrap align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" checked="">
                                                                    </div>
                                                                    <span>Tuesday</span>
                                                                </div>
                                                                <div class="d-flex align-items-center flex-wrap flex-sm-nowrap row-gap-2">
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="09:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="mx-3">to</span>
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="06:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 d-flex gap-2 flex-wrap align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" checked="">
                                                                    </div>
                                                                    <span>Wednesday</span>
                                                                </div>
                                                                <div class="d-flex align-items-center flex-wrap flex-sm-nowrap row-gap-2">
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="09:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="mx-3">to</span>
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="06:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 d-flex gap-2 flex-wrap align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" checked="">
                                                                    </div>
                                                                    <span>Thursday</span>
                                                                </div>
                                                                <div class="d-flex align-items-center flex-wrap flex-sm-nowrap row-gap-2">
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="09:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="mx-3">to</span>
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="06:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 d-flex gap-2 flex-wrap align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox" checked="">
                                                                    </div>
                                                                    <span>Friday</span>
                                                                </div>
                                                                <div class="d-flex align-items-center flex-wrap flex-sm-nowrap row-gap-2">
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="09:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="mx-3">to</span>
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="06:30">
                                                                        <span class="input-group-text">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 d-flex gap-2 flex-wrap align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox">
                                                                    </div>
                                                                    <span>Saturday</span>
                                                                </div>
                                                                <div class="d-flex align-items-center flex-wrap flex-sm-nowrap row-gap-2">
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text bg-light">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" disabled>
                                                                        <span class="input-group-text bg-light">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="mx-3">to</span>
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text bg-light">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" disabled>
                                                                        <span class="input-group-text bg-light">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex gap-2 flex-wrap align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="form-check form-switch">
                                                                        <input class="form-check-input" type="checkbox">
                                                                    </div>
                                                                    <span>Sunday</span>
                                                                </div>
                                                                <div class="d-flex align-items-center flex-wrap flex-sm-nowrap row-gap-2">
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text bg-light">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" disabled>
                                                                        <span class="input-group-text bg-light">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                    <span class="mx-3">to</span>
                                                                    <div class="input-group w-auto input-group-flat">
                                                                        <span class="input-group-text bg-light">
                                                                            <i class="ti ti-clock"></i>
                                                                        </span>
                                                                        <input type="text" class="form-control" data-provider="timepickr" disabled>
                                                                        <span class="input-group-text bg-light">
                                                                            <i class="ti ti-selector text-gray-5"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div> <!-- end card body -->
                                                    </div> <!-- end card -->
                                                    
                                                    <div class="card border-0">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center justify-content-between flex-wrap row-gap-2 mb-3">
                                                                <h6 class="mb-0">Break Hours</h6>
                                                                <a href="javascript:void(0);" class="text-primary" data-bs-toggle="modal" data-bs-target="#add_break"><i class="ti ti-plus me-1"></i>Add New</a>
                                                            </div>
                                                            <div class="d-xl-flex gap-3 align-items-center justify-content-between">
                                                                <div class="d-flex align-items-center mb-2 mb-xl-0">
                                                                    <span class="text-dark fw-medium fs-14">Morning Break</span>
                                                                </div>
                                                                <div class="d-sm-flex align-items-center">
                                                                    <div class="d-flex align-items-center flex-wrap flex-sm-nowrap row-gap-2">
                                                                        <div class="input-group w-auto input-group-flat">
                                                                            <span class="input-group-text">
                                                                                <i class="ti ti-clock"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control" data-provider="timepickr" data-default-time="11:00">
                                                                            <span class="input-group-text">
                                                                                <i class="ti ti-selector text-gray-5"></i>
                                                                            </span>
                                                                        </div>
                                                                        <span class="mx-3">to</span>
                                                                        <div class="input-group w-auto input-group-flat">
                                                                            <span class="input-group-text">
                                                                                <i class="ti ti-clock"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control" data-provider="timepickr" data-default-time="11:15">
                                                                            <span class="input-group-text">
                                                                                <i class="ti ti-selector text-gray-5"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-sm-3 d-flex align-items-center">
                                                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#edit_break"><i class="ti ti-edit"></i></a>
                                                                        <a href="javascript:void(0);" class="link-reset fs-18" data-bs-toggle="modal" data-bs-target="#delete_break"><i class="ti ti-trash ms-2"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div> <!-- end card body -->
                                                    </div> <!-- end card -->
                                                    
                                                    <div class="card border-0">
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <h6 class="mb-0">Lunch Hours</h6>
                                                            </div>
                                                            <div class="row align-items-center">
                                                                <div class="col-xl-4">
                                                                    <span class="text-dark fw-medium fs-14">Lunch Break</span>
                                                                </div>
                                                                <div class="col-xl-8">
                                                                    <div class="d-flex align-items-center gap-2 justify-content-xl-end flex-xl-nowrap flex-wrap">
                                                                        <label class="flex-shrink-0 me-2 text-dark">I Like you to have a</label>
                                                                        <div>
                                                                            <select class="select w-auto">
                                                                                <option value="m-1">30 Min</option>
                                                                                <option value="m-2">45 Min</option>
                                                                                <option value="m-3">1 Hour</option>
                                                                            </select>
                                                                        </div>
                                                                        <label class="flex-shrink-0 mx-2 text-dark">Lunch at</label>
                                                                        <div class="input-group w-auto input-group-flat">
                                                                            <span class="input-group-text">
                                                                                <i class="ti ti-clock"></i>
                                                                            </span>
                                                                            <input type="text" class="form-control" data-provider="timepickr" data-default-time="01:00">
                                                                            <span class="input-group-text">
                                                                                <i class="ti ti-selector text-gray-5"></i>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div> <!-- end card body -->
                                                    </div> <!-- end card -->
                                                    
                                                    <div class="d-flex align-items-center justify-content-end flex-wrap row-gap-2 border-top pt-4">
                                                        <button type="button" class="btn btn-light me-2">Cancel</button>
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div> <!-- end card body -->
                                        </div> <!-- end card -->
                                        
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