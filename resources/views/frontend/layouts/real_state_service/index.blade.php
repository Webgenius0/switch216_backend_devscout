@extends('frontend.app')

@section('title')
    Real Estate Service Page
@endsection
@section('header')
   @include('frontend.partials.header')
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
    <!-- banner section end -->

    <!-- main section start -->
    <main>
        <div class="se--wrapper--section">
            <div class="container">
                <div class="se--choose--your-services">
                    <div class="se--choose-col-1" data-aos="fade-right">
                        <h1 class="se--common-header">Chose Your service</h1>
                        <p class="se--common--pera">Find top-rated providers, compare services, and book with confidence to
                            meet
                            your needs.</p>

                    </div>
                    <div class="se--choose--plane-container">
                        @forelse ($data['realStateServiceSubCategorys'] as $carServicesSubCategory )
                        <a href="{{route('service.real_state_list',['category' => 'Real Estate','subcategory'=> $carServicesSubCategory->name])}}" class="se-choose--plan-box" data-aos="fade-right">
                           <img src="{{ asset($carServicesSubCategory->thumbnail ?? '') }}" alt="No Image" width="200" height="200" style="border-bottom-left-radius: 60px;">
                            <h1 class="se--plan-box-header">{{$carServicesSubCategory->name?? ''}}</h1>
                            <p class="se--plan-box-pera">{{$carServicesSubCategory->description?? ''}}</p>
                        </a>
                        @empty
                            
                        @endforelse
                    </div>
                </div>
            </div>

        </div>

        <div class="se--wrapper--section">
            <div class="container">
                <div class="se--houses--layout" data-aos="fade-down">
                    <div class="se--houses-col--1">
                        <h1 class="se--section--header">Real Estate For You in Hoover, AL</h1>
                        <p class="se--common--pera2">Based on Real Estate you recently viewed <a class="se--link"
                                href="{{route('service.real_state_list')}}">click here</a>
                        </p>

                    </div>
                    <div class="se--homes--container">
                        @forelse ($data['real_state_service'] as $newCarService )
                        <div class="se--home--card">
                            <!-- image  -->
                            <img src="{{ asset($newCarService->cover_image ) }}" alt="house no 1" class="img-fluid" />

                            <div class="se--house--card--info">
                                <div class="se--house--location">
                                    <svg class="se--home--card--svg" xmlns="http://www.w3.org/2000/svg" width="25"
                                        height="25" viewBox="0 0 25 25" fill="none">
                                        <path
                                            d="M7.5 18.5C5.67107 18.9117 4.5 19.5443 4.5 20.2537C4.5 21.4943 8.08172 22.5 12.5 22.5C16.9183 22.5 20.5 21.4943 20.5 20.2537C20.5 19.5443 19.3289 18.9117 17.5 18.5"
                                            stroke="" stroke-width="1.5" stroke-linecap="round" />
                                        <path
                                            d="M15 9.5C15 10.8807 13.8807 12 12.5 12C11.1193 12 10 10.8807 10 9.5C10 8.11929 11.1193 7 12.5 7C13.8807 7 15 8.11929 15 9.5Z"
                                            stroke="" stroke-width="1.5" />
                                        <path
                                            d="M13.7574 17.9936C13.4201 18.3184 12.9693 18.5 12.5002 18.5C12.031 18.5 11.5802 18.3184 11.2429 17.9936C8.1543 15.0008 4.01519 11.6575 6.03371 6.80373C7.1251 4.17932 9.74494 2.5 12.5002 2.5C15.2554 2.5 17.8752 4.17933 18.9666 6.80373C20.9826 11.6514 16.8536 15.0111 13.7574 17.9936Z"
                                            stroke="" stroke-width="1.5" />
                                    </svg>

                                </div>

                                <p class="se--home--card--details">{{ $newCarService->user->userAddresses()->first()->location ?? ' ' }}</p>

                            </div>

                        </div>
                        @empty
                            
                        @endforelse
                        

                    </div>

                </div>

            </div>

        </div>
    </main>
    <!-- main section end -->
@endsection



@push('scripts')
<script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/aos-2.3.1.min.js') }}"></script>
    <script type="text/javascript">
        const searchDate = document.getElementById('searchDate');

        if (searchDate) {
            const picker = new easepick.create({
                element: searchDate,
                css: [
                    '{{ asset('frontend/assets/css/plugins/easepick-1.2.1.css') }}',
                    '{{ asset('frontend/assets/css/provider-profile-easepick.css') }}',
                ],
                zIndex: 100,
                format: 'DD-MM-YYYY',
            });
        }
    </script>
@endpush
