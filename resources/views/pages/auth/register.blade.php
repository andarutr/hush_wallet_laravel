@extends('layouts.auth')

@section('content')
<div class="text-center mb-10">
    <h1 class="text-dark mb-3">Register</h1>
    <div class="text-gray-400 fw-bold fs-4">Sudah memiliki akun?
    <a href="/login" class="link-primary fw-bolder">Login disini...</a></div>
</div>

<div class="fv-row mb-10">
    <label class="form-label fs-6 fw-bolder text-dark">Nama Lengkap</label>
    <input class="form-control form-control-lg form-control-solid" type="text" id="namaLengkapForm" />
</div>

<div class="fv-row mb-10">
    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
    <input class="form-control form-control-lg form-control-solid" type="text" id="emailForm" autocomplete="off" />
</div>

<div class="fv-row mb-10">
    <div class="d-flex flex-stack mb-2">
        <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
    </div>
    <input class="form-control form-control-lg form-control-solid" type="password" id="passwordForm" autocomplete="off" />
</div>

<div class="text-center">
    <button type="submit" id="btnRegister" class="btn btn-lg btn-primary w-100 mb-5">Register</button>
</div>
@endsection

@push('scripts')
<script>
function notifySuccess(title, icon, message){
    Swal.fire({
        title: title,
        icon: icon,
        text: message
    });

    $("input").val('');
}

function notifyError(title, icon, message){
    Swal.fire({
        title: title,
        icon: icon,
        html: message
    });
}

$(document).on("click", "#btnRegister", function(){
    let namaLengkapForm = $("#namaLengkapForm").val();
    let emailForm = $("#emailForm").val();
    let passwordForm = $("#passwordForm").val();

    $.ajax({
        type: "POST",
        url: "/register",
        data: {
            nama: namaLengkapForm,
            email: emailForm,
            password: passwordForm
        },
        success: function(res){
            notifySuccess("Berhasil", "success", res.message);
        },
        error: function(xhr){
            let errors = xhr.responseJSON.errors;
			let message = '';

			$.each(errors, function(key, value) {
				message += value[0] + '<br>';
			});

            notifyError("Gagal", "error", message);
        }
    })
});
</script>
@endpush