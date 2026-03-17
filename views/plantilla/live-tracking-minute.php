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
                            <h4 class="fs-20 fw-bold mb-0">Live Tracking</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Live Tracking</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="live-tracking" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-live-photo me-2"></i>Live Tracking</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="live-tracking-minute" class="nav-link active">
                                <span class="d-md-inline-block"><i class="ti ti-clock-bolt me-2"></i>Last 5 Minutes</span>
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
                            <div class="input-group input-group-flat custom-date">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" value="15 jun 2025">
                            </div>
                        </div>
                    </div>
                    <!-- End Search and Filter -->


                    <div class="table-responsive">
                        <table class="table table-nowrap bg-white border mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Clock In</th>
                                    <th>Web App / Applications</th>
                                    <th>Project & Task</th>
                                    <th>Lat / Lan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar bg-violet-500 online avatar-rounded">
                                                <span class="avatar bg-primary-subtle rounded-circle">
                                                    <span class="avatar-title text-primary">LH</span>
                                                </span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Leslie Hensley</a></h6>
                                                <p class="fs-13 mb-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:15 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/illustrator.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Adobe-Illustrator</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Doccure</a></h6>
                                        <p class="fs-13 mb-0">Testing & Bug Fixing</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Karen Galvan</a></h6>
                                                <p class="fs-13 mb-0">Android Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:22 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/sales-force.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">SalesForce</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Service Booking App</a></h6>
                                        <p class="fs-13 mb-0">Creating Application Modules</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Thomas Ward</a></h6>
                                                <p class="fs-13 mb-0">IOS Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:25 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/outlook.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Outlook</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Doctor Appointment</a></h6>
                                        <p class="fs-13 mb-0">Creating Icons for Application</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Karen Flores</a></h6>
                                                <p class="fs-13 mb-0">SEO Analyst</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:00 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/illustrator.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Adobe-Illustrator</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Food Order App</a></h6>
                                        <p class="fs-13 mb-0">Ad Setup & Campaign Management</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Charles Cline</a></h6>
                                                <p class="fs-13 mb-0">HR Assistant</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:10 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/mail.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Gmail</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Truelysell</a></h6>
                                        <p class="fs-13 mb-0">Integration & API Testing</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Aliza Duncan</a></h6>
                                                <p class="fs-13 mb-0">Application Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:13 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/jira.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Jira</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Dreamschat</a></h6>
                                        <p class="fs-13 mb-0">Performance Monitoring & Optimization</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">James Higham</a></h6>
                                                <p class="fs-13 mb-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:25 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/slack.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Slack</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Time Tacking</a></h6>
                                        <p class="fs-13 mb-0">Testing & Bug Fixing</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Shaun Farley</a></h6>
                                                <p class="fs-13 mb-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:45 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/google-doc.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Google Docs</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Office Management</a></h6>
                                        <p class="fs-13 mb-0">Creating Application Modules</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Jenny Ellis</a></h6>
                                                <p class="fs-13 mb-0">PHP Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:20 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/figma.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Figma</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Service Management App</a></h6>
                                        <p class="fs-13 mb-0">Creating Application Modules</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="employee-details" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="employee-details" class="text-dark">Leon Baxter</a></h6>
                                                <p class="fs-13 mb-0">Senior Manager</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09:30 AM</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm avatar-rounded">
                                                <img src="/assets/img/icons/google.svg" class="img-fluid" alt="img">
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-0 fs-14">Google</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="fw-medium mb-1 fs-14"><a href="project-details" class="text-dark">Advanced Booking System</a></h6>
                                        <p class="fs-13 mb-0">Develop Workflows & Rules</p>
                                    </td>
                                    <td>11.016844 / 76.955833</td>
                                    <td class="text-end">
                                        <a href="javascript:void(0);" class="btn btn-outline-light text-dark btn-sm"><i class="ti ti-photo me-1"></i>Take Screenshot</a>
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