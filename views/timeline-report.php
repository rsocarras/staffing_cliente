    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <div class="card mb-0">
                <div class="card-body">

                    <!-- Page Header -->
                    <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold mb-0">Timeline Report</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>    
                                <li class="breadcrumb-item"><a href="reports">Report</a></li>                          
                                <li class="breadcrumb-item active" aria-current="page">Timeline Report</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->
            
                    <!-- Start Filter-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-end gap-2">
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
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/./assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
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
                    <!-- End Filter-->

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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Shaun Farley</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Jenny Ellis</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Leon Baxter</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Karen Flores</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Charles Cline</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Aliza Duncan</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Leslie Hensley</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Karen Galvan</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">Thomas Ward</a></h6>
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
                                                <h6 class="fw-medium fs-14 m-0"><a href="timeline-details">James Higham</a></h6>
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