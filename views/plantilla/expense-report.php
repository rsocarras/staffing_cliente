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
                            <h4 class="fs-20 fw-bold mb-0">Expense Report</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>       
                                <li class="breadcrumb-item"><a href="reports">Report</a></li>                         
                                <li class="breadcrumb-item active" aria-current="page">Expense Report</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->
                    
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
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Shaun Farley
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/assets/img/users/user-02.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Jenny Ellis
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Leon Baxter
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/assets/img/users/user-04.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Karen Flores
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Charles Cline
                                        </label>
                                    </li>
                                    <li>
                                        <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                            <input class="form-check-input m-0 me-2" type="checkbox">
                                            <span class="avatar avatar-sm rounded-circle me-2"><img src="/assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span> Aliza Duncan
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

                    <!-- start table -->
                    <div class="table-responsive">
                        <table class="table m-0 table-nowrap bg-white border">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Entry Date</th>
                                    <th>Submission Date</th>
                                    <th>Amount</th>
                                    <th>Project</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Flight Travel</td>
                                    <td>15 May 2025</td>
                                    <td>15 May 2025</td>
                                    <td>5000</td>
                                    <td>Doccure</td>
                                </tr>
                                <tr>
                                    <td>Auto Rental</td>
                                    <td>13 May 2025</td>
                                    <td>13 May 2025</td>
                                    <td>1459</td>
                                    <td>Tour & Travel</td>
                                </tr>
                                <tr>
                                    <td>Entertainment</td>
                                    <td>11 May 2025</td>
                                    <td>11 May 2025</td>
                                    <td>6589</td>
                                    <td>CSPSC</td>
                                </tr>
                                <tr>
                                    <td>Food</td>
                                    <td>26 Apr 2025</td>
                                    <td>26 Apr 2025</td>
                                    <td>4754</td>
                                    <td>Law Maker</td>
                                </tr>
                                <tr>
                                    <td>Car Booking</td>
                                    <td>24 Apr 2025</td>
                                    <td>24 Apr 2025</td>
                                    <td>2145</td>
                                    <td>Service Marketplace</td>
                                </tr>
                                <tr>
                                    <td>Entertainment</td>
                                    <td>20 Apr 2025</td>
                                    <td>20 Apr 2025</td>
                                    <td>6589</td>
                                    <td>Chat App</td>
                                </tr>
                                <tr>
                                    <td>Car Booking</td>
                                    <td>23 Mar 2025</td>
                                    <td>23 Mar 2025</td>
                                    <td>1458</td>
                                    <td>Booking Management</td>
                                </tr>
                                <tr>
                                    <td>Auto Rental</td>
                                    <td>15 Mar 2025</td>
                                    <td>15 Mar 2025</td>
                                    <td>3658</td>
                                    <td>Pilot Rider</td>
                                </tr>
                                <tr>
                                    <td>Others</td>
                                    <td>21 Feb 2025</td>
                                    <td>21 Feb 2025</td>
                                    <td>4785</td>
                                    <td>Entry Management</td>
                                </tr>
                                <tr>
                                    <td>Food</td>
                                    <td>16 Feb 2025</td>
                                    <td>16 Feb 2025</td>
                                    <td>3659</td>
                                    <td>Booking App Mobile</td>
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
