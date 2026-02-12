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
                                                <a href="company-settings" class="nav-link active">
                                                    <span class="d-md-inline-block">Organization</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="department-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Departments</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="location-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Locations</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="employee-settings" class="nav-link">
                                                    <span class="d-md-inline-block">Employee Type</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                        <!-- end tab -->
                                        
                                        <form action="profile-settings">
                                            <!-- start row -->
                                            <div class="row row-gap-4 pb-4 mb-4 border-bottom">
                                                <div class="col-xl-4">
                                                    <div class="mb-0">
                                                        <h5 class="mb-1 fs-16">Profile</h5>
                                                        <span class="fs-14">Upload profile picture</span>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-8">
                                                    <div class="d-flex align-items-center flex-wrap gap-2">
                                                        <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                                                            <img class="rounded-circle" src="./assets/img/icons/upload-profile.svg" alt="img">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <div class="d-flex align-items-start mb-2 gap-2 flex-wrap">
                                                                <div class="drag-upload-btn btn btn-sm btn-dark position-relative">
                                                                    Change Image
                                                                    <input type="file" class="form-control image-sign" multiple="">
                                                                </div>
                                                                <a href="javascript:void(0);" class="btn btn-sm btn-danger">  Remove</a>
                                                            </div>
                                                            <span class="fs-13">Recommended size is 300px x 300px</span>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                            <!-- start row -->
                                            <div class="row row-gap-4 mb-4 pb-4 border-bottom">
                                                <div class="col-xl-4">
                                                    <div class="mb-0">
                                                        <h5 class="mb-1 fs-16">Basic Information</h5>
                                                        <span class="fs-14">Your personal information </span>
                                                    </div>
                                                </div> <!-- end col -->

                                                <div class="col-xl-8">
                                                    <!-- start row -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Organization Name<span class="text-danger ms-1">*</span></label>
                                                                <input type="text" class="form-control" value="Steven ">
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Owner Name<span class="text-danger ms-1">*</span></label>
                                                                <input type="text" class="form-control" value="Osborne">
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                                                <input type="email" class="form-control" value="stevenosborne@example.com">
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                                                <input type="tel" class="form-control phone" name="phone">
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-0">
                                                                <label class="form-label">Industry<span class="text-danger ms-1">*</span></label>
                                                                <select class="select">
                                                                    <option>Select</option>
                                                                    <option>Healthcare</option>
                                                                    <option>IT</option>
                                                                    <option>Construction</option>
                                                                    <option>Agriculture</option>
                                                                    <option>Manufacturing</option>
                                                                </select>
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-0">
                                                                <label class="form-label">Team Size</label>
                                                                <select class="select">
                                                                    <option>Select</option>
                                                                    <option>1-10</option>
                                                                    <option>11-50</option>
                                                                    <option>51-100</option>
                                                                    <option>101-500</option>
                                                                    <option>501+</option>
                                                                </select>
                                                            </div>
                                                        </div> <!-- end col -->

                                                    </div>
                                                    <!-- end row -->
                                                </div> <!-- end col -->
                                            </div>
                                            <!-- end row -->

                                            <!-- start row -->
                                            <div class="row row-gap-4 mb-4 pb-4 border-bottom">
                                                <div class="col-xl-4">
                                                    <div class="mb-0">
                                                        <h5 class="mb-1 fs-16">Address Information</h5>
                                                        <span class="fs-13">Your address details</span>
                                                    </div>
                                                </div> <!-- end col -->
                                                <div class="col-xl-8">
                                                    <!-- start row -->
                                                    <div class="row row-gap-3">
                                                        <div class="col-md-12">
                                                            <div class="mb-0">
                                                                <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                                                                <input type="text" class="form-control" value="87 Griffin Street">
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-0">
                                                                <label class="form-label">Country<span class="text-danger ms-1">*</span></label>
                                                                <select class="select">
                                                                    <option>United States</option>
                                                                    <option>Canada</option>
                                                                    <option>Germany</option>
                                                                    <option>France</option>
                                                                </select>
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-0">
                                                                <label class="form-label">State</label>
                                                                <select class="select">
                                                                    <option>California</option>
                                                                    <option>New York</option>
                                                                    <option>Texas</option>
                                                                    <option>Florida</option>
                                                                </select>
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-0">
                                                                <label class="form-label">City<span class="text-danger ms-1">*</span></label>
                                                                <select class="select">
                                                                    <option>Los Angeles</option>
                                                                    <option>San Diego</option>
                                                                    <option>Fresno</option>
                                                                    <option>San Francisco</option>
                                                                </select>
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-0">
                                                                <label class="form-label">Postal Code<span class="text-danger ms-1">*</span></label>
                                                                <input type="text" class="form-control" value="90001">
                                                            </div>
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end row -->
                                                </div> <!-- end col -->
                                            </div>
                                            <!-- end row -->

                                            <!-- start row -->
                                            <div class="row row-gap-4">
                                                <div class="col-xl-4">
                                                    <div class="mb-0">
                                                        <h5 class="mb-1 fs-16">Transfer Ownership</h5>
                                                        <span class="fs-13">Select an admin to transfer ownership.</span>
                                                    </div>
                                                </div> <!-- end col -->
                                                <div class="col-xl-8">
                                                    <div class="d-flex align-items-end gap-2">
                                                        <div class="mb-0 w-100">
                                                            <label class="form-label">Owner<span class="text-danger ms-1">*</span></label>
                                                            <select class="select">
                                                                <option>Select</option>
                                                                <option>Shaun farley</option>
                                                                <option>Jenny Wilson</option>
                                                                <option>Leon Bailey</option>
                                                            </select>
                                                        </div>
                                                        <a href="javascript:void(0);" class="btn btn-dark">Update</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            <div class="d-flex align-items-center justify-content-end flex-wrap row-gap-2 border-top pt-4 mt-4">
                                                <button type="button" class="btn btn-light me-2">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
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
