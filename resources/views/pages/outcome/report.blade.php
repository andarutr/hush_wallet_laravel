@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <label class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalFilter">
                    </div>
                    <div class="col-lg-2">
                        <label class="form-label">Jenis Pendapatan</label>
                        <select class="form-select" id="jenisPendapatanFilter">
                            <option value="allData">Semua data</option>
                            <option value="keperluan sehari-hari">Keperluan Sehari-hari</option>
                            <option value="hutang">Hutang</option>
                            <option value="cicilan">Cicilan</option>
                            <option value="keinginan">Keinginan</option>
                            <option value="bulanan">Bulanan</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive table-card">
                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0" id="tableReportIncome">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col">ID Transaksi</th>
                                <th scope="col">Jenis Pengeluaran</th>
                                <th scope="col">Tgl</th>
                                <th scope="col">Nominal</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Dibuat</th>
                                <th scope="col">Diperbarui</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div> 
    </div> 
</div>
@endsection

@push('scripts')
<script>
    let tanggalFilter = moment().format("YYYY-MM-DD");
    let jenisPendapatanFilter = 'allData';

    $("#tanggalFilter").val(tanggalFilter);
    $("#jenisPendapatanFilter").val(jenisPendapatanFilter);

    $(document).on("change", "#tanggalFilter", function(){
        tanggalFilter = $("#tanggalFilter").val();
        
        table().columns(2).search(tanggalFilter).draw();
    });
   
    $(document).on("change", "#jenisPendapatanFilter", function(){
        jenisPendapatanFilter = $("#jenisPendapatanFilter").val();

        table().columns(1).search(jenisPendapatanFilter).draw();
    });

    function notifySwal(title, icon, message){
        Swal.fire({
            title: title,
            icon: icon,
            html: message,
        });
    }

    function table(){
        $("#tableReportIncome").DataTable({
            searching: false,
            bDestroy: true,
            ajax: {
                type: "GET",
                url: "/u/outcome/laporan/getData",
                data: {
                    tanggal_filter: tanggalFilter,
                    jenis_filter: jenisPendapatanFilter
                }
            },
            columns: [
                { data: 'id_transaksi'},
                { data: 'jenis_pengeluaran'},
                { data: 'tgl'},
                { 
                    data: 'nominal',
                    render: function(data, type, row){
                        let saldo = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(data);

                        return `${saldo}`;
                    }
                },
                { data: 'catatan'},
                { 
                    data: 'created_at',
                    render: function(data, type, row){
                        let dibuat = moment(data).format('d MMMM YYYY');

                        return `${dibuat}`;
                    }
                },
                { 
                    data: 'updated_at',
                    render: function(data, type, row){
                        let diperbarui = moment(data).format('d MMMM YYYY');

                        return `${diperbarui}`;
                    }
                }
            ]
        });
    }

    table();
</script>
@endpush