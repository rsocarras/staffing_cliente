    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <!-- Page Header -->
            <div class="d-flex align-items-sm-center flex-sm-row flex-column gap-2 pb-3">
                <div class="flex-grow-1">
                    <h4 class="mb-0">Contact</h4>
                </div>
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>                              
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Applications</a></li>                            
                        <li class="breadcrumb-item active">Contact</li>
                    </ol>
                </div>
            </div>
            <!-- End Page Header -->

            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_modal"><i class="ti ti-square-rounded-plus me-1"></i>New Contact</a>
                <ul class="d-flex align-items-center flex-shrink-0 list-unstyled mb-0">
                    <li>
                        <a href="contacts" class="btn btn-icon btn-sm bg-white text-dark me-2" aria-label="Contacts" title="Contacts"><i class="ti ti-layout-grid"></i></a>
                    </li>
                    <li>
                        <a href="contact-list" class="btn btn-icon btn-sm bg-primary text-white active me-2" aria-label="Contact List" title="Contact List"><i class="ti ti-list-tree"></i></a>
                    </li>
                </ul>
            </div>

            <!-- card start -->
            <div class="card mb-0">
                <div class="card-header d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h5 class="d-inline-flex align-items-center mb-0">Contacts<span class="badge bg-danger ms-2">658</span></h5>
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle btn btn-outline-light d-inline-flex align-items-center" data-bs-toggle="dropdown">
                                <i class="ti ti-sort-descending-2 me-1"></i><span class="me-1">Sort By : </span> Newest
                            </a>
                            <ul class="dropdown-menu  dropdown-menu-end p-2">
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Newest</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" class="dropdown-item rounded-1">Oldest</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- table start -->
                    <div class="table-responsive table-nowrap">
                        <table class="table mb-0 border">
                            <thead>
                                <tr>
                                    <th class="no-sort">Name</th>
                                    <th class="no-sort">Phone</th>
                                    <th class="no-sort">Email ID</th>
                                    <th class="no-sort"></th>
                                    <th class="no-sort"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-13.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">James Jackson</a></h6>
                                        </div>
                                    </td>
                                    <td>(123) 4567 890</td>
                                    <td>jamesjackson@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-11.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Robin Coffin</a></h6>
                                        </div>
                                    </td>
                                    <td>(179) 7382 829</td>
                                    <td>robin@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>       
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-14.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Vincent Thornburg</a></h6>
                                        </div>
                                    </td>
                                    <td>(184) 2719 738</td>
                                    <td>vincent@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-15.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Fran Faulkner</a></h6>
                                        </div>
                                    </td>
                                    <td>(184) 2719 738</td>
                                    <td>franfaulker@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-16.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Ernestine Waller</a></h6>
                                        </div>
                                    </td>
                                    <td>(183) 9302 890</td>
                                    <td>waller@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-18.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Jared Adams</a></h6>
                                        </div>
                                    </td>
                                    <td>(120) 3728 039</td>
                                    <td>jaredadams@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-17.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Reyna Pelfrey</a></h6>
                                        </div>
                                    </td>
                                    <td>(102) 8480 832</td>
                                    <td>reynapelfrey@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-20.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Rafael Lowe</a></h6>
                                        </div>
                                    </td>
                                    <td>(162) 8920 713</td>
                                    <td>rafeallowe@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-24.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Enrique Ratcliff</a></h6>
                                        </div>
                                    </td>
                                    <td>(189) 0920 723</td>
                                    <td>enrique@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="javascript:void(0);" class="avatar avatar-sm flex-shrink-0 me-2"><img src="assets/img/profiles/avatar-12.jpg" alt="user"></a>
                                            <h6 class="fs-14 fw-semibold mb-0"><a href="javascript:void(0);">Elizabeth Pegues</a></h6>
                                        </div>
                                    </td>
                                    <td>(168) 8392 823</td>
                                    <td>elizabeth@example.com</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="voice-call" class="btn btn-icon btn-light btn-sm" aria-label="phone"><i class="ti ti-phone-calling"></i></a>
                                            <a href="chat" class="btn btn-icon btn-light btn-sm" aria-label="message"><i class="ti ti-message-chatbot"></i></a>
                                            <a href="video-call" class="btn btn-icon btn-light btn-sm" aria-label="video"><i class="ti ti-video-plus"></i></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <button type="button" class="btn btn-icon btn-outline-light btn-sm" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="More options">
                                                <i class="ti ti-dots-vertical" aria-hidden="true"></i>
                                            </button>                                                
                                            <ul class="dropdown-menu p-2">
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#edit_modal"><i class="ti ti-edit me-1"></i>Edit</a>
                                                </li>                                       
                                                <li>
                                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#delete_modal"><i class="ti ti-trash me-1"></i>Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- table end -->
                </div>

            </div>
            <!-- card start -->
                            
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
