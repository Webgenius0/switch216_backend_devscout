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
