    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <div class="content content-two create-project">
                <form action="project">
                    <!-- start row -->
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="mb-3">
                                <a class="fw-medium" href="project"><i class="ti ti-arrow-narrow-left me-1"></i>Back to  Project List</a>
                            </div>

                            <div class="card shadow-none">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Project Details</h5>

                                    <!-- start row -->
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <span class="text-dark fw-bold mb-2 d-flex">Project Image</span>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                                                    <img class="rounded-circle" src="./assets/img/icons/upload-profile.svg" alt="img">
                                                </div>
                                                <div class="d-inline-flex flex-column align-items-start">
                                                    <div class="drag-upload-btn btn btn-sm btn-dark position-relative mb-2">
                                                        Change Image
                                                        <input type="file" class="form-control image-sign" multiple="">
                                                    </div>
                                                    <span>Recommended size is 80px x 80px</span>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Project Name<span class="text-danger ms-1">*</span></label>
                                                <input class="form-control" value="Office Management">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-label">Client</label>
                                                    <a href="clients" class="text-primary text-decoration-underline fs-13 fw-medium">Add New Client</a>
                                                </div>
                                                <select class="form-control select2" data-toggle="select2">
                                                    <option>Select</option>
                                                    <option>Aliza Duncan</option>
                                                    <option>Charles Cline</option>
                                                    <option>James Higham</option>
                                                </select>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Project Code</label>
                                                <input class="form-control" value="PR23174">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                                <div class="input-group w-auto input-group-flat">
                                                    <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="20 Jan 2003">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">End Date<span class="text-danger ms-1">*</span></label>
                                                <div class="input-group w-auto input-group-flat">
                                                    <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="30 Jan 2003">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Project Type<span class="text-danger ms-1">*</span></label>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>Consulting</option>
                                                    <option>Fixed</option>
                                                </select>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>Active</option>
                                                    <option>Archived</option>
                                                    <option>Completed</option>
                                                    <option>On Hold</option>
                                                </select>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Priority<span class="text-danger ms-1">*</span></label>
                                                <select class="select">
                                                    <option>Low</option>
                                                    <option>Medium</option>
                                                    <option>High</option>
                                                </select>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-12">
                                            <div class="mb-0">
                                                <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                                <textarea class="form-control"></textarea>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                </div>
                            </div>
                            <div class="card shadow-none">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">People & Hourly rates</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">User<span class="text-danger ms-1">*</span></label>
                                                <select class="select">
                                                    <option>Select No of Users</option>
                                                    <option>4</option>
                                                    <option>3</option>
                                                    <option>2</option>
                                                    <option>1</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Team<span class="text-danger ms-1">*</span></label>
                                                <select class="select">
                                                    <option>Select Team</option>
                                                    <option>UI / UX Team</option>
                                                    <option>HTML Team</option>
                                                    <option>React Team</option>
                                                    <option>Angular Team</option>
                                                    <option>Vue Js Team</option>
                                                </select>
                                            </div>
                                        </div>  <!-- end col -->
                                    </div>

                                    <div class=" mt-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Default Billable Rate <span class="text-danger ms-1">*</span></label>
                                                    <select class="select">
                                                        <option>Select</option>
                                                        <option>Same For Everyone</option>
                                                        <option>Individual Rates</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Rate<span class="text-danger ms-1">*</span></label>
                                                    <input class="form-control" value="22">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="rounded-1 bg-white border p-3">
                                                    <!-- Start Table List -->
                                                    <div class="table-responsive border border-bottom-0 ">
                                                        <table class="table m-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Users</th>
                                                                    <th>Billable Rate/h ($)</th>
                                                                    <th>Cost Rate/h</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                                                <img src="/assets/img/users/user-06.jpg" class="img-fluid" alt="img">
                                                                            </a>
                                                                            <div class="ms-2">
                                                                                <h6 class="fw-medium m-0"><a href="javascript:void(0);">Leslie Hensley</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="22">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="20">
                                                                    </td>
                                                                    <td class="text-end"><a href="javascript:void(0);" class="p-1 rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-gray-5"><i class="ti ti-x fs-14 text-gray-5"></i></a></td>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                                                <img src="/assets/img/users/user-04.jpg" class="img-fluid" alt="img">
                                                                            </a>
                                                                            <div class="ms-2">
                                                                                <h6 class="fw-medium m-0"><a href="javascript:void(0);">Robert Brown</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="35">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="33">
                                                                    </td>
                                                                    <td class="text-end"><a href="javascript:void(0);" class="p-1 rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-gray-5"><i class="ti ti-x fs-14 text-gray-5"></i></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                                                <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                                                            </a>
                                                                            <div class="ms-2">
                                                                                <h6 class="fw-medium"><a href="javascript:void(0);">Ashley Regan</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="42">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="40">
                                                                    </td>
                                                                    <td class="text-end"><a href="javascript:void(0);" class="p-1 rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-gray-5"><i class="ti ti-x fs-14 text-gray-5"></i></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                                                <img src="/assets/img/users/user-03.jpg" class="img-fluid" alt="img">
                                                                            </a>
                                                                            <div class="ms-2">
                                                                                <h6 class="fw-medium m-0"><a href="javascript:void(0);">Mike Moore</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="22">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="20">
                                                                    </td>
                                                                    <td class="text-end"><a href="javascript:void(0);" class="p-1 rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-gray-5"><i class="ti ti-x fs-14 text-gray-5"></i></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center">
                                                                            <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                                                <img src="/assets/img/users/user-01.jpg" class="img-fluid" alt="img">
                                                                            </a>
                                                                            <div class="ms-2">
                                                                                <h6 class="fw-medium m-0"><a href="javascript:void(0);">Michael Tanaka</a></h6>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="10">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" class="form-control w-50" value="8">
                                                                    </td>
                                                                    <td class="text-end"><a href="javascript:void(0);" class="p-1 rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-gray-5"><i class="ti ti-x fs-14 text-gray-5"></i></a></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- End Table -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow-none">
                                <div class="card-body">
                                    <h5 class="fw-bold mb-3">Budget</h5>
                                    <!-- start row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Type<span class="text-danger ms-1">*</span></label>
                                                <select class="select">
                                                    <option>Time Budget</option>
                                                    <option>Money Budget</option>
                                                </select>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Budget Amount<span class="text-danger ms-1">*</span></label>
                                                <input class="form-control">
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Interval<span class="text-danger ms-1">*</span></label>
                                                <select class="select">
                                                    <option value="monthly">Monthly</option>
                                                    <option value="weekly">Weekly</option>
                                                </select>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-12 mb-3">
                                            <div class="bg-light p-3 rounded-1 border">
                                                <div class="row row-gap-3" id="monthly-fields">
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <label class="form-label">Start Month<span class="text-danger ms-1">*</span></label>
                                                            <input type="month" class="form-control" id="start-month">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <label class="form-label">End Month<span class="text-danger ms-1">*</span></label>
                                                            <input type="month" class="form-control" id="end-month">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row row-gap-3 d-none" id="weekly-fields">
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <label class="form-label">Start Week<span class="text-danger ms-1">*</span></label>
                                                            <input type="week" class="form-control" id="start-week">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-0">
                                                            <label class="form-label">End Week<span class="text-danger ms-1">*</span></label>
                                                            <input type="week" class="form-control" id="end-week">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input custom-check" type="checkbox" value="" id="flexCheckChecked" checked="">
                                                    <label class="form-check-label text-dark" for="flexCheckChecked">
                                                        Invoice based on budget instead of logged hours (30h, invoiced monthly)
                                                    </label>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->

                                        <div class="col-md-6">
                                            <div class="row align-items-center">
                                                <label class="form-label">Notify at (Email Alert)<span class="text-danger ms-1">*</span></label>
                                                <div class="col-8">
                                                    <div>
                                                        <input class="form-control" value="80">
                                                    </div>
                                                </div>
                                                <div class="col-4 ps-0">
                                                    <span>% of Budget</span>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div> <!-- end card body -->
                            </div> <!-- end card -->

                            <div class="d-flex justify-content-end">
                                <a href="javascript:void(0);" class="btn btn-light me-2 btn-sm">Cancel</a>
                                <button type="submit" class="btn btn-primary btn-sm">Save Project</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>


        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
