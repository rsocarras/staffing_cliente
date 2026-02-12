    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content pb-0">

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Images</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Base UI</a></li>                            
                        <li class="breadcrumb-item active">Images</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->
            
            <!-- start row -->
            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Images Shapes</h5>
                        </div>
                        <div class="card-body">
                        
                            <div class="row">
                                <div class="col-xl-12">
                                    <p class="text-muted">Add classes to an <code>&lt;img&gt;</code> element to easily style images in any project.</p>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="assets/img/media/img-4.jpg" alt="image" class="img-fluid rounded" width="200">
                                            <p class="mb-0">
                                                <code>.rounded</code>
                                            </p>
                                        </div>

                                        <div class="col-sm-3">
                                            <img src="assets/img/profiles/avatar-03.jpg" alt="image" class="img-fluid rounded-circle" width="133">
                                            <p class="mb-0">
                                                <code>.rounded-circle</code>
                                            </p>
                                        </div>

                                        <div class="col-sm-3">
                                            <img src="assets/img/media/img-1.jpg" alt="image" class="img-fluid img-thumbnail" width="200">
                                            <p class="mb-0">
                                                <code>.img-thumbnail</code>
                                            </p>
                                        </div>

                                        <div class="col-sm-3">
                                            <img src="assets/img/profiles/avatar-02.jpg" alt="image" class="img-thumbnail rounded-pill" width="133">
                                            <p class="mb-0">
                                                <code>.rounded-pill</code>
                                            </p>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->

            <div class="row">

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Image Left Align</h5>
                        </div>
                        <div class="card-body">
                            <img class="rounded float-start" src="assets/img/media/img-1.jpg" alt="..." width="200">
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Image Center Align</h5>
                        </div>
                        <div class="card-body">
                            <img class="rounded mx-auto d-block" src="assets/img/media/img-1.jpg" alt="..." width="200">
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Image Right Align</h5>
                        </div>
                        <div class="card-body">
                            <img class="rounded float-end" src="assets/img/media/img-1.jpg" alt="..." width="200">
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Figures</h5>
                        </div>
                        <div class="card-body d-flex justify-content-between gap-2">
                            <figure class="figure mb-0">
                                <img class="bd-placeholder-img figure-img img-fluid rounded card-img" src="assets/img/media/img-1.jpg" alt="...">
                                <figcaption class="figure-caption">A caption for the above image.</figcaption>
                            </figure>
                            <figure class="figure mb-0 float-end">
                                <img class="bd-placeholder-img figure-img img-fluid rounded card-img" src="assets/img/media/img-1.jpg" alt="...">
                                <figcaption class="figure-caption text-end">A caption for the above image.
                                </figcaption>
                            </figure>
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->

            </div>
            <!-- end row -->
                            
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->