<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SI-LAB - @yield('title')</title>

    <!-- CSS (Urutkan CSS terlebih dahulu) -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com"> --}}
    {{-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Arima:wght@100..700&family=Itim&family=Lato:wght@400;700&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('js/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



    <!-- Style Kustom -->
    @stack('styles')

    <style>
        body {
            font-family: "Sour Gummy", serif;
        }

        #sidebar-wrapper {
            height: 100vh;
            width: 200px;
            position: sticky;
            top: 0;
        }

        .main-content {
            padding: 20px;
            overflow-x: hidden;
        }

        .nav-link.active {
            font-weight: bold;
            color: #0d6efd;
        }

        .logout-link {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar dan Sidebar -->
        @include('partials.navbar') <!-- Pastikan navbar di-include dengan benar -->

        <div class="container-fluid page-body-wrapper">
            <!-- Sidebar -->
            @include('partials.sidebar') <!-- Pastikan sidebar di-include dengan benar -->

            <div class="main-content flex-grow-1">
                @yield('content') <!-- Isi konten utama halaman -->
            </div>

        </div>
    </div>
    
    
    <!-- JS (Letakkan script di bagian bawah, pastikan Popper.js ada sebelum Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Script Kustom -->
    @stack('scripts')
    @yield('scripts')
</body>

</html>
