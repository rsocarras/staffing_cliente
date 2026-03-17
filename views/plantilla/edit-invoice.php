    <!-- ========================
        Start Page Content
    ========================= -->

    <div class="page-wrapper">

        <!-- Start Content -->
        <div class="content">

            <!-- Breadcrumb -->
            <div class="mb-3">
                <a href="invoices" class="fw-medium"><i class="ti ti-arrow-left me-1"></i>Back to Invoices</a>
            </div>
            <!-- /Breadcrumb -->

            <div class="card mb-0">
                <div class="card-body">
                    <form action="edit-invoice">
                        <div class="border-bottom mb-3">
                            <div class="row">
                                <div class="col-xl-4 col-lg-6 col-md-4">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-0">
                                            <label class="form-label">Client</label>
                                            <a href="clients" class="text-primary"><i class="ti ti-circle-plus me-1"></i>Add New</a>
                                        </div>
                                        <select class="select form-control">
                                            <option>Select</option>
                                            <option selected>Shaun Farley</option>
                                            <option>Jenny Ellis</option>
                                            <option>Leon Baxter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-6 col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">
                                            Invoice Number <span class="text-danger ms-1">*</span>
                                        </label>
                                        <input type="text" class="form-control" value="INV010">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control phone" name="phone">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Issued Date</label>
                                        <div class="input-group w-auto input-group-flat">
                                            <input type="text" class="form-control" value="10/01/2025" data-provider="flatpickr" data-date-format="d M, Y">
                                            <span class="input-group-text">
                                                <i class="ti ti-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Due Date</label>
                                        <div class="input-group w-auto input-group-flat">
                                            <input type="text" class="form-control" value="10 May, 2025" data-provider="flatpickr" data-date-format="d M, Y">
                                            <span class="input-group-text">
                                                <i class="ti ti-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center justify-content-between mb-0">
                                            <label class="form-label">Currency</label>
                                        </div>
                                        <select class="select form-control">
                                            <option>Select</option>
                                            <option selected>USD</option>
                                            <option>EUR</option>
                                            <option>INR</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom mb-4">
                            <h6 class="fs-14 fw-bold mb-3">Item Details</h6>
                            <div class="table-responsive mb-1">
                                <table class="table border table-nowrap" id="item-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="w-25 fs-14 fw-medium">Product</th>
                                            <th class="w-120 fs-14 fw-medium">Quantity</th>
                                            <th class="w-120 fs-14 fw-medium">Unit</th>
                                            <th class="w-120 fs-14 fw-medium">Price ($)</th>
                                            <th class="w-120 fs-14 fw-medium">Tax (%)</th>
                                            <th colspan="2" class="fs-14 fw-medium">Discount</th>
                                            <th class="fs-14 fw-medium">Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" placeholder="Qty">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td class="ps-0">
                                                <select class="form-select form-select-sm custom-select-spacing">
                                                    <option value="1">%</option>
                                                    <option value="2">$</option>
                                                </select>
                                            </td>
                                            <td class=" fw-14 fw-medium">$400.00</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm" placeholder="Qty">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm">
                                            </td>
                                            <td class="ps-0">
                                                <select class="form-select form-select-sm custom-select-spacing">
                                                    <option value="1">%</option>
                                                    <option value="2">$</option>
                                                </select>
                                            </td>
                                            <td class=" fw-14 fw-medium">$250.00</td>
                                            <td>
                                                <a href="javascript:void(0);" class="delete-row link-danger" aria-label="Delete"><i class="ti ti-trash"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary my-3">
                                <i class="ti ti-plus me-1"></i>Add More Items
                            </a>
                        </div>
                        <div>
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label mb-1">Notes</label>
                                        <textarea rows="3" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label mb-1">Terms & Conditions</label>
                                        <textarea rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border p-3 rounded">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-6 text-dark fw-medium">
                                                Subtotal
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm text-end" placeholder="0.00">
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-6 text-dark fw-medium">
                                                Extra Discount (0%)
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm text-end" placeholder="0.00">
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-6 text-dark fw-medium">
                                                Tax (0%)
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm text-end" placeholder="0.00">
                                            </div>
                                        </div>
                                        <div class="row align-items-center mb-3">
                                            <div class="col-6 text-dark fw-medium">
                                                <div class="d-flex">
                                                    <label class="form-check-label me-2" for="flexSwitchCheckChecked">Round Off</label>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" class="form-control form-control-sm text-end" placeholder="0.00">
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <h6 class="mb-0 fs-16 fw-bold">Grand Total</h6>
                                            <h6 class="mb-0 fs-16 fw-bold">$0.00</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border p-3 rounded d-flex align-items-center justify-content-end flex-wrap">
                                <a href="javascript:void(0);" class="btn btn-sm btn-light me-2">Cancel</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary me-2">Save as Draft</a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-dark">Save & Send</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            
        </div>
        <!-- End Content -->

        <?= $this->render('layouts/partials/footer') ?>

    </div>

    <!-- ========================
        End Page Content
    ========================= -->
