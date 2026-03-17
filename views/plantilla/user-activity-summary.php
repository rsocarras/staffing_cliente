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
                            <h4 class="fs-20 fw-bold mb-0">Activity Summary</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>     
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>                          
                                <li class="breadcrumb-item active" aria-current="page">Activity Summary</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">                                             
                            <a href="user-activity-summary" class="nav-link d-flex align-items-center active"><i class="ti ti-calendar me-2"></i>By Day</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-activity-summary-week" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Week</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-activity-summary-month" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Month</a>
                        </li>
                    </ul>  
                    
                    <!-- Start Search and Filter -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        <div class="d-flex align-items-center flex-wrap gap-3"> 
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
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Total Time (H)</th>
                                    <th>Utilization</th>
                                    <th class="w-50"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium m-0 fs-14"><a href="#">Shaun Farley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 15m</td>
                                    <td>80%</td>
                                    <td class="w-50">
                                        <div class="progress mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 06:00 AM - 08:00 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 08:08 AM - 10:25 AM<br>Duration : 02h 22m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 20%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 10:25 AM - 11:25 AM<br>Duration : 02h 24m 36s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 30%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 11:35 AM - 03:25 AM<br>Duration : 03h 28m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 03:35 AM - 06:25 AM<br>Duration : 03h 03m 56s" data-bs-html="true"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top" title="Time : 06:35 AM - 08:25 AM<br>Duration : 02h 24m 56s" data-bs-html="true"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00 AM</span>
                                            <span class="fs-13">08:00 AM</span>
                                            <span class="fs-13">10:00 AM</span>
                                            <span class="fs-13">12:00 PM</span>
                                            <span class="fs-13">02:00 PM</span>
                                            <span class="fs-13">04:00 PM</span>
                                            <span class="fs-13">06:00 PM</span>
                                            <span class="fs-13">08:00 PM</span>
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