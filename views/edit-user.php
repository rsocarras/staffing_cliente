    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <div class="row justify-content-center">

                <div class="col-md-11 col-xl-10">
                    <!-- Breadcrumb -->
                    <div class="mb-4">
                        <a href="users"><i class="ti ti-arrow-left me-1"></i>Back to Users List</a>
                    </div>
                    <!-- /Breadcrumb -->

                    <div class="card mb-0">
                        <div class="card-header">
                            <h5 class="fw-bold">Edit Users</h5>
                        </div>
                        <div class="card-body">
                            <div class="bg-light d-flex gap-3 flex-wrap justify-content-between align-items-sm-center w-100 p-3 mb-3 rounded flex-column flex-sm-row">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl bg-primary avatar-rounded">
                                        <span class="avatar-title text-white">LH</span>
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="fs-14 mb-1">Leslie Hensley</h6>
                                        <p class="m-0">lessile@example.com</p>
                                    </div>
                                </div>
                                <div class="text-sm-end">
                                    <p class="fw-medium mb-0">Timezone: (GMT+05:30) Asia/Kolkata</p>
                                    <p class="fw-medium mb-0">Joined On: 17 Jan 2025</p>
                                </div>
                            </div>
                            <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                                <li class="nav-item">                                             
                                    <a href="javascript:void(0);" class="nav-link d-flex align-items-center active" data-bs-toggle="tab" data-bs-target="#basic-information">Basic Information</a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link d-flex align-items-center" data-bs-toggle="tab" data-bs-target="#employee-details">Employee Details</a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link d-flex align-items-center" data-bs-toggle="tab" data-bs-target="#work-limits">Work Limits</a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link d-flex align-items-center" data-bs-toggle="tab" data-bs-target="#reports">Reports</a>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0);" class="nav-link d-flex align-items-center" data-bs-toggle="tab" data-bs-target="#additional-information">Additional Settings</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                            
                                <!-- Basic Info -->
                                <div class="tab-pane fade show active" id="basic-information" role="tabpanel">
                                    <h6 class="fw-semibold mb-3">Basic information</h6>
                                    <form action="users">
                                        <div class="border-bottom mb-4 pb-1">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Name <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            User ID <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Email Address <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                                        <input type="tel" class="form-control phone" name="phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Onboarding Date <span class="text-danger">*</span></label>
                                                        <div class="input-group w-auto input-group-flat">
                                                            <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                                            <span class="input-group-text text-dark">
                                                                <i class="ti ti-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"> Date of Birth <span class="text-danger">*</span></label>
                                                        <div class="input-group w-auto input-group-flat">
                                                            <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                                            <span class="input-group-text text-dark">
                                                                <i class="ti ti-calendar"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-bottom mb-4 pb-1">
                                            <h6 class="fw-semibold mb-3">Address Info</h6>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Address <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Country <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>United States</option>
                                                            <option>Canada</option>
                                                            <option>United Kingdom</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            States <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>California</option>
                                                            <option>New York</option>
                                                            <option>Texas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            City <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Postal Code <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a href="javascript:void(0);" class="btn btn-light me-2">Cancel</a>
                                            <button type="submit" class="btn btn-dark">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Basic Info -->
                                
                                <!-- Employee Details -->
                                <div class="tab-pane fade" id="#" role="tabpanel">
                                    <form action="users">
                                        <div class="border-bottom mb-4 pb-1">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Employment Type <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>Administrator</option>
                                                            <option>Consultant</option>
                                                            <option>Contractor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Inoffice / Remote <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>In Office</option>
                                                            <option>Remote</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Member of Team <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>UI / UX Team</option>
                                                            <option>HTML Team</option>
                                                            <option>React Team</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Role <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>HR Assistant</option>
                                                            <option>PHP Developer</option>
                                                            <option>UI/UX Designer</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <div class="d-flex align-items-center justify-content-between mb-0">
                                                            <label class="form-label">Projects</label>
                                                            <a href="projects" class="text-primary form-label"><i class="ti ti-circle-plus me-1"></i>Add New</a>
                                                        </div>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>Office Management</option>
                                                            <option>Clinic Management</option>
                                                            <option>Chat & Call Mobile App</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label"> Comments</label>
                                                        <textarea class="form-control" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a href="javascript:void(0);" class="btn btn-light me-2">Cancel</a>
                                            <button type="submit" class="btn btn-dark">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Employee Details -->
                                
                                <!-- Work Limits -->
                                <div class="tab-pane fade" id="work-limits" role="tabpanel">
                                    <form action="users">
                                        <div class="border-bottom mb-4 pb-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Work Days <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="d-flex flex-wrap btn-group-primary gap-2" role="group" aria-label="Basic checkbox toggle button group">
                                                            <div>
                                                                <input type="checkbox" class="btn-check" id="btn-check" checked>
                                                                <label class="btn btn-white fw-normal" for="btn-check">Mon</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" class="btn-check" id="btn-check-2" checked>
                                                                <label class="btn btn-white" for="btn-check-2">Tue</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" class="btn-check" id="btn-check-3" checked>
                                                                <label class="btn btn-white" for="btn-check-3">Wed</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" class="btn-check" id="btn-check-4" checked>
                                                                <label class="btn btn-white" for="btn-check-4">Thu</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" class="btn-check" id="btn-check-5" checked>
                                                                <label class="btn btn-white" for="btn-check-5">Fri</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" class="btn-check" id="btn-check-6">
                                                                <label class="btn btn-white" for="btn-check-6">Sat</label>
                                                            </div>
                                                            <div>
                                                                <input type="checkbox" class="btn-check" id="btn-check-7">
                                                                <label class="btn btn-white" for="btn-check-7">Sun</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Limits <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="d-flex">
                                                            <div class="form-check me-3">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                                <label class="form-check-label" for="flexRadioDefault1">No Limit</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                                                <label class="form-check-label" for="flexRadioDefault2">Limit</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">
                                                                Daily Limit (hrs/day) <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" class="form-control" value="9">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class=" mb-3">
                                                            <label class="form-label">Work Time <span class="text-danger">*</span></label>
                                                            <div class="d-flex align-items-center">
                                                                <div class="input-group w-auto position-relative input-group-flat">
                                                                    <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                                                    <span class="input-group-text text-dark">
                                                                        <i class="ti ti-clock-hour-3"></i>
                                                                    </span>
                                                                </div>
                                                                <div class="form-check form-check-md ms-3 flex-shrink-0">
                                                                    <input class="form-check-input" type="checkbox">
                                                                    <label class="fs-14">All Days</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Timezone <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>Eastern Standard Time - UTC -5</option>
                                                            <option>Central Standard Time - UTC -6</option>
                                                            <option>Pacific Standard Time - UTC -8</option>
                                                            <option>India Standard Time - UTC +5:30</option>
                                                            <option>Central European Time - UTC +1</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a href="javascript:void(0);" class="btn btn-light me-2">Cancel</a>
                                            <button type="submit" class="btn btn-dark">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Work Limits -->
                                
                                <!-- Reports-->
                                <div class="tab-pane fade" id="reports" role="tabpanel">
                                    <form action="users">
                                        <div class="border-bottom mb-4 pb-1">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Reports Type <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option>Timesheet Report</option>
                                                            <option>Activity Summary</option>
                                                            <option>Web & App Usage</option>
                                                            <option>Poor Time Use</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a href="javascript:void(0);" class="btn btn-light me-2">Cancel</a>
                                            <button type="submit" class="btn btn-dark">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Reports-->
                                
                                <!-- Additional Info-->
                                <div class="tab-pane fade" id="additional-information" role="tabpanel">
                                    <form action="users">
                                        <div class="border-bottom mb-4 pb-1">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="form-check form-switch me-2">
                                                    <input class="form-check-input" type="checkbox" checked>
                                                </div>
                                                <span class="status-label">Take Screenshot</span>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">
                                                        Screenshot <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="select">
                                                        <option>Select</option>
                                                        <option selected>Every 2 Mins</option>
                                                        <option>Every 5 Mins</option>
                                                        <option>Every 10 Mins</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="form-check form-switch me-2">
                                                    <input class="form-check-input" type="checkbox" checked>
                                                </div>
                                                <span class="status-label">Manual Time</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="form-check form-switch me-2">
                                                    <input class="form-check-input" type="checkbox" checked>
                                                </div>
                                                <span class="status-label">Delete Screenshots</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="form-check form-switch me-2">
                                                    <input class="form-check-input" type="checkbox" checked>
                                                </div>
                                                <span class="status-label">Permanent Task</span>
                                            </div>
                                            <div class="d-flex align-items-center mb-4 pb-1">
                                                <div class="form-check form-switch me-2">
                                                    <input class="form-check-input" type="checkbox" checked>
                                                </div>
                                                <span class="status-label">Add member to all new projects</span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Inactive Time starts after <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option selected> 2 Mins</option>
                                                            <option> 5 Mins</option>
                                                            <option> 10 Mins</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Allowed Apps
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option selected> All Apps</option>
                                                            <option> Google Chrome</option>
                                                            <option> VS Code</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            Keep Idle Time <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="select">
                                                            <option>Select</option>
                                                            <option selected>Every 2 Mins</option>
                                                            <option>Every 5 Mins</option>
                                                            <option>Every 10 Mins</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end align-items-center">
                                            <a href="javascript:void(0);" class="btn btn-light me-2">Cancel</a>
                                            <button type="submit" class="btn btn-dark">Save Changes</button>>
                                        </div>
                                    </form>
                                </div>
                                <!-- End Additional Info-->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
