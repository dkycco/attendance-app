<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title') | Kehadiran Mahasiswa UNSAP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="Aplikasi Kehadiran mahasiswa UNSAP" name="description" />
    <meta content="UNSAP" name="author" />
    <link rel="shortcut icon" href="{{ asset('images/unsap.png') }}">

    <link href="{{ asset('libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    @stack('css')

    <script src="{{ asset('js/layout.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/toastify-js/src/toastify.css') }}"  rel="stylesheet" type="text/css" >

</head>

<body>

    <div id="layout-wrapper">

        @include('pages.dashboard.partials.header')

        @include('pages.dashboard.partials.app-menu')

        <div class="vertical-overlay"></div>

        <div class="main-content">

            <div class="modal modal-primer fade" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false" role="dialog"></div>
            <div class="modal modal-secondary fade" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false" tabindex="-1" role="dialog"></div>


            <div class="page-content">
                <div class="container-fluid">

                    {{ $slot }}

                </div>
            </div>

            @include('pages.dashboard.partials.footer')

        </div>

    </div>

    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    @include('pages.dashboard.partials.preloader')

    @include('pages.dashboard.partials.theme-button')

    @include('pages.dashboard.partials.theme-settings')

    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

    @stack('vendors')

    <script src="{{ asset('libs/toastify-js/src/toastify.js') }}"></script>
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}"></script>

    @stack('js')
</body>

</html>
