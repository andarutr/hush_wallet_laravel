@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card" id="tasksList">
            <div class="card-body">
                <button class="btn btn-sm btn-primary mb-3" onClick="tambahModal()">Tambah data</button>
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="tableIncome">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="sort">ID Transaksi</th>
                                <th class="sort">Jenis Pendapatan</th>
                                <th class="sort">Tgl</th>
                                <th class="sort">Nominal</th>
                                <th class="sort">Catatan</th>
                                <th class="sort">Action</th>
                            </tr>
                        </thead>
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
                
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="card card-height-100">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Summary</h4>
                <div class="flex-shrink-0">
                    <a href="/u/income/laporan" class="btn btn-success btn-sm">
                        Rekapan
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <h6 class="text-muted text-uppercase fw-semibold text-truncate fs-12 mb-3">Total Pemasukan</h6>
                        <h4 class="fs- mb-0" id="saldoBulanIni"></h4>
                        <p>{{ \Carbon\Carbon::parse(now())->format('F Y') }}</p>
                    </div><!-- end col -->
                    <div class="col-6">
                        <div class="text-center">
                            <img src="/assets/media/illustrations/sketchy-1/2.png" class="img-fluid" alt="">
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->
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
    function notifySwal(title, icon,message){
        Swal.fire({
            title: title,
            icon: icon,
            html: message,
        });
    }

    function resetForm(){
        $("input").val('');
        $("select").val('');
        $("textarea").val('');
        // Trigger change khusus menggunakan plugin select 2
        $("select").val('').trigger("change");
    }

    function saldo(){
        $.ajax({
            type: "GET",
            url: "/u/income/getDataSaldo",
            success: function(res){
                let rupiah = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(res.saldo);

                $("#saldoBulanIni").text(rupiah);
            }
        })
    }

    saldo();

    function tableIncome(){
        $("#tableIncome").DataTable({
            info: false,
            bDestroy: true,
            ajax: {
                type: "GET",
                url: "/u/income/getData"
            },
            columns: [
                {
                    data: 'id_transaksi'
                },
                {
                    data: 'jenis_pendapatan'
                },
                {
                    data: 'tgl_income'
                },
                {
                    data: 'nominal',
                    render: function(data, type, row){
                        let rupiah = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(data);

                        return `Rp ${rupiah}`;
                    }
                },
                {
                    data: 'catatan'
                },
                {
                    render: function(data, type, row){
                        return `
                            <button class="btn btn-success btn-sm btn-icon" data-id="${row.id}" data-jenispendapatan="${row.jenis_pendapatan}" data-tanggal="${row.tgl_income}" data-nominal="${row.nominal}" data-catatan="${row.catatan}" onClick="updateIncomeModal(${row.id})"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-danger btn-sm btn-icon" onClick="remove(${row.id})"><i class="bi bi-trash"></i></button>
                        `;
                    }
                }
            ]
        })
    }
    
    tableIncome();

    function formTambah() {
        $("#contentModal").append(`
        <div class="mb-3">
            <label class="form-label">Jenis Pendapatan</label>
            <select class="form-select form-select-solid" id="jenisPendapatanForm">
                <option value="">Pilih</option>
                <option value="Freelance">Freelance</option>
                <option value="Bekerja">Bekerja</option>
                <option value="belum bekerja">Belum Bekerja</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nominal</label>
            <input type="number" class="form-control form-control-solid" id="nominalForm">
        </div>

        <div class="mb-3">
            <label class="form-label">Catatan</label>
            <textarea class="form-control form-control-solid" id="catatanForm"
                rows="3"></textarea>
        </div>

        <div class="d-flex align-items-start gap-3 mt-3">
            <button class="btn btn-sm btn-primary" onClick="store()"><i
                    class="ri-bank label-icon align-middle fs-16 ms-2"></i>Submit</button>
        </div>
        `);
    }

    function formUpdate(id){
        $.ajax({
            type: "GET",
            url: "/u/income/getDataFirst",
            data: {
                id
            },
            success: function(res){
                $("#contentModal").append(`
                <div class="mb-3">
                    <label class="form-label">Jenis Pendapatan</label>
                    <select class="form-select form-select-solid" id="jenisPendapatanForm" data-hide-search="true" data-control="select2">
                        <option value="${res.jenis_pendapatan}">${res.jenis_pendapatan}</option>
                        <option value="freelance">freelance</option>
                        <option value="bekerja">bekerja</option>
                        <option value="belum bekerja">belum bekerja</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control form-control-solid" id="tglIncomeForm" value="${res.tgl_income}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nominal</label>
                    <input type="number" class="form-control form-control-solid" id="nominalForm" value="${res.nominal}">
                </div>
                <div class="mb-3">
                    <label class="form-label" id="labelCatatan">Catatan</label>
                    <textarea class="form-control form-control-solid" id="catatanForm">${res.catatan}
                        </textarea>
                </div>
                <button class="btn btn-primary mt-3" onClick="update(${res.id})">Update</button>
                `);
            },
            error: function(xhr){
                Swal.fire("Error","error", xhr.responseText);
            }
        });
    }

    function store(){
        let jenisPendapatan = $("#jenisPendapatanForm").val();
        let nominal = $("#nominalForm").val();
        let catatan = $("#catatanForm").val();

        $.ajax({
            type: "POST", 
            url: "/u/income/store",
            data: {
                jenis_pendapatan: jenisPendapatan,
                nominal: nominal,
                catatan: catatan
            },
            success: function(res){
                $("#modal").modal("hide");
                notifySwal("berhasil","success", res.message);
                tableIncome();
            }, 
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let message = '';
                $.each(errors, function(key, value) {
                    message += value[0] + '<br>';
                });

                notifySwal("gagal","error", message);
            }
        })
    }

    function update(id){
        let jenisPendapatanForm = $("#jenisPendapatanForm").val();
        let tglIncomeForm = $("#tglIncomeForm").val();
        let nominalForm = $("#nominalForm").val();
        let catatanForm = $("#catatanForm").val();

        $.ajax({
            type: "PUT",
            url: "/u/income/update",
            data: {
                id: id,
                jenis_pendapatan: jenisPendapatanForm,
                tgl_income: tglIncomeForm,
                nominal: nominalForm,
                catatan: catatanForm
            },
            success: function(res){
                $("#modal").modal("hide");
                notifySwal("berhasil","success", res.message);
                tableIncome();
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let message = '';
                $.each(errors, function(key, value) {
                    message += value[0] + '<br>';
                });

                notifySwal("gagal","error", message);
            }
        });
    }

    function remove(id){
        Swal.fire({
            title: "Konfirmasi",
            icon: "question",
            text: "Yakin ingin menghapus income?",
            
            showCancelButton: true,
            confirmButtonText: "Yakin"
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    type: "DELETE",
                    url: "/u/income/remove",
                    data: {
                        id
                    },
                    success: function(res){
                        notifySwal("Berhasil", "success", ""+res.message);
                        tableIncome();
                    }
                });
            }
        });
    }
    // Modals
    function tambahModal() {
        $("#judulModal").text("Tambah Income");
        $("#contentModal").empty();

        formTambah();

        $("#modal").modal("show");
    }

    function updateIncomeModal(id){
        $("#judulModal").text("Update Income");
        $("#contentModal").empty();
        
        formUpdate(id);

        $("#modal").modal("show");
    }
</script>
@endpush