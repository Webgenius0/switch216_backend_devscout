<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Links Of CSS File -->
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/sidebar-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/google-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/fullcalendar.main.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/lightpick.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/admin/assets/css/style.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png"
        href="{{ asset($systemSetting->favicon ?? 'backend/admin/assets/images/favicon.png') }} ">
    <!-- Title -->
    <title>@yield('title') | {{ $systemSetting->system_name ?? 'Switch' }} </title>
</head>

<body class="boxed-size">


    @include('backend.partials.asidebar')

    <!-- Start Main Content Area -->
    <div class="container-fluid">
        <div class="main-content d-flex flex-column">

            @include('backend.partials.header')
            @yield('content')

            {{-- <div class="flex-grow-1"></div> --}}

            @include('backend.partials.footer')
        </div>
    </div>
    <!-- Start Main Content Area -->
    @include('backend.partials.settings_area')

    @include('backend.partials.script')

</body>

</html>
