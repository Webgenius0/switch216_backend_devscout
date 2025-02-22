@extends('frontend.app')

@section('title')
    Home Page
@endsection
@section('header')
    @include('frontend.partials.header')
    {{-- @include('frontend.partials.header2') --}}
@endsection

@push('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/aos-2.3.1.min.css') }}" />
<style>
    .dropdown-menu {
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        max-height: 150px;
        overflow-y: auto;
        width: 40%;
        display: none;
        margin-top: 80px;
    }

    .dropdown-menu div {
        padding: 8px;
        cursor: pointer;
    }

    .dropdown-menu div:hover {
        background: #f0f0f0;
    }
    .new-banner-photo {
        padding:30px 20px
    }
    @media screen and (min-width: 1300px){
        .new-banner-photo {
            padding:60px 400px
        }
    }
</style>
@endpush

@section('content')
    <!-- banner section start -->
    <section class="banner">
        @if (!empty($cms['banner']) && count($cms['banner']) > 0)
            <div class="line-tracker">
                @foreach ($cms['banner'] as $key => $d)
                    <span class="tracker-item @if ($loop->first) active @endif"
                        data-value="{{ $key }}"></span>
                @endforeach
            </div>
        @else
            <div class="line-tracker">
                <span class="tracker-item active" data-value="1"></span>
                <span class="tracker-item" data-value="2"></span>
                <span class="tracker-item" data-value="3"></span>
                <span class="tracker-item" data-value="4"></span>
                <span class="tracker-item" data-value="5"></span>
            </div>
        @endif

        @if (!empty($cms['banner']) && count($cms['banner']) > 0)
            <div class="slide-container">
                @foreach ($cms['banner'] as $d)
                    <div class="slide-item @if ($loop->first) active @endif">
                        @if (!empty($d->image))
                            <img class="slide-bg-img" src="{{ asset($d->image) }}" alt="Slide image" />
                        @else
                            <img class="slide-bg-img" src="{{ asset('frontend/assets/images/banner-01.jpg') }}"
                                alt="Slide image" />
                        @endif
                        <div class="overlay"></div>
                        <div class="slide-content">
                            <h4 class="slide-title">{{ $d->title ?? 'Find the Perfect Service for Your Needs' }}</h4>
                            <p class="slide-des">
                                {{ $d->description ??
                                    "Explore trusted professionals across multiple categories, from
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    party planners to contractors, all in one place." }}
                                </h4>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="slide-container">
                <div class="slide-item active">
                    <img class="slide-bg-img" src="{{ asset('frontend/assets/images/banner-01.jpg') }}" alt="Slide image" />
                    <div class="overlay"></div>
                    <div class="slide-content">
                        <h4 class="slide-title">Find the Perfect Service for Your Needs</h4>
                        <p class="slide-des">
                            Explore trusted professionals across multiple categories, from
                            party planners to contractors, all in one place.
                        </p>
                    </div>
                </div>
                <div class="slide-item">
                    <img class="slide-bg-img" src="{{ asset('frontend/assets/images/banner-02.jpg') }}" alt="Slide image" />
                    <div class="overlay"></div>
                    <div class="slide-content">
                        <h4 class="slide-title">Find the Perfect Service for Your Needs</h4>
                        <p class="slide-des">
                            Explore trusted professionals across multiple categories, from
                            party planners to contractors, all in one place.
                        </p>
                    </div>
                </div>
                <div class="slide-item">
                    <img class="slide-bg-img" src="{{ asset('frontend/assets/images/banner-03.jpg') }}" alt="Slide image" />
                    <div class="overlay"></div>
                    <div class="slide-content">
                        <h4 class="slide-title">Find the Perfect Service for Your Needs</h4>
                        <p class="slide-des">
                            Explore trusted professionals across multiple categories, from
                            party planners to contractors, all in one place.
                        </p>
                    </div>
                </div>
                <div class="slide-item">
                    <img class="slide-bg-img" src="{{ asset('frontend/assets/images/banner-04.jpg') }}" alt="Slide image" />
                    <div class="overlay"></div>
                    <div class="slide-content">
                        <h4 class="slide-title">Find the Perfect Service for Your Needs</h4>
                        <p class="slide-des">
                            Explore trusted professionals across multiple categories, from
                            party planners to contractors, all in one place.
                        </p>
                    </div>
                </div>
                <div class="slide-item">
                    <img class="slide-bg-img" src="{{ asset('frontend/assets/images/banner-05.jpg') }}" alt="Slide image" />
                    <div class="overlay"></div>
                    <div class="slide-content">
                        <h4 class="slide-title">Find the Perfect Service for Your Needs</h4>
                        <p class="slide-des">
                            Explore trusted professionals across multiple categories, from
                            party planners to contractors, all in one place.
                        </p>
                    </div>
                </div>
            </div>
        @endif
        @if (!empty($cms['banner']) && count($cms['banner']) > 0)
            <div class="thumbnail">
                @foreach ($cms['banner'] as $d)
                    <div class="thumbnail-item @if ($loop->first) active @endif"
                        style="background-image: url('{{ isset($d->image) ? asset($d->image) : asset('frontend/assets/images/banner-01.jpg') }}')">
                        <h6 class="thumbnail-title">{{ $d->sub_title ?? 'contractors' }}</h6>
                        <p class="thumbnail-des">{{ $d->sub_description ?? 'electrician' }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="thumbnail">
                <div class="thumbnail-item active"
                    style="background-image: url('{{ asset('frontend/assets/images/banner-01.jpg') }}')">
                    <h6 class="thumbnail-title">contractors</h6>
                    <p class="thumbnail-des">electrician</p>
                </div>
                <div class="thumbnail-item"
                    style="background-image: url('{{ asset('frontend/assets/images/banner-02.jpg') }}')">
                    <h6 class="thumbnail-title">contractors</h6>
                    <p class="thumbnail-des">electrician</p>
                </div>
                <div class="thumbnail-item"
                    style="background-image: url('{{ asset('frontend/assets/images/banner-03.jpg') }}')">
                    <h6 class="thumbnail-title">contractors</h6>
                    <p class="thumbnail-des">electrician</p>
                </div>
                <div class="thumbnail-item"
                    style="background-image: url('{{ asset('frontend/assets/images/banner-04.jpg') }}')">
                    <h6 class="thumbnail-title">contractors</h6>
                    <p class="thumbnail-des">electrician</p>
                </div>
                <div class="thumbnail-item"
                    style="background-image: url('{{ asset('frontend/assets/images/banner-05.jpg') }}')">
                    <h6 class="thumbnail-title">contractors</h6>
                    <p class="thumbnail-des">electrician</p>
                </div>
            </div>
        @endif


        <div class="slide-nav">
            <button id="slide-prev-btn" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M-4.37114e-08 6C-6.78525e-08 5.44772 0.447715 5 1 5L17 5C17.5523 5 18 5.44771 18 6C18 6.55228 17.5523 7 17 7L1 7C0.447715 7 4.00344e-08 6.55228 -4.37114e-08 6Z"
                        fill="white" />
                    <path
                        d="M2.02786 6C2.12116 6.15477 2.31675 6.43289 2.53062 6.67494C2.95637 7.15677 3.5431 7.70716 4.1556 8.23895C4.76313 8.76643 5.3736 9.25635 5.83397 9.61562C6.06363 9.79485 6.45995 10.0942 6.59308 10.1948C7.03772 10.5223 7.13269 11.1483 6.8052 11.5929C6.47769 12.0376 5.85169 12.1326 5.40699 11.8051L5.40328 11.8023C5.2589 11.6933 4.84028 11.3771 4.60352 11.1923C4.1264 10.82 3.48686 10.307 2.84439 9.74916C2.20689 9.19566 1.54362 8.5784 1.03187 7.99922C0.776998 7.71077 0.538562 7.40821 0.358424 7.1094C0.194842 6.83805 1.61001e-05 6.44321 -2.62267e-07 6.00004C1.60613e-05 5.55687 0.194842 5.16195 0.358424 4.8906C0.538562 4.59179 0.776998 4.28923 1.03186 4.00078C1.54362 3.4216 2.20689 2.80434 2.84439 2.25084C3.48686 1.69303 4.1264 1.18002 4.60352 0.807669C4.84028 0.622909 5.25863 0.306927 5.40301 0.197876L5.40699 0.194867C5.85169 -0.132641 6.47769 -0.0376389 6.8052 0.407059C7.13269 0.851733 7.03771 1.47768 6.59308 1.80521C6.45995 1.90576 6.06363 2.20515 5.83397 2.38437C5.3736 2.74365 4.76313 3.23357 4.1556 3.76105C3.5431 4.29284 2.95637 4.84323 2.53062 5.32506C2.31675 5.56711 2.12116 5.84523 2.02786 6Z"
                        fill="white" />
                </svg>
            </button>
            <button id="slide-next-btn" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12"
                    fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M18 6C18 6.55228 17.5523 7 17 7L0.999983 7C0.447699 7 -1.7234e-05 6.55229 -1.72098e-05 6C-1.71857e-05 5.44772 0.447699 5 0.999983 5L17 5C17.5523 5 18 5.44772 18 6Z"
                        fill="white" />
                    <path
                        d="M15.9721 6C15.8788 5.84523 15.6832 5.56711 15.4694 5.32506C15.0436 4.84323 14.4569 4.29284 13.8444 3.76105C13.2369 3.23357 12.6264 2.74365 12.166 2.38437C11.9364 2.20515 11.5401 1.90576 11.4069 1.80521C10.9623 1.47768 10.8673 0.851733 11.1948 0.40706C11.5223 -0.0376388 12.1483 -0.132641 12.593 0.194867L12.5967 0.19767C12.7411 0.306722 13.1597 0.62291 13.3965 0.80767C13.8736 1.18002 14.5131 1.69303 15.1556 2.25084C15.7931 2.80434 16.4564 3.4216 16.9681 4.00078C17.223 4.28923 17.4614 4.59179 17.6416 4.8906C17.8052 5.16195 18 5.55679 18 5.99996C18 6.44313 17.8052 6.83805 17.6416 7.1094C17.4614 7.40821 17.223 7.71077 16.9681 7.99922C16.4564 8.5784 15.7931 9.19566 15.1556 9.74916C14.5131 10.307 13.8736 10.82 13.3965 11.1923C13.1597 11.3771 12.7414 11.6931 12.597 11.8021L12.593 11.8051C12.1483 12.1326 11.5223 12.0376 11.1948 11.5929C10.8673 11.1483 10.9623 10.5223 11.4069 10.1948C11.5401 10.0942 11.9364 9.79485 12.166 9.61563C12.6264 9.25635 13.2369 8.76643 13.8444 8.23895C14.4569 7.70716 15.0436 7.15677 15.4694 6.67494C15.6832 6.43289 15.8788 6.15477 15.9721 6Z"
                        fill="white" />
                </svg>
            </button>
        </div>
    </section>
    <!-- banner section end -->

    <!-- search section start -->
    <div class="container search-container" data-aos="fade-up">
        <div class="search-section">
            <form action="{{route('home.serchingStatic')}}" method="POST">
                @csrf
                <div class="search-item">
                    <div class="item-title">Location</div>
                    <input id="locationInput" name="location" class="search-input" placeholder="Select location" type="text" autocomplete="off" />
                    <div id="locationDropdown" class="dropdown-menu"></div>
                </div>
                <div class="search-item">
                    <div class="item-title">Service Type</div>
                    <select name="category" class="select" required>
                        <option value="">Select Category</option>
                        @foreach ($categories as $categoryItem)
                            <option value="{{ $categoryItem->name }}">{{ $categoryItem->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="button">
                    <span>Search</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                        fill="none">
                        <path
                            d="M9.0625 15.625C12.6869 15.625 15.625 12.6869 15.625 9.0625C15.625 5.43813 12.6869 2.5 9.0625 2.5C5.43813 2.5 2.5 5.43813 2.5 9.0625C2.5 12.6869 5.43813 15.625 9.0625 15.625Z"
                            stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.7031 13.7031L17.5 17.5" stroke="white" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
    <!-- search section end -->
    <!-- main section start -->
    <main>
        <!-- service section start -->
        <section class="service container">
            <div class="row justify-content-between">
                <div class="col-sm-6">
                    <div class="service-content">
                        <h2 class="title" data-aos="fade-right">
                            {{ $cms['service_container']->title ?? '24/7 Service at Your Door' }}
                        </h2>
                        @if (isset($cms['service_container_content']) && count($cms['service_container_content']) > 0)
                            <div class="accordion" id="serviceAccordion" data-aos="fade-up">
                                @foreach ($cms['service_container_content'] as $key => $service)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ $key }}">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}"
                                                aria-expanded="false" aria-controls="collapse{{ $key }}">
                                                {{ $service['title'] ?? 'Default Service Title' }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $key }}"
                                            class="accordion-collapse collapse @if ($loop->first) show @endif"
                                            aria-labelledby="heading{{ $key }}"
                                            data-bs-parent="#serviceAccordion">
                                            <div class="accordion-body">
                                                {{ $service['description'] ?? 'Default service description.' }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="accordion" id="serviceAccordion" data-aos="fade-up">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#serviceOne" aria-expanded="true" aria-controls="serviceOne">
                                            Installation and repair of locks
                                        </button>
                                    </h2>
                                    <div id="serviceOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#serviceAccordion">
                                        <div class="accordion-body">
                                            Yet bed any for traveling assistance indulgence
                                            unpleasing. Not thoughts all exercise blessing. Indulgence
                                            way everything joy.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#serviceTwo" aria-expanded="false"
                                            aria-controls="serviceTwo">
                                            Fast lockout service
                                        </button>
                                    </h2>
                                    <div id="serviceTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#serviceAccordion">
                                        <div class="accordion-body">
                                            Yet bed any for traveling assistance indulgence
                                            unpleasing. Not thoughts all exercise blessing. Indulgence
                                            way everything joy.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#serviceThree"
                                            aria-expanded="false" aria-controls="serviceThree">
                                            Quick Tips and Advice
                                        </button>
                                    </h2>
                                    <div id="serviceThree" class="accordion-collapse collapse"
                                        data-bs-parent="#serviceAccordion">
                                        <div class="accordion-body">
                                            Yet bed any for traveling assistance indulgence
                                            unpleasing. Not thoughts all exercise blessing. Indulgence
                                            way everything joy.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <a href="{{route('contact_us.index')}}" class="button"
                            data-aos="fade-left">{{ $cms['service_container']->button_text ?? 'Contact Now' }}</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="service-card">
                        <h4 class="card-title">{{ $cms['service_container']->sub_title ?? 'Emergency with Services' }}
                        </h4>
                        <figure class="card-img">
                            @if (!empty($cms['service_container']->image))
                                <img src="{{ asset($cms['service_container']->image) }}" alt="Service card image" />
                            @else
                                <img src="{{ asset('frontend/assets/images/service.png') }}" alt="Service card image" />
                            @endif
                        </figure>
                    </div>
                </div>
            </div>
        </section>
        <!-- service section end -->

        <!-- process section start -->
        <section class="process container">
            <div class="gr"></div>
            <svg class="left-icon" width="310" height="369" viewBox="0 0 310 369" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M-45.8754 156.023L-14.5256 174.308C-14.0018 174.614 -13.4214 174.81 -12.8195 174.886C-12.2176 174.962 -11.6066 174.915 -11.0232 174.749L5.62584 169.986L84.3341 191.076L86.6654 182.381L6.72575 160.963C5.93849 160.75 5.1083 160.757 4.3243 160.981L-11.6798 165.544L-38.3787 149.962L-33.568 132.007L-2.63816 131.87L8.94165 143.823C9.50819 144.411 10.2242 144.833 11.0126 145.044L90.9534 166.464L93.2817 157.768L14.5737 136.678L2.5411 124.237C2.11881 123.801 1.61267 123.454 1.05306 123.218C0.493436 122.982 -0.108121 122.861 -0.715508 122.863L-37.0084 123.026C-37.9927 123.033 -38.9476 123.362 -39.7271 123.963C-40.5066 124.564 -41.0676 125.404 -41.3243 126.354L-47.9133 150.951C-48.1771 151.903 -48.1205 152.915 -47.7522 153.832C-47.3839 154.748 -46.7244 155.518 -45.8754 156.023ZM148.178 117.829L111.93 253.111L103.233 250.78L139.484 115.5L148.178 117.829ZM98.6716 264.811C97.9921 264.434 97.2265 264.24 96.4495 264.247C95.6726 264.254 94.9106 264.462 94.2378 264.85L70.8477 278.355C70.175 278.743 69.6143 279.299 69.2202 279.968C68.8261 280.637 68.6121 281.397 68.599 282.174L68.1564 308.418C68.1421 309.235 68.3503 310.04 68.7587 310.747C69.1671 311.455 69.7603 312.038 70.4748 312.434L93.4243 325.172C94.1035 325.549 94.8686 325.743 95.6452 325.737C96.4217 325.73 97.1834 325.523 97.856 325.134L121.246 311.63C121.919 311.242 122.48 310.686 122.874 310.016C123.268 309.347 123.483 308.587 123.496 307.81L123.937 281.567C123.952 280.75 123.744 279.945 123.335 279.238C122.927 278.53 122.333 277.947 121.619 277.551L98.6716 264.811ZM114.539 305.106L95.561 316.063L77.2029 305.873L77.5557 284.876L96.5337 273.919L114.893 284.112L114.539 305.106Z"
                    fill="#FF6600" fill-opacity="0.05" />
                <path
                    d="M182.372 120.404C208.169 105.626 217.103 72.7306 202.324 46.9329C200.074 43.0067 197.339 39.3797 194.183 36.1377C192.456 34.3481 189.607 34.2974 187.817 36.0236C187.231 36.5909 186.809 37.3066 186.597 38.0946L176.331 76.3564L153.372 81.0562L135.838 65.5144L146.091 27.2319C146.298 26.4609 146.296 25.6489 146.085 24.8791C145.874 24.1093 145.462 23.4094 144.892 22.8511C144.322 22.2928 143.613 21.8962 142.839 21.702C142.065 21.5077 141.253 21.5228 140.486 21.7457C111.866 29.8386 95.2266 59.5984 103.319 88.217C104.545 92.5596 106.313 96.7304 108.582 100.631C110.365 103.695 112.447 106.572 114.804 109.218L78.7196 243.886C75.3567 245.001 72.1137 246.45 69.0393 248.211C43.2019 263.128 34.3495 296.164 49.2669 322.002C64.1832 347.838 97.2198 356.69 123.057 341.772C148.893 326.856 157.745 293.82 142.829 267.984C141.047 264.921 138.963 262.044 136.607 259.397L145.246 227.157L159.345 230.935C160.499 231.244 161.727 231.082 162.761 230.485C163.795 229.888 164.55 228.905 164.859 227.752L165.682 224.677C166.411 221.991 169.174 220.396 171.864 221.107C174.555 221.824 176.154 224.587 175.438 227.279L175.434 227.291L174.61 230.364C173.967 232.765 175.392 235.234 177.793 235.876L251.146 255.531C270.504 260.813 290.477 249.401 295.759 230.043C301.039 210.686 289.627 190.712 270.269 185.431C270.165 185.402 270.059 185.373 269.952 185.345L196.6 165.691C194.2 165.048 191.731 166.473 191.088 168.873L190.265 171.947C189.535 174.635 186.774 176.229 184.081 175.517C181.391 174.799 179.79 172.037 180.508 169.348C180.51 169.343 180.512 169.339 180.512 169.335L181.336 166.259C181.979 163.858 180.554 161.39 178.154 160.747L164.054 156.969L172.692 124.729C176.055 123.615 179.299 122.166 182.373 120.404L182.372 120.404ZM274.214 244.107C271.38 245.738 268.276 246.847 265.05 247.381L277.917 199.356C289.568 208.925 291.256 226.126 281.687 237.776C279.598 240.32 277.066 242.464 274.214 244.107ZM171.553 168.285C170.209 175.927 175.317 183.212 182.958 184.554C189.673 185.734 196.268 181.922 198.594 175.512L267.624 194.041C268.373 194.243 269.107 194.488 269.832 194.75L255.744 247.325C254.981 247.196 254.224 247.033 253.475 246.837L184.413 228.329C185.757 220.687 180.649 213.402 173.008 212.06C166.292 210.878 159.697 214.693 157.37 221.101L147.532 218.466L161.722 165.664L171.553 168.285ZM164.658 119.988L127.27 259.465C127.068 260.216 127.064 261.007 127.258 261.76C127.453 262.513 127.839 263.204 128.379 263.764C145.853 281.679 145.496 310.37 127.578 327.844C109.662 345.319 80.9712 344.961 63.4952 327.044C46.0222 309.127 46.3796 280.437 64.2974 262.961C69.7178 257.676 76.3751 253.833 83.6621 251.781C84.4083 251.563 85.0862 251.158 85.6308 250.603C86.1755 250.049 86.5688 249.364 86.773 248.614L124.139 109.147C124.341 108.396 124.344 107.606 124.149 106.853C123.954 106.1 123.567 105.411 123.026 104.853C105.73 87.1611 106.05 58.798 123.741 41.5002C127.085 38.2318 130.92 35.5068 135.106 33.4241L126.42 65.8695C126.203 66.6764 126.215 67.5277 126.455 68.3279C126.695 69.1282 127.153 69.8458 127.778 70.4003L149.079 89.2911C149.603 89.754 150.227 90.0889 150.902 90.2691C151.577 90.4493 152.285 90.4701 152.969 90.3296L180.863 84.6215C181.681 84.4539 182.436 84.062 183.045 83.4896C183.653 82.9171 184.09 82.1868 184.307 81.3802L192.998 48.9431C193.47 49.6528 193.92 50.3771 194.347 51.1149C206.823 72.4733 199.624 99.8998 178.268 112.378C174.965 114.306 171.43 115.804 167.748 116.835C167 117.049 166.321 117.452 165.775 118.007C165.23 118.561 164.837 119.247 164.635 119.998L164.656 119.986L164.658 119.988Z"
                    fill="#FF6600" fill-opacity="0.05" />
                <path d="M256.007 214.557L253.676 223.254L192.187 206.778L194.516 198.082L256.007 214.557Z" fill="#FF6600"
                    fill-opacity="0.05" />
            </svg>
            <svg class="right-icon" width="310" height="369" viewBox="0 0 310 369" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M-45.8754 156.023L-14.5256 174.308C-14.0018 174.614 -13.4214 174.81 -12.8195 174.886C-12.2176 174.962 -11.6066 174.915 -11.0232 174.749L5.62584 169.986L84.3341 191.076L86.6654 182.381L6.72575 160.963C5.93849 160.75 5.1083 160.757 4.3243 160.981L-11.6798 165.544L-38.3787 149.962L-33.568 132.007L-2.63816 131.87L8.94165 143.823C9.50819 144.411 10.2242 144.833 11.0126 145.044L90.9534 166.464L93.2817 157.768L14.5737 136.678L2.5411 124.237C2.11881 123.801 1.61267 123.454 1.05306 123.218C0.493436 122.982 -0.108121 122.861 -0.715508 122.863L-37.0084 123.026C-37.9927 123.033 -38.9476 123.362 -39.7271 123.963C-40.5066 124.564 -41.0676 125.404 -41.3243 126.354L-47.9133 150.951C-48.1771 151.903 -48.1205 152.915 -47.7522 153.832C-47.3839 154.748 -46.7244 155.518 -45.8754 156.023ZM148.178 117.829L111.93 253.111L103.233 250.78L139.484 115.5L148.178 117.829ZM98.6716 264.811C97.9921 264.434 97.2265 264.24 96.4495 264.247C95.6726 264.254 94.9106 264.462 94.2378 264.85L70.8477 278.355C70.175 278.743 69.6143 279.299 69.2202 279.968C68.8261 280.637 68.6121 281.397 68.599 282.174L68.1564 308.418C68.1421 309.235 68.3503 310.04 68.7587 310.747C69.1671 311.455 69.7603 312.038 70.4748 312.434L93.4243 325.172C94.1035 325.549 94.8686 325.743 95.6452 325.737C96.4217 325.73 97.1834 325.523 97.856 325.134L121.246 311.63C121.919 311.242 122.48 310.686 122.874 310.016C123.268 309.347 123.483 308.587 123.496 307.81L123.937 281.567C123.952 280.75 123.744 279.945 123.335 279.238C122.927 278.53 122.333 277.947 121.619 277.551L98.6716 264.811ZM114.539 305.106L95.561 316.063L77.2029 305.873L77.5557 284.876L96.5337 273.919L114.893 284.112L114.539 305.106Z"
                    fill="#FF6600" fill-opacity="0.05" />
                <path
                    d="M182.372 120.404C208.169 105.626 217.103 72.7306 202.324 46.9329C200.074 43.0067 197.339 39.3797 194.183 36.1377C192.456 34.3481 189.607 34.2974 187.817 36.0236C187.231 36.5909 186.809 37.3066 186.597 38.0946L176.331 76.3564L153.372 81.0562L135.838 65.5144L146.091 27.2319C146.298 26.4609 146.296 25.6489 146.085 24.8791C145.874 24.1093 145.462 23.4094 144.892 22.8511C144.322 22.2928 143.613 21.8962 142.839 21.702C142.065 21.5077 141.253 21.5228 140.486 21.7457C111.866 29.8386 95.2266 59.5984 103.319 88.217C104.545 92.5596 106.313 96.7304 108.582 100.631C110.365 103.695 112.447 106.572 114.804 109.218L78.7196 243.886C75.3567 245.001 72.1137 246.45 69.0393 248.211C43.2019 263.128 34.3495 296.164 49.2669 322.002C64.1832 347.838 97.2198 356.69 123.057 341.772C148.893 326.856 157.745 293.82 142.829 267.984C141.047 264.921 138.963 262.044 136.607 259.397L145.246 227.157L159.345 230.935C160.499 231.244 161.727 231.082 162.761 230.485C163.795 229.888 164.55 228.905 164.859 227.752L165.682 224.677C166.411 221.991 169.174 220.396 171.864 221.107C174.555 221.824 176.154 224.587 175.438 227.279L175.434 227.291L174.61 230.364C173.967 232.765 175.392 235.234 177.793 235.876L251.146 255.531C270.504 260.813 290.477 249.401 295.759 230.043C301.039 210.686 289.627 190.712 270.269 185.431C270.165 185.402 270.059 185.373 269.952 185.345L196.6 165.691C194.2 165.048 191.731 166.473 191.088 168.873L190.265 171.947C189.535 174.635 186.774 176.229 184.081 175.517C181.391 174.799 179.79 172.037 180.508 169.348C180.51 169.343 180.512 169.339 180.512 169.335L181.336 166.259C181.979 163.858 180.554 161.39 178.154 160.747L164.054 156.969L172.692 124.729C176.055 123.615 179.299 122.166 182.373 120.404L182.372 120.404ZM274.214 244.107C271.38 245.738 268.276 246.847 265.05 247.381L277.917 199.356C289.568 208.925 291.256 226.126 281.687 237.776C279.598 240.32 277.066 242.464 274.214 244.107ZM171.553 168.285C170.209 175.927 175.317 183.212 182.958 184.554C189.673 185.734 196.268 181.922 198.594 175.512L267.624 194.041C268.373 194.243 269.107 194.488 269.832 194.75L255.744 247.325C254.981 247.196 254.224 247.033 253.475 246.837L184.413 228.329C185.757 220.687 180.649 213.402 173.008 212.06C166.292 210.878 159.697 214.693 157.37 221.101L147.532 218.466L161.722 165.664L171.553 168.285ZM164.658 119.988L127.27 259.465C127.068 260.216 127.064 261.007 127.258 261.76C127.453 262.513 127.839 263.204 128.379 263.764C145.853 281.679 145.496 310.37 127.578 327.844C109.662 345.319 80.9712 344.961 63.4952 327.044C46.0222 309.127 46.3796 280.437 64.2974 262.961C69.7178 257.676 76.3751 253.833 83.6621 251.781C84.4083 251.563 85.0862 251.158 85.6308 250.603C86.1755 250.049 86.5688 249.364 86.773 248.614L124.139 109.147C124.341 108.396 124.344 107.606 124.149 106.853C123.954 106.1 123.567 105.411 123.026 104.853C105.73 87.1611 106.05 58.798 123.741 41.5002C127.085 38.2318 130.92 35.5068 135.106 33.4241L126.42 65.8695C126.203 66.6764 126.215 67.5277 126.455 68.3279C126.695 69.1282 127.153 69.8458 127.778 70.4003L149.079 89.2911C149.603 89.754 150.227 90.0889 150.902 90.2691C151.577 90.4493 152.285 90.4701 152.969 90.3296L180.863 84.6215C181.681 84.4539 182.436 84.062 183.045 83.4896C183.653 82.9171 184.09 82.1868 184.307 81.3802L192.998 48.9431C193.47 49.6528 193.92 50.3771 194.347 51.1149C206.823 72.4733 199.624 99.8998 178.268 112.378C174.965 114.306 171.43 115.804 167.748 116.835C167 117.049 166.321 117.452 165.775 118.007C165.23 118.561 164.837 119.247 164.635 119.998L164.656 119.986L164.658 119.988Z"
                    fill="#FF6600" fill-opacity="0.05" />
                <path d="M256.007 214.557L253.676 223.254L192.187 206.778L194.516 198.082L256.007 214.557Z" fill="#FF6600"
                    fill-opacity="0.05" />
            </svg>

            <div class="process-content" data-aos="fade-right">
                <h2 class="title">{{ $cms['process_container']->title ?? 'We have best team and best process' }}</h2>
                <p class="des">
                    {{ $cms['process_container']->description ??
                        'Yet bed any for traveling assistance indulgence unpleasing. Not
                                                                                                                                                                thoughts all exercise blessing. Indulgence way everything joy.' }}
                </p>
                <a href="{{ route('service.category') }}" class="button">{{ $cms['process_container']->button_text ?? 'See All Service' }}</a>
            </div>

            @if (isset($cms['process_container_content']) && count($cms['process_container_content']) > 0)
                <div class="process-timeline-container" data-aos="fade-up">
                    @foreach ($cms['process_container_content'] as $key => $d)
                        <div class="process-item" data-aos="fade-left">
                            <div class="item-num">{{ ++$key }}</div>
                            <div class="item-tracker"></div>
                            <h5 class="item-title">{{ $d->title ?? 'Project Discovery Call' }}</h5>
                            <p class="item-des">
                                {{ $d->description ??
                                    "Party we years to order allow asked of. We so opinion friends me
                                                                                                                                                                                                                                message as delight." }}
                            </p>
                        </div>
                    @endforeach
                    <svg class="process-timeline-svg" xmlns="http://www.w3.org/2000/svg" width="100%" height="464"
                        viewBox="0 0 1150 464" fill="none" preserveAspectRatio="none">
                        <g filter="url(#filter0_d_4391_773)">
                            <path id="animatedPath"
                                d="M27 326C75 361 186.8 427 250 411C329 391 351.911 301.371 470.5 264C589.5 226.5 723.5 346 776.5 203.001C829.719 59.41 1012 -39.0001 1123 20.0001"
                                stroke="#003366" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <filter id="filter0_d_4391_773" x="0.5" y="0.0881348" width="1149" height="463.871"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dy="24" />
                                <feGaussianBlur stdDeviation="12" />
                                <feComposite in2="hardAlpha" operator="out" />
                                <feColorMatrix type="matrix"
                                    values="0 0 0 0 0.215686 0 0 0 0 0.203922 0 0 0 0 0.662745 0 0 0 0.3 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4391_773" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4391_773"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </div>
            @else
                <div class="process-timeline-container" data-aos="fade-up">
                    <div class="process-item" data-aos="fade-left">
                        <div class="item-num">1</div>
                        <div class="item-tracker"></div>
                        <h5 class="item-title">Project Discovery Call</h5>
                        <p class="item-des">
                            Party we years to order allow asked of. We so opinion friends me
                            message as delight.
                        </p>
                    </div>
                    <div class="process-item" data-aos="fade-right">
                        <div class="item-num">2</div>
                        <div class="item-tracker"></div>
                        <h5 class="item-title">Project Discovery Call</h5>
                        <p class="item-des">
                            Party we years to order allow asked of. We so opinion friends me
                            message as delight.
                        </p>
                    </div>
                    <div class="process-item" data-aos="fade-up">
                        <div class="item-num">3</div>
                        <div class="item-tracker"></div>
                        <h5 class="item-title">Project Discovery Call</h5>
                        <p class="item-des">
                            Party we years to order allow asked of. We so opinion friends me
                            message as delight.
                        </p>
                    </div>
                    <svg class="process-timeline-svg" xmlns="http://www.w3.org/2000/svg" width="100%" height="464"
                        viewBox="0 0 1150 464" fill="none" preserveAspectRatio="none">
                        <g filter="url(#filter0_d_4391_773)">
                            <path id="animatedPath"
                                d="M27 326C75 361 186.8 427 250 411C329 391 351.911 301.371 470.5 264C589.5 226.5 723.5 346 776.5 203.001C829.719 59.41 1012 -39.0001 1123 20.0001"
                                stroke="#003366" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <filter id="filter0_d_4391_773" x="0.5" y="0.0881348" width="1149" height="463.871"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                                <feOffset dy="24" />
                                <feGaussianBlur stdDeviation="12" />
                                <feComposite in2="hardAlpha" operator="out" />
                                <feColorMatrix type="matrix"
                                    values="0 0 0 0 0.215686 0 0 0 0 0.203922 0 0 0 0 0.662745 0 0 0 0.3 0" />
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_4391_773" />
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_4391_773"
                                    result="shape" />
                            </filter>
                        </defs>
                    </svg>
                </div>
            @endif
        </section>
        <!-- process section end -->

        <!-- work section start -->
        <section class="work container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <h2 class="title">
                        {{ $cms['plat_form_work_container']->title ?? 'We have best team and best process' }}</h2>
                    </h2>
                    <p class="des">
                        {{ $cms['plat_form_work_container']->description ??
                            'From booking event planners to finding home contractors, our platform makes it easy to connect with professionals in your city.' }}

                    </p>
                    @if (isset($cms['plat_form_work_container_content']) && count($cms['plat_form_work_container_content']) > 0)
                        <div class="icon-container">
                            @foreach ($cms['plat_form_work_container_content'] as $key => $d)
                                <div class="icon-item">
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                            viewBox="0 0 40 40" fill="none">
                                            <g clip-path="url(#clip0_4391_679)">
                                                <path
                                                    d="M37.8761 16.3953L34.9754 19.296V9.8372L38.801 6.01162C39.894 4.9186 39.894 3.15295 38.801 2.10197L37.9181 1.21914C37.6589 0.959327 37.3509 0.753201 37.0118 0.612562C36.6728 0.471922 36.3094 0.39953 35.9423 0.39953C35.5752 0.39953 35.2118 0.471922 34.8728 0.612562C34.5337 0.753201 34.2257 0.959327 33.9665 1.21914C25.1802 10.0054 28.2071 6.97852 27.5344 7.60911H8.95306V0.756708C8.95306 0.336315 8.61675 0.0420393 8.2384 0H4.83321C2.35289 0 0.292969 2.01789 0.292969 4.54025V29.5536C0.292969 32.0339 2.31085 34.0939 4.83321 34.0939H20.1776L16.352 37.9194C15.5953 38.6762 16.1418 39.9373 17.1928 39.9373H39.1373C39.5577 39.9373 39.852 39.601 39.894 39.2227V17.2361C39.894 16.1851 38.6328 15.6386 37.8761 16.3953ZM24.4656 18.203C23.9611 18.0349 23.6248 17.5724 23.5407 17.0259C23.4987 16.6896 23.2464 16.4374 22.9101 16.3953C22.4056 16.3533 21.9432 16.017 21.7751 15.4705L32.3269 4.9186L35.0595 7.65115C20.5559 22.1127 25.5586 17.152 24.4656 18.203ZM22.826 18.8336L20.3878 19.5903L21.1445 17.152C21.1865 17.1941 21.5649 17.5724 22.2375 17.7826C22.3216 18.161 22.5738 18.5393 22.826 18.8336ZM35.0595 2.22808C35.5639 1.72361 36.4047 1.72361 36.9092 2.22808L37.792 3.11091C38.2965 3.61538 38.2965 4.45617 37.792 4.96064L36.1105 6.64221L33.3779 3.90966L35.0595 2.22808ZM4.41282 1.51341H7.48169V25.0134H4.83321C3.69815 25.0134 2.60513 25.4338 1.76434 26.1905V4.54025C1.76434 2.98479 2.89941 1.72361 4.41282 1.51341ZM4.83321 32.5805C3.15164 32.5805 1.76434 31.1932 1.76434 29.5116C1.76434 27.83 3.15164 26.4427 4.83321 26.4427H8.2384C8.65879 26.4427 8.9951 26.1064 8.9951 25.686V9.08049H26.1051L20.4298 14.7138C20.3878 14.7558 20.2616 14.8819 20.2196 15.008C17.6132 23.3738 18.8743 19.296 18.538 20.4731C18.3699 21.0196 18.9164 21.5662 19.4629 21.398L24.886 19.7164C24.97 19.6744 25.0962 19.6324 25.1802 19.5483L33.4199 11.3086V20.8095L21.691 32.5805H4.83321ZM38.4226 38.466H37.6659V37.4991C37.6659 37.0787 37.3296 36.7424 36.9092 36.7424C36.4888 36.7424 36.1525 37.0787 36.1525 37.4991V38.466H34.8072V38.0035C34.8072 37.5831 34.4709 37.2468 34.0505 37.2468C33.6301 37.2468 33.2938 37.5831 33.2938 38.0035V38.466H31.9486V37.4991C31.9486 37.0787 31.6122 36.7424 31.1919 36.7424C30.7715 36.7424 30.4351 37.0787 30.4351 37.4991V38.466H29.216V38.0035C29.216 37.5831 28.8797 37.2468 28.4593 37.2468C28.0389 37.2468 27.7026 37.5831 27.7026 38.0035V38.466H26.3573V37.4991C26.3573 37.0787 26.021 36.7424 25.6006 36.7424C25.1802 36.7424 24.8439 37.0787 24.8439 37.4991V38.466H23.4987V38.0035C23.4987 37.5831 23.1623 37.2468 22.742 37.2468C22.3216 37.2468 21.9853 37.5831 21.9853 38.0035V38.466H20.64V37.4991C20.64 37.0787 20.3037 36.7424 19.8833 36.7424C19.4629 36.7424 19.1266 37.0787 19.1266 37.4991V38.466H17.7393L38.2545 17.9508L38.4226 38.466Z"
                                                    fill="white" />
                                                <path
                                                    d="M25.262 34.6825C24.7995 35.145 25.1359 35.9437 25.7664 35.9437H35.1832C35.6036 35.9437 35.8979 35.6074 35.94 35.229V25.7702C35.94 25.0976 35.1412 24.8033 34.6788 25.2657L25.262 34.6825ZM34.4265 34.4723H27.5321L34.4265 27.5779V34.4723Z"
                                                    fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_4391_679">
                                                    <rect width="40" height="40" fill="white" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                    <div class="details">
                                        <h6 class="icon-title">{{ $d->title ?? 'Best Service provider' }}</h6>
                                        <p class="icon-des">
                                            {{ $d->description ??
                                                "Lorem Ipsum is simply dummy text of the printing and
                                                                                                        typesetting industry. Lorem Ipsum has." }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="icon-container">
                            <div class="icon-item">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                        viewBox="0 0 40 40" fill="none">
                                        <g clip-path="url(#clip0_4391_679)">
                                            <path
                                                d="M37.8761 16.3953L34.9754 19.296V9.8372L38.801 6.01162C39.894 4.9186 39.894 3.15295 38.801 2.10197L37.9181 1.21914C37.6589 0.959327 37.3509 0.753201 37.0118 0.612562C36.6728 0.471922 36.3094 0.39953 35.9423 0.39953C35.5752 0.39953 35.2118 0.471922 34.8728 0.612562C34.5337 0.753201 34.2257 0.959327 33.9665 1.21914C25.1802 10.0054 28.2071 6.97852 27.5344 7.60911H8.95306V0.756708C8.95306 0.336315 8.61675 0.0420393 8.2384 0H4.83321C2.35289 0 0.292969 2.01789 0.292969 4.54025V29.5536C0.292969 32.0339 2.31085 34.0939 4.83321 34.0939H20.1776L16.352 37.9194C15.5953 38.6762 16.1418 39.9373 17.1928 39.9373H39.1373C39.5577 39.9373 39.852 39.601 39.894 39.2227V17.2361C39.894 16.1851 38.6328 15.6386 37.8761 16.3953ZM24.4656 18.203C23.9611 18.0349 23.6248 17.5724 23.5407 17.0259C23.4987 16.6896 23.2464 16.4374 22.9101 16.3953C22.4056 16.3533 21.9432 16.017 21.7751 15.4705L32.3269 4.9186L35.0595 7.65115C20.5559 22.1127 25.5586 17.152 24.4656 18.203ZM22.826 18.8336L20.3878 19.5903L21.1445 17.152C21.1865 17.1941 21.5649 17.5724 22.2375 17.7826C22.3216 18.161 22.5738 18.5393 22.826 18.8336ZM35.0595 2.22808C35.5639 1.72361 36.4047 1.72361 36.9092 2.22808L37.792 3.11091C38.2965 3.61538 38.2965 4.45617 37.792 4.96064L36.1105 6.64221L33.3779 3.90966L35.0595 2.22808ZM4.41282 1.51341H7.48169V25.0134H4.83321C3.69815 25.0134 2.60513 25.4338 1.76434 26.1905V4.54025C1.76434 2.98479 2.89941 1.72361 4.41282 1.51341ZM4.83321 32.5805C3.15164 32.5805 1.76434 31.1932 1.76434 29.5116C1.76434 27.83 3.15164 26.4427 4.83321 26.4427H8.2384C8.65879 26.4427 8.9951 26.1064 8.9951 25.686V9.08049H26.1051L20.4298 14.7138C20.3878 14.7558 20.2616 14.8819 20.2196 15.008C17.6132 23.3738 18.8743 19.296 18.538 20.4731C18.3699 21.0196 18.9164 21.5662 19.4629 21.398L24.886 19.7164C24.97 19.6744 25.0962 19.6324 25.1802 19.5483L33.4199 11.3086V20.8095L21.691 32.5805H4.83321ZM38.4226 38.466H37.6659V37.4991C37.6659 37.0787 37.3296 36.7424 36.9092 36.7424C36.4888 36.7424 36.1525 37.0787 36.1525 37.4991V38.466H34.8072V38.0035C34.8072 37.5831 34.4709 37.2468 34.0505 37.2468C33.6301 37.2468 33.2938 37.5831 33.2938 38.0035V38.466H31.9486V37.4991C31.9486 37.0787 31.6122 36.7424 31.1919 36.7424C30.7715 36.7424 30.4351 37.0787 30.4351 37.4991V38.466H29.216V38.0035C29.216 37.5831 28.8797 37.2468 28.4593 37.2468C28.0389 37.2468 27.7026 37.5831 27.7026 38.0035V38.466H26.3573V37.4991C26.3573 37.0787 26.021 36.7424 25.6006 36.7424C25.1802 36.7424 24.8439 37.0787 24.8439 37.4991V38.466H23.4987V38.0035C23.4987 37.5831 23.1623 37.2468 22.742 37.2468C22.3216 37.2468 21.9853 37.5831 21.9853 38.0035V38.466H20.64V37.4991C20.64 37.0787 20.3037 36.7424 19.8833 36.7424C19.4629 36.7424 19.1266 37.0787 19.1266 37.4991V38.466H17.7393L38.2545 17.9508L38.4226 38.466Z"
                                                fill="white" />
                                            <path
                                                d="M25.262 34.6825C24.7995 35.145 25.1359 35.9437 25.7664 35.9437H35.1832C35.6036 35.9437 35.8979 35.6074 35.94 35.229V25.7702C35.94 25.0976 35.1412 24.8033 34.6788 25.2657L25.262 34.6825ZM34.4265 34.4723H27.5321L34.4265 27.5779V34.4723Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_4391_679">
                                                <rect width="40" height="40" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="details">
                                    <h6 class="icon-title">Best Service provider</h6>
                                    <p class="icon-des">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has.
                                    </p>
                                </div>
                            </div>
                            <div class="icon-item">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                        viewBox="0 0 40 40" fill="none">
                                        <g clip-path="url(#clip0_4391_679)">
                                            <path
                                                d="M37.8761 16.3953L34.9754 19.296V9.8372L38.801 6.01162C39.894 4.9186 39.894 3.15295 38.801 2.10197L37.9181 1.21914C37.6589 0.959327 37.3509 0.753201 37.0118 0.612562C36.6728 0.471922 36.3094 0.39953 35.9423 0.39953C35.5752 0.39953 35.2118 0.471922 34.8728 0.612562C34.5337 0.753201 34.2257 0.959327 33.9665 1.21914C25.1802 10.0054 28.2071 6.97852 27.5344 7.60911H8.95306V0.756708C8.95306 0.336315 8.61675 0.0420393 8.2384 0H4.83321C2.35289 0 0.292969 2.01789 0.292969 4.54025V29.5536C0.292969 32.0339 2.31085 34.0939 4.83321 34.0939H20.1776L16.352 37.9194C15.5953 38.6762 16.1418 39.9373 17.1928 39.9373H39.1373C39.5577 39.9373 39.852 39.601 39.894 39.2227V17.2361C39.894 16.1851 38.6328 15.6386 37.8761 16.3953ZM24.4656 18.203C23.9611 18.0349 23.6248 17.5724 23.5407 17.0259C23.4987 16.6896 23.2464 16.4374 22.9101 16.3953C22.4056 16.3533 21.9432 16.017 21.7751 15.4705L32.3269 4.9186L35.0595 7.65115C20.5559 22.1127 25.5586 17.152 24.4656 18.203ZM22.826 18.8336L20.3878 19.5903L21.1445 17.152C21.1865 17.1941 21.5649 17.5724 22.2375 17.7826C22.3216 18.161 22.5738 18.5393 22.826 18.8336ZM35.0595 2.22808C35.5639 1.72361 36.4047 1.72361 36.9092 2.22808L37.792 3.11091C38.2965 3.61538 38.2965 4.45617 37.792 4.96064L36.1105 6.64221L33.3779 3.90966L35.0595 2.22808ZM4.41282 1.51341H7.48169V25.0134H4.83321C3.69815 25.0134 2.60513 25.4338 1.76434 26.1905V4.54025C1.76434 2.98479 2.89941 1.72361 4.41282 1.51341ZM4.83321 32.5805C3.15164 32.5805 1.76434 31.1932 1.76434 29.5116C1.76434 27.83 3.15164 26.4427 4.83321 26.4427H8.2384C8.65879 26.4427 8.9951 26.1064 8.9951 25.686V9.08049H26.1051L20.4298 14.7138C20.3878 14.7558 20.2616 14.8819 20.2196 15.008C17.6132 23.3738 18.8743 19.296 18.538 20.4731C18.3699 21.0196 18.9164 21.5662 19.4629 21.398L24.886 19.7164C24.97 19.6744 25.0962 19.6324 25.1802 19.5483L33.4199 11.3086V20.8095L21.691 32.5805H4.83321ZM38.4226 38.466H37.6659V37.4991C37.6659 37.0787 37.3296 36.7424 36.9092 36.7424C36.4888 36.7424 36.1525 37.0787 36.1525 37.4991V38.466H34.8072V38.0035C34.8072 37.5831 34.4709 37.2468 34.0505 37.2468C33.6301 37.2468 33.2938 37.5831 33.2938 38.0035V38.466H31.9486V37.4991C31.9486 37.0787 31.6122 36.7424 31.1919 36.7424C30.7715 36.7424 30.4351 37.0787 30.4351 37.4991V38.466H29.216V38.0035C29.216 37.5831 28.8797 37.2468 28.4593 37.2468C28.0389 37.2468 27.7026 37.5831 27.7026 38.0035V38.466H26.3573V37.4991C26.3573 37.0787 26.021 36.7424 25.6006 36.7424C25.1802 36.7424 24.8439 37.0787 24.8439 37.4991V38.466H23.4987V38.0035C23.4987 37.5831 23.1623 37.2468 22.742 37.2468C22.3216 37.2468 21.9853 37.5831 21.9853 38.0035V38.466H20.64V37.4991C20.64 37.0787 20.3037 36.7424 19.8833 36.7424C19.4629 36.7424 19.1266 37.0787 19.1266 37.4991V38.466H17.7393L38.2545 17.9508L38.4226 38.466Z"
                                                fill="white" />
                                            <path
                                                d="M25.262 34.6825C24.7995 35.145 25.1359 35.9437 25.7664 35.9437H35.1832C35.6036 35.9437 35.8979 35.6074 35.94 35.229V25.7702C35.94 25.0976 35.1412 24.8033 34.6788 25.2657L25.262 34.6825ZM34.4265 34.4723H27.5321L34.4265 27.5779V34.4723Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_4391_679">
                                                <rect width="40" height="40" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="details">
                                    <h6 class="icon-title">Emergency Service</h6>
                                    <p class="icon-des">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has.
                                    </p>
                                </div>
                            </div>
                            <div class="icon-item">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                        viewBox="0 0 40 40" fill="none">
                                        <g clip-path="url(#clip0_4391_679)">
                                            <path
                                                d="M37.8761 16.3953L34.9754 19.296V9.8372L38.801 6.01162C39.894 4.9186 39.894 3.15295 38.801 2.10197L37.9181 1.21914C37.6589 0.959327 37.3509 0.753201 37.0118 0.612562C36.6728 0.471922 36.3094 0.39953 35.9423 0.39953C35.5752 0.39953 35.2118 0.471922 34.8728 0.612562C34.5337 0.753201 34.2257 0.959327 33.9665 1.21914C25.1802 10.0054 28.2071 6.97852 27.5344 7.60911H8.95306V0.756708C8.95306 0.336315 8.61675 0.0420393 8.2384 0H4.83321C2.35289 0 0.292969 2.01789 0.292969 4.54025V29.5536C0.292969 32.0339 2.31085 34.0939 4.83321 34.0939H20.1776L16.352 37.9194C15.5953 38.6762 16.1418 39.9373 17.1928 39.9373H39.1373C39.5577 39.9373 39.852 39.601 39.894 39.2227V17.2361C39.894 16.1851 38.6328 15.6386 37.8761 16.3953ZM24.4656 18.203C23.9611 18.0349 23.6248 17.5724 23.5407 17.0259C23.4987 16.6896 23.2464 16.4374 22.9101 16.3953C22.4056 16.3533 21.9432 16.017 21.7751 15.4705L32.3269 4.9186L35.0595 7.65115C20.5559 22.1127 25.5586 17.152 24.4656 18.203ZM22.826 18.8336L20.3878 19.5903L21.1445 17.152C21.1865 17.1941 21.5649 17.5724 22.2375 17.7826C22.3216 18.161 22.5738 18.5393 22.826 18.8336ZM35.0595 2.22808C35.5639 1.72361 36.4047 1.72361 36.9092 2.22808L37.792 3.11091C38.2965 3.61538 38.2965 4.45617 37.792 4.96064L36.1105 6.64221L33.3779 3.90966L35.0595 2.22808ZM4.41282 1.51341H7.48169V25.0134H4.83321C3.69815 25.0134 2.60513 25.4338 1.76434 26.1905V4.54025C1.76434 2.98479 2.89941 1.72361 4.41282 1.51341ZM4.83321 32.5805C3.15164 32.5805 1.76434 31.1932 1.76434 29.5116C1.76434 27.83 3.15164 26.4427 4.83321 26.4427H8.2384C8.65879 26.4427 8.9951 26.1064 8.9951 25.686V9.08049H26.1051L20.4298 14.7138C20.3878 14.7558 20.2616 14.8819 20.2196 15.008C17.6132 23.3738 18.8743 19.296 18.538 20.4731C18.3699 21.0196 18.9164 21.5662 19.4629 21.398L24.886 19.7164C24.97 19.6744 25.0962 19.6324 25.1802 19.5483L33.4199 11.3086V20.8095L21.691 32.5805H4.83321ZM38.4226 38.466H37.6659V37.4991C37.6659 37.0787 37.3296 36.7424 36.9092 36.7424C36.4888 36.7424 36.1525 37.0787 36.1525 37.4991V38.466H34.8072V38.0035C34.8072 37.5831 34.4709 37.2468 34.0505 37.2468C33.6301 37.2468 33.2938 37.5831 33.2938 38.0035V38.466H31.9486V37.4991C31.9486 37.0787 31.6122 36.7424 31.1919 36.7424C30.7715 36.7424 30.4351 37.0787 30.4351 37.4991V38.466H29.216V38.0035C29.216 37.5831 28.8797 37.2468 28.4593 37.2468C28.0389 37.2468 27.7026 37.5831 27.7026 38.0035V38.466H26.3573V37.4991C26.3573 37.0787 26.021 36.7424 25.6006 36.7424C25.1802 36.7424 24.8439 37.0787 24.8439 37.4991V38.466H23.4987V38.0035C23.4987 37.5831 23.1623 37.2468 22.742 37.2468C22.3216 37.2468 21.9853 37.5831 21.9853 38.0035V38.466H20.64V37.4991C20.64 37.0787 20.3037 36.7424 19.8833 36.7424C19.4629 36.7424 19.1266 37.0787 19.1266 37.4991V38.466H17.7393L38.2545 17.9508L38.4226 38.466Z"
                                                fill="white" />
                                            <path
                                                d="M25.262 34.6825C24.7995 35.145 25.1359 35.9437 25.7664 35.9437H35.1832C35.6036 35.9437 35.8979 35.6074 35.94 35.229V25.7702C35.94 25.0976 35.1412 24.8033 34.6788 25.2657L25.262 34.6825ZM34.4265 34.4723H27.5321L34.4265 27.5779V34.4723Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_4391_679">
                                                <rect width="40" height="40" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="details">
                                    <h6 class="icon-title">Party Services</h6>
                                    <p class="icon-des">
                                        Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="video-container">
                        @if (!empty($cms['plat_form_work_container']->image))
                            <video id="work-video" src="{{ asset($cms['plat_form_work_container']->image) }}"
                                type="video/mp4"></video>
                        @else
                            <video id="work-video" src="{{ asset('frontend/assets/images/work-video.mp4') }}"
                                type="video/mp4"></video>
                        @endif

                        <button id="work-video-play-button" class="play-button">
                            &#9658;
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="work work-sec container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="video-container">
                        @if (!empty($cms['provider_work_container']->image))
                            <video id="work-video" src="{{ asset($cms['provider_work_container']->image) }}"
                                type="video/mp4"></video>
                        @else
                            <video id="work-video" src="{{ asset('frontend/assets/images/work-video.mp4') }}"
                                type="video/mp4"></video>
                        @endif
                        <button id="work-video-play-button" class="play-button">
                            &#9658;
                        </button>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <h2 class="title"> {{ $cms['provider_work_container']->title ?? 'Service Provider showing Work' }}
                    </h2>
                    <p class="des">
                        {{ $cms['provider_work_container']->description ??
                            'Yet bed any for travelling assistance indulgence unpleasing. Not
                                                                                                thoughts all exercise blessing. Indulgence way everything joy. Yet
                                                                                                bed any for travelling assistance indulgence unpleasing. Not
                                                                                                thoughts all exercise blessing. Indulgence way everything joy.' }}
                    </p>
                    <a href="#"
                        class="button">{{ $cms['provider_work_container']->button_text ?? 'Service Provider showing Work' }}</a>
                </div>
            </div>
        </section>
        <!-- work section end -->

        <!-- user review section start -->
        {{-- <section class="user-review">
            <div class="container">
                <h2 class="title" data-aos="fade-up">
                    {{ $cms['review_user_container']->title ?? 'What Our Users Are Saying' }}</h2>
                <p class="des" data-aos="fade-up">
                    {{ $cms['review_user_container']->description ??
                        "Lorem ipsum dolor sit amet consectetur. Sodales odio vulputate erat arcu eget ac pharetra enim cras. Etiam et laoreet iaculis bibendum
                                        ipsum mauris enim. Fermentum adipiscing id tincidunt vehicula. Ac ut
                                        tellus condimentum et urna orci eu morbi eleifend." }}
                </p>
            </div>
            <div data-aos="fade-down">
                <div class="user-review-carousel owl-carousel owl-theme" aria-label="User review Carousel">
                    <a href="#" class="item" aria-roledescription="slide">
                        <img src="{{ asset('frontend/assets/images/user-review-01.png') }}" alt="user review image" />
                        <div class="details-container">
                            <div class="user-details">
                                <div>
                                    <div class="user-name">Sarah Deo</div>
                                    <div class="tagline">(Car painter)</div>
                                </div>
                                <div class="review">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M7.2795 1.91199C7.35287 1.78609 7.45796 1.68164 7.58429 1.60904C7.71063 1.53644 7.85379 1.49823 7.9995 1.49823C8.14521 1.49823 8.28838 1.53644 8.41471 1.60904C8.54105 1.68164 8.64614 1.78609 8.7195 1.91199L10.5828 5.11065L14.2015 5.89465C14.3438 5.92558 14.4756 5.99329 14.5836 6.09101C14.6916 6.18873 14.7721 6.31306 14.8171 6.4516C14.8621 6.59014 14.87 6.73806 14.84 6.8806C14.81 7.02314 14.7432 7.15533 14.6462 7.26399L12.1795 10.0247L12.5528 13.708C12.5676 13.853 12.544 13.9994 12.4845 14.1325C12.4249 14.2655 12.3315 14.3807 12.2136 14.4664C12.0956 14.552 11.9573 14.6053 11.8123 14.6208C11.6674 14.6363 11.5209 14.6135 11.3875 14.5547L7.9995 13.0613L4.6115 14.5547C4.47811 14.6135 4.33163 14.6363 4.18667 14.6208C4.04171 14.6053 3.90336 14.552 3.78542 14.4664C3.66748 14.3807 3.57408 14.2655 3.51455 14.1325C3.45502 13.9994 3.43144 13.853 3.44617 13.708L3.8195 10.0247L1.35284 7.26465C1.25565 7.156 1.18867 7.02376 1.15858 6.88113C1.12848 6.7385 1.13633 6.59047 1.18133 6.45182C1.22633 6.31317 1.30692 6.18875 1.41504 6.09099C1.52316 5.99322 1.65504 5.92552 1.7975 5.89465L5.41617 5.11065L7.2795 1.91199Z"
                                            fill="#FFC700" />
                                    </svg>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <p class="details">
                                Professional the with 10 years of experience.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="item" aria-roledescription="slide">
                        <img src="{{ asset('frontend/assets/images/user-review-01.png') }}" alt="user review image" />
                        <div class="details-container">
                            <div class="user-details">
                                <div>
                                    <div class="user-name">Sarah Deo</div>
                                    <div class="tagline">(Car painter)</div>
                                </div>
                                <div class="review">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M7.2795 1.91199C7.35287 1.78609 7.45796 1.68164 7.58429 1.60904C7.71063 1.53644 7.85379 1.49823 7.9995 1.49823C8.14521 1.49823 8.28838 1.53644 8.41471 1.60904C8.54105 1.68164 8.64614 1.78609 8.7195 1.91199L10.5828 5.11065L14.2015 5.89465C14.3438 5.92558 14.4756 5.99329 14.5836 6.09101C14.6916 6.18873 14.7721 6.31306 14.8171 6.4516C14.8621 6.59014 14.87 6.73806 14.84 6.8806C14.81 7.02314 14.7432 7.15533 14.6462 7.26399L12.1795 10.0247L12.5528 13.708C12.5676 13.853 12.544 13.9994 12.4845 14.1325C12.4249 14.2655 12.3315 14.3807 12.2136 14.4664C12.0956 14.552 11.9573 14.6053 11.8123 14.6208C11.6674 14.6363 11.5209 14.6135 11.3875 14.5547L7.9995 13.0613L4.6115 14.5547C4.47811 14.6135 4.33163 14.6363 4.18667 14.6208C4.04171 14.6053 3.90336 14.552 3.78542 14.4664C3.66748 14.3807 3.57408 14.2655 3.51455 14.1325C3.45502 13.9994 3.43144 13.853 3.44617 13.708L3.8195 10.0247L1.35284 7.26465C1.25565 7.156 1.18867 7.02376 1.15858 6.88113C1.12848 6.7385 1.13633 6.59047 1.18133 6.45182C1.22633 6.31317 1.30692 6.18875 1.41504 6.09099C1.52316 5.99322 1.65504 5.92552 1.7975 5.89465L5.41617 5.11065L7.2795 1.91199Z"
                                            fill="#FFC700" />
                                    </svg>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <p class="details">
                                Professional the with 10 years of experience.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="item" aria-roledescription="slide">
                        <img src="{{ asset('frontend/assets/images/user-review-01.png') }}" alt="user review image" />
                        <div class="details-container">
                            <div class="user-details">
                                <div>
                                    <div class="user-name">Sarah Deo</div>
                                    <div class="tagline">(Car painter)</div>
                                </div>
                                <div class="review">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M7.2795 1.91199C7.35287 1.78609 7.45796 1.68164 7.58429 1.60904C7.71063 1.53644 7.85379 1.49823 7.9995 1.49823C8.14521 1.49823 8.28838 1.53644 8.41471 1.60904C8.54105 1.68164 8.64614 1.78609 8.7195 1.91199L10.5828 5.11065L14.2015 5.89465C14.3438 5.92558 14.4756 5.99329 14.5836 6.09101C14.6916 6.18873 14.7721 6.31306 14.8171 6.4516C14.8621 6.59014 14.87 6.73806 14.84 6.8806C14.81 7.02314 14.7432 7.15533 14.6462 7.26399L12.1795 10.0247L12.5528 13.708C12.5676 13.853 12.544 13.9994 12.4845 14.1325C12.4249 14.2655 12.3315 14.3807 12.2136 14.4664C12.0956 14.552 11.9573 14.6053 11.8123 14.6208C11.6674 14.6363 11.5209 14.6135 11.3875 14.5547L7.9995 13.0613L4.6115 14.5547C4.47811 14.6135 4.33163 14.6363 4.18667 14.6208C4.04171 14.6053 3.90336 14.552 3.78542 14.4664C3.66748 14.3807 3.57408 14.2655 3.51455 14.1325C3.45502 13.9994 3.43144 13.853 3.44617 13.708L3.8195 10.0247L1.35284 7.26465C1.25565 7.156 1.18867 7.02376 1.15858 6.88113C1.12848 6.7385 1.13633 6.59047 1.18133 6.45182C1.22633 6.31317 1.30692 6.18875 1.41504 6.09099C1.52316 5.99322 1.65504 5.92552 1.7975 5.89465L5.41617 5.11065L7.2795 1.91199Z"
                                            fill="#FFC700" />
                                    </svg>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <p class="details">
                                Professional the with 10 years of experience.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="item" aria-roledescription="slide">
                        <img src="{{ asset('frontend/assets/images/user-review-01.png') }}" alt="user review image" />
                        <div class="details-container">
                            <div class="user-details">
                                <div>
                                    <div class="user-name">Sarah Deo</div>
                                    <div class="tagline">(Car painter)</div>
                                </div>
                                <div class="review">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M7.2795 1.91199C7.35287 1.78609 7.45796 1.68164 7.58429 1.60904C7.71063 1.53644 7.85379 1.49823 7.9995 1.49823C8.14521 1.49823 8.28838 1.53644 8.41471 1.60904C8.54105 1.68164 8.64614 1.78609 8.7195 1.91199L10.5828 5.11065L14.2015 5.89465C14.3438 5.92558 14.4756 5.99329 14.5836 6.09101C14.6916 6.18873 14.7721 6.31306 14.8171 6.4516C14.8621 6.59014 14.87 6.73806 14.84 6.8806C14.81 7.02314 14.7432 7.15533 14.6462 7.26399L12.1795 10.0247L12.5528 13.708C12.5676 13.853 12.544 13.9994 12.4845 14.1325C12.4249 14.2655 12.3315 14.3807 12.2136 14.4664C12.0956 14.552 11.9573 14.6053 11.8123 14.6208C11.6674 14.6363 11.5209 14.6135 11.3875 14.5547L7.9995 13.0613L4.6115 14.5547C4.47811 14.6135 4.33163 14.6363 4.18667 14.6208C4.04171 14.6053 3.90336 14.552 3.78542 14.4664C3.66748 14.3807 3.57408 14.2655 3.51455 14.1325C3.45502 13.9994 3.43144 13.853 3.44617 13.708L3.8195 10.0247L1.35284 7.26465C1.25565 7.156 1.18867 7.02376 1.15858 6.88113C1.12848 6.7385 1.13633 6.59047 1.18133 6.45182C1.22633 6.31317 1.30692 6.18875 1.41504 6.09099C1.52316 5.99322 1.65504 5.92552 1.7975 5.89465L5.41617 5.11065L7.2795 1.91199Z"
                                            fill="#FFC700" />
                                    </svg>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <p class="details">
                                Professional the with 10 years of experience.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="item" aria-roledescription="slide">
                        <img src="{{ asset('frontend/assets/images/user-review-01.png') }}" alt="user review image" />
                        <div class="details-container">
                            <div class="user-details">
                                <div>
                                    <div class="user-name">Sarah Deo</div>
                                    <div class="tagline">(Car painter)</div>
                                </div>
                                <div class="review">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M7.2795 1.91199C7.35287 1.78609 7.45796 1.68164 7.58429 1.60904C7.71063 1.53644 7.85379 1.49823 7.9995 1.49823C8.14521 1.49823 8.28838 1.53644 8.41471 1.60904C8.54105 1.68164 8.64614 1.78609 8.7195 1.91199L10.5828 5.11065L14.2015 5.89465C14.3438 5.92558 14.4756 5.99329 14.5836 6.09101C14.6916 6.18873 14.7721 6.31306 14.8171 6.4516C14.8621 6.59014 14.87 6.73806 14.84 6.8806C14.81 7.02314 14.7432 7.15533 14.6462 7.26399L12.1795 10.0247L12.5528 13.708C12.5676 13.853 12.544 13.9994 12.4845 14.1325C12.4249 14.2655 12.3315 14.3807 12.2136 14.4664C12.0956 14.552 11.9573 14.6053 11.8123 14.6208C11.6674 14.6363 11.5209 14.6135 11.3875 14.5547L7.9995 13.0613L4.6115 14.5547C4.47811 14.6135 4.33163 14.6363 4.18667 14.6208C4.04171 14.6053 3.90336 14.552 3.78542 14.4664C3.66748 14.3807 3.57408 14.2655 3.51455 14.1325C3.45502 13.9994 3.43144 13.853 3.44617 13.708L3.8195 10.0247L1.35284 7.26465C1.25565 7.156 1.18867 7.02376 1.15858 6.88113C1.12848 6.7385 1.13633 6.59047 1.18133 6.45182C1.22633 6.31317 1.30692 6.18875 1.41504 6.09099C1.52316 5.99322 1.65504 5.92552 1.7975 5.89465L5.41617 5.11065L7.2795 1.91199Z"
                                            fill="#FFC700" />
                                    </svg>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <p class="details">
                                Professional the with 10 years of experience.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="item" aria-roledescription="slide">
                        <img src="{{ asset('frontend/assets/images/user-review-01.png') }}" alt="user review image" />
                        <div class="details-container">
                            <div class="user-details">
                                <div>
                                    <div class="user-name">Sarah Deo</div>
                                    <div class="tagline">(Car painter)</div>
                                </div>
                                <div class="review">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M7.2795 1.91199C7.35287 1.78609 7.45796 1.68164 7.58429 1.60904C7.71063 1.53644 7.85379 1.49823 7.9995 1.49823C8.14521 1.49823 8.28838 1.53644 8.41471 1.60904C8.54105 1.68164 8.64614 1.78609 8.7195 1.91199L10.5828 5.11065L14.2015 5.89465C14.3438 5.92558 14.4756 5.99329 14.5836 6.09101C14.6916 6.18873 14.7721 6.31306 14.8171 6.4516C14.8621 6.59014 14.87 6.73806 14.84 6.8806C14.81 7.02314 14.7432 7.15533 14.6462 7.26399L12.1795 10.0247L12.5528 13.708C12.5676 13.853 12.544 13.9994 12.4845 14.1325C12.4249 14.2655 12.3315 14.3807 12.2136 14.4664C12.0956 14.552 11.9573 14.6053 11.8123 14.6208C11.6674 14.6363 11.5209 14.6135 11.3875 14.5547L7.9995 13.0613L4.6115 14.5547C4.47811 14.6135 4.33163 14.6363 4.18667 14.6208C4.04171 14.6053 3.90336 14.552 3.78542 14.4664C3.66748 14.3807 3.57408 14.2655 3.51455 14.1325C3.45502 13.9994 3.43144 13.853 3.44617 13.708L3.8195 10.0247L1.35284 7.26465C1.25565 7.156 1.18867 7.02376 1.15858 6.88113C1.12848 6.7385 1.13633 6.59047 1.18133 6.45182C1.22633 6.31317 1.30692 6.18875 1.41504 6.09099C1.52316 5.99322 1.65504 5.92552 1.7975 5.89465L5.41617 5.11065L7.2795 1.91199Z"
                                            fill="#FFC700" />
                                    </svg>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <p class="details">
                                Professional the with 10 years of experience.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="item" aria-roledescription="slide">
                        <img src="{{ asset('frontend/assets/images/user-review-01.png') }}" alt="user review image" />
                        <div class="details-container">
                            <div class="user-details">
                                <div>
                                    <div class="user-name">Sarah Deo</div>
                                    <div class="tagline">(Car painter)</div>
                                </div>
                                <div class="review">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M7.2795 1.91199C7.35287 1.78609 7.45796 1.68164 7.58429 1.60904C7.71063 1.53644 7.85379 1.49823 7.9995 1.49823C8.14521 1.49823 8.28838 1.53644 8.41471 1.60904C8.54105 1.68164 8.64614 1.78609 8.7195 1.91199L10.5828 5.11065L14.2015 5.89465C14.3438 5.92558 14.4756 5.99329 14.5836 6.09101C14.6916 6.18873 14.7721 6.31306 14.8171 6.4516C14.8621 6.59014 14.87 6.73806 14.84 6.8806C14.81 7.02314 14.7432 7.15533 14.6462 7.26399L12.1795 10.0247L12.5528 13.708C12.5676 13.853 12.544 13.9994 12.4845 14.1325C12.4249 14.2655 12.3315 14.3807 12.2136 14.4664C12.0956 14.552 11.9573 14.6053 11.8123 14.6208C11.6674 14.6363 11.5209 14.6135 11.3875 14.5547L7.9995 13.0613L4.6115 14.5547C4.47811 14.6135 4.33163 14.6363 4.18667 14.6208C4.04171 14.6053 3.90336 14.552 3.78542 14.4664C3.66748 14.3807 3.57408 14.2655 3.51455 14.1325C3.45502 13.9994 3.43144 13.853 3.44617 13.708L3.8195 10.0247L1.35284 7.26465C1.25565 7.156 1.18867 7.02376 1.15858 6.88113C1.12848 6.7385 1.13633 6.59047 1.18133 6.45182C1.22633 6.31317 1.30692 6.18875 1.41504 6.09099C1.52316 5.99322 1.65504 5.92552 1.7975 5.89465L5.41617 5.11065L7.2795 1.91199Z"
                                            fill="#FFC700" />
                                    </svg>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <p class="details">
                                Professional the with 10 years of experience.
                            </p>
                        </div>
                    </a>
                    <a href="#" class="item" aria-roledescription="slide">
                        <img src="{{ asset('frontend/assets/images/user-review-01.png') }}" alt="user review image" />
                        <div class="details-container">
                            <div class="user-details">
                                <div>
                                    <div class="user-name">Sarah Deo</div>
                                    <div class="tagline">(Car painter)</div>
                                </div>
                                <div class="review">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 16 16" fill="none">
                                        <path
                                            d="M7.2795 1.91199C7.35287 1.78609 7.45796 1.68164 7.58429 1.60904C7.71063 1.53644 7.85379 1.49823 7.9995 1.49823C8.14521 1.49823 8.28838 1.53644 8.41471 1.60904C8.54105 1.68164 8.64614 1.78609 8.7195 1.91199L10.5828 5.11065L14.2015 5.89465C14.3438 5.92558 14.4756 5.99329 14.5836 6.09101C14.6916 6.18873 14.7721 6.31306 14.8171 6.4516C14.8621 6.59014 14.87 6.73806 14.84 6.8806C14.81 7.02314 14.7432 7.15533 14.6462 7.26399L12.1795 10.0247L12.5528 13.708C12.5676 13.853 12.544 13.9994 12.4845 14.1325C12.4249 14.2655 12.3315 14.3807 12.2136 14.4664C12.0956 14.552 11.9573 14.6053 11.8123 14.6208C11.6674 14.6363 11.5209 14.6135 11.3875 14.5547L7.9995 13.0613L4.6115 14.5547C4.47811 14.6135 4.33163 14.6363 4.18667 14.6208C4.04171 14.6053 3.90336 14.552 3.78542 14.4664C3.66748 14.3807 3.57408 14.2655 3.51455 14.1325C3.45502 13.9994 3.43144 13.853 3.44617 13.708L3.8195 10.0247L1.35284 7.26465C1.25565 7.156 1.18867 7.02376 1.15858 6.88113C1.12848 6.7385 1.13633 6.59047 1.18133 6.45182C1.22633 6.31317 1.30692 6.18875 1.41504 6.09099C1.52316 5.99322 1.65504 5.92552 1.7975 5.89465L5.41617 5.11065L7.2795 1.91199Z"
                                            fill="#FFC700" />
                                    </svg>
                                    <span>(4.5)</span>
                                </div>
                            </div>
                            <p class="details">
                                Professional the with 10 years of experience.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </section> --}}
        <!-- user review section end -->

        <!-- testimonial section start -->
        {{-- <section class="testimonial container">
            <h2 class="title" data-aos="fade-up">
                {{ $cms['review_provider_container']->title ?? 'What Our Users Are Saying' }}</h2>
            <p class="des" data-aos="fade-up">
                {{ $cms['review_provider_container']->description ??
                    "Lorem ipsum dolor sit amet consectetur. Sodales odio vulputate erat
                                arcu eget ac pharetra enim cras. Etiam et laoreet iaculis bibendum
                                ipsum mauris enim. Fermentum adipiscing id tincidunt vehicula. Ac ut
                                tellus condimentum et urna orci eu morbi eleifend." }}

            </p>
            <div data-aos="fade-down">
                <div class="testimonial-carousel owl-carousel owl-theme" aria-label="Testimonials Carousel">
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance" maskUnits="userSpaceOnUse"
                                            x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance"
                                            maskUnits="userSpaceOnUse" x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance"
                                            maskUnits="userSpaceOnUse" x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance"
                                            maskUnits="userSpaceOnUse" x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                    <div class="item" aria-roledescription="slide" aria-label="Testimonial by Sarah">
                        <div class="header">
                            <figure class="client-photo">
                                <img src="{{ asset('frontend/assets/images/client.jpg') }}" alt="Photo of Sarah" />
                            </figure>
                            <div>
                                <h4 class="client-name">Sarah</h4>
                                <div class="stars" aria-label="5 out of 5 stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="#FFD700" aria-hidden="true">
                                        <path
                                            d="M12 .587l3.668 7.431 8.332 1.151-6.064 5.684 1.44 8.147-7.376-4.098-7.376 4.098 1.44-8.147-6.064-5.684 8.332-1.151z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="media-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="31" height="33"
                                    viewBox="0 0 31 33" fill="none">
                                    <g clip-path="url(#clip0_4391_514)">
                                        <mask id="mask0_4391_514" style="mask-type: luminance"
                                            maskUnits="userSpaceOnUse" x="0" y="0" width="31" height="33">
                                            <path d="M31 0.665039H0V32.3341H31V0.665039Z" fill="white" />
                                        </mask>
                                        <g mask="url(#mask0_4391_514)">
                                            <path
                                                d="M30.9835 16.7955C30.9835 15.498 30.8781 14.5512 30.6498 13.5694H15.8086V19.4255H24.5201C24.3445 20.8808 23.3961 23.0725 21.2884 24.5452L21.2589 24.7413L25.9514 28.3703L26.2765 28.4027C29.2622 25.6499 30.9835 21.5996 30.9835 16.7955Z"
                                                fill="#4285F4" />
                                            <path
                                                d="M15.8086 32.2267C20.0765 32.2267 23.6594 30.824 26.2764 28.4044L21.2884 24.5469C19.9536 25.4762 18.162 26.125 15.8086 26.125C11.6285 26.125 8.08071 23.3723 6.81602 19.5675L6.63064 19.5832L1.75131 23.353L1.6875 23.53C4.28687 28.6848 9.62619 32.2267 15.8086 32.2267Z"
                                                fill="#34A853" />
                                            <path
                                                d="M6.81457 19.5655C6.48087 18.5837 6.28775 17.5316 6.28775 16.4446C6.28775 15.3574 6.48088 14.3054 6.79702 13.3236L6.78818 13.1145L1.8477 9.28418L1.68606 9.36093C0.61473 11.5001 0 13.9022 0 16.4446C0 18.9869 0.61473 21.3889 1.68606 23.528L6.81457 19.5655Z"
                                                fill="#FBBC05" />
                                            <path
                                                d="M15.8086 6.76665C18.7768 6.76665 20.779 8.04659 21.9206 9.1162L26.3818 4.76787C23.6419 2.22552 20.0765 0.665039 15.8086 0.665039C9.6262 0.665039 4.28688 4.20677 1.6875 9.36158L6.79846 13.3242C8.08071 9.51944 11.6285 6.76665 15.8086 6.76665Z"
                                                fill="#EB4335" />
                                        </g>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4391_514">
                                            <rect width="31" height="33" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>
                        </div>
                        <blockquote>
                            <p class="client-testimonial">
                                This platform helped me find a reliable contractor for my home
                                renovation. The service was seamless, and I highly recommend
                                it! This platform helped me find a reliable contractor for my
                                home renovation. The service was seamless, and I highly
                                recommend it!
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- testimonial section end -->


  <!-- ads section start -->
        <section class="user-review">
            <div class="container">
                <h2 class="title" data-aos="fade-up">
                    {{ $cms['review_user_container']->title ?? 'View Some ' }}</h2>
                <p class="des" data-aos="fade-up">
                    {{ $cms['review_user_container']->description ??
                        "Lorem ipsum " }}
                </p>
            </div>
            <div class="new-banner-photo"  >
                <a href="https://ramafox.blogspot.com/?m=1" target="_blank">
                <img src="{{ asset('frontend/assets/images/add_photo.jpg') }}" alt="ads image" style="width:100%; height: 100%; object-fit:cover" />
                </a> 
            </div>
        </section>
        <!-- ads section end -->

        <!-- faq section star -->
        <section class="faq container">
            <div class="row justify-content-between">
                <div class="col-md-4" data-aos="fade-right">
                    <h2 class="title">{{ $cms['faq_container']->title ?? 'Any questions? We got you.' }}</h2>
                    <p class="des">
                        {{ $cms['faq_container']->description ??
                            "Yet bed any for assistance indulgence unpleasing. Not thoughts all
                                                exercise blessing. Indulgence way everything joy alteration
                                                boisterous the attachment." }}

                    </p>
                    <a class="more-btn"
                        href="#"><span>{{ $cms['faq_container']->button_text ?? 'More FAQ' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="12" viewBox="0 0 17 12"
                            fill="none">
                            <path
                                d="M16.5303 6.53033C16.8232 6.23744 16.8232 5.76256 16.5303 5.46967L11.7574 0.696699C11.4645 0.403806 10.9896 0.403806 10.6967 0.696699C10.4038 0.989593 10.4038 1.46447 10.6967 1.75736L14.9393 6L10.6967 10.2426C10.4038 10.5355 10.4038 11.0104 10.6967 11.3033C10.9896 11.5962 11.4645 11.5962 11.7574 11.3033L16.5303 6.53033ZM0 6.75H16V5.25H0L0 6.75Z"
                                fill="#003366" />
                        </svg></a>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    @if (isset($cms['faq_container_content']) && count($cms['faq_container_content']) > 0)
                        <div class="accordion" id="faqAccordion">
                            @foreach ($cms['faq_container_content'] as $key => $d)
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#faqOne{{ $key }}" aria-expanded="true"
                                            aria-controls="faqOne{{ $key }}">
                                            {{ $d->title ?? 'How this work?' }}
                                        </button>
                                    </h2>
                                    <div id="faqOne{{ $key }}"
                                        class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {{ $d->description ??
                                                'Yet bed any for assistance indulgence unpleasing. Not
                                                                                    thoughts all exercise blessing. Indulgence way everything
                                                                                    joy alteration boisterous the attachment.' }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="accordion" id="faqAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#faqOne" aria-expanded="true" aria-controls="faqOne">
                                        How this work?
                                    </button>
                                </h2>
                                <div id="faqOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yet bed any for assistance indulgence unpleasing. Not
                                        thoughts all exercise blessing. Indulgence way everything
                                        joy alteration boisterous the attachment.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faqTwo" aria-expanded="false"
                                        aria-controls="faqTwo">
                                        Are there any additional fee?
                                    </button>
                                </h2>
                                <div id="faqTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yet bed any for assistance indulgence unpleasing. Not
                                        thoughts all exercise blessing. Indulgence way everything
                                        joy alteration boisterous the attachment.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faqThree" aria-expanded="false"
                                        aria-controls="faqThree">
                                        How can I get the app?
                                    </button>
                                </h2>
                                <div id="faqThree" class="accordion-collapse collapse"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yet bed any for assistance indulgence unpleasing. Not
                                        thoughts all exercise blessing. Indulgence way everything
                                        joy alteration boisterous the attachment.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faqfour" aria-expanded="false"
                                        aria-controls="faqfour">
                                        What features do you offer and other not?
                                    </button>
                                </h2>
                                <div id="faqfour" class="accordion-collapse collapse"
                                    data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yet bed any for assistance indulgence unpleasing. Not
                                        thoughts all exercise blessing. Indulgence way everything
                                        joy alteration boisterous the attachment.
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
        <!-- faq section end -->

        <!-- subscribe section start -->
        <section class="subscribe container" data-aos="fade-up">
            <div class="wrapper">
                <h2 class="title">
                    Join with us to explore the next revolution of future
                </h2>
                {{-- <form class="subscribe-form" >
                    <fieldset>
                        <input type="email" placeholder="Your Email Address" />
                    </fieldset>
                    <button type="submit">Sign Up</button>
                </form> --}}
            </div>
            <svg class="left-icon" width="310" height="369" viewBox="0 0 310 369" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M-45.8754 156.023L-14.5256 174.308C-14.0018 174.614 -13.4214 174.81 -12.8195 174.886C-12.2176 174.962 -11.6066 174.915 -11.0232 174.749L5.62584 169.986L84.3341 191.076L86.6654 182.381L6.72575 160.963C5.93849 160.75 5.1083 160.757 4.3243 160.981L-11.6798 165.544L-38.3787 149.962L-33.568 132.007L-2.63816 131.87L8.94165 143.823C9.50819 144.411 10.2242 144.833 11.0126 145.044L90.9534 166.464L93.2817 157.768L14.5737 136.678L2.5411 124.237C2.11881 123.801 1.61267 123.454 1.05306 123.218C0.493436 122.982 -0.108121 122.861 -0.715508 122.863L-37.0084 123.026C-37.9927 123.033 -38.9476 123.362 -39.7271 123.963C-40.5066 124.564 -41.0676 125.404 -41.3243 126.354L-47.9133 150.951C-48.1771 151.903 -48.1205 152.915 -47.7522 153.832C-47.3839 154.748 -46.7244 155.518 -45.8754 156.023ZM148.178 117.829L111.93 253.111L103.233 250.78L139.484 115.5L148.178 117.829ZM98.6716 264.811C97.9921 264.434 97.2265 264.24 96.4495 264.247C95.6726 264.254 94.9106 264.462 94.2378 264.85L70.8477 278.355C70.175 278.743 69.6143 279.299 69.2202 279.968C68.8261 280.637 68.6121 281.397 68.599 282.174L68.1564 308.418C68.1421 309.235 68.3503 310.04 68.7587 310.747C69.1671 311.455 69.7603 312.038 70.4748 312.434L93.4243 325.172C94.1035 325.549 94.8686 325.743 95.6452 325.737C96.4217 325.73 97.1834 325.523 97.856 325.134L121.246 311.63C121.919 311.242 122.48 310.686 122.874 310.016C123.268 309.347 123.483 308.587 123.496 307.81L123.937 281.567C123.952 280.75 123.744 279.945 123.335 279.238C122.927 278.53 122.333 277.947 121.619 277.551L98.6716 264.811ZM114.539 305.106L95.561 316.063L77.2029 305.873L77.5557 284.876L96.5337 273.919L114.893 284.112L114.539 305.106Z"
                    fill="#FF6600" fill-opacity="0.05" />
                <path
                    d="M182.372 120.404C208.169 105.626 217.103 72.7306 202.324 46.9329C200.074 43.0067 197.339 39.3797 194.183 36.1377C192.456 34.3481 189.607 34.2974 187.817 36.0236C187.231 36.5909 186.809 37.3066 186.597 38.0946L176.331 76.3564L153.372 81.0562L135.838 65.5144L146.091 27.2319C146.298 26.4609 146.296 25.6489 146.085 24.8791C145.874 24.1093 145.462 23.4094 144.892 22.8511C144.322 22.2928 143.613 21.8962 142.839 21.702C142.065 21.5077 141.253 21.5228 140.486 21.7457C111.866 29.8386 95.2266 59.5984 103.319 88.217C104.545 92.5596 106.313 96.7304 108.582 100.631C110.365 103.695 112.447 106.572 114.804 109.218L78.7196 243.886C75.3567 245.001 72.1137 246.45 69.0393 248.211C43.2019 263.128 34.3495 296.164 49.2669 322.002C64.1832 347.838 97.2198 356.69 123.057 341.772C148.893 326.856 157.745 293.82 142.829 267.984C141.047 264.921 138.963 262.044 136.607 259.397L145.246 227.157L159.345 230.935C160.499 231.244 161.727 231.082 162.761 230.485C163.795 229.888 164.55 228.905 164.859 227.752L165.682 224.677C166.411 221.991 169.174 220.396 171.864 221.107C174.555 221.824 176.154 224.587 175.438 227.279L175.434 227.291L174.61 230.364C173.967 232.765 175.392 235.234 177.793 235.876L251.146 255.531C270.504 260.813 290.477 249.401 295.759 230.043C301.039 210.686 289.627 190.712 270.269 185.431C270.165 185.402 270.059 185.373 269.952 185.345L196.6 165.691C194.2 165.048 191.731 166.473 191.088 168.873L190.265 171.947C189.535 174.635 186.774 176.229 184.081 175.517C181.391 174.799 179.79 172.037 180.508 169.348C180.51 169.343 180.512 169.339 180.512 169.335L181.336 166.259C181.979 163.858 180.554 161.39 178.154 160.747L164.054 156.969L172.692 124.729C176.055 123.615 179.299 122.166 182.373 120.404L182.372 120.404ZM274.214 244.107C271.38 245.738 268.276 246.847 265.05 247.381L277.917 199.356C289.568 208.925 291.256 226.126 281.687 237.776C279.598 240.32 277.066 242.464 274.214 244.107ZM171.553 168.285C170.209 175.927 175.317 183.212 182.958 184.554C189.673 185.734 196.268 181.922 198.594 175.512L267.624 194.041C268.373 194.243 269.107 194.488 269.832 194.75L255.744 247.325C254.981 247.196 254.224 247.033 253.475 246.837L184.413 228.329C185.757 220.687 180.649 213.402 173.008 212.06C166.292 210.878 159.697 214.693 157.37 221.101L147.532 218.466L161.722 165.664L171.553 168.285ZM164.658 119.988L127.27 259.465C127.068 260.216 127.064 261.007 127.258 261.76C127.453 262.513 127.839 263.204 128.379 263.764C145.853 281.679 145.496 310.37 127.578 327.844C109.662 345.319 80.9712 344.961 63.4952 327.044C46.0222 309.127 46.3796 280.437 64.2974 262.961C69.7178 257.676 76.3751 253.833 83.6621 251.781C84.4083 251.563 85.0862 251.158 85.6308 250.603C86.1755 250.049 86.5688 249.364 86.773 248.614L124.139 109.147C124.341 108.396 124.344 107.606 124.149 106.853C123.954 106.1 123.567 105.411 123.026 104.853C105.73 87.1611 106.05 58.798 123.741 41.5002C127.085 38.2318 130.92 35.5068 135.106 33.4241L126.42 65.8695C126.203 66.6764 126.215 67.5277 126.455 68.3279C126.695 69.1282 127.153 69.8458 127.778 70.4003L149.079 89.2911C149.603 89.754 150.227 90.0889 150.902 90.2691C151.577 90.4493 152.285 90.4701 152.969 90.3296L180.863 84.6215C181.681 84.4539 182.436 84.062 183.045 83.4896C183.653 82.9171 184.09 82.1868 184.307 81.3802L192.998 48.9431C193.47 49.6528 193.92 50.3771 194.347 51.1149C206.823 72.4733 199.624 99.8998 178.268 112.378C174.965 114.306 171.43 115.804 167.748 116.835C167 117.049 166.321 117.452 165.775 118.007C165.23 118.561 164.837 119.247 164.635 119.998L164.656 119.986L164.658 119.988Z"
                    fill="#FF6600" fill-opacity="0.05" />
                <path d="M256.007 214.557L253.676 223.254L192.187 206.778L194.516 198.082L256.007 214.557Z" fill="#FF6600"
                    fill-opacity="0.05" />
            </svg>
            <svg class="right-icon" width="310" height="369" viewBox="0 0 310 369" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M-45.8754 156.023L-14.5256 174.308C-14.0018 174.614 -13.4214 174.81 -12.8195 174.886C-12.2176 174.962 -11.6066 174.915 -11.0232 174.749L5.62584 169.986L84.3341 191.076L86.6654 182.381L6.72575 160.963C5.93849 160.75 5.1083 160.757 4.3243 160.981L-11.6798 165.544L-38.3787 149.962L-33.568 132.007L-2.63816 131.87L8.94165 143.823C9.50819 144.411 10.2242 144.833 11.0126 145.044L90.9534 166.464L93.2817 157.768L14.5737 136.678L2.5411 124.237C2.11881 123.801 1.61267 123.454 1.05306 123.218C0.493436 122.982 -0.108121 122.861 -0.715508 122.863L-37.0084 123.026C-37.9927 123.033 -38.9476 123.362 -39.7271 123.963C-40.5066 124.564 -41.0676 125.404 -41.3243 126.354L-47.9133 150.951C-48.1771 151.903 -48.1205 152.915 -47.7522 153.832C-47.3839 154.748 -46.7244 155.518 -45.8754 156.023ZM148.178 117.829L111.93 253.111L103.233 250.78L139.484 115.5L148.178 117.829ZM98.6716 264.811C97.9921 264.434 97.2265 264.24 96.4495 264.247C95.6726 264.254 94.9106 264.462 94.2378 264.85L70.8477 278.355C70.175 278.743 69.6143 279.299 69.2202 279.968C68.8261 280.637 68.6121 281.397 68.599 282.174L68.1564 308.418C68.1421 309.235 68.3503 310.04 68.7587 310.747C69.1671 311.455 69.7603 312.038 70.4748 312.434L93.4243 325.172C94.1035 325.549 94.8686 325.743 95.6452 325.737C96.4217 325.73 97.1834 325.523 97.856 325.134L121.246 311.63C121.919 311.242 122.48 310.686 122.874 310.016C123.268 309.347 123.483 308.587 123.496 307.81L123.937 281.567C123.952 280.75 123.744 279.945 123.335 279.238C122.927 278.53 122.333 277.947 121.619 277.551L98.6716 264.811ZM114.539 305.106L95.561 316.063L77.2029 305.873L77.5557 284.876L96.5337 273.919L114.893 284.112L114.539 305.106Z"
                    fill="#FF6600" fill-opacity="0.05" />
                <path
                    d="M182.372 120.404C208.169 105.626 217.103 72.7306 202.324 46.9329C200.074 43.0067 197.339 39.3797 194.183 36.1377C192.456 34.3481 189.607 34.2974 187.817 36.0236C187.231 36.5909 186.809 37.3066 186.597 38.0946L176.331 76.3564L153.372 81.0562L135.838 65.5144L146.091 27.2319C146.298 26.4609 146.296 25.6489 146.085 24.8791C145.874 24.1093 145.462 23.4094 144.892 22.8511C144.322 22.2928 143.613 21.8962 142.839 21.702C142.065 21.5077 141.253 21.5228 140.486 21.7457C111.866 29.8386 95.2266 59.5984 103.319 88.217C104.545 92.5596 106.313 96.7304 108.582 100.631C110.365 103.695 112.447 106.572 114.804 109.218L78.7196 243.886C75.3567 245.001 72.1137 246.45 69.0393 248.211C43.2019 263.128 34.3495 296.164 49.2669 322.002C64.1832 347.838 97.2198 356.69 123.057 341.772C148.893 326.856 157.745 293.82 142.829 267.984C141.047 264.921 138.963 262.044 136.607 259.397L145.246 227.157L159.345 230.935C160.499 231.244 161.727 231.082 162.761 230.485C163.795 229.888 164.55 228.905 164.859 227.752L165.682 224.677C166.411 221.991 169.174 220.396 171.864 221.107C174.555 221.824 176.154 224.587 175.438 227.279L175.434 227.291L174.61 230.364C173.967 232.765 175.392 235.234 177.793 235.876L251.146 255.531C270.504 260.813 290.477 249.401 295.759 230.043C301.039 210.686 289.627 190.712 270.269 185.431C270.165 185.402 270.059 185.373 269.952 185.345L196.6 165.691C194.2 165.048 191.731 166.473 191.088 168.873L190.265 171.947C189.535 174.635 186.774 176.229 184.081 175.517C181.391 174.799 179.79 172.037 180.508 169.348C180.51 169.343 180.512 169.339 180.512 169.335L181.336 166.259C181.979 163.858 180.554 161.39 178.154 160.747L164.054 156.969L172.692 124.729C176.055 123.615 179.299 122.166 182.373 120.404L182.372 120.404ZM274.214 244.107C271.38 245.738 268.276 246.847 265.05 247.381L277.917 199.356C289.568 208.925 291.256 226.126 281.687 237.776C279.598 240.32 277.066 242.464 274.214 244.107ZM171.553 168.285C170.209 175.927 175.317 183.212 182.958 184.554C189.673 185.734 196.268 181.922 198.594 175.512L267.624 194.041C268.373 194.243 269.107 194.488 269.832 194.75L255.744 247.325C254.981 247.196 254.224 247.033 253.475 246.837L184.413 228.329C185.757 220.687 180.649 213.402 173.008 212.06C166.292 210.878 159.697 214.693 157.37 221.101L147.532 218.466L161.722 165.664L171.553 168.285ZM164.658 119.988L127.27 259.465C127.068 260.216 127.064 261.007 127.258 261.76C127.453 262.513 127.839 263.204 128.379 263.764C145.853 281.679 145.496 310.37 127.578 327.844C109.662 345.319 80.9712 344.961 63.4952 327.044C46.0222 309.127 46.3796 280.437 64.2974 262.961C69.7178 257.676 76.3751 253.833 83.6621 251.781C84.4083 251.563 85.0862 251.158 85.6308 250.603C86.1755 250.049 86.5688 249.364 86.773 248.614L124.139 109.147C124.341 108.396 124.344 107.606 124.149 106.853C123.954 106.1 123.567 105.411 123.026 104.853C105.73 87.1611 106.05 58.798 123.741 41.5002C127.085 38.2318 130.92 35.5068 135.106 33.4241L126.42 65.8695C126.203 66.6764 126.215 67.5277 126.455 68.3279C126.695 69.1282 127.153 69.8458 127.778 70.4003L149.079 89.2911C149.603 89.754 150.227 90.0889 150.902 90.2691C151.577 90.4493 152.285 90.4701 152.969 90.3296L180.863 84.6215C181.681 84.4539 182.436 84.062 183.045 83.4896C183.653 82.9171 184.09 82.1868 184.307 81.3802L192.998 48.9431C193.47 49.6528 193.92 50.3771 194.347 51.1149C206.823 72.4733 199.624 99.8998 178.268 112.378C174.965 114.306 171.43 115.804 167.748 116.835C167 117.049 166.321 117.452 165.775 118.007C165.23 118.561 164.837 119.247 164.635 119.998L164.656 119.986L164.658 119.988Z"
                    fill="#FF6600" fill-opacity="0.05" />
                <path d="M256.007 214.557L253.676 223.254L192.187 206.778L194.516 198.082L256.007 214.557Z" fill="#FF6600"
                    fill-opacity="0.05" />
            </svg>
        </section>
        <!-- subscribe section end -->
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

<script>
    $(document).ready(function () {
    let cities = [];

    // Load Morocco city list from JSON
    $.getJSON("/backend/admin/assets/morocco_city_list.json", function (data) {
        cities = data.results.map(city => city.name); // Extract only city names
    });

    $("#locationInput").on("input", function () {
        let query = $(this).val().toLowerCase();
        let filteredCities = cities.filter(city => city.toLowerCase().includes(query));

        let dropdown = $("#locationDropdown");
        dropdown.empty().hide();

        if (filteredCities.length > 0) {
            dropdown.show();
            filteredCities.forEach(city => {
                dropdown.append(`<div class="dropdown-item">${city}</div>`);
            });
        }
    });
    $("#locationInput").on("click", function () {
        let query = $(this).val().toLowerCase();
        let filteredCities = cities.filter(city => city.toLowerCase().includes(query));

        let dropdown = $("#locationDropdown");
        dropdown.empty().hide();

        if (filteredCities.length > 0) {
            dropdown.show();
            filteredCities.forEach(city => {
                dropdown.append(`<div class="dropdown-item">${city}</div>`);
            });
        }
    });
    // Click event for selecting a city
    $(document).on("click", ".dropdown-item", function () {
        $("#locationInput").val($(this).text());
        $("#locationDropdown").hide();
    });

    // Hide dropdown if clicked outside
    $(document).click(function (e) {
        if (!$(e.target).closest(".search-item").length) {
            $("#locationDropdown").hide();
        }
    });
});

</script>
@endpush
