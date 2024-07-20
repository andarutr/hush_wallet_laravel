@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <button class="btn btn-sm btn-primary mb-3" onClick="tambahModal()"><i class="bi bi-plus-lg"></i>Tambah data</button>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="tableOutcome">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="sort">ID Transaksi</th>
                                <th class="sort">Jenis Pengeluaran</th>
                                <th class="sort">Tgl</th>
                                <th class="sort">Nominal</th>
                                <th class="sort">Catatan</th>
                                <th class="sort">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <a href="/u/outcome/laporan" class="btn btn-success btn-sm mb-3"><i class="bi bi-eye"></i>Rekapan</a>
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6 text-center">
                        <h6 class="text-muted text-uppercase fw-semibold text-truncate fs-12 mb-3">Total Pengeluaran</h6>
                        <h4 class="fs- mb-0" id="dataOut"></h4>
                        <p>{{ \Carbon\Carbon::parse(now())->format('F Y') }}</p>
                    </div><!-- end col -->
                    <div class="col-6">
                        <div class="text-center">
                            <img src="/assets/media/illustrations/dozzy-1/3-dark.png" class="img-fluid" alt="">
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
    function notifySwal(title, icon, message){
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
            url: "/u/outcome/getDataNominal",
            success: function(res){
                let rupiah = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(res.saldo);

                $("#dataOut").text(rupiah);
            }
        })
    }

    saldo();

    function tableOutcome(){
        $("#tableOutcome").DataTable({
            info: false,
            bDestroy: true,
            ajax: {
                type: "GET",
                url: "/u/outcome/getData"
            },
            columns: [
                {
                    data: 'id_transaksi'
                },
                {
                    data: 'jenis_pengeluaran'
                },
                {
                    data: 'tgl'
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
                            <button class="btn btn-success btn-sm btn-icon" data-id="${row.id}" data-jenispengeluaran="${row.jenis_pengeluaran}" data-tanggal="${row.tgl}" data-nominal="${row.nominal}" data-catatan="${row.catatan}" onClick="updateOutcomeModal(${row.id})"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-danger btn-sm btn-icon" onClick="remove(${row.id})"><i class="bi bi-trash"></i></button>
                        `;
                    }
                }
            ]
        })
    }
    
    tableOutcome();

    function formTambah() {
        $("#contentModal").append(`
        <div class="mb-3">
            <label class="form-label">Jenis Pengeluaran</label>
            <select class="form-select form-select-solid" id="jenisPengeluaranForm">
                <option value="">Pilih</option>
                <option value="keperluan sehari-hari">Keperluan Sehari-hari</option>
                <option value="hutang">Hutang</option>
                <option value="cicilan">Cicilan</option>
                <option value="keinginan">Keinginan</option>
                <option value="bulanan">Bulanan</option>
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
            url: "/u/outcome/getDataFirst",
            data: {
                id
            },
            success: function(res){
                $("#contentModal").append(`
                <div class="mb-3">
                    <label class="form-label">Jenis Pengeluaran</label>
                    <select class="form-select form-select-solid" id="jenisPengeluaranForm" data-hide-search="true" data-control="select2">
                        <option value="${res.jenis_pengeluaran}">${res.jenis_pengeluaran}</option>
                        <option value="keperluan sehari-hari">Keperluan Sehari-hari</option>
                        <option value="hutang">Hutang</option>
                        <option value="cicilan">Cicilan</option>
                        <option value="keinginan">Keinginan</option>
                        <option value="bulanan">Bulanan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" class="form-control form-control-solid" id="tglOutcomeForm" value="${res.tgl}">
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
        let jenisPengeluaran = $("#jenisPengeluaranForm").val();
        let nominal = $("#nominalForm").val();
        let catatan = $("#catatanForm").val();

        $.ajax({
            type: "POST", 
            url: "/u/outcome/store",
            data: {
                jenis_pengeluaran: jenisPengeluaran,
                nominal: nominal,
                catatan: catatan
            },
            success: function(res){
                $("#modal").modal("hide");
                notifySwal("berhasil","success", res.message);
                tableOutcome();
                saldo();
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
        let jenisPengeluaranForm = $("#jenisPengeluaranForm").val();
        let tglOutcomeForm = $("#tglOutcomeForm").val();
        let nominalForm = $("#nominalForm").val();
        let catatanForm = $("#catatanForm").val();

        $.ajax({
            type: "PUT",
            url: "/u/outcome/update",
            data: {
                id: id,
                jenis_pengeluaran: jenisPengeluaranForm,
                tgl: tglOutcomeForm,
                nominal: nominalForm,
                catatan: catatanForm
            },
            success: function(res){
                $("#modal").modal("hide");
                notifySwal("berhasil","success", res.message);
                tableOutcome();
                saldo();
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
                    url: "/u/outcome/remove",
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

    function updateOutcomeModal(id){
        $("#judulModal").text("Update Income");
        $("#contentModal").empty();
        
        formUpdate(id);

        $("#modal").modal("show");
    }
</script>
@endpush