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
                <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="0px">
                    <div class="d-flex flex-stack py-4">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px symbol-circle">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRic1znecxO-qDy385l4Zd8VyPpZQgn_i7CkQ&s" />
                            </div>
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Rp 150.000</a>
                                <div class="fw-bold text-muted">Nanovest (Saham)</div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end ms-2">
                            <span class="text-muted fs-7 mb-1">July 2024</span>
                        </div>
                    </div>
                    <div class="d-flex flex-stack py-4">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-45px symbol-circle">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRic1znecxO-qDy385l4Zd8VyPpZQgn_i7CkQ&s" />
                            </div>
                            <div class="ms-5">
                                <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">Rp 500.000</a>
                                <div class="fw-bold text-muted">Nanovest (Emas)</div>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end ms-2">
                            <span class="text-muted fs-7 mb-1">July 2024</span>
                        </div>
                    </div>
                    {{-- looping --}}
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
                <option value="Ajaib">Ajaib</option>
                <option value="Stockbit">Stockbit</option>
                <option value="Nanovest (Saham)">Nanovest (Saham)</option>
                <option value="Nanovest (Emas)">Nanovest (Emas)</option>
                // Jangan lupa master datanya!
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
        <button class="btn btn-primary mt-3">Submit</button>
    `);
}

main();

$(document).on("click", "#statusCatatan", function(){
    $("#statusCatatan").hide("slow");
    $("#labelCatatan").show("slow");
    $("#catatanForm").show("slow");
});
</script>
@endpush