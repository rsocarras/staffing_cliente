    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-10 col-md-10">
                    <!-- Breadcrumb -->
                    <div class="mb-4">
                        <a href="users" class="fw-medium"><i class="ti ti-arrow-left me-2"></i>Back to Users List</a>
                    </div>
                    <!-- /Breadcrumb -->

                    <div class="card">
                        <div class="card-header">
                            <h5 class="fw-bold m-0">Invite Users</h5>
                        </div>
                        <div class="card-body">
                            <form action="invite-users">
                                <div class="mb-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Email Address <span class="text-danger">*</span>
                                                </label>
                                                <input class="input-tags form-control" placeholder="Add new" type="text" data-role="tagsinput" name="Label"  data-choices data-choices-limit="Required Limit" data-choices-removeItem>
                                                <p class="mt-1">To Invite Multiple users, Add email seperated by comma</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    Role
                                                </label>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>User</option>
                                                    <option>Manager</option>
                                                    <option>Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between mb-0">
                                                    <label class="form-label">Projects</label>
                                                    <a href="projects" class="text-primary fw-medium  d-inline-flex align-items-center form-label"><i class="ti ti-circle-plus me-1"></i>Add New</a>
                                                </div>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>Doccure</option>
                                                    <option>Tour & Travel</option>
                                                    <option>Law Maker</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <div class="d-flex align-items-center justify-content-between mb-0">
                                                    <label class="form-label">Member of Team</label>
                                                    <a href="teams" class="text-primary fw-medium form-label d-inline-flex align-items-center"><i class="ti ti-circle-plus me-1"></i>Add New</a>
                                                </div>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>Shaun Farley</option>
                                                    <option>Jenny Ellis</option>
                                                    <option>Leon Baxter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end align-items-center">
                                    <a href="javascript:void(0);" class="btn btn-light me-2">Cancel</a>
                                    <a href="javascript:void(0);" class="btn btn-dark">Invite Users</a>
                                </div>
                            </form>
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