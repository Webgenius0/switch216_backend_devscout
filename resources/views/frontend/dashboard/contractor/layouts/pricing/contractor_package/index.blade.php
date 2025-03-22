@extends('frontend.dashboard.contractor.app')

@section('title')
    Dashboard Contrator
@endsection
@section('header')
    @include('frontend.dashboard.contractor.partials.header')
@endsection
@push('styles')
    <style>
        .pricing-card {
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .discount-badge {
            position: absolute;
            top: -10px;
            left: 10px;
            background: red;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
        }

        .price {
            font-size: 24px;
            font-weight: bold;
        }

        .old-price {
            text-decoration: line-through;
            color: gray;
            font-size: 16px;
        }

        .btn-custom {
            background: #f44336;
            color: white;
            font-weight: bold;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn-custom:hover {
            background: #d32f2f;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                    {{-- <h1 class="display-4">Pricing</h1>
                    <p class="lead">Quickly build an effective pricing table for your potential customers with this
                        Bootstrap example. It’s built with default Bootstrap components and utilities with little
                        customization.</p> --}}
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Free</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title
                        pricing-card-title">$0 <small class="text-muted">/
                                mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>10 users included</li>
                            <li>2 GB of storage</li>
                            <li>Email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-outline-primary">Sign up for free</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Pro</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title

                        pricing-card-title">$15 <small class="text-muted">/
                                mo</small></h1>

                        <ul class="list-unstyled mt-3 mb-4">
                            <li>20 users included</li>
                            <li>10 GB of storage</li>
                            <li>Priority email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Get started</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Enterprise</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title
                        pricing-card-title">$29 <small class="text-muted">/
                                mo</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>30 users included</li>
                            <li>15 GB of storage</li>
                            <li>Phone and email support</li>
                            <li>Help center access</li>
                        </ul>
                        <button type="button" class="btn btn-lg btn-block btn-primary">Contact us</button>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row">
            @foreach ($pricing as $package)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">{{ $package->title }}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">
                                ${{ $package->price }} <small class="text-muted" style="font-size: 0.4em;">{{ $package->days }} Days</small>
                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>{{ $package->days }} Days</li>
                            </ul>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>{{ $package->description }}</li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-block {{ $package->price == 0 ? 'btn-outline-primary' : 'btn-primary' }}">
                                {{ $package->button_text ?? ($package->price == 0 ? 'Sign up for free' : 'Get started') }}
                            </button>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div> --}}

        <!-- Card 1 -->
        <div class="row">

                @foreach ($pricing as $package)
                <div class="col-md-4 mb-5">
                    <div class="pricing-card">
                        <h5>📁 {{ $package->title }}</h5>
                        <p class="text-muted">{{ $package->description }}</p>
                        <p class="price">{{ $package->days }} <span class="text-muted">/day</span></p>
                        <p class="">${{ $package->price }}</p>
                        <button type="button"
                            class="btn-custom w-100 {{ $package->price == 0 ? 'btn-outline-primary' : 'btn-primary' }}">
                            {{ $package->button_text ?? ($package->price == 0 ? 'Sign up for free' : 'Get started') }}
                        </button>
                    </div>
               
    
            </div>
            @endforeach

        </div>
            




    </div>
@endsection

@push('scripts')
@endpush
