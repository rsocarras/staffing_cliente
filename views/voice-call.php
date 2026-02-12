    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">
    
        <!-- Start Content -->
        <div class="content">                

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Voice Call</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                        <li class="breadcrumb-item"><a href="index">Applications</a></li>                              
                        <li class="breadcrumb-item active" aria-current="page">Voice Call</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="card voice-call  mb-0 shadow-none">
                <div class="card-body position-relative text-center d-flex flex-column">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-md me-2 online avatar-rounded">
                                <img src="assets/img/users/user-01.jpg" alt="user">
                            </span>
                            <div>
                                <h6 class="mb-1"><a href="#">Edward Lietz</a></h6>
                                <span class="fs-13 d-block">+22-555-345-11</span>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="dropdown-toggle drop-arrow-none btn btn-icon btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="Row options">
                                <i class="ti ti-dots-vertical fs-16 text-dark"></i>
                            </button>                                
                            <ul class="dropdown-menu p-2">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#add_participent">Add Participant</a>
                                </li>                                       
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">Hold Call</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">Transfer Call</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item">End Call</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="call-body border flex-grow-1 position-relative d-flex align-items-center justify-content-center mb-3 p-5">
                        <img src="assets/img/bg/call-bg-01.png" class="position-absolute top-0 end-0 rounded-top img-fluid" alt="bg">
                        <img src="assets/img/bg/call-bg-02.png" class="position-absolute bottom-0 start-0 rounded-bottom img-fluid" alt="bg">
                        <div class="flex-fill text-center">
                            <div class="animation-ripple call-avatar-outer d-flex align-items-center justify-content-center m-auto mb-4">
                                <div class="avatar call-avatar d-flex mx-auto rounded-circle">
                                    <img src="assets/img/users/user-01.jpg" class="img-fluid rounded-circle" alt="user">
                                </div>
                            </div>
                            <span class="badge bg-white text-dark">01:45</span>
                            <div class="border rounded border-2 border-primary avatar avatar-xxl d-inline-flex position-absolute end-0 bottom-0 m-4">
                                <div class="bg-light p-1 rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <a href="#" class="avatar avatar-lg">
                                        <img src="assets/img/users/user-02.jpg" class="rounded-circle" alt="user">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="call-footer border rounded p-2">
                        <div class="d-flex align-items-center justify-content-center flex-wrap row-gap-2">
                            <a href="#" class="btn btn-light btn-icon me-2"><i class="ti ti-microphone fs-16"></i></a>
                            <a href="#" class="btn btn-light btn-icon me-2"><i class="ti ti-video fs-16"></i></a>
                            <a href="#" class="btn btn-light btn-icon me-2"><i class="ti ti-messages fs-16"></i></a>
                            <a href="#" class="btn btn-icon p-4 btn-danger text-white me-2"><i class="ti ti-phone fs-16"></i></a>
                            <a href="#" class="btn btn-light btn-icon me-2"><i class="ti ti-volume fs-16"></i></a>
                            <a href="#" class="btn btn-light btn-icon me-2"><i class="ti ti-mood-smile fs-16"></i></a>
                            <a href="#" class="btn btn-light btn-icon"><i class="ti ti-screen-share fs-16"></i></a>
                        </div>
                    </div> 
                </div> <!-- end card-body -->
            </div> <!-- end card -->

        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->