@extends('frontend.dashboard.customer.app')

@section('title')
    Dashboard Customer
@endsection
@section('header')
    @include('frontend.dashboard.customer.partials.header')
@endsection
@push('styles')
@endpush

@section('content')
    <!-- dashboard content start -->
    <div class="dashboard-main-content ">
        <!-- dashboard-banner-content start -->
        <div class="dashboard-banner-content">
            <div class="title">
                Hello, <span>John Doe</span> ! Let's get started on your multi services
            </div>
            <div class="text mt-3">
                Start now to connect with multi-service professionals, book appointments, and manage your
                documents—all in
                one place for a smooth preparation experience.
            </div>
        </div>
        <!-- dashboard-banner-content end -->

        <!-- dashboard appointments start -->
        {{-- <div class="section-title mt-5">Upcoming Appointments</div>
        <div class="dashboard-appointments mt-5">
            <div class="item">
                <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                    <div class="profile d-flex gap-2 flex-wrap">
                        <div class="profile-img">
                            <img src="./assets/images/user.png" alt="">
                        </div>
                        <div class="profile-info">
                            <div class="profile-title">
                                Danial David
                            </div>
                            <div class="profile-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                                    fill="none">
                                    <path
                                        d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                    <path
                                        d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                </svg>
                                <span>
                                    Spain
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        17 Aug, 2024
                    </div>
                </div>
                <div class="text mt-3">
                    Professional DJ with 10 years of experience in weddings and corporate events.
                </div>
                <a class="action mt-5" href="">
                    Reschedule
                </a>
            </div>
            <div class="item">
                <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                    <div class="profile d-flex gap-2 flex-wrap">
                        <div class="profile-img">
                            <img src="./assets/images/user.png" alt="">
                        </div>
                        <div class="profile-info">
                            <div class="profile-title">
                                Danial David
                            </div>
                            <div class="profile-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                                    fill="none">
                                    <path
                                        d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                    <path
                                        d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                </svg>
                                <span>
                                    Spain
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        17 Aug, 2024
                    </div>
                </div>
                <div class="text mt-3">
                    Professional DJ with 10 years of experience in weddings and corporate events.
                </div>
                <a class="action mt-5" href="">
                    Reschedule
                </a>
            </div>
            <div class="item">
                <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                    <div class="profile d-flex gap-2 flex-wrap">
                        <div class="profile-img">
                            <img src="./assets/images/user.png" alt="">
                        </div>
                        <div class="profile-info">
                            <div class="profile-title">
                                Danial David
                            </div>
                            <div class="profile-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17"
                                    fill="none">
                                    <path
                                        d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                    <path
                                        d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                </svg>
                                <span>
                                    Spain
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        17 Aug, 2024
                    </div>
                </div>
                <div class="text mt-3">
                    Professional DJ with 10 years of experience in weddings and corporate events.
                </div>
                <a class="action mt-5" href="">
                    Reschedule
                </a>
            </div>
            <div class="item">
                <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                    <div class="profile d-flex gap-2 flex-wrap">
                        <div class="profile-img">
                            <img src="./assets/images/user.png" alt="">
                        </div>
                        <div class="profile-info">
                            <div class="profile-title">
                                Danial David
                            </div>
                            <div class="profile-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                    viewBox="0 0 16 17" fill="none">
                                    <path
                                        d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                    <path
                                        d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                </svg>
                                <span>
                                    Spain
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        17 Aug, 2024
                    </div>
                </div>
                <div class="text mt-3">
                    Professional DJ with 10 years of experience in weddings and corporate events.
                </div>
                <a class="action mt-5" href="">
                    Reschedule
                </a>
            </div>
            <div class="item">
                <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                    <div class="profile d-flex gap-2 flex-wrap">
                        <div class="profile-img">
                            <img src="./assets/images/user.png" alt="">
                        </div>
                        <div class="profile-info">
                            <div class="profile-title">
                                Danial David
                            </div>
                            <div class="profile-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                    viewBox="0 0 16 17" fill="none">
                                    <path
                                        d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                    <path
                                        d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                </svg>
                                <span>
                                    Spain
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        17 Aug, 2024
                    </div>
                </div>
                <div class="text mt-3">
                    Professional DJ with 10 years of experience in weddings and corporate events.
                </div>
                <a class="action mt-5" href="">
                    Reschedule
                </a>
            </div>
            <div class="item">
                <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                    <div class="profile d-flex gap-2 flex-wrap">
                        <div class="profile-img">
                            <img src="./assets/images/user.png" alt="">
                        </div>
                        <div class="profile-info">
                            <div class="profile-title">
                                Danial David
                            </div>
                            <div class="profile-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                    viewBox="0 0 16 17" fill="none">
                                    <path
                                        d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                    <path
                                        d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                </svg>
                                <span>
                                    Spain
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        17 Aug, 2024
                    </div>
                </div>
                <div class="text mt-3">
                    Professional DJ with 10 years of experience in weddings and corporate events.
                </div>
                <a class="action mt-5" href="">
                    Reschedule
                </a>
            </div>
            <div class="item">
                <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                    <div class="profile d-flex gap-2 flex-wrap">
                        <div class="profile-img">
                            <img src="./assets/images/user.png" alt="">
                        </div>
                        <div class="profile-info">
                            <div class="profile-title">
                                Danial David
                            </div>
                            <div class="profile-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                    viewBox="0 0 16 17" fill="none">
                                    <path
                                        d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                    <path
                                        d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                </svg>
                                <span>
                                    Spain
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        17 Aug, 2024
                    </div>
                </div>
                <div class="text mt-3">
                    Professional DJ with 10 years of experience in weddings and corporate events.
                </div>
                <a class="action mt-5" href="">
                    Reschedule
                </a>
            </div>
            <div class="item">
                <div class="top d-flex align-items-center justify-content-between gap-3 flex-wrap ">
                    <div class="profile d-flex gap-2 flex-wrap">
                        <div class="profile-img">
                            <img src="./assets/images/user.png" alt="">
                        </div>
                        <div class="profile-info">
                            <div class="profile-title">
                                Danial David
                            </div>
                            <div class="profile-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17"
                                    viewBox="0 0 16 17" fill="none">
                                    <path
                                        d="M7.99992 9.45334C9.14867 9.45334 10.0799 8.52209 10.0799 7.37334C10.0799 6.22458 9.14867 5.29333 7.99992 5.29333C6.85117 5.29333 5.91992 6.22458 5.91992 7.37334C5.91992 8.52209 6.85117 9.45334 7.99992 9.45334Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                    <path
                                        d="M2.4133 6.16004C3.72664 0.386709 12.28 0.393376 13.5866 6.16671C14.3533 9.55338 12.2466 12.42 10.4 14.1934C9.05997 15.4867 6.93997 15.4867 5.5933 14.1934C3.7533 12.42 1.64664 9.54671 2.4133 6.16004Z"
                                        stroke="#BDBDBD" stroke-width="1.5" />
                                </svg>
                                <span>
                                    Spain
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="date">
                        17 Aug, 2024
                    </div>
                </div>
                <div class="text mt-3">
                    Professional DJ with 10 years of experience in weddings and corporate events.
                </div>
                <a class="action mt-5" href="">
                    Reschedule
                </a>
            </div>
        </div> --}}
        <!-- dashboard appointments end -->

    </div>
    <!-- dashboard content end -->
@endsection


@push('scripts')
@endpush
