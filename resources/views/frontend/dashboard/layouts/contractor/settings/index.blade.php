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
                <h4 class="fs-20 mb-1">Profile Settings</h4>
                <p class="fs-15">Update your Profile and more details here.</p>
            </div>

            <form action="{{ route('contractor.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Name</label>
                            <div class="form-group position-relative">
                                <input type="text"
                                    class="form-control text-dark ps-3 h-55 @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $contractor->name ?? 'Mr. John Doe') }}" required
                                    placeholder="Enter Name here">
                            </div>
                            @error('name')
                                <div id="name-error" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Email</label>
                            <div class="form-group position-relative">
                                <input type="text"
                                    class="form-control text-dark ps-3 h-55 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $contractor->email ?? '') }}" required
                                     disabled>
                            </div>
                            @error('email')
                                <div id="email-error" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Phone</label>
                            <div class="form-group position-relative">
                                <input type="text"
                                    class="form-control text-dark ps-3 h-55 @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone', $contractor->phone ?? '+8801234567') }}" required
                                    placeholder="Enter Phone here">
                            </div>
                            @error('phone')
                                <div id="phone-error" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label text-secondary">Gender</label>
                            <div class="form-group position-relative">
                                <select class="form-select text-dark ps-3 h-55 @error('gender') is-invalid @enderror"
                                    name="gender" required>
                                    <option value="">Select</option>
                                    <option value="male" {{ old('gender', $contractor->gender ?? '') == 'male' ? 'selected' : '' }}>
                                        Male</option>
                                    <option value="female" {{ old('gender', $contractor->gender ?? '') == 'female' ? 'selected' : '' }}>
                                        Female</option>
                                    <option value="other" {{ old('gender', $contractor->gender ?? '') == 'other' ? 'selected' : '' }}>
                                        Other</option>
                                </select>
                            </div>
                            @error('gender')
                                <div id="gender-error" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group ">
                            <label class="label text-secondary mb-1">Avatar</label>
                            <input class="dropify form-control @error('avatar') is-invalid @enderror" type="file"
                                name="avatar"
                                data-default-file="{{ asset($contractor->avatar ?? 'backend/assets/images/user.png') }}">
                            @error('avatar')
                                <div id="avatar-error" class="text-danger">{{ $message }}</div>
                            @enderror
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
    {{-- <script src="{{ asset('frontend/assets/js/plugins/jquery-3.7.1.min.js') }}"></script> --}}
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>
@endpush
