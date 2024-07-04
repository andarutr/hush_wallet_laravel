@extends('layouts.master')

@section('content')
<div class="card">
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
                    <button data-bs-toggle="modal" data-bs-target="#adddeals" class="btn btn-success"><i
                            class="ri-add-fill align-bottom me-1"></i> Tambah Dompet</button>
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
                <div class="ribbon ribbon-danger" style="cursor: pointer;"><i class="ri-delete-bin-line"></i></div>
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

<div class="modal fade" id="adddeals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light p-3">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Dompet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="needs-validation" novalidate id="deals-form" onsubmit="return false">
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i class="ri-save-line align-bottom me-1"></i>
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection