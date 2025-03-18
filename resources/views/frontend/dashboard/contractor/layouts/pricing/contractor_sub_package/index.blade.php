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

<div class="bg-light">
    <div class="container py-5">
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="pricing-card">
                    <span class="discount-badge">67% off</span>
                    <h5>📁 Stellar</h5>
                    <p class="text-muted">Shared Hosting</p>
                    <p class="price">$1.48 <span class="text-muted">/mo</span></p>
                    <p class="old-price">$4.48</p>
                    <p class="text-danger">On first year</p>
                    <a href="#" class="btn btn-custom w-100">Get Started</a>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="pricing-card">
                    <span class="discount-badge">47% off</span>
                    <h5>📁 Stellar Business</h5>
                    <p class="text-muted">Shared Hosting</p>
                    <p class="price">$4.98 <span class="text-muted">/mo</span></p>
                    <p class="old-price">$9.48</p>
                    <p class="text-danger">On first year</p>
                    <a href="#" class="btn btn-custom w-100">Get Started</a>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="pricing-card">
                    <span class="discount-badge">100% off</span>
                    <h5>⚓ EasyWP Starter</h5>
                    <p class="text-muted">WordPress Hosting</p>
                    <p class="price">$0 <span class="text-muted">/mo</span></p>
                    <p class="old-price">$6.88</p>
                    <p class="text-danger">On first month</p>
                    <a href="#" class="btn btn-custom w-100">Try for Free</a>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection

@push('scripts')
@endpush
