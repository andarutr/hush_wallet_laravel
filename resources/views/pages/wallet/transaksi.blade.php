@extends('layouts.master')

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body pt-15">
                    <div id="containerAtm"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#incomeTab">Income</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#outcomeTab">Outcome</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#nabungTab">Nabung</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="incomeTab" role="tabpanel">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Income</h2>
                            </div>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-flex btn-light-danger" onClick="downloadPdfIncomeModal()">Download Pdf</button>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <table class="table align-middle table-row-dashed gy-5" id="tableIncome">
                                <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                    <tr class="text-start text-muted text-uppercase gs-0">
                                        <th>ID Transaksi</th>
                                        <th>Jenis Pendapatan</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                        <th>Dibuat</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="outcomeTab" role="tabpanel">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Outcome</h2>
                            </div>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-flex btn-light-danger" onClick="downloadPdfOutcomeModal()">Download Pdf</button>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <table class="table align-middle table-row-dashed gy-5" id="tableOutcome">
                                <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                    <tr class="text-start text-muted text-uppercase gs-0">
                                        <th>ID Transaksi</th>
                                        <th>Jenis Pengeluaran</th>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                        <th>Dibuat</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="nabungTab" role="tabpanel">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Nabung</h2>
                            </div>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-sm btn-flex btn-light-primary" onClick="downloadPdfNabungModal()">Download Pdf</button>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <table class="table align-middle table-row-dashed gy-5" id="tableNabung">
                                <thead class="border-bottom border-gray-200 fs-7 fw-bolder">
                                    <tr class="text-start text-muted text-uppercase gs-0">
                                        <th>ID Transaksi</th>
                                        <th>Jenis</th>
                                        <th>Platform</th>
                                        <th>Nominal</th>
                                        <th>Catatan</th>
                                        <th>Tgl</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="modal">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder" id="judulModal"></h2>
            </div>
            <div class="modal-body py-10 px-lg-17" id="contentModal"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function notifySwal(title, icon, message){
        Swal.fire({
            title: title,
            icon: icon,
            html: message,
        });
    }

    function containerAtm(){
        $.ajax({
            type: "GET",
            url: "u/wallet/transaksi/getDataAtm",
            data: {
                id: localStorage.getItem('transactionId')
            },
            success: function(res){
                let saldo = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(res.saldo);

                $("#containerAtm").empty();

                $("#containerAtm").append(`
                    <div class="d-flex flex-center flex-column mb-5">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <img src="{{ asset('assets/media/banks') }}/${res.picture}" class="img-fluid me-4 rounded" width="150" />
                        </div>
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">${res.bank}</a>
                        <div class="fs-5 fw-bold text-muted mb-6">${res.rekening}</div>
                        <div class="fs-1 fw-bold text-muted mb-6">${saldo}</div>
                        <a href="/u/wallet" class="btn btn-success btn-sm">Kembali</a>
                    </div>
                `);
            }
        })
    }

    containerAtm();

    function downloadPdfIncomeModal(){
        $("#judulModal").text("Download Rekapan Income");
        $("#contentModal").empty();
        
        $("#contentModal").append(`
            <div class="row">
                <div class="col-lg-4">
                    <label>Dari</label>
                    <input type="date" class="form-control" id="fromDateIncome">
                </div>
                <div class="col-lg-4">
                    <label>Sampai</label>
                    <input type="date" class="form-control" id="toDateIncome">
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-primary mt-5" onClick="downloadRekapanIncome()">Download</button>
                </div>
            </div>
        `);
        
        $("#modal").modal("show");
    }

    function downloadPdfOutcomeModal(){
        $("#judulModal").text("Download Rekapan Outcome");
        $("#contentModal").empty();
        
        $("#contentModal").append(`
            <div class="row">
                <div class="col-lg-4">
                    <label>Dari</label>
                    <input type="date" class="form-control" id="fromDateOutcome">
                </div>
                <div class="col-lg-4">
                    <label>Sampai</label>
                    <input type="date" class="form-control" id="toDateOutcome">
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-primary mt-5" onClick="downloadRekapanOutcome()">Download</button>
                </div>
            </div>
        `);
        
        $("#modal").modal("show");
    }

    function downloadPdfNabungModal(){
        $("#judulModal").text("Download Rekapan Tabungan");
        $("#contentModal").empty();
        
        $("#contentModal").append(`
            <div class="row">
                <div class="col-lg-3">
                    <label>Dari</label>
                    <input type="date" class="form-control" id="fromDateNabung">
                </div>
                <div class="col-lg-3">
                    <label>Sampai</label>
                    <input type="date" class="form-control" id="toDateNabung">
                </div>
                <div class="col-lg-3">
                    <label>Platform</label>
                    <select class="form-select form-select-solid" id="platformNabung">
                        <option value="">Pilih</option>
                        @foreach($platform as $pt)
                        <option value="{{ $pt }}">{{ $pt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-primary mt-5" onClick="downloadRekapanNabung()">Download</button>
                </div>
            </div>
        `);
        
        $("#modal").modal("show");
    }

    function tableIncome(){
        $("#tableIncome").DataTable({
            searching: false,
            info: false,
            ajax: {
                type: "GET",
                url: "/u/wallet/transaksi/getDataIncome"
            },
            columns: [
                { data: 'id_transaksi'},
                { data: 'jenis_pendapatan'},
                { data: 'tgl_income'},
                { 
                    data: 'nominal',
                    render: function(data, type, row){
                        let saldo = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(data);

                        return `${saldo}`;
                    }
                },
                { data: 'catatan' },
                { 
                    data: null,
                    render: function(data, type, row){
                        return `${moment(row.created_at).format('D/MM/YY')}`;
                    }
                },
            ]
        });
    }

    tableIncome();
    
    function tableOutcome(){
        $("#tableOutcome").DataTable({
            searching: false,
            info: false,
            ajax: {
                type: "GET",
                url: "/u/wallet/transaksi/getDataOutcome"
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
                    data: null,
                    render: function(data, type, row){
                        return `${moment(row.created_at).format('D/MM/YY')}`;
                    }
                },
            ]
        });
    }

    tableOutcome();

    function tableNabung(){
        $("#tableNabung").DataTable({
            searching: false,
            info: false,
            ajax: {
                type: "GET",
                url: "/u/wallet/transaksi/getDataNabung"
            },
            columns: [
                { data: 'id_transaksi'},
                { data: 'jenis_tabungan'},
                { data: 'platform'},
                { 
                    data: 'nominal',
                    render: function(data, type, row){
                        let saldo = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(data);

                        return `${saldo}`;
                    }
                },
                { data: 'catatan'},
                { 
                    data: null,
                    render: function(data, type, row){
                        return `${moment(row.created_at).format('D/MM/YY')}`;
                    }
                },
            ]
        });
    }

    tableNabung();

    function downloadRekapanIncome(){
        let from = $("#fromDateIncome").val();
        let to = $("#toDateIncome").val();
        
        $.ajax({
            type: "POST",
            url: "/u/wallet/transaksi/downloadRekapanIncome",
            data: {
                from: from,
                to: to,
                bankId: localStorage.getItem('transactionId')
            },
            success: function(res){
                notifySwal("Berhasil","success", res.message);
                $("#modal").modal("hide");
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let message = '';

                $.each(errors, function(key, value) {
                    message += value[0] + '<br>';
                });

                notifySwal("error","error", message);
            }
        });
    }

    function downloadRekapanOutcome(){
        let from = $("#fromDateOutcome").val();
        let to = $("#toDateOutcome").val();
        
        $.ajax({
            type: "POST",
            url: "/u/wallet/transaksi/downloadRekapanOutcome",
            data: {
                from: from,
                to: to,
                bankId: localStorage.getItem('transactionId')
            },
            success: function(res){
                notifySwal("Berhasil","success", res.message);
                $("#modal").modal("hide");
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let message = '';

                $.each(errors, function(key, value) {
                    message += value[0] + '<br>';
                });

                notifySwal("error","error", message);
            }
        });
    }
    
    function downloadRekapanNabung(){
        let from = $("#fromDateNabung").val();
        let to = $("#toDateNabung").val();
        let platform = $("#platformNabung").val();
        
        $.ajax({
            type: "POST",
            url: "/u/wallet/transaksi/downloadRekapanNabung",
            data: {
                from,
                to,
                platform
            },
            success: function(res){
                notifySwal("Berhasil","success", res.message);
                $("#modal").modal("hide");
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let message = '';

                $.each(errors, function(key, value) {
                    message += value[0] + '<br>';
                });

                notifySwal("error","error", message);
            }
        });
    }
</script>
@endpush