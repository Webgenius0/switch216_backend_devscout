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
@endpush

@section('content')
    <!-- banner section start -->
    <section class="provider-banner">
        <div class="provider-banner-content" data-aos="fade-up">
            <h2 class="banner-title">
                Find the Best <span>Party Services</span> in City
            </h2>
            <p class="banner-text">
                Explore top-rated DJs, photographers, caterers, and more for your next
                event.
            </p>
            <!-- search section start -->
            {{-- <div class="container banner-search-container search-container" data-aos="fade-up">
        <div class="search-section">
          <form action="./service.html">
            <div class="search-item">
              <div class="item-title">Location</div>
              <input class="search-input" placeholder="Select location" type="text" />
            </div>
            <div class="search-item">
              <div class="item-title">Service Type</div>
              <select class="select">
                <option value="">Select service</option>
                <option value="contractor">Contractor</option>
                <option value="plumber">plumber</option>
                <option value="real_state">Real state</option>
              </select>
            </div>
            <button type="submit" class="button">
              <span>Search</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path
                  d="M9.0625 15.625C12.6869 15.625 15.625 12.6869 15.625 9.0625C15.625 5.43813 12.6869 2.5 9.0625 2.5C5.43813 2.5 2.5 5.43813 2.5 9.0625C2.5 12.6869 5.43813 15.625 9.0625 15.625Z"
                  stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M13.7031 13.7031L17.5 17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" />
              </svg>
            </button>
          </form>
        </div>
      </div> --}}
            <!-- search section end -->
        </div>
    </section>
    <!-- banner section end -->

    <!-- main section start -->
    <main class="container m-top m-bottom">
        <section>
            <h2 class="section-title" data-aos="fade-up">
                Contractors Service Providers in city
            </h2>
            <p class="section-text" data-aos="fade-left">
                Looking for service? <a class="active" href="">Click now</a>
            </p>
            <div class="service-container sub-service-container" data-aos="fade-down">
                @forelse ($category->subCategories as $key=>$sub_category)
                <a href="{{ route('service.emergency', ['category' => $category->name,'subcategory'=> $sub_category->name]) }}" class="item">
                  <img src="{{asset($sub_category->thumbnail)}}" alt="not photo find">
                   <h4 class="section-card-title mt-2 mt-xl-4">{{$sub_category->name??""}}</h4>
                   <p class="section-card-text mt-2 mb-2">
                       {{$sub_category->description ??""}}
                   </p>
                   <div class="mt-2 mt-xl-5">
                     <div class="action">
                       <span>Explore Now</span>
         
                       <svg xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 17 13" fill="none">
                         <path
                           d="M16.5303 7.03033C16.8232 6.73744 16.8232 6.26256 16.5303 5.96967L11.7574 1.1967C11.4645 0.903806 10.9896 0.903806 10.6967 1.1967C10.4038 1.48959 10.4038 1.96447 10.6967 2.25736L14.9393 6.5L10.6967 10.7426C10.4038 11.0355 10.4038 11.5104 10.6967 11.8033C10.9896 12.0962 11.4645 12.0962 11.7574 11.8033L16.5303 7.03033ZM0 7.25H16V5.75H0L0 7.25Z"
                           fill="" />
                       </svg>
                     </div>
                   </div>
                 </a>
                @empty
                <h1>No Sub Category Found</h1>
                @endforelse
                

            </div>
        </section>
    </main>
    <!-- main section end -->
@endsection



@push('scripts')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/aos-2.3.1.min.js') }}"></script>
@endpush
