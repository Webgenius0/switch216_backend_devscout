@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ $systemSetting->system_name ?? 'Switch' }} </title>
    <link rel="shortcut icon" href="{{ asset($systemSetting->favicon ?? 'favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('frontend.dashboard.contractor.partials.style')

</head>

<body>
    <div class="layout-container">
        @include('frontend.dashboard.contractor.partials.asidebar')
        <!-- main content start -->
        <div class="main-content">
            <div class="main-content-container">
                @include('frontend.dashboard.contractor.partials.header')
                @yield('content')
            </div>
        </div>
    </div>


    @include('frontend.dashboard.contractor.partials.script')
</body>

</html>
