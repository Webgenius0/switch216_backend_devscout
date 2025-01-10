{{-- <html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg" data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>@yield('title') | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/backend/favicon.ico')}}">
    @include('backend.partials.style')
</head>

<body class="flex items-center justify-center min-h-screen py-16 bg-cover bg-auth-pattern dark:bg-auth-pattern-dark font-public">

<div class="mb-0 border-none shadow-none lg:w-[500px] card bg-white/70 dark:bg-zink-500/70">
    <div class="!px-10 !py-12 card-body">
        <a href="/">
            <img src="{{asset('logo.png')}}" alt="logo" class="h-14 mx-auto">
        </a>
        <div class="mt-10">
            <img src="{{asset('/backend/images/error-404.png')}}" alt="error" class="h-64 mx-auto">
        </div>
        <div class="mt-8 text-center">
            <h4 class="mb-2 text-purple-500">@yield('code') @yield('title')</h4>
            <p class="mb-6 text-slate-500 dark:text-zink-200">@yield('message')</p>
            <a href="/" class="text-white transition-all duration-200 ease-linear btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="home" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Back to Home</span></a>
        </div>
    </div>
</div>
@include('backend.partials.script')
</body>
</html> --}}

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
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/light-favicon.ico')}}" media="(prefers-color-scheme: light)"
        type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/dark-favicon.ico')}}" media="(prefers-color-scheme: dark)"
        type="image/x-icon" />

    @include('frontend.partials.style')

</head>

<body>

    @yield('header')

    @yield('content')

    
@include('frontend.partials.footer')
    @include('frontend.partials.script')
</body>
