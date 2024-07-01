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
                        <h4 class="text-primary">REGISTER</h4>
                        <p class="text-muted">Isi data berikut</p>
                    </div>
                    <div class="p-2 mt-4">
                        <form action="#">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="namaLengkapForm" placeholder="Masukkan nama lengkap">
                            </div>
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
                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Register</button>
                            </div>
                        </form>
                        <p class="mt-3">Sudah memiliki akun ? <a href="/login">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection