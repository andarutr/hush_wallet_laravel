@extends('layouts.master')

@section('content')
<div class="card mb-5 mb-xl-10">
    <div class="card-header card-header-stretch pb-0">
        <div class="card-title">
            <h3 class="m-0">List Wallets / Rekening</h3>
        </div>
    </div>

    <div class="card-body tab-content">
        <div class="tab-pane fade show active" role="tabpanel">
            <div class="row gx-9 gy-6">
                <div class="col-xl-12">
                    <button type="button" class="btn btn-primary btnAddModal" id="">Tambah Data</button>
                </div>
                <div id="containerMasterBank"></div>
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
function notifySuccess(message){
    Swal.fire({
        title: "Berhasil",
        icon: "success",
        text: message
    });
    $("#modal").modal("hide");
}

function notifyError(message){
    Swal.fire({
        title: "Error",
        icon: "error",
        html: message
    });
}

function containerMasterBank(){
    $.ajax({
        type: "GET",
        url: "/u/wallet/getData",
        dataType: "json",
        success: function(res){
            $("#containerMasterBank").empty();

            $.each(res, function(index, wallet){
                if (index % 2 === 0) {
                    $("#containerMasterBank").append('<div class="row mb-4"></div>');
                }

                $("#containerMasterBank .row:last-child").append(`
                    <div class="col-6">
                        <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                            <div class="d-flex flex-column py-2">
                                <div class="d-flex align-items-center fs-4 fw-bolder mb-5">${wallet.bank}</div>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/media/banks') }}/${wallet.picture}" alt="" class="img-fluid me-4 rounded" width="50" />
                                    <div>
                                        <div class="fs-4 fw-bolder">${wallet.rekening}</div>
                                        <div class="fs-6 fw-bold text-gray-400">Saldo: Rp. ${wallet.saldo}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center py-2">
                                <button class="btn btn-icon btn-sm btn-success me-3 btnEditModal" data-id="${wallet.id}" data-bank="${wallet.bank}" data-rekening="${wallet.rekening}" data-saldo="${wallet.saldo}"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-icon btn-sm btn-danger me-3 btnRemove" data-id="${wallet.id}"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                    </div>
                `);
            });
        }
    })
}

containerMasterBank();

$(document).on("click", ".btnAddModal", function(){
    $("#judulModal").text("Tambah Data Dompet");

    $("#contentModal").empty().append(`
    <div class="scroll-y me-n7 pe-7">
        <div class="mb-3">
            <label class="form-label">No. Rekening</label>
            <input type="number" class="form-control form-control-solid" id="noRekeningForm">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Bank</label>
            <select class="form-select form-select-solid" id="namaBankForm">
                <option value="">Pilih jenis</option>
                @foreach($rekening as $rek)
                <option value="{{ $rek->nama_bank }}">{{ $rek->nama_bank }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Saldo Terakhir</label>
            <input type="number" class="form-control form-control-solid" id="saldoForm">
        </div>
        <button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
    </div>
    `);

    $(document).on("click", "#btnSubmit", function(){
        let namaBankForm = $("#namaBankForm").val();
        let noRekeningForm = $("#noRekeningForm").val();
        let saldoForm = $("#saldoForm").val();

        $.ajax({
            type: "POST",
            url: "/u/wallet/store",
            data: {
                bank: namaBankForm,
                rekening: noRekeningForm,
                saldo: saldoForm
            },
            success: function(res){
                notifySuccess(res.message);
                containerMasterBank();
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let message = '';

                $.each(errors, function(key, value) {
                    message += value[0] + '<br>';
                });

                notifyError(message);
            }
        })
    });

    $("#modal").modal("show");
});

$(document).off("click", ".btnEditModal");
$(document).on("click", ".btnEditModal", function(){
    let id = $(this).data("id");
    let bank = $(this).data("bank");
    let rekening = $(this).data("rekening");
    let saldo = $(this).data("saldo");

    $("#judulModal").text("Tambah Data Dompet");

    $("#contentModal").empty().append(`
    <div class="scroll-y me-n7 pe-7">
        <div class="mb-3">
            <label class="form-label">No. Rekening</label>
            <input type="number" class="form-control form-control-solid" id="noRekeningForm" value="${rekening}">
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Bank</label>
            <select class="form-select form-select-solid" id="namaBankForm">
                <option value="${bank}">${bank}</option>
                @foreach($rekening as $rek)
                <option value="{{ $rek->nama_bank }}">{{ $rek->nama_bank }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Saldo Terakhir</label>
            <input type="number" class="form-control form-control-solid" id="saldoForm" value="${saldo}">
        </div>
        <button type="button" class="btn btn-success" id="btnEdit">Update</button>
    </div>
    `);

    $(document).off("click", "#btnEdit");
    $(document).on("click", "#btnEdit", function(){
        let namaBankForm = $("#namaBankForm").val();
        let noRekeningForm = $("#noRekeningForm").val();
        let saldoForm = $("#saldoForm").val();

        $.ajax({
            type: "PUT",
            url: "/u/wallet/update",
            data: {
                id:id,
                bank: namaBankForm,
                rekening: noRekeningForm,
                saldo: saldoForm
            },
            success: function(res){
                notifySuccess(res.message);
                containerMasterBank();
            },
            error: function(xhr){
                let errors = xhr.responseJSON.errors;
                let message = '';

                $.each(errors, function(key, value) {
                    message += value[0] + '<br>';
                });

                notifyError(message);
            }
        })
    });

    $("#modal").modal("show");
});

$(document).off("click", ".btnRemove");
$(document).on("click", ".btnRemove", function(){
    let id = $(this).data("id");
    
    Swal.fire({
        title: "Konfirmasi",
        icon: "info",
        text: "Yakin ingin menghapus data?",
        
        showCancelButton: true,
        confirmButtonText: "Hapus",
        confirmButtonColor: "#ED5E5E"
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                type: "DELETE", 
                url: "/u/wallet/remove",
                data: {
                    data: {
                        id
                    }
                },
                success: function(res){
                    notifySuccess(res.message);
                    $(`.btnRemove[data-id="${id}"]`).closest(".col-6").remove();
                }
            });
        }
    });
});
</script>
@endpush