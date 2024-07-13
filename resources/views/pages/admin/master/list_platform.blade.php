@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-toolbar">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" onClick="showModal()">Tambah Data</button>
            </div>
        </div>
    </div>

    <div class="card-body pt-0">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="masterPlatformTable">
            <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" type="checkbox" id="checkAll" />
                        </div>
                    </th>
                    <th>Logo</th>
                    <th>Nama Platform</th>
                    <th>Dibuat</th>
                    <th>Diperbarui</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<button class="btn btn-danger btn-sm mt-4" id="btnRemoveChoose" onClick="removeChoose()"><i class="bi bi-trash"></i> hapus</button>

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
<script src="https://momentjs.com/downloads/moment.js"></script>
<script>
$("#btnRemoveChoose").hide();

function notifySuccess(message){
    Swal.fire({
        title: "Berhasil",
        icon: "success",
        text: message
    });

    $("input").val('');
    $(".modalHush").modal("hide");
    $("#btnRemoveChoose").hide();
}

function notifyError(message){
    Swal.fire({
        title: "Error",
        icon: "error",
        html: message
    });
}

function table(){
    $("#masterPlatformTable").DataTable({
        searching: true,
        serverSide: true,
        info: false,
        paging: false,
        ordering: false,
        bDestroy: true,
        ajax: {
            type: "GET",
            url: "/su/master/platform/getData"
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
                    return `<img src="/assets/media/platforms/${data}" class="img-fluid rounded" width="50">`
                }
            },
            {
                data: "nama_platform"
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
                    return `<button class="btn btn-sm btn-danger" id="btnRemove" onClick="remove(${row.id})"><i class="bi bi-trash"></i></button>`;
                }
            },
        ]
    });
} 

table();

function form(){
    $("#contentModal").empty().append(`
        <div class="scroll-y me-n7 pe-7">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Nama Platform</label>
                        <input class="form-control form-control-solid" id="namaPlatformForm">   
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label class="form-label">Foto Logo</label>
                        <input type="file" id="pictureForm" class="form-control">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" onClick="store()">Submit</button>
        </div>
    `);
}

function store(){
    let namaPlatformForm = $("#namaPlatformForm").val();
    let pictureForm = $("#pictureForm")[0].files[0];

    let formData = new FormData();
    formData.append("nama_platform", namaPlatformForm);
    formData.append("picture", pictureForm);

    $.ajax({
        type: "POST",
        url: "/su/master/platform/store",
        data: formData,
        processData: false,
        contentType: false,
        success: function(res){
            $("#modal").modal("hide");
            notifySuccess(res.message);
            table();
        },
        error: function(xhr){
            let errors = xhr.responseJSON.errors;
            let message = '';

            $.each(errors, function(key, value) {
                message += value[0] + '<br>';
            });

            notifyError(message);
        }
    });
}

$(document).on("change", ".checkwish", function() {
    let anyChecked = $('.checkwish:checked').length > 0;
    if (anyChecked) {
        $('#btnRemoveChoose').show();
    } else {
        $('#btnRemoveChoose').hide();
    }
});

function remove(id){
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
                url: "/su/master/platform/remove",
                data: {
                    id
                },
                success: function(res){
                    notifySuccess(res.message);
                    table();
                }
            });
        }
    });
}

function removeChoose(){
    let dataToSend = [];
    $("#masterPlatformTable tbody input[type=checkbox].checkwish:checked").each(function(){
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
                url: "/su/master/platform/removeChoose",
                data: {
                    data: dataToSend
                },
                success: function(res){
                    notifySuccess(res.message);
                    table();
                }
            });
        }
    });
}

// Modal
function showModal(){
    $("#judulModal").text("Tambah Master Data Bank");
    $("#contentModal").empty();

    form();

    $("#modal").modal("show");
}
</script>
@endpush