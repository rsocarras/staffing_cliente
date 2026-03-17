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
                            <a href="user-timesheet" class="nav-link active">
                                <span class="d-md-inline-block">Daily</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-timesheet-week" class="nav-link">
                                <span class="d-md-inline-block">Weekly</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-timesheet-month" class="nav-link">
                                <span class="d-md-inline-block">Monthly</span>
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

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table mb-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
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
                                    <td>08h 00m</td>
                                    <td colspan="12">
                                        <div class="progress bg-transparent-dark mb-1 py-1 px-1"
                                            style="height: 33px;">
                                            <div class="progress-bar bg-light rounded me-1" role="progressbar"
                                                style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top"
                                                title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s"
                                                data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar"
                                                style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top"
                                                title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s"
                                                data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar"
                                                style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top"
                                                title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s"
                                                data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar"
                                                style="width: 10%;" data-bs-toggle="tooltip" data-bs-placement="Top"
                                                title="Task : Component Creation<br>Project : Dreams Timer<br>Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s"
                                                data-bs-html="true"></div>
                                            <div class="progress-bar bg-warning rounded me-1" role="progressbar"
                                                style="width: 2%;" data-bs-toggle="tooltip" data-bs-placement="Top"
                                                title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s"
                                                data-bs-html="true"></div>
                                            <div class="progress-bar bg-success rounded me-1" role="progressbar"
                                                style="width: 32%;"></div>
                                            <div class="progress-bar bg-light rounded" role="progressbar"
                                                style="width: 18%;" data-bs-toggle="tooltip" data-bs-placement="Top"
                                                title="Time : 09:35 AM - 11:25 AM<br>Duration : 02h 24m 56s"
                                                data-bs-html="true"></div>
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