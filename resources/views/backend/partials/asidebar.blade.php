{{-- @php
$systemSetting = App\Models\SystemSetting::first();
@endphp --}}
<!-- Start Sidebar Area -->
<div class="sidebar-area" id="sidebar-area">
    <div class="logo position-relative">
        <a href="{{ route('admin.dashboard') }}" class="d-block text-decoration-none position-relative">
            <img src="{{ asset($systemSetting->logo ?? 'backend/admin/assets/logo.png') }}" alt="logo-icon">
            {{-- <span class="logo-text fw-bold text-dark">Switch</span> --}}
        </a>
        <button
            class="sidebar-burger-menu bg-transparent p-0 border-0 opacity-0 z-n1 position-absolute top-50 end-0 translate-middle-y"
            id="sidebar-burger-menu">
            <i data-feather="x"></i>
        </button>
    </div>

    <aside id="layout-menu" class="layout-menu menu-vertical menu active" data-simplebar>
        <ul class="menu-inner">
            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">MAIN</span>
            </li>
            <!-- Dashboard Menu Item -->
            <li class="menu-item open">
                <a href="{{ route('admin.dashboard') }}"
                    class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined menu-icon">dashboard</span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">APPS</span>
            </li>

            <!-- User-list Menu Item -->
            <li class="menu-item {{ request()->routeIs('user-list.*') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">group_add</span>
                    <span class="title">Users</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('user-list.index', ['userType' => 'customer']) }}"
                            class="menu-link {{ request()->routeIs('user-list.index') && request('userType') == 'customer' ? 'active' : '' }}">
                            Customer
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('user-list.index', ['userType' => 'contractor']) }}"
                            class="menu-link {{ request()->routeIs('user-list.index') && request('userType') == 'contractor' ? 'active' : '' }}">
                            Provider
                        </a>
                    </li>

                </ul>
            </li>

            <!-- Category Menu Item -->
            <li class="menu-item open">
                <a href="{{ route('category.index') }}"
                    class="menu-link {{ request()->routeIs('category.index') ? 'active' : '' }}">
                    <span class="material-symbols-outlined menu-icon">handshake</span>
                    <span class="title">Category</span>
                </a>
            </li>
            <!-- Sub Category Menu Item -->
            <li class="menu-item open">
                <a href="{{ route('sub_category.index') }}"
                    class="menu-link {{ request()->routeIs('sub_category.index') ? 'active' : '' }}">
                    <span class="material-symbols-outlined menu-icon">content_paste</span>
                    <span class="title">Sub Category</span>
                </a>
            </li>
            <li class="menu-item open">
                <a href="{{ route('admin_contact_us.index') }}"
                    class="menu-link {{ request()->routeIs('admin_contact_us.index') ? 'active' : '' }}">
                    <span class="material-symbols-outlined menu-icon">content_paste</span>
                    <span class="title">Contact Us Message</span>
                </a>
            </li>

            <!-- Users Menu Item -->

            {{-- <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">group_add</span>
                    <span class="title">Users</span>
                </a>
                <ul class="menu-sub">
                    <!-- Users List Submenu -->
                    <li class="menu-item">
                        <a href="users-list.html" class="menu-link">
                            Users List
                        </a>
                    </li>
                    <!-- Add User Submenu -->
                    <li class="menu-item">
                        <a href="add-user.html" class="menu-link">
                            Add User
                        </a>
                    </li>
                </ul>
            </li> --}}

            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">OTHERS</span>
            </li>

            <!-- Settings Menu Item -->
            <li class="menu-item {{ request()->routeIs('profile_settings.*', 'system_settings.*') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">settings</span>
                    <span class="title">Settings</span>
                </a>
                <ul class="menu-sub">
                    <!-- Account Settings Submenu -->
                    <li class="menu-item ">
                        <a href="{{ route('profile_settings.index') }}"
                            class="menu-link {{ request()->routeIs('profile_settings.index') ? 'active' : '' }} ">
                            Profile Settings
                        </a>
                    </li>
                    <!-- Change Password Submenu -->
                    <li class="menu-item">
                        <a href="{{ route('profile_settings.password_change') }}"
                            class="menu-link {{ request()->routeIs('profile_settings.password_change') ? 'active' : '' }}">
                            Change Password
                        </a>
                    </li>
                    <!-- Email Configaration Submenu -->
                    <li class="menu-item">
                        <a href="{{ route('system_settings.index') }}"
                            class="menu-link {{ request()->routeIs('system_settings.index') ? 'active' : '' }}">
                            System Configaration
                        </a>
                    </li>
                    <!-- Email Configaration Submenu -->
                    <li class="menu-item">
                        <a href="{{ route('system_settings.mail_get') }}"
                            class="menu-link {{ request()->routeIs('system_settings.mail_get') ? 'active' : '' }}">
                            Email Configaration
                        </a>
                    </li>
                </ul>
            </li>
            <!-- dynamic page Menu Item -->
            <li class="menu-item {{ request()->routeIs('dynamic_page.*') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">clarify</span>
                    <span class="title">Daynamic page</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('dynamic_page.index') }}"
                            class="menu-link {{ request()->routeIs('dynamic_page.index') ? 'active' : '' }}">
                            Pages
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('dynamic_page.create') }}"
                            class="menu-link {{ request()->routeIs('dynamic_page.create') ? 'active' : '' }}">
                            Add New
                        </a>
                    </li>

                </ul>
            </li>

            <li class="menu-title small text-uppercase">
                <span class="menu-title-text">CMS</span>
            </li>
            <!-- CMS Menu Item -->
            <li class="menu-item {{ request()->routeIs('cms.home_page.*') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle active">
                    <span class="material-symbols-outlined menu-icon">handshake</span>
                    <span class="title">Home Page</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.banner.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.banner.*') ? 'active' : '' }}">
                            Hero Banner
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.service_container.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.service_container.*') ? 'active' : '' }}">
                            Service Container
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.process_container.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.process_container.index') ? 'active' : '' }}">
                            Process Container
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.platform_work_container.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.platform_work_container.index') ? 'active' : '' }}">
                            Platform Work
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.provider_work_container.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.provider_work_container.index') ? 'active' : '' }}">
                            Provider Work Container
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.review_container.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.review_container.index') ? 'active' : '' }}">
                            Review Container
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.advertisement_container.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.advertisement_container.index') ? 'active' : '' }}">
                            Advertisement Container
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.about_us_container.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.about_us_container.index') ? 'active' : '' }}">
                            About Us
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.faq_container.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.faq_container.index') ? 'active' : '' }}">
                            Faq Container
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('cms.home_page.social_link.index') }}"
                            class="menu-link {{ request()->routeIs('cms.home_page.social_link.index') ? 'active' : '' }}">
                            Social Link Container
                        </a>
                    </li>

                </ul>
            </li>
            <!-- CMS Car Item -->
            <li class="menu-item {{ request()->routeIs('cms.car_page.*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <span class="material-symbols-outlined menu-icon">directions_car</span>
                    <span class="title">Car Page</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('cms.car_page.banner') ? 'active' : '' }}">
                        <a href="{{ route('cms.car_page.banner') }}"
                            class="menu-link {{ request()->routeIs('cms.car_page.banner') ? 'active' : '' }}">
                            Car Banner
                        </a>
                    </li>
                </ul>
            </li>
            <!-- CMS Restaurant Item -->
            <li class="menu-item {{ request()->routeIs('cms.restaurant_page.*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <span class="material-symbols-outlined menu-icon">table_restaurant</span>
                    <span class="title">Restaurant Page</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('cms.restaurant_page.banner') ? 'active' : '' }}">
                        <a href="{{ route('cms.restaurant_page.banner') }}"
                            class="menu-link {{ request()->routeIs('cms.restaurant_page.banner') ? 'active' : '' }}">
                            Restaurant Banner
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- CMS Real Estate Item -->
            <li class="menu-item {{ request()->routeIs('cms.RealEstate_page.*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <span class="material-symbols-outlined menu-icon">home_work</span>
                    <span class="title">Real Estate Page</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('cms.RealEstate_page.banner') ? 'active' : '' }}">
                        <a href="{{ route('cms.RealEstate_page.banner') }}"
                            class="menu-link {{ request()->routeIs('cms.RealEstate_page.banner') ? 'active' : '' }}">
                            Real Estate Banner
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- CMS Service Provider Item -->
            <li class="menu-item {{ request()->routeIs('cms.service_page.*') || request()->routeIs('cms.provider_page.process.*') || request()->routeIs('cms.provider_page.work.*') ? 'open active' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <span class="material-symbols-outlined menu-icon">app_registration</span>
                    <span class="title">Provider Register Page</span>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('cms.service_page.container') ? 'active' : '' }}">
                        <a href="{{ route('cms.service_page.container') }}"
                            class="menu-link {{ request()->routeIs('cms.service_page.container') ? 'active' : '' }}">
                            Service Container
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('cms.provider_page.process.*') ? 'active' : '' }}">
                        <a href="{{ route('cms.provider_page.process.index') }}"
                            class="menu-link {{ request()->routeIs('cms.provider_page.process.*') ? 'active' : '' }}">
                            Process Container
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('cms.provider_page.work.*') ? 'active' : '' }}">
                        <a href="{{ route('cms.provider_page.work.index') }}"
                            class="menu-link {{ request()->routeIs('cms.provider_page.work.*') ? 'active' : '' }}">
                            Provider Work Container
                        </a>
                    </li>
                </ul>
            </li>
            




            <!-- Logout Menu Item -->
            <li class="menu-item">
                <a class="menu-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form-asidebar').submit();">
                    <span class="material-symbols-outlined menu-icon">logout</span>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>
        <form id="logout-form-asidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </aside>
</div>
<!-- End Sidebar Area -->
