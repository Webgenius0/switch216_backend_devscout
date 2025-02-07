@extends('frontend.app')

@section('title')
    Contact Page
@endsection
@section('header')
    {{-- @include('frontend.partials.header') --}}
    @include('frontend.partials.header2')
@endsection
@push('styles')
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
