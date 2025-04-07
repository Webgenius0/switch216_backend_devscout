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
            background: #233cca;
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
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-md-12">
                <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                    <h1 class="display-4">View All Pakages</h1>
                    <p class="lead">Quickly build an effective pricing table for your potential customers with this
                        Bootstrap example. It’s built with default Bootstrap components and utilities with little
                        customization.</p>
                </div>
            </div>
        </div> --}}
        <!-- Card 1 -->
        <div class="row mt-4 flex flex-wrap">

            @foreach ($pakesges as $package)
                <div class="col-xl-3 col-xxl-3 col-md-6 col-sm-6 col-12 mt-2 mb-5 flex">

                    <div class="pricing-card shadow-lg p-4 rounded-lg text-center bg-white flex flex-col h-full w-full">
                        <h5 class="font-bold text-xl text-gray-900 flex items-center justify-center gap-2">
                            📁 {{ $package->title }}
                        </h5>


                        <div class="mt-4 mb-3">
                            <p class="text-lg font-semibold text-gray-700">
                                {{ $package->days }} <span class="text-gray-500">/day</span>
                            </p>
                            <p class="text-2xl font-bold text-gray-900">${{ $package->price }}</p>
                        </div>

                        <a href="{{ route('contractor.subscription.create_payment_intent',$package->id) }}" type="button"
                            class="btn-custom w-100 {{ $package->price == 0 ? 'btn-outline-primary' : 'btn-primary' }}">
                            {{ $package->button_text ?? ($package->price == 0 ? 'Sign up for free' : 'Get started') }}
                        </a>
                        {{-- <button type="button" id="getSubscription" onclick="getSubscription({{ $package->id }})"
                            class="btn-custom w-100 {{ $package->price == 0 ? 'btn-outline-primary' : 'btn-primary' }}">
                            {{ $package->button_text ?? ($package->price == 0 ? 'Sign up for free' : 'Get started') }}
                        </button> --}}
                        <div class="text-dark text-left mt-3 leading-relaxed">
                            <p>{!! $package->description !!}</p>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>





    </div>
@endsection

@push('scripts')
    <script>
        // $('#getSubscription').click(function() {
        //     console.log('ok');
        // })

        function getSubscription(packageId) {
            console.log(packageId);
            if (event) {
                event.preventDefault();
            }

            Swal.fire({
                title: 'Confirm Subscription',
                text: 'Do you want to proceed with the subscription?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('contractor.subscription.make_subscribe', ':id') }}'.replace(':id',
                            packageId),
                        type: 'POST',
                        data: {
                            package_id: packageId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                window.location.href = response.url;
                            } else {
                                alert(response.message);
                            }
                        },
                        error: function(xhr) {
                            flasher.error("Something went wrong!");
                        }
                    });
                }
            });

        }
    </script>
@endpush
