<!DOCTYPE html>
<html lang="en">
	<head><base href="../../">
		<title>{{ $title ?? '' }} | Hush Wallet</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/hush.png') }}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
		@stack('styles')
	</head>
	<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
		<div class="d-flex flex-column flex-root">
			<div class="page d-flex flex-row flex-column-fluid">
				@include('partials.sidebar')
				<div class="wrapper d-flex flex-column flex-row-fluid">
					@include('partials.navbar')
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="container-xxl">
							@yield('content')
						</div>
					</div>

                    <div class="footer py-4 d-flex flex-lg-column">
						<div class="container-xxl d-flex flex-column flex-md-row flex-stack">
							<div class="text-dark order-2 order-md-1">
								<span class="text-gray-400 fw-bold me-1">Created by</span>
								<a href="https://andarutr.my.id" target="_blank" class="text-muted text-hover-primary fw-bold me-2 fs-6">Andaru Triadi</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		{{-- JS --}}
        <script>var hostUrl = "assets/";</script>
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
		<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="{{ asset('assets/js/custom/apps/customers/list/export.js') }}"></script>
		<script src="{{ asset('assets/js/custom/apps/customers/list/list.js') }}"></script>
		<script src="{{ asset('assets/js/custom/apps/customers/add.js') }}"></script>
		<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
		<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
		<script src="{{ asset('assets/js/custom/modals/create-app.js') }}"></script>
		<script src="{{ asset('assets/js/custom/modals/upgrade-plan.js') }}"></script>
		<script src="{{ asset('assets/plugins/global/momentjs/moment.js') }}"></script>
		@stack('scripts')
        <script>
            $(document).on("click", "#btnLogout", function(){
               $.ajax({
                type: "POST",
                url: "/logout",
                success: function(res){
                    window.location.href = "/login";
                }
               });
            });
        </script>
	</body>
</html>