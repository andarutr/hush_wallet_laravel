@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card" id="tasksList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Master Data Bank</h5>
                    <div class="flex-shrink-0">
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-sm btn-primary" id="btnShowModal"><i
                                    class="ri-add-line align-bottom me-1"></i> Tambah Data</button>
                            <button class="btn btn-soft-secondary" id="remove-actions" onClick="deleteMultiple()"><i
                                    class="ri-delete-bin-2-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end card-body-->
            <div class="card-body">
                <div class="table-card mb-4">
                    <table class="table" id="masterBankTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 40px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                    </div>
                                </th>
                                <th class="sort">Logo</th>
                                <th class="sort">Nama Bank</th>
                                <th class="sort">Dibuat</th>
                                <th class="sort">Diperbarui</th>
                                <th class="sort">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <button class="btn btn-sm btn-danger mb-5" id="btnRemoveChoose"><i class="mdi mdi-trash-can"></i> hapus</button>
    </div>
</div>

{{-- id="removeNotificationModal" jangan dihapus --}}
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
</div>
@endsection

@push('scripts')
<script src="https://momentjs.com/downloads/moment.js"></script>
<script>
$("#btnRemoveChoose").hide();

let table = $("#masterBankTable").DataTable({
    searching: false,
    serverSide: true,
    info: false,
    paging: false,
    ordering: false,
    ajax: {
        type: "GET",
        url: "/su/master/bank/getData"
    },
    columns: [
        {
            render: function(data, type, row){
                return `<input type="checkbox" class="form-check-input checkwish" value="${row.id}">`;
            }
        },
        {
            data: "picture",
            render: function(data,type, row){
                return `<img src="/assets/images/banks/${data}" class="img-fluid rounded" width="50">`
            }
        },
        {
            data: "nama_bank"
        },
        {
            data: "created_at",
            render: function(data, type, row){
                let created_at = moment(data).format('LL');
                return `${created_at}`;
            }
        },
        {
            data: "updated_at",
            render: function(data, type, row){
                let updated_at = moment(data).format('LL');
                return `${updated_at}`;
            }
        },
        {
            render: function(data, type, row){
                return `<button class="btn btn-sm btn-danger btnRemove" data-id="${row.id}"><i class="mdi mdi-trash-can"></i></button>`;
            }
        },
    ]
});

$(document).on("change", ".checkwish", function() {
    let anyChecked = $('.checkwish:checked').length > 0;
    if (anyChecked) {
        $('#btnRemoveChoose').show();
    } else {
        $('#btnRemoveChoose').hide();
    }
});

function notifySuccess(message){
    Swal.fire({
        title: "Berhasil",
        icon: "success",
        text: message
    });

    $("input").val('');
    $(".modalHush").modal("hide");
    $("#btnRemoveChoose").hide();
    table.ajax.reload();
}

function notifyError(message){
    Swal.fire({
        title: "Error",
        icon: "error",
        html: message
    });
}

$(document).on("click", "#btnShowModal", function(){
    $("#judulModal").text("Tambah Master Data Bank");

    $("#contentModal").empty().append(`
        <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label">Nama Bank</label>
                    <input class="form-control" id="namaBankForm">   
                </div>
            </div>

            <div class="col-sm-6">
                <div class="mb-3">
                    <label class="form-label">Foto Logo</label>
                    <input type="file" id="pictureForm" class="form-control">
                </div>
            </div>
        </div>

        <button type="button" class="btn btn-primary" id="btnSubmit">Submit</button>
    `);
    
    $(document).on("click", "#btnSubmit", function(){
        let namaForm = $("#namaBankForm").val();
        let pictureForm = $("#pictureForm")[0].files[0];

        let formData = new FormData();
        formData.append("nama_bank", namaForm);
        formData.append("picture", pictureForm);

        $.ajax({
            type: "POST",
            url: "/su/master/bank/store",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                notifySuccess(res.message);
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

    $(".modalHush").modal("show");
});

$(document).on("click", "#btnRemoveChoose", function(){
    let dataToSend = [];
    $("#masterBankTable tbody input[type=checkbox].checkwish:checked").each(function(){
        checkwishId = $(this).val();

        dataToSend.push({checkwishId});
    });

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
                url: "/su/master/bank/removeChoose",
                data: {
                    data: dataToSend
                },
                success: function(res){
                    notifySuccess(res.message);
                }
            });
        }
    });
});

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
                url: "/su/master/bank/remove",
                data: {
                    id
                },
                success: function(res){
                    notifySuccess(res.message);
                }
            });
        }
    });
});
</script>
@endpush