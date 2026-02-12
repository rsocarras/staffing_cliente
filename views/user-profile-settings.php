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
                            <h4 class="fs-20 fw-bold mb-0">Settings</h4>
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
                                <div class="settings-sidebar" id="sidebar2">
                                    <div class="sidebar-inner">
                                        <!-- toggle item -->
                                        <div class="settings-sidebar-header">
                                            <h6 class="mb-0 ">Settings Menu</h6>
                                            <button class="settings-sidebar-close d-lg-none" id="settings-sidebar-close">
                                                <i class="ti ti-x"></i>
                                            </button>
                                        </div>
                                        <div id="sidebar-menu5" class="sidebar-menu p-0">
                                            <ul>
                                                <li class="submenu-open">
                                                    <ul>
                                                        <li class="active">
                                                            <a href="user-profile-settings">
                                                                <i class="ti ti-user-circle fs-14"></i>
                                                                <span class="fs-14 fw-medium ms-2">Profile</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="user-security-settings">
                                                                <i class="ti ti-user-cog fs-14"></i>
                                                                <span class="fs-14 fw-medium ms-2">Security</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="user-teams-settings">
                                                                <i class="ti ti-users-group fs-14"></i>
                                                                <span class="fs-14 fw-medium ms-2">Teams</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- end settings sidebar -->

                                <div class="card flex-fill mb-0 bg-soft-light border shadow-none">
                                    <div class="card-body">

                                        <form action="user-profile-settings">
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
                                                            <img class="rounded-circle" src="./assets/img/profiles/avatar-17.jpg" alt="img">
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
                                            <div class="row row-gap-4 mb-4 pb-3 border-bottom">
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
                                                                <label class="form-label">First Name<span class="text-danger ms-1">*</span></label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Last Name<span class="text-danger ms-1">*</span></label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                                                <input type="email" class="form-control">
                                                            </div>
                                                        </div> <!-- end col -->

                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                                                <input type="tel" class="form-control phone" name="phone">
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
                                                                <input type="text" class="form-control">
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
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div> <!-- end col -->
                                                    </div>
                                                    <!-- end row -->
                                                </div> <!-- end col -->
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