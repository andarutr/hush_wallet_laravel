@extends('layouts.master')

@push('styles')
<link rel="stylesheet" href="/assets/libs/dragula/dragula.min.css" />
@endpush

@section('content')
<div class="tasks-board mb-3" id="kanbanboard">
    <div class="tasks-list">
        <div class="d-flex mb-3">
            <div class="flex-grow-1">
                <h6 class="fs-13 text-uppercase mb-0">Jangka Pendek <small
                        class="badge bg-success align-bottom ms-1 totaltask-badge">2</small></h6>
            </div>
        </div>
        <div data-simplebar class="tasks-wrapper px-3 mx-n3">
            <div id="unassigned-task" class="tasks">
                <div class="card tasks-box">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <h6 class="fs-14 mb-0 flex-grow-1 text-truncate task-title"><a
                                    href="apps-tasks-details.html" class="text-body d-block">Buat Portfolio Baru</a></h6>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="ri-edit-2-line align-bottom me-2 text-muted"></i>
                                            Edit</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i
                                                class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i>
                                            Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-muted">Membuat financial system menggunakan Laravel, jQuery, Ajax dan MySQL</p>
                    </div>
                </div>
            </div>
            <!--end tasks-->
        </div>
        <div class="my-3">
            <button class="btn btn-soft-info w-100" data-bs-toggle="modal" data-bs-target="#creatertaskModal">Add
                More</button>
        </div>
    </div>
    <!--end tasks-list-->
    <div class="tasks-list">
        <div class="d-flex mb-3">
            <div class="flex-grow-1">
                <h6 class="fs-13 text-uppercase mb-0">Jangka Panjang <small
                        class="badge bg-secondary align-bottom ms-1 totaltask-badge">2</small></h6>
            </div>
        </div>
        <div data-simplebar class="tasks-wrapper px-3 mx-n3">
            <div id="todo-task" class="tasks">
                <div class="card tasks-box">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <h6 class="fs-14 mb-0 flex-grow-1 text-truncate task-title"><a
                                    href="apps-tasks-details.html" class="text-body d-block">Buat Portfolio Baru</a></h6>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="ri-edit-2-line align-bottom me-2 text-muted"></i>
                                            Edit</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i
                                                class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i>
                                            Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-muted">Membuat financial system menggunakan Laravel, jQuery, Ajax dan MySQL</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3">
            <button class="btn btn-soft-info w-100" data-bs-toggle="modal" data-bs-target="#creatertaskModal">Add
                More</button>
        </div>
    </div>

    <div class="tasks-list">
        <div class="d-flex mb-3">
            <div class="flex-grow-1">
                <h6 class="fs-13 text-uppercase mb-0">new <small
                        class="badge bg-success align-bottom ms-1 totaltask-badge">1</small></h6>
            </div>
            <div class="flex-shrink-0">
                <div class="dropdown card-header-dropdown">
                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <span class="fw-medium text-muted fs-12">Priority<i
                                class="mdi mdi-chevron-down ms-1"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Priority</a>
                        <a class="dropdown-item" href="#">Date Added</a>
                    </div>
                </div>
            </div>
        </div>
        <div data-simplebar class="tasks-wrapper px-3 mx-n3">
            <div id="new-task" class="tasks">
                <div class="card tasks-box">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <h6 class="fs-14 mb-0 flex-grow-1 text-truncate task-title"><a
                                    href="apps-tasks-details.html" class="text-body d-block">Buat Portfolio Baru</a></h6>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="text-muted" id="dropdownMenuLink1"
                                    data-bs-toggle="dropdown" aria-expanded="false"><i class="ri-more-fill"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="ri-edit-2-line align-bottom me-2 text-muted"></i>
                                            Edit</a></li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal" href="#deleteRecordModal"><i
                                                class="ri-delete-bin-5-line align-bottom me-2 text-muted"></i>
                                            Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-muted">Membuat financial system menggunakan Laravel, jQuery, Ajax dan MySQL</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3">
            <button class="btn btn-soft-info w-100" data-bs-toggle="modal" data-bs-target="#creatertaskModal">Add
                More</button>
        </div>
    </div>
</div>

<div class="modal fade" id="creatertaskModal" tabindex="-1" aria-labelledby="creatertaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header p-3 bg-info-subtle">
                <h5 class="modal-title" id="creatertaskModalLabel">Tambah Goals Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control">
                        </div>
                        
                        <div class="col-lg-12">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mt-4">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success">Add Task</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="/assets/libs/dragula/dragula.min.js"></script>
<script src="/assets/js/pages/tasks-kanban.init.js"></script>
@endpush