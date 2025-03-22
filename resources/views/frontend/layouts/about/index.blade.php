@extends('frontend.app')

@section('title')
    About Page
@endsection
@section('header')
    {{-- @include('frontend.partials.header') --}}
    @include('frontend.partials.header2')
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/aos-2.3.1.min.css') }}" />
@endpush

@section('content')
    <!-- main section start -->
    <main class="container">
        <section class="row about-section">
            <div class="col-md-6 col-lg-7" data-aos="fade-right">
                <h1 class="section-title">{{ $data['aboutPageContainer']->title ?? 'WE HAVE 25 YEARS EXPERIENCE' }}</h1>

                <p class="des">
                    {{ $data['aboutPageContainer']->description ??
                        'Welcome to kolchie, your trusted partner for all-in-one solutions.
                                        We provide a wide range of services tailored to meet the needs of
                                        both individuals and businesses, offering expertise, convenience,
                                        and top-notch customer care in every interaction. With 2 year years
                                        of experience, we are committed to delivering exceptional results
                                        across various sectors. Whether you’re looking for [list key
                                        services, e.g., home improvement, IT solutions, financial
                                        consulting], or anything in between, our team of dedicated
                                        professionals is here to help. At kolchie, we believe in simplifying
                                        your life with services that you can rely on. We take pride in our
                                        ability to cater to diverse needs while ensuring the highest quality
                                        standards. Our goal is to build long-term relationships with our
                                        clients by providing efficient, transparent, and personalized
                                        solutions.' }}
                </p>
            </div>
            <div class="col-md-6 col-lg-5" data-aos="fade-left">
                <figure class="about-img">
                    {{-- <img src="{{ asset('frontend') }}/assets/images/about.png" alt="about page image" /> --}}
                    <img src="{{ isset($data['aboutPageContainer']->image) ? asset($data['aboutPageContainer']->image) : asset('frontend/assets/images/about.png') }}"
                        alt="About Image">

                </figure>
            </div>
        </section>

        <section class="about-card" data-aos="fade-up">
            @if(!empty($data['aboutServiceContainer']) && count($data['aboutServiceContainer']) > 0)
                @foreach($data['aboutServiceContainer'] as $service)
                    <div class="about-card-item">
                        <h5 class="card-title">{{ $service->title }}</h5>
                        <p class="card-des">{{ $service->description }}</p>
                    </div>
                @endforeach
            @else
                <div class="about-card-item">
                    <h5 class="card-title">Best Service</h5>
                    <p class="card-des">
                        At Best Service Multiservices, we provide a wide range of
                        professional solutions, from home services to business support,
                        ensuring quality, efficiency, and customer satisfaction.
                    </p>
                </div>
                <div class="about-card-item">
                    <h5 class="card-title">24/7 Support</h5>
                    <p class="card-des">
                        At Best Service Multiservices, we’re available 24/7 to provide you
                        with reliable, round-the-clock solutions. No matter the time, we’re
                        here to meet your needs with prompt and professional service.
                    </p>
                </div>
                <div class="about-card-item">
                    <h5 class="card-title">Support Us</h5>
                    <p class="card-des">
                        Our journey at Best Service Multiservices has been built on trust,
                        quality, and customer satisfaction, transforming challenges into
                        success stories.
                    </p>
                </div>
            @endif
        </section>
        
        
        </section>

    </main>
    <!-- main section end -->
@endsection



@push('scripts')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/aos-2.3.1.min.js') }}"></script>
@endpush
