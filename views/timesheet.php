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
                            <h4 class="fs-20 fw-bold mb-0">Timesheet</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Timesheet</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="timesheet" class="nav-link active">
                                <span class="d-md-inline-block">By Day</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="timesheet-week" class="nav-link">
                                <span class="d-md-inline-block">By Week</span>
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
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-outline-light bg-white text-dark" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                                    All Employees
                                </a>
                                <ul class="dropdown-menu dropdown-menu-md p-2 dropdown-employee">
                                    <li>
                                        <div class="mb-2">
                                            <input type="text" class="form-control form-control-sm" placeholder="Search">
                                        </div>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="./assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <div class="input-group input-group-flat custom-date">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" value="15 jun 2025">
                            </div>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- start table -->
                    <div class="table-responsive">
                        <table class="table table-nowrap bg-white border mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total Time (H)</th>
                                    <th>06 AM</th>
                                    <th>08 AM</th>
                                    <th>10 AM</th>
                                    <th>12 PM</th>
                                    <th>02 PM</th>
                                    <th>04 PM</th>
                                    <th>06 PM</th>
                                    <th>08 PM</th>
                                    <th>10 PM</th>
                                    <th>12 AM</th>
                                    <th>02 AM</th>
                                    <th>04 AM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Shaun Farley</a></h6>
                                                <p class="fs-13 mb-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 15m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar" style="width: 1%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 12:35 AM - 01:25 AM<br>Duration : 00h 44m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 20%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Jenny Ellis</a></h6>
                                                <p class="fs-13 mb-0">PHP Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09h 20m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 5%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 15%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 12%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 20%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Leon Baxter</a></h6>
                                                <p class="fs-13 mb-0">Senior Manager</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 00m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 32%;"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Karen Flores</a></h6>
                                                <p class="fs-13 mb-0">SEO Analyst</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 25m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-gray-100 rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar" style="width: 1%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 32%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Charles Cline</a></h6>
                                                <p class="fs-13 mb-0">HR Assistant</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 15m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 5%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 8%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 20%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 16%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Aliza Duncan</a></h6>
                                                <p class="fs-13 mb-0">Application Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 30m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar" style="width: 1%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 35%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar bg-violet-500 online avatar-rounded">
                                                <span class="avatar bg-primary-subtle rounded-circle">
                                                    <span class="avatar-title text-primary">LH</span>
                                                </span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Leslie Hensley</a></h6>
                                                <p class="fs-13 mb-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09h 30m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar" style="width: 1%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 12%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 8%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 15%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 8%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 8%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Karen Galvan</a></h6>
                                                <p class="fs-13 mb-0">Android Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 40m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar" style="width: 1%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 3%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 8%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 12%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 25%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">Thomas Ward</a></h6>
                                                <p class="fs-13 mb-0">IOS Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 22m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 6%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 15%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 3%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 8%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 12%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 20%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium mb-1 fs-14"><a href="#" class="text-dark">James Higham</a></h6>
                                                <p class="fs-13 mb-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 45m</td>
                                    <td colspan="12">
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 32%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> 
                    <!-- end table -->

                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->