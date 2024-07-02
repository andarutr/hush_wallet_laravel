@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Laporan Outcome</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-soft-danger btn-sm">
                        <i class="ri-file-list-3-line align-middle"></i> Download PDF
                    </button>
                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col">ID Transaksi</th>
                                <th scope="col">Jenis Pendapatan</th>
                                <th scope="col">Tgl</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Dibuat</th>
                                <th scope="col">Diperbarui</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    #VZ211ASJKD22103
                                </td>
                                <td>
                                    Bekerja
                                </td>
                                <td>01-07-2024</td>
                                <td>
                                    Rp 350.000
                                </td>
                                <td>Jokian cair RZA</td>
                                <td>
                                    01-07-2024
                                </td>
                                <td>
                                    02-07-2024
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    #VZ211ASJKD22103
                                </td>
                                <td>
                                    Bekerja
                                </td>
                                <td>01-07-2024</td>
                                <td>
                                    Rp 350.000
                                </td>
                                <td>Jokian cair RZA</td>
                                <td>
                                    01-07-2024
                                </td>
                                <td>
                                    02-07-2024
                                </td>
                            </tr>
                        </tbody><!-- end tbody -->
                    </table><!-- end table -->
                </div>
            </div>
        </div> <!-- .card-->
    </div> <!-- .col-->
</div>
@endsection