@extends('frontend.app')

@section('title')
    Car Page
@endsection
@section('header')
    {{-- @include('frontend.partials.header') --}}
    @include('frontend.partials.header2')
@endsection
@push('styles')
<style>
    .se--car-rental-banner {
  height: 600px;
  width: 100%;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  position: relative;
  padding-top: 50px;
  padding-left: 16px;
  padding-right: 16px;
}
.filters-container {
    gap:5px !important;
}
</style>
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/aos-2.3.1.min.css') }}" /> --}}
@livewireStyles

@endpush

@section('content')
  <!-- banner section start -->
  <section class="se--car-rental-banner se--bottom " style="background-image: url('{{ asset('frontend/assets/images/carBanner.png') }}');">
    <div class="provider-banner-content container se--banner-text-width  " data-aos="fade-up">
      <h2 class="banner-title ">
        Find the Best <span>Party Services</span> in City
      </h2>
      <p class="banner-text">
        Explore top-rated DJs, photographers, caterers, and more for your next event.
      </p>

    </div>
  </section>
  <!-- banner section end -->
    <!-- main section start -->
    <main class="container provider-list-container emg-service m-bottom">
        
        <livewire:car-page />
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
