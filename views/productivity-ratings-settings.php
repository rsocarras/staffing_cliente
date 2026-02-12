    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">
            <div class="card mb-0">
                <div class="card-body">
                    <!-- Page Header -->
                    <div class="d-flex align-items-center flex-row gap-2 mb-4">
                        <div class="flex-grow-1">
                            <h4 class="fs-20 fw-semibold mb-0 d-flex align-items-center gap-2"><a href="javascript:void(0);" class="settings-collapse-bar d-flex align-items-center text-body" aria-label="Settings"><i class="ti ti-menu-4 fs-24"></i></a>Settings</h4>
                        </div>
                        <div class="text-end">
                            <ol class="breadcrumb m-0 py-0">
                                <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                                <li class="breadcrumb-item active" aria-current="page">Settings</li>
                            </ol>
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- start row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="settings-wrapper d-flex">

                                <?= $this->render('layouts/partials/settings-sidebar') ?>

                                <div class="card flex-fill mb-0 bg-soft-light border shadow-none">
                                    <div class="card-body">

                                        <!-- start tab -->
                                        <ul class="nav nav-tabs nav-bordered nav-bordered-primary mb-4">
                                            <li class="nav-item">
                                                <a href="leave-types-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Leave Types</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="shift-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Shift</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="working-hours-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Working Hours</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="tracker-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Tracker Settings</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="productivity-ratings-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Productivity Ratings</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end tab -->

                                        <!-- start table -->
                                        <div class="table-responsive">
                                            <table class="table table-nowrap bg-white border mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>App/Website</th>
                                                        <th>Total Time (H)</th>
                                                        <th>Category</th>
                                                        <th>Label</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="avatar avatar-rounded">
                                                                    <img src="assets/img/icons/figma.svg" class="img-fluid" alt="img">
                                                                </a>
                                                                <div class="ms-2">
                                                                    <h6 class="fw-medium mb-1 fs-14"><a href="#">Figma</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>09h 45m</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option selected>Design</option>
                                                                    <option>Browser</option>
                                                                    <option>Office Suite</option>
                                                                    <option>Education</option>
                                                                    <option>AI Tools</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option>Select</option>
                                                                    <option>Productive</option>
                                                                    <option>Neutral</option>
                                                                    <option>Unproductive</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="avatar avatar-rounded">
                                                                    <img src="assets/img/icons/google.svg" class="img-fluid" alt="img">
                                                                </a>
                                                                <div class="ms-2">
                                                                    <h6 class="fw-medium mb-1 fs-14"><a href="#">Google Chrome</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>09h 20m</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option>Design</option>
                                                                    <option selected>Browser</option>
                                                                    <option>Office Suite</option>
                                                                    <option>Education</option>
                                                                    <option>AI Tools</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option>Select</option>
                                                                    <option>Productive</option>
                                                                    <option>Neutral</option>
                                                                    <option>Unproductive</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="avatar avatar-rounded">
                                                                    <img src="assets/img/icons/illustrator.svg" class="img-fluid" alt="img">
                                                                </a>
                                                                <div class="ms-2">
                                                                    <h6 class="fw-medium mb-1 fs-14"><a href="#">Adobe Illustrator</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>09h 30m</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option selected>Design</option>
                                                                    <option>Browser</option>
                                                                    <option>Office Suite</option>
                                                                    <option>Education</option>
                                                                    <option>AI Tools</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option>Select</option>
                                                                    <option>Productive</option>
                                                                    <option>Neutral</option>
                                                                    <option>Unproductive</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="avatar avatar-rounded">
                                                                    <img src="assets/img/icons/slack.svg" class="img-fluid" alt="img">
                                                                </a>
                                                                <div class="ms-2">
                                                                    <h6 class="fw-medium mb-1 fs-14"><a href="#">Slack</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>09h 00m</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option selected>Design</option>
                                                                    <option>Browser</option>
                                                                    <option>Office Suite</option>
                                                                    <option>Education</option>
                                                                    <option>AI Tools</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option>Select</option>
                                                                    <option>Productive</option>
                                                                    <option>Neutral</option>
                                                                    <option>Unproductive</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="#" class="avatar avatar-rounded">
                                                                    <img src="assets/img/icons/google-doc.svg" class="img-fluid" alt="img">
                                                                </a>
                                                                <div class="ms-2">
                                                                    <h6 class="fw-medium mb-1 fs-14"><a href="#">Google Docs</a></h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>09h 25m</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option selected>Design</option>
                                                                    <option>Browser</option>
                                                                    <option>Office Suite</option>
                                                                    <option>Education</option>
                                                                    <option>AI Tools</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <select class="select">
                                                                    <option>Select</option>
                                                                    <option>Productive</option>
                                                                    <option>Neutral</option>
                                                                    <option>Unproductive</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table -->
                                        
                                    </div> <!-- end card body -->
                                </div> <!-- end card -->
                            </div>
                        </div> <!-- end col -->

                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->