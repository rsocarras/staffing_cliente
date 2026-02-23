<?php
use yii\helpers\Html;
use yii\helpers\Url;

$path = Yii::$app->request->getPathInfo();
// Handle root path - if empty, treat as index page
$page = empty($path) ? 'index' : basename($path);
?>

<?php if ($page == 'activity-logs') {   ?>
    <!-- Start Delete -->
    <div class="modal fade" id="delete_user">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete user?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="user-archived" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'api-keys') {   ?>
    <!-- Add Modal Content -->
    <div class="modal fade" id="add_apikeys">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add API Key</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="api-keys">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Service Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div>
                            <label class="form-label">Key<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Key</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Modal Content -->
    <div class="modal fade" id="edit_apikeys">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit API Key</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="api-keys">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Service Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Google Calendar Sync">
                        </div>
                        <div>
                            <label class="form-label">Key<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="GOOGLE-SYNC-3456-CALENDAR">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete Modal Content -->
    <div class="modal fade" id="delete_apikeys">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to delete API Key?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="api-keys" class="btn btn-sm btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'attendance') {   ?>
    <!-- Start Add Attendance  -->
    <div class="modal fade" id="add_attendance">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="attendance">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Aliza Duncan</option>
                                        <option>Charles Cline</option>
                                        <option>James Higham</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Clock In<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Clock out<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Total Hours Worked<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-hrs="true" >
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Attendance</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Attendance  -->

    <!-- Start Edit Attendance  -->
    <div class="modal fade" id="edit_attendance">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="attendance">
                    <div class="modal-body">

                        <!-- start row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Aliza Duncan</option>
                                        <option>Charles Cline</option>
                                        <option>James Higham</option>
                                    </select>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Clock In<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Clock out<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Total Hours Worked<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-hrs="true" >
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div> <!-- end col -->

                        </div>
                        <!-- start row -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Attendance  -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete attendance?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="attendance" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'blog-categories') {   ?>
    <!-- Add Modal -->
    <div class="modal fade" id="add-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="blog-categories">
                    <div class="modal-body">
                        <div>
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="edit-category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="blog-categories">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="Productivity">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="form-label mb-0">Status</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete category?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="blog-categories" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'blog-comments') {   ?>
    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete comment?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="blog-comments" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'blog-tags') {   ?>
    <!-- Add Modal -->
    <div class="modal fade" id="add-tag">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="blog-tags">
                    <div class="modal-body">
                        <div class="mb-0">
                            <label class="form-label">Tag</label>
                            <input class="form-control" data-choices data-choices-removeItem type="text">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-2 btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Modal -->
    <div class="modal fade" id="edit-tag">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="blog-tags">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tag</label>
                            <input class="form-control" data-choices data-choices-removeItem type="text" value="Audits">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="form-label mb-0">Status</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-2 btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete tag?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="blog-tags" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'blogs') {   ?>
    <!-- Add Blog Modal -->
    <div class="modal fade blog-modal" id="add_blog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Blog</h5>
                    <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="blogs">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl border rounded-circle me-3 text-body flex-shrink-0 d-flex align-items-center justify-content-center flex-column">
                                        <i class="ti ti-upload fs-14 mb-1"></i>
                                        <span class="fs-14 lh-sm fw-normal">Upload</span>
                                    </div>
                                    <div class="d-inline-flex flex-column align-items-start">
                                        <div class="drag-upload-btn btn btn-sm btn-dark position-relative mb-2">
                                            Upload
                                            <input type="file" class="form-control image-sign" multiple="">
                                        </div>
                                        <span>Recommended size is 800px x 800px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Blog Title<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Efficiency</option>
                                        <option>Time Management</option>
                                        <option>Productivity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tag</label>
                                    <input class="input-tags form-control" type="text" data-role="tagsinput" name="Label" value="Finance">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control mb-2" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Blog</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Blog Modal -->
    <div class="modal fade blog-modal" id="edit_blog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Blog</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="blogs">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl border rounded-circle me-3 text-body flex-shrink-0 d-flex align-items-center justify-content-center flex-column">
                                        <i class="ti ti-upload fs-14 mb-1"></i>
                                        <span class="fs-14 lh-sm fw-normal">Upload</span>
                                    </div>
                                    <div class="d-inline-flex flex-column align-items-start">
                                        <div class="drag-upload-btn btn btn-sm btn-dark position-relative mb-2">
                                            Upload
                                            <input type="file" class="form-control image-sign" multiple="">
                                        </div>
                                        <span>Recommended size is 80px x 80px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Blog Title<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" value="Boost Productivity with Time Tracking">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Efficiency</option>
                                        <option>Time Management</option>
                                        <option>Productivity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tag</label>
                                    <input class="input-tags form-control" type="text" data-role="tagsinput" name="Label" value="Finance">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control mb-2" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-dark fw-medium">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_blog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete blog?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="blogs" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'calendar') {   ?>
    <!-- Add New Event Start -->
    <div class="modal fade" id="add_new">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Event</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="calendar">
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Event Name <span class="text-danger ms-1">*</span></label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Event Type <span class="text-danger ms-1">*</span></label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>Green</option>
                                    <option>Blue</option>
                                    <option>Red</option>
                                    <option>Yellow</option>
                                    <option>Orange</option>
                                    <option>Cyan</option>
                                    <option>Teal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Priority</label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>Medium</option>
                                    <option>High</option>
                                    <option>Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">From</label>
                                <div class="input-group w-auto input-group-flat">
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">To</label>
                                <div class="input-group w-auto input-group-flat">
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div>
                                <label class="form-label">Description</label>
                                <textarea rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add New Event End -->

    <!-- Start Event -->
    <div class="modal fade" id="event_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-dark modal-title fw-bold"><span id="eventTitle"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Project Kickoff – Mobile App Redesign</h6>
                    <p class="mb-3">Introductory meeting to outline goals, timelines, roles, and milestones for the redesign project.</p>
                    <span class="fw-semibold mb-1 d-block">Event Date</span>
                    <p class="mb-0">17 July 2025</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Event -->
<?php }?>

<?php if ($page == 'cities') {   ?>
    <!-- Add city -->
    <div class="modal fade" id="add_city">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="cities">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">City<span class="text-danger ms-1">*</span></label>
                            <input class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>United States</option>
                                <option>Germany</option>
                                <option>Canada</option>
                                <option>Australia</option>
                                <option>Egypt</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">State<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>California</option>
                                <option>New York</option>
                                <option>Texas</option>
                                <option>Quebec</option>
                                <option>Florida</option>
                                <option>Berlin</option>
                                <option>Gauteng</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add City</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit city -->
    <div class="modal fade" id="edit_city">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit City</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="cities">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">City<span class="text-danger ms-1">*</span></label>
                            <input class="form-control" value="Los Angeles">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Country<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option selected>United States</option>
                                <option>Germany</option>
                                <option>Canada</option>
                                <option>Australia</option>
                                <option>Egypt</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">State<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option selected>California</option>
                                <option>New York</option>
                                <option>Texas</option>
                                <option>Quebec</option>
                                <option>Florida</option>
                                <option>Berlin</option>
                                <option>Gauteng</option>
                            </select>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="fw-medium">Status</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete city?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="cities" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'clients-grid') {   ?>
    <!-- Start Add Client  -->
    <div class="modal fade" id="add_client">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="clients-grid">
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>USD</option>
                                        <option>AED</option>
                                        <option>EUR</option>
                                        <option>INR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                    <div class="add-flag">
                                        <input type="text" class="form-control phone" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Default Project Hourly Rate<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Default Invoice Terms<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="mb-0">
                                    <label class="form-label">Notes<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <h6 class="mb-3 fs-16 fw-bold">Address Info</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>United States of America</option>
                                        <option>Canada</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">State</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>California</option>
                                        <option>New York</option>
                                        <option>Texas</option>
                                        <option>Florida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Los Angeles</option>
                                        <option>San Diego</option>
                                        <option>Fresno</option>
                                        <option>San Francisco</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Client  -->

    <!-- Start Edit Client  -->
    <div class="modal fade" id="edit_client">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="clients-grid">
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                                        <img class="rounded-circle" src="./assets/img/users/user-01.jpg" alt="img">
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Brian Thompson">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>USD</option>
                                        <option>AED</option>
                                        <option>EUR</option>
                                        <option>INR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                    <input type="email" class="form-control" value="brian@example.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                    <div class="add-flag">
                                        <input type="text" class="form-control phone" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Default Project Hourly Rate<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Default Invoice Terms<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="mb-0">
                                    <label class="form-label">Notes<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <h6 class="mb-3 fs-16 fw-bold">Address Info</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>United States of America</option>
                                        <option>Canada</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">State</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>California</option>
                                        <option selected>New York</option>
                                        <option>Texas</option>
                                        <option>Florida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Los Angeles</option>
                                        <option>San Diego</option>
                                        <option>Fresno</option>
                                        <option>San Francisco</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" value="765565">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Client  -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete client?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="clients-grid" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->

    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="client_details">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Client Details</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <div class="card bg-light border-0">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl rounded-circle mb-3 flex-shrink-0">
                            <img class="rounded-circle" src="./assets/img/profiles/avatar-20.jpg" alt="img">
                        </div>
                        <h6 class="fs-16 fw-bold mb-1">David Spiegel</h6>
                        <p class="mb-2">Frontend Developer</p>
                        <span class="badge bg-primary">Frontend Development</span>
                    </div>
                </div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Details</h6>
                <!-- start row -->
                <div class="row row-gap-4 mb-3">
                    <div class="col-md-6">
                        <div class="card bg-light border-0 mb-0">
                            <div class="card-body text-center">
                                <i class="ti ti-mail text-dark text-dark mb-3 fs-20"></i>
                                <h6 class="fs-14 fw-medium mb-1">Email Address</h6>
                                <p class="mb-0">james@example.com</p>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="card bg-light border-0 mb-0">
                            <div class="card-body text-center">
                                <i class="ti ti-device-mobile text-dark mb-3 fs-20"></i>
                                <h6 class="fs-14 fw-medium mb-1">Phone Number</h6>
                                <p class="mb-0">+1 404 555 0102</p>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="table-responsive mb-4">
                    <table class="table table-nowrap bg-white border mb-0">
                        <tbody>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Year of Experience</h6></td>
                                <td>15 years</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Address Info</h6></td>
                                <td>325 Lexington Ave, New York, NY 10016</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Status</h6></td>
                                <td><span class="badge badge-soft-success">Active</span></td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">No of Projects</h6></td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Work Location</h6></td>
                                <td>Remote</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Shift type</h6></td>
                                <td>Morning shift</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
                <h6 class="mb-3 fs-16 fw-bold">Basic Details</h6>
                <p class="mb-0">Experienced pereson passionate about delivering user-centered solutions, leading cross-functional teams, and driving product success.</p>
            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-light">  Edit</a>
            <a href="javascript:void(0);" class="btn btn-danger">  Delete</a>
        </div>
    </div>
    <!-- end offcanvas -->
<?php }?>

<?php if ($page == 'clients') {   ?>
    <!-- Start Add Client  -->
    <div class="modal fade" id="add_client">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="clients">
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>USD</option>
                                        <option>AED</option>
                                        <option>EUR</option>
                                        <option>INR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                    <div class="add-flag">
                                        <input type="text" class="form-control phone" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Default Project Hourly Rate<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Default Invoice Terms<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="mb-0">
                                    <label class="form-label">Notes<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <h6 class="mb-3 fs-16 fw-bold">Address Info</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>United States of America</option>
                                        <option>Canada</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">State</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>California</option>
                                        <option>New York</option>
                                        <option>Texas</option>
                                        <option>Florida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Los Angeles</option>
                                        <option>San Diego</option>
                                        <option>Fresno</option>
                                        <option>San Francisco</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Client  -->

    <!-- Start Edit Client  -->
    <div class="modal fade" id="edit_client">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="clients">
                    <div class="modal-body pb-1">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                                        <img class="rounded-circle" src="./assets/img/users/user-01.jpg" alt="img">
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Brian Thompson">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>USD</option>
                                        <option>AED</option>
                                        <option>EUR</option>
                                        <option>INR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                    <input type="email" class="form-control" value="brian@example.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                    <div class="add-flag">
                                        <input type="text" class="form-control phone" name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Default Project Hourly Rate<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Default Invoice Terms<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="mb-0">
                                    <label class="form-label">Notes<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <h6 class="mb-3 fs-16 fw-bold">Address Info</h6>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>United States of America</option>
                                        <option>Canada</option>
                                        <option>Germany</option>
                                        <option>France</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">State</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>California</option>
                                        <option selected>New York</option>
                                        <option>Texas</option>
                                        <option>Florida</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Los Angeles</option>
                                        <option>San Diego</option>
                                        <option>Fresno</option>
                                        <option>San Francisco</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" value="765565">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Client  -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete client?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="clients" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->

    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="client_details">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Client Details</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <div class="card bg-light border-0">
                    <div class="card-body text-center">
                        <div class="avatar avatar-xxl rounded-circle mb-3 flex-shrink-0">
                            <img class="rounded-circle" src="./assets/img/profiles/avatar-20.jpg" alt="img">
                        </div>
                        <h6 class="fs-16 fw-bold mb-1">David Spiegel</h6>
                        <p class="mb-2">Frontend Developer</p>
                        <span class="badge bg-primary">Frontend Development</span>
                    </div>
                </div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Details</h6>
                <!-- start row -->
                <div class="row row-gap-4 mb-3">
                    <div class="col-md-6">
                        <div class="card bg-light border-0 mb-0">
                            <div class="card-body text-center">
                                <i class="ti ti-mail text-dark text-dark mb-3 fs-20"></i>
                                <h6 class="fs-14 fw-medium mb-1">Email Address</h6>
                                <p class="mb-0">james@example.com</p>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="card bg-light border-0 mb-0">
                            <div class="card-body text-center">
                                <i class="ti ti-device-mobile text-dark mb-3 fs-20"></i>
                                <h6 class="fs-14 fw-medium mb-1">Phone Number</h6>
                                <p class="mb-0">+1 404 555 0102</p>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="table-responsive mb-4">
                    <table class="table table-nowrap bg-white border mb-0">
                        <tbody>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Year of Experience</h6></td>
                                <td>15 years</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Address Info</h6></td>
                                <td>325 Lexington Ave, New York, NY 10016</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Status</h6></td>
                                <td><span class="badge badge-soft-success">Active</span></td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">No of Projects</h6></td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Work Location</h6></td>
                                <td>Remote</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Shift type</h6></td>
                                <td>Morning shift</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
                <h6 class="mb-3 fs-16 fw-bold">Basic Details</h6>
                <p class="mb-0">Experienced pereson passionate about delivering user-centered solutions, leading cross-functional teams, and driving product success.</p>
            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-light">  Edit</a>
            <a href="javascript:void(0);" class="btn btn-danger">  Delete</a>
        </div>
    </div>
    <!-- end offcanvas -->    
<?php }?>

<?php if ($page == 'contact-list') {   ?>
    <!-- Add Contact -->
    <div class="modal fade" id="add_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="contact-list">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div>
                            <label class="form-label">Email Address<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Contact end -->

    <!-- Edit Contact -->
    <div class="modal fade" id="edit_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="contact-list">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="James Jackson">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="(123) 4567 890">
                        </div>
                        <div>
                            <label class="form-label">Email Address<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="jamesjackson@example.com">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Contact end -->

    <!-- Start Modal  -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <span class="avatar avatar-md rounded-circle bg-danger"><i class="ti ti-trash fs-24"></i></span>
                    </div>
                    <h6 class="fs-16 mb-1">Confirm Deletion</h6>
                    <p class="mb-3">Are you sure you want to delete?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="javascript:void(0);" class="btn btn-outline-light w-100" data-bs-dismiss="modal">Cancel</a>
                        <a href="contact-list" class="btn btn-danger w-100">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal  -->
<?php }?>

<?php if ($page == 'contacts') {   ?>
    <!-- Add Contact -->
    <div class="modal fade" id="add_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="contacts">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div>
                            <label class="form-label">Email Address<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Contact end -->

    <!-- Edit Contact -->
    <div class="modal fade" id="edit_modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="contacts">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="James Jackson">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="(123) 4567 890">
                        </div>
                        <div>
                            <label class="form-label">Email Address<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" value="jamesjackson@example.com">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Contact end -->

    <!-- Start Modal  -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <span class="avatar avatar-md rounded-circle bg-danger"><i class="ti ti-trash fs-24"></i></span>
                    </div>
                    <h6 class="fs-16 mb-1">Confirm Deletion</h6>
                    <p class="mb-3">Are you sure you want to delete?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="javascript:void(0);" class="btn btn-outline-light w-100" data-bs-dismiss="modal">Cancel</a>
                        <a href="contacts" class="btn btn-danger w-100">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal  -->
<?php }?>

