@extends('layouts.master')

@push('styles')
<style>
.bi-eye{
    cursor: pointer;
}

.bi-eye-slash{
    cursor: pointer;
}

.bi-eye-slash{
    display: none;
}
</style>
@endpush

@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-5 mb-xl-8">
                <div class="card-body pt-15">
                    <div id="containerProfile"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#profileTab">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                        href="#changePasswordTab">Ganti Password</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="profileTab" role="tabpanel">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Profile</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="mb-3">
                                <label class="required form-label">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-solid" value="{{ auth()->user()->nama }}" id="namaForm"/>
                            </div>
                            <div class="mb-3">
                                <label class="required form-label">Email</label>
                                <input type="email" class="form-control form-control-solid" value="{{ auth()->user()->email }}" id="emailForm"/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <select class="form-select form-select-solid" id="pekerjaanForm">
                                    <option value="{{ auth()->user()->pekerjaan ? auth()->user()->pekerjaan : '' }}">{{ auth()->user()->pekerjaan ? auth()->user()->pekerjaan : 'Pilih' }}</option>
                                    <option value="bekerja">Bekerja</option>
                                    <option value="belum bekerja">Belum Bekerja</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary btn-sm" onClick="updateProfile()"><i class="bi bi-send"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="changePasswordTab" role="tabpanel">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <div class="card-header border-0">
                            <div class="card-title">
                                <h2>Ganti Password</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 pb-5">
                            <div class="mb-3">
                                <label class="form-label">Password Lama 
                                </label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-solid" id="oldPasswordForm"/>
                                    <span class="input-group-text">
                                        <i class="bi bi-eye" onClick="showPassword('old')" id="oldShowPassword"></i>
                                        <i class="bi bi-eye-slash" onClick="hidePassword('old')" id="oldHidePassword"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control form-control-solid" id="newPasswordForm"/>
                                    <span class="input-group-text">
                                        <i class="bi bi-eye" onClick="showPassword('new')" id="newShowPassword"></i>
                                        <i class="bi bi-eye-slash" onClick="hidePassword('new')" id="newHidePassword"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary btn-sm" onClick="updatePassword()"><i class="bi bi-send"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function showPassword(status){
        $("#"+status+"PasswordForm").attr("type","text");
        $("#"+status+"ShowPassword").hide();
        $("#"+status+"HidePassword").show();
    }

    function hidePassword(status){
        $("#"+status+"PasswordForm").attr("type","password");
        $("#"+status+"HidePassword").hide();
        $("#"+status+"ShowPassword").show();
    }

    function notifySwal(title, icon, message){
        Swal.fire({
            title: title,
            icon: icon,
            html: message,
        });
    }

    function containerProfile(){
        $.ajax({
            type: "GET",
            url: "/settings/getData",
            success: function(res){
                $("#containerProfile").empty();
                $("#containerProfile").append(`
                    <div class="d-flex flex-center flex-column">
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            <img src="{{ asset('assets/media/avatars/blank.png') }}" class="img-fluid me-4 rounded" width="150" />
                        </div>
                        <a href="javascript:;" class="fs-3 text-gray-800 text-hover-primary fw-bolder mb-1">${res.nama}</a>
                        <div class="fs-5 fw-bold text-muted mb-6">${res.email}</div>
                    </div>
                    <p class="fw-bold text-muted">Pekerjaan: ${res.pekerjaan ? res.pekerjaan : 'Belum diisi'}</p>
                    <p class="fw-bold text-muted">Role: ${res.is_admin == 'y' ? 'Admin' : 'User'}</p>
                `);
            }
        })
    }

    containerProfile();

    function updateProfile(){
        let namaForm = $("#namaForm").val();
        let emailForm = $("#emailForm").val();
        let pekerjaanForm = $("#pekerjaanForm").val();

        $.ajax({
            type: "PUT",
            url: "/settings/update_profile",
            data: {
                nama: namaForm,
                email: emailForm,
                pekerjaan: pekerjaanForm
            },
            success: function(res){
                notifySwal("Berhasil","success", res.message);
                containerProfile();
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

    function updatePassword(){
        let oldPasswordForm = $("#oldPasswordForm").val();
        let newPasswordForm = $("#newPasswordForm").val();

        $.ajax({
            type: "PUT",
            url: "/settings/update_password",
            data: {
                old_password: oldPasswordForm,
                new_password: newPasswordForm
            },
            success: function(res){
                if(res.status == "success"){
                    notifySwal("Berhasil", "success", res.message);
                }else{
                    notifySwal("Gagal", "error", res.message);
                }

                $("input[type=password]").val('');
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
</script>
@endpush