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
                            <h4 class="fs-20 fw-bold mb-0">Projects & Tasks</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>                               
                                <li class="breadcrumb-item active" aria-current="page">Projects & Tasks</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center active bg-transparent" id="info-tab" data-bs-toggle="tab" data-bs-target="#employee" role="tab" aria-selected="true"><i class="ti ti-calendar me-2"></i> By Day</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center bg-transparent" id="date-tab" data-bs-toggle="tab" data-bs-target="#date" role="tab" aria-selected="false"><i class="ti ti-calendar me-2"></i>By Week</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a href="#" class="nav-link d-flex align-items-center bg-transparent" id="team-tab" data-bs-toggle="tab" data-bs-target="#team" role="tab" aria-selected="false"><i class="ti ti-calendar me-2"></i>By Month</a>
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
                                            All Projects
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
                                                    Office Management
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Clinic Management
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Educational Platform
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Chat & Call Mobile App
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Travel Planning Website
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Service Booking Software
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

                            <!-- Start Table head -->
                            <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
                                <p class="mb-0">Project : <a href="javascript:void(0);" class="fw-medium">Office Management</a></p>
                                <p class="mb-0">Total Time Worked : <span class="fw-medium text-dark">26h 15m</span></p>
                            </div>
                            <!-- End Table head -->

                            <!-- Start Table -->
                            <div class="table-responsive mb-0">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time Worked</th>
                                            <th>Status Bar</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content12" data-bs-toggle="collapse" class="d-flex align-items-center collapsed task-collapse" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">26h 15m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content12 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content13" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">List Pages<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">08h 35m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content13 collapse">
                                            <td>15 Jan 2025</td>
                                            <td>08h 45m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content12 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content14" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Dashboard<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 40m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content14 collapse">
                                            <td>14 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content14 collapse">
                                            <td>13 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

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
                                            All Projects
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
                                                    Office Management
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Clinic Management
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Educational Platform
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Chat & Call Mobile App
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Travel Planning Website
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Service Booking Software
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

                            <!-- Start Table head -->
                            <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
                                <p class="mb-0">Project : <a href="javascript:void(0);" class="fw-medium">Clinic Management</a></p>
                                <p class="mb-0">Total Time Worked : <span class="fw-medium text-dark">53h 05m</span></p>
                            </div>
                            <!-- End Table head -->

                            <!-- Start Table -->
                            <div class="table-responsive mb-4">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time Worked</th>
                                            <th>Status Bar</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content5" data-bs-toggle="collapse" class="d-flex align-items-center collapsed task-collapse" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">53h 05m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content5 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content6" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Landing Page<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 15m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content6 collapse">
                                            <td>18 Jan 2025</td>
                                            <td>08h 40m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content6 collapse">
                                            <td>17 Jan 2025</td>
                                            <td>08h 45m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content5 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content7" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Dashboard<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">18h 30m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content7 collapse">
                                            <td>16 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content5 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content8" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Components & Authentication<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 20m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content8 collapse">
                                            <td>21 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content8 collapse">
                                            <td>20 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

                            <!-- Start Table head -->
                            <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
                                <p class="mb-0">Project : <a href="javascript:void(0);" class="fw-medium">Office Management</a></p>
                                <p class="mb-0">Total Time Worked : <span class="fw-medium text-dark">26h 15m</span></p>
                            </div>
                            <!-- End Table head -->

                            <!-- Start Table -->
                            <div class="table-responsive mb-0">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time Worked</th>
                                            <th>Status Bar</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content12" data-bs-toggle="collapse" class="d-flex align-items-center collapsed task-collapse" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">26h 15m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content12 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content13" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">List Pages<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">08h 35m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content13 collapse">
                                            <td>15 Jan 2025</td>
                                            <td>08h 45m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content12 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content14" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Dashboard<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 40m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content14 collapse">
                                            <td>14 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content14 collapse">
                                            <td>13 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

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
                                            All Projects
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
                                                    Office Management
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Clinic Management
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Educational Platform
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Chat & Call Mobile App
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Travel Planning Website
                                                </label>
                                            </li>
                                            <li>
                                                <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                    <input class="form-check-input m-0 me-2" type="checkbox">
                                                    Service Booking Software
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

                            <!-- Start Table head -->
                            <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
                                <p class="mb-0">Project : <a href="javascript:void(0);" class="fw-medium">Chat & Call Mobile App</a></p>
                                <p class="mb-0">Total Time Worked : <span class="fw-medium text-dark">58h 50m</span></p>
                            </div>
                            <!-- End Table head -->

                            <!-- Start Table -->
                            <div class="table-responsive mb-4">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time Worked</th>
                                            <th>Status Bar</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content" data-bs-toggle="collapse" class="d-flex align-items-center collapsed task-collapse" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">08h 35m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content2" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Landing Page<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">58h 50m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content2 collapse">
                                            <td>31 Jan 2025</td>
                                            <td>17h 45m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content2 collapse">
                                            <td>30 Jan 2025</td>
                                            <td>09h 00m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content3" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Voice & Video Calls<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">08h 45m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content3 collapse">
                                            <td>29 Jan 2025</td>
                                            <td>14h 20m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content4" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Chats & Groups<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">26h 45m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content4 collapse">
                                            <td>16 Jan 2025</td>
                                            <td>08h 35m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content4 collapse">
                                            <td>27 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

                            <!-- Start Table head -->
                            <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
                                <p class="mb-0">Project : <a href="javascript:void(0);" class="fw-medium">Clinic Management</a></p>
                                <p class="mb-0">Total Time Worked : <span class="fw-medium text-dark">53h 05m</span></p>
                            </div>
                            <!-- End Table head -->

                            <!-- Start Table -->
                            <div class="table-responsive mb-4">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time Worked</th>
                                            <th>Status Bar</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content5" data-bs-toggle="collapse" class="d-flex align-items-center collapsed task-collapse" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">53h 05m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content5 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content6" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Landing Page<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 15m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content6 collapse">
                                            <td>18 Jan 2025</td>
                                            <td>08h 40m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content6 collapse">
                                            <td>17 Jan 2025</td>
                                            <td>08h 45m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content5 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content7" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Dashboard<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">18h 30m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content7 collapse">
                                            <td>16 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content5 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content8" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Components & Authentication<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 20m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content8 collapse">
                                            <td>21 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content8 collapse">
                                            <td>20 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

                            <!-- Start Table head -->
                            <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
                                <p class="mb-0">Project : <a href="javascript:void(0);" class="fw-medium">Travel Planning Website</a></p>
                                <p class="mb-0">Total Time Worked : <span class="fw-medium text-dark">26h 55m</span></p>
                            </div>
                            <!-- End Table head -->

                            <!-- Start Table -->
                            <div class="table-responsive mb-4">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time Worked</th>
                                            <th>Status Bar</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content9" data-bs-toggle="collapse" class="d-flex align-items-center collapsed task-collapse" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">26h 55m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content9 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content10" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">New Page Design<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 25m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content10 collapse">
                                            <td>18 Jan 2025</td>
                                            <td>08h 40m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content10 collapse">
                                            <td>17 Jan 2025</td>
                                            <td>08h 45m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content9 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content11" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Changes<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">09h 30m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 80%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content11 collapse">
                                            <td>16 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

                            <!-- Start Table head -->
                            <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
                                <p class="mb-0">Project : <a href="javascript:void(0);" class="fw-medium">Office Management</a></p>
                                <p class="mb-0">Total Time Worked : <span class="fw-medium text-dark">26h 15m</span></p>
                            </div>
                            <!-- End Table head -->

                            <!-- Start Table -->
                            <div class="table-responsive mb-4">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time Worked</th>
                                            <th>Status Bar</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content12" data-bs-toggle="collapse" class="d-flex align-items-center collapsed task-collapse" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">26h 15m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content12 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content13" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">List Pages<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">08h 35m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content13 collapse">
                                            <td>15 Jan 2025</td>
                                            <td>08h 45m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content12 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content14" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Dashboard<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 40m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content14 collapse">
                                            <td>14 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content14 collapse">
                                            <td>13 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

                            <!-- Start Table head -->
                            <div class="d-flex justify-content-between gap-2 align-items-center flex-wrap mb-4">
                                <p class="mb-0">Project : <a href="javascript:void(0);" class="fw-medium">POS Admin Software</a></p>
                                <p class="mb-0">Total Time Worked : <span class="fw-medium text-dark">88h 40m</span></p>
                            </div>
                            <!-- End Table head -->

                            <!-- Start Table -->
                            <div class="table-responsive mb-0">
                                <table class="table m-0 table-nowrap bg-white border">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Time Worked</th>
                                            <th>Status Bar</th>
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
                                                        <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content15" data-bs-toggle="collapse" class="d-flex align-items-center collapsed task-collapse" aria-expanded="false">Shaun Farley<i class="ti ti-chevron-up ms-2"></i> </a></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-dark">88h 40m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content15 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content16" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Landing Page<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">17h 40m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content16 collapse">
                                            <td>11 Jan 2025</td>
                                            <td>08h 40m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content16 collapse">
                                            <td>10 Jan 2025</td>
                                            <td>08h 45m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content15 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content17" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">Settings<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">18h 00m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content17 collapse">
                                            <td>16 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content17 collapse">
                                            <td>08 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content15 collapse">
                                            <td>
                                                <h6 class="fw-medium m-0 fs-14"><a href="#" data-bs-target=".task-collapse-content18" data-bs-toggle="collapse" aria-expanded="false" class="d-flex align-items-center collapsed task-collapse">List Pages<i class="ti ti-chevron-up ms-2"></i></a></h6>
                                            </td>
                                            <td class="text-dark">34h 50m</td>
                                            <td>
                                                <div class="progress progress-xl progress-animate custom-progress-4 success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar bg-success" style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="task-collapse-content18 collapse">
                                            <td>16 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content18 collapse">
                                            <td>16 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content18 collapse">
                                            <td>04 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>
                                        <tr class="task-collapse-content18 collapse">
                                            <td>03 Jan 2025</td>
                                            <td>09h 30m</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

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