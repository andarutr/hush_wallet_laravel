@extends('layouts.auth')

@section('content')
<div class="text-center mb-10">
    <h1 class="text-dark mb-3">Login</h1>
    <div class="text-gray-400 fw-bold fs-4">Belum memiliki akun?
    <a href="/register" class="link-primary fw-bolder">Daftar disini...</a></div>
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
    <button type="submit" id="btnLogin" class="btn btn-lg btn-primary w-100 mb-5">Login</button>
</div>
@endsection

@push('scripts')
<script>
function notifyError(title, icon, message){
    Swal.fire({
        title: title,
        icon: icon,
        html: message
    });
}

$(document).on("click", "#btnLogin", function(){
    let emailForm = $("#emailForm").val();
    let passwordForm = $("#passwordForm").val();

    $.ajax({
        type: "POST",
        url: "/login", 
        data: {
            email: emailForm,
            password: passwordForm
        },
        success: function(res){
            if(res.status == "success"){
                if(res.is_admin == "y"){
                    window.location.href = "/su/dashboard";
                }else{
                    window.location.href = "/u/dashboard";
                }
            }else if(res.status == "error"){
                Swal.fire("error", "Email dan password salah!", "error");
                $("#passwordForm").val('');
            }
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