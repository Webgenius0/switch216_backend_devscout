@extends('frontend.app')

@section('title')
    Contact Page
@endsection
@section('header')
    {{-- @include('frontend.partials.header') --}}
    @include('frontend.partials.header2')
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
        #map {
            width: 100%;
            height: 40vh;
            border-radius: 10px;
        }

        .leaflet-top.leaflet-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 8px;
        }

        .map-button {
            background: white;
            border: 2px solid #ccc;
            border-radius: 5px;
            padding: 8px;
            cursor: pointer;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            font-size: 14px;
        }

        .map-button:hover {
            background: #f0f0f0;
        }

        .navbar {
            z-index: 9999 !important;
        }

        .see-all-img-btn {
            background-color: #003366;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            cursor: pointer;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/plugins/aos-2.3.1.min.css') }}" />
@endpush

@section('content')
    <!-- main content section start -->
    <main class="container my-md-5 my-2">
        <div class="row">
            <div class="col-md-7 col-lg-8">
                <!-- profile section start -->
                <div class="profile-header-section">
                    <div class="profile-section">
                        <figure class="profile-img">
                            <img src="{{ asset($service->user->avatar ?? 'frontend/assets/images/avatar_defult.png') }}"
                                alt="Service provider profile" />
                        </figure>
                    </div>
                    <div class="profile-details col-md-2">
                        <h3 class="profile-name">{{ $service->user->name ?? '' }}</h3>
                        <div class="profile-location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="22" viewBox="0 0 16 22"
                                fill="none">
                                <path
                                    d="M10.5 8C10.5 9.38071 9.38071 10.5 8 10.5C6.61929 10.5 5.5 9.38071 5.5 8C5.5 6.61929 6.61929 5.5 8 5.5C9.38071 5.5 10.5 6.61929 10.5 8Z"
                                    stroke="#757575" stroke-width="1.5" />
                                <path
                                    d="M9.2574 16.4936C8.92012 16.8184 8.46932 17 8.00015 17C7.53099 17 7.08018 16.8184 6.7429 16.4936C3.6543 13.5008 -0.48481 10.1575 1.53371 5.30373C2.6251 2.67932 5.24494 1 8.00015 1C10.7554 1 13.3752 2.67933 14.4666 5.30373C16.4826 10.1514 12.3536 13.5111 9.2574 16.4936Z"
                                    stroke="#757575" stroke-width="1.5" />
                                <path d="M14 19C14 20.1046 11.3137 21 8 21C4.68629 21 2 20.1046 2 19" stroke="#757575"
                                    stroke-width="1.5" stroke-linecap="round" />
                            </svg>
                            <span>{{ $service->user->userAddresses()->first()->location ?? ' ' }}</span>
                        </div>
                        <div class="profile-tags">
                            {{ $categoryNames->first() }}
                            {{-- @forelse ($categoryNames as $item)
                                <span>{{ $item }},</span>
                            @empty
                                <span>No Category</span>
                            @endforelse --}}
                        </div>
                    </div>
                    <div class="profile-end ">
                        
                        <div class="profile-reviews" style="display: flex; align-items: center; gap: 10px;">
                            {{-- Star Rating --}}
                            @for ($i = 0; $i < floor($ContactorProfileCounter['last_60_days_average_rating']??0); $i++)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="17" viewBox="0 0 16 17" fill="none">
                                    <path
                                        d="M7.2795 2.41205C7.35287 2.28615 7.45796 2.1817 7.58429 2.1091C7.71063 2.0365 7.85379 1.99829 7.9995 1.99829C8.14521 1.99829 8.28838 2.0365 8.41471 2.1091C8.54105 2.1817 8.64614 2.28615 8.7195 2.41205L10.5828 5.61071L14.2015 6.39471C14.3438 6.42565 14.4756 6.49335 14.5836 6.59107C14.6916 6.68879 14.7721 6.81312 14.8171 6.95166C14.8621 7.09021 14.87 7.23812 14.84 7.38066C14.81 7.5232 14.7432 7.65539 14.6462 7.76405L12.1795 10.5247L12.5528 14.208C12.5676 14.3531 12.544 14.4994 12.4845 14.6325C12.4249 14.7656 12.3315 14.8807 12.2136 14.9664C12.0956 15.0521 11.9573 15.1054 11.8123 15.1209C11.6674 15.1363 11.5209 15.1135 11.3875 15.0547L7.9995 13.5614L4.6115 15.0547C4.47811 15.1135 4.33163 15.1363 4.18667 15.1209C4.04171 15.1054 3.90336 15.0521 3.78542 14.9664C3.66748 14.8807 3.57408 14.7656 3.51455 14.6325C3.45502 14.4994 3.43144 14.3531 3.44617 14.208L3.8195 10.5247L1.35284 7.76471C1.25565 7.65606 1.18867 7.52382 1.15858 7.38119C1.12848 7.23856 1.13633 7.09053 1.18133 6.95188C1.22633 6.81323 1.30692 6.68882 1.41504 6.59105C1.52316 6.49328 1.65504 6.42558 1.7975 6.39471L5.41617 5.61071L7.2795 2.41205Z"
                                        fill="#FFC700" />
                                </svg>
                            @endfor
                        
                            {{-- Ranking Tag and Review Count --}}
                            <span>
                                Level: {{ $ContactorProfileCounter['rank'] ?? "Silver" }}
                                (Total Reviews: {{ $ContactorProfileCounter['review_count'] ?? 0 }})
                            </span>
                        </div>
                        @if ($service->user->instagram_social_link)
                            <a href="{{ $service->user->instagram_social_link ?? '' }}" target="_blank"
                                class="action-button">
                                <span class="media-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32"
                                        viewBox="0 0 33 32" fill="none">
                                        <path
                                            d="M25 0H8C3.85786 0 0.5 3.35786 0.5 7.5V24.5C0.5 28.6421 3.85786 32 8 32H25C29.1421 32 32.5 28.6421 32.5 24.5V7.5C32.5 3.35786 29.1421 0 25 0Z"
                                            fill="url(#paint0_radial_4669_326)" />
                                        <path
                                            d="M25 0H8C3.85786 0 0.5 3.35786 0.5 7.5V24.5C0.5 28.6421 3.85786 32 8 32H25C29.1421 32 32.5 28.6421 32.5 24.5V7.5C32.5 3.35786 29.1421 0 25 0Z"
                                            fill="url(#paint1_radial_4669_326)" />
                                        <path
                                            d="M16.5011 3.5C13.1064 3.5 12.6803 3.51488 11.347 3.5755C10.0163 3.6365 9.10787 3.84712 8.31313 4.15625C7.49088 4.4755 6.7935 4.90262 6.09875 5.59762C5.40338 6.2925 4.97625 6.98987 4.656 7.81175C4.346 8.60675 4.13512 9.5155 4.07525 10.8456C4.01562 12.179 4 12.6053 4 16.0001C4 19.395 4.015 19.8197 4.0755 21.153C4.13675 22.4837 4.34738 23.3921 4.65625 24.1869C4.97575 25.0091 5.40288 25.7065 6.09788 26.4013C6.7925 27.0966 7.48988 27.5247 8.3115 27.844C9.10687 28.1531 10.0154 28.3637 11.3459 28.4247C12.6792 28.4854 13.105 28.5002 16.4996 28.5002C19.8948 28.5002 20.3195 28.4854 21.6528 28.4247C22.9835 28.3637 23.8929 28.1531 24.6882 27.844C25.5101 27.5247 26.2065 27.0966 26.901 26.4013C27.5964 25.7065 28.0234 25.0091 28.3438 24.1873C28.651 23.3921 28.862 22.4835 28.9245 21.1532C28.9844 19.82 29 19.395 29 16.0001C29 12.6053 28.9844 12.1792 28.9245 10.8459C28.862 9.51512 28.651 8.60688 28.3438 7.81213C28.0234 6.98988 27.5964 6.2925 26.901 5.59762C26.2057 4.90237 25.5104 4.47525 24.6875 4.15637C23.8906 3.84712 22.9817 3.63638 21.651 3.5755C20.3176 3.51488 19.8931 3.5 16.4972 3.5H16.5011ZM15.3798 5.75262C15.7126 5.75213 16.084 5.75262 16.5011 5.75262C19.8388 5.75262 20.2342 5.76463 21.5522 5.8245C22.771 5.88025 23.4325 6.08388 23.8731 6.255C24.4565 6.4815 24.8724 6.75238 25.3096 7.19C25.7471 7.6275 26.0179 8.04412 26.245 8.6275C26.4161 9.0675 26.62 9.729 26.6755 10.9478C26.7354 12.2655 26.7484 12.6612 26.7484 15.9972C26.7484 19.3333 26.7354 19.7291 26.6755 21.0467C26.6198 22.2655 26.4161 22.927 26.245 23.3671C26.0185 23.9505 25.7471 24.3659 25.3096 24.8031C24.8721 25.2406 24.4568 25.5114 23.8731 25.738C23.433 25.9099 22.771 26.113 21.5522 26.1688C20.2345 26.2286 19.8388 26.2416 16.5011 26.2416C13.1634 26.2416 12.7677 26.2286 11.4501 26.1688C10.2314 26.1125 9.56987 25.9089 9.12887 25.7377C8.54562 25.5111 8.12887 25.2404 7.69137 24.8029C7.25387 24.3654 6.98312 23.9498 6.756 23.3661C6.58488 22.926 6.381 22.2645 6.3255 21.0457C6.26562 19.728 6.25362 19.3323 6.25362 15.9941C6.25362 12.656 6.26562 12.2624 6.3255 10.9446C6.38125 9.72587 6.58488 9.06437 6.756 8.62375C6.98263 8.04037 7.25388 7.62375 7.6915 7.18625C8.12913 6.74875 8.54562 6.47787 9.129 6.25087C9.56962 6.079 10.2314 5.87587 11.4501 5.81987C12.6032 5.76775 13.0501 5.75212 15.3798 5.7495V5.75262ZM23.1736 7.82812C22.3455 7.82812 21.6736 8.49938 21.6736 9.32763C21.6736 10.1558 22.3455 10.8276 23.1736 10.8276C24.0018 10.8276 24.6736 10.1558 24.6736 9.32763C24.6736 8.4995 24.0018 7.82762 23.1736 7.82762V7.82812ZM16.5011 9.58075C12.9561 9.58075 10.0819 12.455 10.0819 16.0001C10.0819 19.5452 12.9561 22.4181 16.5011 22.4181C20.0462 22.4181 22.9195 19.5452 22.9195 16.0001C22.9195 12.4551 20.046 9.58075 16.5009 9.58075H16.5011ZM16.5011 11.8334C18.8022 11.8334 20.6679 13.6988 20.6679 16.0001C20.6679 18.3013 18.8022 20.1669 16.5011 20.1669C14.2 20.1669 12.3345 18.3013 12.3345 16.0001C12.3345 13.6988 14.1999 11.8334 16.5011 11.8334Z"
                                            fill="white" />
                                        <defs>
                                            <radialGradient id="paint0_radial_4669_326" cx="0" cy="0" r="1"
                                                gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(9 34.4646) rotate(-90) scale(31.7144 29.4969)">
                                                <stop stop-color="#FFDD55" />
                                                <stop offset="0.1" stop-color="#FFDD55" />
                                                <stop offset="0.5" stop-color="#FF543E" />
                                                <stop offset="1" stop-color="#C837AB" />
                                            </radialGradient>
                                            <radialGradient id="paint1_radial_4669_326" cx="0" cy="0" r="1"
                                                gradientUnits="userSpaceOnUse"
                                                gradientTransform="translate(-4.86012 2.30512) rotate(78.681) scale(14.1765 58.436)">
                                                <stop stop-color="#3771C8" />
                                                <stop offset="0.128" stop-color="#3771C8" />
                                                <stop offset="1" stop-color="#6600FF" stop-opacity="0" />
                                            </radialGradient>
                                        </defs>
                                    </svg>
                                </span>
                                <span class="action-text">See our project in action</span>
                            </a>
                        @endif

                    </div>
                </div>
                <!-- profile section end -->

                <!-- about section start -->
                <article class="about-section">
                    <h2 class="profile-section-title">Description</h2>
                    <p class="des">
                        {{ $service->description ?? '' }}
                    </p>
                </article>
                <!-- about section end -->
                <hr class="separator" />
                <!-- gallery modal start -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Image Gallery</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img src="" id="modal-image" class="modal-img w-100" />
                                <div class="d-flex align-items-center justify-content-center gap-4 mt-4">
                                    <button class="btn btn-secondary" id="prev-btn">←</button>
                                    <button class="btn btn-secondary" id="next-btn">→</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- gallery modal end -->
                <!-- gallery section start -->
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="profile-section-title">Best Services in gallery</h2>
                    <div class="see-all-img-btn">See All</div>
                </div>
                <div class="gallery-section">
                    @php
                        $galleryImages = is_array($service->gallery_images)
                            ? $service->gallery_images
                            : json_decode($service->gallery_images, true);
                    @endphp

                    @foreach ($galleryImages as $key => $gallery_image)
                        <div class="gallery-image">
                            <figure>
                                <img src="{{ asset($gallery_image) }}" alt="gallery image" />
                            </figure>
                        </div>
                    @endforeach
                </div>
                <!-- gallery section end -->

                <hr class="separator" />

                <!-- service section start -->
                <h2 class="profile-section-title">Services Offered by</h2>
                <div class="service-wrapper">
                    @forelse ($ServiceTitleWithDescription as $item)
                        <div class="service-item">
                            <h5 class="service-title">{{ $item->title }}</h5>
                            <p class="service-des">
                                {{ $item->description }}
                            </p>
                        </div>

                    @empty
                    @endforelse


                </div>
                <!-- service section end -->

                <hr class="separator" />

                <!-- comment section start -->
                <h2 class="profile-section-title">Customer Reviews Section</h2>
                <div class="comment-wrapper">
                    @forelse ($ContactorReviews as $item)
                        <div class="comment-item">
                            <div class="comment-header">
                                <figure class="comment-user-img">
                                    <img
                                        src="{{ asset($item->user->avatar ?? 'frontend/assets/images/comment-user.jpg') }}" />
                                </figure>
                                <div class="comment-user-details">
                                    <h6 class="comment-user-name">{{ $item->user->name ?? '' }}</h6>
                                    <div class="comment-ratings">
                                        @for ($i = 0; $i < $item->rating; $i++)
                                            <svg class="full-rating" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" viewBox="0 0 16 16" fill="none">
                                                <path
                                                    d="M7.2795 1.9118C7.35287 1.78591 7.45796 1.68145 7.58429 1.60885C7.71063 1.53625 7.85379 1.49805 7.9995 1.49805C8.14521 1.49805 8.28838 1.53625 8.41471 1.60885C8.54105 1.68145 8.64614 1.78591 8.7195 1.9118L10.5828 5.11047L14.2015 5.89447C14.3438 5.9254 14.4756 5.9931 14.5836 6.09083C14.6916 6.18855 14.7721 6.31288 14.8171 6.45142C14.8621 6.58996 14.87 6.73788 14.84 6.88042C14.81 7.02296 14.7432 7.15515 14.6462 7.2638L12.1795 10.0245L12.5528 13.7078C12.5676 13.8528 12.544 13.9992 12.4845 14.1323C12.4249 14.2654 12.3315 14.3805 12.2136 14.4662C12.0956 14.5519 11.9573 14.6051 11.8123 14.6206C11.6674 14.6361 11.5209 14.6133 11.3875 14.5545L7.9995 13.0611L4.6115 14.5545C4.47811 14.6133 4.33163 14.6361 4.18667 14.6206C4.04171 14.6051 3.90336 14.5519 3.78542 14.4662C3.66748 14.3805 3.57408 14.2654 3.51455 14.1323C3.45502 13.9992 3.43144 13.8528 3.44617 13.7078L3.8195 10.0245L1.35284 7.26447C1.25565 7.15582 1.18867 7.02358 1.15858 6.88095C1.12848 6.73832 1.13633 6.59029 1.18133 6.45164C1.22633 6.31299 1.30692 6.18857 1.41504 6.0908C1.52316 5.99303 1.65504 5.92534 1.7975 5.89447L5.41617 5.11047L7.2795 1.9118Z"
                                                    fill="#FFC700" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <div class="comment-time">{{ $item->created_at->diffForHumans() }}</div>
                            </div>
                            <p class="comment-des">
                                {{ $item->review }}
                            </p>
                        </div>
                    @empty
                        <p>No Review available</p>
                    @endforelse

                </div>
                <!-- comment section ens -->
            </div>
            <div class="col-md-5 mt-md-0 mt-3 col-lg-4">
                <div class="status-wrapper">
                    <div class="status-item">
                        <div class="status count"
                            data-target="{{ $ContactorProfileCounter['complete_booking_count'] ?? 0 }}">
                            {{ $ContactorProfileCounter['complete_booking_count'] ?? 0 }}</div>
                        <div class="status-name">Complete Work</div>
                    </div>
                    <div class="divider"></div>
                    <div class="status-item">
                        <div class="status count"
                            data-target="{{ $ContactorProfileCounter['pending_booking_count'] ?? 0 }}">
                            {{ $ContactorProfileCounter['pending_booking_count'] ?? 0 }}</div>
                        <div class="status-name">Pending Work</div>
                    </div>
                    <div class="divider"></div>
                    <div class="status-item">
                        <div class="status count"
                            data-target="{{ $ContactorProfileCounter['client_review_count'] ?? 0 }}">
                            {{ $ContactorProfileCounter['client_review_count'] ?? 0 }}</div>
                        <div class="status-name">Client Review</div>
                    </div>
                </div>
                <input type="text" hidden id="appointment-date-picker" />
                @guest
                    <button class="button w-100 mt-2 mt-lg-3 d-block" type="button" data-bs-toggle="modal"
                        data-bs-target="#authModal">
                        Book Appointment
                    </button>
                    <a data-bs-toggle="modal" data-bs-target="#authModal" href="#"
                        class="button w-100 mt-2 mt-lg-3 sec">Contact us</a>
                @endguest

                @auth
                    @if (auth()->user()->role === 'customer')
                        <button id="bookAppointmentBtn" class="button w-100 mt-2 mt-lg-3 d-block" type="button">
                            Book Appointment
                        </button>

                        <a href="{{ route('contractor.message.start_chat', $service->id) }}"
                            class="button w-100 mt-2 mt-lg-3 sec">Send Message</a>
                    @endif
                @endauth
                <div id="map"></div>
                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
                <input type="hidden" name="address" id="address">
            </div>
        </div>
    </main>
    <!-- main content section end -->
    <!-- chat section start -->
    {{-- <button id="chat-icon" type="button">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
            <path
                d="M29.3346 13.3332V17.3332C29.3346 22.6665 26.668 25.3332 21.3346 25.3332H20.668C20.2546 25.3332 19.8546 25.5332 19.6013 25.8665L17.6013 28.5332C16.7213 29.7065 15.2813 29.7065 14.4013 28.5332L12.4013 25.8665C12.188 25.5732 11.6946 25.3332 11.3346 25.3332H10.668C5.33464 25.3332 2.66797 23.9998 2.66797 17.3332V10.6665C2.66797 5.33317 5.33464 2.6665 10.668 2.6665H18.668"
                stroke="white" stroke-width="3" stroke-miterlimit="10" stroke-linecap="round"
                stroke-linejoin="round" />
            <path
                d="M26.0013 9.33317C27.8423 9.33317 29.3346 7.84079 29.3346 5.99984C29.3346 4.15889 27.8423 2.6665 26.0013 2.6665C24.1604 2.6665 22.668 4.15889 22.668 5.99984C22.668 7.84079 24.1604 9.33317 26.0013 9.33317Z"
                stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M21.3273 14.6667H21.3393" stroke="white" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M15.9953 14.6667H16.0073" stroke="white" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M10.6593 14.6667H10.6713" stroke="white" stroke-width="3" stroke-linecap="round"
                stroke-linejoin="round" />
        </svg>
    </button> --}}
    <!-- chat section end -->
    <!-- Auth Modal -->
    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="authModalLabel">
                        You have to <span>Sign In</span> to Connect with user
                    </h1>
                    <button class="close-btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                                stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.17188 14.8299L14.8319 9.16992" stroke="#6B6B6B" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14.8319 14.8299L9.17188 9.16992" stroke="#6B6B6B" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    Join our community of professionals and clients today! By signing
                    up, you gain direct access to experienced multi-services,
                    personalized services, and a seamless platform to manage your
                    service needs.
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal">Sign In later</button>
                    <button type="button" class="button" onclick="window.location.href='{{ route('login') }}'">Sign In
                        Now</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button class="close-btn" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                            stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M9.17188 14.8299L14.8319 9.16992" stroke="#6B6B6B" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14.8319 14.8299L9.17188 9.16992" stroke="#6B6B6B" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <figure class="success-icon-img">
                    <img src="{{ asset('frontend/assets/images/success-icon.png') }}" alt="success icon" />
                </figure>
                <div class="title">
                    Your Booking Request Sent Successfully
                </div>
                {{-- <div class="des">
                    Join our community of professionals and clients today! By signing
                    up, you gain direct access to experienced multi-services,
                    personalized services, and a seamless platform to manage your
                    service needs.
                </div> --}}
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script type="text/javascript" src="{{ asset('frontend/assets/js/plugins/aos-2.3.1.min.js') }}"></script>

    <script type="text/javascript">
        const appointmentDatePicker = document.getElementById(
            'appointment-date-picker'
        );

        if (appointmentDatePicker) {
            const picker = new easepick.create({
                element: appointmentDatePicker,
                inline: true,
                css: [
                    '{{ asset('frontend/assets') }}/css/plugins/easepick-1.2.1.css',
                    '{{ asset('frontend/assets') }}/css/provider-profile-easepick.css',
                ],
            });
        }
    </script>

    {{-- <script>
        const chatIcon = document.getElementById('chat-icon');
        chatIcon.hidden = true;
        setTimeout(() => {
            chatIcon.hidden = false;
        }, 10000)
        chatIcon.onclick = function() {
            console.log('clicked');
        }
    </script> --}}

    <script>
        let currentMarker;
        const serviceLat = {{ $service->user->userAddresses()->first()->latitude ?? '34.0522' }}; // Default: Los Angeles
        const serviceLng = {{ $service->user->userAddresses()->first()->longitude ?? '-118.2437' }};
        let mapTilerKey = '';

        const map = L.map('map', {
            center: [serviceLat, serviceLng],
            zoom: 13,
            zoomControl: true,
            scrollWheelZoom: false
        });

        $.ajax({
            url: "{{ route('map.api.key') }}",
            method: "GET",
            success: function(response) {
                mapTilerKey = response.key;
                initializeMap();
            },
            error: function() {
                alert("Failed to load Map API key!");
            }
        });

        function initializeMap() {
            L.tileLayer(`https://api.maptiler.com/maps/basic-v2/{z}/{x}/{y}.png?key=${mapTilerKey}`, {
                maxZoom: 18,
                tileSize: 512,
                zoomOffset: -1
            }).addTo(map);

            // Show service provider's marker
            L.marker([serviceLat, serviceLng], {
                    draggable: false
                })
                .addTo(map)
                .bindPopup("Service Provider's Location")
                .openPopup();
        }

        function locateUser() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        // Show user's marker
                        const userMarker = L.marker([userLat, userLng], {
                                draggable: false
                            })
                            .addTo(map)
                            .bindPopup("Your Location")
                            .openPopup();

                        // Draw red line between user and service provider
                        const latLngs = [
                            [serviceLat, serviceLng],
                            [userLat, userLng]
                        ];
                        L.polyline(latLngs, {
                            color: 'red',
                            weight: 3
                        }).addTo(map);

                        // Fit map bounds
                        const bounds = L.latLngBounds(latLngs);
                        map.fitBounds(bounds);
                    },
                    () => {
                        alert("Location access denied! Using only service provider location.");
                    }, {
                        enableHighAccuracy: true,
                        timeout: 5000
                    }
                );
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        locateUser(); // Auto-locate on load


        function Booking(event) {
            event.prevent;
            // $.ajax({
            //     url: "{{ route('map.api.key') }}",
            //     method: "POST",
            //     success: function(response) {
            //         mapTilerKey = response.key;
            //         initializeMap();
            //     },
            //     error: function() {
            //         alert("Failed to load Map API key!");
            //     }
            // });
        }

        $(document).ready(function() {
            $('#bookAppointmentBtn').on('click', function(e) {
                e.preventDefault();

                let bookingDate = $('#appointment-date-picker').val(); // Get the date from date picker
                console.log(bookingDate);
                if (!bookingDate) {
                    alert("Please select a booking date.");
                    return;
                }

                $.ajax({
                    url: "{{ route('customer.booking.store') }}", // Laravel route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        service_id: "{{ $service->id }}", // Assuming `$service->id` is available
                        booking_date: bookingDate
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('#successModal').modal('show'); // Show success modal
                        } else {
                            alert(response.message); // Show error message
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = "Something went wrong!";

                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }

                        alert(errorMessage); // Show error alert
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            @php
                $galleryImages = is_array($service->gallery_images) ? $service->gallery_images : json_decode($service->gallery_images, true);
            @endphp
            const images = [
                @foreach ($galleryImages as $key => $gallery_image)
                    "{{ asset($gallery_image) }}",
                @endforeach
            ];
            let currentIndex = 0;

            function updateImage(index) {
                $("#modal-image").attr("src", images[index]);
            }

            $(".gallery-img").click(function() {
                currentIndex = $(this).data("index");
                updateImage(currentIndex);
                $("#imageModal").modal("show");
            });

            $(".see-all-img-btn").click(function() {
                currentIndex = 0;
                updateImage(currentIndex);
                $("#imageModal").modal("show");
            });

            $("#prev-btn").click(function() {
                currentIndex =
                    currentIndex > 0 ? currentIndex - 1 : images.length - 1;
                updateImage(currentIndex);
            });

            $("#next-btn").click(function() {
                currentIndex =
                    currentIndex < images.length - 1 ? currentIndex + 1 : 0;
                updateImage(currentIndex);
            });
        });
    </script>
@endpush
