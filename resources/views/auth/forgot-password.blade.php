{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
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
            <div class="auth-title">Email your account</div>
            <div class="se--new-user">
              <p>New user?</p>
              <a href="{{route('register')}}">Create an Account</a>

            </div>
            <form class="auth-form" method="POST" action="{{ route('password.email') }}">
              @csrf
              <fieldset class="input-wrapper">
                <label for="userEmail" class="input-label">Email</label>
                <input type="email" id="userEmail" class="input-field" placeholder="kolchie@mail.com" required name="email" :value="old('email')"  autofocus autocomplete="username" />
              </fieldset>
              <button type="submit" class="button w-100">Continue</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- main section end -->
@endsection

@push('scripts')
@endpush

