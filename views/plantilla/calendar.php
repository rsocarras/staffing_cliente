    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Calendar</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Applications</a></li>                            
                        <li class="breadcrumb-item active">Calendar</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 d-flex">
                            <div class="flex-fill">
                                <div class="card">
                                    <div class="card-body">
                                        <div>
                                            <a href="#" class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#add_new"><i class="ti ti-square-rounded-plus me-1"></i>Create Event </a>
                                            <div class="accordion accordion-flush custom-accordion mt-3" id="accordionFlushExample">
                                
                                                <div class="accordion-item bg-transparent">
                                                    <h2 class="accordion-header mb-0">
                                                        <button class="accordion-button fw-semibold p-0 bg-transparent" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Events
                                                        </button>
                                                    </h2>
                                                    <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFlushExample">
                                                        <div id='external-events' class="d-flex flex-column gap-2 mt-3">
                                                            <div class="fc-event bg-soft-info p-2 d-inline-flex align-items-center rounded cursor-move" data-event='{ "title": "Meeting with Team Dev" }' data-event-classname="bg-info">
                                                                <i class="ti ti-point-filled text-info me-1 fs-18"></i>Meeting
                                                            </div>
                                                            <div class="fc-event bg-soft-secondary p-2 d-inline-flex align-items-center rounded cursor-move" data-event='{ "title": "Office Team..." }' data-event-classname="bg-secondary">
                                                                <i class="ti ti-point-filled text-secondary me-1 fs-18"></i>Office
                                                            </div>
                                                            <div class="fc-event bg-soft-success p-2 d-inline-flex align-items-center rounded cursor-move" data-event='{ "title": "Hiring For HR" }' data-event-classname="bg-success">
                                                                <i class="ti ti-point-filled text-success me-1 fs-18"></i>Hiring
                                                            </div>
                                                            <div class="fc-event bg-soft-pink p-2 d-inline-flex align-items-center rounded cursor-move" data-event='{ "title": "Optional Holiday" }' data-event-classname="bg-pink">
                                                                <i class="ti ti-point-filled text-pink me-1 fs-18"></i>Holiday
                                                            </div>
                                                            <div class="fc-event bg-soft-warning p-2 d-inline-flex align-items-center rounded cursor-move" data-event='{ "title": "Meeting with Team Dev" }' data-event-classname="bg-warning">
                                                                <i class="ti ti-point-filled text-warning me-1 fs-18"></i>Employee
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-lg-0 d-none">
                                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <h6 class="mb-0">Upcoming Events</h6>
                                        <a href="javascript:void(0);" class="btn btn-outline-light fs-12 btn-sm">View All</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="border rounded shadow-sm p-3 mb-3">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h6 class="fs-14 fw-semibold mb-0">Team Sync-Up</h6>
                                                <span class="badge badge-soft-danger">16 July 2025</span>
                                            </div>
                                            <p class="mb-0 fs-14">A quick daily standup to align on current sprint tasks, blockers</p>
                                        </div>
                                        <div class="border rounded shadow-sm p-3 mb-3">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h6 class="fs-14 fw-semibold mb-0">Project Kickoff</h6>
                                                <span class="badge badge-soft-purple">16 July 2025</span>
                                            </div>
                                            <p class="mb-0 fs-14">Introductory meeting to outline goals, timelines...</p>
                                        </div>
                                        <div class="border rounded shadow-sm p-3">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h6 class="fs-14 fw-semibold mb-0">Project Kickoff</h6>
                                                <span class="badge badge-soft-info">16 July 2025</span>
                                            </div>
                                            <p class="mb-0 fs-14"> Introductory meeting to outline goals,</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8 d-flex">
                            <div id="calendar" class="flex-fill"></div>
                        </div>
                    </div>
                </div>
            </div>           

        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
