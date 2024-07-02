@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                      <center>
                        <img src="/assets/images/hush.png" class="img-fluid" width="150">
                      </center>
                        <h4 class="text-primary">LOGIN</h4>
                        <p class="text-muted">Silahkan login</p>
                    </div>
                    <div class="p-2 mt-4">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailForm" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="position-relative auth-pass-inputgroup mb-3">
                                <input type="password" class="form-control pe-5 password-input" id="passwordForm" placeholder="Masukkan password">
                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-success w-100" id="btnLogin">Login</button>
                        </div>
                        <p class="mt-3">Tidak memiliki akun ? <a href="/register">Register</a></p>
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
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