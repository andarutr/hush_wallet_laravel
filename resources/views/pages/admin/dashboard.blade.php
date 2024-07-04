@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-xxl-5">
        <div class="d-flex flex-column h-100">
            <div class="row h-100">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="row align-items-end">
                                <div class="col-sm-8">
                                    <div class="p-3">
                                        <p class="fs-17 lh-base">Selamat Datang Andaru Triadi<span
                                                class="fw-semibold"> jangan lupa</span>, Nabung ya untuk masa depan... <i
                                                class="mdi mdi-arrow-right"></i></p>
                                        <div class="mt-3">
                                            <a href="#"
                                                class="btn btn-success">Nabung!</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="px-3">
                                        <img src="{{ asset('assets/images/user-illustarator-1.png') }}"
                                            class="img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end card-body-->
                    </div>
                </div> <!-- end col-->
            </div> <!-- end row-->

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Income</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span
                                            class="counter-value" data-target="28.05">0</span>k</h2>
                                    <p class="mb-0 text-muted"><span
                                            class="badge bg-light text-success mb-0">
                                            <i class="ri-arrow-up-line align-middle"></i> 16.24 %
                                        </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i data-feather="users" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Outcome</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span
                                            class="counter-value" data-target="97.66">0</span>k</h2>
                                    <p class="mb-0 text-muted"><span
                                            class="badge bg-light text-danger mb-0">
                                            <i class="ri-arrow-down-line align-middle"></i> 3.96 %
                                        </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i data-feather="activity" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row-->

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Tabungan</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span
                                            class="counter-value" data-target="3">0</span>m
                                        <span class="counter-value" data-target="40">0</span>sec
                                    </h2>
                                    <p class="mb-0 text-muted"><span
                                            class="badge bg-light text-danger mb-0">
                                            <i class="ri-arrow-down-line align-middle"></i> 0.24 %
                                        </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i data-feather="clock" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->

                <div class="col-md-6">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Goals</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span
                                            class="counter-value" data-target="33.48">0</span>%</h2>
                                    <p class="mb-0 text-muted"><span
                                            class="badge bg-light text-success mb-0">
                                            <i class="ri-arrow-up-line align-middle"></i> 7.05 %
                                        </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span
                                            class="avatar-title bg-info-subtle rounded-circle fs-2">
                                            <i data-feather="external-link" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div> <!-- end card-->
                </div> <!-- end col-->
            </div> <!-- end row-->
        </div>
    </div> <!-- end col-->
</div>
@endsection