@extends('frontend.app')

@section('title')
    Contact Page
@endsection
@section('header')
    {{-- @include('frontend.partials.header') --}}
    @include('frontend.partials.header2')
@endsection
@push('styles')
    <style>
        .all-services {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            margin-top: 30px;
            gap: 40px;
            margin-bottom: 100px;
        }

        .all-services .item {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            border-radius: 8px;
            padding: 40px 20px;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <!-- main content section start -->
    <main class="container my-md-5 my-2">
        <h2>All Services</h2>
        <div class="all-services">
            <div class="item">
                Foods
            </div>
            <div class="item">
                Real State
            </div>
            <div class="item">
                Car Rent
            </div>
            <div class="item">
                Category 4
            </div>
            <div class="item">
                Category 5
            </div>
            <div class="item">
                Category 6
            </div>
            <div class="item">
                Category 7
            </div>
            <div class="item">
                Category 8
            </div>
            <div class="item">
                Category 9
            </div>
            <div class="item">
                Category 10
            </div>
            <div class="item">
                Category 11
            </div>
            <div class="item">
                Category 12
            </div>
            <div class="item">
                Category 8
            </div>
            <div class="item">
                Category 9
            </div>
            <div class="item">
                Category 10
            </div>
            <div class="item">
                Category 11
            </div>
            <div class="item">
                Category 12
            </div>
            <div class="item">
                Category 8
            </div>
            <div class="item">
                Category 9
            </div>
            <div class="item">
                Category 10
            </div>
            <div class="item">
                Category 11
            </div>
            <div class="item">
                Category 12
            </div>
        </div>
    </main>
    <!-- main content section end -->
@endsection



@push('scripts')
@endpush
