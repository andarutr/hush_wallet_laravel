<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Logo-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">
        <img alt="Logo" src="{{ asset('assets/media/logos/hush.png') }}" class="img-fluid rounded-circle mt-3" width="100" />
    </div>
    <!--end::Logo-->
    <!--begin::Nav-->
    <div class="aside-menu flex-column-fluid pt-0 pb-5 py-lg-5" id="kt_aside_menu">
        <!--begin::Aside menu-->
        <div id="kt_aside_menu_wrapper" class="w-100 hover-scroll-overlay-y scroll-ps d-flex" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu" data-kt-scroll-offset="0">
            <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-icon-gray-400 menu-arrow-gray-400 fw-bold fs-6" data-kt-menu="true">
                @if(Auth::user()->is_admin === 'y')
                <div class="menu-item py-3">
                    <a class="menu-link" href="/su/dashboard" title="Dashboard" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon">
                            <i class="bi bi-rocket-takeoff" style="font-size: 24px;"></i>
                        </span>
                    </a>
                </div>
                <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3">
                    <span class="menu-link" title="Master Data" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2x">
                                <i class="bi bi-building-fill-check" style="font-size: 24px;"></i>
                            </span>
                        </span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Master Data</span>
                            </div>
                        </div>
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="/su/master/bank">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Bank</span>
                            </a>
                        </div>
                    </div>
                </div>
                @else
                <div class="menu-item py-3">
                    <a class="menu-link" href="/u/dashboard" title="Dashboard" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon">
                            <i class="bi bi-rocket-takeoff" style="font-size: 24px;"></i>
                        </span>
                    </a>
                </div>
                <div class="menu-item py-3">
                    <a class="menu-link" href="/u/wallet" title="Wallet" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon">
                            <i class="bi bi-wallet" style="font-size: 24px;"></i>
                        </span>
                    </a>
                </div>
                <div class="menu-item py-3">
                    <a class="menu-link" href="/u/nabung" title="Nabung" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon">
                            <i class="bi bi-piggy-bank" style="font-size: 24px;"></i>
                        </span>
                    </a>
                </div>
                <div class="menu-item py-3">
                    <a class="menu-link" href="/u/goals" title="Goals" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon">
                            <i class="bi bi-person-lines-fill" style="font-size: 24px;"></i>
                        </span>
                    </a>
                </div>
                <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3">
                    <span class="menu-link" title="Income" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2x">
                                <i class="bi bi-box-arrow-in-down-right" style="font-size: 24px;"></i>
                            </span>
                        </span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Income</span>
                            </div>
                        </div>
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="/u/income">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List</span>
                            </a>
                            <a class="menu-link" href="/u/income/laporan">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Laporan</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click" data-kt-menu-placement="right-start" class="menu-item py-3">
                    <span class="menu-link" title="Outcome" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2x">
                                <i class="bi bi-box-arrow-up-left" style="font-size: 22px;"></i>
                            </span>
                        </span>
                    </span>
                    <div class="menu-sub menu-sub-dropdown w-225px px-1 py-4">
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">Outcome</span>
                            </div>
                        </div>
                        <div class="menu-item menu-accordion">
                            <a class="menu-link" href="/u/outcome">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List</span>
                            </a>
                            <a class="menu-link" href="/u/outcome/laporan">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Laporan</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>