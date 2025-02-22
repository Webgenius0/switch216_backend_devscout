@extends('frontend.app')

@section('title')
    Emergency Page
@endsection
@section('header')
    {{-- @include('frontend.partials.header') --}}
    @include('frontend.partials.header2')
@endsection
@push('styles')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/aos-2.3.1.min.css') }}" /> --}}
@livewireStyles

@endpush

@section('content')
    <!-- main section start -->
    <main class="container provider-list-container emg-service m-bottom">
        <livewire:emergency-page />
    </main>
    <!-- main section end -->
@endsection



@push('scripts')
<script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/aos-2.3.1.min.js') }}"></script>
    <script type="text/javascript">
        let assetEasepick = "{{ asset('frontend/assets/css/plugins/easepick-1.2.1.css') }}";
        let assetEasepickProvider = "{{ asset('frontend/assets/css/provider-profile-easepick.css') }}";

        const searchDate = document.getElementById('searchDate');

        if (searchDate) {
            const picker = new easepick.create({
                element: searchDate,
                css: [
                    assetEasepick,
                    assetEasepickProvider,
                ],
                zIndex: 100,
                format: 'DD-MM-YYYY',
            });
        }
    </script>
    @livewireScripts
@endpush
