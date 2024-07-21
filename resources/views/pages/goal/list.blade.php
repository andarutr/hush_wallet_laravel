@extends('layouts.master')

@push('styles')
<style>
.card-body {
    max-height: 250px; 
    overflow-y: auto; 
}
.symbol-circle{
    cursor: pointer;
}
</style>
@endpush

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Tambah Goals</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div id="containerGoals"></div>
            </div>

            <div class="card-footer pt-4">
                <div class="row">
                    <p>Note: klik icon <i class="bi bi-record-circle"></i> apabila goals telah tercapai.</p>
                    <div class="col-lg-4">
                        <input class="form-control mb-3" placeholder="Masukkan Judul" id="judulForm">
                    </div>
                    <div class="col-lg-8">
                        <input class="form-control mb-3" placeholder="Masukkan Deskripsi" id="catatanForm">
                    </div>
                </div>
                <div class="d-flex flex-stack">
                    <button class="btn btn-primary form-control" type="button" onClick="store()">Tambahkan</button>
                </div>
            </div>
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
    }

    function containerGoals(){
        $.ajax({
            type: "GET",
            url: "/u/goals/getData",
            success: function(res){
                $("#containerGoals").empty();

                $.each(res, function(index, goal){
                    let icon = '';
                    goal.is_checked == 0 ? icon = `<i style="font-size: 20px;" class="bi bi-record-circle text-danger" onClick="checkList(${goal.id})"></i>` : icon = `<i style="font-size: 20px;" class="bi bi-check2-square text-success" onClick="unCheckList(${goal.id})"></i>`; 

                    $("#containerGoals").append(`
                        <div class="d-flex flex-stack py-4">
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-45px symbol-circle">
                                    ${icon}
                                </div>
                                <div class="ms-5">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">${goal.judul}</a>
                                    <div class="fw-bold text-muted">${goal.catatan}</div>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-end ms-2">
                                <span class="text-muted fs-7 mb-1">${moment(goal.created_at).format('DD MMMM YYYY')}</span>
                            </div>
                        </div>
                    `);
                });
            }
        })
    }

    containerGoals();

    function store(){
        let judulForm = $("#judulForm").val();
        let catatanForm = $("#catatanForm").val();

        $.ajax({
            type: "POST",
            url: "/u/goals/store",
            data: {
                judul: judulForm,
                catatan: catatanForm
            },
            success: function(res){
                containerGoals();
                resetForm();
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

    function checkList(id){
        $.ajax({
            type: "PUT",
            url: "/u/goals/checklist",
            data: {
                id
            },
            success: function(res){
                containerGoals();
            }
        })
    }
    
    function unCheckList(id){
        $.ajax({
            type: "PUT",
            url: "/u/goals/unchecklist",
            data: {
                id
            },
            success: function(res){
                containerGoals();
            }
        })
    }
</script>
@endpush