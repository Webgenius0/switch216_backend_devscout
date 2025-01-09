{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('frontend.app')

@section('title')
    Home Page
@endsection
@section('header')
    {{-- @include('frontend.partials.header') --}}
    @include('frontend.partials.header2')
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/service.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets') }}/css/serviceResponsive.css" />
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
                    <div class="auth-card">
                        <div class="auth-title">Sign Up</div>
                        <form class="auth-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <fieldset class="input-wrapper">
                                <label for="userName" class="input-label">Name</label>
                                <input type="text" id="userName" class="input-field" placeholder="Enter your Name"
                                    required name="name"    value="{{ old('name') }}" />
                                    <span class="text-red-600 text-sm" style="color: red">{{ $errors->first('name') }}</span> 
                            </fieldset>
                            <fieldset class="input-wrapper">
                                <label for="userEmail" class="input-label">Email</label>
                                <input type="email" id="userEmail" class="input-field" placeholder="Enter your Email"
                                        required name="email" value="{{ old('email') }}" />
                                    <span class="text-red-600 text-sm" style="color: red">{{ $errors->first('email') }}</span> 
                            </fieldset>
                            <fieldset class="input-wrapper password-wrapper">
                                <label for="userPassword" class="input-label">Password</label>
                                <input type="password" id="userPassword" class="input-field" placeholder="******"
                                    required name="password" /> 
                                    <span class="text-red-600 text-sm" style="color: red">{{ $errors->first('password') }}</span> 
                            </fieldset>
                            <fieldset class="input-wrapper password-wrapper">
                                <label for="userPassword" class="input-label">Confirm Password</label>
                                <input type="password" id="userPassword" class="input-field" placeholder="******"
                                    required name="password_confirmation" /> 
                                    <span class="text-red-600 text-sm" style="color: red">{{ $errors->first('password_confirmation') }}</span> 
                            </fieldset>
                            <fieldset class="checkbox-wrapper">
                                <input type="checkbox" id="terms" class="checkbox-field" required />
                                <label class="checkbox-label" for="terms">
                                    I Accept Terms and Condition
                                </label>
                            </fieldset>
                            <button type="submit" class="button w-100">Sign Up</button>
                        </form>
                        <div class="auth-des auth-bottom text-center">
                            Already have an account? <a href="{{ route('login') }}">Sign In</a>
                        </div>
                        <div class="text-separator">
                            <div class="bar"></div>
                            <div class="text">or</div>
                            <div class="bar"></div>
                        </div>
                        <button type="button" class="social-auth-btn" id="google-auth-btn">
                            <img src="{{ asset('frontend/assets') }}/images/google-logo-9808 1.png" alt="google logo" />
                            <span>Sign Up Google account</span>
                        </button>
                        <button type="button" class="social-auth-btn" id="facebook-auth-btn">
                            <img src="{{ asset('frontend/assets') }}/images/logos_facebook.png" alt="facebook logo" />
                            <span>Sign Up Facebook account</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main section end -->
@endsection

@push('scripts')
@endpush
