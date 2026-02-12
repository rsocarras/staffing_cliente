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
                            <h4 class="fs-20 fw-bold mb-0">Manual Time</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>  
                                <li class="breadcrumb-item"><a href="#">Reports</a></li>                            
                                <li class="breadcrumb-item active" aria-current="page">Manual Time</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start tab -->
                    <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4" role="tablist">
                        <li class="nav-item">                                             
                            <a href="user-manual-time-report" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Day</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-manual-time-week" class="nav-link d-flex align-items-center"><i class="ti ti-calendar me-2"></i>By Week</a>
                        </li>
                        <li class="nav-item">
                            <a href="user-manual-time-month" class="nav-link d-flex align-items-center active"><i class="ti ti-calendar me-2"></i>By Month</a>
                        </li>
                    </ul> 
                    <!-- end tab --> 

                    <!-- Start Filter-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-4">
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

                    <!-- item 1 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 02 Jan 2025</h6>

                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Leon Baxter</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Clinic Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-danger fs-10">Rejected</span></td>
                                        <td>Meeting With Client</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 1 -->

                    <!-- item 2 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 03 Jan 2025</h6>

                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
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
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Shaun Farley</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Office Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Jenny Ellis</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 30m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Travel Planning Website</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-warning fs-10">Pending</span></td>
                                        <td>Project Not Added</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 2 -->

                    <!-- item 3 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 04 Jan 2025</h6>

                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
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
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Shaun Farley</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Office Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-02.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Jenny Ellis</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 30m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Travel Planning Website</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-warning fs-10">Pending</span></td>
                                        <td>Project Not Added</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Leon Baxter</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Clinic Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-danger fs-10">Rejected</span></td>
                                        <td>Meeting With Client</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 3 -->

                    <!-- item 4 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 05 Jan 2025</h6>

                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
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
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Shaun Farley</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Office Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 4 -->

                    <!-- item 5 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 06 Jan 2025</h6>

                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Leon Baxter</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Clinic Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-danger fs-10">Rejected</span></td>
                                        <td>Meeting With Client</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 5 -->

                    <!-- item 6 -->
                    <div class="mb-3">
                        <h6 class="fs-14 fw-medium mb-3">Date : 07 Jan 2025</h6>

                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Charles Cline</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 30m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-danger fs-10">Rejected</span></td>
                                        <td>Meeting With Client</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 6 -->

                    <!-- item 7 -->
                    <div class="mb-0">
                        <h6 class="fs-14 fw-medium mb-3">Date : 08 Jan 2025</h6>

                        <!-- Start Table -->
                        <div class="table-responsive">
                            <table class="table m-0 table-nowrap bg-white border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Edit Time (H)</th>
                                        <th>Duration</th>
                                        <th>Project</th>
                                        <th>Status</th>
                                        <th>Reason</th>
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
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Shaun Farley</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Office Management</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Karen Flores</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>00h 45m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">Chat & Call Mobile App</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Meeting With Manager</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" class="avatar online avatar-rounded">
                                                    <img src="assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-14 m-0"><a href="#">Aliza Duncan</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>12:00 PM - 01:00PM</td>
                                        <td>01h 35m</td>
                                        <td>
                                            <a href="project-details" class="fw-medium d-block">POS Admin Software</a>
                                            <p>Components Creation</p>
                                        </td>
                                        <td><span class="badge bg-success fs-10">Approved</span></td>
                                        <td>Internal meeting</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->
                    </div>
                    <!-- /item 7 -->


                </div>
            </div> 
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->