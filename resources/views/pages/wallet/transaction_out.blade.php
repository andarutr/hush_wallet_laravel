@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card" id="tasksList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Wallet Transaksi OUT</h5>
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
                                        <input class="form-check-input" type="checkbox"
                                            id="checkAll" value="option">
                                    </div>
                                </th>
                                <th class="sort">ID Transaksi</th>
                                <th class="sort">Nominal</th>
                                <th class="sort">Untuk</th>
                                <th class="sort">Print</th>
                            </tr>
                        </thead>
                        <tbody class="list form-check-all">
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="chk_child" value="option1">
                                    </div>
                                </th>
                                <td>25 Jan, 2022</td>
                                <td>25 Jan, 2022</td>
                                <td>25 Jan, 2022</td>
                                <td>
                                    <center>
                                        <a href="" class="btn btn-sm btn-danger">pdf</a>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end table-->
                    <div class="noresult" style="display: none">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                colors="primary:#121331,secondary:#08a88a"
                                style="width:75px;height:75px"></lord-icon>
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
    <!--end col-->
</div>
@endsection`