<?php if ($page == 'countries') {   ?>
    <!-- Add Countries -->
    <div class="modal fade" id="add_country">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="countries">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Country Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Country Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Country</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Countries -->
    <div class="modal fade" id="edit_country">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="countries">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Country Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="United States">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Country Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="US">
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="form-label mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete country?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="countries" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'currencies-settings') {   ?>
    <!-- Add Currency -->
    <div class="modal fade" id="add_currency">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Currency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="currencies-settings">
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Currency Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Exchange Rate<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Code<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Symbol<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Currency</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Currency -->
    <div class="modal fade" id="edit_currency">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Currency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="currencies-settings">
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Currency Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Dirhams">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Exchange Rate<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="3.67">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Code<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="AED">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Symbol<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="د.إ">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_currency">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h6 class="fw-medium mb-3">Are you sure to delete currency?</h6>
                    <div class="d-flex">
                        <button type="button" class="btn btn-md btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="currencies-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>

<?php if ($page == 'custom-fields-settings') {   ?>
    <!-- Add Custom Field -->
    <div class="modal fade" id="add_custom_field">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Custom Field</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="custom-fields-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Module<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Employee</option>
                                        <option>Projects</option>
                                        <option>Teams</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Label<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Default Value</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Input Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Text</option>
                                        <option>Text Area</option>
                                        <option>Select</option>
                                        <option>Checkbox</option>
                                        <option>Radio Button</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Required<span class="text-danger ms-1">*</span></label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked="">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Custom Field</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Custom Field -->
    <div class="modal fade" id="edit_custom_field">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Custom Field</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="custom-fields-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Module<span class="text-danger ms-1">*</span></label>
                                            <select class="select">
                                                <option selected>Employee</option>
                                                <option>Projects</option>
                                                <option>Teams</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Label<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="Employment Type">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Default Value</label>
                                            <input type="text" class="form-control" value="Full Time">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Input Type<span class="text-danger ms-1">*</span></label>
                                                <select class="select">
                                                    <option>Select</option>
                                                    <option>Text</option>
                                                    <option>Text Area</option>
                                                    <option selected>Select</option>
                                                    <option>Checkbox</option>
                                                    <option>Radio Button</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Required<span class="text-danger ms-1">*</span></label>
                                            <div class="d-flex">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                    <label class="form-check-label" for="flexRadioDefault3">
                                                        Yes
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked="">
                                                    <label class="form-check-label" for="flexRadioDefault4">
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="fw-medium mb-0">Status</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input m-0" type="checkbox" checked="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete custom field?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="custom-fields-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'delete-account') {   ?>
    <!-- delete account modal -->
    <div class="modal fade" id="delete-account">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="delete-account">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="fw-bold mb-1">Why Are You Deleting Your Account?</h6>
                                <span>We're sorry to see you go! To help us improve, please let us know your reason for deleting your account</span>
                                <div class="mt-3">
                                    <div class="form-check form-check-md mb-3 d-inline-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="Radio" id="No-longer-use">
                                        <label class="form-check-label text-dark fs-14 fw-medium ms-2" for="No-longer-use">
                                            No longer using the service
                                            <span class="d-flex text-gray-5 fw-normal">I no longer need this service and won’t be using it in the future.</span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-md mb-3 d-inline-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="Radio" id="privacy-concerns">
                                        <label class="form-check-label text-dark fs-14 fw-medium ms-2" for="privacy-concerns">
                                            Privacy concerns
                                            <span class="d-flex text-gray-5 fw-normal">I am concerned about how my data is handled and want to remove</span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-md mb-3 d-inline-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="Radio" id="notifications">
                                        <label class="form-check-label text-dark fs-14 fw-medium ms-2" for="notifications">
                                            Too many notifications/emails
                                            <span class="d-flex text-gray-5 fw-normal">I’m overwhelmed by the volume of notifications or emails</span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-md mb-3 d-inline-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="Radio" id="poor-user-experience">
                                        <label class="form-check-label text-dark fs-14 fw-medium ms-2" for="poor-user-experience">
                                            Poor user experience
                                            <span class="d-flex text-gray-5 fw-normal">I’ve had difficulty using the platform, and it didn’t meet my expectations</span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-md mb-3 d-inline-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="Radio" id="other" checked>
                                        <label class="form-check-label text-dark fs-14 fw-medium ms-2" for="other">
                                            Other (Please specify)
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm & Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>

<?php if ($page == 'department-settings') {   ?>
    <!-- Add Custom Field -->
    <div class="modal fade" id="add_department">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="department-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Custom Field -->
    <div class="modal fade" id="edit_department">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="department-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="Networking">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="fw-medium mb-0">Status</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input m-0" type="checkbox" checked="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fs-16 mb-3">Are you sure to delete department?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="department-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'edit-time-approved') {   ?>
    <!-- Start view -->
    <div class="modal fade" id="view-approved">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Approved Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Reason</h6>
                    <span>Internal meeting for team collaboration, strategy discussion, and design updates in new project</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End view -->
<?php }?>

<?php if ($page == 'edit-time-request') {   ?>
    <!-- Start Request Details  -->
    <div class="modal fade" id="request_details">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="edit-time-request">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="d-block mb-1">Employee Name</span>
                                    <h6 class="mb-0 fs-14 fw-normal">Shaun Farley</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="d-block mb-1">Edit Time (h)</span>
                                    <h6 class="mb-0 fs-14 fw-normal">12:00 PM - 01:00 PM</h6>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <span class="d-block mb-1">Duration</span>
                                    <h6 class="mb-0 fs-14 fw-normal">45 Min</h6>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <span class="d-block mb-1">Project</span>
                                    <h6 class="mb-0 fs-14 fw-normal">Office Management</h6>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <span class="d-block mb-1">Task</span>
                                    <h6 class="mb-0 fs-14 fw-normal">Components Creation</h6>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <span class="d-block mb-1">Created Date</span>
                                    <h6 class="mb-0 fs-14 fw-normal">25 Jan 2025</h6>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <span class="d-block mb-1">Reason</span>
                                    <h6 class="mb-0 fs-14 fw-normal">Meeting with client</h6>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Approval<span class="text-danger ms-1">*</span></label>
                                    <div class="d-flex">
                                        <div class="form-check me-3">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Approve
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Reject
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Edit Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Request Details  -->
<?php }?>

<?php if ($page == 'edit-time-waiting') {   ?>
    <!-- Start view -->
    <div class="modal fade" id="view-request">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Request Reason</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Reason</h6>
                    <span>Internal meeting for team collaboration, strategy discussion, and design updates in new project</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End view -->
<?php }?>

<?php if ($page == 'edit-time') {   ?>
    <!-- Start Add Manual Time -->
    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit-time">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Manual Time -->

    <!-- Start Add Time  -->
    <div class="modal fade" id="add_time">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit-time">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Project Name<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Office Management</option>
                                        <option>Clinic Management</option>
                                        <option>Chat & Call Mobile App</option>
                                        <option>Travel Planning Website</option>
                                        <option>Food Order App</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Component Creation</option>
                                        <option>New Pages Design</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <div class="input-icon-end position-relative">
                                        <input type="text" class="form-control bg-light border" value="09h 05m 14s" disabled readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Time  -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete project?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="edit-time" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'employee-settings') {   ?>
    <!-- Add Custom Field -->
    <div class="modal fade" id="add_employee">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="employee-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Employee Type<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Employee</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Custom Field -->
    <div class="modal fade" id="edit_employee_type">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Employee Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="employee-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Employee Type<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="Administrator">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="fw-medium mb-0">Status</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input m-0" type="checkbox" checked="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_employee_type">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fs-16 mb-3">Are you sure to delete employee type?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="employee-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'employee-details') {   ?>
    <!-- Start Edit Task -->
    <div id="edit_employees" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="employee-details">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl rounded-circle border me-3 flex-shrink-0">
                                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
                                    </div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <div class="d-flex align-items-start mb-2 gap-2 flex-wrap">
                                            <div class="drag-upload-btn btn btn-sm btn-dark position-relative">
                                                Change Image
                                                <input type="file" class="form-control image-sign" multiple="">
                                            </div>
                                        </div>
                                        <span class="fs-13">Recommended size is 300px x 300px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Shaun Farley">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Team<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>UI / UX Team</option>
                                        <option selected>HTML Team</option>
                                        <option>React Team</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Location<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Remote</option>
                                        <option selected>Office</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Regular</option>
                                        <option>Night Shift</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->
<?php }?>

<?php if ($page == 'employees-archived') {   ?>
    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="add_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Add Employee</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle border me-3 flex-shrink-0">
                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
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
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
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
                            <label class="form-label">City</label>
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
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Add Employee</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="edit_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Edit Employee</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle border me-3 flex-shrink-0">
                        <img class="rounded-circle" src="./assets/img/users/user-01.jpg" alt="img">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-start mb-2 gap-2 flex-wrap">
                            <div class="drag-upload-btn btn btn-sm btn-dark position-relative">
                                Change Image
                                <input type="file" class="form-control image-sign" multiple="">
                            </div>
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger">  Remove</a>
                        </div>
                        <span>Recommended size is 300px x 300px</span>
                    </div>
                </div>
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Shaun Farley">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="shaunfarley@example.com">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="2 Years">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option selected>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" value="325 Lexington Ave, New York, NY 10016">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option selected>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <select class="select">
                                <option>California</option>
                                <option selected>New York</option>
                                <option>Texas</option>
                                <option>Florida</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-0">
                            <label class="form-label">City</label>
                            <select class="select">
                                <option>Los Angeles</option>
                                <option selected>San Diego</option>
                                <option>Fresno</option>
                                <option>San Francisco</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-0">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control" value="846401"> 
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Save Changes</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete employee?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="employees-archived" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'employees-deactivated') {   ?>
    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="add_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Add Employee</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle border me-3 flex-shrink-0">
                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
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
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
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
                            <label class="form-label">City</label>
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
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Add Employee</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="edit_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Edit Employee</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle border me-3 flex-shrink-0">
                        <img class="rounded-circle" src="./assets/img/users/user-01.jpg" alt="img">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-start mb-2 gap-2 flex-wrap">
                            <div class="drag-upload-btn btn btn-sm btn-dark position-relative">
                                Change Image
                                <input type="file" class="form-control image-sign" multiple="">
                            </div>
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger">  Remove</a>
                        </div>
                        <span>Recommended size is 300px x 300px</span>
                    </div>
                </div>
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Shaun Farley">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="shaunfarley@example.com">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="2 Years">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option selected>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" value="325 Lexington Ave, New York, NY 10016">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option selected>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <select class="select">
                                <option>California</option>
                                <option selected>New York</option>
                                <option>Texas</option>
                                <option>Florida</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-0">
                            <label class="form-label">City</label>
                            <select class="select">
                                <option>Los Angeles</option>
                                <option selected>San Diego</option>
                                <option>Fresno</option>
                                <option>San Francisco</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-0">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control" value="846401"> 
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Save Changes</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete employee?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="employees-deactivated" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'employees-grid') {   ?>
    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="add_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Add Employee</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
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
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
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
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <select class="select">
                                <option>Los Angeles</option>
                                <option>San Diego</option>
                                <option>Fresno</option>
                                <option>San Francisco</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Add Employee</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="edit_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Edit Employee</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                        <img class="rounded-circle" src="./assets/img/users/user-01.jpg" alt="img">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-start mb-2 gap-2 flex-wrap">
                            <div class="drag-upload-btn btn btn-sm btn-dark position-relative">
                                Change Image
                                <input type="file" class="form-control image-sign" multiple="">
                            </div>
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger">  Remove</a>
                        </div>
                        <span>Recommended size is 300px x 300px</span>
                    </div>
                </div>
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Shaun Farley">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="shaunfarley@example.com">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="2 Years">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option selected>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" value="325 Lexington Ave, New York, NY 10016">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option selected>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <select class="select">
                                <option>California</option>
                                <option selected>New York</option>
                                <option>Texas</option>
                                <option>Florida</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <select class="select">
                                <option>Los Angeles</option>
                                <option selected>San Diego</option>
                                <option>Fresno</option>
                                <option>San Francisco</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control" value="846401"> 
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Save Changes</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete employee?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="employees-grid" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'employees') {   ?>
    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="add_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Add Employee</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle border me-3 flex-shrink-0">
                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
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
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
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
                            <label class="form-label">City</label>
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
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Add Employee</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="edit_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Edit Employee</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle border me-3 flex-shrink-0">
                        <img class="rounded-circle" src="./assets/img/users/user-01.jpg" alt="img">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-start mb-2 gap-2 flex-wrap">
                            <div class="drag-upload-btn btn btn-sm btn-dark position-relative">
                                Change Image
                                <input type="file" class="form-control image-sign" multiple="">
                            </div>
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger">  Remove</a>
                        </div>
                        <span>Recommended size is 300px x 300px</span>
                    </div>
                </div>
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Shaun Farley">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="shaunfarley@example.com">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="2 Years">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option selected>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" value="325 Lexington Ave, New York, NY 10016">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option selected>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">State</label>
                            <select class="select">
                                <option>California</option>
                                <option selected>New York</option>
                                <option>Texas</option>
                                <option>Florida</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-0">
                            <label class="form-label">City</label>
                            <select class="select">
                                <option>Los Angeles</option>
                                <option selected>San Diego</option>
                                <option>Fresno</option>
                                <option>San Francisco</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-0">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control" value="846401"> 
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Save Changes</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete employee?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="employees" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'expense-approved') {   ?>
    <!-- Start Add Expense -->
    <div class="modal fade" id="add_expense">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-requested">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Project Name<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Tour & Travel</option>
                                        <option>CSPSC</option>
                                        <option>Doccure</option>
                                        <option>Law Maker</option>
                                        <option>Booking App Mobile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Flight Travel</option>
                                        <option>Auto Rental</option>
                                        <option>Entertainment</option>
                                        <option>Foods</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Rental</option>
                                        <option>Reservation</option>
                                        <option>Flight Travel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Entry Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Euro</option>
                                        <option>Dhirams</option>
                                        <option>USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment method<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Cash</option>
                                        <option>Credit Card</option>
                                        <option>Debit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Expense -->
<?php }?>

<?php if ($page == 'expense-category-settings') {   ?>
    <!-- Add Custom Field -->
    <div class="modal fade" id="add_expense_category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-category-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Custom Field -->
    <div class="modal fade" id="edit_expense_category">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Expense Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="employee-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="Depreciation">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="fw-medium mb-0">Status</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input m-0" type="checkbox" checked="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h6 class="fs-16 mb-3">Are you sure to delete expense Category?</h6>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="expense-category-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'expense-rejected') {   ?>
    <!-- Start Add Expense -->
    <div class="modal fade" id="add_expense">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-requested">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Project Name<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Tour & Travel</option>
                                        <option>CSPSC</option>
                                        <option>Doccure</option>
                                        <option>Law Maker</option>
                                        <option>Booking App Mobile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Flight Travel</option>
                                        <option>Auto Rental</option>
                                        <option>Entertainment</option>
                                        <option>Foods</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Rental</option>
                                        <option>Reservation</option>
                                        <option>Flight Travel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Entry Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Euro</option>
                                        <option>Dhirams</option>
                                        <option>USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment method<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Cash</option>
                                        <option>Credit Card</option>
                                        <option>Debit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Expense -->

    <!-- View Reject Modal Content -->
    <div class="modal fade" id="view-reject">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Rejected Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Reason</h6>
                    <span>Request denied as the project period overlaps with critical work schedules or exceed price.</span>
                </div>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>

<?php if ($page == 'expense-requested') {   ?>
    <!-- Start Add Expense -->
    <div class="modal fade" id="add_expense">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-requested">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Project Name<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Tour & Travel</option>
                                        <option>CSPSC</option>
                                        <option>Doccure</option>
                                        <option>Law Maker</option>
                                        <option>Booking App Mobile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Flight Travel</option>
                                        <option>Auto Rental</option>
                                        <option>Entertainment</option>
                                        <option>Foods</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Rental</option>
                                        <option>Reservation</option>
                                        <option>Flight Travel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Entry Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Euro</option>
                                        <option>Dhirams</option>
                                        <option>USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment method<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Cash</option>
                                        <option>Credit Card</option>
                                        <option>Debit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Expense -->

    <!-- Expense Accept -->
    <div class="modal fade" id="expense-accept-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form>
                    <div class="modal-body leave-accept-body">
                        <div class="text-center mb-3">
                            <span class="avatar avatar-lg bg-success rounded-circle mb-3">
                                <i class="ti ti-check fs-24 text-white"></i>
                            </span>
                            <h5>Are you Sure to Accept Expense Request</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Expense Accept -->

    <!-- Expense Rejected -->
    <div class="modal fade" id="expense-reject-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form>
                    <div class="modal-body leave-accept-body">
                        <div class="text-center mb-3">
                            <span class="avatar avatar-lg bg-danger rounded-circle mb-2">
                                <i class="ti ti-x fs-24 text-white"></i>
                            </span>
                            <h5>Are you Sure to Reject Expense Request</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Expense Rejected -->
<?php }?>

<?php if ($page == 'expense-type-settings') {   ?>
    <!-- Add Expense Type -->
    <div class="modal fade" id="add-expense-type">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-type-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Expense Type<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Expense Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Travel</option>
                                        <option>Advertising</option>
                                        <option>Office Supplies</option>
                                        <option>Utilities</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Expense Type -->
    <div class="modal fade" id="edit-expense-type">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Expense Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-type-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Expense Type<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Rental">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Expense Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Travel</option>
                                        <option>Advertising</option>
                                        <option>Office Supplies</option>
                                        <option>Utilities</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete-expense-type">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h6 class="fw-medium mb-3">Are you sure to delete expense type?</h6>
                    <div class="d-flex">
                        <button type="button" class="btn btn-md btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="expense-type-settings" class="btn btn-sm btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>

<?php if ($page == 'expense') {   ?>
    <!-- Start Add Expense -->
    <div class="modal fade" id="add_expense">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-requested">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Project Name<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Tour & Travel</option>
                                        <option>CSPSC</option>
                                        <option>Doccure</option>
                                        <option>Law Maker</option>
                                        <option>Booking App Mobile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Flight Travel</option>
                                        <option>Auto Rental</option>
                                        <option>Entertainment</option>
                                        <option>Foods</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Rental</option>
                                        <option>Reservation</option>
                                        <option>Flight Travel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Entry Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Euro</option>
                                        <option>Dhirams</option>
                                        <option>USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment method<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Cash</option>
                                        <option>Credit Card</option>
                                        <option>Debit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Expense</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Expense -->

    <!-- Start Edit Expense -->
    <div class="modal fade" id="edit-expense">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-requested">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Project Name<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Tour & Travel</option>
                                        <option>CSPSC</option>
                                        <option>Doccure</option>
                                        <option>Law Maker</option>
                                        <option>Booking App Mobile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Category<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Flight Travel</option>
                                        <option>Auto Rental</option>
                                        <option>Entertainment</option>
                                        <option>Foods</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Rental</option>
                                        <option>Reservation</option>
                                        <option>Flight Travel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Entry Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Currency<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Euro</option>
                                        <option>Dhirams</option>
                                        <option>USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Payment method<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Cash</option>
                                        <option>Credit Card</option>
                                        <option>Debit Card</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Amount<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Expense -->

    <!-- Start Expense Details -->
    <div class="modal fade" id="expense-details">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Expense Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="expense-requested">
                    <div class="modal-body">
                        <div class="bg-light rounded-2 d-flex align-items-center p-2 mb-3">
                            <a href="#" class="avatar avatar-lg bg-primary avatar-rounded flex-shrink-0 me-2">
                                <span class="avatar-title text-white">BM</span>
                            </a>
                            <div>
                                <h6 class="mb-1 fw-semibold">Booking App Mobile</h6>
                                <div class="d-flex align-items-center flex-wrap">
                                    <span class="fs-13 pe-2 border-end me-2">Category : Travel</span>
                                    <span class="fs-13">Type : Flight Booking</span>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 row-gap-3">
                            <div class="col-md-3 col-6">
                                <span class="fs-13">Entry Date</span>
                                <h6 class="mt-1 fw-normal">25 May 2025</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="fs-13">Currency</span>
                                <h6 class="mt-1 fw-normal">USD</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="fs-13 text-truncate">Payment Method</span>
                                <h6 class="mt-1 fw-normal">Cash</h6>
                            </div>
                            <div class="col-md-3 col-6">
                                <span class="fs-13">Amount</span>
                                <h6 class="mt-1 fw-normal">$256</h6>
                            </div>
                        </div>
                        <p class="m-0">Flight travel should clearly outline the purpose, details, and cost of the flight.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Expense Details -->

    <!-- Start Expense Accept -->
    <div class="modal fade" id="expense-accept-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form>
                    <div class="modal-body leave-accept-body">
                        <div class="text-center mb-3">
                            <span class="avatar avatar-lg bg-success rounded-circle mb-3">
                        <i class="ti ti-check fs-24 text-white"></i>
                    </span>
                            <h5>Are you Sure to Accept Expense</h5>
                        </div>
                        <button class="btn btn-lg btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Expense Accept -->

    <!-- Start Expense Rejected -->
    <div class="modal fade" id="expense-reject-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form>
                    <div class="modal-body leave-accept-body">
                        <div class="text-center mb-3">
                            <span class="avatar avatar-lg bg-danger rounded-circle mb-2">
                        <i class="ti ti-x fs-24 text-white"></i>
                    </span>
                            <h5>Are you Sure to Reject Expense</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <button class="btn btn-lg btn-primary w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Expense Rejected -->
<?php }?>

<?php if ($page == 'faq') {   ?>
    <!-- Add Faq -->
    <div class="modal fade" id="add-faq">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="faq">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Question <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div>
                            <label class="form-label">Answer <span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add FAQ</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Faq -->
    <div class="modal fade" id="edit-faq">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="faq">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="General">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Question <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="What is a time tracking and management app?">
                        </div>
                        <div>
                            <label class="form-label">Answer <span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="3">It tracks and records time spent on tasks or projects to improve productivity</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete faq?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="faq" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'file-manager') {   ?>
    <div class="modal fade" id="add_folder">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mb-0">Create Folder</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="file-manager">
                    <div class="modal-body">
                        <div class="mb-0">
                            <label class="form-label">Folder Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New Folder</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <div class="modal fade" id="add_member">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Members</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body pb-2">
                    <div class="position-relative mb-3">
                        <input type="text" class="form-control" placeholder="Search Email">
                    </div>
                    <div class="form-check ps-0">
                        <label class="form-check-label member-check-list activate d-flex align-items-center justify-content-between p-2 rounded mb-1">
                            <span class="d-flex align-items-center text-dark">
                                <span>
                                    <img src="/assets/img/profiles/avatar-01.jpg" class="avatar avatar-md avatar-rounded me-2" alt="Img">
                                </span> Sophie
                            </span>
                            <input type="checkbox" class="form-check-input" checked>
                        </label>
                        <label class="form-check-label member-check-list d-flex align-items-center justify-content-between p-2 rounded mb-1">
                            <span class="d-flex align-items-center text-dark">
                                <span>
                                    <img src="/assets/img/profiles/avatar-02.jpg" class="avatar avatar-md avatar-rounded me-2" alt="Img">
                                </span> Cameron
                            </span>
                            <input type="checkbox" class="form-check-input">
                        </label>
                        <label class="form-check-label member-check-list d-flex align-items-center justify-content-between p-2 rounded mb-1">
                            <span class="d-flex align-items-center text-dark">
                                <span>
                                    <img src="/assets/img/profiles/avatar-03.jpg" class="avatar avatar-md avatar-rounded me-2" alt="Img">
                                </span> Doris
                            </span>
                            <input type="checkbox" class="form-check-input">
                        </label>
                        <label class="form-check-label member-check-list d-flex align-items-center justify-content-between p-2 rounded mb-1">
                            <span class="d-flex align-items-center text-dark">
                                <span>
                                    <img src="/assets/img/profiles/avatar-04.jpg" class="avatar avatar-md avatar-rounded me-2" alt="Img">
                                </span> Rufana
                            </span>
                            <input type="checkbox" class="form-check-input">
                        </label>
                        <label class="form-check-label member-check-list d-flex align-items-center justify-content-between p-2 rounded mb-1">
                            <span class="d-flex align-items-center text-dark">
                                <span>
                                    <img src="/assets/img/profiles/avatar-04.jpg" class="avatar avatar-md avatar-rounded me-2" alt="Img">
                                </span> Michael
                            </span>
                            <input type="checkbox" class="form-check-input">
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end modal -->

    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete file?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="file-manager" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'index' || $page == 'layout-mini' || $page == 'layout-hoverview' || $page == 'layout-hidden' || $page == 'layout-fullwidth' || $page == 'layout-rtl' || $page == 'layout-dark') {   ?>
    <!-- start offcanvas -->
    <div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="add_new">
        <div class="offcanvas-header d-block border-bottom">
            <div class="d-flex align-items-center justify-content-between">
            <h5 class="offcanvas-title fs-18 fw-bold">Add Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
        </div>
        <div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-start mb-2 gap-2 flex-wrap">
                            <div class="drag-upload-btn btn btn-sm btn-dark position-relative">
                                Change Image
                                <input type="file" class="form-control image-sign" multiple="">
                            </div>
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger">  Remove</a>
                        </div>
                        <span>Recommended size is 300px x 300px</span>
                    </div>
                </div>
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
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
                            <label class="form-label">City</label>
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
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Add Member</a>
        </div>
    </div>
    <!-- end offcanvas -->
<?php }?>

<?php if ($page == 'integrations-settings') { ?>
    <!-- Add Custom Field -->
    <div class="modal fade" id="add_department">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="integrations-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Custom Field -->
    <div class="modal fade" id="edit_department">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="integrations-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="Networking">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="fw-medium mb-0">Status</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input m-0" type="checkbox" checked="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fs-16 mb-3">Are you sure to delete department?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="integrations-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'invoice') { ?>
    <!-- Start View Invoice -->
    <div class="modal fade" id="view-invoice">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row d-flex justify-content-between align-items-center border-bottom mb-3 pb-2">
                        <div class="col-md-6">
                            <div class="invoice-logo mb-2">
                                <img src="/assets/img/logo.svg" class="logo-white" alt="logo">
                                <img src="/assets/img/logo-white.svg" class="logo-dark" alt="logo">
                            </div>
                            <p class="mb-0">3099 Kennedy Court Framingham, MA 01702</p>
                        </div>
                        <div class="col-md-6">
                            <div class=" text-end mb-2">
                                <h5 class=" mb-1">Invoice No <span class="text-primary">#INV0001</span></h5>
                                <p class="mb-1 fw-medium">Created Date : <span class="text-dark">25 Dec 2025</span> </p>
                                <p class="fw-medium m-0">Due Date : <span class="text-dark">28 Dec 2025</span> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-3 pb-3">
                        <div class="col-md-6">
                            <p class="text-dark mb-2 fw-semibold">From</p>
                            <div>
                                <p class=" fw-medium mb-1">Thomas Lawler</p>
                                <p class="mb-1">2077 Chicago Avenue Orosi, CA 93647</p>
                                <p class="mb-1">Email : <span class="text-dark">thomaslawler@example.com</span></p>
                                <p class="m-0">Phone : <span class="text-dark">+1 987 654 3210</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="text-dark mb-2 fw-semibold">To</p>
                            <div>
                                <p class="text-dark fw-medium mb-1">Sara Clarke</p>
                                <p class="mb-1">3103 Trainer Avenue Peoria, IL 61602</p>
                                <p class="mb-1">Email : <span class="text-dark">saraclarke@example.com</span></p>
                                <p class="m-0">Phone : <span class="text-dark">+1 987 471 6589</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <p class="fw-medium mb-2">Invoice For : <span class="text-dark fw-medium">Design & development of Website</span></p>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class=" fs-14 fw-medium ">Description</th>
                                        <th class=" fs-14 fw-medium text-end">Type</th>
                                        <th class=" fs-14 fw-medium text-end">Qty</th>
                                        <th class=" fs-14 fw-medium text-end">Cost</th>
                                        <th class=" fs-14 fw-medium text-end">Discount</th>
                                        <th class=" fs-14 fw-medium text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class=" fs-14 fw-medium">Design System</td>
                                        <td class=" text-end">1</td>
                                        <td class=" text-end">Service</td>
                                        <td class=" text-end">$500</td>
                                        <td class=" text-end">$100</td>
                                        <td class=" text-end">$400</td>
                                    </tr>
                                    <tr>
                                        <td class=" fs-14 fw-medium">Brand Guidellines</td>
                                        <td class=" text-end">1</td>
                                        <td class=" text-end">Service</td>
                                        <td class=" text-end">$300</td>
                                        <td class=" text-end">$50</td>
                                        <td class=" text-end">$250</td>
                                    </tr>
                                    <tr>
                                        <td class=" fs-14 fw-medium">Social Media Teams</td>
                                        <td class=" text-end">1</td>
                                        <td class=" text-end">Service</td>
                                        <td class=" text-end">$400</td>
                                        <td class=" text-end">$100</td>
                                        <td class=" text-end">$300</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row border-bottom mb-4">
                        <div class="col-md-5 ms-auto mb-3">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-2 pe-3">
                                <p class="mb-0">Sub Total</p>
                                <p class="text-dark fw-medium mb-2">$950</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-2 pe-3">
                                <p class="mb-0">Discount (0%)</p>
                                <p class="text-dark fw-medium mb-2">$0</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2 pe-3">
                                <p class="mb-0">VAT (5%)</p>
                                <p class="text-dark fw-medium mb-2">$0</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2 pe-3">
                                <h5>Total Amount</h5>
                                <h5>$950</h5>
                            </div>
                            <p class="fs-14 m-0">
                                Amount in Words : Dollar Nine Hundred Fifty
                            </p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-7">
                            <div>
                                <div class="mb-3">
                                    <h6 class="mb-1">Terms and Conditions</h6>
                                    <p>We are not liable for disruptions or delays caused by third-party providers (e.g., airlines, hotels, car rentals).</p>
                                </div>
                                <div class="mb-0">
                                    <h6 class="mb-1">Notes</h6>
                                    <p class="m-0">Please ensure that all booking details are correct before proceeding with payment.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="text-end">
                                <img src="/assets/img/icons/sign.svg" class="img-fluid" alt="sign">
                            </div>
                            <div class="text-end mb-0">
                                <h6 class="fs-14 fw-medium pe-3">Ted M. Davis</h6>
                                <p class="m-0">Assistant Manager</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End View Invoice -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_invoice">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to delete invoice?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn  btn-light  me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="invoice" class="btn  btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'invoices') { ?>
    <!-- Start Delete Task -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-md modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure want to delete?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="invoices" class="btn btn-primary w-100">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Task -->
<?php }?>

<?php if ($page == 'kanban-view') { ?>
    <!-- Add Todo -->
    <div class="modal fade" id="add-task">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="kanban-view">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>To Do</option>
                                        <option>Inprogress</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Medium</option>
                                        <option>High</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Descriptions</label>
                                    <div class="snow-editor"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    <label class="form-label">Select Assignee</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Sophie</option>
                                        <option>Cameron</option>
                                        <option>Doris</option>
                                        <option>Rufana</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Todo end -->

    <!-- Edit Todo -->
    <div class="modal fade" id="edit_task">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="kanban-view">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" value="UI Pages">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>To Do</option>
                                        <option>Inprogress</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Medium</option>
                                        <option>High</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Descriptions</label>
                                    <div class="snow-editor"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    <label class="form-label">Select Assignee</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Sophie</option>
                                        <option>Cameron</option>
                                        <option>Doris</option>
                                        <option>Rufana</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Todo end -->

    <!-- Start Modal  -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <span class="avatar avatar-md rounded-circle bg-danger"><i class="ti ti-trash fs-24"></i></span>
                    </div>
                    <h6 class="fs-16 mb-1">Confirm Deletion</h6>
                    <p class="mb-3">Are you sure you want to delete this task?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="javascript:void(0);" class="btn btn-outline-light w-100" data-bs-dismiss="modal">Cancel</a>
                        <a href="kanban-view" class="btn btn-danger w-100">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal  -->
<?php }?>

<?php if ($page == 'leave-approved') { ?>
    <!-- Add Leave Modal Content -->
    <div class="modal fade" id="add_leave">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="leave-approved">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Aliza Duncan</option>
                                        <option>Charles Cline</option>
                                        <option>James Higham</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Annual Leave</option>
                                        <option>Permission</option>
                                        <option>Sick Leave</option>
                                        <option>Maternity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">From Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">To Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 bg-light p-3 rounded-2">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">25 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">26 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            1st Half  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-medium mb-0">27 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- View Approved Modal Content -->
    <div class="modal fade" id="view-approved">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Approved Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Reason</h6>
                    <span>Approved, as attending a graduation ceremony is a significant personal milestone that recognizes the employee's dedication and achievement.</span>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'leave-rejected') { ?>
    <!-- Add Leave Modal Content -->
    <div class="modal fade" id="add_leave">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="leave-approved">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Aliza Duncan</option>
                                        <option>Charles Cline</option>
                                        <option>James Higham</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Annual Leave</option>
                                        <option>Permission</option>
                                        <option>Sick Leave</option>
                                        <option>Maternity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">From Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">To Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 bg-light p-3 rounded-2">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">25 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">26 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            1st Half  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-medium mb-0">27 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- View Reject Modal Content -->
    <div class="modal fade" id="view-reject">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Rejected Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Reason</h6>
                    <span>Request denied as the leave period overlaps with critical work schedules or employees needs.</span>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'leave-types-settings') { ?>
    <!-- Add Leave Type -->
    <div class="modal fade" id="add-leave">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="leave-types-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leave Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Leave Type -->
    <div class="modal fade" id="edit_leave_type">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leave Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="leave-types-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Casual Leave">
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-dark fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h6 class="fw-medium mb-3">Are you sure to delete leave type?</h6>
                    <div class="d-flex">
                        <button type="button" class="btn btn-md btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="leave-types-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>

<?php if ($page == 'leave-types') { ?>
    <!-- Add Custom Field -->
    <div class="modal fade" id="add_shift">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="leave-types">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leave Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Custom Field -->
    <div class="modal fade" id="edit_department">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Leave Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="leave-types">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Casual Leave">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fs-16 mb-3">Are you sure to delete leave type?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="leave-types" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'leave') { ?>
    <!-- Add Leave Modal Content -->
    <div class="modal fade" id="add_leave">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="leave">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Aliza Duncan</option>
                                        <option>Charles Cline</option>
                                        <option>James Higham</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Annual Leave</option>
                                        <option>Permission</option>
                                        <option>Sick Leave</option>
                                        <option>Maternity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">From Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">To Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 bg-light p-3 rounded-2">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">25 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">26 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            1st Half  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-medium mb-0">27 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- View Request Modal Content -->
    <div class="modal fade" id="view-request">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Request Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Reason</h6>
                    <span>To participate in my graduation ceremony and officially receive my degree, marking the successful completion of my academic journey.</span>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Leave Accept Modal Content -->
    <div class="modal fade" id="leave-accept-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="leave">
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <span class="avatar avatar-lg bg-success rounded-circle mb-2">
                            <i class="ti ti-check fs-24 text-white"></i>
                        </span>
                            <h5>Are you Sure to Accept Leave</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Leave Rejected Modal Content -->
    <div class="modal fade" id="leave-reject-modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="leave">
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <span class="avatar avatar-lg bg-danger rounded-circle mb-2">
                            <i class="ti ti-x fs-24 text-white"></i>
                        </span>
                            <h5>Are you Sure to Reject Leave</h5>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary w-100" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'location-settings') { ?>
    <!-- Add Custom Field -->
    <div class="modal fade" id="add_locations">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="location-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Location</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Custom Field -->
    <div class="modal fade" id="edit_location">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="location-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="Remote">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <span class="fw-medium mb-0">Status</span>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input m-0" type="checkbox" checked="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fs-16 mb-3">Are you sure to delete location?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="location-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'notes') { ?>
    <!-- Add Todo -->
    <div class="modal fade" id="add_note">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="notes">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Priority</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Medium</option>
                                        <option>High</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Created Date</label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date</label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Descriptions</label>
                                    <div class="snow-editor"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    <label class="form-label">Select Assignee</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Sophie</option>
                                        <option>Cameron</option>
                                        <option>Doris</option>
                                        <option>Rufana</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New To Do</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Todo end -->

    <!-- Edit Todo -->
    <div class="modal fade" id="edit_note">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="notes">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" value="Meeting with Product Team">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Priority</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Medium</option>
                                        <option>High</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Created Date</label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date</label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Descriptions</label>
                                    <div class="snow-editor"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div>
                                    <label class="form-label">Select Assignee</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Sophie</option>
                                        <option>Cameron</option>
                                        <option>Doris</option>
                                        <option>Rufana</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Todo end -->

    <!-- Start Modal  -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-2">
                        <span class="avatar avatar-md rounded-circle bg-danger"><i class="ti ti-trash fs-24"></i></span>
                    </div>
                    <h6 class="fs-16 mb-1">Confirm Deletion</h6>
                    <p class="mb-3">Are you sure you want to delete this note?</p>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="javascript:void(0);" class="btn btn-outline-light w-100" data-bs-dismiss="modal">Cancel</a>
                        <a href="notes" class="btn btn-danger w-100">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal  -->

    <!-- Start View Note -->
    <div class="modal fade" id="view-note">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header">
                            <div class="d-flex align-items-center">
                                <h4 class="modal-title mb-0">Notes</h4>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <h4 class="mb-2">Meet Lisa to discuss project details</h4>
                                        <p>Hiking is a long, vigorous walk, usually on trails or footpaths in the countryside. Walking for pleasure developed in Europe during the eighteenth century. Religious pilgrimages have existed much longer but they involve walking long distances for a spiritual purpose associated with specific religions and also we achieve inner peace while we hike at a local park.</p>
                                        <p class="badge badge-outline-danger d-inline-flex align-items-center mb-0"><i class="ti ti-circle-filled fs-7 me-1"></i> High</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End View Note -->
<?php }?>

<?php if ($page == 'notifications') { ?>
    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete Notification?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="notifications" class="btn btn-primary w-100" >Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'pages') { ?>
    <!-- Add Page -->
    <div class="modal fade" id="add_pages">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="pages">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keywords<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                        <div>
                            <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                            <div class="snow-editor"></div>
                            <p class="mt-2 mb-0">Maximum 60 Words</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Add Page -->

    <!-- Edit Page -->
    <div class="modal fade" id="edit_pages">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Page</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="pages">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Title<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Live Tracking">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="live tracking">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keywords<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="LT">
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                            <div class="snow-editor"><p class="mb-0">Provides an overview of employee or project-related activities.</p></div>
                            <p class="mt-2">Maximum 60 Words</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <span class="form-label mb-0">Status</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Edit Page -->

    <!-- Delete -->
    <div class="modal fade" id="delete_pages">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete page?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="pages" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Delete -->
<?php }?>

<?php if ($page == 'payment-method-settings') { ?>
    <!-- Add Payment Method -->
    <div class="modal fade" id="add-payment">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="payment-method-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Payment Method<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Payment Method</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Payment Method -->
    <div class="modal fade" id="edit-payment">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Payment Method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="payment-method-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Payment Method<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Cash">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete-payment">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h6 class="fw-medium mb-3">Are you sure to delete payment method?</h6>
                    <div class="d-flex">
                        <button type="button" class="btn btn-md btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="payment-method-settings" class="btn btn-sm btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>

<?php if ($page == 'permissions') { ?>
    <!-- Start Add Role -->
    <div class="modal fade" id="add-role">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Role</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="roles-permissions">
                    <div class="modal-body">
                        <div>
                            <label class="form-label">Role Name <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Role -->

    <!-- Start Edit Role -->
    <div class="modal fade" id="edit-role">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Role</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="roles-permissions">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Role Name <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="User">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="form-label">Status</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Role -->
<?php }?>

<?php if ($page == 'plans-and-billings') { ?>
    <!-- Invoice Details -->
    <div class="modal fade" id="purchase-details">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="invoice-content">
                        <div>
                            <div class="row justify-content-between align-items-center border-bottom mb-4 pb-4">
                                <div class="col-md-6">
                                    <div class="invoice-logo mb-2">
                                        <img src="/assets/img/logo.svg" class="logo-white" alt="logo">
                                        <img src="/assets/img/logo-white.svg" class="logo-dark" alt="logo">
                                    </div>
                                    <p class="mb-0 text-body">3099 Kennedy Court Framingham, MA 01702</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-end flex-wrap gap-3">
                                        <img src="/assets/img/icons/paid-icon-1.svg" alt="">
                                        <div class="text-end">
                                            <p class="mb-1 fs-18 fw-bold"><a href="javascript:void(0);" class="text-primary">#INV0001</a></p>
                                            <p class="mb-1 text-body">Created Date : <span class="text-dark">Sep 24, 2023</span></p>
                                            <p class="mb-0 text-body">Due Date : <span class="text-dark">Sep 30, 2023</span> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4 row-gap-3 pb-4 border-bottom">
                                <div class="col-md-6">
                                    <h6 class="mb-2 fw-bold">From</h6>
                                    <div>
                                        <h6 class="mb-2 fw-medium fs-14">Thomas Lawler</h6>
                                        <p class="mb-1 fs-14">2077 Chicago Avenue Orosi, CA 93647</p>
                                        <p class="mb-1 fs-14">Email : <span class="text-dark">thomaslawler@example.com</span></p>
                                        <p class="fs-14 mb-0">Phone : <span class="text-dark">+1 987 654 3210</span></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-2 fw-medium">To</h6>
                                    <div>
                                        <h6 class="mb-2 fw-medium fs-14">Sara Flores</h6>
                                        <p class="mb-1 fs-14">3103 Trainer Avenue Peoria, IL 61602</p>
                                        <p class="mb-1 fs-14">Email : <span class="text-dark">saraflores@example.com</span></p>
                                        <p class="fs-14 mb-0">Phone : <span class="text-dark">+1 987 471 6589</span></p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-4 fw-bold text-body">Invoice For : <span class="text-dark">Subscription</span> </h6>
                                <div class="table-responsive mb-3">
                                    <table class="table table-nowrap bg-white border mb-0">
                                        <thead>
                                            <tr>
                                                <th>DESCRIPTION</th>
                                                <th>QUANTITY</th>
                                                <th>COST</th>
                                                <th>DAYS</th>
                                                <th>TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fw-medium text-dark">Basic (Monthly)</td>
                                                <td>01</td>
                                                <td>$500</td>
                                                <td>30 Days</td>
                                                <td>$400</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row justify-content-end mb-4 pb-4 border-bottom">
                                <div class="col-md-5">
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-2 pe-3">
                                        <p class="mb-0">Sub Total</p>
                                        <p class="text-dark fw-medium mb-2">$99</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center border-bottom mb-2 pe-3">
                                        <p class="mb-0">Discount(0%)</p>
                                        <p class="text-dark fw-medium mb-2">$0</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-3 pe-3">
                                        <p class="mb-0">VAT(5%)</p>
                                        <p class="text-dark fw-medium mb-2">$0</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-0 pe-3">
                                        <h5 class="fw-bold mb-0">Total Amount</h5>
                                        <h5 class="fw-bold mb-0">$99</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center row-gap-4 pb-0">
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <h6 class="mb-1 fw-medium fs-14">Terms and Conditions</h6>
                                        <p class="mb-0">We are not liable for disruptions or delays</p>
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-medium fs-14">Notes</h6>
                                        <p class="mb-0">Please ensure that all booking details are Correct</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-end">
                                        <img src="/assets/img/icons/sign.svg" class="img-fluid" alt="sign">
                                    </div>
                                    <div class="text-end">
                                        <h6 class="fs-14 fw-medium">Ted M. Davis</h6>
                                        <p class="mb-0">Assistant Manager</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Add Card -->
    <div class="modal fade" id="add_card">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="plans-and-billings">
                    <div class="modal-body">
                        <div class="row row-gap-3">
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label">Name on the Card<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label">Card Number<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label">Expiration Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label">CVV<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control">
                                        <span class="input-group-text">
                                            <i class="ti ti-lock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Card</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Card -->
    <div class="modal fade" id="edit_card">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="plans-and-billings">
                    <div class="modal-body">
                        <div class="row row-gap-3">
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label">Name on the Card<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Kevin Reynolds">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <label class="form-label">Card Number<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="5396 5250 1908 1568">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label">Expiration Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <label class="form-label">CVV<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control">
                                        <span class="input-group-text">
                                            <i class="ti ti-lock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Upgrade -->
    <div class="modal fade" id="upgrade">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Plans</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <ul class="col-3 mx-auto nav nav-pills bg-nav-pills nav-justified border p-2 bg-white pricing-tab">
                            <li class="nav-item">
                                <a href="#home2" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded active">
                                    Monthly Billing
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#profile2" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded">
                                    Annual Billing
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="home2">
                            <!-- start row -->
                            <div class="row justify-content-center row-gap-3">

                                <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                                    <div class="card mb-0 flex-fill">
                                        <div class="card-body">
                                            <div class="card bg-light rounded border-0 text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title fs-16 fw-bold mb-2">Basic Plan</h5>
                                                    <h3 class="text-dark mb-2 fs-28">$29.00 <small class="text-muted fs-14 fw-normal">/ Per Month</small></h3>
                                                    <p class="mb-0">Basic Feature for up to <span class="text-dark">10</span> users</p>
                                                </div>
                                            </div>
                                            <h6 class="fs-14 mb-1">Features Includes</h6>
                                            <p class="mb-3 text-body">Includes in this Basic plan</p>
                                            <div class="mb-4">
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Apps & Web Activity Analysis</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Attendance</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Screenshots</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Productivity Reports</span>
                                                <span class="d-flex align-items-center mb-0 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Work Type Report</span>
                                            </div>
                                            <button class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#checkout_card">Subscribe Now</button>
                                        </div> <!-- end card body -->
                                    </div> <!-- end card -->
                                </div> <!-- end col -->

                                <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                                    <div class="card mb-0 flex-fill">
                                        <div class="card-body">
                                            <div class="card bg-light rounded border-0 text-center position-relative">
                                                <div class="card-body">
                                                    <span class="badge bg-pink custom-badge">Recommended</span>
                                                    <h5 class="card-title fs-16 fw-bold mb-2">Business Plan</h5>
                                                    <h3 class="text-dark mb-2 fs-28">$69.00 <small class="text-muted fs-14 fw-normal">/ Per Month</small></h3>
                                                    <p class="mb-0">Basic Feature for up to <span class="text-dark">22</span> users</p>
                                                </div>
                                            </div>
                                            <h6 class="fs-14 mb-1">Features Includes</h6>
                                            <p class="mb-3 text-body">Includes in this Business plan</p>
                                            <div class="mb-4">
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Apps & Web Activity Analysis</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Attendance</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Screenshots</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Productivity Reports</span>
                                                <span class="d-flex align-items-center mb-0 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>2FA</span>
                                            </div>
                                            <button class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#checkout_card">Subscribe Now</button>
                                        </div> <!-- end card body -->
                                    </div> <!-- end card -->
                                </div> <!-- end col -->

                                <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                                    <div class="card mb-0 flex-fill">
                                        <div class="card-body">
                                            <div class="card bg-light rounded border-0 text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title fs-16 fw-bold mb-2">Enterprise Plan</h5>
                                                    <h3 class="text-dark mb-2 fs-28">$99.00 <small class="text-muted fs-14 fw-normal">/ Per Month</small></h3>
                                                    <p class="mb-0">Basic Feature for up to <span class="text-dark">33</span> users</p>
                                                </div>
                                            </div>
                                            <h6 class="fs-14 mb-1">Features Includes</h6>
                                            <p class="mb-3 text-body">Includes in this Basic plan</p>
                                            <div class="mb-4">
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Apps & Web Activity Analysis</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Productivity Reports</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Work Type Report</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>HRIS Integrations</span>
                                                <span class="d-flex align-items-center mb-0 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Stealth mode</span>
                                            </div>
                                            <button class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#checkout_card">Subscribe Now</button>
                                        </div> <!-- end card body -->
                                    </div> <!-- end card -->
                                </div> <!-- end col -->

                            </div>
                            <!-- end row -->
                        </div>
                        <div class="tab-pane" id="profile2">
                            <!-- start row -->
                            <div class="row justify-content-center row-gap-3">

                                <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                                    <div class="card mb-0 flex-fill">
                                        <div class="card-body">
                                            <div class="card bg-light rounded border-0 text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title fs-16 fw-bold mb-2">Basic Plan</h5>
                                                    <h3 class="text-dark mb-2 fs-28">$129.00 <small class="text-muted fs-14 fw-normal">/ Year</small></h3>
                                                    <p class="mb-0">Basic Feature for up to <span class="text-dark">10</span> users</p>
                                                </div>
                                            </div>
                                            <h6 class="fs-14 mb-1">Features Includes</h6>
                                            <p class="mb-3 text-body">Includes in this Basic plan</p>
                                            <div class="mb-4">
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Apps & Web Activity Analysis</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Attendance</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Screenshots</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Productivity Reports</span>
                                                <span class="d-flex align-items-center mb-0 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Work Type Report</span>
                                            </div>
                                            <button class="btn btn-primary w-100">Current Plan</button>
                                        </div> <!-- end card body -->
                                    </div> <!-- end card -->
                                </div> <!-- end col -->

                                <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                                    <div class="card mb-0 flex-fill">
                                        <div class="card-body">
                                            <div class="card bg-light rounded border-0 text-center position-relative">
                                                <div class="card-body">
                                                    <span class="badge bg-pink custom-badge">Recommended</span>
                                                    <h5 class="card-title fs-16 fw-bold mb-2">Business Plan</h5>
                                                    <h3 class="text-dark mb-2 fs-28">$169.00 <small class="text-muted fs-14 fw-normal">/ Year</small></h3>
                                                    <p class="mb-0">Basic Feature for up to <span class="text-dark">22</span> users</p>
                                                </div>
                                            </div>
                                            <h6 class="fs-14 mb-1">Features Includes</h6>
                                            <p class="mb-3 text-body">Includes in this Business plan</p>
                                            <div class="mb-4">
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Apps & Web Activity Analysis</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Attendance</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Screenshots</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Productivity Reports</span>
                                                <span class="d-flex align-items-center mb-0 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>2FA</span>
                                            </div>
                                            <button class="btn btn-dark w-100">Subscribe Now</button>
                                        </div> <!-- end card body -->
                                    </div> <!-- end card -->
                                </div> <!-- end col -->

                                <div class="col-xl-4 col-lg-6 col-md-6 d-flex">
                                    <div class="card mb-0 flex-fill">
                                        <div class="card-body">
                                            <div class="card bg-light rounded border-0 text-center">
                                                <div class="card-body">
                                                    <h5 class="card-title fs-16 fw-bold mb-2">Enterprise Plan</h5>
                                                    <h3 class="text-dark mb-2 fs-28">$1199.00 <small class="text-muted fs-14 fw-normal">/ Year</small></h3>
                                                    <p class="mb-0">Basic Feature for up to <span class="text-dark">33</span> users</p>
                                                </div>
                                            </div>
                                            <h6 class="fs-14 mb-1">Features Includes</h6>
                                            <p class="mb-3 text-body">Includes in this Basic plan</p>
                                            <div class="mb-4">
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Apps & Web Activity Analysis</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Productivity Reports</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Work Type Report</span>
                                                <span class="d-flex align-items-center mb-2 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>HRIS Integrations</span>
                                                <span class="d-flex align-items-center mb-0 text-body"><i class="ti ti-circle-check-filled text-success me-2"></i>Stealth mode</span>
                                            </div>
                                            <button class="btn btn-dark w-100">Subscribe Now</button>
                                        </div> <!-- end card body -->
                                    </div> <!-- end card -->
                                </div> <!-- end col -->

                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Checkout Card -->
    <div class="modal fade" id="checkout_card">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="plans-and-billings">
                    <div class="modal-body">

                        <!-- start row -->
                        <div class="row row-gap-3">
                            <div class="col-lg-6">
                                <h6 class="mb-4 fs-16 fw-bold">Basic Information</h6>
                                <div class="row row-gap-3 mb-4 pb-4 border-bottom">
                                    <div class="col-lg-6">
                                        <div>
                                            <label class="form-label">First Name<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="Kevin Reynolds">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <label class="form-label">Last Name<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="Osborne">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="stevenosborne@example.com">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div>
                                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                            <input type="tel" class="form-control phone" name="phone">
                                        </div>
                                    </div>
                                </div>
                                <h6 class="mb-4 fs-16 fw-bold">Address Information</h6>
                                <!-- start row -->
                                <div class="row row-gap-3">
                                    <div class="col-md-12">
                                        <div>
                                            <label class="form-label">Address<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="87 Griffin Street">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="form-label">Country<span class="text-danger ms-1">*</span></label>
                                            <select class="select">
                                                <option>United States</option>
                                                <option>Canada</option>
                                                <option>Germany</option>
                                                <option>France</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="form-label">State</label>
                                            <select class="select">
                                                <option>California</option>
                                                <option>New York</option>
                                                <option>Texas</option>
                                                <option>Florida</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="form-label">City<span class="text-danger ms-1">*</span></label>
                                            <select class="select">
                                                <option>Los Angeles</option>
                                                <option>San Diego</option>
                                                <option>Fresno</option>
                                                <option>San Francisco</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <label class="form-label">Postal Code<span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" value="90001">
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </div>
                            <div class="col-lg-6 d-flex">
                                <div class="card bg-light rounded border-0 flex-fill mb-0">
                                    <div class="card-body d-flex flex-column justify-content-between gap-3">
                                        <div>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="mb-3 fs-16 fw-bold">Subscription Details</h6>
                                                    <p class="d-flex align-items-center justify-content-between mb-2 text-body">Plan Name <span class="text-dark fw-medium"> Basic</span> </p>
                                                    <p class="d-flex align-items-center justify-content-between mb-2 text-body">Plan Amount <span class="text-dark fw-medium"> $19.99</span> </p>
                                                    <p class="d-flex align-items-center justify-content-between mb-0 text-body">Tax <span class="text-dark fw-medium"> $0.00</span> </p>
                                                    <h6 class="fw-bold fs-16 mt-3 pt-3 border-top text-body d-flex align-items-center justify-content-between mb-0">Total <span class="text-dark fw-bold"> $19.99</span></h6>
                                                </div>
                                            </div>
                                            <div class="py-2 px-3 rounded border border-success">
                                                <div class="d-flex align-items-center flex-wrap gap-2">
                                                    <img src="/assets/img/icons/shield-icon.svg" alt="shield-icon">
                                                    <div>
                                                        <h6 class="fs-14 mb-1">100% Seucred Payment Guarantee</h6>
                                                        <p class="mb-0">You can confidently complete your purchase that info is safe.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#purchase-details">Pay $29.00</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_card">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-4 fs-14">Are you sure to delete card?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="plans-and-billings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'project-details-milestones-grid') { ?>
    <!-- Start Add Manual Time -->
    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones-grid">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Manual Time -->

    <!-- Start Edit Manual Time -->
    <div id="edit-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones-grid">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Manual Time -->

    <!-- Start Add Milestone -->
    <div id="add-milestone" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Milestone</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones-grid">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Assignee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="input-block mb-0">
                                        <label class="form-label">No of Days</label>
                                        <input type="text" class="form-control" placeholder="0" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Milestone</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Milestone -->

    <!-- Start Edit Milestone -->
    <div id="edit-milestone" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Milestone</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones-grid">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Project Kickoff">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Assignee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="input-block mb-0">
                                        <label class="form-label">No of Days</label>
                                        <input type="text" class="form-control" placeholder="10" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Milestone -->

    <!-- Start Delete Milestone -->
    <div class="modal fade" id="delete-milestone">
        <div class="modal-dialog modal-dialog-centered modal-md modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to delete milestone?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="project-details-milestones" class="btn  btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Milestone -->
<?php }?>

<?php if ($page == 'project-details-milestones') { ?>
    <!-- Start Add Manual Time -->
    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Manual Time -->

    <!-- Start Edit Manual Time -->
    <div id="edit-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Manual Time -->

    <!-- Start Add Milestone -->
    <div id="add-milestone" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Milestone</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Assignee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="input-block mb-0">
                                        <label class="form-label">No of Days</label>
                                        <input type="text" class="form-control" placeholder="0" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Milestone</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Milestone -->

    <!-- Start Edit Milestone -->
    <div id="edit-milestone" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Milestone</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Project Kickoff">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Assignee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="input-block mb-0">
                                        <label class="form-label">No of Days</label>
                                        <input type="text" class="form-control" placeholder="10" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Milestone -->

    <!-- Start Delete Milestone -->
    <div class="modal fade" id="delete-milestone">
        <div class="modal-dialog modal-dialog-centered modal-md modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to delete milestone?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn  btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="project-details-milestones" class="btn  btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Milestone -->
<?php }?>

<?php if ($page == 'project-details-milestones') { ?>
    <!-- Start Add Manual Time -->
    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Manual Time -->

    <!-- Start Edit Manual Time -->
    <div id="edit-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Manual Time -->

    <!-- Start Add Milestone -->
    <div id="add-milestone" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Milestone</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Assignee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="input-block mb-0">
                                        <label class="form-label">No of Days</label>
                                        <input type="text" class="form-control" placeholder="0" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Milestone</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Milestone -->

    <!-- Start Edit Milestone -->
    <div id="edit-milestone" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Milestone</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-milestones">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Project Kickoff">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Assignee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="input-block mb-0">
                                        <label class="form-label">No of Days</label>
                                        <input type="text" class="form-control" placeholder="10" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Milestone -->

    <!-- Start Delete Milestone -->
    <div class="modal fade" id="delete-milestone">
        <div class="modal-dialog modal-dialog-centered modal-md modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to delete milestone?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn  btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="project-details-milestones" class="btn  btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Milestone -->
<?php }?>

<?php if ($page == 'project-details-screenshots') { ?>
    <!-- Start Assign Employee -->
    <div id="assign-employee" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Employee</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-screenshots">
                    <div class="modal-body pb-1">
                        <div class="mb-3">
                            <label class="form-label">Team <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UI / UX Team</option>
                                <option>HTML</option>
                                <option>React</option>
                                <option>Angular</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Employee <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Shaun Farley</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                                <option>Karen Flores</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Assign Employees</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Assign Employee -->

    <!-- Start Add Manual Time -->
    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-screenshots">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Manual Time -->

    <!-- Start Edit Manual Time -->
    <div id="edit-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-screenshots">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Manual Time -->

    <!-- Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-screenshots">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->

    <!-- Edit task -->
    <div id="edit-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="project-details-screenshots">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Creating Application Modules">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-role="tagsinput" name="specialist" value="design">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-md me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit task -->

    <!-- Start Delete Task -->
    <div class="modal fade" id="delete-task">
        <div class="modal-dialog modal-dialog-centered modal-md modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to delete task?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn  btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="project-details-task" class="btn  btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Task -->

    <!-- Start Project Details -->
    <div class="modal fade" id="project-details">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between w-100">
                        <h4 class="modal-title">Task Detail</h4>
                        <div class="d-flex align-items-center">
                            <div>
                                <select class="select">
                                    <option>Completed</option>
                                    <option>Active</option>
                                    <option>On Hold</option>
                                </select>
                            </div>
                            <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                        </div>
                    </div>
                </div>
                <form action="project-details-screenshots">
                    <div class="modal-body">
                        <div class="row mb-3 row-gap-3">
                            <div class="col-md-12">
                                <span>Project</span>
                                <h6 class="mt-1 fw-normal">Hospital Administration</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Created on</span>
                                <h6 class="mt-1 fw-normal">14 Nov 2026</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Started on</span>
                                <h6 class="mt-1 fw-normal">15 Jan 2026</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Due Date</span>
                                <h6 class="mt-1 fw-normal">15 Nov 2026</h6>
                            </div>
                        </div>
                        <div class="card bg-light-500 shadow-none mb-2">
                            <div class="card-body">
                                <span class="badge badge-sm bg-danger mb-2"><i class="ti ti-point-filled me-1"></i>High</span>
                                <h5 class="mb-2">Patient and Doctor Video Conferencing Module</h5>
                                <span class="d-flex mb-3">The Enhanced Patient Management System (EPMS) project aims to modernize and streamline the patient management processes within. By integrating advanced technologies and optimizing existing workflows, the project seeks to improve patient care, enhance operational efficiency, and ensure compliance with regulatory standards.</span>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="fw-medium">Employee</h5>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                    <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-10"><a href="#">Catherine</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="fw-medium">Tags</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <a href="#" class="badge badge-sm bg-info rounded-pill text-white">Admin Panel</a>
                                            <a href="#" class="badge badge-sm bg-info rounded-pill text-white">High Tech</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Project Details -->
<?php }?>

<?php if ($page == 'project-details-task-list') { ?>
    <!-- Start Assign Employee -->
    <div id="assign-employee" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Employee</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-task-list">
                    <div class="modal-body pb-1">
                        <div class="mb-3">
                            <label class="form-label">Team <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UI / UX Team</option>
                                <option>HTML</option>
                                <option>React</option>
                                <option>Angular</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Employee <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Shaun Farley</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                                <option>Karen Flores</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Assign Employees</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Assign Employee -->

    <!-- Start Add Manual Time -->
    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-task-list">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Manual Time -->

    <!-- Start Edit Manual Time -->
    <div id="edit-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-task-list">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Manual Time -->

    <!-- Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-task-list">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->

    <!-- Edit task -->
    <div id="edit-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="project-details-task-list">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Creating Application Modules">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-role="tagsinput" name="specialist" value="design">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-md me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit task -->

    <!-- Start Delete Task -->
    <div class="modal fade" id="delete-task">
        <div class="modal-dialog modal-dialog-centered modal-md modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to delete task?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="project-details-task-list" class="btn btn-sm btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Task -->

    <!-- Start Project Details -->
    <div class="modal fade" id="project-details">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between w-100">
                        <h4 class="modal-title">Task Detail</h4>
                        <div class="d-flex align-items-center">
                            <div>
                                <select class="select">
                                    <option>Completed</option>
                                    <option>Active</option>
                                    <option>On Hold</option>
                                </select>
                            </div>
                            <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                        </div>
                    </div>
                </div>
                <form action="project-details-task-list">
                    <div class="modal-body">
                        <div class="row mb-3 row-gap-3">
                            <div class="col-md-12">
                                <span>Project</span>
                                <h6 class="mt-1 fw-normal">Hospital Administration</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Created on</span>
                                <h6 class="mt-1 fw-normal">14 Nov 2026</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Started on</span>
                                <h6 class="mt-1 fw-normal">15 Jan 2026</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Due Date</span>
                                <h6 class="mt-1 fw-normal">15 Nov 2026</h6>
                            </div>
                        </div>
                        <div class="card bg-light-500 shadow-none mb-2">
                            <div class="card-body">
                                <span class="badge badge-sm bg-danger mb-2"><i class="ti ti-point-filled me-1"></i>High</span>
                                <h5 class="mb-2">Patient and Doctor Video Conferencing Module</h5>
                                <span class="d-flex mb-3">The Enhanced Patient Management System (EPMS) project aims to modernize and streamline the patient management processes within. By integrating advanced technologies and optimizing existing workflows, the project seeks to improve patient care, enhance operational efficiency, and ensure compliance with regulatory standards.</span>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="fw-medium">Employee</h5>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                    <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-10"><a href="#">Catherine</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="fw-medium">Tags</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <a href="#" class="badge badge-sm bg-info rounded-pill text-white">Admin Panel</a>
                                            <a href="#" class="badge badge-sm bg-info rounded-pill text-white">High Tech</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Project Details -->
<?php }?>

<?php if ($page == 'project-details-task') { ?>
    <!-- Start Assign Employee -->
    <div id="assign-employee" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Employee</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-task">
                    <div class="modal-body pb-1">
                        <div class="mb-3">
                            <label class="form-label">Team <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UI / UX Team</option>
                                <option>HTML</option>
                                <option>React</option>
                                <option>Angular</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Employee <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Shaun Farley</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                                <option>Karen Flores</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Assign Employees</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Assign Employee -->

    <!-- Start Add Manual Time -->
    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-task">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Manual Time -->

    <!-- Start Edit Manual Time -->
    <div id="edit-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-task">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Manual Time -->

    <!-- Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-task">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->

    <!-- Edit task -->
    <div id="edit-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="project-details-task">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Creating Application Modules">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-role="tagsinput" name="specialist" value="design">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-md me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit task -->

    <!-- Start Delete Task -->
    <div class="modal fade" id="delete-task">
        <div class="modal-dialog modal-dialog-centered modal-md modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to delete task?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn  btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="project-details-task" class="btn  btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Task -->

    <!-- Start Project Details -->
    <div class="modal fade" id="project-details">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between w-100">
                        <h4 class="modal-title">Task Detail</h4>
                        <div class="d-flex align-items-center">
                            <div>
                                <select class="select">
                                    <option>Completed</option>
                                    <option>Active</option>
                                    <option>On Hold</option>
                                </select>
                            </div>
                            <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                        </div>
                    </div>
                </div>
                <form action="project-details-task">
                    <div class="modal-body">
                        <div class="row mb-3 row-gap-3">
                            <div class="col-md-12">
                                <span>Project</span>
                                <h6 class="mt-1 fw-normal">Hospital Administration</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Created on</span>
                                <h6 class="mt-1 fw-normal">14 Nov 2026</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Started on</span>
                                <h6 class="mt-1 fw-normal">15 Jan 2026</h6>
                            </div>
                            <div class="col-md-4">
                                <span>Due Date</span>
                                <h6 class="mt-1 fw-normal">15 Nov 2026</h6>
                            </div>
                        </div>
                        <div class="card bg-light-500 shadow-none mb-2">
                            <div class="card-body">
                                <span class="badge badge-sm bg-danger mb-2"><i class="ti ti-point-filled me-1"></i>High</span>
                                <h5 class="mb-2">Patient and Doctor Video Conferencing Module</h5>
                                <span class="d-flex mb-3">The Enhanced Patient Management System (EPMS) project aims to modernize and streamline the patient management processes within. By integrating advanced technologies and optimizing existing workflows, the project seeks to improve patient care, enhance operational efficiency, and ensure compliance with regulatory standards.</span>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5 class="fw-medium">Employee</h5>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <a href="javascript:void(0);" class="avatar avatar-sm avatar-rounded">
                                                    <img src="/assets/img/users/user-05.jpg" class="img-fluid" alt="img">
                                                </a>
                                                <div class="ms-2">
                                                    <h6 class="fw-medium fs-10"><a href="#">Catherine</a></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="fw-medium">Tags</h5>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <a href="#" class="badge badge-sm bg-info rounded-pill text-white">Admin Panel</a>
                                            <a href="#" class="badge badge-sm bg-info rounded-pill text-white">High Tech</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Project Details -->
<?php }?>

<?php if ($page == 'project') { ?>
    <!-- Start Assign Employee -->
    <div id="assign-employee" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Assign Employee</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-usage">
                    <div class="modal-body pb-1">
                        <div class="mb-3">
                            <label class="form-label">Team <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UI / UX Team</option>
                                <option>HTML</option>
                                <option>React</option>
                                <option>Angular</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Employee <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Shaun Farley</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                                <option>Karen Flores</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Assign Employees</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Assign Employee -->

    <!-- Start Add Manual Time -->
    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-usage">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Manual Time -->

    <!-- Start Edit Manual Time -->
    <div id="edit-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details-usage">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto position-relative input-group-flat">
                                        <input type="text" class="form-control form-control" data-provider="timepickr" data-time-basic="true" placeholder="-- : --">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Manual Time -->
<?php }?>

<?php if ($page == 'project-details') { ?>
    <div id="assign-employee" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mb-0">Assign Employee</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details">
                    <div class="modal-body pb-1">
                        <div class="mb-3">
                            <label class="form-label">Team <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UI / UX Team</option>
                                <option>HTML</option>
                                <option>React</option>
                                <option>Angular</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Employee <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Shaun Farley</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                                <option>Karen Flores</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light  me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Assign Employees</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal dialog -->
    </div> <!-- end modal -->

    <div id="add-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mb-0">Add Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Creating Application Modules</option>
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" class="form-control" placeholder="--:-- --" data-provider="timepickr" data-time-basic="true">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" class="form-control" placeholder="--:-- --" data-provider="timepickr" data-time-basic="true">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2 " data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Add Manual Time</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal dialog -->
    </div> <!-- end modal -->

    <div id="edit-manual-time" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mb-0">Edit Manual Time</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-x"></i></button>
                </div>
                <form action="project-details">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Project Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Office Management</option>
                                <option>Service Management App</option>
                                <option>Advanced Booking System</option>
                                <option>Food Order App</option>
                                <option>Truelysell</option>
                                <option>Doccure</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Task Name <span class="text-danger">*</span></label>
                            <select class="select">
                                <option>Develop Workflows & Rules</option>
                                <option>Ad Setup & Campaign Management</option>
                                <option>Integration & API Testing</option>
                                <option>Performance Monitoring & Optimization</option>
                                <option>Testing & Bug Fixing</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" class="form-control" placeholder="--:-- --" data-provider="timepickr" data-time-basic="true" value="09:00">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" class="form-control" placeholder="--:-- --" data-provider="timepickr" data-time-basic="true" value="19:00">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock-hour-3"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Duration<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="09h 05m 14s" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Reason for Manual Time<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2 " data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Save Changes</button>
                    </div>
                </form>
            </div>
        </div> <!-- end modal dialog -->
    </div> <!-- end modal -->  
    
    <!-- Delete Modal Content -->
    <div class="modal fade" id="delete_employee">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3">Are you sure to Remove employee?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn  btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="project-details" class="btn  btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'projects-grid') { ?>
    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="add_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">New Project</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
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
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Client<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Project Code<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Start Month<span class="text-danger ms-1">*</span></label>
                            <div class="input-group w-auto input-group-flat">
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                            <div class="input-group w-auto input-group-flat">
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y">
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
                                <option>Fixed</option>
                                <option>Hourly</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Active</option>
                                <option>Inprogress</option>
                                <option>Completed</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Members<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Shaun Farley</option>
                                <option>John Doe</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Team Lead<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>John Mitchell</option>
                                <option>Lisa Thompson</option>
                                <option>Michael Rodriguez</option>
                                <option>Sarah Lee</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">Project Description<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-primary">  Add New Project</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- start offcanvas -->
    <div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="edit_new">
        <div class="offcanvas-header d-block border-bottom">
            <div class="d-flex align-items-center justify-content-between">
            <h5 class="offcanvas-title fs-18 fw-bold">Edit Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
        </div>
        <div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                        <img class="rounded-circle" src="./assets/img/icons/project-logo2.svg" alt="img">
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
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Clinic Management">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Client<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Brian Thompson">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Project Code<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="#PR0002">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Start Month<span class="text-danger ms-1">*</span></label>
                            <div class="input-group w-auto input-group-flat">
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" value="02 Dec 2026">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                            <div class="input-group w-auto input-group-flat">
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" value="10 Dec 2026">
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
                                <option selected>Fixed</option>
                                <option>Hourly</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Active</option>
                                <option selected>Inprogress</option>
                                <option>Completed</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Members<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Shaun Farley</option>
                                <option>John Doe</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Team Lead<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>John Mitchell</option>
                                <option>Lisa Thompson</option>
                                <option>Michael Rodriguez</option>
                                <option>Sarah Lee</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">Project Description<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4">Manage patient records, appointments, prescriptions, and billing seamlessly.</textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-primary"> Save Changes</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="view_details">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Project Details</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <div class="card bg-light border-0">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-lg-between">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="avatar avatar-xxl rounded-circle flex-shrink-0">
                                    <img class="rounded-circle" src="./assets/img/profiles/avatar-13.jpg" alt="img">
                                </div>
                                <div class="text-start">
                                    <span class="badge bg-danger mb-1 d-inline-flex align-items-center gap-1"> <i class="ti ti-point-filled"></i> High</span>
                                    <h6 class="fs-16 fw-bold mb-0">Clinic Management</h6>
                                </div>
                            </div>
                            <div class="mb-0">
                                <select class="select">
                                    <option>Inprogress</option>
                                    <option>Active</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Details</h6>
                <div class="table-responsive mb-4">
                    <table class="table table-nowrap bg-white border mb-0">
                        <tbody>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Project Code</h6></td>
                                <td>#PR2145</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Members</h6></td>
                                <td><div class="avatar-list-stacked avatar-group-sm">
                                    <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-03.jpg" alt="img"></span>
                                    <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-06.jpg" alt="img"></span>
                                    <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-02.jpg" alt="img"></span>
                                    <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                </div></td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Total Worked Hours</h6></td>
                                <td><span class="badge badge-soft-success">72</span></td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Start Date</h6></td>
                                <td>24 Dec 2026</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Due Date</h6></td>
                                <td>24 Dec 2026</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Budget</h6></td>
                                <td>$42,000</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Project Type</h6></td>
                                <td>Fixed</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Client</h6></td>
                                <td>Andrews Simon</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
                <h6 class="mb-3 fs-16 fw-bold">About Project</h6>
                <p class="mb-0">Manage patient records, appointments, prescriptions, and billing with an intuitive interface..</p>
            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-light">  Edit</a>
            <a href="javascript:void(0);" class="btn btn-danger">  Delete</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete project?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="projects-grid" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'projects') { ?>
    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="add_new">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">New Project</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle me-3 border flex-shrink-0">
                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
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
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Client<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Project Code<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Start Month<span class="text-danger ms-1">*</span></label>
                            <div class="input-group w-auto input-group-flat">
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                            <div class="input-group w-auto input-group-flat">
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y">
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
                                <option>Fixed</option>
                                <option>Hourly</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Active</option>
                                <option>Inprogress</option>
                                <option>Completed</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Members<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Shaun Farley</option>
                                <option>John Doe</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Team Lead<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>John Mitchell</option>
                                <option>Lisa Thompson</option>
                                <option>Michael Rodriguez</option>
                                <option>Sarah Lee</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">Project Description<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-primary">  Add New Project</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- start offcanvas -->
    <div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="edit_new">
        <div class="offcanvas-header d-block border-bottom">
            <div class="d-flex align-items-center justify-content-between">
            <h5 class="offcanvas-title fs-18 fw-bold">Edit Project</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
        </div>
        <div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <label class="form-label">Profile Image<span class="text-danger ms-1">*</span></label>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                        <img class="rounded-circle" src="./assets/img/icons/project-logo2.svg" alt="img">
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
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Clinic Management">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Client<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="Brian Thompson">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Project Code<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="#PR0002">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Start Month<span class="text-danger ms-1">*</span></label>
                            <div class="input-group w-auto input-group-flat">
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" value="02 Dec 2026">
                                <span class="input-group-text">
                                    <i class="ti ti-calendar"></i>
                                </span>
                            </div>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                            <div class="input-group w-auto input-group-flat">
                                <input type="text" class="form-control form-control" data-provider="flatpickr" data-date-format="d M, Y" value="10 Dec 2026">
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
                                <option selected>Fixed</option>
                                <option>Hourly</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Active</option>
                                <option selected>Inprogress</option>
                                <option>Completed</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Members<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>Shaun Farley</option>
                                <option>John Doe</option>
                                <option>Jenny Ellis</option>
                                <option>Leon Baxter</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Team Lead<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option selected>John Mitchell</option>
                                <option>Lisa Thompson</option>
                                <option>Michael Rodriguez</option>
                                <option>Sarah Lee</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">Project Description<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4">Manage patient records, appointments, prescriptions, and billing seamlessly.</textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-primary"> Save Changes</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- start offcanvas -->
	<div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="view_details">
		<div class="offcanvas-header d-block border-bottom">
			<div class="d-flex align-items-center justify-content-between">
			<h5 class="offcanvas-title fs-18 fw-bold">Project Details</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
		</div>
		<div class="offcanvas-body">
            <div>
                <div class="card bg-light border-0">
                    <div class="card-body text-center">
                        <div class="d-flex align-items-center gap-2 flex-wrap justify-content-lg-between">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="avatar avatar-xxl rounded-circle flex-shrink-0">
                                    <img class="rounded-circle" src="./assets/img/profiles/avatar-13.jpg" alt="img">
                                </div>
                                <div class="text-start">
                                    <span class="badge bg-danger mb-1 d-inline-flex align-items-center gap-1"> <i class="ti ti-point-filled"></i> High</span>
                                    <h6 class="fs-16 fw-bold mb-0">Clinic Management</h6>
                                </div>
                            </div>
                            <div class="mb-0">
                                <select class="select">
                                    <option>Inprogress</option>
                                    <option>Active</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Details</h6>
                <div class="table-responsive mb-4">
                    <table class="table table-nowrap bg-white border mb-0">
                        <tbody>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Project Code</h6></td>
                                <td>#PR2145</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Members</h6></td>
                                <td><div class="avatar-list-stacked avatar-group-sm">
                                    <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-03.jpg" alt="img"></span>
                                    <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-06.jpg" alt="img"></span>
                                    <span class="avatar avatar-rounded"><img class="border border-white" src="assets/img/profiles/avatar-02.jpg" alt="img"></span>
                                    <a class="avatar bg-primary avatar-rounded text-white fs-10 fw-medium" href="javascript:void(0);">+1</a>
                                </div></td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Total Worked Hours</h6></td>
                                <td><span class="badge badge-soft-success">72</span></td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Start Date</h6></td>
                                <td>24 Dec 2026</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Due Date</h6></td>
                                <td>24 Dec 2026</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Budget</h6></td>
                                <td>$42,000</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Project Type</h6></td>
                                <td>Fixed</td>
                            </tr>
                            <tr>
                                <td><h6 class="mb-0 fs-14 fw-medium">Client</h6></td>
                                <td>Andrews Simon</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->
                <h6 class="mb-3 fs-16 fw-bold">About Project</h6>
                <p class="mb-0">Manage patient records, appointments, prescriptions, and billing with an intuitive interface..</p>
            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-light">  Edit</a>
            <a href="javascript:void(0);" class="btn btn-danger">  Delete</a>
        </div>
    </div>
    <!-- end offcanvas -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete project?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="projects" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'roles-permissions') { ?>
    <!-- Start Add Role -->
    <div class="modal fade" id="add-role">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-18 fw-bold">Add Role</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="roles-permissions">
                    <div class="modal-body">
                        <div>
                            <label class="form-label">Role Name <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Role -->

    <!-- Start Edit Role -->
    <div class="modal fade" id="edit-role">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-18 fw-bold">Edit Role</h5>
                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="roles-permissions">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Role Name <span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" value="User">
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="form-label mb-0">Status</span>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Role -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_role">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to remove role?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="roles-permissions" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'search-results') { ?>
    <!-- Start Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->
<?php }?>

<?php if ($page == 'security-settings') { ?>
    <!-- Code Delivery Modal -->
    <div class="modal fade" id="two-step-verification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Code Delivery Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <h6 class="fs-16 fw-bold">How would you like to get your codes?</h6>
                        <p class="mb-3">You'll need a authentication code when signing in to your account.</p>
                        <a href="javascript:void(0);" class="fs-14 fw-semibold text-dark p-2 rounded verify-item mb-3 d-block position-relative" data-bs-toggle="modal" data-bs-target="#sms-verification">
                            SMS text message
                            <span class="fs-14 text-body d-block mt-1 fw-normal">Receive a text message to your mobile device when signing in.</span>
                            <i class="ti ti-check position-absolute"></i>
                        </a>
                        <a href="javascript:void(0);" class="fs-14 fw-semibold text-dark p-2 rounded verify-item d-block position-relative" data-bs-toggle="modal" data-bs-target="#email-verification">
                            Email Authentication
                            <span class="fs-14 text-body d-block mt-1 fw-normal">Receive a Email to your Registered Email Address.</span>
                            <i class="ti ti-check position-absolute"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Code Sms Modal -->
    <div class="modal fade" id="sms-verification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add SMS Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="javascript:void(0);">
                    <div class="modal-body">
                        <p class="mb-3">We'll send a time sensitive authentication code to your mobile phone via text message when you're signing in.</p>
                        <div class="mb-0">
                            <div class="input-blocks">
                                <label class="form-label">Current Phone Number <span class="text-danger ms-1">*</span></label>
                                <input class="form-control phone" name="phone" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sms-verification-code">Add Phone Number</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Code Sms Modal -->
    <div class="modal fade" id="sms-verification-code">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verify SMS Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <p class="mb-3">We'll send a time sensitive authentication code to your mobile phone via text message when you're signing in.</p>
                        <div class="mb-0">
                            <div class="input-blocks mb-2">
                                <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                <input class="form-control phone bg-light" name="phone" type="text">
                            </div>
                            <a href="javascript:void(0);" class="text-decoration-underline text-primary">Edit Phone Number</a>
                            <div class="mt-3">
                                <label class="form-label mb-2">We've sent a 6 digit verification code to the number above<span class="text-danger ms-1">*</span></label>
                                <div class="input-blocks custom-input-settings mb-2">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <p class="mb-0 fs-14 text-body">Didn't receive code? <a href="javascript:void(0);" class="text-decoration-underline text-primary">Resend code</a></p>
                                    <span class="badge badge-soft-danger fs-12">01:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Verify Code & Enable</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Code Email Modal -->
    <div class="modal fade" id="email-verification1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Email Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="javascript:void(0);">
                    <div class="modal-body">
                        <p class="mb-3">We'll send a time sensitive authentication code to your email message when you're signing in.</p>
                        <div class="mb-0">
                            <div class="input-blocks">
                                <label class="form-label">Email <span class="text-danger ms-1">*</span></label>
                                <input class="form-control" name="email" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#email-verification-code">Add Email Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Code Sms Modal -->
    <div class="modal fade" id="email-verification-code">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verify Email Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <p class="mb-3">We'll send a time sensitive authentication code to your email message when you're signing in.</p>
                        <div class="mb-0">
                            <div class="input-blocks mb-2">
                                <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                <input class="form-control bg-light" type="text" value="stevenosborne@example.com">
                            </div>
                            <a href="javascript:void(0);" class="text-decoration-underline text-primary">Edit Email Number</a>
                            <div class="mt-3">
                                <label class="form-label mb-2">We've sent a 6 digit verification code to the email above<span class="text-danger ms-1">*</span></label>
                                <div class="input-blocks custom-input-settings mb-2">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <p class="mb-0 fs-14 text-body">Didn't receive code? <a href="javascript:void(0);" class="text-decoration-underline text-primary">Resend code</a></p>
                                    <span class="badge badge-soft-danger fs-12">01:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Verify Code & Enable</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Change Email Modal -->
    <div class="modal fade" id="email-verification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Email Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-blocks">
                                <label class="form-label">Current Email <span class="text-danger ms-1">*</span></label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div>
                                <label class="form-label">New Email <span class="text-danger ms-1">*</span></label>
                                <input class="form-control" type="email">
                            </div>
                            <p class="d-inline-flex align-items-center mt-2 mb-0"><i class="ti ti-info-circle me-1"></i>New email address only updated once you verified </p>
                        </div>
                        <div>
                            <label class="form-label">Current Password <span class="text-danger ms-1">*</span></label>
                            <div class="input-group input-group-flat pass-group">
                                <input type="password" class="form-control pass-input">
                                <span class="input-group-text toggle-password ">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Change Phone Number Modal -->
    <div class="modal fade" id="phone-verification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Phone Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-blocks">
                                <label class="form-label">Current Phone Number <span class="text-danger ms-1">*</span></label>
                                <input class="form-control phone" name="phone" type="text">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div>
                                <label class="form-label">New Phone Number <span class="text-danger ms-1">*</span></label>
                                <input class="form-control phone" name="phone" type="text">
                            </div>
                            <p class="mt-2"><i class="ti ti-info-circle me-1"></i>New phone number only updated once you verified </p>
                        </div>
                        <div>
                            <label class="form-label">Current Password <span class="text-danger ms-1">*</span></label>
                            <div class="input-group input-group-flat pass-group">
                                <input type="password" class="form-control pass-input">
                                <span class="input-group-text toggle-password ">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="javascript:void(0);" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Deactivate -->
    <div class="modal fade" id="deactivate_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-ban fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to deactivate?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="javascript:void(0);" class="btn btn-primary w-100">Deactivate</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->

     <!-- Delete Account -->
     <div class="modal fade" id="delete_account">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <p class="mb-1 fs-16 fw-bold text-dark">Why Are You Deleting Your Account?</p>
                        <p class="fs-14 mb-0">We're sorry to see you go! To help us improve, please let us know your reason for deleting your account</p>
                        <div class="mt-3">
                            <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                            <select class="select"  id="reason-select">
                                <option>Select</option>
                                <option>No longer using the service</option>
                                <option>Privacy concerns</option>
                                <option>Too many notifications/emails</option>
                                <option>Poor user experience</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="mt-3" id="other-reason-box">
                            <label class="form-label">Please Specify<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="3" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'shift-settings') { ?>
    <!-- Add Shift -->
    <div class="modal fade" id="add_shift">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="shift-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Shift Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-0">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Shift</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <!-- end modal -->

    <!-- Edit Shift -->
    <div class="modal fade" id="edit_shift">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="shift-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Shift Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Regular Shift">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-dark fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h6 class="fw-medium mb-3">Are you sure to delete shift?</h6>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="shift-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>

<?php if ($page == 'shifts-leave-types') { ?>
    <!-- Add Custom Field -->
    <div class="modal fade" id="add_shift">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="shifts-leave-types">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Shift Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-0">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-0">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Shift</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Custom Field -->
    <div class="modal fade" id="edit_department">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="shifts-leave-types">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Shift Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="16:45">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fs-16 mb-3">Are you sure to delete shift?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="shifts-leave-types" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'states') { ?>
    <!-- Add State -->
    <div class="modal fade" id="add_states">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add State</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="states">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">State Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Country Name <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>United States</option>
                                        <option>Germany</option>
                                        <option>Canada</option>
                                        <option>Australia</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-sm">Add State</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit State -->
    <div class="modal fade" id="edit_states">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit State</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="states">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">State Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="California">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Country Name <span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option selected>United States</option>
                                        <option>Germany</option>
                                        <option>Canada</option>
                                        <option>Australia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="form-label mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary btn-md">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete state?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="states" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'tasks-archived') { ?>
    <!-- Start Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->
<?php }?>

<?php if ($page == 'tasks-completed') { ?>
    <!-- Start Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->
<?php }?>

<?php if ($page == 'tasks-grid') { ?>
    <!-- Start Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->

    <!-- Start Edit Task -->
    <div id="edit-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Task Management">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option selected>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark fs-13" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark fs-13" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control">Create, assign, track, and manage tasks with deadlines.</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                            <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="design">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete task?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="tasks" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'tasks-onhold') { ?>
    <!-- Start Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->
<?php }?>

<?php if ($page == 'tasks') { ?>
    <!-- Start Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->

    <!-- Start Edit Task -->
    <div id="edit-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Task Management">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option selected>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark fs-13" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark fs-13" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control">Create, assign, track, and manage tasks with deadlines.</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                            <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="design">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete task?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="tasks" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'taxes-settings') { ?>
    <!-- Add Tax -->
    <div class="modal fade" id="add-tax">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="taxes-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Tax Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Tax Rate (%)<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Tax</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Tax -->
    <div class="modal fade" id="edit-tax">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="taxes-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Tax Name <span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="VAT">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Tax Rate (%) <span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="10">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Add Tax -->
    <div class="modal fade" id="add-tax-group">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="taxes-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Tax Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Tax Rate (%)<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Tax</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Tax -->
    <div class="modal fade" id="edit-tax-group">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="taxes-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Tax Name <span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="VAT">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Tax Rate (%) <span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="10">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete-tax">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h6 class="fw-medium mb-3">Are you sure to delete tax?</h6>
                    <div class="d-flex">
                        <button type="button" class="btn btn-md btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="taxes-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>

<?php if ($page == 'teams-grid') { ?>
    <!-- Start Add Teams  -->
    <div class="modal fade" id="add_teams">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-18 fw-bold">Add Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="teams-grid">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Team Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Team Lead<span class="text-danger ms-1">*</span></label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>John Mitchell</option>
                                    <option>Lisa Thompson </option>
                                    <option>Michael Rodriguez</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Employees<span class="text-danger ms-1">*</span></label>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle form-control w-100 d-flex align-items-center justify-content-between" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                                        Select
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg p-2 dropdown-employee w-100">
                                        <li>
                                            <div class="input-group w-auto input-group-flat mb-2">
                                                <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                                                <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                                            </div> 
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Shaun Farley
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Karen Galvan
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Thomas Ward
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Adrian Travon
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Charles Cline
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Team Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Team</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Teams  -->

    <!-- Start Edit Teams  -->
    <div class="modal fade" id="edit_team">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-18 fw-bold">Edit Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="teams-grid">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Team Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Html">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Team Lead<span class="text-danger ms-1">*</span></label>
                                <select class="select">
                                    <option>Select</option>
                                    <option selected>John Mitchell</option>
                                    <option>Lisa Thompson </option>
                                    <option>Michael Rodriguez</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Employees<span class="text-danger ms-1">*</span></label>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle form-control w-100 d-flex align-items-center justify-content-between" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                                        Select
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg p-2 dropdown-employee w-100">
                                        <li>
                                            <div class="input-group w-auto input-group-flat mb-2">
                                                <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                                                <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                                            </div> 
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox" checked>
                                                Shaun Farley
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Karen Galvan
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Thomas Ward
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Adrian Travon
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Charles Cline
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Team Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3">Designs user interfaces and experiences that are intuitive, engaging, and accessible across platforms.</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                                    <label class="form-check-label" for="switchCheckChecked">Status</label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Teams  -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_team">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to remove team?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light  me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="teams-grid" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'teams') { ?>
    <!-- Start Add Teams  -->
    <div class="modal fade" id="add_teams">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-18 fw-bold">Add Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="teams">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Team Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Team Lead<span class="text-danger ms-1">*</span></label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>John Mitchell</option>
                                    <option>Lisa Thompson </option>
                                    <option>Michael Rodriguez</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Employees<span class="text-danger ms-1">*</span></label>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle form-control w-100 d-flex align-items-center justify-content-between" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                                        Select
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg p-2 dropdown-employee w-100">
                                        <li>
                                            <div class="input-group w-auto input-group-flat mb-2">
                                                <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                                                <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                                            </div> 
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Shaun Farley
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Karen Galvan
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Thomas Ward
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Adrian Travon
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Charles Cline
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <label class="form-label">Team Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Team</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Teams  -->

    <!-- Start Edit Teams  -->
    <div class="modal fade" id="edit_team">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-18 fw-bold">Edit Team</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="teams">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Team Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Html">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Team Lead<span class="text-danger ms-1">*</span></label>
                                <select class="select">
                                    <option>Select</option>
                                    <option selected>John Mitchell</option>
                                    <option>Lisa Thompson </option>
                                    <option>Michael Rodriguez</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Employees<span class="text-danger ms-1">*</span></label>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle form-control w-100 d-flex align-items-center justify-content-between" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                                        Select
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg p-2 dropdown-employee w-100">
                                        <li>
                                            <div class="input-group w-auto input-group-flat mb-2">
                                                <span class="input-group-text border-end-0"><i class="ti ti-search"></i></span>
                                                <input type="text" class="form-control form-control-sm" placeholder="Search Keyword">
                                            </div> 
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox" checked>
                                                Shaun Farley
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Karen Galvan
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Thomas Ward
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Adrian Travon
                                            </label>
                                        </li>
                                        <li>
                                            <label class="dropdown-item px-2 d-flex align-items-center rounded-1">
                                                <input class="form-check-input m-0 me-2" type="checkbox">
                                                Charles Cline
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Team Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3">Designs user interfaces and experiences that are intuitive, engaging, and accessible across platforms.</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check form-switch d-flex align-items-center justify-content-between p-0">
                                    <label class="form-check-label" for="switchCheckChecked">Status</label>
                                    <input class="form-check-input" type="checkbox" role="switch" id="switchCheckChecked" checked>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Teams  -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_team">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to remove team?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light  me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="teams" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'testimonials') { ?>
    <!-- Add Testimonials -->
    <div class="modal fade" id="add_testimonials">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="testimonials">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl border text-body rounded-circle me-3 flex-shrink-0 d-flex align-items-center justify-content-center flex-column">
                                        <i class="ti ti-upload fs-14 mb-1"></i>
                                        <span class="fs-14 lh-sm fw-normal">Upload</span>
                                    </div>
                                    <div class="d-inline-flex flex-column align-items-start">
                                        <div class="drag-upload-btn btn btn-sm btn-dark position-relative mb-2">
                                            Upload
                                            <input type="file" class="form-control image-sign" multiple="">
                                        </div>
                                        <span>Recommended size is 80px x 80px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Author<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Role<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>User</option>
                                        <option>Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Content<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Ratings<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>1 Rating</option>
                                        <option>2 Rating</option>
                                        <option>3 Rating</option>
                                        <option>4 Rating</option>
                                        <option>5 Rating</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Add Testimonial</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit Testimonials -->
    <div class="modal fade" id="edit_testimonials">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Testimonial</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="testimonials">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                                        <img class="rounded-circle" src="./assets/img/users/user-13.jpg" alt="img">
                                    </div>
                                    <div class="d-inline-flex flex-column align-items-start">
                                        <div class="drag-upload-btn btn btn-sm btn-dark position-relative mb-2">
                                            Change Image
                                            <input type="file" class="form-control image-sign" multiple="">
                                        </div>
                                        <span>Recommended size is 80px x 80px</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Author<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" value="Johnny Chavez">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Role<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Manager</option>
                                        <option>User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Content<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3">Billing and payroll are now accurate and stress-free, saving hours of manual work.</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Ratings<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>1 Rating</option>
                                        <option>2 Rating</option>
                                        <option>3 Rating</option>
                                        <option>4 Rating</option>
                                        <option>5 Rating</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete modal -->
    <div class="modal fade" id="delete-modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete testimonial?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-sm btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="testimonials" class="btn btn-sm btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'todo-list') { ?>
    <!-- Add Todo -->
    <div class="modal fade" id="add_todo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Todo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="todo-list">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Todo Title</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Tag</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Internal</option>
                                        <option>Projects</option>
                                        <option>Meetings</option>
                                        <option>Reminder</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Medium</option>
                                        <option>High</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Descriptions</label>
                                    <div class="snow-editor"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Add Assignee</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Sophie</option>
                                        <option>Cameron</option>
                                        <option>Doris</option>
                                        <option>Rufana</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-0">
                                    <label class="form-label">Status</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Completed</option>
                                        <option>Pending</option>
                                        <option>Onhold</option>
                                        <option>Inprogress</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add New Todo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Todo end -->

    <!-- Edit Todo -->
    <div class="modal fade" id="edit_todo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Todo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="todo-list">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Todo Title</label>
                                    <input type="text" class="form-control" value="Update calendar and schedule">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Tag</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Internal</option>
                                        <option>Projects</option>
                                        <option>Meetings</option>
                                        <option>Reminder</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>High</option>
                                        <option selected>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label class="form-label">Descriptions</label>
                                    <div class="snow-editor"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Add Assignee</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Sophie</option>
                                        <option>Cameron</option>
                                        <option>Doris</option>
                                        <option>Rufana</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-0">
                                    <label class="form-label">Status</label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Completed</option>
                                        <option>Pending</option>
                                        <option>Onhold</option>
                                        <option>Inprogress</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Todo end -->

    <!-- Start Modal  -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <span class="avatar bg-danger"><i class="ti ti-trash fs-24"></i></span>
                    </div>
                    <h6 class="fs-16 mb-1">Delete Confirmation</h6>
                    <p class="mb-3">Are you sure want to delete?</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <a href="todo-list" class="btn btn-danger">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal  -->
<?php }?>

<?php if ($page == 'todo') { ?>
    <!-- Add Todo -->
    <div class="modal fade" id="add_todo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add To Do</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="todo">
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="select">
                                    <option>Select</option>
                                    <option>Inprogress</option>
                                    <option>On Hold</option>
                                    <option>Pending</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-0">
                                <label class="form-label">Created Date</label>
                                <div class="input-group w-auto input-group-flat">
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-0">
                                <label class="form-label">Due Date</label>
                                <div class="input-group w-auto input-group-flat">
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add To Do</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Todo end -->

    <!-- Edit Todo -->
    <div class="modal fade" id="edit_todo">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Todo</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="todo">
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" value="Update calendar and schedule">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="select">
                                    <option>Select</option>
                                    <option selected>Inprogress</option>
                                    <option>On Hold</option>
                                    <option>Pending</option>
                                    <option>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-0">
                                <label class="form-label">Created Date</label>
                                <div class="input-group w-auto input-group-flat">
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-0">
                                <label class="form-label">Due Date</label>
                                <div class="input-group w-auto input-group-flat">
                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" placeholder="dd/mm/yyyy">
                                    <span class="input-group-text">
                                        <i class="ti ti-calendar"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Todo end -->

    <!-- Start Modal  -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="mb-3">
                        <span class="avatar bg-danger"><i class="ti ti-trash fs-24"></i></span>
                    </div>
                    <h6 class="fs-16 mb-1">Delete Confirmation</h6>
                    <p class="mb-3">Are you sure you want to delete  this to do?</p>
                    <div class="d-flex justify-content-center">
                        <a href="javascript:void(0);" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</a>
                        <a href="todo" class="btn btn-danger">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal  -->
<?php }?>

<?php if ($page == 'user-archived') {   ?>
    <!-- Start Delete -->
    <div class="modal fade" id="delete_user">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete user?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="user-archived" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'user-invite-status') {   ?>
    <!-- Start Delete -->
    <div class="modal fade" id="delete_user">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete user?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="user-invite-status" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'user-leave-approved') {   ?>
    <!-- Add Leave Modal Content -->
    <div class="modal fade" id="add_leave">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="user-leave-approved">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Aliza Duncan</option>
                                        <option>Charles Cline</option>
                                        <option>James Higham</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Annual Leave</option>
                                        <option>Permission</option>
                                        <option>Sick Leave</option>
                                        <option>Maternity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">From Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">To Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 bg-light p-3 rounded-2">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">25 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">26 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            1st Half  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-medium mb-0">27 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- View Approved Modal Content -->
    <div class="modal fade" id="view-approved">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Approved Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Reason</h6>
                    <span>Approved, as attending a graduation ceremony is a significant personal milestone that recognizes the employee's dedication and achievement.</span>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'user-leave-pending') {   ?>
    <!-- Add Leave Modal Content -->
    <div class="modal fade" id="add_leave">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="user-leave-pending">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Aliza Duncan</option>
                                        <option>Charles Cline</option>
                                        <option>James Higham</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Annual Leave</option>
                                        <option>Permission</option>
                                        <option>Sick Leave</option>
                                        <option>Maternity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">From Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">To Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 bg-light p-3 rounded-2">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">25 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">26 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            1st Half  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-medium mb-0">27 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_leave">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to cancel leave?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="javascript:void(0);" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'user-leave-rejected') {   ?>
    <!-- Add Leave Modal Content -->
    <div class="modal fade" id="add_leave">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="user-leave-rejected">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Aliza Duncan</option>
                                        <option>Charles Cline</option>
                                        <option>James Higham</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Leave Type<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Annual Leave</option>
                                        <option>Permission</option>
                                        <option>Sick Leave</option>
                                        <option>Maternity</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">From Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">To Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3 bg-light p-3 rounded-2">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">25 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h6 class="fw-medium mb-0">26 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            1st Half  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h6 class="fw-medium mb-0">27 Jan 2025</h6>
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" class="btn btn-outline-light bg-white text-dark d-inline-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                                            Full Day  <i class="ti ti-chevron-down ms-2"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1st Half</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">1 Day</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">3 Days</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- View Reject Modal Content -->
    <div class="modal fade" id="view-reject">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">View Rejected Reason</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-1">Reason</h6>
                    <span>Request denied as the leave period overlaps with critical work schedules or employees needs.</span>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'user-security-settings'){ ?>
    <!-- Code Delivery Modal -->
    <div class="modal fade" id="two-step-verification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Select Code Delivery Option</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <h6 class="fs-16 fw-bold">How would you like to get your codes?</h6>
                        <p class="mb-3">You'll need a authentication code when signing in to your account.</p>
                        <a href="javascript:void(0);" class="fs-14 fw-semibold text-dark p-2 rounded verify-item mb-3 d-block position-relative" data-bs-toggle="modal" data-bs-target="#sms-verification">
                            SMS text message
                            <span class="fs-14 text-body d-block mt-1 fw-normal">Receive a text message to your mobile device when signing in.</span>
                            <i class="ti ti-check position-absolute"></i>
                        </a>
                        <a href="javascript:void(0);" class="fs-14 fw-semibold text-dark p-2 rounded verify-item d-block position-relative" data-bs-toggle="modal" data-bs-target="#email-verification">
                            Email Authentication
                            <span class="fs-14 text-body d-block mt-1 fw-normal">Receive a Email to your Registered Email Address.</span>
                            <i class="ti ti-check position-absolute"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Code Sms Modal -->
    <div class="modal fade" id="sms-verification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add SMS Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="javascript:void(0);">
                    <div class="modal-body">
                        <p class="mb-3">We'll send a time sensitive authentication code to your mobile phone via text message when you're signing in.</p>
                        <div class="mb-0">
                            <div class="input-blocks">
                                <label class="form-label">Current Phone Number <span class="text-danger ms-1">*</span></label>
                                <input class="form-control phone" name="phone" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sms-verification-code">Add Phone Number</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Code Sms Modal -->
    <div class="modal fade" id="sms-verification-code">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verify SMS Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <p class="mb-3">We'll send a time sensitive authentication code to your mobile phone via text message when you're signing in.</p>
                        <div class="mb-0">
                            <div class="input-blocks mb-2">
                                <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                                <input class="form-control phone bg-light" name="phone" type="text">
                            </div>
                            <a href="javascript:void(0);" class="text-decoration-underline text-primary">Edit Phone Number</a>
                            <div class="mt-3">
                                <label class="form-label mb-2">We've sent a 6 digit verification code to the number above<span class="text-danger ms-1">*</span></label>
                                <div class="input-blocks custom-input-settings mb-2">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <p class="mb-0 fs-14 text-body">Didn't receive code? <a href="javascript:void(0);" class="text-decoration-underline text-primary">Resend code</a></p>
                                    <span class="badge badge-soft-danger fs-12">01:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Verify Code & Enable</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Code Email Modal -->
    <div class="modal fade" id="email-verification1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Email Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="javascript:void(0);">
                    <div class="modal-body">
                        <p class="mb-3">We'll send a time sensitive authentication code to your email message when you're signing in.</p>
                        <div class="mb-0">
                            <div class="input-blocks">
                                <label class="form-label">Email <span class="text-danger ms-1">*</span></label>
                                <input class="form-control" name="email" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#email-verification-code">Add Email Address</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Code Sms Modal -->
    <div class="modal fade" id="email-verification-code">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verify Email Authentication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <p class="mb-3">We'll send a time sensitive authentication code to your email message when you're signing in.</p>
                        <div class="mb-0">
                            <div class="input-blocks mb-2">
                                <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                                <input class="form-control bg-light" type="text" value="stevenosborne@example.com">
                            </div>
                            <a href="javascript:void(0);" class="text-decoration-underline text-primary">Edit Email Number</a>
                            <div class="mt-3">
                                <label class="form-label mb-2">We've sent a 6 digit verification code to the email above<span class="text-danger ms-1">*</span></label>
                                <div class="input-blocks custom-input-settings mb-2">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                    <input type="text" class="form-control">
                                </div>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <p class="mb-0 fs-14 text-body">Didn't receive code? <a href="javascript:void(0);" class="text-decoration-underline text-primary">Resend code</a></p>
                                    <span class="badge badge-soft-danger fs-12">01:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Verify Code & Enable</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Change Email Modal -->
    <div class="modal fade" id="email-verification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Email Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-blocks">
                                <label class="form-label">Current Email <span class="text-danger ms-1">*</span></label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div>
                                <label class="form-label">New Email <span class="text-danger ms-1">*</span></label>
                                <input class="form-control" type="email">
                            </div>
                            <p class="d-inline-flex align-items-center mt-2 mb-0"><i class="ti ti-info-circle me-1"></i>New email address only updated once you verified </p>
                        </div>
                        <div>
                            <label class="form-label">Current Password <span class="text-danger ms-1">*</span></label>
                            <div class="input-group input-group-flat pass-group">
                                <input type="password" class="form-control pass-input">
                                <span class="input-group-text toggle-password ">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Change Phone Number Modal -->
    <div class="modal fade" id="phone-verification">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Phone Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-blocks">
                                <label class="form-label">Current Phone Number <span class="text-danger ms-1">*</span></label>
                                <input class="form-control phone" name="phone" type="text">
                            </div>
                        </div>
                        <div class="mb-3">
                            <div>
                                <label class="form-label">New Phone Number <span class="text-danger ms-1">*</span></label>
                                <input class="form-control phone" name="phone" type="text">
                            </div>
                            <p class="mt-2"><i class="ti ti-info-circle me-1"></i>New phone number only updated once you verified </p>
                        </div>
                        <div>
                            <label class="form-label">Current Password <span class="text-danger ms-1">*</span></label>
                            <div class="input-group input-group-flat pass-group">
                                <input type="password" class="form-control pass-input">
                                <span class="input-group-text toggle-password ">
                                    <i class="ti ti-eye-off"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="javascript:void(0);" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Deactivate -->
    <div class="modal fade" id="deactivate_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-ban fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to deactivate?</h5>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="javascript:void(0);" class="btn btn-primary w-100">Deactivate</a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->

     <!-- Delete Account -->
     <div class="modal fade" id="delete_account">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form>
                    <div class="modal-body">
                        <p class="mb-1 fs-16 fw-bold text-dark">Why Are You Deleting Your Account?</p>
                        <p class="fs-14 mb-0">We're sorry to see you go! To help us improve, please let us know your reason for deleting your account</p>
                        <div class="mt-3">
                            <label class="form-label">Reason<span class="text-danger ms-1">*</span></label>
                            <select class="select"  id="reason-select">
                                <option>Select</option>
                                <option>No longer using the service</option>
                                <option>Privacy concerns</option>
                                <option>Too many notifications/emails</option>
                                <option>Poor user experience</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="mt-3" id="other-reason-box">
                            <label class="form-label">Please Specify<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="3" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->
<?php }?>

<?php if ($page == 'user-tasks-grid'){ ?>
    <!-- Start Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->

    <!-- Start Edit Task -->
    <div id="edit-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Task Management">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option selected>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark fs-13" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark fs-13" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control">Create, assign, track, and manage tasks with deadlines.</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                            <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="design">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete project?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="tasks" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'user-tasks'){ ?>
    <!-- Start Add Task -->
    <div id="add-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Task Name">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                        <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Task</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Task -->

    <!-- Start Edit Task -->
    <div id="edit-task" class="modal fade">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="tasks">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Task Name<span class="text-danger ms-1">*</span></label>
                                    <input class="form-control" type="text" value="Task Management">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Select Employee<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Shaun Farley</option>
                                        <option>Jenny Ellis</option>
                                        <option>Leon Baxter</option>
                                        <option>Karen Flores</option>
                                        <option>Charles Cline</option>
                                        <option>Aliza Duncan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Status<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option selected>Active</option>
                                        <option>Onhold</option>
                                        <option>Archieved</option>
                                        <option>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priority<span class="text-danger ms-1">*</span></label>
                                    <select class="select">
                                        <option>Select</option>
                                        <option>Low</option>
                                        <option selected>High</option>
                                        <option>Medium</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Start Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark fs-13" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Due Date<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-calendar"></i>
                                        </span>
                                        <input type="text" class="form-control text-dark fs-13" data-provider="flatpickr" data-date-format="d.m.y" data-enable-time placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Description<span class="text-danger ms-1">*</span></label>
                                    <textarea class="form-control">Create, assign, track, and manage tasks with deadlines.</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-0">
                                    <div class="input-block mb-0">
                                        <label class="form-label">Tags</label>
                                            <input class="input-tags form-control" type="text" data-choices data-choices-limit="Required Limit" data-choices-removeItem value="design">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
    <!-- End Edit Modal -->

    <!-- Start Delete -->
    <div class="modal fade" id="delete_modal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete project?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="tasks" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'users'){ ?>
    <!-- Start Delete -->
    <div class="modal fade" id="delete_user">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h5 class="fw-medium mb-3 fs-14">Are you sure to delete user?</h5>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="users" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete -->
<?php }?>

<?php if ($page == 'voice-call'){ ?>
    <!-- Add Participent -->
    <div class="modal fade" id="add_participent">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New Participant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="voice-call">
                    <div class="modal-body">
                        <div class="input-group w-auto input-group-flat mb-3">
                            <span class="input-group-text">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="avatar me-2 flex-shrink-0"><img src="/assets/img/profiles/avatar-01.jpg" alt="user" class="img-fluid rounded-circle"></span>
                            <div>
                                <h6 class="fs-14 mb-1">James Hong </h6>
                                <p class="mb-0">+1 54789 31795</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <span class="avatar me-2 flex-shrink-0"><img src="/assets/img/profiles/avatar-02.jpg" alt="user" class="img-fluid rounded-circle"></span>
                            <div>
                                <h6 class="fs-14 mb-1">Daniel Williams </h6>
                                <p class="mb-0">+1 19325 24785</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="avatar me-2 flex-shrink-0"><img src="/assets/img/profiles/avatar-04.jpg" alt="user" class="img-fluid rounded-circle"></span>
                            <div>
                                <h6 class="fs-14 mb-1">Olivia Miller </h6>
                                <p class="mb-0">+1 34852 34985</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Participant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Participent -->
<?php }?>

<?php if ($page == 'widgets'){ ?>
    <!-- start offcanvas -->
    <div class="offcanvas offcanvas-offset offcanvas-end" tabindex="-1"  id="add_new">
        <div class="offcanvas-header d-block border-bottom">
            <div class="d-flex align-items-center justify-content-between">
            <h5 class="offcanvas-title fs-18 fw-bold">Add Member</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i class="ti ti-circle-x"></i></button></div>
        </div>
        <div class="offcanvas-body">
            <div>
                <h6 class="mb-3 fs-16 fw-bold">Basic Information</h6>
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar avatar-xxl rounded-circle me-3 flex-shrink-0">
                        <img class="rounded-circle" src="/assets/img/icons/profile-icon.svg" alt="img">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-start mb-2 gap-2 flex-wrap">
                            <div class="drag-upload-btn btn btn-sm btn-dark position-relative">
                                Change Image
                                <input type="file" class="form-control image-sign" multiple="">
                            </div>
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger">  Remove</a>
                        </div>
                        <span>Recommended size is 300px x 300px</span>
                    </div>
                </div>
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Name<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email Address<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Phone Number<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Experience<span class="text-danger ms-1">*</span></label>
                            <input type="text" class="form-control" >
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Department<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>UX Research</option>
                                <option>DevOps </option>
                                <option>Testing</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Designation<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Frontend Developer</option>
                                <option>DevOps Engineer</option>
                                <option>Test Lead</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Shift<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Morning shift</option>
                                <option>Evening shift</option>
                                <option>Night shift</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Work Location<span class="text-danger ms-1">*</span></label>
                            <select class="select">
                                <option>Select</option>
                                <option>Office</option>
                                <option>Hybrid</option>
                                <option>Remote</option>
                            </select>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-md-12">
                        <div class="mb-0">
                            <label class="form-label">About<span class="text-danger ms-1">*</span></label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
                <h6 class=" fs-16 fw-bold pt-3 my-3 border-top">Address Information</h6>

                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Country</label>
                            <select class="select">
                                <option>United States</option>
                                <option>Canada</option>
                                <option>Germany</option>
                                <option>France</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
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
                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <select class="select">
                                <option>Los Angeles</option>
                                <option>San Diego</option>
                                <option>Fresno</option>
                                <option>San Francisco</option>
                            </select>
                        </div>
                    </div> <!-- end col -->

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control">
                        </div>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>
        <div class="offcanvas-footer">
            <a href="javascript:void(0);" class="btn btn-sm btn-light">  Cancel</a>
            <a href="javascript:void(0);" class="btn btn-sm btn-primary">  Add Member</a>
        </div>
    </div>
    <!-- end offcanvas -->
<?php }?>

<?php if ($page == 'working-hours-settings') {   ?>
    <!-- Add break -->
    <div class="modal fade" id="add_break">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Break</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="working-hours-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Break Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="01:00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-0">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="01:00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add Break</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Edit leave type -->
    <div class="modal fade" id="edit_break">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Break</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="ti ti-circle-x"></i></button>
                </div>
                <form action="working-hours-settings">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Break Name<span class="text-danger ms-1">*</span></label>
                                    <input type="text" class="form-control" value="Morning Break">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 mb-md-0">
                                    <label class="form-label">Start Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="01:00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">End Time<span class="text-danger ms-1">*</span></label>
                                    <div class="input-group w-auto input-group-flat">
                                        <span class="input-group-text">
                                            <i class="ti ti-clock"></i>
                                        </span>
                                        <input type="text" class="form-control" data-provider="timepickr" data-default-time="01:00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="text-dark fw-medium mb-0">Status</span>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input m-0" type="checkbox" checked="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div> <!-- end modal -->

    <!-- Delete -->
    <div class="modal fade" id="#delete_break">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <span class="d-inline-flex align-items-center justify-content-center p-2 rounded-circle bg-danger mb-2"><i class="ti ti-trash fs-24 text-white"></i></span>
                    <h6 class="fw-medium mb-3">Are you sure to delete break?</h6>
                    <div class="d-flex">
                        <button type="button" class="btn btn-light me-2 w-100" data-bs-dismiss="modal">Cancel</button>
                        <a href="working-hours-settings" class="btn btn-primary w-100">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <!-- end modal -->
<?php }?>
