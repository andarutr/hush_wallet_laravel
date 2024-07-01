@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="search-box">
                    <input type="text" class="form-control search"
                        placeholder="Search for deals...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-md-auto ms-auto">
                <div class="d-flex hastck gap-2 flex-wrap">
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted">Sort by: </span>
                        <select class="form-control mb-0" data-choices data-choices-search-false
                            id="choices-single-default">
                            <option value="Owner">Owner</option>
                            <option value="Company">Company</option>
                            <option value="Date">Date</option>
                        </select>
                    </div>
                    <button data-bs-toggle="modal" data-bs-target="#adddeals"
                        class="btn btn-success"><i class="ri-add-fill align-bottom me-1"></i> Add
                        Deals</button>
                    <div class="dropdown">
                        <button class="btn btn-soft-info btn-icon fs-14" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="ri-settings-4-line"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Copy</a></li>
                            <li><a class="dropdown-item" href="#">Move to pipline</a></li>
                            <li><a class="dropdown-item" href="#">Add to exceptions</a></li>
                            <li><a class="dropdown-item" href="#">Switch to common form view</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Reset form view to default</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
</div>
<!--end card-->

<div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">
    <div class="col">
        <div class="collapse show" id="leadDiscovered">
            <div class="card mb-1 ribbon-box ribbon-fill ribbon-sm">
                <div class="ribbon ribbon-info"><i class="ri-flashlight-fill"></i></div>
                <div class="card-body">
                    <a class="d-flex align-items-center" data-bs-toggle="collapse"
                        href="#leadDiscovered3" role="button" aria-expanded="false"
                        aria-controls="leadDiscovered3">
                        <div class="flex-shrink-0">
                            <img src="https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/Mandiri-512.png" alt=""
                                class="avatar-xs rounded-circle" />
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fs-13 mb-1">Bank Mandiri</h6>
                            <p class="text-muted mb-0">No rek: xxxxxxxxxx</p>
                        </div>
                    </a>
                </div>
                <div class="collapse border-top border-top-dashed show" id="leadDiscovered3">
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 mb-0">
                            <li>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-xxs text-muted">
                                        <i class=" ri-money-dollar-circle-line"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Rp 10.000.000</h6>
                                        <small class="text-muted">Saldo</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer hstack gap-2">
                        <button class="btn btn-warning btn-sm w-100"><i
                                class=" ri-logout-box-r-line"></i> Transaksi OUT</button>
                        <button class="btn btn-info btn-sm w-100"><i
                                class="ri-login-box-line"></i>
                            Transaksi IN</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="adddeals" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Create Deals</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form class="needs-validation" novalidate id="deals-form" onsubmit="return false">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="deatType" class="form-label">Deals Type</label>
                        <select class="form-select" id="deatType" data-choices
                            aria-label="Default select example" required>
                            <option value="" data-custom-properties="[object Object]">Select deals
                                type</option>
                            <option value="Lead Disovered">Lead Disovered</option>
                            <option value="Contact Initiated">Contact Initiated</option>
                            <option value="Need Identified">Need Identified</option>
                            <option value="Meeting Arranged">Meeting Arranged</option>
                            <option value="Offer Accepted">Offer Accepted</option>
                        </select>
                        <div class="invalid-feedback">
                            Please write an deals owner name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dealTitle" class="form-label">Deal Title</label>
                        <input type="text" class="form-control" id="dealTitle"
                            placeholder="Enter title" required>
                        <div class="invalid-feedback">
                            Please write a title.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dealValue" class="form-label">Value (USD)</label>
                        <input type="number" class="form-control" id="dealValue" step="0.01"
                            placeholder="Enter value" required>
                        <div class="invalid-feedback">
                            Please write a value.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dealOwner" class="form-label">Deals Owner</label>
                        <input type="text" class="form-control" id="dealOwner" required
                            placeholder="Enter owner name">
                        <div class="invalid-feedback">
                            Please write an deals owner name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dueDate" class="form-label">Due Date</label>
                        <input type="text" class="form-control" id="dueDate"
                            data-provider="flatpickr" placeholder="Select date" required>
                        <div class="invalid-feedback">
                            Please select a due date.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dealEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="dealEmail"
                            placeholder="Enter email" required>
                        <div class="invalid-feedback">
                            Please write a email.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="contactNumber" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contactNumber"
                            placeholder="Enter contact number" required>
                        <div class="invalid-feedback">
                            Please add a contact.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="contactDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="contactDescription" rows="3"
                            placeholder="Enter description" required></textarea>
                        <div class="invalid-feedback">
                            Please add a description.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" id="close-modal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i
                            class="ri-save-line align-bottom me-1"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end modal-->
@endsection