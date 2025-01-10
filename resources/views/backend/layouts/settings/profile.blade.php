@extends('backend.app')
@section('title', 'Profile')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
@endpush
@section('content')
    <main>
        <h2 class="section-title">Profile Settings</h2>
        {{-- here tab list  --}}
        <ul class="order-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-setting-tab" data-bs-toggle="tab"
                    data-bs-target="#profile-setting" type="button" role="tab" aria-controls="profile-setting"
                    aria-selected="true">
                    Profile Settings
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-password-setting-tab" data-bs-toggle="tab"
                    data-bs-target="#profile-password-setting" type="button" role="tab"
                    aria-controls="profile-password-setting" aria-selected="false" tabindex="-1">
                    Update Password
                </button>
            </li>
        </ul>


        {{-- here tab content  --}}
        <div class="tab-content">
            <div class="tab-pane active" id="profile-setting" role="tabpanel" aria-labelledby="profile-setting-tab"
                tabindex="0">
                <div class="table-wrapper">
                    <form action="{{ route('profile_settings.update') }}" method="POST" class="tm-form mt-5"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-field-wrapper">
                            {{-- Name input field --}}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    name="name" required placeholder="Enter Name here"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div id="name-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Phone input field --}}
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input class="form-control @error('phone') is-invalid @enderror" type="tel"
                                    name="phone" required placeholder="0123122123"
                                    value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                    <div id="phone-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-field-wrapper">
                            {{-- Email input field --}}
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    name="email" required placeholder="Email Address"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div id="email-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nationality input field --}}
                            <div class="form-group">
                                <label for="nationality">Nationality*</label>
                                <select class="tm-dropdown @error('nationality') is-invalid @enderror" name="nationality"
                                    required>
                                    <option value="">Select Nationality</option>
                                    <option value="USA"
                                        {{ old('nationality', $user->nationality ?? '') == 'USA' ? 'selected' : '' }}>USA
                                    </option>
                                    <option value="UK"
                                        {{ old('nationality', $user->nationality ?? '') == 'UK' ? 'selected' : '' }}>UK
                                    </option>
                                    <option value="Canada"
                                        {{ old('nationality', $user->nationality ?? '') == 'Canada' ? 'selected' : '' }}>
                                        Canada</option>
                                </select>
                                @error('nationality')
                                    <div id="nationality-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-field-wrapper">
                            {{-- Date of Birth input field --}}
                            <div class="form-group">
                                <label for="birthday">Date of Birth</label>
                                <input class="form-control @error('birthday') is-invalid @enderror" type="date"
                                    name="birthday" required
                                    value="{{ old('birthday', isset($user->birthday) ? \Carbon\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}">
                                @error('birthday')
                                    <div id="birthday-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Gender input field --}}
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="tm-dropdown @error('gender') is-invalid @enderror" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="male"
                                        {{ old('gender', $user->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female"
                                        {{ old('gender', $user->gender ?? '') == 'female' ? 'selected' : '' }}>Female
                                    </option>
                                    <option value="other"
                                        {{ old('gender', $user->gender ?? '') == 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                                @error('gender')
                                    <div id="gender-error" class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Photo input field --}}
                        <div class="form-group">
                            <label for="avatar">Photo</label>
                            <input class="dropify form-control @error('avatar') is-invalid @enderror" type="file"
                                name="avatar"
                                data-default-file="{{ asset(auth()->user()->avatar ? auth()->user()->avatar : 'backend/images/avatar_defult.png') }}">
                            @error('avatar')
                                <div id="avatar-error" class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button class="tm-dashboard-btn" type="submit" style="align-self: flex-start;">Update</button>
                    </form>

                </div>
            </div>

            <div class="tab-pane" id="profile-password-setting" role="tabpanel"
                aria-labelledby="profile-password-setting-tab" tabindex="0">
                <div class="table-wrapper">
                    <form action="{{ route('profile_settings.password') }}" method="POST" class="tm-form mt-5">
                        @csrf
                        {{-- old password input field --}}
                        <div class="user-box password-wrapper col-6">
                            <input type="password" name="old_password" required placeholder="Enter Old Password" />
                            <button class="password-toggle-icon" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20"
                                    viewBox="0 0 22 20" fill="none">
                                    <path d="M2 1L20 19" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M9.58445 8.58704C9.20917 8.96205 8.99823 9.47079 8.99805 10.0013C8.99786 10.5319 9.20844 11.0408 9.58345 11.416C9.95847 11.7913 10.4672 12.0023 10.9977 12.0024C11.5283 12.0026 12.0372 11.7921 12.4125 11.417"
                                        stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M8.363 3.36506C9.22042 3.11978 10.1082 2.9969 11 3.00006C15 3.00006 18.333 5.33306 21 10.0001C20.222 11.3611 19.388 12.5241 18.497 13.4881M16.357 15.3491C14.726 16.4491 12.942 17.0001 11 17.0001C7 17.0001 3.667 14.6671 1 10.0001C2.369 7.60506 3.913 5.82506 5.632 4.65906"
                                        stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        @error('old_password')
                            <div id="error-old_password" class="text-danger">{{ $message }}</div>
                        @enderror
                        {{-- new password input field --}}
                        <div class="user-box password-wrapper col-6">
                            <input type="password" name="password" id="new-password" required
                                placeholder="New Password" />
                            <button class="password-toggle-icon" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20"
                                    viewBox="0 0 22 20" fill="none">
                                    <path d="M2 1L20 19" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M9.58445 8.58704C9.20917 8.96205 8.99823 9.47079 8.99805 10.0013C8.99786 10.5319 9.20844 11.0408 9.58345 11.416C9.95847 11.7913 10.4672 12.0023 10.9977 12.0024C11.5283 12.0026 12.0372 11.7921 12.4125 11.417"
                                        stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M8.363 3.36506C9.22042 3.11978 10.1082 2.9969 11 3.00006C15 3.00006 18.333 5.33306 21 10.0001C20.222 11.3611 19.388 12.5241 18.497 13.4881M16.357 15.3491C14.726 16.4491 12.942 17.0001 11 17.0001C7 17.0001 3.667 14.6671 1 10.0001C2.369 7.60506 3.913 5.82506 5.632 4.65906"
                                        stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <div id="error-password" class="text-danger">{{ $message }}</div>
                        @enderror
                        {{-- new password confirmation input field --}}
                        <div class="user-box password-wrapper col-6">
                            <input type="password" name="password_confirmation" id="password_confirmation" required
                                placeholder="Confirm Password" />
                            <button class="password-toggle-icon" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="20"
                                    viewBox="0 0 22 20" fill="none">
                                    <path d="M2 1L20 19" stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M9.58445 8.58704C9.20917 8.96205 8.99823 9.47079 8.99805 10.0013C8.99786 10.5319 9.20844 11.0408 9.58345 11.416C9.95847 11.7913 10.4672 12.0023 10.9977 12.0024C11.5283 12.0026 12.0372 11.7921 12.4125 11.417"
                                        stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M8.363 3.36506C9.22042 3.11978 10.1082 2.9969 11 3.00006C15 3.00006 18.333 5.33306 21 10.0001C20.222 11.3611 19.388 12.5241 18.497 13.4881M16.357 15.3491C14.726 16.4491 12.942 17.0001 11 17.0001C7 17.0001 3.667 14.6671 1 10.0001C2.369 7.60506 3.913 5.82506 5.632 4.65906"
                                        stroke="#BFBFBF" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>

                        <button class="tm-dashboard-btn" type="submit" style="align-self: flex-start;">Update Password </button>
                    </form>

                </div>
            </div>
        </div>
    </main>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.tm-dropdown').niceSelect();
        });
    </script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropify').dropify();
        })
    </script>
@endpush
