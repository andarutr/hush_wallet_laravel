<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="dark" data-sidebar-size="lg" data-sidebar="light" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? '-' }} | Hush Wallet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    <script src="/assets/js/layout.js"></script>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    @stack('styles')
</head>
<body style="background-color: #6691E7;">
    <div class="auth-page-wrapper pt-5">
        <div class="auth-page-content">
            @yield('content')
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>
    <script src="/assets/libs/feather-icons/feather.min.js"></script>
    <script src="/assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="/assets/js/plugins.js"></script>
    <script src="/assets/libs/particles.js/particles.js"></script>
    <script src="/assets/js/pages/particles.app.js"></script>
    <script src="/assets/js/pages/password-addon.init.js"></script>
    <script src="/assets/js/swal2.min.js"></script>
    <script src="/assets/js/jquery.min.js"></script>
    @stack('scripts')
</body>
</html>