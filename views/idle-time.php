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
                            <h4 class="fs-20 fw-bold mb-0">Idle Time</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>       
                                <li class="breadcrumb-item"><a href="reports">Report</a></li>                         
                                <li class="breadcrumb-item active" aria-current="page">Idle Time</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center active" id="info-tab" data-bs-toggle="tab" data-bs-target="#employee" role="tab" aria-selected="true"><i class="ti ti-user me-2"></i> By Employee</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center" id="date-tab" data-bs-toggle="tab" data-bs-target="#date" role="tab" aria-selected="false"><i class="ti ti-calendar me-2"></i>By Date</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center" id="team-tab" data-bs-toggle="tab" data-bs-target="#team" role="tab" aria-selected="false"><i class="ti ti-users-group me-2"></i>By Team</a>
                        </li>
                    </ul>  

                    <!-- Start Tab Content -->
                    <div class="tab-content" id="myTabContent">
                    
                        <!-- Start Basic Info -->
                        <div class="tab-pane fade show active" id="employee" role="tabpanel" aria-labelledby="info-tab" tabindex="0">                                
                    
                            <!-- Start Search and Filter -->
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                                <div class="input-group w-auto input-group-flat">
                                    <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap-3"> 
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
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                        <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search and Filter -->

                            <div class="table-responsive">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Idle Time</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">05h 45m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task2-collapse" aria-expanded="false">Jenny Ellis<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">09h 20m</td>
                                        </tr>
                                        <tr class="task2-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task2-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task2-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task2-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task2-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task2-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task2-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task2-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task2-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task2-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task2-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task2-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task3-collapse" aria-expanded="false">Leon Baxter<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">08h 00m</td>
                                        </tr>
                                        <tr class="task3-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task3-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task3-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task3-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task3-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task3-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task3-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task3-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task3-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task3-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task3-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task3-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task4-collapse" aria-expanded="false">Karen Flores<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">08h 25m</td>
                                        </tr>
                                        <tr class="task4-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task4-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task4-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task4-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task4-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task4-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task4-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task4-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task4-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task4-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task4-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task4-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task5-collapse" aria-expanded="false">Charles Cline<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">08h 15m</td>
                                        </tr>
                                        <tr class="task5-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task5-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task5-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task5-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task5-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task5-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task5-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task5-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task5-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task5-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task5-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task5-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task6-collapse" aria-expanded="false">Aliza Duncan<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">08h 30m</td>
                                        </tr>
                                        <tr class="task6-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task6-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task6-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task6-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task6-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task6-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task6-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task6-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task6-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task6-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task6-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task6-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-info online avatar-rounded">
                                                        <span class="avatar-title text-white">LH</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task7-collapse" aria-expanded="false">Leslie Hensley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">09h 30m</td>
                                        </tr>
                                        <tr class="task7-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task7-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task7-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task7-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task7-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task7-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task7-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task7-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task7-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task7-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task7-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task7-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task8-collapse" aria-expanded="false">Karen Galvan<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">08h 40m</td>
                                        </tr>
                                        <tr class="task8-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task8-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task8-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task8-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task8-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task8-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task8-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task8-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task8-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task8-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task8-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task8-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task9-collapse" aria-expanded="false">Thomas Ward<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">08h 22m</td>
                                        </tr>
                                        <tr class="task9-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task9-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task9-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task9-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task9-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task9-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task9-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task9-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task9-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task9-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task9-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task9-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task10-collapse" aria-expanded="false">James Higham<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">08h 45m</td>
                                        </tr>
                                        <tr class="task10-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task10-collapse" aria-expanded="false">13 Jan 2025</a></p>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task10-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task10-collapse" aria-expanded="false">14 Jan 2025</a></p>
                                            </td>
                                            <td>01h 15m</td>
                                        </tr>
                                        <tr class="task10-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task10-collapse" aria-expanded="false">15 Jan 2025</a></p>
                                            </td>
                                            <td>00h 50m</td>
                                        </tr>
                                        <tr class="task10-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task10-collapse" aria-expanded="false">16 Jan 2025</a></p>
                                            </td>
                                            <td>01h 00m</td>
                                        </tr>
                                        <tr class="task10-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task10-collapse" aria-expanded="false">17 Jan 2025</a></p>
                                            </td>
                                            <td>00h 40m</td>
                                        </tr>
                                        <tr class="task10-collapse collapse">
                                            <td>
                                                <p class="m-0"><a href="#" class="d-flex align-items-center collapsed task-collapse text-body" data-bs-toggle="collapse" data-bs-target=".task10-collapse" aria-expanded="false">18 Jan 2025</a></p>
                                            </td>
                                            <td>00h 30m</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Basic Info -->
                        
                        <!-- Start Date -->
                        <div class="tab-pane fade" id="date" role="tabpanel" aria-labelledby="date-tab" tabindex="0">                                
                    
                            <!-- Start Search and Filter -->
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                                <div class="input-group w-auto input-group-flat">
                                    <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap-3"> 
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
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                        <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search and Filter -->

                            <div class="table-responsive">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Idle Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">13 Jan 2025 <i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">04h 30m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Shaun Farley</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 40m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Jenny Ellis</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Leon Baxter</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 20m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task2-collapse-content" aria-expanded="false">14 Jan 2025 <i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">03h 20m</td>
                                        </tr>
                                        <tr class="task2-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Shaun Farley</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 40m</td>
                                        </tr>
                                        <tr class="task2-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Jenny Ellis</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task2-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Leon Baxter</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 20m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task3-collapse-content" aria-expanded="false">15 Jan 2025 <i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">04h 10m</td>
                                        </tr>
                                        <tr class="task3-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Shaun Farley</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 40m</td>
                                        </tr>
                                        <tr class="task3-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Jenny Ellis</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task3-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Leon Baxter</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 20m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task4-collapse-content" aria-expanded="false">16 Jan 2025 <i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">03h 40m</td>
                                        </tr>
                                        <tr class="task4-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Shaun Farley</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 40m</td>
                                        </tr>
                                        <tr class="task4-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Jenny Ellis</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task4-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Leon Baxter</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 20m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task5-collapse-content" aria-expanded="false">17 Jan 2025 <i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">04h 10m</td>
                                        </tr>
                                        <tr class="task5-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Shaun Farley</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 40m</td>
                                        </tr>
                                        <tr class="task5-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Jenny Ellis</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task5-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Leon Baxter</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 20m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse" data-bs-toggle="collapse" data-bs-target=".task6-collapse-content" aria-expanded="false">18 Jan 2025 <i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">03h 30m</td>
                                        </tr>
                                        <tr class="task6-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Shaun Farley</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 40m</td>
                                        </tr>
                                        <tr class="task6-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Jenny Ellis</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 30m</td>
                                        </tr>
                                        <tr class="task6-collapse-content collapse">
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar online avatar-rounded">
                                                        <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="javascript:void(0);" class="d-flex align-items-center collapsed task-collapse text-gray" data-bs-toggle="collapse" data-bs-target=".task-collapse-content" aria-expanded="false">Leon Baxter</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>01h 20m</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Date -->
                        
                        <!-- Start Team Tab -->
                        <div class="tab-pane fade" id="team" role="tabpanel" aria-labelledby="team-tab" tabindex="0">                                
                    
                            <!-- Start Search and Filter -->
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                                <div class="input-group w-auto input-group-flat">
                                    <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                                    <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                                </div>
                                <div class="d-flex align-items-center flex-wrap gap-3"> 
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
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    <span class="avatar avatar-sm rounded-circle me-2"><img src="assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                        <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search and Filter -->

                            <div class="table-responsive">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Team Name</th>
                                            <th>Idle Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-indigo avatar-rounded">
                                                        <span class="avatar-title text-indigo">UI</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">UI / UX Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>05h 45m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-pink avatar-rounded">
                                                        <span class="avatar-title text-pink">HT</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">HTML Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>09h 20m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-info avatar-rounded">
                                                        <span class="avatar-title text-info">RT</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">React Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>08h 00m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-danger avatar-rounded">
                                                        <span class="avatar-title text-danger">AT</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">Angular Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>08h 25m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-success avatar-rounded">
                                                        <span class="avatar-title text-success">VT</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">Vue Js Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>08h 15m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-dark avatar-rounded">
                                                        <span class="avatar-title text-dark">PT</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">PHP Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>08h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-orange avatar-rounded">
                                                        <span class="avatar-title text-orange">LT</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">Laravel Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>09h 30m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-purple avatar-rounded">
                                                        <span class="avatar-title text-purple">TW</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">Tailwind Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>08h 22m</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="#" class="avatar bg-soft-info avatar-rounded">
                                                        <span class="avatar-title text-info">IT</span>
                                                    </a>
                                                    <div class="ms-2">
                                                        <h6 class="fw-medium mb-0 fs-14"><a href="#">IT Team</a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>08h 45m</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Team Tab -->
                        
                    </div>
                    <!-- End Tab Content -->

                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
