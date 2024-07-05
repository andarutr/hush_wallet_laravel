@extends('layouts.master')

@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-header card-header-stretch pb-0">
        <div class="card-title">
            <h3 class="m-0">List Wallets / Rekening</h3>
        </div>
    </div>

    <div class="card-body tab-content">
        <div id="kt_billing_creditcard" class="tab-pane fade show active" role="tabpanel">
            <div class="row gx-9 gy-6">
                <div class="col-xl-12">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Tambah Data</button>
                </div>

                <div id="containerMasterBank"></div>

            </div>
            <!--end::Row-->
        </div>
        <!--end::Tab panel-->
        <!--begin::Tab panel-->
        <div id="kt_billing_paypal" class="tab-pane fade" role="tabpanel" aria-labelledby="kt_billing_paypal_tab">
            <!--begin::Title-->
            <h3 class="mb-5">My Paypal</h3>
            <!--end::Title-->
            <!--begin::Description-->
            <div class="text-gray-600 fs-6 fw-bold mb-5">To use PayPal as your payment method, you will need to make pre-payments each month before your bill is due.</div>
            <!--end::Description-->
            <!--begin::Form-->
            <form class="form">
                <!--begin::Input group-->
                <div class="mb-7 mw-350px">
                    <select name="timezone" data-control="select2" data-placeholder="Select an option" data-hide-search="true" class="form-select form-select-solid form-select-lg fw-bold fs-6 text-gray-700">
                        <option>Select an option</option>
                        <option value="25">US $25.00</option>
                        <option value="50">US $50.00</option>
                        <option value="100">US $100.00</option>
                        <option value="125">US $125.00</option>
                        <option value="150">US $150.00</option>
                    </select>
                </div>
                <!--end::Input group-->
                <button type="submit" class="btn btn-primary">Pay with Paypal</button>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Tab panel-->
    </div>
    <!--end::Tab content-->
</div>

{{-- <div class="card">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="search-box">
                    <input type="text" class="form-control search" placeholder="Cari data">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <!--end col-->
            <div class="col-md-auto ms-auto">
                <div class="d-flex hastck gap-2 flex-wrap">
                    <button class="btn btn-success" id="btnTambahDompetModal"><i class="ri-add-fill align-bottom me-1"></i> Tambah Dompet</button>
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
        <div class="collapse show" id="bankMandiri">
            <div class="card mb-1 ribbon-box ribbon-fill ribbon-sm">
                <div class="ribbon ribbon-danger cardRemove" style="cursor: pointer;"><i class="ri-delete-bin-line"></i></div>
                <div class="card-body">
                    <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#bankMandiri8" role="button"
                        aria-expanded="false" aria-controls="bankMandiri8">
                        <div class="flex-shrink-0">
                            <img src="https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/Mandiri-512.png"
                                alt="" class="avatar-xs rounded-circle" />
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fs-13 mb-1">Bank Mandiri</h6>
                            <p class="text-muted mb-0">No rek: xxxxxxxxxx</p>
                        </div>
                    </a>
                </div>
                <div class="collapse border-top border-top-dashed show" id="bankMandiri8">
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
                        <a href="/u/wallet/transaksi-out/XcPRHjJNtbS&ust" class="btn btn-warning btn-sm w-100"><i
                                class=" ri-logout-box-r-line"></i> Transaksi OUT</a>
                        <a href="/u/wallet/transaksi-in/0CBEQjRxqFwoTCLiAgfu8h" class="btn btn-info btn-sm w-100"><i
                                class="ri-login-box-line"></i>
                            Transaksi IN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="collapse show" id="dompet">
            <div class="card mb-1 ribbon-box ribbon-fill ribbon-sm">
                <div class="ribbon ribbon-danger" style="cursor: pointer;"><i class="ri-delete-bin-line"></i></div>
                <div class="card-body">
                    <a class="d-flex align-items-center" data-bs-toggle="collapse" href="#dompet3" role="button"
                        aria-expanded="false" aria-controls="dompet3">
                        <div class="flex-shrink-0">
                            <img src="https://images-platform.99static.com//L71nswp3zqis9pEl95KNLOdaIT0=/238x1737:1253x2754/fit-in/500x500/99designs-contests-attachments/95/95081/attachment_95081032"
                                alt="" class="avatar-xs rounded-circle" />
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fs-13 mb-1">Cash</h6>
                            <p class="text-muted mb-0">Dompet</p>
                        </div>
                    </a>
                </div>
                <div class="collapse border-top border-top-dashed show" id="dompet3">
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 mb-0">
                            <li>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-xxs text-muted">
                                        <i class=" ri-money-dollar-circle-line"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Rp 500.000</h6>
                                        <small class="text-muted">Saldo</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer hstack gap-2">
                        <a href="/u/wallet/transaksi-out/XcPRHjJNtbS&ust" class="btn btn-warning btn-sm w-100"><i
                                class=" ri-logout-box-r-line"></i> Transaksi OUT</a>
                        <a href="/u/wallet/transaksi-in/0CBEQjRxqFwoTCLiAgfu8h" class="btn btn-info btn-sm w-100"><i
                                class="ri-login-box-line"></i>
                            Transaksi IN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade zoomIn modalHush" id="removeNotificationModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="judulModal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <div class="modal-body" id="contentModal"></div>
        </div>
    </div>
</div> --}}
@endsection

@push('script')
<script>
function containerMasterBank(){
    $.ajax({
        type: "GET",
        url: "/su/master/bank/getData",
        success: function(res){
            $("#containerMasterBank").empty().append(`
                <div class="col-xl-6">
                    <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                        <div class="d-flex flex-column py-2">
                            <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Marcus Morris
                            <span class="badge badge-light-success fs-7 ms-2">Primary</span></div>
                            <div class="d-flex align-items-center">
                                <img src="assets/media/svg/card-logos/visa.svg" alt="" class="me-4" />
                                <div>
                                    <div class="fs-4 fw-bolder">Visa **** 1679</div>
                                    <div class="fs-6 fw-bold text-gray-400">Card expires at 09/24</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center py-2">
                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-3">Delete</button>
                            <button class="btn btn-sm btn-light btn-active-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">Edit</button>
                        </div>
                    </div>
                </div>
            `);
        }
    })
}

containerMasterBank();

$(document).on("click", "#btnTambahDompetModal", function(){
    $("#judulModal").text("Tambah Data Dompet");

    $("#contentModal").empty().append(`
        <div class="mb-3">
            <label for="deatType" class="form-label">Jenis Dompet</label>
            <select class="form-select" id="deatType" data-choices aria-label="Default select example"
                required>
                <option value="">Pilih jenis</option>
                <option value="Cash">Cash</option>
                <option value="Cashless">Cashless</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">No. Rekening</label>
            <input type="text" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Bank</label>
            <input type="text" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nominal</label>
            <input type="number" class="form-control" required>
        </div>
    `);

    $("#removeNotificationModal").modal("show");
});
</script>
@endpush