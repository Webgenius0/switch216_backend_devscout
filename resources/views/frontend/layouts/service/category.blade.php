@extends('frontend.app')

@section('title')
    Contact Page
@endsection
@section('header')
    @include('frontend.partials.header')
    {{-- @include('frontend.partials.header2') --}}
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/aos-2.3.1.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/service.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/serviceResponsive.css') }}" />
@endpush

@section('content')
    <!-- banner section start -->
    <section class="se--car-rental-banner " style="background-image: url('{{ isset($data['realStateBanner']->background_image) ? asset($data['realStateBanner']->background_image) . '?t=' . time() : asset('frontend/assets/images/home-rental.png') }}');">
        <div class="provider-banner-content container se--banner-text-width  " data-aos="fade-up">
            <h2 class="banner-title ">

                {{$data['realStateBanner']->title ?? 'Agents. Tours. Loans. Homes. Best Real Estate Service in City'}} 
                
            </h2>
            <p class="banner-text">
                {{$data['realStateBanner']->description ?? 'Explore top-rated DJs, photographers, caterers, and more for your next event.'}} 
                
            </p>
        </div>
    </section>

    <!-- main section start -->
    <main class="container m-top m-bottom">
        <section>
            <h2 class="section-title" data-aos="fade-up">All Multi Service</h2>
            {{-- <div class="section-text" data-aos="fade-left">
        Looking for service? <a class="active" href="#">Click now</a>
      </div> --}}
            <div class="service-container" data-aos="fade-down">
                @forelse ($categories as $key=> $category)
                    <a href="{{ route('service.sub_category', [$category->id]) }}" class="item">
                        <img src="{{ asset($category->thumbnail) }}" alt="not photo find">
                        <h4 class="section-card-title mt-2 mt-xl-4">{{ $category->name ?? '' }}</h4>
                        <p class="section-card-text mt-2 mb-2">
                            {{ Str::limit($category->description ?? '', 100) }}
                        </p>
                        <div class="mt-2 mt-xl-5">
                            <div class="action">
                                <span>Explore Now</span>

                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 17 13"
                                    fill="none">
                                    <path
                                        d="M16.5303 7.03033C16.8232 6.73744 16.8232 6.26256 16.5303 5.96967L11.7574 1.1967C11.4645 0.903806 10.9896 0.903806 10.6967 1.1967C10.4038 1.48959 10.4038 1.96447 10.6967 2.25736L14.9393 6.5L10.6967 10.7426C10.4038 11.0355 10.4038 11.5104 10.6967 11.8033C10.9896 12.0962 11.4645 12.0962 11.7574 11.8033L16.5303 7.03033ZM0 7.25H16V5.75H0L0 7.25Z"
                                        fill="" />
                                </svg>
                            </div>
                        </div>
                    </a>
                @empty
                    <h1>No Category Found</h1>
                @endforelse


            </div>
        </section>
    </main>
    <!-- main section end -->
@endsection



@push('scripts')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/aos-2.3.1.min.js') }}"></script>
@endpush
