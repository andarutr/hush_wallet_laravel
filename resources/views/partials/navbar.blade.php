<div class="header-mobile py-3">
    <!--begin::Container-->
    <div class="container d-flex flex-stack">
        <!--begin::Mobile logo-->
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
            <a href="../../demo9/dist/index.html">
                <img alt="Logo" src="assets/media/logos/logo-demo9.svg" class="h-35px" />
            </a>
        </div>
        <!--end::Mobile logo-->
        <!--begin::Aside toggle-->
        <button class="btn btn-icon btn-active-color-primary" id="kt_aside_toggle">
            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
            <span class="svg-icon svg-icon-2x me-n1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                        fill="black" />
                    <path opacity="0.3"
                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                        fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </button>
        <!--end::Aside toggle-->
    </div>
    <!--end::Container-->
</div>

<div id="kt_header" class="header py-6 py-lg-0" data-kt-sticky="true" data-kt-sticky-name="header"
    data-kt-sticky-offset="{lg: '300px'}">
    <!--begin::Container-->
    <div class="header-container container-xxl">
        <!--begin::Page title-->
        <div
            class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-20 py-3 py-lg-0 me-3">
            <h1 class="d-flex flex-column text-dark fw-bolder my-1">
                <span class="text-white fs-1">{{ $title ?? '' }}</span>
            </h1>
        </div>
        <!--end::Page title=-->
        <!--begin::Wrapper-->
        <div class="d-flex align-items-center flex-wrap">
            <div class="d-flex align-items-center py-3 py-lg-0">
                <div class="me-3">
                    <a href="#" class="btn btn-icon btn-custom btn-active-color-primary" data-kt-menu-trigger="click"
                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com013.svg-->
                        <span class="svg-icon svg-icon-1 svg-icon-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                    fill="black" />
                                <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="assets/media/avatars/150-26.jpg" />
                                </div>
                                <!--end::Avatar-->
                                <div class="d-flex flex-column">
                                    <div class="fw-bolder d-flex align-items-center fs-5">{{ auth()->user()->nama }}
                                    </div>
                                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="menu-item px-5">
                            <a href="/settings" class="menu-link px-5"><i class="bi bi-person-gear"></i> Settings</a>
                        </div>
                    </div>
                </div>
                <button class="btn btn-danger" id="btnLogout">Logout</button>
            </div>
            <!--end::Action-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Container-->
    <div class="header-offset"></div>
</div>