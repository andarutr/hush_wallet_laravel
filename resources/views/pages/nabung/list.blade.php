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
function main(){
    $("#contentForm").empty().append(`
        <div class="mb-3">
            <label class="form-label">Jenis Tabungan</label>
            <select class="form-select form-select-solid" id="jenisTabunganForm">
                <option value="">Pilih jenis</option>
                <option value="Jangka Pendek">Jangka Pendek</option>
                <option value="Jangka Panjang">Jangka Panjang</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Platform</label>
            <select class="form-select form-select-solid" id="platformForm">
                <option value="">Pilih jenis</option>
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
            <a href="javascript:;" id="statusCatatan">Tambahkan catatan?</a>
            <label class="form-label" id="labelCatatan">Catatan</label>
            <textarea class="form-control form-control-solid" id="catatanForm"></textarea>
        </div>
        <button class="btn btn-primary mt-3" id="btnSubmit">Submit</button>
    `);
}

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

function savingCard(){
    $.ajax({
        type: "GET",
        url: "/u/nabung/getData",
        success: function(res){
            res.forEach(item => {
                let formattedDate = new Date(item.created_at).toLocaleDateString('en-US', { month: 'long', year: 'numeric' });

                let html = `
                <div class="d-flex flex-stack py-4">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-45px symbol-circle">
                            <img src="/assets/media/platforms/${res.picture}" class="img-fluid" />
                        </div>
                        <div class="ms-5">
                            <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Rp ${item.nominal}</a>
                            <div class="fw-bold text-muted">${item.platform}</div>
                        </div>
                    </div>
                    <div class="d-flex flex-column align-items-end ms-2">
                        <span class="text-muted fs-7 mb-1">${formattedDate}</span>
                    </div>
                </div>
                `;
            });

            $("#savingCard").empty().append(`
            
            `);
        }
    })
}

main();
savingCard();

$(document).on("click", "#statusCatatan", function(){
    $("#statusCatatan").hide("slow");
    $("#labelCatatan").show("slow");
    $("#catatanForm").show("slow");
});

$(document).off("click", "#btnSubmit");
$(document).on("click", "#btnSubmit", function(){
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
            resetForm();

            notifySuccessSwal(res.message);
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
});
</script>
@endpush