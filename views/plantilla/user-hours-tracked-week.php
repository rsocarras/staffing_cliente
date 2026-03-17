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
                            <h4 class="fs-20 fw-bold mb-0">Hours Tracked</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>                               
                                <li class="breadcrumb-item active" aria-current="page">Hours Tracked</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">                                             
                            <a href="user-hours-tracked-report" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Day</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-hours-tracked-week" class="nav-link d-flex align-items-center active"><i class="ti ti-calendar me-2"></i>By Week</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-hours-tracked-month" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Month</a>
                        </li>
                    </ul>  
                    
                    <!-- Start Search and Filter -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                        <div class="input-group w-auto input-group-flat">
                            <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                            <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                        </div>
                        <div class="d-flex align-items-center flex-wrap gap-3"> 
                            <div class="daterangepick custom-date form-control w-auto d-flex align-items-center">
                                <i class="ti ti-calendar text-gray-5 fs-14"></i><span class="reportrange-picker"></span>
                            </div>
                        </div>
                    </div>
                    <!-- End Search and Filter -->

                    <!-- start table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th class="w-25">Date</th>
                                    <th>Time Tracked</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01 Jan 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">00h 00m</span>
                                            <div class="progress progress-bar-group bg-light mb-1 p-1 w-100 custom-progress-bar-height mw-250">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>02 Jan 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">08h 15m</span>
                                            <div class="progress progress-bar-group bg-light mb-1 p-1 w-100 custom-progress-bar-height mw-250">
                                                <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 75%;"></div>
                                                <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 25%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>03 Jan 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">08h 30m</span>
                                            <div class="progress progress-bar-group bg-light mb-1 p-1 w-100 custom-progress-bar-height mw-250">
                                                <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 60%;"></div>
                                                <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 40%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>04 Jan 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">08h 15m</span>
                                            <div class="progress progress-bar-group bg-light mb-1 p-1 w-100 custom-progress-bar-height mw-250">
                                                <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 75%;"></div>
                                                <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 25%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>05 Jan 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">00h 00m</span>
                                            <div class="progress progress-bar-group bg-light mb-1 p-1 w-100 custom-progress-bar-height mw-250">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>06 Jan 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">09h 30m</span>
                                            <div class="progress progress-bar-group bg-light mb-1 p-1 w-100 custom-progress-bar-height mw-250">
                                                <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 60%;"></div>
                                                <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 40%;"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>07 Jan 2025</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">08h 30m</span>
                                            <div class="progress progress-bar-group bg-light mb-1 p-1 w-100 custom-progress-bar-height mw-250">
                                                <div class="progress-bar bg-success rounded-start" role="progressbar" style="width: 85%;"></div>
                                                <div class="progress-bar bg-warning rounded-end" role="progressbar" style="width: 15%;"></div>
                                            </div>
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