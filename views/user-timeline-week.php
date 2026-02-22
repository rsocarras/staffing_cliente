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
                            <h4 class="fs-20 fw-bold mb-0">Timeline Report</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>   
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>                           
                                <li class="breadcrumb-item active" aria-current="page">Timeline Report</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                        <li class="nav-item">
                            <a href="user-timeline-report" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-calendar me-2"></i>By Day</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-timeline-week" class="nav-link active">
                                <span class="d-md-inline-block"><i class="ti ti-calendar me-2"></i>By Week</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-timeline-screenshots" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-photo fs-13 me-1"></i>Screenshots</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-timeline-usage" class="nav-link">
                                <span class="d-md-inline-block"><i class="ti ti-chart-pie fs-13 me-1"></i>Usage</span>
                            </a>
                        </li>
                    </ul>
                    <!-- end tab -->

                    <!-- Start Filter-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-end gap-2">
                            <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Filter-->

                    <!-- Start Filter -->
                    <div class="d-flex justify-content-between g-3 align-items-center flex-wrap mb-3">
                        <span>Employee Name : <a href="#" class="fw-medium">James Higham</a></span>
                        <span>Total Time Worked : <strong class="fw-medium text-dark">08h 35m</strong></span>
                    </div>
                    <!-- End Filter -->

                    <!-- Start Filter -->
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="d-flex gap-2 gap-sm-3">
                                <div class="mb-3">
                                    <p class="d-flex align-items-center mb-1"><i class="ti ti-point-filled text-success me-1"></i>Total Working hours</p>
                                    <h5 class="fw-medium">06h 45m</h5>
                                </div>
                                <div class="mb-3">
                                    <p class="d-flex align-items-center mb-1"><i class="ti ti-point-filled text-warning me-1"></i>Edited hours</p>
                                    <h5 class="fw-medium">00h 45m</h5>
                                </div>
                            </div>
                            <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 23%;"></div>
                                <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 2%;"></div>
                                <div class="progress-bar bg-warning rounded me-3" role="progressbar" style="width: 25%;"></div>
                                <div class="progress-bar bg-success rounded me-4" role="progressbar" style="width: 30%;"></div>
                                <div class="progress-bar bg-success rounded me-4" role="progressbar" style="width: 35%;"></div>
                                <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>
                                <div class="progress-bar bg-light rounded" role="progressbar" style="width: 10%;"></div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <span class="fs-13">06:00</span>
                                <span class="fs-13">07:00</span>
                                <span class="fs-13">08:00</span>
                                <span class="fs-13">09:00</span>
                                <span class="fs-13">10:00</span>
                                <span class="fs-13">11:00</span>
                                <span class="fs-13">12:00</span>
                                <span class="fs-13">01:00</span>
                                <span class="fs-13">02:00</span>
                                <span class="fs-13">03:00</span>
                                <span class="fs-13">04:00</span>
                                <span class="fs-13">05:00</span>
                                <span class="fs-13">06:00</span>
                                <span class="fs-13">07:00</span>
                                <span class="fs-13">08:00</span>
                            </div>
                        </div>
                    </div>
                    <!-- End Filter -->

                    <!-- Start Subheader -->
                    <div class="d-flex justify-content-between g-3 align-items-center flex-wrap mb-4">
                        <span>Employee Name : <a href="#" class="fw-medium">Component Creation</a></span>
                        <span>Total Time Worked : <strong class="fw-medium text-dark">48h 07m</strong></span>
                    </div>
                    <!-- End Subheade -->

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead class="table-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Time Worked</th>
                                    <th>Timeline</th>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Shaun Farley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 15m</td>
                                    <td>08h 15m</td>
                                    <td>08h 15m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Jenny Ellis</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09h 20m</td>
                                    <td>09h 20m</td>
                                    <td>09h 20m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Leon Baxter</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 00m</td>
                                    <td>08h 00m</td>
                                    <td>08h 00m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Karen Flores</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 25m</td>
                                    <td>08h 25m</td>
                                    <td>08h 25m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Charles Cline</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 15m</td>
                                    <td>08h 15m</td>
                                    <td>08h 15m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Aliza Duncan</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 30m</td>
                                    <td>08h 30m</td>
                                    <td>08h 30m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar bg-info online avatar-rounded">
                                                <span class="avatar-title text-white">LH</span>
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Leslie Hensley</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>09h 30m</td>
                                    <td>09h 30m</td>
                                    <td>09h 30m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-07.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Karen Galvan</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 40m</td>
                                    <td>08h 40m</td>
                                    <td>08h 40m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-08.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">Thomas Ward</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 22m</td>
                                    <td>08h 22m</td>
                                    <td>08h 22m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar online avatar-rounded">
                                                <img src="/assets/img/users/user-09.jpg" class="img-fluid" alt="img">
                                            </a>
                                            <div class="ms-2">
                                                <h6 class="fw-medium fs-14 m-0"><a href="user-timeline-report">James Higham</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>08h 45m</td>
                                    <td>08h 45m</td>
                                    <td>08h 45m</td>
                                    <td>
                                        <div class="progress  mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-light rounded" role="progressbar" style="width: 18%;"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar" style="width: 4%;"></div>
                                            <div class="progress-bar bg-warning rounded me-2" role="progressbar" style="width: 30%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 35%;"></div>
                                            <div class="progress-bar bg-success rounded me-2" role="progressbar" style="width: 25%;"></div>

                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                            <span class="fs-13">10:00</span>
                                            <span class="fs-13">12:00</span>
                                            <span class="fs-13">02:00</span>
                                            <span class="fs-13">04:00</span>
                                            <span class="fs-13">06:00</span>
                                            <span class="fs-13">08:00</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- End Table -->

                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->