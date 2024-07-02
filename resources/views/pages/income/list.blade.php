@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card" id="tasksList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">List Income</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-sm btn-primary add-btn" data-bs-toggle="modal" data-bs-target="#showModal"><i
                                    class="ri-add-line align-bottom me-1"></i> Tambah Data</button>
                            <button class="btn btn-soft-secondary" id="remove-actions" onClick="deleteMultiple()"><i
                                    class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end card-body-->
            <div class="card-body">
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 40px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th class="sort">ID Transaksi</th>
                                <th class="sort">Jenis Pendapatan</th>
                                <th class="sort">Tgl</th>
                                <th class="sort">Nominal</th>
                                <th class="sort">Catatan</th>
                                <th class="sort">Action</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </td>
                                <td>VLSKDJX12NJDK8</td>
                                <td>Freelance</td>
                                <td>02-07-2024</td>
                                <td>Rp350.000</td>
                                <td>Jokian cair RZA</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </td>
                                <td>VLSKDJX12NJIWQ20</td>
                                <td>Freelance</td>
                                <td>02-07-2024</td>
                                <td>Rp100.000</td>
                                <td>Jokian cair RZA</td>
                                <td>
                                    <div class="dropdown d-inline-block">
                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-fill align-middle"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item edit-item-btn"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a></li>
                                            <li>
                                                <a class="dropdown-item remove-item-btn">
                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end table-->
                    <div class="noresult" style="display: none">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                            <h5 class="mt-2">Sorry! No Result Found</h5>
                            <p class="text-muted mb-0">We've searched more than 200k+ tasks We did
                                not find any tasks for you search.</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <div class="pagination-wrap hstack gap-2">
                        <a class="page-item pagination-prev disabled" href="#">
                            Previous
                        </a>
                        <ul class="pagination listjs-pagination mb-0"></ul>
                        <a class="page-item pagination-next" href="#">
                            Next
                        </a>
                    </div>
                </div>
            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Summary</h4>
                <div class="flex-shrink-0">
                    <a href="/u/income/laporan" class="btn btn-soft-success btn-sm">
                        Rekapan
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="row align-items-center">
                    <div class="col-6">
                        <h6 class="text-muted text-uppercase fw-semibold text-truncate fs-12 mb-3">
                            Total Pemasukan</h6>
                        <h4 class="fs- mb-0">Rp 450.000</h4>
                    </div><!-- end col -->
                    <div class="col-6">
                        <div class="text-center">
                            <img src="/assets/images/illustrator-1.png" class="img-fluid" alt="">
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
                <div class="mt-3 pt-2">
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <p class="text-truncate text-muted fs-14 mb-0"><i class="mdi mdi-circle align-middle text-info me-2"></i>Juni
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <p class="mb-0">Rp 500.000</p>
                        </div>
                    </div><!-- end -->
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <p class="text-truncate text-muted fs-14 mb-0"><i class="mdi mdi-circle align-middle text-info me-2"></i>Mei
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <p class="mb-0">Rp 400.000</p>
                        </div>
                    </div><!-- end -->
                    <div class="d-flex mb-2">
                        <div class="flex-grow-1">
                            <p class="text-truncate text-muted fs-14 mb-0"><i class="mdi mdi-circle align-middle text-info me-2"></i>April
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <p class="mb-0">Rp 300.000</p>
                        </div>
                    </div><!-- end -->
                </div><!-- end -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Income</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close-modal"></button>
            </div>
            <form class="tablelist-form" autocomplete="off">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="billinginfo-firstName" class="form-label">Jenis Pendapatan</label>
                                <select class="form-select">
                                    <option value="">Pilih</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Bekerja">Bekerja</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="billinginfo-lastName" class="form-label">Nominal</label>
                                <input type="email" class="form-control" id="billinginfo-email"
                                    placeholder="Enter email">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="billinginfo-address" class="form-label">Catatan</label>
                        <textarea class="form-control" id="billinginfo-address" placeholder="Enter address"
                            rows="3"></textarea>
                    </div>

                    <div class="d-flex align-items-start gap-3 mt-3">
                        <button type="button" class="btn btn-primary btn-label right ms-auto nexttab"
                            data-nexttab="pills-bill-address-tab"><i
                                class="ri-bank label-icon align-middle fs-16 ms-2"></i>Submit</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" id="close-modal"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Add Task</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update Task</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection