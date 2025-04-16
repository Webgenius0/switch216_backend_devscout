<!-- All CSS files -->

<link rel="stylesheet" href="{{ asset('backend/assets') }}/css/plugins/bootstrap.min.css" />
<link rel="stylesheet" href="{{ asset('backend/assets') }}/css/plugins/aos.css" />

<!-- custom css -->
<link rel="stylesheet" href="{{ asset('backend/assets') }}/css/style.css" />
<link rel="stylesheet" href="{{ asset('backend/assets') }}/css/responsive.css" />
<link rel="stylesheet" href="{{ asset('backend/assets') }}/css/notification.css" />
<link href="{{ asset('vendor/flasher/flasher.min.css') }}" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.0/dist/sweetalert2.min.css" rel="stylesheet">
<style>
     .dropify-wrapper .dropify-preview .dropify-render img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
</style>
@stack('styles')
