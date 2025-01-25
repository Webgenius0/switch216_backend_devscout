@extends('frontend.app')

@section('title')
    Provider Register Page
@endsection
@section('header')
    {{-- @include('frontend.partials.header') --}}
    @include('frontend.partials.header2')
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/serviceResponsive.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/service.css" />
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jQuery (required by Select2) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

@endpush

@section('content')
    <!-- main section start -->
    <main class="auth-container mt-md-5 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-right">
                    <figure class="auth-img">
                        <img src="{{ asset('frontend/assets') }}/images/auth.png" alt="auth image" />
                    </figure>
                </div>
                <div class="col-md-6" data-aos="fade-left">
                    <div class="auth-step-form-container">
                        <form class="auth-step-form" method="POST" action="{{ route('provider.register.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <!-- Step 1 -->
                            <div class="step-content">
                                <!-- step header start -->
                                {{-- <div class="step-tagline">
                                    <span>1</span>/4 Create Profile
                                </div> --}}
                                <div class="step-title">Tell us about yourself</div>
                                {{-- <div class="step-progress">
                                    <div class="circle active"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                </div> --}}
                                <!-- step header start -->
                                <div class="form-group">
                                    <label>Upload Profile Image</label>
                                    <div class="profile-upload-container">
                                        <div class="profile-upload-box">
                                            <div class="content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    viewBox="0 0 32 32" fill="none">
                                                    <path
                                                        d="M16 11V21M21 16H11M31 16C31 17.9698 30.612 19.9204 29.8582 21.7403C29.1044 23.5601 27.9995 25.2137 26.6066 26.6066C25.2137 27.9995 23.5601 29.1044 21.7403 29.8582C19.9204 30.612 17.9698 31 16 31C14.0302 31 12.0796 30.612 10.2597 29.8582C8.43986 29.1044 6.78628 27.9995 5.3934 26.6066C4.00052 25.2137 2.89563 23.5601 2.14181 21.7403C1.38799 19.9204 1 17.9698 1 16C1 12.0218 2.58035 8.20644 5.3934 5.3934C8.20644 2.58035 12.0218 1 16 1C19.9782 1 23.7936 2.58035 26.6066 5.3934C29.4196 8.20644 31 12.0218 31 16Z"
                                                        stroke="#222222" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <div class="text">Upload Photo</div>
                                            </div>
                                            <input type="file" name="avatar" accept="image/*" hidden />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" placeholder="Enter your name" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" placeholder="Enter your email" />
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" inputmode="numeric"
                                        placeholder="Enter your phone number" />
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    {{-- <select class="form-select" name="location" id="">
                                        <option value="">Select Location</option>
                                        @foreach ($morocco_city['results'] as $value)
                                            <option value="{{ $value['geonameid'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select class="form-select" name="location" id="location-select">
                                        <option value="">Select Location</option>
                                        @foreach ($morocco_city['results'] as $value)
                                            <option value="{{ $value['geonameid'] }}">{{ $value['name'] }}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                {{-- <div class="form-group">
                                    <label for="instagram">Add Instagram Link</label>
                                    <input type="url" id="instagram" name="instagram"
                                        placeholder="Enter Instagram link" />
                                </div> --}}
                                <div class="form-navigation">
                                    <button type="submit" class="button-next">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main section end -->
@endsection


@push('scripts')
{{-- <script>
    $(document).ready(function() {
        // Initialize Select2 on the dropdown
        $('#location-select').select2({
            placeholder: "Select Location", // Optional placeholder
            allowClear: true                // Allows clearing the selection
        });
    });
</script> --}}
@endpush
