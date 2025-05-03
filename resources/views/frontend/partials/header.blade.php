@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp
<!-- header section start -->
<header>
    <!-- navbar section start -->
    <nav class="navbar banner-navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="{{ route('home') }}" class="site-logo">
                    <img class="footer-logo"
                        src="{{ asset($systemSetting->logo ?? 'frontend/assets/images/light-logo.png') }}"
                        alt="site logo" />
                </a>
            </div>
            <div class="nav-items">
                <a class="nav-item active" href="{{ route('home') }}">Home</a>
                <div class="nav-item dropdown-items">
                    <span class="dropdown-item-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Category
                    </span>
                    <div class="dropdown-item-menu">
                        <a class="dropdown-item" href="{{ route('service.real_state') }}">Real Estate</a>
                        <a class="dropdown-item"
                            href="{{ route('service.restaurant') }}">Restaurant</a>
                        <a class="dropdown-item" href="{{ route('service.car') }}">Car</a>
                        <a class="dropdown-item" href="{{ route('service.category') }}">All Category</a>
                    </div>
                </div>
                <a href="{{ route('service.real_state') }}" class="nav-item">Real Estate</a>
                <a href="{{ route('service.restaurant') }}" class="nav-item">Restaurant</a>
                <a href="{{ route('service.car') }}" class="nav-item">Car</a>
                <a href="{{ route('service.emergency', ['serching_is_emergency' => 'true']) }}" class="nav-item">Emergency</a>
            </div>
            <div class="nav-actions">
                <select class="select" onchange="langChange(this)">
                    <option @if (app()->getLocale() !== 'es') selected @endif value="en">English</option>
                    <option @if (app()->getLocale() === 'es') selected @endif value="es">Spanish</option>
                    <option @if (app()->getLocale() === 'ar') selected @endif value="ar">Arabic</option>
                    <option @if (app()->getLocale() === 'fr') selected @endif value="fr">French</option>
                </select>
                @if (Auth::check())
                    <div class="profile-dropdown-container1">
                        <div class="profile-dropdown-btn">
                            <img src="{{ asset(Auth::user()->avatar ?? 'frontend/assets/images/profile.jpg') }}"
                                alt="Profile" />
                        </div>
                        <div class="profile-dropdown1">
                            <a class="dropdown-item1 mb-2">{{ Auth::user()->name ?? 'Mr. John Doe' }}</a>
                            <a
                                href="@if (Auth::user()->role === 'admin') {{ route('admin.dashboard') }}
                                  @elseif (Auth::user()->role === 'customer')
                                  {{ route('customer.dashboard') }}
                                   
                                  @elseif (Auth::user()->role === 'contractor')
                                  {{ route('contractor.dashboard') }} @endif">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 20 20" fill="#6B6B6B">
                                    <path
                                        d="M8.125 3.125H4.375C4.04348 3.125 3.72554 3.2567 3.49112 3.49112C3.2567 3.72554 3.125 4.04348 3.125 4.375V8.125C3.125 8.45652 3.2567 8.77446 3.49112 9.00888C3.72554 9.2433 4.04348 9.375 4.375 9.375H8.125C8.45652 9.375 8.77446 9.2433 9.00888 9.00888C9.2433 8.77446 9.375 8.45652 9.375 8.125V4.375C9.375 4.04348 9.2433 3.72554 9.00888 3.49112C8.77446 3.2567 8.45652 3.125 8.125 3.125ZM8.125 8.125H4.375V4.375H8.125V8.125ZM15.625 3.125H11.875C11.5435 3.125 11.2255 3.2567 10.9911 3.49112C10.7567 3.72554 10.625 4.04348 10.625 4.375V8.125C10.625 8.45652 10.7567 8.77446 10.9911 9.00888C11.2255 9.2433 11.5435 9.375 11.875 9.375H15.625C15.9565 9.375 16.2745 9.2433 16.5089 9.00888C16.7433 8.77446 16.875 8.45652 16.875 8.125V4.375C16.875 4.04348 16.7433 3.72554 16.5089 3.49112C16.2745 3.2567 15.9565 3.125 15.625 3.125ZM15.625 8.125H11.875V4.375H15.625V8.125ZM8.125 10.625H4.375C4.04348 10.625 3.72554 10.7567 3.49112 10.9911C3.2567 11.2255 3.125 11.5435 3.125 11.875V15.625C3.125 15.9565 3.2567 16.2745 3.49112 16.5089C3.72554 16.7433 4.04348 16.875 4.375 16.875H8.125C8.45652 16.875 8.77446 16.7433 9.00888 16.5089C9.2433 16.2745 9.375 15.9565 9.375 15.625V11.875C9.375 11.5435 9.2433 11.2255 9.00888 10.9911C8.77446 10.7567 8.45652 10.625 8.125 10.625ZM8.125 15.625H4.375V11.875H8.125V15.625ZM15.625 10.625H11.875C11.5435 10.625 11.2255 10.7567 10.9911 10.9911C10.7567 11.2255 10.625 11.5435 10.625 11.875V15.625C10.625 15.9565 10.7567 16.2745 10.9911 16.5089C11.2255 16.7433 11.5435 16.875 11.875 16.875H15.625C15.9565 16.875 16.2745 16.7433 16.5089 16.5089C16.7433 16.2745 16.875 15.9565 16.875 15.625V11.875C16.875 11.5435 16.7433 11.2255 16.5089 10.9911C16.2745 10.7567 15.9565 10.625 15.625 10.625ZM15.625 15.625H11.875V11.875H15.625V15.625Z"
                                        fill=""></path>
                                </svg>

                                <span>Dashboard</span>
                            </a>
                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                    viewBox="0 0 21 21" fill="none">
                                    <path
                                        d="M13.0174 5.74495V4.81195C13.0174 2.77695 11.3674 1.12695 9.33244 1.12695H4.45744C2.42344 1.12695 0.773438 2.77695 0.773438 4.81195V15.942C0.773438 17.977 2.42344 19.627 4.45744 19.627H9.34244C11.3714 19.627 13.0174 17.982 13.0174 15.953V15.01"
                                        stroke="#6B6B6B" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M19.8105 10.377H7.76953" stroke="#6B6B6B" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16.8828 7.46094L19.8108 10.3759L16.8828 13.2919" stroke="#6B6B6B"
                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                @else
                    @if (request()->routeIs('login') !== true)
                        <a href="{{ route('login') }}" class="auth-btn">Sign In</a>
                    @endif
                    <a href="{{ route('provider.index') }}" class="auth-btn auth-btn-sec">Join As service
                        provider</a>
                @endif


                <button type="button" class="menu-open button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="26" viewBox="0 0 28 26"
                        fill="none">
                        <path
                            d="M24.5 6.14999H3.5C3.3793 6.14999 3.125 5.98708 3.125 5.59999C3.125 5.2129 3.3793 5.04999 3.5 5.04999H24.5C24.6207 5.04999 24.875 5.2129 24.875 5.59999C24.875 5.98708 24.6207 6.14999 24.5 6.14999Z"
                            stroke="white" />
                        <path
                            d="M24.5 13.15H3.5C3.3793 13.15 3.125 12.9871 3.125 12.6C3.125 12.2129 3.3793 12.05 3.5 12.05H24.5C24.6207 12.05 24.875 12.2129 24.875 12.6C24.875 12.9871 24.6207 13.15 24.5 13.15Z"
                            stroke="white" />
                        <path
                            d="M24.5 20.15H3.5C3.3793 20.15 3.125 19.9871 3.125 19.6C3.125 19.2129 3.3793 19.05 3.5 19.05H24.5C24.6207 19.05 24.875 19.2129 24.875 19.6C24.875 19.9871 24.6207 20.15 24.5 20.15Z"
                            stroke="white" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
    <!-- navbar section end -->

    <!-- mobile navbar section start -->
    <div class="mobile-navbar">
        <button type="button" class="menu-close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path
                    d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z"
                    fill="white" />
                <path
                    d="M9.16937 15.58C8.97937 15.58 8.78938 15.51 8.63938 15.36C8.34938 15.07 8.34938 14.59 8.63938 14.3L14.2994 8.63999C14.5894 8.34999 15.0694 8.34999 15.3594 8.63999C15.6494 8.92999 15.6494 9.40998 15.3594 9.69998L9.69937 15.36C9.55937 15.51 9.35937 15.58 9.16937 15.58Z"
                    fill="white" />
                <path
                    d="M14.8294 15.58C14.6394 15.58 14.4494 15.51 14.2994 15.36L8.63938 9.69998C8.34938 9.40998 8.34938 8.92999 8.63938 8.63999C8.92937 8.34999 9.40937 8.34999 9.69937 8.63999L15.3594 14.3C15.6494 14.59 15.6494 15.07 15.3594 15.36C15.2094 15.51 15.0194 15.58 14.8294 15.58Z"
                    fill="white" />
            </svg>
        </button>
        <div class="logo">
            <a href="{{ route('home') }}" class="site-logo">
                <img class="footer-logo"
                    src="{{ asset($systemSetting->logo ?? 'frontend/assets/images/light-logo.png') }}"
                    alt="site logo" />
            </a>
        </div>
        <div class="nav-items">
            <a class="nav-item active" href="{{ route('home') }}">Home</a>
            <div class="nav-item dropdown-items">
                <span class="dropdown-item-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Category
                </span>
                <div class="dropdown-item-menu">
                    <a class="dropdown-item" href="{{ route('service.real_state') }}">Real Estate</a>
                    <a class="dropdown-item"
                        href="{{ route('service.restaurant') }}">Restaurant</a>
                    <a class="dropdown-item" href="{{ route('service.car') }}">Car </a>
                    <a class="dropdown-item" href="{{ route('service.category') }}">All Category</a>
                </div>
            </div>

            <a href="{{ route('service.real_state') }}" class="nav-item">Real Estate</a>
            <a href="{{ route('service.restaurant') }}" class="nav-item">Restaurant</a>
            <a href="{{ route('service.car') }}" class="nav-item">Car</a>
            <a href="{{ route('service.emergency',['serching_is_emergency'=> 'true']) }}" class="nav-item">Emergency</a>
        </div>
        <div class="nav-actions">
            <select class="select" onchange="langChange(this)">
                <option @if (app()->getLocale() !== 'es') selected @endif value="en">English</option>
                <option @if (app()->getLocale() === 'es') selected @endif value="es">Spanish</option>
                <option @if (app()->getLocale() === 'ar') selected @endif value="ar">Arabic</option>
                <option @if (app()->getLocale() === 'fr') selected @endif value="fr">French</option>
            </select>
            @if (Auth::check())
            @else
                <a href="{{ route('login') }}" class="auth-btn">Sign In</a>
                <a href="{{ route('provider.index') }}" class="auth-btn auth-btn-sec">Join As service
                    provider</a>
            @endif
        </div>
    </div>
    <!-- mobile navbar section end -->
</header>
<!-- header section end -->

<script>
    function langChange(e) {
        console.log(e.value)
        var url = '{{ route('setLocale', ':code') }}';
        $.ajax({
            type: "POST",
            url: url.replace(':code', e.value),
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(resp) {
                //handle success
            },
            error: function(error) {
                //handle error
            }
        })

        if (e.value === 'es') {
            doGTranslate('en|es');
            doGTranslate('en|es');
        } else if (e.value === 'ar') {
            doGTranslate('en|ar');
            doGTranslate('en|ar');
        } else if (e.value === 'fr') {
            doGTranslate('en|fr');
            doGTranslate('en|fr');
        } else {
            doGTranslate('es|en');
            doGTranslate('es|en');
        }
        return false;
    }
</script>
