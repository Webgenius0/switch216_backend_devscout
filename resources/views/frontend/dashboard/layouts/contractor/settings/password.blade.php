@extends('frontend.dashboard.app')

@section('title')
    Dashboard Contrator
@endsection
@section('header')
    @include('frontend.dashboard.partials.header')
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush

@section('content')
    <div class="col-12 p-5">
        <div class="card-body p-4 bg-white rounded ">
            <div class="mb-4">
                <h4 class="fs-20 mb-1">Password Settings</h4>
                <p class="fs-15">Update your Password and more details here.</p>
            </div>
            <form action="{{ route('contractor.settings.password_update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Old Password</label>
                            <div class="form-group">
                                <div class="password-wrapper position-relative">
                                    <input type="password" id="password" class="form-control h-55 text-dark @error('old_password') is-invalid @enderror" name="old_password" required>
                                    <i style="color: #A9A9C8; font-size: 16px; right: 15px;"
                                        class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 position-absolute"
                                        aria-hidden="true"></i>
                                </div>
                                @error('old_password')
                                    <div id="old_password-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">New Password</label>
                            <div class="form-group">
                                <div class="password-wrapper position-relative">
                                    <input type="password" class="form-control h-55 text-dark @error('password') is-invalid @enderror" name="password" required>
                                    {{-- <i style="color: #A9A9C8; font-size: 16px; right: 15px;"
                                        class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 position-absolute"
                                        aria-hidden="true"></i> --}}
                                </div>
                                @error('password')
                                    <div id="password-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Confirm Password</label>
                            <div class="form-group">
                                <div class="password-wrapper position-relative">
                                    <input type="password" class="form-control h-55 text-dark" name="password_confirmation" required>
                                    {{-- <i style="color: #A9A9C8; font-size: 16px; right: 15px;"
                                        class="ri-eye-off-line password-toggle-icon translate-middle-y top-50 position-absolute"
                                        aria-hidden="true"></i> --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-4">
                                {{-- <button type="submit"
                            class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</button> --}}
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16"> <i
                                        class="ri-check-line text-white fw-medium"></i> Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script src="{{ asset('frontend/assets/js/plugins/jquery-3.7.1.min.js') }}"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>
@endpush
