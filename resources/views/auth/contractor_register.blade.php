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
                                <div class="step-tagline">
                                    <span>1</span>/4 Create Profile
                                </div>
                                <div class="step-title">Tell us about yourself</div>
                                <div class="step-progress">
                                    <div class="circle active"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                </div>
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
                                <div class="form-group">
                                    <label for="instagram">Add Instagram Link</label>
                                    <input type="url" id="instagram" name="instagram"
                                        placeholder="Enter Instagram link" />
                                </div>
                                <div class="form-navigation">
                                    <button type="button" class="button-prev" disabled aria-disabled="true">
                                        Pervious
                                    </button>
                                    <button type="button" class="button-next">Next</button>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="step-content">
                                <!-- step header start -->
                                <div class="step-tagline">
                                    <span>2</span>/4 Create Profile
                                </div>
                                <div class="step-title">select Category</div>
                                <div class="step-progress">
                                    <div class="circle active"></div>
                                    <div class="line active"></div>
                                    <div class="circle active"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                </div>
                                <!-- step header start -->
                                <div class="form-group">
                                    <label for="serviceTitle">Category*</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="serviceTitle">Sub Category*</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Seo Optimization</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="serviceDetails">Description</label>
                                    <textarea id="serviceDetails" name="serviceDetails" placeholder="I am Seo Expert"></textarea>
                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="button-prev">Pervious</button>
                                    <button type="button" class="button-next">Next</button>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="step-content">
                                <!-- step header start -->
                                <div class="step-tagline">
                                    <span>3</span>/4 Create Profile
                                </div>
                                <div class="step-title">Tell more about your service</div>
                                <div class="step-progress">
                                    <div class="circle active"></div>
                                    <div class="line active"></div>
                                    <div class="circle active"></div>
                                    <div class="line active"></div>
                                    <div class="circle active"></div>
                                    <div class="line"></div>
                                    <div class="circle"></div>
                                </div>
                                <!-- step header start -->
                                <div class="form-group">
                                    <label for="serviceTitle">Service Title</label>
                                    <input type="text" id="serviceTitle" name="serviceTitle"
                                        placeholder="Enter service title" />
                                </div>
                                <div class="form-group">
                                    <label for="serviceDetails">Service Details</label>
                                    <textarea id="serviceDetails" name="serviceDetails" placeholder="Enter service details"></textarea>

                                    {{-- <button class="se--add--service">Add Service</button> --}}
                                </div>
                                <div class="form-group">
                                    <label for="emergency">Emergency Service</label>
                                    <label class="check-label">
                                        <input type="checkbox" name="emergency" />
                                        <span class="custom-check-box"></span>
                                        Active emergency support
                                    </label>
                                </div>
                                <div class="form-navigation">
                                    <button type="button" class="button-prev">Pervious</button>
                                    <button type="button" class="button-next">Next</button>
                                </div>
                            </div>

                            <!--step 4-->

                            <div class="step-content">
                                <!-- step header start -->
                                <div class="step-tagline"><span>4</span>/4 Final Step</div>
                                <div class="step-title">Review and Submit</div>
                                <div class="step-progress">
                                    <div class="circle active"></div>
                                    <div class="line active"></div>
                                    <div class="circle active"></div>
                                    <div class="line active"></div>
                                    <div class="circle active"></div>
                                    <div class="line active"></div>
                                    <div class="circle active"></div>
                                </div>
                                <!-- step header end -->
                                <div class="form-group">
                                    <label for="">Upload gallery image</label>
                                    <div class="se--set" id="imagePreviewContainer"></div>
                                    <div class="file-upload-container">
                                        <div class="content">
                                            <div class="drag-container">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61"
                                                    viewBox="0 0 60 61" fill="none">
                                                    <path
                                                        d="M53.125 33V21.75C53.125 18.4348 51.808 15.2554 49.4638 12.9112C47.1196 10.567 43.9402 9.25 40.625 9.25H19.375C16.0598 9.25 12.8804 10.567 10.5362 12.9112C8.19196 15.2554 6.875 18.4348 6.875 21.75V39.25C6.875 40.8915 7.19832 42.517 7.82651 44.0335C8.45469 45.5501 9.37543 46.9281 10.5362 48.0888C12.8804 50.433 16.0598 51.75 19.375 51.75H35.025"
                                                        stroke="#FF6600" stroke-width="4" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path
                                                        d="M7.52344 43.0001L14.3734 35.0001C15.273 34.1066 16.4537 33.5514 17.7156 33.4284C18.9776 33.3054 20.2432 33.6221 21.2984 34.3251C22.3536 35.028 23.6193 35.3448 24.8812 35.2218C26.1432 35.0988 27.3238 34.5436 28.2234 33.6501L34.0484 27.8251C35.7222 26.1457 37.9382 25.1156 40.301 24.9187C42.6639 24.7218 45.0198 25.3709 46.9484 26.7501L53.1234 31.5251M20.0234 25.9251C20.5684 25.9218 21.1074 25.8112 21.6097 25.5996C22.1119 25.388 22.5676 25.0796 22.9506 24.6919C23.3336 24.3042 23.6366 23.8449 23.8421 23.3401C24.0476 22.8354 24.1517 22.2951 24.1484 21.7501C24.1452 21.2051 24.0346 20.6661 23.823 20.1638C23.6114 19.6616 23.3029 19.2059 22.9153 18.8229C22.5276 18.4399 22.0682 18.1369 21.5635 17.9314C21.0587 17.7259 20.5184 17.6218 19.9734 17.6251C18.8728 17.6317 17.8199 18.0753 17.0463 18.8583C16.2727 19.6412 15.8418 20.6994 15.8484 21.8001C15.8551 22.9007 16.2987 23.9537 17.0816 24.7272C17.8646 25.5008 18.9228 25.9317 20.0234 25.9251Z"
                                                        stroke="#FF6600" stroke-width="4" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                    <path d="M46.7656 38V50.5" stroke="#FF6600" stroke-width="4"
                                                        stroke-miterlimit="10" stroke-linecap="round" />
                                                    <path
                                                        d="M52.5002 43.262L47.5827 38.3445C47.4758 38.2372 47.3488 38.152 47.2089 38.0939C47.0691 38.0358 46.9191 38.0059 46.7677 38.0059C46.6162 38.0059 46.4662 38.0358 46.3264 38.0939C46.1865 38.152 46.0595 38.2372 45.9527 38.3445L41.0352 43.262"
                                                        stroke="#FF6600" stroke-width="4" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                                <span class="title">Drag and drop file here</span>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="choose-container">
                                                <span>Or choose a file</span>
                                                <button type="button">Browser</button>
                                                <span>Supported file types: .jpg, .jpeg, .png.</span>
                                            </div>
                                        </div>
                                        <input type="file" name="gallary_image[]" accept="image/*" multiple
                                            id="fileInput" hidden />


                                    </div>
                                </div>

                                <div class="form-navigation">
                                    <button type="button" class="button-prev">Previous</button>
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
