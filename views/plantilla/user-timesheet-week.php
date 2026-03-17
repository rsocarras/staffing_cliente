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
                            <a href="user-timesheet" class="nav-link">
                                <span class="d-md-inline-block">Daily</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="user-timesheet-week" class="nav-link active">
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
                            <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Search and Filter -->                        

                    <!-- Start Table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Total Time (H)</th>
                                    <th>Mon <br> <span class="text-body fs-13 fw-normal">13 Jan 2025</span></th>
                                    <th>Tue <br> <span class="text-body fs-13 fw-normal">14 Jan 2025</span></th>
                                    <th>Wed <br> <span class="text-body fs-13 fw-normal">15 Jan 2025</span></th>
                                    <th>Thu <br> <span class="text-body fs-13 fw-normal">16 Jan 2025</span></th>
                                    <th>Fri <br> <span class="text-body fs-13 fw-normal">17 Jan 2025</span></th>
                                    <th>Sat <br> <span class="text-body fs-13 fw-normal">18 Jan 2025</span></th>
                                    <th>Sun <br> <span class="text-body fs-13 fw-normal">19 Jan 2025</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>51h 35m</td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 70%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start rounded-bottom-0 rounded-end-0 rounded-top-0" role="progressbar" style="width: 25%;"></div>
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%;"></div>
                                            <div class="progress-bar bg-success rounded-start-0 rounded-bottom rounded-end rounded-top-0" role="progressbar" style="width: 45%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 75%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 15m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 85%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">09h 30m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 40m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                            <div class="progress-bar bg-success rounded-start rounded-bottom-0 rounded-end-0 rounded-top-0" role="progressbar" style="width: 65%;"></div>
                                            <div class="progress-bar bg-warning rounded-start-0 rounded-bottom rounded-end rounded-top-0" role="progressbar" style="width: 15%;"></div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">08h 25m</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress bg-soft-light mb-1 py-1 px-1" style="height: 33px;">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between gap-2">
                                            <span class="text-dark fs-14">00h 00m</span>
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