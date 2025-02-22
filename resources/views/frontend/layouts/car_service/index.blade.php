@extends('frontend.app')

@section('title')
    Car Service Page
@endsection
@section('header')
   @include('frontend.partials.header')
    {{-- @include('frontend.partials.header2') --}}
@endsection

@push('styles')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/aos-2.3.1.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/service.css" />
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/serviceResponsive.css" />

@endpush

@section('content')
    <!-- banner section start -->
    <section class="se--car-rental-banner " style="background-image: url('{{ asset('frontend/assets/images/carBanner.png') }}');">
        <div class="provider-banner-content container se--banner-text-width  " data-aos="fade-up">
            <h2 class="banner-title ">
                Agents. Tours. Loans. Homes. Best <span>Rent Service</span> in City
            </h2>
            <p class="banner-text">
                Explore top-rated DJs, photographers, caterers, and more for your next event.
            </p>
            <!-- search section start -->
            {{-- <div class="se--serach--container" data-aos="fade-up">
                <div class="se--home--rental--search-section ">
                    <form action="">
                        <input type="text" class="se--search--input" placeholder="Search all Services" />
                    </form>

                    <div class="se--serach-icon">

                        <svg xmlns="http://www.w3.org/2000/svg" width="31" height="30" viewBox="0 0 31 30"
                            fill="none">
                            <path
                                d="M14.0938 23.4375C19.5303 23.4375 23.9375 19.0303 23.9375 13.5938C23.9375 8.1572 19.5303 3.75 14.0938 3.75C8.6572 3.75 4.25 8.1572 4.25 13.5938C4.25 19.0303 8.6572 23.4375 14.0938 23.4375Z"
                                stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21.0547 20.5547L26.7501 26.2501" stroke="white" stroke-width="3"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </div>
                </div>
            </div> --}}
            <!-- search section end -->
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
                        @forelse ($data['carServiceSubCategorys'] as $carServicesSubCategory )
                        <a href="{{route('service.car_list',['category' => 'Car','subcategory'=> $carServicesSubCategory->name])}}" class="se-choose--plan-box" data-aos="fade-right">
                           <img src="{{ asset($carServicesSubCategory->thumbnail) }}" alt="No Image" width="200" height="200" style="border-bottom-left-radius: 60px;">
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
                        <h1 class="se--section--header">Cars For You in Hoover, AL</h1>
                        <p class="se--common--pera2">Based on Cars you recently viewed <a class="se--link"
                                href="{{route('service.car_list')}}">click here</a>
                        </p>

                    </div>
                    <div class="se--homes--container">
                        @forelse ($data['car_Services'] as $newCarService )
                        <div class="se--home--card">
                            <!-- favourite icons -->
                            {{-- <div class="se--fav--icon--box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25"
                                    fill="none">
                                    <path
                                        d="M16.44 3.59961C14.63 3.59961 13.01 4.47961 12 5.82961C10.99 4.47961 9.37 3.59961 7.56 3.59961C4.49 3.59961 2 6.09961 2 9.18961C2 10.3796 2.19 11.4796 2.52 12.4996C4.1 17.4996 8.97 20.4896 11.38 21.3096C11.72 21.4296 12.28 21.4296 12.62 21.3096C15.03 20.4896 19.9 17.4996 21.48 12.4996C21.81 11.4796 22 10.3796 22 9.18961C22 6.09961 19.51 3.59961 16.44 3.59961Z"
                                        fill="#003366" />
                                </svg>
                            </div> --}}
                            {{-- @dd($newCarService) --}}
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
                                    {{-- <p class="se--adress--info">{{ $newCarService->user->userAddresses()->first()->location ?? ' ' }}</p> --}}

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
                    '{{ asset('frontend/assets') }}/css/plugins/easepick-1.2.1.css',
                    '{{ asset('frontend/assets') }}/css/provider-profile-easepick.css',
                ],
                zIndex: 100,
                format: 'DD-MM-YYYY',
            });
        }
    </script>
@endpush
