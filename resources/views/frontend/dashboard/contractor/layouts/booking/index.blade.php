@extends('frontend.dashboard.contractor.app')

@section('title')
    Dashboard Contrator
@endsection
@section('header')
    @include('frontend.dashboard.contractor.partials.header')
@endsection
@push('styles')
@endpush

@section('content')
    <!-- dashboard content start -->
    <div class="dashboard-main-content ">

        <!-- dashboard Booking start -->
        <div class="section-title mt-5">Upcoming Booking</div>
        <div class="dashboard-appointments mt-5">
            @forelse ($bookings as $booking)
                <div class="item">
                    <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                        <div class="profile d-flex gap-2 flex-wrap">
                            <div class="profile-img">
                                <img src="{{ asset($booking->service->user->avatar ?? 'backend/assets/images/user.png') }}"
                                    alt="">
                            </div>
                            <div class="profile-info">
                                <div class="profile-title">
                                    Danial David
                                </div><span>
                                    Status : {{ $booking->status }}
                                </span>
                                <div class="profile-text d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                        viewBox="0 0 16 17" fill="none">
                                        <path
                                            d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                            stroke="#BDBDBD" stroke-width="1.5" />
                                        <path
                                            d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                            stroke="#BDBDBD" stroke-width="1.5" />
                                    </svg>
                                    <span class="ms-2">
                                        Location: {{ $booking->service->user->userAddresses()->first()->location ?? ' ' }}
                                    </span>
                                </div>

                            </div>
                        </div>
                        <div class="date"> Date:
                            {{ $booking->booking_date ? \Carbon\Carbon::parse($booking->booking_date)->format('d M, Y') : ' ' }}
                        </div>
                    </div>
                    <div class="text mt-3">
                        Description: {{ $booking->service->description ?? ' ' }}
                    </div>
                    @if (!in_array($booking->status, ['completed', 'cancelled', 'confirmed','request_completed']))
                        <a href="{{ route('contractor.booking.confirm', $booking->id) }}"
                            class="action mt-5 cancelled-booking-btn" type="button">
                            Confirm Booking
                        </a>
                    @endif
                    @if ( in_array($booking->status, ['pending', 'confirmed', 'pending_reschedule']))
                        <a href="{{ route('contractor.booking.cancle', $booking->id) }}"
                            class="action mt-5 cancelled-booking-btn" type="button">
                            Cancle Booking
                        </a>
                    @endif
                    @if (in_array($booking->status, ['confirmed']) && !$booking->booking_date->isFuture())
                        <a href="{{ route('contractor.booking.mark_as_complete', $booking->id) }}"
                            class="action mt-5 complete-booking-btn" type="button">
                            Mark As Complete
                        </a>
                    @endif

                </div>
            @empty
            @endforelse


        </div>
        <!-- dashboard appointments end -->

    </div>
    <!-- dashboard content end -->
@endsection


@push('scripts')
@endpush