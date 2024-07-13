@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Transaksi Tabungan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label for="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggalFilter">
                    </div>
                </div>
                <table id="tableTransaksi" class="table table-bordered table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th>ID Transaksi</th>
                            <th>Jenis</th>
                            <th>Platform</th>
                            <th>Nominal</th>
                            <th>Catatan</th>
                            <th>Tgl Menabung</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <button class="btn btn-danger btn-sm mt-4" id="btnRemoveChoose" onClick="removeChoose()"><i class="bi bi-trash"></i> hapus</button>
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
$("#btnRemoveChoose").hide();

$("#tanggalFilter").change(function(){
    let search = $(this).val();
    table().columns(6).search(search).draw();
});

function notify(title, icon, message){
    Swal.fire({
        title: title,
        icon: icon,
        html: message
    });
}

function table(){
    $("#tableTransaksi").DataTable({
        ordering: false,
        bDestroy: true,
        info: false,
        searching: true,
        ajax: {
            type: "GET",
            url: "/u/nabung/transaksi/getData"
        },
        columns: [
            {
                render: function(data, type, row){
                    return `
                    <div class="form-check">
                        <input class="form-check-input checkwish fs-15" type="checkbox" value="${row.id}">
                    </div>
                    `;
                }
            },
            {
                data: "id_transaksi"
            },
            {
                data: "jenis_tabungan"
            },
            {
                data: "platform"
            },
            {
                data: "nominal",
                render: function(data, type, row){
                    let rupiah = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(data);

                    return `Rp. ${rupiah}`;
                }
            },
            {
                data: "catatan"
            },
            {
                data: "created_at",
                render: function(data, type, row){
                    return moment(data).format('DD MMMM YYYY')
                }
            },
            {
                render: function(data, type, row){
                    return `
                    <button class="btn btn-icon btn-sm btn-success" onClick="editModal(${row.id})"><i class="bi bi-pencil"></i></button>
                    <button class="btn btn-icon btn-sm btn-danger" onClick="remove(${row.id})"><i class="bi bi-trash"></i></button>
                    `;
                }
            }
        ]
    });
}

table();

function form(id){
    $.ajax({
        type: "GET",
        url: "/u/nabung/transaksi/getDataFirst",
        data: {
            id
        },
        success: function(res){
            let id = res.id;
            let tanggal = moment(res.created_at).format('YYYY-MM-DD');
            let jenis_tabungan = res.jenis_tabungan;
            let platform = res.platform;
            let rupiah = res.nominal;
            let catatan = res.catatan == null ? '' : res.catatan;

            $("#contentModal").append(`
                <div class="scroll-y me-n7 pe-7">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Tgl Menabung</label>
                                <input type="date" class="form-control form-control-solid" id="tanggalForm" value="${tanggal}">   
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Jenis Tabungan</label>
                                <select class="form-select form-select-solid" id="jenisTabunganForm" data-hide-search="true" data-control="select2" data-placeholder="${jenis_tabungan}">
                                    <option value="${jenis_tabungan}">${jenis_tabungan}</option>
                                    <option value="Jangka Pendek">Jangka Pendek</option>
                                    <option value="Jangka Panjang">Jangka Panjang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Platform</label>
                                <select class="form-select form-select-solid" data-hide-search="true" data-control="select2" id="platformForm" data-placeholder="${platform}">
                                    <option value="${platform}">${platform}</option>
                                    @foreach($nabung as $nb)
                                    <option value="{{ $nb->nama_platform }}">{{ $nb->nama_platform }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="form-label">Nominal</label>
                                <input type="number" class="form-control form-control-solid" id="nominalForm" value="${rupiah}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control form-control-solid" id="catatanForm">${catatan}</textarea>    
                        </div>
                    </div>
                    <button type="button" class="btn btn-success mt-3" onClick="update(${id})">Update</button>
                </div>
            `);
        }
    });
}

$(document).on("change", ".checkwish", function() {
    let anyChecked = $('.checkwish:checked').length > 0;
    if (anyChecked) {
        $('#btnRemoveChoose').fadeIn();
    } else {
        $('#btnRemoveChoose').fadeOut();
    }
});

function update(id){
    let tanggalForm = $("#tanggalForm").val();
    let jenisTabunganForm = $("#jenisTabunganForm").val();
    let platformForm = $("#platformForm").val();
    let nominalForm = $("#nominalForm").val();
    let catatanForm = $("#catatanForm").val();
    
    $.ajax({
        type: "PUT",
        url: "/u/nabung/transaksi/update",
        data: {
            id: id,
            created_at: tanggalForm,
            jenis_tabungan: jenisTabunganForm,
            platform: platformForm,
            nominal: nominalForm,
            catatan: catatanForm
        },
        success: function(res){
            $("#modal").modal("hide");
            notify("Berhasil", "success", res.message);
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

function remove(id){
    Swal.fire({
        title: "Konfirmasi",
        icon: "question",
        text: "Yakin ingin menghapus transaksi?",
        
        showCancelButton: true,
        confirmButtonText: "Yakin"
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                type: "DELETE",
                url: "/u/nabung/transaksi/remove",
                data: {
                    id
                },
                success: function(res){
                    notify("Berhasil", "success", res.message);
                    table();
                }
            });
        }
    });
}

function removeChoose(){
    let dataToSend = [];
    $("#tableTransaksi tbody input[type=checkbox].checkwish:checked").each(function(){
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
                url: "/u/nabung/transaksi/removeChoose",
                data: {
                    data: dataToSend
                },
                success: function(res){
                    notify("Berhasil", "success", res.message);
                    table();
                }
            });
        }
    });
}

// Modal
function editModal(id){
    $("#judulModal").text("Edit Transaksi");
    $("#contentModal").empty();

    form(id);

    $("#modal").modal("show");
}
</script>
@endpush