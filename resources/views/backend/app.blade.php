@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Links Of CSS File -->

    @include('backend.partials.style')
    <!-- Favicon -->
    <link rel="icon" type="image/png"
        href="{{ asset($systemSetting->favicon ?? 'backend/admin/assets/favicon.ico') }} ">
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
    <!-- Modal -->
    {{-- <div class="modal fade" id="OpenModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hello Modal Center
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary text-white">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}
    <x-modal id="openModal" title="My Modal Title" labelledby="customModalLabel" size="modal-lg" saveButton="Submit">
        <p>This is the modal content.</p>
    </x-modal>
    <x-modal id="openModal2" title="My Modal Title" labelledby="customModalLabel" size="modal-lg" saveButton="Submit">
        <p>This is the modal content.</p>
    </x-modal>
</body>

</html>
