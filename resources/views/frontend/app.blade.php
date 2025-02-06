@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>Service Banner</title> --}}
    <title>@yield('title') | {{ $systemSetting->system_name ?? 'Switch' }} </title>
    <link rel="shortcut icon" href="{{ asset($systemSetting->favicon ?? 'favicon.ico') }}" type="image/x-icon">

    <!-- All fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('frontend.partials.style')

</head>

<body>

    {{-- @include('frontend.partials.header2') --}}
    {{-- @include('frontend.partials.header2') --}}
    @yield('header')

    @yield('content')


    @include('frontend.partials.footer')
    @include('frontend.partials.script')
</body>

</html>
