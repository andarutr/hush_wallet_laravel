@extends('layouts.master')

@push('styles')
<style> 
    #labelCatatan, #catatanForm {
        display: none
    }
</style>
@endpush

@section('content')
<div class="d-flex flex-column flex-lg-row">
    <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
        <div class="card card-flush">
            <div class="card-header pt-7">
                <h5>List Menabung</h5>
            </div>
            <div class="card-body pt-5" id="kt_chat_contacts_body">
                <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto">
                    <div id="savingCard"></div>
                    <a href="/u/nabung/transaksi">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
        <div class="card" id="kt_chat_messenger">
            <div class="card-header" id="kt_chat_messenger_header">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <h5 class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1" id="judulForm">Tambah Data</h5>
                    </div>
                </div>
            </div>
            
            <div class="card-body" id="contentForm"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function notifySuccessSwal(message){
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: message,
    });
}

function notifyErrorSwal(message){
    Swal.fire({
        icon: 'error',
        title: 'Error',
        html: message,
    });
}

function resetForm(){
    $("input").val('');
    $("select").val('');
    $("textarea").val('');
}

function form(){
    $("#contentForm").empty().append(`
        <div class="mb-3">
            <label class="form-label">Jenis Tabungan</label>
            <select class="form-select form-select-solid" id="jenisTabunganForm" data-hide-search="true" data-control="select2" data-placeholder="Pilih">
                <option></option>
                <option value="Jangka Pendek">Jangka Pendek</option>
                <option value="Jangka Panjang">Jangka Panjang</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Platform</label>
            <select class="form-select form-select-solid" data-hide-search="true" data-control="select2" id="platformForm" data-placeholder="Pilih">
                <option></option>
                @foreach($nabung as $nb)
                <option value="{{ $nb->nama_platform }}">{{ $nb->nama_platform }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Nominal</label>
            <input type="number" class="form-control form-control-solid" id="nominalForm">
        </div>
        <div class="mb-3">
            <a href="javascript:;" onClick="showCatatan()">Tambahkan catatan?</a>
            <label class="form-label" id="labelCatatan">Catatan</label>
            <textarea class="form-control form-control-solid" id="catatanForm"></textarea>
        </div>
        <button class="btn btn-primary mt-3" id="btnSubmit">Submit</button>
    `);
}

form();

function savingCard(){
    $.ajax({
        type: "GET",
        url: "/u/nabung/getData",
        success: function(res){
            let html = '';

            res.forEach(item => {
                let formattedDate = moment(item.created_at).format("DD MMMM YYYY");
                let rupiah = new Intl.NumberFormat("id-ID", { style: 'currency', currency: 'IDR' }).format(item.nominal);

                html += `
                <div class="d-flex flex-stack py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-45px symbol-circle">
                            <img src="/assets/media/platforms/${item.picture}" class="img-fluid" />
                        </div>
                        <div class="ms-5">
                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Rp ${rupiah}</a>
                            <div class="fw-bold text-muted">${item.platform}</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-end ms-2">
                        <span class="text-muted fs-7 mb-1">${formattedDate}</span>
                    </div>
                </div>
                `;
            });

            $("#savingCard").append(html);
        }
    })
}

savingCard();

function showCatatan(){
    $("#statusCatatan").hide("slow");
    $("#labelCatatan").show("slow");
    $("#catatanForm").show("slow");
}

function store(){
    let jenisTabunganForm = $("#jenisTabunganForm").val();
    let platformForm = $("#platformForm").val();
    let nominalForm = $("#nominalForm").val();
    let catatanForm = $("#catatanForm").val();
    
    $.ajax({
        type: "POST",
        url: "/u/nabung/store",
        data: {
            jenis_tabungan: jenisTabunganForm,
            platform: platformForm,
            nominal: nominalForm,
            catatan: catatanForm
        },
        success: function(res){
            notifySuccessSwal(res.message);
            resetForm();
        },
        error: function(xhr){
            let errors = xhr.responseJSON.errors;
			let message = '';
			$.each(errors, function(key, value) {
				message += value[0] + '<br>';
			});

            notifyErrorSwal(message);
        }
    });
}
</script>
@endpush